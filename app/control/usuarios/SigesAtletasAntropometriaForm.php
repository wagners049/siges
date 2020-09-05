<?php

class SigesAtletasAntropometriaForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'siges';
    private static $activeRecord = 'SigesAtletasAntropometria';
    private static $primaryKey = 'id';
    private static $formName = 'form_SigesAtletasAntropometria';

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
        $this->form->setFormTitle("Cadastro de siges atletas antropometria");

        $criteria_system_users_id = new TCriteria();

        $criteria_system_users_id->setProperty('order', 'name asc');

        $id = new TEntry('id');
        $data_pesquisa = new TDate('data_pesquisa');
        $system_users_id = new TDBSeekButton('system_users_id', 'siges', self::$formName, 'SystemUsers', 'name', 'system_users_id', 'system_users_id_display', $criteria_system_users_id);
        $system_users_id_display = new TEntry('system_users_id_display');
        $status_cadastro = new TRadioGroup('status_cadastro');
        $observacoes = new THtmlEditor('observacoes');
        $estatura = new TNumeric('estatura', '1', ',', '.' );
        $massa_corporal = new TNumeric('massa_corporal', '3', ',', '.' );
        $imc = new TNumeric('imc', '6', ',', '.' );
        $estatura_sentado = new TNumeric('estatura_sentado', '1', ',', '.' );
        $membro_inferior = new TNumeric('membro_inferior', '1', ',', '.' );
        $envergadura = new TNumeric('envergadura', '1', ',', '.' );
        $gordura_corporal = new TNumeric('gordura_corporal', '3', ',', '.' );
        $lado_predominante = new TRadioGroup('lado_predominante');
        $flexibilidade = new TNumeric('flexibilidade', '1', ',', '.' );
        $salto_vertical = new TNumeric('salto_vertical', '2', ',', '.' );
        $diametro_u = new TNumeric('diametro_u', '1', ',', '.' );
        $diametro_f = new TNumeric('diametro_f', '1', ',', '.' );
        $d_escapular = new TNumeric('d_escapular', '1', ',', '.' );
        $d_lombar = new TNumeric('d_lombar', '1', ',', '.' );
        $din_direito = new TNumeric('din_direito', '2', ',', '.' );
        $din_esquerdo = new TNumeric('din_esquerdo', '2', ',', '.' );
        $c_abdominal = new TNumeric('c_abdominal', '2', ',', '.' );
        $c_quadril = new TNumeric('c_quadril', '2', ',', '.' );
        $c_cintura = new TNumeric('c_cintura', '2', ',', '.' );
        $dc_subescapular = new TNumeric('dc_subescapular', '2', ',', '.' );
        $dc_triciptal = new TNumeric('dc_triciptal', '2', ',', '.' );
        $dc_panturrilha_medial = new TNumeric('dc_panturrilha_medial', '2', ',', '.' );
        $dc_suprailiaca = new TNumeric('dc_suprailiaca', '2', ',', '.' );
        $dc_biceps = new TNumeric('dc_biceps', '2', ',', '.' );
        $dc_abdominal = new TNumeric('dc_abdominal', '2', ',', '.' );
        $pas = new TNumeric('pas', '2', ',', '.' );
        $pad = new TNumeric('pad', '2', ',', '.' );
        $fc = new TNumeric('fc', '2', ',', '.' );

        $estatura->setExitAction(new TAction([$this,'calcIMCe']));
        $massa_corporal->setExitAction(new TAction([$this,'calcIMCm']));

        $system_users_id->addValidation("System users id", new TRequiredValidator()); 

        $data_pesquisa->setMask('dd/mm/yyyy');
        $data_pesquisa->setDatabaseMask('yyyy-mm-dd');
        $system_users_id->setDisplayMask('{name}');
        $system_users_id->setAuxiliar($system_users_id_display);
        $status_cadastro->setUseButton();

        $status_cadastro->addItems(['1'=>'Aberto','2'=>'Fechado']);
        $lado_predominante->addItems(['D'=>'Direito','E'=>'Esquerdo']);

        $status_cadastro->setLayout('horizontal');
        $lado_predominante->setLayout('horizontal');

        $id->setEditable(false);
        $imc->setEditable(false);
        $system_users_id_display->setEditable(false);

        $id->setSize(100);
        $fc->setSize('100%');
        $pad->setSize('100%');
        $pas->setSize('100%');
        $imc->setSize('100%');
        $estatura->setSize('100%');
        $d_lombar->setSize('100%');
        $dc_biceps->setSize('100%');
        $c_cintura->setSize('100%');
        $c_quadril->setSize('100%');
        $diametro_f->setSize('100%');
        $diametro_u->setSize('100%');
        $data_pesquisa->setSize(200);
        $c_abdominal->setSize('100%');
        $din_direito->setSize('100%');
        $system_users_id->setSize(70);
        $envergadura->setSize('100%');
        $d_escapular->setSize('100%');
        $status_cadastro->setSize(140);
        $dc_abdominal->setSize('100%');
        $din_esquerdo->setSize('100%');
        $dc_triciptal->setSize('100%');
        $flexibilidade->setSize('100%');
        $massa_corporal->setSize('100%');
        $dc_suprailiaca->setSize('100%');
        $salto_vertical->setSize('100%');
        $lado_predominante->setSize(100);
        $membro_inferior->setSize('100%');
        $dc_subescapular->setSize('100%');
        $estatura_sentado->setSize('100%');
        $gordura_corporal->setSize('100%');
        $observacoes->setSize('100%', 250);
        $system_users_id_display->setSize(542);
        $dc_panturrilha_medial->setSize('100%');

        $this->form->appendPage("Atleta");

        $this->form->addFields([new THidden('current_tab')]);
        $this->form->setTabFunction("$('[name=current_tab]').val($(this).attr('data-current_page'));");

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null)],[$id],[new TLabel("Data pesquisa:", null, '14px', null)],[$data_pesquisa]);
        $row2 = $this->form->addFields([new TLabel("Atleta:", '#ff0000', '14px', null)],[$system_users_id]);
        $row3 = $this->form->addFields([new TLabel("Status do cadastro:", null, '14px', null)],[$status_cadastro]);
        $row4 = $this->form->addFields([new TLabel("Observações:", null, '14px', null)],[$observacoes]);

        $this->form->appendPage("Medidas");
        $row5 = $this->form->addFields([new TLabel("Estatura (cm):", null, '14px', null, '100%')],[$estatura],[new TLabel("Massa corporal (Kg):", null, '14px', null, '100%')],[$massa_corporal],[new TLabel("IMC:", null, '14px', null, '100%')],[$imc]);
        $row5->layout = [' col-sm-2 control-label','col-sm-2',' col-sm-2 control-label',' col-sm-2',' col-sm-2 control-label','col-sm-2'];

        $row6 = $this->form->addFields([new TLabel("Estatura sentado (cm):", null, '14px', null)],[$estatura_sentado],[new TLabel("Membro inferior (cm):", null, '14px', null)],[$membro_inferior],[new TLabel("Envergadura (cm):", null, '14px', null)],[$envergadura]);
        $row6->layout = [' col-sm-2 control-label',' col-sm-2',' col-sm-2 control-label','col-sm-2',' col-sm-2 control-label','col-sm-2'];

        $row7 = $this->form->addFields([new TLabel("Gordura corporal:", null, '14px', null, '100%')],[$gordura_corporal],[],[],[],[]);
        $row7->layout = [' col-sm-2 control-label',' col-sm-2',' col-sm-2','col-sm-2','col-sm-2','col-sm-2'];

        $row8 = $this->form->addFields([new TLabel("Lado predominante:", null, '14px', null, '100%')],[$lado_predominante],[],[],[],[]);
        $row8->layout = [' col-sm-2 control-label',' col-sm-2',' col-sm-2','col-sm-2','col-sm-2','col-sm-2'];

        $row9 = $this->form->addFields([new TLabel("Flexibilidade:", null, '14px', null, '100%')],[$flexibilidade],[new TLabel("Salto Vertical:", null, '14px', null, '100%')],[$salto_vertical],[],[]);
        $row9->layout = [' col-sm-2 control-label',' col-sm-2',' col-sm-2 control-label','col-sm-2','col-sm-2','col-sm-2'];

        $row10 = $this->form->addContent([new TFormSeparator("Diâmetro (cm)", '#333333', '18', '#eeeeee')]);
        $row11 = $this->form->addFields([new TLabel("Úmero:", null, '14px', null, '100%')],[$diametro_u],[new TLabel("Fêmur:", null, '14px', null, '100%')],[$diametro_f]);
        $row12 = $this->form->addFields([new TLabel("Escapular:", null, '14px', null, '100%')],[$d_escapular],[new TLabel("Lombar:", null, '14px', null, '100%')],[$d_lombar]);
        $row13 = $this->form->addFields([new TLabel("Din Direito", null, '14px', null)],[$din_direito],[new TLabel("Din Esquerdo", null, '14px', null, '100%')],[$din_esquerdo]);
        $row14 = $this->form->addContent([new TFormSeparator("Comprimento (cm)", '#333333', '18', '#eeeeee')]);
        $row15 = $this->form->addFields([new TLabel("Abdominal:", null, '14px', null, '100%')],[$c_abdominal],[new TLabel("Quadril:", null, '14px', null, '100%')],[$c_quadril],[new TLabel("Cintura:", null, '14px', null, '100%')],[$c_cintura]);
        $row15->layout = [' col-sm-2 control-label',' col-sm-2',' col-sm-2 control-label','col-sm-2',' col-sm-2 control-label','col-sm-2'];

        $this->form->appendPage("Dobras Cutâneas");
        $row16 = $this->form->addFields([new TLabel("Subescapular:", null, '14px', null)],[$dc_subescapular],[new TLabel("Triciptal:", null, '14px', null)],[$dc_triciptal]);
        $row17 = $this->form->addFields([new TLabel("Panturrilha medial:", null, '14px', null)],[$dc_panturrilha_medial],[new TLabel("Suprailiaca:", null, '14px', null)],[$dc_suprailiaca]);
        $row18 = $this->form->addFields([new TLabel("Bíceps:", null, '14px', null)],[$dc_biceps],[new TLabel("Abdominal:", null, '14px', null)],[$dc_abdominal]);

        $this->form->appendPage("Pressão");
        $row19 = $this->form->addFields([new TLabel("PAS", null, '14px', null)],[$pas],[],[]);
        $row20 = $this->form->addFields([new TLabel("PAD", null, '14px', null)],[$pad],[],[]);
        $row21 = $this->form->addFields([new TLabel("FC", null, '14px', null)],[$fc],[],[]);

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'far:save #ffffff');
        $btn_onsave->addStyleClass('btn-primary'); 

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        $container->add(TBreadCrumb::create(["Usuários","Cadastro de Antropometria"]));
        $container->add($this->form);

        parent::add($container);

    }

    public static function calcIMCe($param = null) 
    {
        try 
        {
            //code here
            $massa_corporal = (double) str_replace(',', '.', str_replace('.', '', $param['massa_corporal']));
            $estatura = (double) str_replace(',', '.', str_replace('.', '', $param['estatura']));

            $imc = $massa_corporal / ( ($estatura/100) * ($estatura/100) ) ;
            $object = new stdClass();
            $object->imc = number_format($imc, 6, ',', '.');
            TForm::sendData(self::$formName, $object);

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public static function calcIMCm($param = null) 
    {
        try 
        {
            //code here
            $massa_corporal = (double) str_replace(',', '.', str_replace('.', '', $param['massa_corporal']));
            $estatura = (double) str_replace(',', '.', str_replace('.', '', $param['estatura']));

            $imc = $massa_corporal / ( ($estatura/100) * ($estatura/100) ) ;
            $object = new stdClass();
            $object->imc = number_format($imc, 6, ',', '.');
            TForm::sendData(self::$formName, $object);

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
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

            $object = new SigesAtletasAntropometria(); // create an empty object 

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

                $object = new SigesAtletasAntropometria($key); // instantiates the Active Record 

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

