<?php

class SigesParticipaOutrasCompeticoes extends TRecord
{
    const TABLENAME  = 'siges_participa_outras_competicoes';
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

