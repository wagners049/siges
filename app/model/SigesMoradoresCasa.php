<?php

class SigesMoradoresCasa extends TRecord
{
    const TABLENAME  = 'siges_moradores_casa';
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

    
}

