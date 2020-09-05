<?php

class SigesAtletasModalidadesChart extends TPage
{
    private $form; // form
    private $loaded;
    private static $database = 'siges';
    private static $activeRecord = 'SigesAtletasModalidades';
    private static $primaryKey = 'id';
    private static $formName = 'formChart_SigesAtletasModalidades';

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
        $this->form->setFormTitle("Modalidades");

        $siges_modalidades_id = new TDBCombo('siges_modalidades_id', 'siges', 'SigesModalidades', 'id', '{modalidade}','id asc'  );

        $siges_modalidades_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Modalidade:", null, '14px', null)],[$siges_modalidades_id]);

        // keep the form filled during navigation with session data
        $this->form->setData( TSession::getValue(__CLASS__.'_filter_data') );

        $btn_ongenerate = $this->form->addAction("Gerar", new TAction([$this, 'onGenerate']), 'fas:search #ffffff');
        $btn_ongenerate->addStyleClass('btn-primary'); 

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->add(TBreadCrumb::create(["Gráficos","Modalidades"]));
        $container->add($this->form);

        parent::add($container);

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

        if (isset($data->siges_modalidades_id) AND ( (is_scalar($data->siges_modalidades_id) AND $data->siges_modalidades_id !== '') OR (is_array($data->siges_modalidades_id) AND (!empty($data->siges_modalidades_id)) )) )
        {

            $filters[] = new TFilter('siges_modalidades_id', '=', $data->siges_modalidades_id);// create the filter 
        }

        // fill the form with data again
        $this->form->setData($data);

        // keep the search data in the session
        TSession::setValue(__CLASS__.'_filter_data', $data);
        TSession::setValue(__CLASS__.'_filters', $filters);
    }

    /**
     * Load the datagrid with data
     */
    public function onGenerate()
    {
        try
        {
            $this->onSearch();
            // open a transaction with database 'siges'
            TTransaction::open(self::$database);
            $param = [];
            // creates a repository for SigesAtletasModalidades
            $repository = new TRepository(self::$activeRecord);
            // creates a criteria
            $criteria = new TCriteria;

            if ($filters = TSession::getValue(__CLASS__.'_filters'))
            {
                foreach ($filters as $filter) 
                {
                    $criteria->add($filter);       
                }
            }

            // load the objects according to criteria
            $objects = $repository->load($criteria, FALSE);

            if ($objects)
            {

                $dataTotals = [];
                $groups = [];
                foreach ($objects as $obj)
                {
                    $group1 = $obj->siges_modalidades->modalidade;

                    $groups[$group1] = true;
                    $numericField = $obj->id;

                    $dataTotals[$group1]['count'] = isset($dataTotals[$group1]['count']) ? $dataTotals[$group1]['count'] + 1 : 1;
                    $dataTotals[$group1]['sum'] = isset($dataTotals[$group1]['sum']) ? $dataTotals[$group1]['sum'] + $numericField  : $numericField;

                }

                ksort($dataTotals);
                ksort($groups);

                $groups = ['x'=>true]+$groups;
                $data = [array_keys($groups)];
                $lineData = [_t('Value')];

                foreach ($dataTotals as $group1 => $totals) 
                {    

                    $lineData[] = $totals['count'];

                }
                $data[] = $lineData;

                $chart = new THtmlRenderer('app/resources/c3_bar_chart.html');
                $chart->enableSection('main', [
                    'data'=> json_encode($data),
                    'height' => 300,
                    'precision' => 2,
                    'decimalSeparator' => ',',
                    'thousandSeparator' => '.',
                    'prefix' => '',
                    'sufix' => '',
                    'width' => 70,
                    'widthType' => '%',
                    'title' => 'Modalidades por Atleta',
                    'showLegend' => 'false',
                    'showPercentage' => 'false',
                    'barDirection' => 'true'
                ]);

                parent::add($chart);
            }
            else
            {
                new TMessage('error', _t('No records found'));
            }

            // close the transaction
            TTransaction::close();
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

}

