<?php

class SigesSociodemografico extends TRecord
{
    const TABLENAME  = 'siges_sociodemografico';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $system_users;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('system_users_id');
        parent::addAttribute('siges_tipos_instituicao_id');
        parent::addAttribute('siges_zona_municipio_id');
        parent::addAttribute('siges_raca_id');
        parent::addAttribute('siges_serie_escolar_id');
        parent::addAttribute('siges_tipo_moradia_id');
        parent::addAttribute('pessoas_residencia');
        parent::addAttribute('siges_moradores_casa_id');
        parent::addAttribute('siges_nivel_escolariade_mae_id');
        parent::addAttribute('siges_nivel_escolariade_pai_id');
        parent::addAttribute('siges_responsaveis_competicoes_id');
        parent::addAttribute('participa_aula_ef');
        parent::addAttribute('participa_aula_ef_sim');
        parent::addAttribute('participa_aula_ef_nao');
        parent::addAttribute('participa_outras_atividades');
        parent::addAttribute('participa_outras_atividades_sim');
        parent::addAttribute('siges_tempo_competicoes_id');
        parent::addAttribute('treina_outra_modalidade');
        parent::addAttribute('treina_outra_modalidade_qual');
        parent::addAttribute('treina_outra_modalidade_quantidade');
        parent::addAttribute('treina_outra_modalidade_duracao');
        parent::addAttribute('siges_participa_outras_competicoes_id');
        parent::addAttribute('siges_apoio_bolsa_id');
        parent::addAttribute('siges_apoio_bolsa_outros');
        parent::addAttribute('participacao_outros');
        parent::addAttribute('siges_espaco_treino_id');
        parent::addAttribute('siges_espaco_treino_outros');
        parent::addAttribute('siges_momento_treino_id');
        parent::addAttribute('siges_dificuldades_id');
        parent::addAttribute('siges_dificuldades_outros');
        parent::addAttribute('siges_espaco_treino_comunidade_id');
        parent::addAttribute('siges_espaco_treino_comunidade_outros');
        parent::addAttribute('siges_apoio_responsavel_id');
            
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

    
}

