<?php

class SigesAtletaPesquisa extends TRecord
{
    const TABLENAME  = 'siges_atleta_pesquisa';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $siges_pesquisas;
    private $system_users;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('siges_pesquisas_id');
        parent::addAttribute('resposta');
        parent::addAttribute('system_users_id');
        parent::addAttribute('data_pesquisa');
            
    }

    /**
     * Method set_siges_pesquisas
     * Sample of usage: $var->siges_pesquisas = $object;
     * @param $object Instance of SigesPesquisas
     */
    public function set_siges_pesquisas(SigesPesquisas $object)
    {
        $this->siges_pesquisas = $object;
        $this->siges_pesquisas_id = $object->id;
    }

    /**
     * Method get_siges_pesquisas
     * Sample of usage: $var->siges_pesquisas->attribute;
     * @returns SigesPesquisas instance
     */
    public function get_siges_pesquisas()
    {
    
        // loads the associated object
        if (empty($this->siges_pesquisas))
            $this->siges_pesquisas = new SigesPesquisas($this->siges_pesquisas_id);
    
        // returns the associated object
        return $this->siges_pesquisas;
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

