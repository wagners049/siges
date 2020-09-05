<?php

class SigesSerieEscolarForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'siges';
    private static $activeRecord = 'SigesSerieEscolar';
    private static $primaryKey = 'id';
    private static $formName = 'form_SigesSerieEscolar';

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
        $this->form->setFormTitle("Cadastro de siges serie escolar");


        $id = new TEntry('id');
        $nivel = new TEntry('nivel');
        $serie = new TEntry('serie');
        $idade = new TEntry('idade');
        $active = new TEntry('active');

        $nivel->addValidation("Nivel", new TRequiredValidator()); 
        $serie->addValidation("Serie", new TRequiredValidator()); 
        $idade->addValidation("Idade", new TRequiredValidator()); 
        $active->addValidation("Active", new TRequiredValidator()); 

        $id->setEditable(false);
        $active->setValue('1');

        $active->setMaxLength(1);
        $nivel->setMaxLength(255);
        $serie->setMaxLength(255);
        $idade->setMaxLength(255);

        $id->setSize(100);
        $nivel->setSize('100%');
        $serie->setSize('100%');
        $idade->setSize('100%');
        $active->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null)],[$id]);
        $row2 = $this->form->addFields([new TLabel("Nivel:", '#ff0000', '14px', null)],[$nivel]);
        $row3 = $this->form->addFields([new TLabel("Serie:", '#ff0000', '14px', null)],[$serie]);
        $row4 = $this->form->addFields([new TLabel("Idade:", '#ff0000', '14px', null)],[$idade]);
        $row5 = $this->form->addFields([new TLabel("Active:", '#ff0000', '14px', null)],[$active]);

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

            $object = new SigesSerieEscolar(); // create an empty object 

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

                $object = new SigesSerieEscolar($key); // instantiates the Active Record 

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

