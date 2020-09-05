<?php

class SigesAtletasModalidades extends TRecord
{
    const TABLENAME  = 'siges_atletas_modalidades';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $siges_modalidades;
    private $system_users;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('siges_modalidades_id');
        parent::addAttribute('system_users_id');
            
    }

    /**
     * Method set_siges_modalidades
     * Sample of usage: $var->siges_modalidades = $object;
     * @param $object Instance of SigesModalidades
     */
    public function set_siges_modalidades(SigesModalidades $object)
    {
        $this->siges_modalidades = $object;
        $this->siges_modalidades_id = $object->id;
    }

    /**
     * Method get_siges_modalidades
     * Sample of usage: $var->siges_modalidades->attribute;
     * @returns SigesModalidades instance
     */
    public function get_siges_modalidades()
    {
    
        // loads the associated object
        if (empty($this->siges_modalidades))
            $this->siges_modalidades = new SigesModalidades($this->siges_modalidades_id);
    
        // returns the associated object
        return $this->siges_modalidades;
    }
    /**
     * Method set_system_users
     * Sample of usage: $var->system_users = $object;
     * @param $object Instance of SystemUsers
     */
    public function set_system_users(SystemUsers $object)
    {
        $this->system_users = $object;
        $this->system_users_id = $object->id;
    }

    /**
     * Method get_system_users
     * Sample of usage: $var->system_users->attribute;
     * @returns SystemUsers instance
     */
    public function get_system_users()
    {
    
        // loads the associated object
        if (empty($this->system_users))
            $this->system_users = new SystemUsers($this->system_users_id);
    
        // returns the associated object
        return $this->system_users;
    }

    
}

