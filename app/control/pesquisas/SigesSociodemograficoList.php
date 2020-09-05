<?php

class SigesSociodemograficoList extends TPage
{
    private $form; // form
    private $datagrid; // listing
    private $pageNavigation;
    private $loaded;
    private $filter_criteria;
    private static $database = 'siges';
    private static $activeRecord = 'SigesSociodemografico';
    private static $primaryKey = 'id';
    private static $formName = 'formList_SigesSociodemografico';
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
        $this->form->setFormTitle("Listagem de sociodemográfico");

        $system_users_id = new TDBCombo('system_users_id', 'siges', 'SystemUsers', 'id', '{name}','name asc'  );
        $siges_tipos_instituicao_id = new TDBCombo('siges_tipos_instituicao_id', 'siges', 'SigesTiposInstituicao', 'id', '{id}','id asc'  );
        $siges_zona_municipio_id = new TDBCombo('siges_zona_municipio_id', 'siges', 'SigesZonaMunicipio', 'id', '{id}','id asc'  );
        $siges_raca_id = new TDBCombo('siges_raca_id', 'siges', 'SigesRaca', 'id', '{id}','id asc'  );
        $siges_serie_escolar_id = new TDBCombo('siges_serie_escolar_id', 'siges', 'SigesSerieEscolar', 'id', '{id}','id asc'  );

        $siges_raca_id->setSize('100%');
        $system_users_id->setSize('100%');
        $siges_serie_escolar_id->setSize('100%');
        $siges_zona_municipio_id->setSize('100%');
        $siges_tipos_instituicao_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("System users id:", null, '14px', null)],[$system_users_id]);
        $row2 = $this->form->addFields([new TLabel("Siges tipos instituicao id:", null, '14px', null)],[$siges_tipos_instituicao_id]);
        $row3 = $this->form->addFields([new TLabel("Siges zona municipio id:", null, '14px', null)],[$siges_zona_municipio_id]);
        $row4 = $this->form->addFields([new TLabel("Siges raca id:", null, '14px', null)],[$siges_raca_id]);
        $row5 = $this->form->addFields([new TLabel("Siges serie escolar id:", null, '14px', null)],[$siges_serie_escolar_id]);

        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );

        $btn_onsearch = $this->form->addAction("Buscar", new TAction([$this, 'onSearch']), 'fas:search #ffffff');
        $btn_onsearch->addStyleClass('btn-primary'); 

        $btn_onshow = $this->form->addHeaderAction("Cadastrar", new TAction(['SigesSociodemograficoForm', 'onShow']), 'fas:plus #69aa46');

        // creates a Datagrid
        $this->datagrid = new TDataGrid;
        $this->datagrid->disableHtmlConversion();
        $this->datagrid = new BootstrapDatagridWrapper($this->datagrid);
        $this->filter_criteria = new TCriteria;

        $this->datagrid->style = 'width: 100%';
        $this->datagrid->setHeight(320);

        $column_id = new TDataGridColumn('id', "Id", 'center' , '70px');
        $column_system_users_name = new TDataGridColumn('system_users->name', "System users id", 'left');
        $column_siges_tipos_instituicao_id = new TDataGridColumn('siges_tipos_instituicao_id', "Siges tipos instituicao id", 'left');
        $column_siges_zona_municipio_id = new TDataGridColumn('siges_zona_municipio_id', "Siges zona municipio id", 'left');
        $column_siges_raca_id = new TDataGridColumn('siges_raca_id', "Siges raca id", 'left');
        $column_siges_serie_escolar_id = new TDataGridColumn('siges_serie_escolar_id', "Siges serie escolar id", 'left');
        $column_siges_tipo_moradia_id = new TDataGridColumn('siges_tipo_moradia_id', "Siges tipo moradia id", 'left');
        $column_pessoas_residencia = new TDataGridColumn('pessoas_residencia', "Pessoas residencia", 'left');
        $column_siges_moradores_casa_id = new TDataGridColumn('siges_moradores_casa_id', "Siges moradores casa id", 'left');
        $column_siges_nivel_escolariade_mae_id = new TDataGridColumn('siges_nivel_escolariade_mae_id', "Siges nivel escolariade mae id", 'left');
        $column_siges_nivel_escolariade_pai_id = new TDataGridColumn('siges_nivel_escolariade_pai_id', "Siges nivel escolariade pai id", 'left');
        $column_siges_responsaveis_competicoes_id = new TDataGridColumn('siges_responsaveis_competicoes_id', "Siges responsaveis competicoes id", 'left');
        $column_participa_aula_ef = new TDataGridColumn('participa_aula_ef', "Participa aula ef", 'left');
        $column_participa_aula_ef_sim = new TDataGridColumn('participa_aula_ef_sim', "Participa aula ef sim", 'left');
        $column_participa_aula_ef_nao = new TDataGridColumn('participa_aula_ef_nao', "Participa aula ef nao", 'left');
        $column_participa_outras_atividades = new TDataGridColumn('participa_outras_atividades', "Participa outras atividades", 'left');
        $column_participa_outras_atividades_sim = new TDataGridColumn('participa_outras_atividades_sim', "Participa outras atividades sim", 'left');
        $column_siges_tempo_competicoes_id = new TDataGridColumn('siges_tempo_competicoes_id', "Siges tempo competicoes id", 'left');
        $column_treina_outra_modalidade = new TDataGridColumn('treina_outra_modalidade', "Treina outra modalidade", 'left');
        $column_treina_outra_modalidade_qual = new TDataGridColumn('treina_outra_modalidade_qual', "Treina outra modalidade qual", 'left');
        $column_treina_outra_modalidade_quantidade = new TDataGridColumn('treina_outra_modalidade_quantidade', "Treina outra modalidade quantidade", 'left');
        $column_treina_outra_modalidade_duracao = new TDataGridColumn('treina_outra_modalidade_duracao', "Treina outra modalidade duracao", 'left');
        $column_siges_participa_outras_competicoes_id = new TDataGridColumn('siges_participa_outras_competicoes_id', "Siges participa outras competicoes id", 'left');
        $column_siges_apoio_bolsa_id = new TDataGridColumn('siges_apoio_bolsa_id', "Siges apoio bolsa id", 'left');
        $column_participacao_outros = new TDataGridColumn('participacao_outros', "Participacao outros", 'left');
        $column_siges_espaco_treino_id = new TDataGridColumn('siges_espaco_treino_id', "Siges espaco treino id", 'left');
        $column_siges_espaco_treino_outros = new TDataGridColumn('siges_espaco_treino_outros', "Siges espaco treino outros", 'left');
        $column_siges_momento_treino_id = new TDataGridColumn('siges_momento_treino_id', "Siges momento treino id", 'left');
        $column_siges_dificuldades_id = new TDataGridColumn('siges_dificuldades_id', "Siges dificuldades id", 'left');
        $column_siges_dificuldades_outros = new TDataGridColumn('siges_dificuldades_outros', "Siges dificuldades outros", 'left');
        $column_siges_espaco_treino_comunidade_id = new TDataGridColumn('siges_espaco_treino_comunidade_id', "Siges espaco treino comunidade id", 'left');
        $column_siges_espaco_treino_comunidade_outros = new TDataGridColumn('siges_espaco_treino_comunidade_outros', "Siges espaco treino comunidade outros", 'left');
        $column_siges_apoio_responsavel_id = new TDataGridColumn('siges_apoio_responsavel_id', "Siges apoio responsavel id", 'left');

        $order_id = new TAction(array($this, 'onReload'));
        $order_id->setParameter('order', 'id');
        $column_id->setAction($order_id);

        $this->datagrid->addColumn($column_id);
        $this->datagrid->addColumn($column_system_users_name);
        $this->datagrid->addColumn($column_siges_tipos_instituicao_id);
        $this->datagrid->addColumn($column_siges_zona_municipio_id);
        $this->datagrid->addColumn($column_siges_raca_id);
        $this->datagrid->addColumn($column_siges_serie_escolar_id);
        $this->datagrid->addColumn($column_siges_tipo_moradia_id);
        $this->datagrid->addColumn($column_pessoas_residencia);
        $this->datagrid->addColumn($column_siges_moradores_casa_id);
        $this->datagrid->addColumn($column_siges_nivel_escolariade_mae_id);
        $this->datagrid->addColumn($column_siges_nivel_escolariade_pai_id);
        $this->datagrid->addColumn($column_siges_responsaveis_competicoes_id);
        $this->datagrid->addColumn($column_participa_aula_ef);
        $this->datagrid->addColumn($column_participa_aula_ef_sim);
        $this->datagrid->addColumn($column_participa_aula_ef_nao);
        $this->datagrid->addColumn($column_participa_outras_atividades);
        $this->datagrid->addColumn($column_participa_outras_atividades_sim);
        $this->datagrid->addColumn($column_siges_tempo_competicoes_id);
        $this->datagrid->addColumn($column_treina_outra_modalidade);
        $this->datagrid->addColumn($column_treina_outra_modalidade_qual);
        $this->datagrid->addColumn($column_treina_outra_modalidade_quantidade);
        $this->datagrid->addColumn($column_treina_outra_modalidade_duracao);
        $this->datagrid->addColumn($column_siges_participa_outras_competicoes_id);
        $this->datagrid->addColumn($column_siges_apoio_bolsa_id);
        $this->datagrid->addColumn($column_participacao_outros);
        $this->datagrid->addColumn($column_siges_espaco_treino_id);
        $this->datagrid->addColumn($column_siges_espaco_treino_outros);
        $this->datagrid->addColumn($column_siges_momento_treino_id);
        $this->datagrid->addColumn($column_siges_dificuldades_id);
        $this->datagrid->addColumn($column_siges_dificuldades_outros);
        $this->datagrid->addColumn($column_siges_espaco_treino_comunidade_id);
        $this->datagrid->addColumn($column_siges_espaco_treino_comunidade_outros);
        $this->datagrid->addColumn($column_siges_apoio_responsavel_id);

        $action_onEdit = new TDataGridAction(array('SigesSociodemograficoForm', 'onEdit'));
        $action_onEdit->setUseButton(false);
        $action_onEdit->setButtonClass('btn btn-default btn-sm');
        $action_onEdit->setLabel("Editar");
        $action_onEdit->setImage('far:edit #478fca');
        $action_onEdit->setField(self::$primaryKey);

        $this->datagrid->addAction($action_onEdit);

        $action_onDelete = new TDataGridAction(array('SigesSociodemograficoList', 'onDelete'));
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
        $container->add(TBreadCrumb::create(["Pesquisas","Sociodemográfico"]));
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
                $object = new SigesSociodemografico($key, FALSE); 

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

        if (isset($data->system_users_id) AND ( (is_scalar($data->system_users_id) AND $data->system_users_id !== '') OR (is_array($data->system_users_id) AND (!empty($data->system_users_id)) )) )
        {

            $filters[] = new TFilter('system_users_id', '=', $data->system_users_id);// create the filter 
        }

        if (isset($data->siges_tipos_instituicao_id) AND ( (is_scalar($data->siges_tipos_instituicao_id) AND $data->siges_tipos_instituicao_id !== '') OR (is_array($data->siges_tipos_instituicao_id) AND (!empty($data->siges_tipos_instituicao_id)) )) )
        {

            $filters[] = new TFilter('siges_tipos_instituicao_id', '=', $data->siges_tipos_instituicao_id);// create the filter 
        }

        if (isset($data->siges_zona_municipio_id) AND ( (is_scalar($data->siges_zona_municipio_id) AND $data->siges_zona_municipio_id !== '') OR (is_array($data->siges_zona_municipio_id) AND (!empty($data->siges_zona_municipio_id)) )) )
        {

            $filters[] = new TFilter('siges_zona_municipio_id', '=', $data->siges_zona_municipio_id);// create the filter 
        }

        if (isset($data->siges_raca_id) AND ( (is_scalar($data->siges_raca_id) AND $data->siges_raca_id !== '') OR (is_array($data->siges_raca_id) AND (!empty($data->siges_raca_id)) )) )
        {

            $filters[] = new TFilter('siges_raca_id', '=', $data->siges_raca_id);// create the filter 
        }

        if (isset($data->siges_serie_escolar_id) AND ( (is_scalar($data->siges_serie_escolar_id) AND $data->siges_serie_escolar_id !== '') OR (is_array($data->siges_serie_escolar_id) AND (!empty($data->siges_serie_escolar_id)) )) )
        {

            $filters[] = new TFilter('siges_serie_escolar_id', '=', $data->siges_serie_escolar_id);// create the filter 
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

            // creates a repository for SigesSociodemografico
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

