<?php

class SigesPesquisasForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'siges';
    private static $activeRecord = 'SigesPesquisas';
    private static $primaryKey = 'id';
    private static $formName = 'form_SigesPesquisas';

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
        $this->form->setFormTitle("Cadastro de pesquisas");


        $id = new TEntry('id');
        $titulo = new TEntry('titulo');
        $subtitulo = new TEntry('subtitulo');
        $instrucoes = new THtmlEditor('instrucoes');
        $siges_alternativas_siges_pesquisas_valor_alternativa = new TEntry('siges_alternativas_siges_pesquisas_valor_alternativa');
        $siges_alternativas_siges_pesquisas_alternativa = new TEntry('siges_alternativas_siges_pesquisas_alternativa');
        $siges_questionarios_siges_pesquisas_questoes = new TEntry('siges_questionarios_siges_pesquisas_questoes');
        $siges_alternativas_siges_pesquisas_id = new THidden('siges_alternativas_siges_pesquisas_id');
        $siges_questionarios_siges_pesquisas_id = new THidden('siges_questionarios_siges_pesquisas_id');

        $titulo->addValidation("Título", new TRequiredValidator()); 

        $id->setEditable(false);
        $id->setSize(100);
        $titulo->setSize('100%');
        $subtitulo->setSize('100%');
        $instrucoes->setSize('100%', 250);
        $siges_alternativas_siges_pesquisas_alternativa->setSize(350);
        $siges_questionarios_siges_pesquisas_questoes->setSize('100%');
        $siges_alternativas_siges_pesquisas_valor_alternativa->setSize(60);

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null)],[$id]);
        $row2 = $this->form->addFields([new TLabel("Título:", null, '14px', null)],[$titulo]);
        $row3 = $this->form->addFields([new TLabel("Subtítulo:", null, '14px', null)],[$subtitulo]);
        $row4 = $this->form->addFields([new TLabel("Instruções:", null, '14px', null)],[$instrucoes]);
        $row5 = $this->form->addFields([new TFormSeparator("Definição de alternativas", '#333333', '18', '#eeeeee')]);
        $row5->layout = [' col-sm-12'];

        $row6 = $this->form->addFields([new TLabel("Opção / Alternativa:", null, '14px', null)],[$siges_alternativas_siges_pesquisas_valor_alternativa,$siges_alternativas_siges_pesquisas_alternativa]);
        $row7 = $this->form->addFields([$siges_alternativas_siges_pesquisas_id]);         
        $add_siges_alternativas_siges_pesquisas = new TButton('add_siges_alternativas_siges_pesquisas');

        $action_siges_alternativas_siges_pesquisas = new TAction(array($this, 'onAddSigesAlternativasSigesPesquisas'));

        $add_siges_alternativas_siges_pesquisas->setAction($action_siges_alternativas_siges_pesquisas, "Adicionar");
        $add_siges_alternativas_siges_pesquisas->setImage('fas:plus #000000');

        $this->form->addFields([$add_siges_alternativas_siges_pesquisas]);

        $detailDatagrid = new TQuickGrid;
        $detailDatagrid->disableHtmlConversion();
        $this->siges_alternativas_siges_pesquisas_list = new BootstrapDatagridWrapper($detailDatagrid);
        $this->siges_alternativas_siges_pesquisas_list->style = 'width:100%';
        $this->siges_alternativas_siges_pesquisas_list->class .= ' table-bordered';
        $this->siges_alternativas_siges_pesquisas_list->disableDefaultClick();
        $this->siges_alternativas_siges_pesquisas_list->addQuickColumn('', 'edit', 'left', 50);
        $this->siges_alternativas_siges_pesquisas_list->addQuickColumn('', 'delete', 'left', 50);

        $column_siges_alternativas_siges_pesquisas_valor_alternativa = $this->siges_alternativas_siges_pesquisas_list->addQuickColumn("Opção", 'siges_alternativas_siges_pesquisas_valor_alternativa', 'left' , '75px');
        $column_siges_alternativas_siges_pesquisas_alternativa = $this->siges_alternativas_siges_pesquisas_list->addQuickColumn("Alternativa", 'siges_alternativas_siges_pesquisas_alternativa', 'left');

        $this->siges_alternativas_siges_pesquisas_list->createModel();
        $this->form->addContent([$this->siges_alternativas_siges_pesquisas_list]);
        $row8 = $this->form->addFields([new TFormSeparator("Questões da pesquisa", '#333333', '18', '#eeeeee')]);
        $row8->layout = [' col-sm-12'];

        $row9 = $this->form->addFields([new TLabel("Questão:", null, '14px', null)],[$siges_questionarios_siges_pesquisas_questoes]);
        $row10 = $this->form->addFields([$siges_questionarios_siges_pesquisas_id]);         
        $add_siges_questionarios_siges_pesquisas = new TButton('add_siges_questionarios_siges_pesquisas');

        $action_siges_questionarios_siges_pesquisas = new TAction(array($this, 'onAddSigesQuestionariosSigesPesquisas'));

        $add_siges_questionarios_siges_pesquisas->setAction($action_siges_questionarios_siges_pesquisas, "Adicionar");
        $add_siges_questionarios_siges_pesquisas->setImage('fas:plus #000000');

        $this->form->addFields([$add_siges_questionarios_siges_pesquisas]);

        $detailDatagrid = new TQuickGrid;
        $detailDatagrid->disableHtmlConversion();
        $this->siges_questionarios_siges_pesquisas_list = new BootstrapDatagridWrapper($detailDatagrid);
        $this->siges_questionarios_siges_pesquisas_list->style = 'width:100%';
        $this->siges_questionarios_siges_pesquisas_list->class .= ' table-bordered';
        $this->siges_questionarios_siges_pesquisas_list->disableDefaultClick();
        $this->siges_questionarios_siges_pesquisas_list->addQuickColumn('', 'edit', 'left', 50);
        $this->siges_questionarios_siges_pesquisas_list->addQuickColumn('', 'delete', 'left', 50);

        $column_siges_questionarios_siges_pesquisas_questoes = $this->siges_questionarios_siges_pesquisas_list->addQuickColumn("Questões", 'siges_questionarios_siges_pesquisas_questoes', 'left');

        $this->siges_questionarios_siges_pesquisas_list->createModel();
        $this->form->addContent([$this->siges_questionarios_siges_pesquisas_list]);

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'far:save #ffffff');
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['SigesPesquisasList', 'onShow']), 'fa:chevron-circle-left #000000');

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

            $object = new SigesPesquisas(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $messageAction = new TAction(['SigesAtletaPesquisaList', 'onShow']);   

            $siges_questionarios_siges_pesquisas_items = $this->storeItems('SigesQuestionarios', 'siges_pesquisas_id', $object, 'siges_questionarios_siges_pesquisas', function($masterObject, $detailObject){ 

                //code here

            }); 

            $siges_alternativas_siges_pesquisas_items = $this->storeItems('SigesAlternativas', 'siges_pesquisas_id', $object, 'siges_alternativas_siges_pesquisas', function($masterObject, $detailObject){ 

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

                $object = new SigesPesquisas($key); // instantiates the Active Record 

                $siges_questionarios_siges_pesquisas_items = $this->loadItems('SigesQuestionarios', 'siges_pesquisas_id', $object, 'siges_questionarios_siges_pesquisas', function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }); 

                $siges_alternativas_siges_pesquisas_items = $this->loadItems('SigesAlternativas', 'siges_pesquisas_id', $object, 'siges_alternativas_siges_pesquisas', function($masterObject, $detailObject, $objectItems){ 

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

        TSession::setValue('siges_alternativas_siges_pesquisas_items', null);
        TSession::setValue('siges_questionarios_siges_pesquisas_items', null);

        $this->onReload();
    }

    public function onAddSigesAlternativasSigesPesquisas( $param )
    {
        try
        {
            $data = $this->form->getData();

            $siges_alternativas_siges_pesquisas_items = TSession::getValue('siges_alternativas_siges_pesquisas_items');
            $key = isset($data->siges_alternativas_siges_pesquisas_id) && $data->siges_alternativas_siges_pesquisas_id ? $data->siges_alternativas_siges_pesquisas_id : uniqid();
            $fields = []; 

            $fields['siges_alternativas_siges_pesquisas_valor_alternativa'] = $data->siges_alternativas_siges_pesquisas_valor_alternativa;
            $fields['siges_alternativas_siges_pesquisas_alternativa'] = $data->siges_alternativas_siges_pesquisas_alternativa;
            $siges_alternativas_siges_pesquisas_items[ $key ] = $fields;

            TSession::setValue('siges_alternativas_siges_pesquisas_items', $siges_alternativas_siges_pesquisas_items);

            $data->siges_alternativas_siges_pesquisas_id = '';
            $data->siges_alternativas_siges_pesquisas_valor_alternativa = '';
            $data->siges_alternativas_siges_pesquisas_alternativa = '';

            $this->form->setData($data);

            $this->onReload( $param );
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());

            new TMessage('error', $e->getMessage());
        }
    }

    public function onEditSigesAlternativasSigesPesquisas( $param )
    {
        $data = $this->form->getData();

        // read session items
        $items = TSession::getValue('siges_alternativas_siges_pesquisas_items');

        // get the session item
        $item = $items[$param['siges_alternativas_siges_pesquisas_id_row_id']];

        $data->siges_alternativas_siges_pesquisas_valor_alternativa = $item['siges_alternativas_siges_pesquisas_valor_alternativa'];
        $data->siges_alternativas_siges_pesquisas_alternativa = $item['siges_alternativas_siges_pesquisas_alternativa'];

        $data->siges_alternativas_siges_pesquisas_id = $param['siges_alternativas_siges_pesquisas_id_row_id'];

        // fill product fields
        $this->form->setData( $data );

        $this->onReload( $param );

    }

    public function onDeleteSigesAlternativasSigesPesquisas( $param )
    {
        $data = $this->form->getData();

        $data->siges_alternativas_siges_pesquisas_valor_alternativa = '';
        $data->siges_alternativas_siges_pesquisas_alternativa = '';

        // clear form data
        $this->form->setData( $data );

        // read session items
        $items = TSession::getValue('siges_alternativas_siges_pesquisas_items');

        // delete the item from session
        unset($items[$param['siges_alternativas_siges_pesquisas_id_row_id']]);
        TSession::setValue('siges_alternativas_siges_pesquisas_items', $items);

        // reload sale items
        $this->onReload( $param );

    }

    public function onReloadSigesAlternativasSigesPesquisas( $param )
    {
        $items = TSession::getValue('siges_alternativas_siges_pesquisas_items'); 

        $this->siges_alternativas_siges_pesquisas_list->clear(); 

        if($items) 
        { 
            $cont = 1; 
            foreach ($items as $key => $item) 
            {
                $rowItem = new StdClass;

                $action_del = new TAction(array($this, 'onDeleteSigesAlternativasSigesPesquisas')); 
                $action_del->setParameter('siges_alternativas_siges_pesquisas_id_row_id', $key);
                $action_del->setParameter('row_data', base64_encode(serialize($item)));
                $action_del->setParameter('key', $key);

                $action_edi = new TAction(array($this, 'onEditSigesAlternativasSigesPesquisas'));  
                $action_edi->setParameter('siges_alternativas_siges_pesquisas_id_row_id', $key);  
                $action_edi->setParameter('row_data', base64_encode(serialize($item)));
                $action_edi->setParameter('key', $key);

                $button_del = new TButton('delete_siges_alternativas_siges_pesquisas'.$cont);
                $button_del->setAction($action_del, '');
                $button_del->setFormName($this->form->getName());
                $button_del->class = 'btn btn-link btn-sm';
                $button_del->title = "Excluir";
                $button_del->setImage('far:trash-alt #dd5a43');

                $rowItem->delete = $button_del;

                $button_edi = new TButton('edit_siges_alternativas_siges_pesquisas'.$cont);
                $button_edi->setAction($action_edi, '');
                $button_edi->setFormName($this->form->getName());
                $button_edi->class = 'btn btn-link btn-sm';
                $button_edi->title = "Editar";
                $button_edi->setImage('far:edit #478fca');

                $rowItem->edit = $button_edi;

                $rowItem->siges_alternativas_siges_pesquisas_valor_alternativa = isset($item['siges_alternativas_siges_pesquisas_valor_alternativa']) ? $item['siges_alternativas_siges_pesquisas_valor_alternativa'] : '';
                $rowItem->siges_alternativas_siges_pesquisas_alternativa = isset($item['siges_alternativas_siges_pesquisas_alternativa']) ? $item['siges_alternativas_siges_pesquisas_alternativa'] : '';

                $row = $this->siges_alternativas_siges_pesquisas_list->addItem($rowItem);

                $cont++;
            } 
        } 
    } 

    public function onAddSigesQuestionariosSigesPesquisas( $param )
    {
        try
        {
            $data = $this->form->getData();

            $siges_questionarios_siges_pesquisas_items = TSession::getValue('siges_questionarios_siges_pesquisas_items');
            $key = isset($data->siges_questionarios_siges_pesquisas_id) && $data->siges_questionarios_siges_pesquisas_id ? $data->siges_questionarios_siges_pesquisas_id : uniqid();
            $fields = []; 

            $fields['siges_questionarios_siges_pesquisas_questoes'] = $data->siges_questionarios_siges_pesquisas_questoes;
            $siges_questionarios_siges_pesquisas_items[ $key ] = $fields;

            TSession::setValue('siges_questionarios_siges_pesquisas_items', $siges_questionarios_siges_pesquisas_items);

            $data->siges_questionarios_siges_pesquisas_id = '';
            $data->siges_questionarios_siges_pesquisas_questoes = '';

            $this->form->setData($data);

            $this->onReload( $param );
        }
        catch (Exception $e)
        {
            $this->form->setData( $this->form->getData());

            new TMessage('error', $e->getMessage());
        }
    }

    public function onEditSigesQuestionariosSigesPesquisas( $param )
    {
        $data = $this->form->getData();

        // read session items
        $items = TSession::getValue('siges_questionarios_siges_pesquisas_items');

        // get the session item
        $item = $items[$param['siges_questionarios_siges_pesquisas_id_row_id']];

        $data->siges_questionarios_siges_pesquisas_questoes = $item['siges_questionarios_siges_pesquisas_questoes'];

        $data->siges_questionarios_siges_pesquisas_id = $param['siges_questionarios_siges_pesquisas_id_row_id'];

        // fill product fields
        $this->form->setData( $data );

        $this->onReload( $param );

    }

    public function onDeleteSigesQuestionariosSigesPesquisas( $param )
    {
        $data = $this->form->getData();

        $data->siges_questionarios_siges_pesquisas_questoes = '';

        // clear form data
        $this->form->setData( $data );

        // read session items
        $items = TSession::getValue('siges_questionarios_siges_pesquisas_items');

        // delete the item from session
        unset($items[$param['siges_questionarios_siges_pesquisas_id_row_id']]);
        TSession::setValue('siges_questionarios_siges_pesquisas_items', $items);

        // reload sale items
        $this->onReload( $param );

    }

    public function onReloadSigesQuestionariosSigesPesquisas( $param )
    {
        $items = TSession::getValue('siges_questionarios_siges_pesquisas_items'); 

        $this->siges_questionarios_siges_pesquisas_list->clear(); 

        if($items) 
        { 
            $cont = 1; 
            foreach ($items as $key => $item) 
            {
                $rowItem = new StdClass;

                $action_del = new TAction(array($this, 'onDeleteSigesQuestionariosSigesPesquisas')); 
                $action_del->setParameter('siges_questionarios_siges_pesquisas_id_row_id', $key);
                $action_del->setParameter('row_data', base64_encode(serialize($item)));
                $action_del->setParameter('key', $key);

                $action_edi = new TAction(array($this, 'onEditSigesQuestionariosSigesPesquisas'));  
                $action_edi->setParameter('siges_questionarios_siges_pesquisas_id_row_id', $key);  
                $action_edi->setParameter('row_data', base64_encode(serialize($item)));
                $action_edi->setParameter('key', $key);

                $button_del = new TButton('delete_siges_questionarios_siges_pesquisas'.$cont);
                $button_del->setAction($action_del, '');
                $button_del->setFormName($this->form->getName());
                $button_del->class = 'btn btn-link btn-sm';
                $button_del->title = "Excluir";
                $button_del->setImage('far:trash-alt #dd5a43');

                $rowItem->delete = $button_del;

                $button_edi = new TButton('edit_siges_questionarios_siges_pesquisas'.$cont);
                $button_edi->setAction($action_edi, '');
                $button_edi->setFormName($this->form->getName());
                $button_edi->class = 'btn btn-link btn-sm';
                $button_edi->title = "Editar";
                $button_edi->setImage('far:edit #478fca');

                $rowItem->edit = $button_edi;

                $rowItem->siges_questionarios_siges_pesquisas_questoes = isset($item['siges_questionarios_siges_pesquisas_questoes']) ? $item['siges_questionarios_siges_pesquisas_questoes'] : '';

                $row = $this->siges_questionarios_siges_pesquisas_list->addItem($rowItem);

                $cont++;
            } 
        } 
    } 

    public function onShow($param = null)
    {

        TSession::setValue('siges_alternativas_siges_pesquisas_items', null);
        TSession::setValue('siges_questionarios_siges_pesquisas_items', null);

        $this->onReload();

    } 

    public function onReload($params = null)
    {
        $this->loaded = TRUE;

        $this->onReloadSigesAlternativasSigesPesquisas($params);
        $this->onReloadSigesQuestionariosSigesPesquisas($params);
    }

    public function show() 
    { 
        if (!$this->loaded AND (!isset($_GET['method']) OR $_GET['method'] !== 'onReload') ) 
        { 
            $this->onReload( func_get_arg(0) );
        }
        parent::show();
    }

}

