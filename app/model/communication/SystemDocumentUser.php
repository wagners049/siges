<?php

class SystemDocumentUser extends TRecord
{
    const TABLENAME  = 'system_document_user';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $system_document;
    private $system_user;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('system_document_id');
        parent::addAttribute('system_user_id');
            
    }

    /**
     * Method set_system_document
     * Sample of usage: $var->system_document = $object;
     * @param $object Instance of SystemDocument
     */
    public function set_system_document(SystemDocument $object)
    {
        $this->system_document = $object;
        $this->system_document_id = $object->id;
    }

    /**
     * Method get_system_document
     * Sample of usage: $var->system_document->attribute;
     * @returns SystemDocument instance
     */
    public function get_system_document()
    {
    
        // loads the associated object
        if (empty($this->system_document))
            $this->system_document = new SystemDocument($this->system_document_id);
    
        // returns the associated object
        return $this->system_document;
    }
    /**
     * Method set_system_users
     * Sample of usage: $var->system_users = $object;
     * @param $object Instance of SystemUsers
     */
    public function set_system_user(SystemUsers $object)
    {
        $this->system_user = $object;
        $this->system_user_id = $object->id;
    }

    /**
     * Method get_system_user
     * Sample of usage: $var->system_user->attribute;
     * @returns SystemUsers instance
     */
    public function get_system_user()
    {
    
        // loads the associated object
        if (empty($this->system_user))
            $this->system_user = new SystemUsers($this->system_user_id);
    
        // returns the associated object
        return $this->system_user;
    }

    
}

