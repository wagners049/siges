PRAGMA foreign_keys=OFF; 

CREATE TABLE siges_alternativas( 
      id  INTEGER    NOT NULL  , 
      valor_alternativa varchar  (10)   , 
      alternativa varchar  (255)   , 
      siges_pesquisas_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(siges_pesquisas_id) REFERENCES siges_pesquisas(id)) ; 

CREATE TABLE siges_apoio_bolsa( 
      id  INTEGER    NOT NULL  , 
      opcao varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_apoio_responsavel( 
      id  INTEGER    NOT NULL  , 
      opcoes varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_atleta_pesquisa( 
      id  INTEGER    NOT NULL  , 
      siges_pesquisas_id int   NOT NULL  , 
      resposta text   , 
      system_users_id int   NOT NULL  , 
      data_pesquisa date   , 
 PRIMARY KEY (id),
FOREIGN KEY(siges_pesquisas_id) REFERENCES siges_pesquisas(id),
FOREIGN KEY(system_users_id) REFERENCES system_users(id)) ; 

CREATE TABLE siges_atletas_analises( 
      id  INTEGER    NOT NULL  , 
      ano_inicio date   , 
      menarca date   , 
      menarca_idate varchar  (255)   , 
      treino_avaliacao char  (1)   , 
      treino_avaliacao_quais text   , 
      observacoes text   , 
      problema_saude char  (1)   , 
      problema_saude_quais text   , 
      afastado_treino char  (1)   , 
      afastado_treino_lesao text   , 
      afastado_treino_tempo varchar  (255)   , 
      presenciou_trote char  (1)   , 
      presenciou_trotes_quais text   , 
      status_cadastro char  (1)   NOT NULL    DEFAULT 'N', 
      system_users_id int   NOT NULL  , 
      data_analise date   , 
      active char  (1)   NOT NULL    DEFAULT 'Y', 
 PRIMARY KEY (id),
FOREIGN KEY(system_users_id) REFERENCES system_users(id)) ; 

CREATE TABLE siges_atletas_antropometria( 
      id  INTEGER    NOT NULL  , 
      data_pesquisa date   , 
      estatura double   , 
      envergadura double   , 
      massa_corporal double   , 
      imc double   , 
      diametro_u double   , 
      diametro_f double   , 
      c_abdominal double   , 
      c_quadril double   , 
      c_cintura double   , 
      dc_subescapular double   , 
      dc_triciptal double   , 
      dc_panturrilha_medial double   , 
      dc_suprailiaca double   , 
      dc_biceps double   , 
      dc_abdominal double   , 
      pas double   , 
      pad double   , 
      fc double   , 
      observacoes text   , 
      status_cadastro char  (1)   NOT NULL    DEFAULT 'N', 
      system_users_id int   NOT NULL  , 
      active char  (1)   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_users_id) REFERENCES system_users(id)) ; 

CREATE TABLE siges_atletas_modalidades( 
      id  INTEGER    NOT NULL  , 
      siges_modalidades_id int   NOT NULL  , 
      system_users_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(siges_modalidades_id) REFERENCES siges_modalidades(id),
FOREIGN KEY(system_users_id) REFERENCES system_users(id)) ; 

CREATE TABLE siges_cidades( 
      id  INTEGER    NOT NULL  , 
      codigo_cidade varchar  (7)   NOT NULL  , 
      codigo_siges varchar  (3)   , 
      municipio varchar  (40)   NOT NULL  , 
      siges_estados_id int   NOT NULL  , 
      siges_regioes_esportivas_id int   NOT NULL  , 
      active char   NOT NULL  , 
      gentilico varchar  (255)   , 
      prefeito varchar  (255)   , 
      populacao int  (11)   , 
      area_territorial double   , 
      pib int   , 
      mapa varchar  (255)   , 
      brasao varchar  (255)   , 
      bandeira varchar  (255)   , 
      siges_mesorregiao_id int   NOT NULL  , 
      siges_microrregiao_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(siges_estados_id) REFERENCES siges_estados(id),
FOREIGN KEY(siges_regioes_esportivas_id) REFERENCES siges_regioes_esportivas(id),
FOREIGN KEY(siges_mesorregiao_id) REFERENCES siges_mesorregiao(id),
FOREIGN KEY(siges_microrregiao_id) REFERENCES siges_microrregiao(id)) ; 

CREATE TABLE siges_cidades_idh( 
      id  INTEGER    NOT NULL  , 
      siges_cidades_id int   NOT NULL  , 
      ano varchar  (4)   NOT NULL  , 
      idhm double   , 
      idhm_renda double   , 
      idhm_long double   , 
      idhm_educacao double   , 
 PRIMARY KEY (id),
FOREIGN KEY(siges_cidades_id) REFERENCES siges_cidades(id)) ; 

CREATE TABLE siges_contato_instituicao( 
      id  INTEGER    NOT NULL  , 
      siges_tipo_contato_id int   NOT NULL  , 
      info_contato varchar  (255)   NOT NULL  , 
      siges_instituicao_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(siges_tipo_contato_id) REFERENCES siges_tipo_contato(id),
FOREIGN KEY(siges_instituicao_id) REFERENCES siges_instituicao(id)) ; 

CREATE TABLE siges_contato_users( 
      id  INTEGER    NOT NULL  , 
      info_contato varchar  (255)   NOT NULL  , 
      system_users_id int   NOT NULL  , 
      siges_tipo_contato_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_users_id) REFERENCES system_users(id),
FOREIGN KEY(siges_tipo_contato_id) REFERENCES siges_tipo_contato(id)) ; 

CREATE TABLE siges_dificuldades( 
      id  INTEGER    NOT NULL  , 
      opcoes varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_espaco_treino( 
      id  INTEGER    NOT NULL  , 
      opcoes varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_estados( 
      id  INTEGER    NOT NULL  , 
      codigo_estado varchar  (2)   NOT NULL  , 
      sigla varchar  (2)   NOT NULL  , 
      estado varchar  (25)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_faixa_idh( 
      id  INTEGER    NOT NULL  , 
      faixa varchar  (20)   NOT NULL  , 
      classificacao int  (3)   NOT NULL  , 
      limite_inferior double   , 
      limite_superior double   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_ideb( 
      id  INTEGER    NOT NULL  , 
      siges_instituicao_id int   NOT NULL  , 
      siges_tipo_serie_id int   NOT NULL  , 
      ano_ref varchar  (4)   NOT NULL  , 
      ideb double   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(siges_instituicao_id) REFERENCES siges_instituicao(id),
FOREIGN KEY(siges_tipo_serie_id) REFERENCES siges_tipo_serie(id)) ; 

CREATE TABLE siges_instituicao( 
      id  INTEGER    NOT NULL  , 
      codigo_instituicao varchar  (15)   , 
      cnpj varchar  (31)   , 
      instituicao_ensino varchar  (255)   NOT NULL  , 
      endereco varchar  (255)   , 
      complemento varchar  (255)   , 
      cep varchar  (10)   , 
      status char  (1)   , 
      siges_cidades_id int   NOT NULL  , 
      siges_tipos_instituicao_id int   NOT NULL  , 
      responsavel varchar  (255)   , 
      alunos_matriculados_ef int  (11)   , 
      alunos_matriculados_em int  (11)   , 
 PRIMARY KEY (id),
FOREIGN KEY(siges_cidades_id) REFERENCES siges_cidades(id),
FOREIGN KEY(siges_tipos_instituicao_id) REFERENCES siges_tipos_instituicao(id)) ; 

CREATE TABLE siges_mesorregiao( 
      id  INTEGER    NOT NULL  , 
      siges_estados_id int   NOT NULL  , 
      codigo int  (11)   NOT NULL  , 
      mesorregiao varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(siges_estados_id) REFERENCES siges_estados(id)) ; 

CREATE TABLE siges_microrregiao( 
      id  INTEGER    NOT NULL  , 
      siges_estados_id int   NOT NULL  , 
      codigo int  (11)   NOT NULL  , 
      microrregiao varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(siges_estados_id) REFERENCES siges_estados(id)) ; 

CREATE TABLE siges_modalidades( 
      id  INTEGER    NOT NULL  , 
      modalidade varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_momento_treino( 
      id  INTEGER    NOT NULL  , 
      opcoes varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_moradores_casa( 
      id  INTEGER    NOT NULL  , 
      tipo varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_nivel_escolariade( 
      id  INTEGER    NOT NULL  , 
      nivel_escolaridade varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_participa_outras_competicoes( 
      id  INTEGER    NOT NULL  , 
      opcoes varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_pesquisas( 
      id  INTEGER    NOT NULL  , 
      titulo varchar  (255)   , 
      subtitulo varchar  (255)   , 
      instrucoes text   , 
      data_criacao date   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_questionarios( 
      id  INTEGER    NOT NULL  , 
      siges_pesquisas_id int   NOT NULL  , 
      questoes text   , 
      tipo varchar  (255)   , 
 PRIMARY KEY (id),
FOREIGN KEY(siges_pesquisas_id) REFERENCES siges_pesquisas(id)) ; 

CREATE TABLE siges_raca( 
      id  INTEGER    NOT NULL  , 
      raca varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_regioes_esportivas( 
      id  INTEGER    NOT NULL  , 
      siges_estados_id int   NOT NULL  , 
      nr_regiao int  (3)   NOT NULL  , 
      regiao varchar  (25)   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(siges_estados_id) REFERENCES siges_estados(id)) ; 

CREATE TABLE siges_responsaveis_competicoes( 
      id  INTEGER    NOT NULL  , 
      opcoes varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_serie_escolar( 
      id  INTEGER    NOT NULL  , 
      nivel varchar  (255)   NOT NULL  , 
      serie varchar  (255)   NOT NULL  , 
      idade varchar  (255)   NOT NULL  , 
      active char  (1)   NOT NULL    DEFAULT 'Y', 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_sociodemografico( 
      id  INTEGER    NOT NULL  , 
      system_users_id int   NOT NULL  , 
      siges_tipos_instituicao_id int   NOT NULL  , 
      siges_zona_municipio_id int   NOT NULL  , 
      siges_raca_id int   NOT NULL  , 
      siges_serie_escolar_id int   NOT NULL  , 
      siges_tipo_moradia_id int   NOT NULL  , 
      pessoas_residencia int  (11)   NOT NULL  , 
      siges_moradores_casa_id varchar  (255)   NOT NULL  , 
      siges_nivel_escolariade_mae_id int   NOT NULL  , 
      siges_nivel_escolariade_pai_id int   NOT NULL  , 
      siges_responsaveis_competicoes_id varchar  (255)   NOT NULL  , 
      participa_aula_ef char  (1)   NOT NULL  , 
      participa_aula_ef_sim varchar  (255)   , 
      participa_aula_ef_nao text   , 
      participa_outras_atividades char  (1)   NOT NULL  , 
      participa_outras_atividades_sim text   , 
      siges_tempo_competicoes_id int   NOT NULL  , 
      treina_outra_modalidade char  (1)   NOT NULL  , 
      treina_outra_modalidade_qual varchar  (255)   , 
      treina_outra_modalidade_quantidade varchar  (255)   , 
      treina_outra_modalidade_duracao varchar  (255)   , 
      siges_participa_outras_competicoes_id int   NOT NULL  , 
      siges_apoio_bolsa_id varchar  (255)   NOT NULL  , 
      siges_apoio_bolsa_outros text   , 
      participacao_outros text   NOT NULL  , 
      siges_espaco_treino_id varchar  (255)   NOT NULL  , 
      siges_espaco_treino_outros text   , 
      siges_momento_treino_id int   NOT NULL  , 
      siges_dificuldades_id varchar  (255)   NOT NULL  , 
      siges_dificuldades_outros text   , 
      siges_espaco_treino_comunidade_id varchar  (255)   NOT NULL  , 
      siges_espaco_treino_comunidade_outros varchar  (255)   , 
      siges_apoio_responsavel_id varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_users_id) REFERENCES system_users(id)) ; 

CREATE TABLE siges_tempo_competicoes( 
      id  INTEGER    NOT NULL  , 
      opcoes varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_tipo_contato( 
      id  INTEGER    NOT NULL  , 
      tipo varchar  (100)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_tipo_moradia( 
      id  INTEGER    NOT NULL  , 
      tipo varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_tipo_serie( 
      id  INTEGER    NOT NULL  , 
      tipo varchar  (255)   NOT NULL  , 
      sigla varchar  (2)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_tipos_instituicao( 
      id  INTEGER    NOT NULL  , 
      tipo_instituicao varchar  (100)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_zona_municipio( 
      id  INTEGER    NOT NULL  , 
      tipo varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_document( 
      id  INTEGER    NOT NULL  , 
      category_id int   NOT NULL  , 
      title text   NOT NULL  , 
      description date   , 
      submission_date date   , 
      archive_date date   , 
      filename text   , 
 PRIMARY KEY (id),
FOREIGN KEY(category_id) REFERENCES system_document_category(id)) ; 

CREATE TABLE system_document_category( 
      id  INTEGER    NOT NULL  , 
      name text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_document_group( 
      id  INTEGER    NOT NULL  , 
      document_id int   NOT NULL  , 
      system_group_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(document_id) REFERENCES system_document(id),
FOREIGN KEY(system_group_id) REFERENCES system_group(id)) ; 

CREATE TABLE system_document_user( 
      system_document_id int   NOT NULL  , 
      id  INTEGER    NOT NULL  , 
      system_user_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_document_id) REFERENCES system_document(id),
FOREIGN KEY(system_user_id) REFERENCES system_users(id)) ; 

CREATE TABLE system_group( 
      id  INTEGER    NOT NULL  , 
      name text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group_program( 
      id  INTEGER    NOT NULL  , 
      system_group_id int   NOT NULL  , 
      system_program_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_group_id) REFERENCES system_group(id),
FOREIGN KEY(system_program_id) REFERENCES system_program(id)) ; 

CREATE TABLE system_message( 
      id  INTEGER    NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_user_to_id int   NOT NULL  , 
      subject text   NOT NULL  , 
      message text   , 
      dt_message date   , 
      checked char  (1)   , 
 PRIMARY KEY (id),
FOREIGN KEY(system_user_id) REFERENCES system_users(id),
FOREIGN KEY(system_user_to_id) REFERENCES system_users(id)) ; 

CREATE TABLE system_notification( 
      id  INTEGER    NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_user_to_id int   NOT NULL  , 
      subject text   , 
      message text   , 
      dt_message date   , 
      action_url text   , 
      action_label text   , 
      icon text   , 
      checked char  (1)   , 
 PRIMARY KEY (id),
FOREIGN KEY(system_user_id) REFERENCES system_users(id),
FOREIGN KEY(system_user_to_id) REFERENCES system_users(id)) ; 

CREATE TABLE system_preference( 
      id text   NOT NULL  , 
      preference text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_program( 
      id  INTEGER    NOT NULL  , 
      name text   NOT NULL  , 
      controller text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_unit( 
      id  INTEGER    NOT NULL  , 
      name text   NOT NULL  , 
      siges_cidades_id int   , 
 PRIMARY KEY (id),
FOREIGN KEY(siges_cidades_id) REFERENCES siges_cidades(id)) ; 

CREATE TABLE system_user_group( 
      id  INTEGER    NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_group_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_user_id) REFERENCES system_users(id),
FOREIGN KEY(system_group_id) REFERENCES system_group(id)) ; 

CREATE TABLE system_user_program( 
      id  INTEGER    NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_program_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_user_id) REFERENCES system_users(id),
FOREIGN KEY(system_program_id) REFERENCES system_program(id)) ; 

CREATE TABLE system_users( 
      id  INTEGER    NOT NULL  , 
      name text   NOT NULL  , 
      login text   NOT NULL  , 
      password text   NOT NULL  , 
      email text   , 
      frontpage_id int   , 
      system_unit_id int   , 
      active char  (1)   , 
      cpf varchar  (14)   NOT NULL  , 
      genero char  (1)   , 
      nascimento date   , 
      siges_instituicao_id int   , 
      observacoes text   , 
 PRIMARY KEY (id),
FOREIGN KEY(frontpage_id) REFERENCES system_program(id),
FOREIGN KEY(system_unit_id) REFERENCES system_unit(id),
FOREIGN KEY(siges_instituicao_id) REFERENCES siges_instituicao(id)) ; 

CREATE TABLE system_user_unit( 
      id  INTEGER    NOT NULL  , 
      system_user_id int   NOT NULL  , 
      system_unit_id int   NOT NULL  , 
 PRIMARY KEY (id),
FOREIGN KEY(system_unit_id) REFERENCES system_unit(id),
FOREIGN KEY(system_user_id) REFERENCES system_users(id)) ; 

 
 CREATE UNIQUE INDEX idx_siges_cidades_codigo_cidade ON siges_cidades(codigo_cidade);
 CREATE UNIQUE INDEX idx_siges_estados_codigo_estado ON siges_estados(codigo_estado);
 CREATE UNIQUE INDEX idx_siges_estados_sigla ON siges_estados(sigla);
 CREATE UNIQUE INDEX idx_siges_estados_estado ON siges_estados(estado);
 CREATE UNIQUE INDEX idx_siges_tipo_contato_tipo ON siges_tipo_contato(tipo);
 CREATE UNIQUE INDEX idx_system_users_cpf ON system_users(cpf);
 
  
