<?php

class SigesContatoInstituicaoForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'siges';
    private static $activeRecord = 'SigesContatoInstituicao';
    private static $primaryKey = 'id';
    private static $formName = 'form_SigesContatoInstituicao';

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
        $this->form->setFormTitle("Cadastro de contatos - Instituição");


        $id = new TEntry('id');
        $siges_tipo_contato_id = new TDBCombo('siges_tipo_contato_id', 'siges', 'SigesTipoContato', 'id', '{id}','id asc'  );
        $info_contato = new TEntry('info_contato');
        $siges_instituicao_id = new TDBCombo('siges_instituicao_id', 'siges', 'SigesInstituicao', 'id', '{id}','id asc'  );

        $siges_tipo_contato_id->addValidation("Siges tipo contato id", new TRequiredValidator()); 
        $info_contato->addValidation("Info contato", new TRequiredValidator()); 
        $siges_instituicao_id->addValidation("Siges instituicao id", new TRequiredValidator()); 

        $id->setEditable(false);
        $id->setSize(100);
        $info_contato->setSize('70%');
        $siges_instituicao_id->setSize('70%');
        $siges_tipo_contato_id->setSize('70%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null)],[$id]);
        $row2 = $this->form->addFields([new TLabel("Siges tipo contato id:", '#ff0000', '14px', null)],[$siges_tipo_contato_id]);
        $row3 = $this->form->addFields([new TLabel("Info contato:", '#ff0000', '14px', null)],[$info_contato]);
        $row4 = $this->form->addFields([new TLabel("Siges instituicao id:", '#ff0000', '14px', null)],[$siges_instituicao_id]);

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave']), 'far:save #ffffff');
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

            $object = new SigesContatoInstituicao(); // create an empty object 

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

                $object = new SigesContatoInstituicao($key); // instantiates the Active Record 

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

