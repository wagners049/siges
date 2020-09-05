<?php

class SigesPesquisas extends TRecord
{
    const TABLENAME  = 'siges_pesquisas';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('titulo');
        parent::addAttribute('subtitulo');
        parent::addAttribute('instrucoes');
        parent::addAttribute('data_criacao');
            
    }

    /**
     * Method getSigesAlternativass
     */
    public function getSigesAlternativass()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('siges_pesquisas_id', '=', $this->id));
        return SigesAlternativas::getObjects( $criteria );
    }
    /**
     * Method getSigesAtletaPesquisas
     */
    public function getSigesAtletaPesquisas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('siges_pesquisas_id', '=', $this->id));
        return SigesAtletaPesquisa::getObjects( $criteria );
    }
    /**
     * Method getSigesQuestionarioss
     */
    public function getSigesQuestionarioss()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('siges_pesquisas_id', '=', $this->id));
        return SigesQuestionarios::getObjects( $criteria );
    }

    
}

