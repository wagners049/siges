<?php

class SigesIdebForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'siges';
    private static $activeRecord = 'SigesIdeb';
    private static $primaryKey = 'id';
    private static $formName = 'form_SigesIdeb';

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
        $this->form->setFormTitle("Cadastro IDEB");


        $id = new TEntry('id');
        $siges_instituicao_id = new TDBUniqueSearch('siges_instituicao_id', 'siges', 'SigesInstituicao', 'id', 'instituicao_ensino','id asc'  );
        $siges_tipo_serie_id = new TDBCombo('siges_tipo_serie_id', 'siges', 'SigesTipoSerie', 'id', '{tipo}','id asc'  );
        $ano_ref = new TEntry('ano_ref');
        $ideb = new TNumeric('ideb', '2', ',', '.' );

        $siges_instituicao_id->addValidation("Instituição", new TRequiredValidator()); 
        $siges_tipo_serie_id->addValidation("Siges tipo serie id", new TRequiredValidator()); 
        $ano_ref->addValidation("Ano ref", new TRequiredValidator()); 
        $ideb->addValidation("Ideb", new TRequiredValidator()); 

        $id->setEditable(false);
        $siges_instituicao_id->setMinLength(2);
        $siges_instituicao_id->setMask('{instituicao_ensino} - {siges_cidades->municipio} - {siges_cidades->siges_estados->sigla} ');
        $ano_ref->setMaxLength(4);

        $id->setSize(100);
        $ideb->setSize('100%');
        $ano_ref->setSize('100%');
        $siges_tipo_serie_id->setSize('100%');
        $siges_instituicao_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null)],[$id]);
        $row2 = $this->form->addFields([new TLabel("Instituição", '#ff0000', '14px', null)],[$siges_instituicao_id]);
        $row3 = $this->form->addFields([new TLabel("Tipo de Série:", '#ff0000', '14px', null)],[$siges_tipo_serie_id]);
        $row4 = $this->form->addFields([new TLabel("Ano referência:", '#ff0000', '14px', null)],[$ano_ref]);
        $row5 = $this->form->addFields([new TLabel("Ideb:", '#ff0000', '14px', null)],[$ideb]);

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'fas:save #ffffff');
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        $container->add(TBreadCrumb::create(["Cadastro","Cadastro IDEB"]));
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

            $object = new SigesIdeb(); // create an empty object 

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

                $object = new SigesIdeb($key); // instantiates the Active Record 

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

