<?php

class SigesCidadesList extends TPage
{
    private $form; // form
    private $datagrid; // listing
    private $pageNavigation;
    private $loaded;
    private $filter_criteria;
    private static $database = 'siges';
    private static $activeRecord = 'SigesCidades';
    private static $primaryKey = 'id';
    private static $formName = 'formList_SigesCidades';
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
        $this->form->setFormTitle("Listagem de cidades");

        $municipio = new TEntry('municipio');
        $codigo_cidade = new TEntry('codigo_cidade');
        $siges_estados_id = new TDBCombo('siges_estados_id', 'siges', 'SigesEstados', 'id', '{estado}','estado asc'  );
        $siges_regioes_esportivas_id = new TDBCombo('siges_regioes_esportivas_id', 'siges', 'SigesRegioesEsportivas', 'id', '{regiao}','nr_regiao asc'  );

        $municipio->setMaxLength(40);
        $codigo_cidade->setMaxLength(7);

        $municipio->setSize('100%');
        $codigo_cidade->setSize('100%');
        $siges_estados_id->setSize('100%');
        $siges_regioes_esportivas_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Município:", null, '14px', null)],[$municipio],[new TLabel("Código IBGE:", null, '14px', null)],[$codigo_cidade]);
        $row2 = $this->form->addFields([new TLabel("Estado:", null, '14px', null)],[$siges_estados_id],[new TLabel("Região Esportiva:", null, '14px', null)],[$siges_regioes_esportivas_id]);

        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );

        $startHidden = true;

        if(TSession::getValue('SigesCidadesList_expand_start_hidden') === false)
        {
            $startHidden = false;
        }
        elseif(TSession::getValue('SigesCidadesList_expand_start_hidden') === true)
        {
            $startHidden = true; 
        }
        $expandButton = $this->form->addExpandButton("Expandir", 'fas:expand #000000', $startHidden);
        $expandButton->addStyleClass('btn-default');
        $expandButton->setAction(new TAction([$this, 'onExpandForm'], ['static'=>1]), "Expandir");
        $this->form->addField($expandButton);

        $btn_onsearch = $this->form->addAction("Buscar", new TAction([$this, 'onSearch']), 'fas:search #ffffff');
        $btn_onsearch->addStyleClass('btn-primary'); 

        $btn_onshow = $this->form->addHeaderAction("Cadastrar", new TAction(['SigesCidadesForm', 'onShow']), 'fas:plus #69aa46');

        // creates a Datagrid
        $this->datagrid = new TDataGrid;
        $this->datagrid->disableHtmlConversion();
        $this->datagrid = new BootstrapDatagridWrapper($this->datagrid);
        $this->filter_criteria = new TCriteria;

        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(320);

        $column_municipio = new TDataGridColumn('municipio', "Municipio", 'left');
        $column_siges_regioes_esportivas_nr_regiao_siges_regioes_esportivas_regiao = new TDataGridColumn('{siges_regioes_esportivas->nr_regiao} - {siges_regioes_esportivas->regiao}', "Região Esportiva", 'left' , '300px');
        $column_codigo_cidade = new TDataGridColumn('codigo_cidade', "Código IBGE", 'left' , '120px');
        $column_siges_estados_sigla = new TDataGridColumn('siges_estados->sigla', "UF", 'center' , '100px');
        $column_active_transformed = new TDataGridColumn('active', "Ativo", 'center' , '100px');

        $column_active_transformed->setTransformer(function($value, $object, $row) 
        {
            if($value === true || $value == 't' || $value === 1 || $value == '1' || $value == 's' || $value == 'S' || $value == 'T')
                return 'Sim';

            return 'Não';

        });        

        $this->datagrid->addColumn($column_municipio);
        $this->datagrid->addColumn($column_siges_regioes_esportivas_nr_regiao_siges_regioes_esportivas_regiao);
        $this->datagrid->addColumn($column_codigo_cidade);
        $this->datagrid->addColumn($column_siges_estados_sigla);
        $this->datagrid->addColumn($column_active_transformed);

        $action_onEdit = new TDataGridAction(array('SigesCidadesForm', 'onEdit'));
        $action_onEdit->setUseButton(false);
        $action_onEdit->setButtonClass('btn btn-default btn-sm');
        $action_onEdit->setLabel("Editar");
        $action_onEdit->setImage('far:edit #478fca');
        $action_onEdit->setField(self::$primaryKey);

        $this->datagrid->addAction($action_onEdit);

        $action_onDelete = new TDataGridAction(array('SigesCidadesList', 'onDelete'));
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
        $container->add(TBreadCrumb::create(["Cadastro","Cidades"]));
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
                $object = new SigesCidades($key, FALSE); 

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

        if (isset($data->municipio) AND ( (is_scalar($data->municipio) AND $data->municipio !== '') OR (is_array($data->municipio) AND (!empty($data->municipio)) )) )
        {

            $filters[] = new TFilter('municipio', 'like', "%{$data->municipio}%");// create the filter 
        }

        if (isset($data->codigo_cidade) AND ( (is_scalar($data->codigo_cidade) AND $data->codigo_cidade !== '') OR (is_array($data->codigo_cidade) AND (!empty($data->codigo_cidade)) )) )
        {

            $filters[] = new TFilter('codigo_cidade', 'like', "%{$data->codigo_cidade}%");// create the filter 
        }

        if (isset($data->siges_estados_id) AND ( (is_scalar($data->siges_estados_id) AND $data->siges_estados_id !== '') OR (is_array($data->siges_estados_id) AND (!empty($data->siges_estados_id)) )) )
        {

            $filters[] = new TFilter('siges_estados_id', '=', $data->siges_estados_id);// create the filter 
        }

        if (isset($data->siges_regioes_esportivas_id) AND ( (is_scalar($data->siges_regioes_esportivas_id) AND $data->siges_regioes_esportivas_id !== '') OR (is_array($data->siges_regioes_esportivas_id) AND (!empty($data->siges_regioes_esportivas_id)) )) )
        {

            $filters[] = new TFilter('siges_regioes_esportivas_id', '=', $data->siges_regioes_esportivas_id);// create the filter 
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

            // creates a repository for SigesCidades
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

            if(TSession::getValue('SigesCidadesList_expand_start_hidden') === false)
            {
                TSession::setValue('SigesCidadesList_expand_start_hidden', true);
            }
            elseif(TSession::getValue('SigesCidadesList_expand_start_hidden') === true)
            {
                TSession::setValue('SigesCidadesList_expand_start_hidden', false);
            }
            else
            {
                TSession::setValue('SigesCidadesList_expand_start_hidden', !$startHidden);
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

