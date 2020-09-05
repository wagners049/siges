<?php

class SigesMicrorregiaoForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'siges';
    private static $activeRecord = 'SigesMicrorregiao';
    private static $primaryKey = 'id';
    private static $formName = 'form_SigesMicrorregiao';

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
        $this->form->setFormTitle("Cadastro de Microrregião");


        $id = new TEntry('id');
        $siges_estados_id = new TDBCombo('siges_estados_id', 'siges', 'SigesEstados', 'id', '{estado}','id asc'  );
        $codigo = new TEntry('codigo');
        $microrregiao = new TEntry('microrregiao');

        $siges_estados_id->addValidation("Siges estados id", new TRequiredValidator()); 
        $codigo->addValidation("Codigo", new TRequiredValidator()); 
        $microrregiao->addValidation("Microrregiao", new TRequiredValidator()); 

        $id->setEditable(false);

        $codigo->setMaxLength(11);
        $microrregiao->setMaxLength(255);

        $id->setSize(100);
        $codigo->setSize('100%');
        $microrregiao->setSize('100%');
        $siges_estados_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null)],[$id]);
        $row2 = $this->form->addFields([new TLabel("Estado:", '#ff0000', '14px', null)],[$siges_estados_id]);
        $row3 = $this->form->addFields([new TLabel("Codigo:", '#ff0000', '14px', null)],[$codigo]);
        $row4 = $this->form->addFields([new TLabel("Microrregiao:", '#ff0000', '14px', null)],[$microrregiao]);

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

            $object = new SigesMicrorregiao(); // create an empty object 

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

                $object = new SigesMicrorregiao($key); // instantiates the Active Record 

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

