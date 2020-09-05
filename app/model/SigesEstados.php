<?php

class SigesEstados extends TRecord
{
    const TABLENAME  = 'siges_estados';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('codigo_estado');
        parent::addAttribute('sigla');
        parent::addAttribute('estado');
            
    }

    /**
     * Method getSigesCidadess
     */
    public function getSigesCidadess()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('siges_estados_id', '=', $this->id));
        return SigesCidades::getObjects( $criteria );
    }
    /**
     * Method getSigesMesorregiaos
     */
    public function getSigesMesorregiaos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('siges_estados_id', '=', $this->id));
        return SigesMesorregiao::getObjects( $criteria );
    }
    /**
     * Method getSigesMicrorregiaos
     */
    public function getSigesMicrorregiaos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('siges_estados_id', '=', $this->id));
        return SigesMicrorregiao::getObjects( $criteria );
    }
    /**
     * Method getSigesRegioesEsportivass
     */
    public function getSigesRegioesEsportivass()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('siges_estados_id', '=', $this->id));
        return SigesRegioesEsportivas::getObjects( $criteria );
    }

    
}

