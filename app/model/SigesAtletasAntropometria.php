<?php

class SigesAtletasAntropometria extends TRecord
{
    const TABLENAME  = 'siges_atletas_antropometria';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $system_users;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('data_pesquisa');
        parent::addAttribute('estatura');
        parent::addAttribute('estatura_sentado');
        parent::addAttribute('membro_inferior');
        parent::addAttribute('envergadura');
        parent::addAttribute('massa_corporal');
        parent::addAttribute('imc');
        parent::addAttribute('diametro_u');
        parent::addAttribute('diametro_f');
        parent::addAttribute('c_abdominal');
        parent::addAttribute('c_quadril');
        parent::addAttribute('c_cintura');
        parent::addAttribute('dc_subescapular');
        parent::addAttribute('dc_triciptal');
        parent::addAttribute('dc_panturrilha_medial');
        parent::addAttribute('dc_suprailiaca');
        parent::addAttribute('dc_biceps');
        parent::addAttribute('dc_abdominal');
        parent::addAttribute('pas');
        parent::addAttribute('pad');
        parent::addAttribute('fc');
        parent::addAttribute('observacoes');
        parent::addAttribute('status_cadastro');
        parent::addAttribute('system_users_id');
        parent::addAttribute('active');
        parent::addAttribute('din_direito');
        parent::addAttribute('din_esquerdo');
        parent::addAttribute('lado_predominante');
        parent::addAttribute('d_escapular');
        parent::addAttribute('d_lombar');
        parent::addAttribute('flexibilidade');
        parent::addAttribute('salto_vertical');
        parent::addAttribute('gordura_corporal');
            
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

