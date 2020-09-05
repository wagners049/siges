<?php

class SigesCidades extends TRecord
{
    const TABLENAME  = 'siges_cidades';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $siges_estados;
    private $siges_regioes_esportivas;
    private $siges_mesorregiao;
    private $siges_microrregiao;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('codigo_cidade');
        parent::addAttribute('codigo_siges');
        parent::addAttribute('municipio');
        parent::addAttribute('siges_estados_id');
        parent::addAttribute('siges_regioes_esportivas_id');
        parent::addAttribute('active');
        parent::addAttribute('gentilico');
        parent::addAttribute('prefeito');
        parent::addAttribute('populacao');
        parent::addAttribute('area_territorial');
        parent::addAttribute('pib');
        parent::addAttribute('mapa');
        parent::addAttribute('brasao');
        parent::addAttribute('bandeira');
        parent::addAttribute('siges_mesorregiao_id');
        parent::addAttribute('siges_microrregiao_id');
            
    }

    /**
     * Method set_siges_estados
     * Sample of usage: $var->siges_estados = $object;
     * @param $object Instance of SigesEstados
     */
    public function set_siges_estados(SigesEstados $object)
    {
        $this->siges_estados = $object;
        $this->siges_estados_id = $object->id;
    }

    /**
     * Method get_siges_estados
     * Sample of usage: $var->siges_estados->attribute;
     * @returns SigesEstados instance
     */
    public function get_siges_estados()
    {
    
        // loads the associated object
        if (empty($this->siges_estados))
            $this->siges_estados = new SigesEstados($this->siges_estados_id);
    
        // returns the associated object
        return $this->siges_estados;
    }
    /**
     * Method set_siges_regioes_esportivas
     * Sample of usage: $var->siges_regioes_esportivas = $object;
     * @param $object Instance of SigesRegioesEsportivas
     */
    public function set_siges_regioes_esportivas(SigesRegioesEsportivas $object)
    {
        $this->siges_regioes_esportivas = $object;
        $this->siges_regioes_esportivas_id = $object->id;
    }

    /**
     * Method get_siges_regioes_esportivas
     * Sample of usage: $var->siges_regioes_esportivas->attribute;
     * @returns SigesRegioesEsportivas instance
     */
    public function get_siges_regioes_esportivas()
    {
    
        // loads the associated object
        if (empty($this->siges_regioes_esportivas))
            $this->siges_regioes_esportivas = new SigesRegioesEsportivas($this->siges_regioes_esportivas_id);
    
        // returns the associated object
        return $this->siges_regioes_esportivas;
    }
    /**
     * Method set_siges_mesorregiao
     * Sample of usage: $var->siges_mesorregiao = $object;
     * @param $object Instance of SigesMesorregiao
     */
    public function set_siges_mesorregiao(SigesMesorregiao $object)
    {
        $this->siges_mesorregiao = $object;
        $this->siges_mesorregiao_id = $object->id;
    }

    /**
     * Method get_siges_mesorregiao
     * Sample of usage: $var->siges_mesorregiao->attribute;
     * @returns SigesMesorregiao instance
     */
    public function get_siges_mesorregiao()
    {
    
        // loads the associated object
        if (empty($this->siges_mesorregiao))
            $this->siges_mesorregiao = new SigesMesorregiao($this->siges_mesorregiao_id);
    
        // returns the associated object
        return $this->siges_mesorregiao;
    }
    /**
     * Method set_siges_microrregiao
     * Sample of usage: $var->siges_microrregiao = $object;
     * @param $object Instance of SigesMicrorregiao
     */
    public function set_siges_microrregiao(SigesMicrorregiao $object)
    {
        $this->siges_microrregiao = $object;
        $this->siges_microrregiao_id = $object->id;
    }

    /**
     * Method get_siges_microrregiao
     * Sample of usage: $var->siges_microrregiao->attribute;
     * @returns SigesMicrorregiao instance
     */
    public function get_siges_microrregiao()
    {
    
        // loads the associated object
        if (empty($this->siges_microrregiao))
            $this->siges_microrregiao = new SigesMicrorregiao($this->siges_microrregiao_id);
    
        // returns the associated object
        return $this->siges_microrregiao;
    }

    /**
     * Method getSigesInstituicaos
     */
    public function getSigesInstituicaos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('siges_cidades_id', '=', $this->id));
        return SigesInstituicao::getObjects( $criteria );
    }
    /**
     * Method getSigesCidadesIdhs
     */
    public function getSigesCidadesIdhs()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('siges_cidades_id', '=', $this->id));
        return SigesCidadesIdh::getObjects( $criteria );
    }

    
}

