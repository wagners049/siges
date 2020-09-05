<?php

class SigesTiposInstituicao extends TRecord
{
    const TABLENAME  = 'siges_tipos_instituicao';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('tipo_instituicao');
            
    }

    /**
     * Method getSigesInstituicaos
     */
    public function getSigesInstituicaos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('siges_tipos_instituicao_id', '=', $this->id));
        return SigesInstituicao::getObjects( $criteria );
    }

    
}

