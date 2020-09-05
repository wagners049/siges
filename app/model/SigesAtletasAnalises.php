<?php

class SigesAtletasAnalises extends TRecord
{
    const TABLENAME  = 'siges_atletas_analises';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $system_users;
    private $siges_categoriaade;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('ano_inicio');
        parent::addAttribute('menarca');
        parent::addAttribute('menarca_data');
        parent::addAttribute('menarca_idade');
        parent::addAttribute('treino_avaliacao');
        parent::addAttribute('treino_avaliacao_quais');
        parent::addAttribute('observacoes');
        parent::addAttribute('problema_saude');
        parent::addAttribute('problema_saude_quais');
        parent::addAttribute('afastado_treino');
        parent::addAttribute('afastado_treino_lesao');
        parent::addAttribute('afastado_treino_tempo');
        parent::addAttribute('presenciou_trote');
        parent::addAttribute('presenciou_trotes_quais');
        parent::addAttribute('status_cadastro');
        parent::addAttribute('system_users_id');
        parent::addAttribute('data_analise');
        parent::addAttribute('active');
        parent::addAttribute('treino_semana');
        parent::addAttribute('duracao_treino');
        parent::addAttribute('ultimo_jogo');
        parent::addAttribute('ultimo_jogo_jogou');
        parent::addAttribute('ultimo_jogo_tempo');
        parent::addAttribute('siges_categoria_idade_id');
            
    }

    /**
     * Method set_system_users
     * Sample of usage: $var->system_users = $object;
     * @param $object Instance of SystemUsers
     */
    public function set_system_users(SystemUsers $object)
    {
        $this->system_users = $object;
        $this->system_users_id = $object->id;
    }

    /**
     * Method get_system_users
     * Sample of usage: $var->system_users->attribute;
     * @returns SystemUsers instance
     */
    public function get_system_users()
    {
    
        // loads the associated object
        if (empty($this->system_users))
            $this->system_users = new SystemUsers($this->system_users_id);
    
        // returns the associated object
        return $this->system_users;
    }
    /**
     * Method set_siges_categoria_idade
     * Sample of usage: $var->siges_categoria_idade = $object;
     * @param $object Instance of SigesCategoriaIdade
     */
    public function set_siges_categoriaade(SigesCategoriaIdade $object)
    {
        $this->siges_categoriaade = $object;
        $this->siges_categoria_idade_id = $object->id;
    }

    /**
     * Method get_siges_categoriaade
     * Sample of usage: $var->siges_categoriaade->attribute;
     * @returns SigesCategoriaIdade instance
     */
    public function get_siges_categoriaade()
    {
    
        // loads the associated object
        if (empty($this->siges_categoriaade))
            $this->siges_categoriaade = new SigesCategoriaIdade($this->siges_categoria_idade_id);
    
        // returns the associated object
        return $this->siges_categoriaade;
    }

    
}

