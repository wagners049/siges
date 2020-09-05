<?php

class SigesCidadesForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'siges';
    private static $activeRecord = 'SigesCidades';
    private static $primaryKey = 'id';
    private static $formName = 'form_SigesCidades';

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
        $this->form->setFormTitle("Cadastro de Cidade");


        $id = new TEntry('id');
        $active = new TRadioGroup('active');
        $municipio = new TEntry('municipio');
        $codigo_cidade = new TEntry('codigo_cidade');
        $codigo_siges = new TEntry('codigo_siges');
        $siges_estados_id = new TDBCombo('siges_estados_id', 'siges', 'SigesEstados', 'id', '{estado}','id asc'  );
        $siges_regioes_esportivas_id = new TDBCombo('siges_regioes_esportivas_id', 'siges', 'SigesRegioesEsportivas', 'id', '{regiao}','nr_regiao asc'  );
        $siges_cidades_idh_siges_cidades_ano = new TEntry('siges_cidades_idh_siges_cidades_ano');
        $siges_cidades_idh_siges_cidades_idhm = new TNumeric('siges_cidades_idh_siges_cidades_idhm', '3', ',', '.' );
        $siges_cidades_idh_siges_cidades_idhm_renda = new TNumeric('siges_cidades_idh_siges_cidades_idhm_renda', '3', ',', '.' );
        $siges_cidades_idh_siges_cidades_idhm_long = new TNumeric('siges_cidades_idh_siges_cidades_idhm_long', '3', ',', '.' );
        $siges_cidades_idh_siges_cidades_idhm_educacao = new TNumeric('siges_cidades_idh_siges_cidades_idhm_educacao', '3', ',', '.' );
        $gentilico = new TEntry('gentilico');
        $prefeito = new TEntry('prefeito');
        $populacao = new TEntry('populacao');
        $area_territorial = new TNumeric('area_territorial', '2', ',', '.' );
        $pib = new TEntry('pib');
        $siges_cidades_idh_siges_cidades_id = new THidden('siges_cidades_idh_siges_cidades_id');

        $active->addValidation("Ativo", new TRequiredValidator()); 
        $municipio->addValidation("Municipio", new TRequiredValidator()); 
        $codigo_cidade->addValidation("Codigo cidade", new TRequiredValidator()); 
        $siges_estados_id->addValidation("Siges estados id", new TRequiredValidator()); 
        $siges_regioes_esportivas_id->addValidation("Siges regioes esportivas id", new TRequiredValidator()); 

        $id->setEditable(false);
        $active->addItems(['1'=>'Sim','2'=>'Não']);
        $active->setLayout('horizontal');
        $active->setValue('1:Sim');
        $active->setUseButton();
        $siges_cidades_idh_siges_cidades_ano->setMask('9999');

        $municipio->setMaxLength(40);
        $prefeito->setMaxLength(255);
        $populacao->setMaxLength(11);
        $gentilico->setMaxLength(255);
        $codigo_siges->setMaxLength(3);
        $codigo_cidade->setMaxLength(7);
        $siges_cidades_idh_siges_cidades_ano->setMaxLength(4);

        $id->setSize(100);
        $pib->setSize('100%');
        $active->setSize('100%');
        $prefeito->setSize('100%');
        $municipio->setSize('100%');
        $gentilico->setSize('100%');
        $populacao->setSize('100%');
        $codigo_siges->setSize('100%');
        $codigo_cidade->setSize('100%');
        $siges_estados_id->setSize('100%');
        $area_territorial->setSize('100%');
        $siges_regioes_esportivas_id->setSize('100%');
        $siges_cidades_idh_siges_cidades_ano->setSize('100%');
        $siges_cidades_idh_siges_cidades_idhm->setSize('100%');
        $siges_cidades_idh_siges_cidades_idhm_long->setSize('100%');
        $siges_cidades_idh_siges_cidades_idhm_renda->setSize('100%');
        $siges_cidades_idh_siges_cidades_idhm_educacao->setSize('100%');

        $this->form->appendPage("Cidade");

        $this->form->addFields([new THidden('current_tab')]);
        $this->form->setTabFunction("$('[name=current_tab]').val($(this).attr('data-current_page'));");

        $row1 = $this->form->addContent([new TFormSeparator("Cidade", '#333333', '18', '#eeeeee')]);
        $row2 = $this->form->addFields([new TLabel("Id:", null, '14px', null)],[$id],[new TLabel("Ativo:", '#ff0000', '14px', null)],[$active]);
        $row3 = $this->form->addFields([new TLabel("Município:", '#ff0000', '14px', null)],[$municipio]);
        $row4 = $this->form->addFields([new TLabel("Código IBGE:", null, '14px', null)],[$codigo_cidade],[new TLabel("Código SIGES:", null, '14px', null)],[$codigo_siges]);
        $row5 = $this->form->addFields([new TLabel("Estado:", '#ff0000', '14px', null)],[$siges_estados_id],[new TLabel("Regiões esportivas:", '#ff0000', '14px', null)],[$siges_regioes_esportivas_id]);

        $this->form->appendPage("IDH");
        $row6 = $this->form->addFields([new TFormSeparator("IDH", '#333333', '18', '#eeeeee')]);
        $row6->layout = [' col-sm-12'];

        $row7 = $this->form->addFields([new TLabel("Ano:", '#ff0000', '14px', null)],[$siges_cidades_idh_siges_cidades_ano]);
        $row8 = $this->form->addFields([new TLabel("IDHM", null, '14px', null)],[$siges_cidades_idh_siges_cidades_idhm],[new TLabel("IDHM Renda", null, '14px', null)],[$siges_cidades_idh_siges_cidades_idhm_renda]);
        $row9 = $this->form->addFields([new TLabel("IDHM Longevidade", null, '14px', null)],[$siges_cidades_idh_siges_cidades_idhm_long],[new TLabel("IDHM Educação", null, '14px', null)],[$siges_cidades_idh_siges_cidades_idhm_educacao]);
        $row10 = $this->form->addFields([$siges_cidades_idh_siges_cidades_id]);         
        $add_siges_cidades_idh_siges_cidades = new TButton('add_siges_cidades_idh_siges_cidades');

        $action_siges_cidades_idh_siges_cidades = new TAction(array($this, 'onAddSigesCidadesIdhSigesCidades'));

        $add_siges_cidades_idh_siges_cidades->setAction($action_siges_cidades_idh_siges_cidades, "Adicionar");
        $add_siges_cidades_idh_siges_cidades->setImage('fas:plus #000000');

        $this->form->addFields([$add_siges_cidades_idh_siges_cidades]);

        $detailDatagrid = new TQuickGrid;
        $detailDatagrid->disableHtmlConversion();
        $this->siges_cidades_idh_siges_cidades_list = new BootstrapDatagridWrapper($detailDatagrid);
        $this->siges_cidades_idh_siges_cidades_list->style = 'width:100%';
        $this->siges_cidades_idh_siges_cidades_list->class .= ' table-bordered';
        $this->siges_cidades_idh_siges_cidades_list->disableDefaultClick();
        $this->siges_cidades_idh_siges_cidades_list->addQuickColumn('', 'edit', 'left', 50);
        $this->siges_cidades_idh_siges_cidades_list->addQuickColumn('', 'delete', 'left', 50);

        $column_siges_cidades_idh_siges_cidades_ano = $this->siges_cidades_idh_siges_cidades_list->addQuickColumn("Ano", 'siges_cidades_idh_siges_cidades_ano', 'left');
        $column_siges_cidades_idh_siges_cidades_idhm = $this->siges_cidades_idh_siges_cidades_list->addQuickColumn("Idhm", 'siges_cidades_idh_siges_cidades_idhm', 'left');
        $column_siges_cidades_idh_siges_cidades_idhm_renda = $this->siges_cidades_idh_siges_cidades_list->addQuickColumn("Idhm renda", 'siges_cidades_idh_siges_cidades_idhm_renda', 'left');
        $column_siges_cidades_idh_siges_cidades_idhm_long = $this->siges_cidades_idh_siges_cidades_list->addQuickColumn("Idhm long", 'siges_cidades_idh_siges_cidades_idhm_long', 'left');
        $column_siges_cidades_idh_siges_cidades_idhm_educacao = $this->siges_cidades_idh_siges_cidades_list->addQuickColumn("Idhm educacao", 'siges_cidades_idh_siges_cidades_idhm_educacao', 'left');

        $this->siges_cidades_idh_siges_cidades_list->createModel();
        $this->form->addContent([$this->siges_cidades_idh_siges_cidades_list]);

        $this->form->appendPage("Informações");
        $row11 = $this->form->addContent([new TFormSeparator("Outras Informações", '#333333', '18', '#eeeeee')]);
        $row12 = $this->form->addFields([new TLabel("Gentílico:", null, '14px', null)],[$gentilico]);
        $row13 = $this->form->addFields([new TLabel("Prefeito:", null, '14px', null)],[$prefeito]);
        $row14 = $this->form->addFields([new TLabel("População:", null, '14px', null)],[$populacao]);
        $row15 = $this->form->addFields([new TLabel("Área territorial:", null, '14px', null)],[$area_territorial]);
        $row16 = $this->form->addFields([new TLabel("PIB:", null, '14px', null)],[$pib]);

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        // $container->add(new TXMLBreadCrumb('menu.xml', __CLASS__));
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

            $object = new SigesCidades(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $siges_cidades_idh_siges_cidades_items = $this->storeItems('SigesCidadesIdh', 'siges_cidades_id', $object, 'siges_cidades_idh_siges_cidades', function($masterObject, $detailObject){ 

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

                $object = new SigesCidades($key); // instantiates the Active Record 

                $siges_cidades_idh_siges_cidades_items = $this->loadItems('SigesCidadesIdh', 'siges_cidades_id', $object, 'siges_cidades_idh_siges_cidades', function($masterObject, $detailObject, $objectItems){ 

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

        TSession::setValue('siges_cidades_idh_siges_cidades_items', null);

        $this->onReload();
    }

    public function onAddSigesCidadesIdhSigesCidades( $param )
    {
        try
        {
            $data = $this->form->getData();

            if(!$data->siges_cidades_idh_siges_cidades_ano)
            {
                throw new Exception(AdiantiCoreTranslator::translate('The field ^1 is required', "Ano"));
            }             

            $siges_cidades_idh_siges_cidades_items = TSession::getValue('siges_cidades_idh_siges_cidades_items');
            $key = isset($data->siges_cidades_idh_siges_cidades_id) && $data->siges_cidades_idh_siges_cidades_id ? $data->siges_cidades_idh_siges_cidades_id : uniqid();
            $fields = []; 

            $fields['siges_cidades_idh_siges_cidades_ano'] = $data->siges_cidades_idh_siges_cidades_ano;
            $fields['siges_cidades_idh_siges_cidades_idhm'] = $data->siges_cidades_idh_siges_cidades_idhm;
            $fields['siges_cidades_idh_siges_cidades_idhm_renda'] = $data->siges_cidades_idh_siges_cidades_idhm_renda;
            $fields['siges_cidades_idh_siges_cidades_idhm_long'] = $data->siges_cidades_idh_siges_cidades_idhm_long;
            $fields['siges_cidades_idh_siges_cidades_idhm_educacao'] = $data->siges_cidades_idh_siges_cidades_idhm_educacao;
            $siges_cidades_idh_siges_cidades_items[ $key ] = $fields;

            TSession::setValue('siges_cidades_idh_siges_cidades_items', $siges_cidades_idh_siges_cidades_items);

            $data->siges_cidades_idh_siges_cidades_id = '';
            $data->siges_cidades_idh_siges_cidades_ano = '';
            $data->siges_cidades_idh_siges_cidades_idhm = '';
            $data->siges_cidades_idh_siges_cidades_idhm_renda = '';
            $data->siges_cidades_idh_siges_cidades_idhm_long = '';
            $data->siges_cidades_idh_siges_cidades_idhm_educacao = '';

            $this->form->setData($data);

            $this->onReload( $param );
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());

            new TMessage('error', $e->getMessage());
        }
    }

    public function onEditSigesCidadesIdhSigesCidades( $param )
    {
        $data = $this->form->getData();

        // read session items
        $items = TSession::getValue('siges_cidades_idh_siges_cidades_items');

        // get the session item
        $item = $items[$param['siges_cidades_idh_siges_cidades_id_row_id']];

        $data->siges_cidades_idh_siges_cidades_ano = $item['siges_cidades_idh_siges_cidades_ano'];
        $data->siges_cidades_idh_siges_cidades_idhm = $item['siges_cidades_idh_siges_cidades_idhm'];
        $data->siges_cidades_idh_siges_cidades_idhm_renda = $item['siges_cidades_idh_siges_cidades_idhm_renda'];
        $data->siges_cidades_idh_siges_cidades_idhm_long = $item['siges_cidades_idh_siges_cidades_idhm_long'];
        $data->siges_cidades_idh_siges_cidades_idhm_educacao = $item['siges_cidades_idh_siges_cidades_idhm_educacao'];

        $data->siges_cidades_idh_siges_cidades_id = $param['siges_cidades_idh_siges_cidades_id_row_id'];

        // fill product fields
        $this->form->setData( $data );

        $this->onReload( $param );

    }

    public function onDeleteSigesCidadesIdhSigesCidades( $param )
    {
        $data = $this->form->getData();

        $data->siges_cidades_idh_siges_cidades_ano = '';
        $data->siges_cidades_idh_siges_cidades_idhm = '';
        $data->siges_cidades_idh_siges_cidades_idhm_renda = '';
        $data->siges_cidades_idh_siges_cidades_idhm_long = '';
        $data->siges_cidades_idh_siges_cidades_idhm_educacao = '';

        // clear form data
        $this->form->setData( $data );

        // read session items
        $items = TSession::getValue('siges_cidades_idh_siges_cidades_items');

        // delete the item from session
        unset($items[$param['siges_cidades_idh_siges_cidades_id_row_id']]);
        TSession::setValue('siges_cidades_idh_siges_cidades_items', $items);

        // reload sale items
        $this->onReload( $param );

    }

    public function onReloadSigesCidadesIdhSigesCidades( $param )
    {
        $items = TSession::getValue('siges_cidades_idh_siges_cidades_items'); 

        $this->siges_cidades_idh_siges_cidades_list->clear(); 

        if($items) 
        { 
            $cont = 1; 
            foreach ($items as $key => $item) 
            {
                $rowItem = new StdClass;

                $action_del = new TAction(array($this, 'onDeleteSigesCidadesIdhSigesCidades')); 
                $action_del->setParameter('siges_cidades_idh_siges_cidades_id_row_id', $key);
                $action_del->setParameter('row_data', base64_encode(serialize($item)));
                $action_del->setParameter('key', $key);

                $action_edi = new TAction(array($this, 'onEditSigesCidadesIdhSigesCidades'));  
                $action_edi->setParameter('siges_cidades_idh_siges_cidades_id_row_id', $key);  
                $action_edi->setParameter('row_data', base64_encode(serialize($item)));
                $action_edi->setParameter('key', $key);

                $button_del = new TButton('delete_siges_cidades_idh_siges_cidades'.$cont);
                $button_del->setAction($action_del, '');
                $button_del->setFormName($this->form->getName());
                $button_del->class = 'btn btn-link btn-sm';
                $button_del->title = "Excluir";
                $button_del->setImage('fas:trash-alt #dd5a43');

                $rowItem->delete = $button_del;

                $button_edi = new TButton('edit_siges_cidades_idh_siges_cidades'.$cont);
                $button_edi->setAction($action_edi, '');
                $button_edi->setFormName($this->form->getName());
                $button_edi->class = 'btn btn-link btn-sm';
                $button_edi->title = "Editar";
                $button_edi->setImage('far:edit #478fca');

                $rowItem->edit = $button_edi;

                $rowItem->siges_cidades_idh_siges_cidades_ano = isset($item['siges_cidades_idh_siges_cidades_ano']) ? $item['siges_cidades_idh_siges_cidades_ano'] : '';
                $rowItem->siges_cidades_idh_siges_cidades_idhm = isset($item['siges_cidades_idh_siges_cidades_idhm']) ? $item['siges_cidades_idh_siges_cidades_idhm'] : '';
                $rowItem->siges_cidades_idh_siges_cidades_idhm_renda = isset($item['siges_cidades_idh_siges_cidades_idhm_renda']) ? $item['siges_cidades_idh_siges_cidades_idhm_renda'] : '';
                $rowItem->siges_cidades_idh_siges_cidades_idhm_long = isset($item['siges_cidades_idh_siges_cidades_idhm_long']) ? $item['siges_cidades_idh_siges_cidades_idhm_long'] : '';
                $rowItem->siges_cidades_idh_siges_cidades_idhm_educacao = isset($item['siges_cidades_idh_siges_cidades_idhm_educacao']) ? $item['siges_cidades_idh_siges_cidades_idhm_educacao'] : '';

                $row = $this->siges_cidades_idh_siges_cidades_list->addItem($rowItem);

                $cont++;
            } 
        } 
    } 

    public function onShow($param = null)
    {

        TSession::setValue('siges_cidades_idh_siges_cidades_items', null);

        $this->onReload();

    } 

    public function onReload($params = null)
    {
        $this->loaded = TRUE;

        $this->onReloadSigesCidadesIdhSigesCidades($params);
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

