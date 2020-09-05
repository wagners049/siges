<?php

class SigesAtletasModalidadesForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'siges';
    private static $activeRecord = 'SigesAtletasModalidades';
    private static $primaryKey = 'id';
    private static $formName = 'form_SigesAtletasModalidades';

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
        $this->form->setFormTitle("Cadastro de atleta: Modalidades");

        $criteria_system_users_id = new TCriteria();

        $criteria_system_users_id->setProperty('order', 'name asc');

        $id = new TEntry('id');
        $siges_modalidades_id = new TDBCombo('siges_modalidades_id', 'siges', 'SigesModalidades', 'id', '{id}','id asc'  );
        $system_users_id = new TDBSeekButton('system_users_id', 'siges', self::$formName, 'SystemUsers', 'name', 'system_users_id', 'system_users_id_display', $criteria_system_users_id);
        $system_users_id_display = new TEntry('system_users_id_display');

        $siges_modalidades_id->addValidation("Siges modalidades id", new TRequiredValidator()); 
        $system_users_id->addValidation("System users id", new TRequiredValidator()); 

        $system_users_id->setDisplayMask('{name}');
        $system_users_id->setAuxiliar($system_users_id_display);

        $id->setEditable(false);
        $system_users_id_display->setEditable(false);

        $id->setSize(100);
        $system_users_id->setSize(70);
        $siges_modalidades_id->setSize('70%');
        $system_users_id_display->setSize(572);

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null)],[$id]);
        $row2 = $this->form->addFields([new TLabel("Modalidade:", '#ff0000', '14px', null)],[$siges_modalidades_id]);
        $row3 = $this->form->addFields([new TLabel("Atleta:", '#ff0000', '14px', null)],[$system_users_id]);

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

            $object = new SigesAtletasModalidades(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            $object->store(); // save the object 

            $messageAction = new TAction(['SigesAtletasModalidadesList', 'onShow']);   

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

                $object = new SigesAtletasModalidades($key); // instantiates the Active Record 

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

