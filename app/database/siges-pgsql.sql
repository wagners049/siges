CREATE TABLE siges_alternativas( 
      id  SERIAL    NOT NULL  , 
      valor_alternativa varchar  (10)   , 
      alternativa varchar  (255)   , 
      siges_pesquisas_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_apoio_bolsa( 
      id  SERIAL    NOT NULL  , 
      opcao varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_apoio_responsavel( 
      id  SERIAL    NOT NULL  , 
      opcoes varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_atleta_pesquisa( 
      id  SERIAL    NOT NULL  , 
      siges_pesquisas_id integer   NOT NULL  , 
      resposta text   , 
      system_users_id integer   NOT NULL  , 
      data_pesquisa date   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_atletas_analises( 
      id  SERIAL    NOT NULL  , 
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
      system_users_id integer   NOT NULL  , 
      data_analise date   , 
      active char  (1)   NOT NULL    DEFAULT 'Y', 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_atletas_antropometria( 
      id  SERIAL    NOT NULL  , 
      data_pesquisa date   , 
      estatura float   , 
      envergadura float   , 
      massa_corporal float   , 
      imc float   , 
      diametro_u float   , 
      diametro_f float   , 
      c_abdominal float   , 
      c_quadril float   , 
      c_cintura float   , 
      dc_subescapular float   , 
      dc_triciptal float   , 
      dc_panturrilha_medial float   , 
      dc_suprailiaca float   , 
      dc_biceps float   , 
      dc_abdominal float   , 
      pas float   , 
      pad float   , 
      fc float   , 
      observacoes text   , 
      status_cadastro char  (1)   NOT NULL    DEFAULT 'N', 
      system_users_id integer   NOT NULL  , 
      active char  (1)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_atletas_modalidades( 
      id  SERIAL    NOT NULL  , 
      siges_modalidades_id integer   NOT NULL  , 
      system_users_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_cidades( 
      id  SERIAL    NOT NULL  , 
      codigo_cidade varchar  (7)   NOT NULL  , 
      codigo_siges varchar  (3)   , 
      municipio varchar  (40)   NOT NULL  , 
      siges_estados_id integer   NOT NULL  , 
      siges_regioes_esportivas_id integer   NOT NULL  , 
      active char   NOT NULL  , 
      gentilico varchar  (255)   , 
      prefeito varchar  (255)   , 
      populacao integer   , 
      area_territorial float   , 
      pib integer   , 
      mapa varchar  (255)   , 
      brasao varchar  (255)   , 
      bandeira varchar  (255)   , 
      siges_mesorregiao_id integer   NOT NULL  , 
      siges_microrregiao_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_cidades_idh( 
      id  SERIAL    NOT NULL  , 
      siges_cidades_id integer   NOT NULL  , 
      ano varchar  (4)   NOT NULL  , 
      idhm float   , 
      idhm_renda float   , 
      idhm_long float   , 
      idhm_educacao float   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_contato_instituicao( 
      id  SERIAL    NOT NULL  , 
      siges_tipo_contato_id integer   NOT NULL  , 
      info_contato varchar  (255)   NOT NULL  , 
      siges_instituicao_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_contato_users( 
      id  SERIAL    NOT NULL  , 
      info_contato varchar  (255)   NOT NULL  , 
      system_users_id integer   NOT NULL  , 
      siges_tipo_contato_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_dificuldades( 
      id  SERIAL    NOT NULL  , 
      opcoes varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_espaco_treino( 
      id  SERIAL    NOT NULL  , 
      opcoes varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_estados( 
      id  SERIAL    NOT NULL  , 
      codigo_estado varchar  (2)   NOT NULL  , 
      sigla varchar  (2)   NOT NULL  , 
      estado varchar  (25)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_faixa_idh( 
      id  SERIAL    NOT NULL  , 
      faixa varchar  (20)   NOT NULL  , 
      classificacao integer   NOT NULL  , 
      limite_inferior float   , 
      limite_superior float   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_ideb( 
      id  SERIAL    NOT NULL  , 
      siges_instituicao_id integer   NOT NULL  , 
      siges_tipo_serie_id integer   NOT NULL  , 
      ano_ref varchar  (4)   NOT NULL  , 
      ideb float   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_instituicao( 
      id  SERIAL    NOT NULL  , 
      codigo_instituicao varchar  (15)   , 
      cnpj varchar  (31)   , 
      instituicao_ensino varchar  (255)   NOT NULL  , 
      endereco varchar  (255)   , 
      complemento varchar  (255)   , 
      cep varchar  (10)   , 
      status char  (1)   , 
      siges_cidades_id integer   NOT NULL  , 
      siges_tipos_instituicao_id integer   NOT NULL  , 
      responsavel varchar  (255)   , 
      alunos_matriculados_ef integer   , 
      alunos_matriculados_em integer   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_mesorregiao( 
      id  SERIAL    NOT NULL  , 
      siges_estados_id integer   NOT NULL  , 
      codigo integer   NOT NULL  , 
      mesorregiao varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_microrregiao( 
      id  SERIAL    NOT NULL  , 
      siges_estados_id integer   NOT NULL  , 
      codigo integer   NOT NULL  , 
      microrregiao varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_modalidades( 
      id  SERIAL    NOT NULL  , 
      modalidade varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_momento_treino( 
      id  SERIAL    NOT NULL  , 
      opcoes varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_moradores_casa( 
      id  SERIAL    NOT NULL  , 
      tipo varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_nivel_escolariade( 
      id  SERIAL    NOT NULL  , 
      nivel_escolaridade varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_participa_outras_competicoes( 
      id  SERIAL    NOT NULL  , 
      opcoes varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_pesquisas( 
      id  SERIAL    NOT NULL  , 
      titulo varchar  (255)   , 
      subtitulo varchar  (255)   , 
      instrucoes text   , 
      data_criacao date   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_questionarios( 
      id  SERIAL    NOT NULL  , 
      siges_pesquisas_id integer   NOT NULL  , 
      questoes text   , 
      tipo varchar  (255)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_raca( 
      id  SERIAL    NOT NULL  , 
      raca varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_regioes_esportivas( 
      id  SERIAL    NOT NULL  , 
      siges_estados_id integer   NOT NULL  , 
      nr_regiao integer   NOT NULL  , 
      regiao varchar  (25)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_responsaveis_competicoes( 
      id  SERIAL    NOT NULL  , 
      opcoes varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_serie_escolar( 
      id  SERIAL    NOT NULL  , 
      nivel varchar  (255)   NOT NULL  , 
      serie varchar  (255)   NOT NULL  , 
      idade varchar  (255)   NOT NULL  , 
      active char  (1)   NOT NULL    DEFAULT 'Y', 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_sociodemografico( 
      id  SERIAL    NOT NULL  , 
      system_users_id integer   NOT NULL  , 
      siges_tipos_instituicao_id integer   NOT NULL  , 
      siges_zona_municipio_id integer   NOT NULL  , 
      siges_raca_id integer   NOT NULL  , 
      siges_serie_escolar_id integer   NOT NULL  , 
      siges_tipo_moradia_id integer   NOT NULL  , 
      pessoas_residencia integer   NOT NULL  , 
      siges_moradores_casa_id varchar  (255)   NOT NULL  , 
      siges_nivel_escolariade_mae_id integer   NOT NULL  , 
      siges_nivel_escolariade_pai_id integer   NOT NULL  , 
      siges_responsaveis_competicoes_id varchar  (255)   NOT NULL  , 
      participa_aula_ef char  (1)   NOT NULL  , 
      participa_aula_ef_sim varchar  (255)   , 
      participa_aula_ef_nao text   , 
      participa_outras_atividades char  (1)   NOT NULL  , 
      participa_outras_atividades_sim text   , 
      siges_tempo_competicoes_id integer   NOT NULL  , 
      treina_outra_modalidade char  (1)   NOT NULL  , 
      treina_outra_modalidade_qual varchar  (255)   , 
      treina_outra_modalidade_quantidade varchar  (255)   , 
      treina_outra_modalidade_duracao varchar  (255)   , 
      siges_participa_outras_competicoes_id integer   NOT NULL  , 
      siges_apoio_bolsa_id varchar  (255)   NOT NULL  , 
      siges_apoio_bolsa_outros text   , 
      participacao_outros text   NOT NULL  , 
      siges_espaco_treino_id varchar  (255)   NOT NULL  , 
      siges_espaco_treino_outros text   , 
      siges_momento_treino_id integer   NOT NULL  , 
      siges_dificuldades_id varchar  (255)   NOT NULL  , 
      siges_dificuldades_outros text   , 
      siges_espaco_treino_comunidade_id varchar  (255)   NOT NULL  , 
      siges_espaco_treino_comunidade_outros varchar  (255)   , 
      siges_apoio_responsavel_id varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_tempo_competicoes( 
      id  SERIAL    NOT NULL  , 
      opcoes varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_tipo_contato( 
      id  SERIAL    NOT NULL  , 
      tipo varchar  (100)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_tipo_moradia( 
      id  SERIAL    NOT NULL  , 
      tipo varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_tipo_serie( 
      id  SERIAL    NOT NULL  , 
      tipo varchar  (255)   NOT NULL  , 
      sigla varchar  (2)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_tipos_instituicao( 
      id  SERIAL    NOT NULL  , 
      tipo_instituicao varchar  (100)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_zona_municipio( 
      id  SERIAL    NOT NULL  , 
      tipo varchar  (255)   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_document( 
      id  SERIAL    NOT NULL  , 
      category_id integer   NOT NULL  , 
      title text   NOT NULL  , 
      description date   , 
      submission_date date   , 
      archive_date date   , 
      filename text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_document_category( 
      id  SERIAL    NOT NULL  , 
      name text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_document_group( 
      id  SERIAL    NOT NULL  , 
      document_id integer   NOT NULL  , 
      system_group_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_document_user( 
      system_document_id integer   NOT NULL  , 
      id  SERIAL    NOT NULL  , 
      system_user_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group( 
      id  SERIAL    NOT NULL  , 
      name text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group_program( 
      id  SERIAL    NOT NULL  , 
      system_group_id integer   NOT NULL  , 
      system_program_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_message( 
      id  SERIAL    NOT NULL  , 
      system_user_id integer   NOT NULL  , 
      system_user_to_id integer   NOT NULL  , 
      subject text   NOT NULL  , 
      message text   , 
      dt_message date   , 
      checked char  (1)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_notification( 
      id  SERIAL    NOT NULL  , 
      system_user_id integer   NOT NULL  , 
      system_user_to_id integer   NOT NULL  , 
      subject text   , 
      message text   , 
      dt_message date   , 
      action_url text   , 
      action_label text   , 
      icon text   , 
      checked char  (1)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_preference( 
      id text   NOT NULL  , 
      preference text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_program( 
      id  SERIAL    NOT NULL  , 
      name text   NOT NULL  , 
      controller text   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_unit( 
      id  SERIAL    NOT NULL  , 
      name text   NOT NULL  , 
      siges_cidades_id integer   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_group( 
      id  SERIAL    NOT NULL  , 
      system_user_id integer   NOT NULL  , 
      system_group_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_program( 
      id  SERIAL    NOT NULL  , 
      system_user_id integer   NOT NULL  , 
      system_program_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_users( 
      id  SERIAL    NOT NULL  , 
      name text   NOT NULL  , 
      login text   NOT NULL  , 
      password text   NOT NULL  , 
      email text   , 
      frontpage_id integer   , 
      system_unit_id integer   , 
      active char  (1)   , 
      cpf varchar  (14)   NOT NULL  , 
      genero char  (1)   , 
      nascimento date   , 
      siges_instituicao_id integer   , 
      observacoes text   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_unit( 
      id  SERIAL    NOT NULL  , 
      system_user_id integer   NOT NULL  , 
      system_unit_id integer   NOT NULL  , 
 PRIMARY KEY (id)) ; 

 
 ALTER TABLE siges_cidades ADD UNIQUE (codigo_cidade);
 ALTER TABLE siges_estados ADD UNIQUE (codigo_estado);
 ALTER TABLE siges_estados ADD UNIQUE (sigla);
 ALTER TABLE siges_estados ADD UNIQUE (estado);
 ALTER TABLE siges_tipo_contato ADD UNIQUE (tipo);
 ALTER TABLE system_users ADD UNIQUE (cpf);
  
 ALTER TABLE siges_alternativas ADD CONSTRAINT fk_siges_alternativas_1 FOREIGN KEY (siges_pesquisas_id) references siges_pesquisas(id); 
ALTER TABLE siges_atleta_pesquisa ADD CONSTRAINT fk_siges_atleta_pesquisa_3 FOREIGN KEY (siges_pesquisas_id) references siges_pesquisas(id); 
ALTER TABLE siges_atleta_pesquisa ADD CONSTRAINT fk_siges_atleta_pesquisa_2 FOREIGN KEY (system_users_id) references system_users(id); 
ALTER TABLE siges_atletas_analises ADD CONSTRAINT fk_siges_atletas_analises_1 FOREIGN KEY (system_users_id) references system_users(id); 
ALTER TABLE siges_atletas_antropometria ADD CONSTRAINT fk_siges_atletas_antropometria_1 FOREIGN KEY (system_users_id) references system_users(id); 
ALTER TABLE siges_atletas_modalidades ADD CONSTRAINT fk_siges_atletas_modalidades_2 FOREIGN KEY (siges_modalidades_id) references siges_modalidades(id); 
ALTER TABLE siges_atletas_modalidades ADD CONSTRAINT fk_siges_atletas_modalidades_2 FOREIGN KEY (system_users_id) references system_users(id); 
ALTER TABLE siges_cidades ADD CONSTRAINT fk_siges_cidades_1 FOREIGN KEY (siges_estados_id) references siges_estados(id); 
ALTER TABLE siges_cidades ADD CONSTRAINT fk_siges_cidades_2 FOREIGN KEY (siges_regioes_esportivas_id) references siges_regioes_esportivas(id); 
ALTER TABLE siges_cidades ADD CONSTRAINT fk_siges_cidades_3 FOREIGN KEY (siges_mesorregiao_id) references siges_mesorregiao(id); 
ALTER TABLE siges_cidades ADD CONSTRAINT fk_siges_cidades_4 FOREIGN KEY (siges_microrregiao_id) references siges_microrregiao(id); 
ALTER TABLE siges_cidades_idh ADD CONSTRAINT fk_siges_cidades_idh_1 FOREIGN KEY (siges_cidades_id) references siges_cidades(id); 
ALTER TABLE siges_contato_instituicao ADD CONSTRAINT fk_siges_contato_1 FOREIGN KEY (siges_tipo_contato_id) references siges_tipo_contato(id); 
ALTER TABLE siges_contato_instituicao ADD CONSTRAINT fk_siges_contato_instituicao_2 FOREIGN KEY (siges_instituicao_id) references siges_instituicao(id); 
ALTER TABLE siges_contato_users ADD CONSTRAINT fk_siges_contato_users_1 FOREIGN KEY (system_users_id) references system_users(id); 
ALTER TABLE siges_contato_users ADD CONSTRAINT fk_siges_contato_users_2 FOREIGN KEY (siges_tipo_contato_id) references siges_tipo_contato(id); 
ALTER TABLE siges_ideb ADD CONSTRAINT fk_siges_ideb_1 FOREIGN KEY (siges_instituicao_id) references siges_instituicao(id); 
ALTER TABLE siges_ideb ADD CONSTRAINT fk_siges_ideb_2 FOREIGN KEY (siges_tipo_serie_id) references siges_tipo_serie(id); 
ALTER TABLE siges_instituicao ADD CONSTRAINT fk_siges_escolas_2 FOREIGN KEY (siges_cidades_id) references siges_cidades(id); 
ALTER TABLE siges_instituicao ADD CONSTRAINT fk_siges_escolas_2 FOREIGN KEY (siges_tipos_instituicao_id) references siges_tipos_instituicao(id); 
ALTER TABLE siges_mesorregiao ADD CONSTRAINT fk_siges_mesorregiao_1 FOREIGN KEY (siges_estados_id) references siges_estados(id); 
ALTER TABLE siges_microrregiao ADD CONSTRAINT fk_siges_microrregiao_1 FOREIGN KEY (siges_estados_id) references siges_estados(id); 
ALTER TABLE siges_questionarios ADD CONSTRAINT fk_siges_questionarios_1 FOREIGN KEY (siges_pesquisas_id) references siges_pesquisas(id); 
ALTER TABLE siges_regioes_esportivas ADD CONSTRAINT fk_siges_regioes_esportivas_1 FOREIGN KEY (siges_estados_id) references siges_estados(id); 
ALTER TABLE siges_sociodemografico ADD CONSTRAINT fk_siges_sociodemografico_1 FOREIGN KEY (system_users_id) references system_users(id); 
ALTER TABLE system_document ADD CONSTRAINT fk_system_document_1 FOREIGN KEY (category_id) references system_document_category(id); 
ALTER TABLE system_document_group ADD CONSTRAINT fk_system_document_group_1 FOREIGN KEY (document_id) references system_document(id); 
ALTER TABLE system_document_group ADD CONSTRAINT fk_system_document_group_1 FOREIGN KEY (system_group_id) references system_group(id); 
ALTER TABLE system_document_user ADD CONSTRAINT fk_system_document_user_1 FOREIGN KEY (system_document_id) references system_document(id); 
ALTER TABLE system_document_user ADD CONSTRAINT fk_system_document_user_1 FOREIGN KEY (system_user_id) references system_users(id); 
ALTER TABLE system_group_program ADD CONSTRAINT fk_system_group_program_2 FOREIGN KEY (system_group_id) references system_group(id); 
ALTER TABLE system_group_program ADD CONSTRAINT fk_system_group_program_1 FOREIGN KEY (system_program_id) references system_program(id); 
ALTER TABLE system_message ADD CONSTRAINT fk_system_message_1 FOREIGN KEY (system_user_id) references system_users(id); 
ALTER TABLE system_message ADD CONSTRAINT fk_system_message_2 FOREIGN KEY (system_user_to_id) references system_users(id); 
ALTER TABLE system_notification ADD CONSTRAINT fk_system_notification_1 FOREIGN KEY (system_user_id) references system_users(id); 
ALTER TABLE system_notification ADD CONSTRAINT fk_system_notification_2 FOREIGN KEY (system_user_to_id) references system_users(id); 
ALTER TABLE system_unit ADD CONSTRAINT fk_system_unit_1 FOREIGN KEY (siges_cidades_id) references siges_cidades(id); 
ALTER TABLE system_user_group ADD CONSTRAINT fk_system_user_group_2 FOREIGN KEY (system_user_id) references system_users(id); 
ALTER TABLE system_user_group ADD CONSTRAINT fk_system_user_group_1 FOREIGN KEY (system_group_id) references system_group(id); 
ALTER TABLE system_user_program ADD CONSTRAINT fk_system_user_program_2 FOREIGN KEY (system_user_id) references system_users(id); 
ALTER TABLE system_user_program ADD CONSTRAINT fk_system_user_program_1 FOREIGN KEY (system_program_id) references system_program(id); 
ALTER TABLE system_users ADD CONSTRAINT fk_system_user_2 FOREIGN KEY (frontpage_id) references system_program(id); 
ALTER TABLE system_users ADD CONSTRAINT fk_system_user_1 FOREIGN KEY (system_unit_id) references system_unit(id); 
ALTER TABLE system_users ADD CONSTRAINT fk_system_users_3 FOREIGN KEY (siges_instituicao_id) references siges_instituicao(id); 
ALTER TABLE system_user_unit ADD CONSTRAINT fk_system_user_unit_2 FOREIGN KEY (system_unit_id) references system_unit(id); 
ALTER TABLE system_user_unit ADD CONSTRAINT fk_system_user_unit_1 FOREIGN KEY (system_user_id) references system_users(id); 

  
