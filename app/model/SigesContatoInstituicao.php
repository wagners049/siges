<?php

class SigesContatoInstituicao extends TRecord
{
    const TABLENAME  = 'siges_contato_instituicao';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $siges_tipo_contato;
    private $siges_instituicao;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('siges_tipo_contato_id');
        parent::addAttribute('info_contato');
        parent::addAttribute('siges_instituicao_id');
            
    }

    /**
     * Method set_siges_tipo_contato
     * Sample of usage: $var->siges_tipo_contato = $object;
     * @param $object Instance of SigesTipoContato
     */
    public function set_siges_tipo_contato(SigesTipoContato $object)
    {
        $this->siges_tipo_contato = $object;
        $this->siges_tipo_contato_id = $object->id;
    }

    /**
     * Method get_siges_tipo_contato
     * Sample of usage: $var->siges_tipo_contato->attribute;
     * @returns SigesTipoContato instance
     */
    public function get_siges_tipo_contato()
    {
    
        // loads the associated object
        if (empty($this->siges_tipo_contato))
            $this->siges_tipo_contato = new SigesTipoContato($this->siges_tipo_contato_id);
    
        // returns the associated object
        return $this->siges_tipo_contato;
    }
    /**
     * Method set_siges_instituicao
     * Sample of usage: $var->siges_instituicao = $object;
     * @param $object Instance of SigesInstituicao
     */
    public function set_siges_instituicao(SigesInstituicao $object)
    {
        $this->siges_instituicao = $object;
        $this->siges_instituicao_id = $object->id;
    }

    /**
     * Method get_siges_instituicao
     * Sample of usage: $var->siges_instituicao->attribute;
     * @returns SigesInstituicao instance
     */
    public function get_siges_instituicao()
    {
    
        // loads the associated object
        if (empty($this->siges_instituicao))
            $this->siges_instituicao = new SigesInstituicao($this->siges_instituicao_id);
    
        // returns the associated object
        return $this->siges_instituicao;
    }

    
}

