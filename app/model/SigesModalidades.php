<?php

class SigesModalidades extends TRecord
{
    const TABLENAME  = 'siges_modalidades';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('modalidade');
            
    }

    /**
     * Method getSigesAtletasModalidadess
     */
    public function getSigesAtletasModalidadess()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('siges_modalidades_id', '=', $this->id));
        return SigesAtletasModalidades::getObjects( $criteria );
    }

    
}

