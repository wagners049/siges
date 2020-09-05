<?php

class SigesUserForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'siges';
    private static $activeRecord = 'SystemUsers';
    private static $primaryKey = 'id';
    private static $formName = 'form_SigesUser';

    use Adianti\Base\AdiantiMasterDetailTrait;

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Cadastro de Atleta");


        $id = new TEntry('id');
        $name = new TEntry('name');
        $email = new TEntry('email');
        $cpf = new TEntry('cpf');
        $genero = new TRadioGroup('genero');
        $nascimento = new TDate('nascimento');
        $siges_instituicao_id = new TDBUniqueSearch('siges_instituicao_id', 'siges', 'SigesInstituicao', 'id', 'instituicao_ensino','instituicao_ensino asc'  );
        $siges_atletas_modalidades_siges_user_siges_modalidades_id = new TDBCombo('siges_atletas_modalidades_siges_user_siges_modalidades_id', 'siges', 'SigesModalidades', 'id', '{modalidade}','id asc'  );
        $observacoes = new THtmlEditor('observacoes');
        $siges_atletas_modalidades_siges_user_id = new THidden('siges_atletas_modalidades_siges_user_id');
        $siges_contato_users_siges_user_siges_tipo_contato_id = new TDBCombo('siges_contato_users_siges_user_siges_tipo_contato_id', 'siges', 'SigesTipoContato', 'id', '{tipo}','tipo asc'  );
        $siges_contato_users_siges_user_info_contato = new TEntry('siges_contato_users_siges_user_info_contato');
        $siges_contato_users_siges_user_id = new THidden('siges_contato_users_siges_user_id');

        $name->addValidation("Name", new TRequiredValidator()); 
        $email->addValidation("E-mail", new TRequiredValidator()); 
        $email->addValidation("E-mail", new TEmailValidator()); 
        $cpf->addValidation("CPF", new TRequiredValidator()); 
        $cpf->addValidation("CPF", new TCPFValidator()); 

        $id->setEditable(false);
        $genero->addItems(['F'=>'Feminino','M'=>'Masculino']);
        $genero->setLayout('horizontal');
        $genero->setBreakItems(2);
        $nascimento->setDatabaseMask('yyyy-mm-dd');
        $siges_instituicao_id->setMinLength(1);

        $cpf->setMask('999.999.999-99');
        $nascimento->setMask('dd/mm/yyyy');
        $siges_instituicao_id->setMask('{instituicao_ensino} - {siges_cidades->municipio} ({siges_cidades->siges_estados->sigla})');

        $id->setSize(100);
        $cpf->setSize('100%');
        $name->setSize('100%');
        $email->setSize('100%');
        $genero->setSize('100%');
        $nascimento->setSize(200);
        $observacoes->setSize('75%', 300);
        $siges_instituicao_id->setSize('100%');
        $siges_atletas_modalidades_siges_user_siges_modalidades_id->setSize('100%');
        $siges_contato_users_siges_user_info_contato->setSize('100%');
        $siges_contato_users_siges_user_siges_tipo_contato_id->setSize('100%');

        $this->form->appendPage("Cadastro");

        $this->form->addFields([new THidden('current_tab')]);
        $this->form->setTabFunction("$('[name=current_tab]').val($(this).attr('data-current_page'));");

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null)],[$id]);
        $row2 = $this->form->addFields([new TLabel("Nome:", '#ff0000', '14px', null)],[$name]);
        $row3 = $this->form->addFields([new TLabel("E-mail:", '#ff0000', '14px', null)],[$email]);
        $row4 = $this->form->addFields([new TLabel("CPF:", '#ff0000', '14px', null)],[$cpf]);
        $row5 = $this->form->addFields([new TLabel("Gênero:", null, '14px', null)],[$genero]);
        $row6 = $this->form->addFields([new TLabel("Nascimento:", null, '14px', null)],[$nascimento]);
        $row7 = $this->form->addFields([new TLabel("Instituição de ensino:", null, '14px', null)],[$siges_instituicao_id]);
        $row8 = $this->form->addFields([new TFormSeparator("Modalidade", '#333333', '18', '#eeeeee')]);
        $row8->layout = [' col-sm-12'];

        $row9 = $this->form->addFields([new TLabel("Modalidade", '#ff0000', '14px', null)],[$siges_atletas_modalidades_siges_user_siges_modalidades_id]);
        $row10 = $this->form->addFields([$siges_atletas_modalidades_siges_user_id]);         
        $add_siges_atletas_modalidades_siges_user = new TButton('add_siges_atletas_modalidades_siges_user');

        $action_siges_atletas_modalidades_siges_user = new TAction(array($this, 'onAddSigesAtletasModalidadesSigesUser'));

        $add_siges_atletas_modalidades_siges_user->setAction($action_siges_atletas_modalidades_siges_user, "Adicionar");
        $add_siges_atletas_modalidades_siges_user->setImage('fa:plus #000000');

        $this->form->addFields([$add_siges_atletas_modalidades_siges_user]);

        $this->siges_atletas_modalidades_siges_user_list = new BootstrapDatagridWrapper(new TQuickGrid);
        $this->siges_atletas_modalidades_siges_user_list->style = 'width:100%';
        $this->siges_atletas_modalidades_siges_user_list->class .= ' table-bordered';
        $this->siges_atletas_modalidades_siges_user_list->disableDefaultClick();
        $this->siges_atletas_modalidades_siges_user_list->addQuickColumn('', 'edit', 'left', 50);
        $this->siges_atletas_modalidades_siges_user_list->addQuickColumn('', 'delete', 'left', 50);

        $column_siges_atletas_modalidades_siges_user_siges_modalidades_id_transformed = $this->siges_atletas_modalidades_siges_user_list->addQuickColumn("Modalidade", 'siges_atletas_modalidades_siges_user_siges_modalidades_id', 'left');

        $this->siges_atletas_modalidades_siges_user_list->createModel();
        $this->form->addContent([$this->siges_atletas_modalidades_siges_user_list]);

        $column_siges_atletas_modalidades_siges_user_siges_modalidades_id_transformed->setTransformer(function($value, $object, $row) 
        {
            if($value)
            {
                return mb_strtoupper($value);
            }
        });
        $this->form->appendPage("Contatos");
        $row13 = $this->form->addFields([new TLabel("Tipo de contato:", '#ff0000', '14px', null)],[$siges_contato_users_siges_user_siges_tipo_contato_id]);
        $row14 = $this->form->addFields([new TLabel("Informação:", '#ff0000', '14px', null)],[$siges_contato_users_siges_user_info_contato]);
        $row15 = $this->form->addFields([$siges_contato_users_siges_user_id]);         
        $add_siges_contato_users_siges_user = new TButton('add_siges_contato_users_siges_user');

        $action_siges_contato_users_siges_user = new TAction(array($this, 'onAddSigesContatoUsersSigesUser'));

        $add_siges_contato_users_siges_user->setAction($action_siges_contato_users_siges_user, "Adicionar");
        $add_siges_contato_users_siges_user->setImage('fa:plus #000000');

        $this->form->addFields([$add_siges_contato_users_siges_user]);

        $this->siges_contato_users_siges_user_list = new BootstrapDatagridWrapper(new TQuickGrid);
        $this->siges_contato_users_siges_user_list->style = 'width:100%';
        $this->siges_contato_users_siges_user_list->class .= ' table-bordered';
        $this->siges_contato_users_siges_user_list->disableDefaultClick();
        $this->siges_contato_users_siges_user_list->addQuickColumn('', 'edit', 'left', 50);
        $this->siges_contato_users_siges_user_list->addQuickColumn('', 'delete', 'left', 50);

        $column_siges_contato_users_siges_user_siges_tipo_contato_id = $this->siges_contato_users_siges_user_list->addQuickColumn("Tipo de contato", 'siges_contato_users_siges_user_siges_tipo_contato_id', 'left' , '150px');
        $column_siges_contato_users_siges_user_info_contato = $this->siges_contato_users_siges_user_list->addQuickColumn("Informação", 'siges_contato_users_siges_user_info_contato', 'left');

        $this->siges_contato_users_siges_user_list->createModel();
        $this->form->addContent([$this->siges_contato_users_siges_user_list]);


        $this->form->appendPage("Observações");
        $row12 = $this->form->addFields([new TLabel("Observações:", null, '14px', null)],[$observacoes]);

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fa:floppy-o #ffffff');
        $btn_onsave->addStyleClass('btn-primary'); 

        //$btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fa:eraser #dd5a43');

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        $container->add(TBreadCrumb::create(["Usuários","Cadastro de Atleta"]));
        $container->add($this->form);

        parent::add($container);

    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new SystemUsers(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data
            
            //var_dump($data);

            if( empty($object->id) )
            {
                if (SystemUsers::newFromLogin($object->login) instanceof SystemUsers)
                {
                    throw new Exception(_t('An user with this login is already registered'));
                }
            }
            
            $object->store(); // save the object 

            $siges_atletas_modalidades_siges_user_items = $this->storeItems('SigesAtletasModalidades', 'system_users_id', $object, 'siges_atletas_modalidades_siges_user', function($masterObject, $detailObject){ 
                // code
             }); 

             $siges_contato_users_siges_user_items = $this->storeItems('SigesContatoUsers', 'system_users_id', $object, 'siges_contato_users_siges_user', function($masterObject, $detailObject){ //</blockLine>
                //code here
            }); 
            
            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data


            TTransaction::close(); // close the transaction

            /**
            // To define an action to be executed on the message close event:
            $messageAction = new TAction(['className', 'methodName']);
            **/

            new TMessage('info', AdiantiCoreTranslator::translate('Record saved'), $messageAction);

        }
        catch (Exception $e) // in case of exception
        {
            //</catchAutoCode> 

            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }

    public function onEdit( $param )
    {
        try
        {
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open(self::$database); // open a transaction

                $object = new SystemUsers($key); // instantiates the Active Record 

                $siges_atletas_modalidades_siges_user_items = $this->loadItems('SigesAtletasModalidades', 'system_users_id', $object, 'siges_atletas_modalidades_siges_user', function($masterObject, $detailObject, $objectItems){ 
                    //code here
                }); 

                $siges_contato_users_siges_user_items = $this->loadItems('SigesContatoUsers', 'system_users_id', $object, 'siges_contato_users_siges_user', function($masterObject, $detailObject, $objectItems){ //</blockLine>
                    //code here
                }); 

                $this->form->setData($object); // fill the form 

                    $this->onReload();

                TTransaction::close(); // close the transaction 
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    /**
     * Clear form data
     * @param $param Request
     */
    public function onClear( $param )
    {
        $this->form->clear(true);

        TSession::setValue('siges_atletas_modalidades_siges_user_items', null);
        TSession::setValue('siges_contato_users_siges_user_items', null);

        $this->onReload();
    }

    public function onAddSigesAtletasModalidadesSigesUser( $param )
    {
        try
        {
            $data = $this->form->getData();

            if(!$data->siges_atletas_modalidades_siges_user_siges_modalidades_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', "Siges modalidades id"));
            }             

            $siges_atletas_modalidades_siges_user_items = TSession::getValue('siges_atletas_modalidades_siges_user_items');
            $key = isset($data->siges_atletas_modalidades_siges_user_id) && $data->siges_atletas_modalidades_siges_user_id ? $data->siges_atletas_modalidades_siges_user_id : uniqid();
            $fields = []; 

            $fields['siges_atletas_modalidades_siges_user_siges_modalidades_id'] = $data->siges_atletas_modalidades_siges_user_siges_modalidades_id;
            $siges_atletas_modalidades_siges_user_items[ $key ] = $fields;

            TSession::setValue('siges_atletas_modalidades_siges_user_items', $siges_atletas_modalidades_siges_user_items);

            $data->siges_atletas_modalidades_siges_user_id = '';
            $data->siges_atletas_modalidades_siges_user_siges_modalidades_id = '';

            $this->form->setData($data);

            $this->onReload( $param );
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());

            new TMessage('error', $e->getMessage());
        }
    }

    public function onEditSigesAtletasModalidadesSigesUser( $param )
    {
        $data = $this->form->getData();

        // read session items
        $items = TSession::getValue('siges_atletas_modalidades_siges_user_items');

        // get the session item
        $item = $items[$param['siges_atletas_modalidades_siges_user_id_row_id']];

        $data->siges_atletas_modalidades_siges_user_siges_modalidades_id = $item['siges_atletas_modalidades_siges_user_siges_modalidades_id'];

        $data->siges_atletas_modalidades_siges_user_id = $param['siges_atletas_modalidades_siges_user_id_row_id'];

        // fill product fields
        $this->form->setData( $data );

        $this->onReload( $param );

    }

    public function onDeleteSigesAtletasModalidadesSigesUser( $param )
    {
        $data = $this->form->getData();

        $data->siges_atletas_modalidades_siges_user_siges_modalidades_id = '';

        // clear form data
        $this->form->setData( $data );

        // read session items
        $items = TSession::getValue('siges_atletas_modalidades_siges_user_items');

        // delete the item from session
        unset($items[$param['siges_atletas_modalidades_siges_user_id_row_id']]);
        TSession::setValue('siges_atletas_modalidades_siges_user_items', $items);

        // reload sale items
        $this->onReload( $param );

    }

    public function onReloadSigesAtletasModalidadesSigesUser( $param )
    {
        $items = TSession::getValue('siges_atletas_modalidades_siges_user_items'); 

        $this->siges_atletas_modalidades_siges_user_list->clear(); 

        if($items) 
        { 
            $cont = 1; 
            foreach ($items as $key => $item) 
            {
                $rowItem = new StdClass;

                $action_del = new TAction(array($this, 'onDeleteSigesAtletasModalidadesSigesUser')); 
                $action_del->setParameter('siges_atletas_modalidades_siges_user_id_row_id', $key);
                $action_del->setParameter('row_data', base64_encode(serialize($item)));
                $action_del->setParameter('key', $key);

                $action_edi = new TAction(array($this, 'onEditSigesAtletasModalidadesSigesUser'));  
                $action_edi->setParameter('siges_atletas_modalidades_siges_user_id_row_id', $key);  
                $action_edi->setParameter('row_data', base64_encode(serialize($item)));
                $action_edi->setParameter('key', $key);

                $button_del = new TButton('delete_siges_atletas_modalidades_siges_user'.$cont);
                $button_del->setAction($action_del, '');
                $button_del->setFormName($this->form->getName());
                $button_del->class = 'btn btn-link btn-sm';
                $button_del->title = "Excluir";
                $button_del->setImage('fa:trash-o #dd5a43');

                $rowItem->delete = $button_del;

                $button_edi = new TButton('edit_siges_atletas_modalidades_siges_user'.$cont);
                $button_edi->setAction($action_edi, '');
                $button_edi->setFormName($this->form->getName());
                $button_edi->class = 'btn btn-link btn-sm';
                $button_edi->title = "Editar";
                $button_edi->setImage('fa:pencil-square-o #478fca');

                $rowItem->edit = $button_edi;

                $rowItem->siges_atletas_modalidades_siges_user_siges_modalidades_id = '';
                if(isset($item['siges_atletas_modalidades_siges_user_siges_modalidades_id']) && $item['siges_atletas_modalidades_siges_user_siges_modalidades_id'])
                {
                    TTransaction::open('siges');
                    $siges_modalidades = SigesModalidades::find($item['siges_atletas_modalidades_siges_user_siges_modalidades_id']);
                    if($siges_modalidades)
                    {
                        $rowItem->siges_atletas_modalidades_siges_user_siges_modalidades_id = $siges_modalidades->render('{modalidade}');
                    }
                    TTransaction::close();
                }

                $row = $this->siges_atletas_modalidades_siges_user_list->addItem($rowItem);

                $cont++;
            } 
        } 
    } 

    public function onAddSigesContatoUsersSigesUser( $param )
    {
        try
        {
            $data = $this->form->getData();

            if(!$data->siges_contato_users_siges_user_siges_tipo_contato_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', "Siges tipo contato id"));
            }             
            if(!$data->siges_contato_users_siges_user_info_contato)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', "Info contato"));
            }             

            $siges_contato_users_siges_user_items = TSession::getValue('siges_contato_users_siges_user_items');
            $key = isset($data->siges_contato_users_siges_user_id) && $data->siges_contato_users_siges_user_id ? $data->siges_contato_users_siges_user_id : uniqid();
            $fields = []; 

            $fields['siges_contato_users_siges_user_siges_tipo_contato_id'] = $data->siges_contato_users_siges_user_siges_tipo_contato_id;
            $fields['siges_contato_users_siges_user_info_contato'] = $data->siges_contato_users_siges_user_info_contato;
            $siges_contato_users_siges_user_items[ $key ] = $fields;

            //<onAddDetailSigesContatoUsersSigesUser>

            //</onAddDetailSigesContatoUsersSigesUser>

            TSession::setValue('siges_contato_users_siges_user_items', $siges_contato_users_siges_user_items);

            $data->siges_contato_users_siges_user_id = '';
            $data->siges_contato_users_siges_user_siges_tipo_contato_id = '';
            $data->siges_contato_users_siges_user_info_contato = '';

            $this->form->setData($data);

            $this->onReload( $param );
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());

            new TMessage('error', $e->getMessage());
        }
    }

    public function onEditSigesContatoUsersSigesUser( $param )
    {
        $data = $this->form->getData();

        // read session items
        $items = TSession::getValue('siges_contato_users_siges_user_items');

        // get the session item
        $item = $items[$param['siges_contato_users_siges_user_id_row_id']];

        $data->siges_contato_users_siges_user_siges_tipo_contato_id = $item['siges_contato_users_siges_user_siges_tipo_contato_id'];
        $data->siges_contato_users_siges_user_info_contato = $item['siges_contato_users_siges_user_info_contato'];

        $data->siges_contato_users_siges_user_id = $param['siges_contato_users_siges_user_id_row_id'];

        //<onDetailStartActionEditSigesContatoUsersSigesUser>

        //</onDetailStartActionEditSigesContatoUsersSigesUser>

        // fill product fields
        $this->form->setData( $data );

        $this->onReload( $param );

        //<onDetailFinishActionEditSigesContatoUsersSigesUser>

        //</onDetailFinishActionEditSigesContatoUsersSigesUser>
    }

    public function onDeleteSigesContatoUsersSigesUser( $param )
    {
        $data = $this->form->getData();

        //<onDetailStartActionDeleteSigesContatoUsersSigesUser>

        //</onDetailStartActionDeleteSigesContatoUsersSigesUser>

        $data->siges_contato_users_siges_user_siges_tipo_contato_id = '';
        $data->siges_contato_users_siges_user_info_contato = '';

        // clear form data
        $this->form->setData( $data );

        // read session items
        $items = TSession::getValue('siges_contato_users_siges_user_items');

        // delete the item from session
        unset($items[$param['siges_contato_users_siges_user_id_row_id']]);
        TSession::setValue('siges_contato_users_siges_user_items', $items);

        // reload sale items
        $this->onReload( $param );

        //<onDetailFinishActionDeleteSigesContatoUsersSigesUser>

        //</onDetailFinishActionDeleteSigesContatoUsersSigesUser>
    }

    public function onReloadSigesContatoUsersSigesUser( $param )
    {
        $items = TSession::getValue('siges_contato_users_siges_user_items'); 

        //<onDetailStartOnReloadSigesContatoUsersSigesUser>

        //</onDetailStartOnReloadSigesContatoUsersSigesUser>

        $this->siges_contato_users_siges_user_list->clear(); 

        if($items) 
        { 
            $cont = 1; 
            foreach ($items as $key => $item) 
            {
                $rowItem = new StdClass;

                $action_del = new TAction(array($this, 'onDeleteSigesContatoUsersSigesUser')); 
                $action_del->setParameter('siges_contato_users_siges_user_id_row_id', $key);
                $action_del->setParameter('row_data', base64_encode(serialize($item)));
                $action_del->setParameter('key', $key);

                $action_edi = new TAction(array($this, 'onEditSigesContatoUsersSigesUser'));  
                $action_edi->setParameter('siges_contato_users_siges_user_id_row_id', $key);  
                $action_edi->setParameter('row_data', base64_encode(serialize($item)));
                $action_edi->setParameter('key', $key);

                $button_del = new TButton('delete_siges_contato_users_siges_user'.$cont);
                $button_del->setAction($action_del, '');
                $button_del->setFormName($this->form->getName());
                $button_del->class = 'btn btn-link btn-sm';
                $button_del->title = "Excluir";
                $button_del->setImage('fa:trash-o #dd5a43');

                $rowItem->delete = $button_del;

                $button_edi = new TButton('edit_siges_contato_users_siges_user'.$cont);
                $button_edi->setAction($action_edi, '');
                $button_edi->setFormName($this->form->getName());
                $button_edi->class = 'btn btn-link btn-sm';
                $button_edi->title = "Editar";
                $button_edi->setImage('fa:pencil-square-o #478fca');

                $rowItem->edit = $button_edi;

                //<onAfterDetailActionsCreationSigesContatoUsersSigesUser>

                //</onAfterDetailActionsCreationSigesContatoUsersSigesUser>

                //<generatedAutoCode>
                $rowItem->siges_contato_users_siges_user_siges_tipo_contato_id = '';
                if(isset($item['siges_contato_users_siges_user_siges_tipo_contato_id']) && $item['siges_contato_users_siges_user_siges_tipo_contato_id'])
                {
                    TTransaction::open('siges');
                    $siges_tipo_contato = SigesTipoContato::find($item['siges_contato_users_siges_user_siges_tipo_contato_id']);
                    if($siges_tipo_contato)
                    {
                        $rowItem->siges_contato_users_siges_user_siges_tipo_contato_id = $siges_tipo_contato->render('{tipo}');
                    }
                    TTransaction::close();
                }

                $rowItem->siges_contato_users_siges_user_info_contato = isset($item['siges_contato_users_siges_user_info_contato']) ? $item['siges_contato_users_siges_user_info_contato'] : '';
                //</generatedAutoCode>

                //<onDetailFinishOnReloadSigesContatoUsersSigesUser>

                //</onDetailFinishOnReloadSigesContatoUsersSigesUser>

                $row = $this->siges_contato_users_siges_user_list->addItem($rowItem);

                $cont++;
            } 
        } 
    } 

    public function onShow($param = null)
    {
        TSession::setValue('siges_atletas_modalidades_siges_user_items', null);
        TSession::setValue('siges_contato_users_siges_user_items', null);

        $this->onReload();

    } 

    public function onReload($params = null)
    {
        $this->loaded = TRUE;

        $this->onReloadSigesAtletasModalidadesSigesUser($params);
        $this->onReloadSigesContatoUsersSigesUser($params);
    }

    public function show() 
    { 
        $param = func_get_arg(0);
        if(!empty($param['current_tab']))
        {
            $this->form->setCurrentPage($param['current_tab']);
        }

        if (!$this->loaded AND (!isset($_GET['method']) OR $_GET['method'] !== 'onReload') ) 
        { 
            $this->onReload( func_get_arg(0) );
        }
        parent::show();
    }

}

