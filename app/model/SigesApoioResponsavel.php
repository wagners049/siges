<?php

class SigesApoioResponsavel extends TRecord
{
    const TABLENAME  = 'siges_apoio_responsavel';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('opcoes');
            
    }

    
}

