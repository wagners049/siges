<?php

class SigesTipoContato extends TRecord
{
    const TABLENAME  = 'siges_tipo_contato';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('tipo');
            
    }

    /**
     * Method getSigesContatoInstituicaos
     */
    public function getSigesContatoInstituicaos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('siges_tipo_contato_id', '=', $this->id));
        return SigesContatoInstituicao::getObjects( $criteria );
    }
    /**
     * Method getSigesContatoUserss
     */
    public function getSigesContatoUserss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('siges_tipo_contato_id', '=', $this->id));
        return SigesContatoUsers::getObjects( $criteria );
    }

    
}

