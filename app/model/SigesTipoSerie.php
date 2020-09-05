<?php

class SigesTipoSerie extends TRecord
{
    const TABLENAME  = 'siges_tipo_serie';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('tipo');
        parent::addAttribute('sigla');
            
    }

    /**
     * Method getSigesIdebs
     */
    public function getSigesIdebs()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('siges_tipo_serie_id', '=', $this->id));
        return SigesIdeb::getObjects( $criteria );
    }

    
}

