<?php

class SigesInstituicaoForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'siges';
    private static $activeRecord = 'SigesInstituicao';
    private static $primaryKey = 'id';
    private static $formName = 'form_SigesInstituicao';

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
        $this->form->setFormTitle("Cadastro de instituição");


        $id = new TEntry('id');
        $status = new TRadioGroup('status');
        $instituicao_ensino = new TEntry('instituicao_ensino');
        $codigo_instituicao = new TEntry('codigo_instituicao');
        $cnpj = new TEntry('cnpj');
        $siges_tipos_instituicao_id = new TDBCombo('siges_tipos_instituicao_id', 'siges', 'SigesTiposInstituicao', 'id', '{tipo_instituicao}','tipo_instituicao asc'  );
        $responsavel = new TEntry('responsavel');
        $siges_cidades_id = new TDBUniqueSearch('siges_cidades_id', 'siges', 'SigesCidades', 'id', 'municipio','municipio asc'  );
        $endereco = new TEntry('endereco');
        $complemento = new TEntry('complemento');
        $cep = new TEntry('cep');
        $siges_contato_instituicao_siges_instituicao_siges_tipo_contato_id = new TDBCombo('siges_contato_instituicao_siges_instituicao_siges_tipo_contato_id', 'siges', 'SigesTipoContato', 'id', '{tipo}','tipo asc'  );
        $siges_contato_instituicao_siges_instituicao_info_contato = new TEntry('siges_contato_instituicao_siges_instituicao_info_contato');
        $alunos_matriculados_ef = new TEntry('alunos_matriculados_ef');
        $alunos_matriculados_em = new TEntry('alunos_matriculados_em');
        $siges_ideb_siges_instituicao_siges_tipo_serie_id = new TDBRadioGroup('siges_ideb_siges_instituicao_siges_tipo_serie_id', 'siges', 'SigesTipoSerie', 'id', '{tipo}','id asc'  );
        $siges_ideb_siges_instituicao_ano_ref = new TEntry('siges_ideb_siges_instituicao_ano_ref');
        $siges_ideb_siges_instituicao_ideb = new TNumeric('siges_ideb_siges_instituicao_ideb', '2', ',', '.' );
        $siges_contato_instituicao_siges_instituicao_id = new THidden('siges_contato_instituicao_siges_instituicao_id');
        $siges_ideb_siges_instituicao_id = new THidden('siges_ideb_siges_instituicao_id');

        $status->addValidation("Status", new TRequiredValidator()); 
        $instituicao_ensino->addValidation("Instituicao ensino", new TRequiredValidator()); 
        $siges_tipos_instituicao_id->addValidation("Tipo de Instituição", new TRequiredValidator()); 
        $siges_cidades_id->addValidation("Cidade", new TRequiredValidator()); 

        $id->setEditable(false);
        $status->addItems(['1'=>'Ativo','2'=>'Inativo']);
        $status->setValue('1:Ativo');
        $status->setUseButton();
        $siges_cidades_id->setMinLength(2);

        $status->setLayout('horizontal');
        $siges_ideb_siges_instituicao_siges_tipo_serie_id->setLayout('vertical');

        $cep->setMask('99.999-999');
        $cnpj->setMask('99.999.999/9999-99');
        $siges_cidades_id->setMask('{municipio} - {siges_estados->sigla} ');

        $cep->setMaxLength(10);
        $cnpj->setMaxLength(31);
        $endereco->setMaxLength(255);
        $responsavel->setMaxLength(255);
        $complemento->setMaxLength(255);
        $codigo_instituicao->setMaxLength(15);
        $instituicao_ensino->setMaxLength(255);
        $alunos_matriculados_ef->setMaxLength(11);
        $alunos_matriculados_em->setMaxLength(11);
        $siges_ideb_siges_instituicao_ano_ref->setMaxLength(4);
        $siges_contato_instituicao_siges_instituicao_info_contato->setMaxLength(255);

        $id->setSize(100);
        $cep->setSize('100%');
        $cnpj->setSize('100%');
        $status->setSize('100%');
        $endereco->setSize('100%');
        $complemento->setSize('100%');
        $responsavel->setSize('100%');
        $siges_cidades_id->setSize('100%');
        $codigo_instituicao->setSize('100%');
        $instituicao_ensino->setSize('100%');
        $alunos_matriculados_ef->setSize('100%');
        $alunos_matriculados_em->setSize('100%');
        $siges_tipos_instituicao_id->setSize('100%');
        $siges_ideb_siges_instituicao_ideb->setSize('100%');
        $siges_ideb_siges_instituicao_ano_ref->setSize('100%');
        $siges_ideb_siges_instituicao_siges_tipo_serie_id->setSize('100%');
        $siges_contato_instituicao_siges_instituicao_info_contato->setSize('100%');
        $siges_contato_instituicao_siges_instituicao_siges_tipo_contato_id->setSize('100%');

        $this->form->appendPage("Instituição");

        $this->form->addFields([new THidden('current_tab')]);
        $this->form->setTabFunction("$('[name=current_tab]').val($(this).attr('data-current_page'));");

        $row1 = $this->form->addContent([new TFormSeparator("Dados da Instituição de Ensino", '#333333', '18', '#eeeeee')]);
        $row2 = $this->form->addFields([new TLabel("Id:", null, '14px', null)],[$id],[new TLabel("Status:", null, '14px', null)],[$status]);
        $row3 = $this->form->addFields([new TLabel("Instituição ensino:", '#ff0000', '14px', null)],[$instituicao_ensino],[new TLabel("Codigo instituição (INEP):", null, '14px', null)],[$codigo_instituicao]);
        $row4 = $this->form->addFields([new TLabel("CNPJ:", null, '14px', null)],[$cnpj],[new TLabel("Tipo de instituição:", '#ff0000', '14px', null)],[$siges_tipos_instituicao_id]);
        $row5 = $this->form->addFields([new TLabel("Responsável:", null, '14px', null)],[$responsavel]);
        $row6 = $this->form->addContent([new TFormSeparator("Endereço", '#333333', '18', '#eeeeee')]);
        $row7 = $this->form->addFields([new TLabel("Cidade:", '#ff0000', '14px', null)],[$siges_cidades_id]);
        $row8 = $this->form->addFields([new TLabel("Endereço:", null, '14px', null)],[$endereco]);
        $row9 = $this->form->addFields([new TLabel("Complemento:", null, '14px', null)],[$complemento],[new TLabel("Cep:", null, '14px', null)],[$cep]);

        $this->form->appendPage("Contato");
        $row10 = $this->form->addFields([new TFormSeparator("Contatos na instituição", '#333333', '18', '#eeeeee')]);
        $row10->layout = [' col-sm-12'];

        $row11 = $this->form->addFields([new TLabel("Tipo de Contato:", '#ff0000', '14px', null)],[$siges_contato_instituicao_siges_instituicao_siges_tipo_contato_id]);
        $row12 = $this->form->addFields([new TLabel("Informação:", '#ff0000', '14px', null)],[$siges_contato_instituicao_siges_instituicao_info_contato]);
        $row13 = $this->form->addFields([$siges_contato_instituicao_siges_instituicao_id]);         
        $add_siges_contato_instituicao_siges_instituicao = new TButton('add_siges_contato_instituicao_siges_instituicao');

        $action_siges_contato_instituicao_siges_instituicao = new TAction(array($this, 'onAddSigesContatoInstituicaoSigesInstituicao'));

        $add_siges_contato_instituicao_siges_instituicao->setAction($action_siges_contato_instituicao_siges_instituicao, "Adicionar");
        $add_siges_contato_instituicao_siges_instituicao->setImage('fas:plus #000000');

        $this->form->addFields([$add_siges_contato_instituicao_siges_instituicao]);

        $detailDatagrid = new TQuickGrid;
        $detailDatagrid->disableHtmlConversion();
        $this->siges_contato_instituicao_siges_instituicao_list = new BootstrapDatagridWrapper($detailDatagrid);
        $this->siges_contato_instituicao_siges_instituicao_list->style = 'width:100%';
        $this->siges_contato_instituicao_siges_instituicao_list->class .= ' table-bordered';
        $this->siges_contato_instituicao_siges_instituicao_list->disableDefaultClick();
        $this->siges_contato_instituicao_siges_instituicao_list->addQuickColumn('', 'edit', 'left', 50);
        $this->siges_contato_instituicao_siges_instituicao_list->addQuickColumn('', 'delete', 'left', 50);

        $column_siges_contato_instituicao_siges_instituicao_siges_tipo_contato_id = $this->siges_contato_instituicao_siges_instituicao_list->addQuickColumn("Tipo de Contato", 'siges_contato_instituicao_siges_instituicao_siges_tipo_contato_id', 'left' , '250px');
        $column_siges_contato_instituicao_siges_instituicao_info_contato = $this->siges_contato_instituicao_siges_instituicao_list->addQuickColumn("Informação", 'siges_contato_instituicao_siges_instituicao_info_contato', 'left');

        $this->siges_contato_instituicao_siges_instituicao_list->createModel();
        $this->form->addContent([$this->siges_contato_instituicao_siges_instituicao_list]);

        $this->form->appendPage("Informações");
        $row14 = $this->form->addContent([new TFormSeparator("Alunos Matriculados", '#333333', '18', '#eeeeee')]);
        $row15 = $this->form->addFields([new TLabel("Ensino Fundamental", null, '14px', null)],[$alunos_matriculados_ef]);
        $row16 = $this->form->addFields([new TLabel("Ensino Médio", null, '14px', null)],[$alunos_matriculados_em]);

        $this->form->appendPage("IDEB");
        $row17 = $this->form->addFields([new TFormSeparator("Detail", '#333', '18', '#eee')]);
        $row17->layout = [' col-sm-12'];

        $row18 = $this->form->addFields([new TLabel("Tipo de Série", '#ff0000', '14px', null)],[$siges_ideb_siges_instituicao_siges_tipo_serie_id]);
        $row19 = $this->form->addFields([new TLabel("Ano referência:", '#ff0000', '14px', null)],[$siges_ideb_siges_instituicao_ano_ref]);
        $row20 = $this->form->addFields([new TLabel("Ideb:", '#ff0000', '14px', null)],[$siges_ideb_siges_instituicao_ideb]);
        $row21 = $this->form->addFields([$siges_ideb_siges_instituicao_id]);         
        $add_siges_ideb_siges_instituicao = new TButton('add_siges_ideb_siges_instituicao');

        $action_siges_ideb_siges_instituicao = new TAction(array($this, 'onAddSigesIdebSigesInstituicao'));

        $add_siges_ideb_siges_instituicao->setAction($action_siges_ideb_siges_instituicao, "Adicionar");
        $add_siges_ideb_siges_instituicao->setImage('fas:plus #000000');

        $this->form->addFields([$add_siges_ideb_siges_instituicao]);

        $detailDatagrid = new TQuickGrid;
        $detailDatagrid->disableHtmlConversion();
        $this->siges_ideb_siges_instituicao_list = new BootstrapDatagridWrapper($detailDatagrid);
        $this->siges_ideb_siges_instituicao_list->style = 'width:100%';
        $this->siges_ideb_siges_instituicao_list->class .= ' table-bordered';
        $this->siges_ideb_siges_instituicao_list->disableDefaultClick();
        $this->siges_ideb_siges_instituicao_list->addQuickColumn('', 'edit', 'left', 50);
        $this->siges_ideb_siges_instituicao_list->addQuickColumn('', 'delete', 'left', 50);

        $column_siges_ideb_siges_instituicao_ano_ref = $this->siges_ideb_siges_instituicao_list->addQuickColumn("Ano referência", 'siges_ideb_siges_instituicao_ano_ref', 'left' , '200px');
        $column_siges_ideb_siges_instituicao_ideb = $this->siges_ideb_siges_instituicao_list->addQuickColumn("Ideb", 'siges_ideb_siges_instituicao_ideb', 'left' , '200px');
        $column_siges_ideb_siges_instituicao_siges_tipo_serie_id = $this->siges_ideb_siges_instituicao_list->addQuickColumn("Tipo de Série", 'siges_ideb_siges_instituicao_siges_tipo_serie_id', 'left');

        $this->siges_ideb_siges_instituicao_list->createModel();
        $this->form->addContent([$this->siges_ideb_siges_instituicao_list]);

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        $container->add(TBreadCrumb::create(["Cadastro","Cadastro de instituição"]));
        $container->add($this->form);

        parent::add($container);

    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            /**
            // Enable Debug logger for SQL operations inside the transaction
            TTransaction::setLogger(new TLoggerSTD); // standard output
            TTransaction::setLogger(new TLoggerTXT('log.txt')); // file
            **/

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new SigesInstituicao(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $siges_ideb_siges_instituicao_items = $this->storeItems('SigesIdeb', 'siges_instituicao_id', $object, 'siges_ideb_siges_instituicao', function($masterObject, $detailObject){ 

                //code here

            }); 

            $siges_contato_instituicao_siges_instituicao_items = $this->storeItems('SigesContatoInstituicao', 'siges_instituicao_id', $object, 'siges_contato_instituicao_siges_instituicao', function($masterObject, $detailObject){ 

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

            new TMessage('info', "Registro salvo", $messageAction); 

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

                $object = new SigesInstituicao($key); // instantiates the Active Record 

                $siges_ideb_siges_instituicao_items = $this->loadItems('SigesIdeb', 'siges_instituicao_id', $object, 'siges_ideb_siges_instituicao', function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }); 

                $siges_contato_instituicao_siges_instituicao_items = $this->loadItems('SigesContatoInstituicao', 'siges_instituicao_id', $object, 'siges_contato_instituicao_siges_instituicao', function($masterObject, $detailObject, $objectItems){ 

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

        TSession::setValue('siges_contato_instituicao_siges_instituicao_items', null);
        TSession::setValue('siges_ideb_siges_instituicao_items', null);

        $this->onReload();
    }

    public function onAddSigesContatoInstituicaoSigesInstituicao( $param )
    {
        try
        {
            $data = $this->form->getData();

            if(!$data->siges_contato_instituicao_siges_instituicao_siges_tipo_contato_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', "Siges tipo contato id"));
            }             
            if(!$data->siges_contato_instituicao_siges_instituicao_info_contato)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', "Info contato"));
            }             

            $siges_contato_instituicao_siges_instituicao_items = TSession::getValue('siges_contato_instituicao_siges_instituicao_items');
            $key = isset($data->siges_contato_instituicao_siges_instituicao_id) && $data->siges_contato_instituicao_siges_instituicao_id ? $data->siges_contato_instituicao_siges_instituicao_id : uniqid();
            $fields = []; 

            $fields['siges_contato_instituicao_siges_instituicao_siges_tipo_contato_id'] = $data->siges_contato_instituicao_siges_instituicao_siges_tipo_contato_id;
            $fields['siges_contato_instituicao_siges_instituicao_info_contato'] = $data->siges_contato_instituicao_siges_instituicao_info_contato;
            $siges_contato_instituicao_siges_instituicao_items[ $key ] = $fields;

            TSession::setValue('siges_contato_instituicao_siges_instituicao_items', $siges_contato_instituicao_siges_instituicao_items);

            $data->siges_contato_instituicao_siges_instituicao_id = '';
            $data->siges_contato_instituicao_siges_instituicao_siges_tipo_contato_id = '';
            $data->siges_contato_instituicao_siges_instituicao_info_contato = '';

            $this->form->setData($data);

            $this->onReload( $param );
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());

            new TMessage('error', $e->getMessage());
        }
    }

    public function onEditSigesContatoInstituicaoSigesInstituicao( $param )
    {
        $data = $this->form->getData();

        // read session items
        $items = TSession::getValue('siges_contato_instituicao_siges_instituicao_items');

        // get the session item
        $item = $items[$param['siges_contato_instituicao_siges_instituicao_id_row_id']];

        $data->siges_contato_instituicao_siges_instituicao_siges_tipo_contato_id = $item['siges_contato_instituicao_siges_instituicao_siges_tipo_contato_id'];
        $data->siges_contato_instituicao_siges_instituicao_info_contato = $item['siges_contato_instituicao_siges_instituicao_info_contato'];

        $data->siges_contato_instituicao_siges_instituicao_id = $param['siges_contato_instituicao_siges_instituicao_id_row_id'];

        // fill product fields
        $this->form->setData( $data );

        $this->onReload( $param );

    }

    public function onDeleteSigesContatoInstituicaoSigesInstituicao( $param )
    {
        $data = $this->form->getData();

        $data->siges_contato_instituicao_siges_instituicao_siges_tipo_contato_id = '';
        $data->siges_contato_instituicao_siges_instituicao_info_contato = '';

        // clear form data
        $this->form->setData( $data );

        // read session items
        $items = TSession::getValue('siges_contato_instituicao_siges_instituicao_items');

        // delete the item from session
        unset($items[$param['siges_contato_instituicao_siges_instituicao_id_row_id']]);
        TSession::setValue('siges_contato_instituicao_siges_instituicao_items', $items);

        // reload sale items
        $this->onReload( $param );

    }

    public function onReloadSigesContatoInstituicaoSigesInstituicao( $param )
    {
        $items = TSession::getValue('siges_contato_instituicao_siges_instituicao_items'); 

        $this->siges_contato_instituicao_siges_instituicao_list->clear(); 

        if($items) 
        { 
            $cont = 1; 
            foreach ($items as $key => $item) 
            {
                $rowItem = new StdClass;

                $action_del = new TAction(array($this, 'onDeleteSigesContatoInstituicaoSigesInstituicao')); 
                $action_del->setParameter('siges_contato_instituicao_siges_instituicao_id_row_id', $key);
                $action_del->setParameter('row_data', base64_encode(serialize($item)));
                $action_del->setParameter('key', $key);

                $action_edi = new TAction(array($this, 'onEditSigesContatoInstituicaoSigesInstituicao'));  
                $action_edi->setParameter('siges_contato_instituicao_siges_instituicao_id_row_id', $key);  
                $action_edi->setParameter('row_data', base64_encode(serialize($item)));
                $action_edi->setParameter('key', $key);

                $button_del = new TButton('delete_siges_contato_instituicao_siges_instituicao'.$cont);
                $button_del->setAction($action_del, '');
                $button_del->setFormName($this->form->getName());
                $button_del->class = 'btn btn-link btn-sm';
                $button_del->title = "Excluir";
                $button_del->setImage('fas:trash-alt #dd5a43');

                $rowItem->delete = $button_del;

                $button_edi = new TButton('edit_siges_contato_instituicao_siges_instituicao'.$cont);
                $button_edi->setAction($action_edi, '');
                $button_edi->setFormName($this->form->getName());
                $button_edi->class = 'btn btn-link btn-sm';
                $button_edi->title = "Editar";
                $button_edi->setImage('far:edit #478fca');

                $rowItem->edit = $button_edi;

                $rowItem->siges_contato_instituicao_siges_instituicao_siges_tipo_contato_id = '';
                if(isset($item['siges_contato_instituicao_siges_instituicao_siges_tipo_contato_id']) && $item['siges_contato_instituicao_siges_instituicao_siges_tipo_contato_id'])
                {
                    TTransaction::open('siges');
                    $siges_tipo_contato = SigesTipoContato::find($item['siges_contato_instituicao_siges_instituicao_siges_tipo_contato_id']);
                    if($siges_tipo_contato)
                    {
                        $rowItem->siges_contato_instituicao_siges_instituicao_siges_tipo_contato_id = $siges_tipo_contato->render('{tipo}');
                    }
                    TTransaction::close();
                }

                $rowItem->siges_contato_instituicao_siges_instituicao_info_contato = isset($item['siges_contato_instituicao_siges_instituicao_info_contato']) ? $item['siges_contato_instituicao_siges_instituicao_info_contato'] : '';

                $row = $this->siges_contato_instituicao_siges_instituicao_list->addItem($rowItem);

                $cont++;
            } 
        } 
    } 

    public function onAddSigesIdebSigesInstituicao( $param )
    {
        try
        {
            $data = $this->form->getData();

            if(!$data->siges_ideb_siges_instituicao_siges_tipo_serie_id)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', "Tipo de Série"));
            }             
            if(!$data->siges_ideb_siges_instituicao_ano_ref)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', "Ano referência"));
            }             
            if(!$data->siges_ideb_siges_instituicao_ideb)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', "Ideb"));
            }             

            $siges_ideb_siges_instituicao_items = TSession::getValue('siges_ideb_siges_instituicao_items');
            $key = isset($data->siges_ideb_siges_instituicao_id) && $data->siges_ideb_siges_instituicao_id ? $data->siges_ideb_siges_instituicao_id : uniqid();
            $fields = []; 

            $fields['siges_ideb_siges_instituicao_siges_tipo_serie_id'] = $data->siges_ideb_siges_instituicao_siges_tipo_serie_id;
            $fields['siges_ideb_siges_instituicao_ano_ref'] = $data->siges_ideb_siges_instituicao_ano_ref;
            $fields['siges_ideb_siges_instituicao_ideb'] = $data->siges_ideb_siges_instituicao_ideb;
            $siges_ideb_siges_instituicao_items[ $key ] = $fields;

            TSession::setValue('siges_ideb_siges_instituicao_items', $siges_ideb_siges_instituicao_items);

            $data->siges_ideb_siges_instituicao_id = '';
            $data->siges_ideb_siges_instituicao_siges_tipo_serie_id = '';
            $data->siges_ideb_siges_instituicao_ano_ref = '';
            $data->siges_ideb_siges_instituicao_ideb = '';

            $this->form->setData($data);

            $this->onReload( $param );
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());

            new TMessage('error', $e->getMessage());
        }
    }

    public function onEditSigesIdebSigesInstituicao( $param )
    {
        $data = $this->form->getData();

        // read session items
        $items = TSession::getValue('siges_ideb_siges_instituicao_items');

        // get the session item
        $item = $items[$param['siges_ideb_siges_instituicao_id_row_id']];

        $data->siges_ideb_siges_instituicao_siges_tipo_serie_id = $item['siges_ideb_siges_instituicao_siges_tipo_serie_id'];
        $data->siges_ideb_siges_instituicao_ano_ref = $item['siges_ideb_siges_instituicao_ano_ref'];
        $data->siges_ideb_siges_instituicao_ideb = $item['siges_ideb_siges_instituicao_ideb'];

        $data->siges_ideb_siges_instituicao_id = $param['siges_ideb_siges_instituicao_id_row_id'];

        // fill product fields
        $this->form->setData( $data );

        $this->onReload( $param );

    }

    public function onDeleteSigesIdebSigesInstituicao( $param )
    {
        $data = $this->form->getData();

        $data->siges_ideb_siges_instituicao_siges_tipo_serie_id = '';
        $data->siges_ideb_siges_instituicao_ano_ref = '';
        $data->siges_ideb_siges_instituicao_ideb = '';

        // clear form data
        $this->form->setData( $data );

        // read session items
        $items = TSession::getValue('siges_ideb_siges_instituicao_items');

        // delete the item from session
        unset($items[$param['siges_ideb_siges_instituicao_id_row_id']]);
        TSession::setValue('siges_ideb_siges_instituicao_items', $items);

        // reload sale items
        $this->onReload( $param );

    }

    public function onReloadSigesIdebSigesInstituicao( $param )
    {
        $items = TSession::getValue('siges_ideb_siges_instituicao_items'); 

        $this->siges_ideb_siges_instituicao_list->clear(); 

        if($items) 
        { 
            $cont = 1; 
            foreach ($items as $key => $item) 
            {
                $rowItem = new StdClass;

                $action_del = new TAction(array($this, 'onDeleteSigesIdebSigesInstituicao')); 
                $action_del->setParameter('siges_ideb_siges_instituicao_id_row_id', $key);
                $action_del->setParameter('row_data', base64_encode(serialize($item)));
                $action_del->setParameter('key', $key);

                $action_edi = new TAction(array($this, 'onEditSigesIdebSigesInstituicao'));  
                $action_edi->setParameter('siges_ideb_siges_instituicao_id_row_id', $key);  
                $action_edi->setParameter('row_data', base64_encode(serialize($item)));
                $action_edi->setParameter('key', $key);

                $button_del = new TButton('delete_siges_ideb_siges_instituicao'.$cont);
                $button_del->setAction($action_del, '');
                $button_del->setFormName($this->form->getName());
                $button_del->class = 'btn btn-link btn-sm';
                $button_del->title = "Excluir";
                $button_del->setImage('fas:trash-alt #dd5a43');

                $rowItem->delete = $button_del;

                $button_edi = new TButton('edit_siges_ideb_siges_instituicao'.$cont);
                $button_edi->setAction($action_edi, '');
                $button_edi->setFormName($this->form->getName());
                $button_edi->class = 'btn btn-link btn-sm';
                $button_edi->title = "Editar";
                $button_edi->setImage('far:edit #478fca');

                $rowItem->edit = $button_edi;

                $rowItem->siges_ideb_siges_instituicao_siges_tipo_serie_id = '';
                if(isset($item['siges_ideb_siges_instituicao_siges_tipo_serie_id']) && $item['siges_ideb_siges_instituicao_siges_tipo_serie_id'])
                {
                    TTransaction::open('siges');
                    $siges_tipo_serie = SigesTipoSerie::find($item['siges_ideb_siges_instituicao_siges_tipo_serie_id']);
                    if($siges_tipo_serie)
                    {
                        $rowItem->siges_ideb_siges_instituicao_siges_tipo_serie_id = $siges_tipo_serie->render('{tipo}');
                    }
                    TTransaction::close();
                }

                $rowItem->siges_ideb_siges_instituicao_ano_ref = isset($item['siges_ideb_siges_instituicao_ano_ref']) ? $item['siges_ideb_siges_instituicao_ano_ref'] : '';
                $rowItem->siges_ideb_siges_instituicao_ideb = isset($item['siges_ideb_siges_instituicao_ideb']) ? $item['siges_ideb_siges_instituicao_ideb'] : '';

                $row = $this->siges_ideb_siges_instituicao_list->addItem($rowItem);

                $cont++;
            } 
        } 
    } 

    public function onShow($param = null)
    {

        TSession::setValue('siges_contato_instituicao_siges_instituicao_items', null);
        TSession::setValue('siges_ideb_siges_instituicao_items', null);

        $this->onReload();

    } 

    public function onReload($params = null)
    {
        $this->loaded = TRUE;

        $this->onReloadSigesContatoInstituicaoSigesInstituicao($params);
        $this->onReloadSigesIdebSigesInstituicao($params);
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

