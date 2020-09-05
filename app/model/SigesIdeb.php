<?php

class SigesIdeb extends TRecord
{
    const TABLENAME  = 'siges_ideb';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $siges_instituicao;
    private $siges_tipo_serie;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('siges_instituicao_id');
        parent::addAttribute('siges_tipo_serie_id');
        parent::addAttribute('ano_ref');
        parent::addAttribute('ideb');
            
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
    /**
     * Method set_siges_tipo_serie
     * Sample of usage: $var->siges_tipo_serie = $object;
     * @param $object Instance of SigesTipoSerie
     */
    public function set_siges_tipo_serie(SigesTipoSerie $object)
    {
        $this->siges_tipo_serie = $object;
        $this->siges_tipo_serie_id = $object->id;
    }

    /**
     * Method get_siges_tipo_serie
     * Sample of usage: $var->siges_tipo_serie->attribute;
     * @returns SigesTipoSerie instance
     */
    public function get_siges_tipo_serie()
    {
    
        // loads the associated object
        if (empty($this->siges_tipo_serie))
            $this->siges_tipo_serie = new SigesTipoSerie($this->siges_tipo_serie_id);
    
        // returns the associated object
        return $this->siges_tipo_serie;
    }

    
}

