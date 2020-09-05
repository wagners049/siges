<?php

class SystemUnit extends TRecord
{
    const TABLENAME  = 'system_unit';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $siges_cidades;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('name');
        parent::addAttribute('siges_cidades_id');
            
    }

    /**
     * Method set_siges_cidades
     * Sample of usage: $var->siges_cidades = $object;
     * @param $object Instance of SigesCidades
     */
    public function set_siges_cidades(SigesCidades $object)
    {
        $this->siges_cidades = $object;
        $this->siges_cidades_id = $object->id;
    }

    /**
     * Method get_siges_cidades
     * Sample of usage: $var->siges_cidades->attribute;
     * @returns SigesCidades instance
     */
    public function get_siges_cidades()
    {
    
        // loads the associated object
        if (empty($this->siges_cidades))
            $this->siges_cidades = new SigesCidades($this->siges_cidades_id);
    
        // returns the associated object
        return $this->siges_cidades;
    }

    
}

