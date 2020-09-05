<?php

class SigesInstituicao extends TRecord
{
    const TABLENAME  = 'siges_instituicao';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $siges_cidades;
    private $siges_tipos_instituicao;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('codigo_instituicao');
        parent::addAttribute('cnpj');
        parent::addAttribute('instituicao_ensino');
        parent::addAttribute('endereco');
        parent::addAttribute('complemento');
        parent::addAttribute('cep');
        parent::addAttribute('status');
        parent::addAttribute('siges_cidades_id');
        parent::addAttribute('siges_tipos_instituicao_id');
        parent::addAttribute('responsavel');
        parent::addAttribute('alunos_matriculados_ef');
        parent::addAttribute('alunos_matriculados_em');
            
    }

    /**
     * Method set_siges_cidades
     * Sample of usage: $var->siges_cidades = $object;
     * @param $object Instance of SigesCidades
     */
    public function set_siges_cidades(SigesCidades $object)
    {
        $this->siges_cidades = $object;
        $this->siges_cidades_id = $object->id;
    }

    /**
     * Method get_siges_cidades
     * Sample of usage: $var->siges_cidades->attribute;
     * @returns SigesCidades instance
     */
    public function get_siges_cidades()
    {
    
        // loads the associated object
        if (empty($this->siges_cidades))
            $this->siges_cidades = new SigesCidades($this->siges_cidades_id);
    
        // returns the associated object
        return $this->siges_cidades;
    }
    /**
     * Method set_siges_tipos_instituicao
     * Sample of usage: $var->siges_tipos_instituicao = $object;
     * @param $object Instance of SigesTiposInstituicao
     */
    public function set_siges_tipos_instituicao(SigesTiposInstituicao $object)
    {
        $this->siges_tipos_instituicao = $object;
        $this->siges_tipos_instituicao_id = $object->id;
    }

    /**
     * Method get_siges_tipos_instituicao
     * Sample of usage: $var->siges_tipos_instituicao->attribute;
     * @returns SigesTiposInstituicao instance
     */
    public function get_siges_tipos_instituicao()
    {
    
        // loads the associated object
        if (empty($this->siges_tipos_instituicao))
            $this->siges_tipos_instituicao = new SigesTiposInstituicao($this->siges_tipos_instituicao_id);
    
        // returns the associated object
        return $this->siges_tipos_instituicao;
    }

    /**
     * Method getSigesContatoInstituicaos
     */
    public function getSigesContatoInstituicaos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('siges_instituicao_id', '=', $this->id));
        return SigesContatoInstituicao::getObjects( $criteria );
    }
    /**
     * Method getSigesIdebs
     */
    public function getSigesIdebs()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('siges_instituicao_id', '=', $this->id));
        return SigesIdeb::getObjects( $criteria );
    }

    
}

