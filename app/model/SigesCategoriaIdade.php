<?php

class SigesCategoriaIdade extends TRecord
{
    const TABLENAME  = 'siges_categoria_idade';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('tipo');
        parent::addAttribute('descricao');
            
    }

    /**
     * Method getSigesAtletasAnalisess
     */
    public function getSigesAtletasAnalisess()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('siges_categoria_idade_id', '=', $this->id));
        return SigesAtletasAnalises::getObjects( $criteria );
    }

    
}

