<?php

class SigesSerieEscolar extends TRecord
{
    const TABLENAME  = 'siges_serie_escolar';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nivel');
        parent::addAttribute('serie');
        parent::addAttribute('idade');
        parent::addAttribute('active');
            
    }

    
}

