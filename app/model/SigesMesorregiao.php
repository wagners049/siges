<?php

class SigesMesorregiao extends TRecord
{
    const TABLENAME  = 'siges_mesorregiao';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $siges_estados;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('siges_estados_id');
        parent::addAttribute('codigo');
        parent::addAttribute('mesorregiao');
            
    }

    /**
     * Method set_siges_estados
     * Sample of usage: $var->siges_estados = $object;
     * @param $object Instance of SigesEstados
     */
    public function set_siges_estados(SigesEstados $object)
    {
        $this->siges_estados = $object;
        $this->siges_estados_id = $object->id;
    }

    /**
     * Method get_siges_estados
     * Sample of usage: $var->siges_estados->attribute;
     * @returns SigesEstados instance
     */
    public function get_siges_estados()
    {
    
        // loads the associated object
        if (empty($this->siges_estados))
            $this->siges_estados = new SigesEstados($this->siges_estados_id);
    
        // returns the associated object
        return $this->siges_estados;
    }

    /**
     * Method getSigesCidadess
     */
    public function getSigesCidadess()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('siges_mesorregiao_id', '=', $this->id));
        return SigesCidades::getObjects( $criteria );
    }

    
}

