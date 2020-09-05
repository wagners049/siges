<?php

class SigesNivelEscolariade extends TRecord
{
    const TABLENAME  = 'siges_nivel_escolariade';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nivel_escolaridade');
            
    }

    
}

