<?php

class SigesInstituicaoList extends TPage
{
    private $form; // form
    private $datagrid; // listing
    private $pageNavigation;
    private $loaded;
    private $filter_criteria;
    private static $database = 'siges';
    private static $activeRecord = 'SigesInstituicao';
    private static $primaryKey = 'id';
    private static $formName = 'formList_SigesInstituicao';
    private $showMethods = ['onReload', 'onSearch'];

    /**
     * Class constructor
     * Creates the page, the form and the listing
     */
    public function __construct()
    {
        parent::__construct();
        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);

        // define the form title
        $this->form->setFormTitle("Listagem de instituições");

        $codigo_instituicao = new TEntry('codigo_instituicao');
        $cnpj = new TEntry('cnpj');
        $instituicao_ensino = new TEntry('instituicao_ensino');
        $siges_tipos_instituicao_id = new TDBCombo('siges_tipos_instituicao_id', 'siges', 'SigesTiposInstituicao', 'id', '{tipo_instituicao}','id asc'  );
        $siges_cidades_id = new TDBUniqueSearch('siges_cidades_id', 'siges', 'SigesCidades', 'id', 'municipio','municipio asc'  );

        $siges_cidades_id->setMinLength(2);
        $siges_cidades_id->setMask('{municipio} - {siges_estados->sigla} ');

        $cnpj->setMaxLength(31);
        $codigo_instituicao->setMaxLength(15);
        $instituicao_ensino->setMaxLength(255);

        $cnpj->setSize('100%');
        $siges_cidades_id->setSize('100%');
        $codigo_instituicao->setSize('100%');
        $instituicao_ensino->setSize('100%');
        $siges_tipos_instituicao_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Código instituição:", null, '14px', null)],[$codigo_instituicao],[new TLabel("Cnpj:", null, '14px', null)],[$cnpj]);
        $row2 = $this->form->addFields([new TLabel("Instituição:", null, '14px', null)],[$instituicao_ensino],[new TLabel("Tipos instituição:", null, '14px', null)],[$siges_tipos_instituicao_id]);
        $row3 = $this->form->addFields([new TLabel("Cidade:", null, '14px', null)],[$siges_cidades_id]);

        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );

        $startHidden = true;

        if(TSession::getValue('SigesInstituicaoList_expand_start_hidden') === false)
        {
            $startHidden = false;
        }
        elseif(TSession::getValue('SigesInstituicaoList_expand_start_hidden') === true)
        {
            $startHidden = true; 
        }
        $expandButton = $this->form->addExpandButton("Expandir", 'fas:expand #000000', $startHidden);
        $expandButton->addStyleClass('btn-default');
        $expandButton->setAction(new TAction([$this, 'onExpandForm'], ['static'=>1]), "Expandir");
        $this->form->addField($expandButton);

        $btn_onsearch = $this->form->addAction("Buscar", new TAction([$this, 'onSearch']), 'fas:search #ffffff');
        $btn_onsearch->addStyleClass('btn-primary'); 

        $btn_onshow = $this->form->addHeaderAction("Cadastrar", new TAction(['SigesInstituicaoForm', 'onShow']), 'fas:plus #69aa46');

        // creates a Datagrid
        $this->datagrid = new TDataGrid;
        $this->datagrid->disableHtmlConversion();
        $this->datagrid = new BootstrapDatagridWrapper($this->datagrid);
        $this->filter_criteria = new TCriteria;

        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(320);

        $column_codigo_instituicao = new TDataGridColumn('codigo_instituicao', "Código", 'left' , '120px');
        $column_instituicao_ensino = new TDataGridColumn('instituicao_ensino', "Instituição ensino", 'left');
        $column_cnpj = new TDataGridColumn('cnpj', "Cnpj", 'left' , '230px');
        $column_siges_cidades_municipio = new TDataGridColumn('siges_cidades->municipio', "Cidade", 'left' , '300px');
        $column_siges_tipos_instituicao_tipo_instituicao = new TDataGridColumn('siges_tipos_instituicao->tipo_instituicao', "Tipo", 'left' , '170px');
        $column_status = new TDataGridColumn('status', "Status", 'left' , '100px');

        $this->datagrid->addColumn($column_codigo_instituicao);
        $this->datagrid->addColumn($column_instituicao_ensino);
        $this->datagrid->addColumn($column_cnpj);
        $this->datagrid->addColumn($column_siges_cidades_municipio);
        $this->datagrid->addColumn($column_siges_tipos_instituicao_tipo_instituicao);
        $this->datagrid->addColumn($column_status);

        $action_onEdit = new TDataGridAction(array('SigesInstituicaoForm', 'onEdit'));
        $action_onEdit->setUseButton(false);
        $action_onEdit->setButtonClass('btn btn-default btn-sm');
        $action_onEdit->setLabel("Editar");
        $action_onEdit->setImage('far:edit #478fca');
        $action_onEdit->setField(self::$primaryKey);

        $this->datagrid->addAction($action_onEdit);

        $action_onDelete = new TDataGridAction(array('SigesInstituicaoList', 'onDelete'));
        $action_onDelete->setUseButton(false);
        $action_onDelete->setButtonClass('btn btn-default btn-sm');
        $action_onDelete->setLabel("Excluir");
        $action_onDelete->setImage('fas:trash-alt #dd5a43');
        $action_onDelete->setField(self::$primaryKey);

        $this->datagrid->addAction($action_onDelete);

        // create the datagrid model
        $this->datagrid->createModel();

        // creates the page navigation
        $this->pageNavigation = new TPageNavigation;
        $this->pageNavigation->enableCounters();
        $this->pageNavigation->setAction(new TAction(array($this, 'onReload')));
        $this->pageNavigation->setWidth($this->datagrid->getWidth());

        $panel = new TPanelGroup;
        $panel->add($this->datagrid);

        $panel->addFooter($this->pageNavigation);

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->add(TBreadCrumb::create(["Cadastro","Instituições"]));
        $container->add($this->form);
        $container->add($panel);

        parent::add($container);

    }

    public function onDelete($param = null) 
    { 
        if(isset($param['delete']) && $param['delete'] == 1)
        {
            try
            {
                // get the paramseter $key
                $key = $param['key'];
                // open a transaction with database
                TTransaction::open(self::$database);

                // instantiates object
                $object = new SigesInstituicao($key, FALSE); 

                // deletes the object from the database
                $object->delete();

                // close the transaction
                TTransaction::close();

                // reload the listing
                $this->onReload( $param );
                // shows the success message
                new TMessage('info', AdiantiCoreTranslator::translate('Record deleted'));
            }
            catch (Exception $e) // in case of exception
            {
                // shows the exception error message
                new TMessage('error', $e->getMessage());
                // undo all pending operations
                TTransaction::rollback();
            }
        }
        else
        {
            // define the delete action
            $action = new TAction(array($this, 'onDelete'));
            $action->setParameters($param); // pass the key paramseter ahead
            $action->setParameter('delete', 1);
            // shows a dialog to the user
            new TQuestion(AdiantiCoreTranslator::translate('Do you really want to delete ?'), $action);   
        }
    }

    /**
     * Register the filter in the session
     */
    public function onSearch()
    {
        // get the search form data
        $data = $this->form->getData();
        $filters = [];

        TSession::setValue(__CLASS__.'_filter_data', NULL);
        TSession::setValue(__CLASS__.'_filters', NULL);

        if (isset($data->codigo_instituicao) AND ( (is_scalar($data->codigo_instituicao) AND $data->codigo_instituicao !== '') OR (is_array($data->codigo_instituicao) AND (!empty($data->codigo_instituicao)) )) )
        {

            $filters[] = new TFilter('codigo_instituicao', 'like', "%{$data->codigo_instituicao}%");// create the filter 
        }

        if (isset($data->cnpj) AND ( (is_scalar($data->cnpj) AND $data->cnpj !== '') OR (is_array($data->cnpj) AND (!empty($data->cnpj)) )) )
        {

            $filters[] = new TFilter('cnpj', 'like', "%{$data->cnpj}%");// create the filter 
        }

        if (isset($data->instituicao_ensino) AND ( (is_scalar($data->instituicao_ensino) AND $data->instituicao_ensino !== '') OR (is_array($data->instituicao_ensino) AND (!empty($data->instituicao_ensino)) )) )
        {

            $filters[] = new TFilter('instituicao_ensino', 'like', "%{$data->instituicao_ensino}%");// create the filter 
        }

        if (isset($data->siges_tipos_instituicao_id) AND ( (is_scalar($data->siges_tipos_instituicao_id) AND $data->siges_tipos_instituicao_id !== '') OR (is_array($data->siges_tipos_instituicao_id) AND (!empty($data->siges_tipos_instituicao_id)) )) )
        {

            $filters[] = new TFilter('siges_tipos_instituicao_id', '=', $data->siges_tipos_instituicao_id);// create the filter 
        }

        if (isset($data->siges_cidades_id) AND ( (is_scalar($data->siges_cidades_id) AND $data->siges_cidades_id !== '') OR (is_array($data->siges_cidades_id) AND (!empty($data->siges_cidades_id)) )) )
        {

            $filters[] = new TFilter('siges_cidades_id', '=', $data->siges_cidades_id);// create the filter 
        }

        $param = array();
        $param['offset']     = 0;
        $param['first_page'] = 1;

        // fill the form with data again
        $this->form->setData($data);

        // keep the search data in the session
        TSession::setValue(__CLASS__.'_filter_data', $data);
        TSession::setValue(__CLASS__.'_filters', $filters);

        $this->onReload($param);
    }

    /**
     * Load the datagrid with data
     */
    public function onReload($param = NULL)
    {
        try
        {
            // open a transaction with database 'siges'
            TTransaction::open(self::$database);

            // creates a repository for SigesInstituicao
            $repository = new TRepository(self::$activeRecord);
            $limit = 20;

            $criteria = clone $this->filter_criteria;

            if (empty($param['order']))
            {
                $param['order'] = 'id';    
            }

            if (empty($param['direction']))
            {
                $param['direction'] = 'desc';
            }

            $criteria->setProperties($param); // order, offset
            $criteria->setProperty('limit', $limit);

            if($filters = TSession::getValue(__CLASS__.'_filters'))
            {
                foreach ($filters as $filter) 
                {
                    $criteria->add($filter);       
                }
            }

            // load the objects according to criteria
            $objects = $repository->load($criteria, FALSE);

            $this->datagrid->clear();
            if ($objects)
            {
                // iterate the collection of active records
                foreach ($objects as $object)
                {
                    // add the object inside the datagrid

                    $this->datagrid->addItem($object);

                }
            }

            // reset the criteria for record count
            $criteria->resetProperties();
            $count= $repository->count($criteria);

            $this->pageNavigation->setCount($count); // count of records
            $this->pageNavigation->setProperties($param); // order, page
            $this->pageNavigation->setLimit($limit); // limit

            // close the transaction
            TTransaction::close();
            $this->loaded = true;
        }
        catch (Exception $e) // in case of exception
        {
            // shows the exception error message
            new TMessage('error', $e->getMessage());
            // undo all pending operations
            TTransaction::rollback();
        }
    }

    public static function onExpandForm($param = null)
    {
        try
        {
            $startHidden = true;

            if(TSession::getValue('SigesInstituicaoList_expand_start_hidden') === false)
            {
                TSession::setValue('SigesInstituicaoList_expand_start_hidden', true);
            }
            elseif(TSession::getValue('SigesInstituicaoList_expand_start_hidden') === true)
            {
                TSession::setValue('SigesInstituicaoList_expand_start_hidden', false);
            }
            else
            {
                TSession::setValue('SigesInstituicaoList_expand_start_hidden', !$startHidden);
            }

        }
        catch(Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }

    public function onShow($param = null)
    {

    }

    /**
     * method show()
     * Shows the page
     */
    public function show()
    {
        // check if the datagrid is already loaded
        if (!$this->loaded AND (!isset($_GET['method']) OR !(in_array($_GET['method'],  $this->showMethods))) )
        {
            if (func_num_args() > 0)
            {
                $this->onReload( func_get_arg(0) );
            }
            else
            {
                $this->onReload();
            }
        }
        parent::show();
    }

}

