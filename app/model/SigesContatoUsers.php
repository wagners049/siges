<?php

class SigesContatoUsers extends TRecord
{
    const TABLENAME  = 'siges_contato_users';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $system_users;
    private $siges_tipo_contato;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('info_contato');
        parent::addAttribute('system_users_id');
        parent::addAttribute('siges_tipo_contato_id');
            
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
    /**
     * Method set_siges_tipo_contato
     * Sample of usage: $var->siges_tipo_contato = $object;
     * @param $object Instance of SigesTipoContato
     */
    public function set_siges_tipo_contato(SigesTipoContato $object)
    {
        $this->siges_tipo_contato = $object;
        $this->siges_tipo_contato_id = $object->id;
    }

    /**
     * Method get_siges_tipo_contato
     * Sample of usage: $var->siges_tipo_contato->attribute;
     * @returns SigesTipoContato instance
     */
    public function get_siges_tipo_contato()
    {
    
        // loads the associated object
        if (empty($this->siges_tipo_contato))
            $this->siges_tipo_contato = new SigesTipoContato($this->siges_tipo_contato_id);
    
        // returns the associated object
        return $this->siges_tipo_contato;
    }

    
}

