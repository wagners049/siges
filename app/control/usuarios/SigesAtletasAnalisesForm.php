<?php

class SigesAtletasAnalisesForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'siges';
    private static $activeRecord = 'SigesAtletasAnalises';
    private static $primaryKey = 'id';
    private static $formName = 'form_SigesAtletasAnalises';

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
        $this->form->setFormTitle("Cadastro de análise do atleta");

        $criteria_system_users_id = new TCriteria();

        $criteria_system_users_id->setProperty('order', 'name asc');

        $id = new TEntry('id');
        $status_cadastro = new TRadioGroup('status_cadastro');
        $system_users_id = new TDBSeekButton('system_users_id', 'siges', self::$formName, 'SystemUsers', 'name', 'system_users_id', 'system_users_id_display', $criteria_system_users_id);
        $system_users_id_display = new TEntry('system_users_id_display');
        $data_analise = new TDate('data_analise');
        $treino_semana = new TNumeric('treino_semana', '0', ',', '.' );
        $duracao_treino = new TNumeric('duracao_treino', '0', ',', '.' );
        $siges_categoria_idade_id = new TDBRadioGroup('siges_categoria_idade_id', 'siges', 'SigesCategoriaIdade', 'id', '{tipo} - {descricao} ','id asc'  );
        $ano_inicio = new TDate('ano_inicio');
        $observacoes = new THtmlEditor('observacoes');
        $treino_avaliacao = new TRadioGroup('treino_avaliacao');
        $treino_avaliacao_quais = new TEntry('treino_avaliacao_quais');
        $problema_saude = new TRadioGroup('problema_saude');
        $problema_saude_quais = new TEntry('problema_saude_quais');
        $afastado_treino = new TRadioGroup('afastado_treino');
        $afastado_treino_lesao = new TEntry('afastado_treino_lesao');
        $afastado_treino_tempo = new TEntry('afastado_treino_tempo');
        $presenciou_trote = new TRadioGroup('presenciou_trote');
        $presenciou_trotes_quais = new TEntry('presenciou_trotes_quais');
        $menarca = new TRadioGroup('menarca');
        $menarca_data = new TDate('menarca_data');
        $menarca_idade = new TEntry('menarca_idade');
        $ultimo_jogo = new TRadioGroup('ultimo_jogo');
        $ultimo_jogo_jogou = new TRadioGroup('ultimo_jogo_jogou');
        $ultimo_jogo_tempo = new TRadioGroup('ultimo_jogo_tempo');

        $status_cadastro->addValidation("Status", new TRequiredValidator()); 
        $system_users_id->addValidation("Atleta", new TRequiredValidator()); 
        $data_analise->addValidation("Data da Análise", new TRequiredValidator()); 

        $status_cadastro->setValue('2');
        $status_cadastro->setUseButton();
        $system_users_id->setDisplayMask('{name}');
        $system_users_id->setAuxiliar($system_users_id_display);
        $menarca_idade->setMaxLength(255);

        $id->setEditable(false);
        $system_users_id_display->setEditable(false);

        $ano_inicio->setMask('dd/mm/yyyy');
        $data_analise->setMask('dd/mm/yyyy');
        $menarca_data->setMask('dd/mm/yyyy');

        $ano_inicio->setDatabaseMask('yyyy-mm-dd');
        $data_analise->setDatabaseMask('yyyy-mm-dd');
        $menarca_data->setDatabaseMask('yyyy-mm-dd');

        $menarca->setBooleanMode();
        $problema_saude->setBooleanMode();
        $afastado_treino->setBooleanMode();
        $treino_avaliacao->setBooleanMode();
        $presenciou_trote->setBooleanMode();
        $ultimo_jogo_jogou->setBooleanMode();

        $menarca->addItems(['1'=>'Sim','2'=>'Não']);
        $problema_saude->addItems(['1'=>'Sim','2'=>'Não']);
        $afastado_treino->addItems(['1'=>'Sim','2'=>'Não']);
        $treino_avaliacao->addItems(['1'=>'Sim','2'=>'Não']);
        $presenciou_trote->addItems(['1'=>'Sim','2'=>'Não']);
        $ultimo_jogo_jogou->addItems(['1'=>'Sim','2'=>'Não']);
        $status_cadastro->addItems(['1'=>'Aberto','2'=>'Fechado']);
        $ultimo_jogo->addItems(['G'=>'Ganhou','E'=>'Empatou','P'=>'Perdeu']);
        $ultimo_jogo_tempo->addItems(['1'=>'durante todo o tempo da partida/jogo','2'=>'apenas em um período do jogo (primeiro ou segundo tempo)','3'=>'por apenas alguns minutos durante a partida/jogo','4'=>'Não informado']);

        $menarca->setLayout('horizontal');
        $ultimo_jogo->setLayout('vertical');
        $problema_saude->setLayout('horizontal');
        $status_cadastro->setLayout('horizontal');
        $afastado_treino->setLayout('horizontal');
        $ultimo_jogo_tempo->setLayout('vertical');
        $treino_avaliacao->setLayout('horizontal');
        $presenciou_trote->setLayout('horizontal');
        $ultimo_jogo_jogou->setLayout('horizontal');
        $siges_categoria_idade_id->setLayout('vertical');

        $id->setSize(100);
        $menarca->setSize(80);
        $ano_inicio->setSize(200);
        $ultimo_jogo->setSize(120);
        $data_analise->setSize(200);
        $menarca_data->setSize(200);
        $menarca_idade->setSize(200);
        $problema_saude->setSize(70);
        $afastado_treino->setSize(70);
        $system_users_id->setSize(70);
        $treino_avaliacao->setSize(70);
        $status_cadastro->setSize(100);
        $presenciou_trote->setSize(70);
        $treino_semana->setSize('100%');
        $ultimo_jogo_jogou->setSize(80);
        $duracao_treino->setSize('100%');
        $observacoes->setSize('70%', 250);
        $ultimo_jogo_tempo->setSize('100%');
        $problema_saude_quais->setSize('100%');
        $system_users_id_display->setSize(562);
        $afastado_treino_tempo->setSize('100%');
        $afastado_treino_lesao->setSize('100%');
        $treino_avaliacao_quais->setSize('100%');
        $presenciou_trotes_quais->setSize('100%');
        $siges_categoria_idade_id->setSize('100%');

        $this->form->appendPage("Atleta");

        $this->form->addFields([new THidden('current_tab')]);
        $this->form->setTabFunction("$('[name=current_tab]').val($(this).attr('data-current_page'));");

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null)],[$id],[new TLabel("Status do cadastro:", null, '14px', null)],[$status_cadastro]);
        $row2 = $this->form->addFields([new TLabel("Atleta:", '#ff0000', '14px', null)],[$system_users_id]);
        $row3 = $this->form->addFields([new TLabel("Data da pesquisa:", null, '14px', null)],[$data_analise]);
        $row4 = $this->form->addFields([new TLabel("Treinos realizados (semana):", null, '14px', null)],[$treino_semana],[new TLabel("Duração (minutos):", null, '14px', null)],[$duracao_treino]);
        $row5 = $this->form->addFields([new TLabel("Categoria:", null, '14px', null)],[$siges_categoria_idade_id]);
        $row6 = $this->form->addFields([new TLabel("Ano de início:", null, '14px', null)],[$ano_inicio],[],[]);
        $row7 = $this->form->addFields([new TLabel("Observações:", null, '14px', null)],[$observacoes]);

        $this->form->appendPage("Questões");
        $row8 = $this->form->addContent([new TFormSeparator("Avaliação do Atleta", '#333333', '18', '#eeeeee')]);
        $row9 = $this->form->addFields([new TLabel("1 - No seu treino, participou de alguma das avaliações realizadas hoje?", null, '14px', null)],[$treino_avaliacao]);
        $row10 = $this->form->addFields([new TLabel("Qual(is)?", null, '14px', null)],[$treino_avaliacao_quais]);
        $row11 = $this->form->addFields([new TLabel("2 - Teve algum problema grave de saúde nos últimos 12 meses (ao longo do ano)?", null, '14px', null)],[$problema_saude]);
        $row12 = $this->form->addFields([new TLabel("Qual(is)?", null, '14px', null)],[$problema_saude_quais]);
        $row13 = $this->form->addFields([new TLabel("3 - Nos últimos três meses, ficou afastado dos treinos/competições em decorrência de algum tipo de lesão?", null, '14px', null)],[$afastado_treino]);
        $row14 = $this->form->addFields([new TLabel("4 - Que tipo de lesão?", null, '14px', null)],[$afastado_treino_lesao]);
        $row15 = $this->form->addFields([new TLabel("Por quanto tempo?", null, '14px', null)],[$afastado_treino_tempo]);
        $row16 = $this->form->addFields([new TLabel("5 - Já presenciou algum tipo de trote (humilhação, maus-tratos) com colegas de equipe?", null, '14px', null)],[$presenciou_trote]);
        $row17 = $this->form->addFields([new TLabel("Qual(is)?", null, '14px', null)],[$presenciou_trotes_quais]);

        $this->form->appendPage("Menarca");
        $row18 = $this->form->addContent([new TFormSeparator("Menarca (dia/mês/ano) - se não souber coloca a idade:", '#333333', '18', '#eeeeee')]);
        $row19 = $this->form->addFields([new TLabel("Menarca:", null, '14px', null)],[$menarca]);
        $row20 = $this->form->addFields([new TLabel("Data da Menarca:", null, '14px', null)],[$menarca_data]);
        $row21 = $this->form->addFields([new TLabel("Idade:", null, '14px', null)],[$menarca_idade]);

        $this->form->appendPage("Último Jogo");
        $row22 = $this->form->addContent([new TFormSeparator("Neste último jogo:", '#333333', '18', '#eeeeee')]);
        $row23 = $this->form->addFields([new TLabel("Sua equipe:", null, '14px', null)],[$ultimo_jogo]);
        $row24 = $this->form->addFields([new TLabel("Você jogou?", null, '14px', null)],[$ultimo_jogo_jogou]);
        $row25 = $this->form->addFields([new TLabel("Tempo:", null, '14px', null)],[$ultimo_jogo_tempo]);

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'far:save #ffffff');
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onshow = $this->form->addAction("Voltar", new TAction(['SigesAtletasAnalisesList', 'onShow']), 'fas:chevron-circle-left #000000');

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        $container->add(TBreadCrumb::create(["Usuários","Cadastro de análise do atleta"]));
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

            $object = new SigesAtletasAnalises(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

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

                $object = new SigesAtletasAnalises($key); // instantiates the Active Record 

                $this->form->setData($object); // fill the form 

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

    }

    public function onShow($param = null)
    {

        try
        {   
           if (isset($param['key']))
            {
                $object = new stdClass;
                $object->system_users_id = $param['key'];
                $this->form->setData($object);
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
        }   
    } 

}

