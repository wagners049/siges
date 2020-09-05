<?php

class SigesQuestionarios extends TRecord
{
    const TABLENAME  = 'siges_questionarios';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $siges_pesquisas;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('siges_pesquisas_id');
        parent::addAttribute('questoes');
        parent::addAttribute('tipo');
            
    }

    /**
     * Method set_siges_pesquisas
     * Sample of usage: $var->siges_pesquisas = $object;
     * @param $object Instance of SigesPesquisas
     */
    public function set_siges_pesquisas(SigesPesquisas $object)
    {
        $this->siges_pesquisas = $object;
        $this->siges_pesquisas_id = $object->id;
    }

    /**
     * Method get_siges_pesquisas
     * Sample of usage: $var->siges_pesquisas->attribute;
     * @returns SigesPesquisas instance
     */
    public function get_siges_pesquisas()
    {
    
        // loads the associated object
        if (empty($this->siges_pesquisas))
            $this->siges_pesquisas = new SigesPesquisas($this->siges_pesquisas_id);
    
        // returns the associated object
        return $this->siges_pesquisas;
    }

    
}

