<?php

class SigesSociodemograficoForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'siges';
    private static $activeRecord = 'SigesSociodemografico';
    private static $primaryKey = 'id';
    private static $formName = 'form_SigesSociodemografico';

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
        $this->form->setFormTitle("Cadastro de Sociodemográfico");

        $criteria_siges_serie_escolar_id = new TCriteria();

        $filterVar = "Y";
        $criteria_siges_serie_escolar_id->add(new TFilter('active', '=', $filterVar)); 

        $id = new TEntry('id');
        $system_users_id = new TDBCombo('system_users_id', 'siges', 'SystemUsers', 'id', '{name}','name asc'  );
        $siges_tipos_instituicao_id = new TDBRadioGroup('siges_tipos_instituicao_id', 'siges', 'SigesTiposInstituicao', 'id', '{tipo_instituicao}','id asc'  );
        $siges_zona_municipio_id = new TDBRadioGroup('siges_zona_municipio_id', 'siges', 'SigesZonaMunicipio', 'id', '{tipo}','id asc'  );
        $siges_raca_id = new TDBRadioGroup('siges_raca_id', 'siges', 'SigesRaca', 'id', '{raca}','id asc'  );
        $siges_serie_escolar_id = new TDBCombo('siges_serie_escolar_id', 'siges', 'SigesSerieEscolar', 'id', '{serie}  - {nivel} ','id asc' , $criteria_siges_serie_escolar_id );
        $siges_tipo_moradia_id = new TDBRadioGroup('siges_tipo_moradia_id', 'siges', 'SigesTipoMoradia', 'id', '{tipo}','id asc'  );
        $pessoas_residencia = new TEntry('pessoas_residencia');
        $siges_moradores_casa_id = new TDBCheckGroup('siges_moradores_casa_id', 'siges', 'SigesMoradoresCasa', 'id', '{tipo}','id asc'  );
        $siges_nivel_escolariade_mae_id = new TDBRadioGroup('siges_nivel_escolariade_mae_id', 'siges', 'SigesNivelEscolariade', 'id', '{nivel_escolaridade}','id asc'  );
        $siges_nivel_escolariade_pai_id = new TDBRadioGroup('siges_nivel_escolariade_pai_id', 'siges', 'SigesNivelEscolariade', 'id', '{nivel_escolaridade}','id asc'  );
        $siges_responsaveis_competicoes_id = new TDBCheckGroup('siges_responsaveis_competicoes_id', 'siges', 'SigesResponsaveisCompeticoes', 'id', '{opcoes}','id asc'  );
        $participa_aula_ef = new TRadioGroup('participa_aula_ef');
        $participa_aula_ef_sim = new TEntry('participa_aula_ef_sim');
        $participa_aula_ef_nao = new TEntry('participa_aula_ef_nao');
        $participa_outras_atividades = new TRadioGroup('participa_outras_atividades');
        $participa_outras_atividades_sim = new TEntry('participa_outras_atividades_sim');
        $siges_tempo_competicoes_id = new TDBRadioGroup('siges_tempo_competicoes_id', 'siges', 'SigesTempoCompeticoes', 'id', '{opcoes}','id asc'  );
        $treina_outra_modalidade = new TRadioGroup('treina_outra_modalidade');
        $treina_outra_modalidade_qual = new TEntry('treina_outra_modalidade_qual');
        $treina_outra_modalidade_quantidade = new TEntry('treina_outra_modalidade_quantidade');
        $treina_outra_modalidade_duracao = new TEntry('treina_outra_modalidade_duracao');
        $siges_participa_outras_competicoes_id = new TDBRadioGroup('siges_participa_outras_competicoes_id', 'siges', 'SigesParticipaOutrasCompeticoes', 'id', '{opcoes}','id asc'  );
        $siges_apoio_bolsa_id = new TDBCheckGroup('siges_apoio_bolsa_id', 'siges', 'SigesApoioBolsa', 'id', '{opcao}','id asc'  );
        $siges_apoio_bolsa_outros = new TEntry('siges_apoio_bolsa_outros');
        $participacao_outros = new TEntry('participacao_outros');
        $siges_espaco_treino_id = new TDBCheckGroup('siges_espaco_treino_id', 'siges', 'SigesEspacoTreino', 'id', '{opcoes}','id asc'  );
        $siges_espaco_treino_outros = new TEntry('siges_espaco_treino_outros');
        $siges_momento_treino_id = new TDBRadioGroup('siges_momento_treino_id', 'siges', 'SigesMomentoTreino', 'id', '{opcoes}','id asc'  );
        $siges_dificuldades_id = new TDBCheckGroup('siges_dificuldades_id', 'siges', 'SigesDificuldades', 'id', '{opcoes}','id asc'  );
        $siges_dificuldades_outros = new TEntry('siges_dificuldades_outros');
        $siges_espaco_treino_comunidade_id = new TDBCheckGroup('siges_espaco_treino_comunidade_id', 'siges', 'SigesEspacoTreino', 'id', '{opcoes}','id asc'  );
        $siges_espaco_treino_comunidade_outros = new TEntry('siges_espaco_treino_comunidade_outros');
        $siges_apoio_responsavel_id = new TDBCheckGroup('siges_apoio_responsavel_id', 'siges', 'SigesApoioResponsavel', 'id', '{opcoes}','id asc'  );

        $system_users_id->addValidation("Atleta", new TRequiredValidator()); 
        $siges_tipos_instituicao_id->addValidation("Questão 1", new TRequiredValidator()); 
        $siges_zona_municipio_id->addValidation("Questão 2", new TRequiredValidator()); 
        $siges_raca_id->addValidation("Questão 3", new TRequiredValidator()); 
        $siges_serie_escolar_id->addValidation("Questão 4", new TRequiredValidator()); 
        $siges_tipo_moradia_id->addValidation("Questão 5", new TRequiredValidator()); 
        $pessoas_residencia->addValidation("Questão 6", new TRequiredValidator()); 
        $siges_moradores_casa_id->addValidation("Questão 7", new TRequiredValidator()); 
        $siges_nivel_escolariade_mae_id->addValidation("Questão 8", new TRequiredValidator()); 
        $siges_nivel_escolariade_pai_id->addValidation("Questão 9", new TRequiredValidator()); 
        $siges_responsaveis_competicoes_id->addValidation("Questão 10", new TRequiredValidator()); 
        $participa_aula_ef->addValidation("Questão 11", new TRequiredValidator()); 
        $participa_outras_atividades->addValidation("Questão 12", new TRequiredValidator()); 
        $siges_tempo_competicoes_id->addValidation("Questão 13", new TRequiredValidator()); 
        $treina_outra_modalidade->addValidation("Questão 14", new TRequiredValidator()); 
        $siges_participa_outras_competicoes_id->addValidation("Questão 15", new TRequiredValidator()); 
        $siges_apoio_bolsa_id->addValidation("Questão 16", new TRequiredValidator()); 
        $participacao_outros->addValidation("Questão 17", new TRequiredValidator()); 
        $siges_espaco_treino_id->addValidation("Questão 18", new TRequiredValidator()); 
        $siges_momento_treino_id->addValidation("Questão 19", new TRequiredValidator()); 
        $siges_dificuldades_id->addValidation("Questão 20", new TRequiredValidator()); 
        $siges_espaco_treino_comunidade_id->addValidation("Questão 21", new TRequiredValidator()); 
        $siges_apoio_responsavel_id->addValidation("Questão 22", new TRequiredValidator()); 

        $id->setEditable(false);
        $pessoas_residencia->forceUpperCase();

        $participa_aula_ef->addItems(['1'=>'Sim','2'=>'Não']);
        $treina_outra_modalidade->addItems(['1'=>'Sim','2'=>'Não']);
        $participa_outras_atividades->addItems(['1'=>'Sim','2'=>'Não']);

        $pessoas_residencia->setMaxLength(11);
        $participa_aula_ef_sim->setMaxLength(255);
        $treina_outra_modalidade_qual->setMaxLength(255);
        $treina_outra_modalidade_duracao->setMaxLength(255);
        $treina_outra_modalidade_quantidade->setMaxLength(255);
        $siges_espaco_treino_comunidade_outros->setMaxLength(255);

        $siges_apoio_bolsa_id->setValueSeparator(',');
        $siges_dificuldades_id->setValueSeparator(',');
        $siges_espaco_treino_id->setValueSeparator(',');
        $siges_moradores_casa_id->setValueSeparator(',');
        $siges_apoio_responsavel_id->setValueSeparator(',');
        $siges_responsaveis_competicoes_id->setValueSeparator(',');
        $siges_espaco_treino_comunidade_id->setValueSeparator(',');

        $siges_raca_id->setLayout('horizontal');
        $participa_aula_ef->setLayout('vertical');
        $siges_apoio_bolsa_id->setLayout('vertical');
        $siges_dificuldades_id->setLayout('vertical');
        $siges_espaco_treino_id->setLayout('vertical');
        $siges_tipo_moradia_id->setLayout('horizontal');
        $siges_moradores_casa_id->setLayout('vertical');
        $siges_momento_treino_id->setLayout('vertical');
        $treina_outra_modalidade->setLayout('vertical');
        $siges_zona_municipio_id->setLayout('horizontal');
        $siges_apoio_responsavel_id->setLayout('vertical');
        $siges_tempo_competicoes_id->setLayout('vertical');
        $participa_outras_atividades->setLayout('vertical');
        $siges_tipos_instituicao_id->setLayout('horizontal');
        $siges_nivel_escolariade_pai_id->setLayout('vertical');
        $siges_nivel_escolariade_mae_id->setLayout('vertical');
        $siges_responsaveis_competicoes_id->setLayout('vertical');
        $siges_espaco_treino_comunidade_id->setLayout('vertical');
        $siges_participa_outras_competicoes_id->setLayout('vertical');

        $id->setSize(100);
        $siges_raca_id->setSize('100%');
        $system_users_id->setSize('100%');
        $pessoas_residencia->setSize('50%');
        $participa_aula_ef->setSize('100%');
        $participacao_outros->setSize('50%');
        $participa_aula_ef_nao->setSize('50%');
        $siges_apoio_bolsa_id->setSize('100%');
        $participa_aula_ef_sim->setSize('50%');
        $siges_serie_escolar_id->setSize('50%');
        $siges_tipo_moradia_id->setSize('100%');
        $siges_dificuldades_id->setSize('100%');
        $siges_espaco_treino_id->setSize('100%');
        $treina_outra_modalidade->setSize('100%');
        $siges_momento_treino_id->setSize('100%');
        $siges_zona_municipio_id->setSize('100%');
        $siges_moradores_casa_id->setSize('100%');
        $siges_apoio_bolsa_outros->setSize('50%');
        $siges_dificuldades_outros->setSize('50%');
        $siges_espaco_treino_outros->setSize('50%');
        $siges_tempo_competicoes_id->setSize('100%');
        $siges_apoio_responsavel_id->setSize('100%');
        $siges_tipos_instituicao_id->setSize('100%');
        $treina_outra_modalidade_qual->setSize('50%');
        $participa_outras_atividades->setSize('100%');
        $treina_outra_modalidade_duracao->setSize('50%');
        $participa_outras_atividades_sim->setSize('50%');
        $siges_nivel_escolariade_pai_id->setSize('100%');
        $siges_nivel_escolariade_mae_id->setSize('100%');
        $treina_outra_modalidade_quantidade->setSize('50%');
        $siges_responsaveis_competicoes_id->setSize('100%');
        $siges_espaco_treino_comunidade_id->setSize('100%');
        $siges_espaco_treino_comunidade_outros->setSize('50%');
        $siges_participa_outras_competicoes_id->setSize('100%');

        $a = new TTextDisplay('Text Display', 'red', 12, 'bi');
        
        
        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null)],[$id]);
        
        $row2 = $this->form->addFields([new TLabel("Atleta", '#ff0000', '14px', null)],[$system_users_id]);
        
        $p1 = $this->form->addFields([], [new TTextDisplay('1) Pergunta numero 1?', 'black', 12, 'b')]);
        $row3 = $this->form->addFields([new TLabel("", '#ff0000', '14px', null)],[$siges_tipos_instituicao_id]);

        $p1 = $this->form->addFields([], [new TTextDisplay('1) Pergunta numero 2 sdfkjsfjsalkfjas  g?', 'black', 12, 'b')]);
        $row4 = $this->form->addFields([new TLabel("", '#ff0000', '14px', null)],[$siges_zona_municipio_id]);
        
        $row5 = $this->form->addFields([new TLabel("3)", '#ff0000', '14px', null)],[$siges_raca_id]);
        $row6 = $this->form->addFields([new TLabel("4)", '#ff0000', '14px', null)],[$siges_serie_escolar_id]);
        $row7 = $this->form->addFields([new TLabel("5)", '#ff0000', '14px', null)],[$siges_tipo_moradia_id]);
        $row8 = $this->form->addFields([new TLabel("6)", '#ff0000', '14px', null)],[$pessoas_residencia]);
        $row9 = $this->form->addFields([new TLabel("7)", '#ff0000', '14px', null)],[$siges_moradores_casa_id]);
        $row10 = $this->form->addFields([new TLabel("8)", '#ff0000', '14px', null)],[$siges_nivel_escolariade_mae_id]);
        $row11 = $this->form->addFields([new TLabel("9)", '#ff0000', '14px', null)],[$siges_nivel_escolariade_pai_id]);
        $row12 = $this->form->addFields([new TLabel("10)", '#ff0000', '14px', null)],[$siges_responsaveis_competicoes_id]);
        $row13 = $this->form->addFields([new TLabel("11)", '#ff0000', '14px', null)],[$participa_aula_ef]);
        $row14 = $this->form->addFields([new TLabel("Participa aula ef sim:", null, '14px', null)],[$participa_aula_ef_sim]);
        $row15 = $this->form->addFields([new TLabel("Participa aula ef nao:", null, '14px', null)],[$participa_aula_ef_nao]);
        $row16 = $this->form->addFields([new TLabel("12)", '#ff0000', '14px', null)],[$participa_outras_atividades]);
        $row17 = $this->form->addFields([new TLabel("Participa outras atividades sim:", null, '14px', null)],[$participa_outras_atividades_sim]);
        $row18 = $this->form->addFields([new TLabel("13)", '#ff0000', '14px', null)],[$siges_tempo_competicoes_id]);
        $row19 = $this->form->addFields([new TLabel("14)", '#ff0000', '14px', null)],[$treina_outra_modalidade]);
        $row20 = $this->form->addFields([new TLabel("Treina outra modalidade qual:", null, '14px', null)],[$treina_outra_modalidade_qual]);
        $row21 = $this->form->addFields([new TLabel("Treina outra modalidade quantidade:", null, '14px', null)],[$treina_outra_modalidade_quantidade]);
        $row22 = $this->form->addFields([new TLabel("Treina outra modalidade duracao:", null, '14px', null)],[$treina_outra_modalidade_duracao]);
        $row23 = $this->form->addFields([new TLabel("15)", '#ff0000', '14px', null)],[$siges_participa_outras_competicoes_id]);
        $row24 = $this->form->addFields([new TLabel("16)", '#ff0000', '14px', null)],[$siges_apoio_bolsa_id]);
        $row25 = $this->form->addFields([new TLabel("outros", null, '14px', null)],[$siges_apoio_bolsa_outros]);
        $row26 = $this->form->addFields([new TLabel("17)", '#ff0000', '14px', null)],[$participacao_outros]);
        $row27 = $this->form->addFields([new TLabel("18)", '#ff0000', '14px', null)],[$siges_espaco_treino_id]);
        $row28 = $this->form->addFields([new TLabel("Siges espaco treino outros:", null, '14px', null)],[$siges_espaco_treino_outros]);
        $row29 = $this->form->addFields([new TLabel("19)", '#ff0000', '14px', null)],[$siges_momento_treino_id]);
        $row30 = $this->form->addFields([new TLabel("20)", '#ff0000', '14px', null)],[$siges_dificuldades_id]);
        $row31 = $this->form->addFields([new TLabel("Siges dificuldades outros:", null, '14px', null)],[$siges_dificuldades_outros]);
        $row32 = $this->form->addFields([new TLabel("21)", '#ff0000', '14px', null)],[$siges_espaco_treino_comunidade_id]);
        $row33 = $this->form->addFields([new TLabel("Siges espaco treino comunidade outros:", null, '14px', null)],[$siges_espaco_treino_comunidade_outros]);
        $row34 = $this->form->addFields([new TLabel("22)", '#ff0000', '14px', null)],[$siges_apoio_responsavel_id]);

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

            $object = new SigesSociodemografico(); // create an empty object 

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

                $object = new SigesSociodemografico($key); // instantiates the Active Record 

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

    } 

}

