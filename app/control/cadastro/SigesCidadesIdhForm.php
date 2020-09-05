<?php

class SigesCidadesIdhForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'siges';
    private static $activeRecord = 'SigesCidadesIdh';
    private static $primaryKey = 'id';
    private static $formName = 'form_SigesCidadesIdh';

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
        $this->form->setFormTitle("Cadastro de siges cidades idh");


        $id = new TEntry('id');
        $siges_cidades_id = new TDBCombo('siges_cidades_id', 'siges', 'SigesCidades', 'id', '{id}','id asc'  );
        $ano = new TEntry('ano');
        $idhm = new TNumeric('idhm', '2', ',', '.' );
        $idhm_renda = new TNumeric('idhm_renda', '2', ',', '.' );
        $idhm_long = new TNumeric('idhm_long', '2', ',', '.' );
        $idhm_educacao = new TNumeric('idhm_educacao', '2', ',', '.' );

        $siges_cidades_id->addValidation("Siges cidades id", new TRequiredValidator()); 
        $ano->addValidation("Ano", new TRequiredValidator()); 

        $ano->setMaxLength(4);
        $id->setEditable(false);

        $id->setSize(100);
        $ano->setSize('100%');
        $idhm->setSize('100%');
        $idhm_long->setSize('100%');
        $idhm_renda->setSize('100%');
        $idhm_educacao->setSize('100%');
        $siges_cidades_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null)],[$id]);
        $row2 = $this->form->addFields([new TLabel("Siges cidades id:", '#ff0000', '14px', null)],[$siges_cidades_id]);
        $row3 = $this->form->addFields([new TLabel("Ano:", '#ff0000', '14px', null)],[$ano]);
        $row4 = $this->form->addFields([new TLabel("Idhm:", null, '14px', null)],[$idhm]);
        $row5 = $this->form->addFields([new TLabel("Idhm renda:", null, '14px', null)],[$idhm_renda]);
        $row6 = $this->form->addFields([new TLabel("Idhm long:", null, '14px', null)],[$idhm_long]);
        $row7 = $this->form->addFields([new TLabel("Idhm educacao:", null, '14px', null)],[$idhm_educacao]);

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

            $object = new SigesCidadesIdh(); // create an empty object 

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

                $object = new SigesCidadesIdh($key); // instantiates the Active Record 

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

