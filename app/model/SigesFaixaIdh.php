<?php

class SigesFaixaIdh extends TRecord
{
    const TABLENAME  = 'siges_faixa_idh';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('faixa');
        parent::addAttribute('classificacao');
        parent::addAttribute('limite_inferior');
        parent::addAttribute('limite_superior');
            
    }

    
}

