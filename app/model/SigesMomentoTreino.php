<?php

class SigesMomentoTreino extends TRecord
{
    const TABLENAME  = 'siges_momento_treino';
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

