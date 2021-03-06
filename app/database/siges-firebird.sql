CREATE TABLE siges_alternativas( 
      id  integer generated by default as identity primary key     NOT NULL , 
      valor_alternativa varchar  (10)   , 
      alternativa varchar  (255)   , 
      siges_pesquisas_id integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_apoio_bolsa( 
      id  integer generated by default as identity primary key     NOT NULL , 
      opcao varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_apoio_responsavel( 
      id  integer generated by default as identity primary key     NOT NULL , 
      opcoes varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_atleta_pesquisa( 
      id  integer generated by default as identity primary key     NOT NULL , 
      siges_pesquisas_id integer    NOT NULL , 
      resposta blob sub_type 1   , 
      system_users_id integer    NOT NULL , 
      data_pesquisa date   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_atletas_analises( 
      id  integer generated by default as identity primary key     NOT NULL , 
      ano_inicio date   , 
      menarca date   , 
      menarca_idate varchar  (255)   , 
      treino_avaliacao char  (1)   , 
      treino_avaliacao_quais blob sub_type 1   , 
      observacoes blob sub_type 1   , 
      problema_saude char  (1)   , 
      problema_saude_quais blob sub_type 1   , 
      afastado_treino char  (1)   , 
      afastado_treino_lesao blob sub_type 1   , 
      afastado_treino_tempo varchar  (255)   , 
      presenciou_trote char  (1)   , 
      presenciou_trotes_quais blob sub_type 1   , 
      status_cadastro char  (1)    DEFAULT 'N'  NOT NULL , 
      system_users_id integer    NOT NULL , 
      data_analise date   , 
      active char  (1)    DEFAULT 'Y'  NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_atletas_antropometria( 
      id  integer generated by default as identity primary key     NOT NULL , 
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
      observacoes blob sub_type 1   , 
      status_cadastro char  (1)    DEFAULT 'N'  NOT NULL , 
      system_users_id integer    NOT NULL , 
      active char  (1)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_atletas_modalidades( 
      id  integer generated by default as identity primary key     NOT NULL , 
      siges_modalidades_id integer    NOT NULL , 
      system_users_id integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_cidades( 
      id  integer generated by default as identity primary key     NOT NULL , 
      codigo_cidade varchar  (7)    NOT NULL , 
      codigo_siges varchar  (3)   , 
      municipio varchar  (40)    NOT NULL , 
      siges_estados_id integer    NOT NULL , 
      siges_regioes_esportivas_id integer    NOT NULL , 
      active char    NOT NULL , 
      gentilico varchar  (255)   , 
      prefeito varchar  (255)   , 
      populacao integer  (11)   , 
      area_territorial float   , 
      pib integer   , 
      mapa varchar  (255)   , 
      brasao varchar  (255)   , 
      bandeira varchar  (255)   , 
      siges_mesorregiao_id integer    NOT NULL , 
      siges_microrregiao_id integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_cidades_idh( 
      id  integer generated by default as identity primary key     NOT NULL , 
      siges_cidades_id integer    NOT NULL , 
      ano varchar  (4)    NOT NULL , 
      idhm float   , 
      idhm_renda float   , 
      idhm_long float   , 
      idhm_educacao float   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_contato_instituicao( 
      id  integer generated by default as identity primary key     NOT NULL , 
      siges_tipo_contato_id integer    NOT NULL , 
      info_contato varchar  (255)    NOT NULL , 
      siges_instituicao_id integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_contato_users( 
      id  integer generated by default as identity primary key     NOT NULL , 
      info_contato varchar  (255)    NOT NULL , 
      system_users_id integer    NOT NULL , 
      siges_tipo_contato_id integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_dificuldades( 
      id  integer generated by default as identity primary key     NOT NULL , 
      opcoes varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_espaco_treino( 
      id  integer generated by default as identity primary key     NOT NULL , 
      opcoes varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_estados( 
      id  integer generated by default as identity primary key     NOT NULL , 
      codigo_estado varchar  (2)    NOT NULL , 
      sigla varchar  (2)    NOT NULL , 
      estado varchar  (25)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_faixa_idh( 
      id  integer generated by default as identity primary key     NOT NULL , 
      faixa varchar  (20)    NOT NULL , 
      classificacao integer  (3)    NOT NULL , 
      limite_inferior float   , 
      limite_superior float   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_ideb( 
      id  integer generated by default as identity primary key     NOT NULL , 
      siges_instituicao_id integer    NOT NULL , 
      siges_tipo_serie_id integer    NOT NULL , 
      ano_ref varchar  (4)    NOT NULL , 
      ideb float    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_instituicao( 
      id  integer generated by default as identity primary key     NOT NULL , 
      codigo_instituicao varchar  (15)   , 
      cnpj varchar  (31)   , 
      instituicao_ensino varchar  (255)    NOT NULL , 
      endereco varchar  (255)   , 
      complemento varchar  (255)   , 
      cep varchar  (10)   , 
      status char  (1)   , 
      siges_cidades_id integer    NOT NULL , 
      siges_tipos_instituicao_id integer    NOT NULL , 
      responsavel varchar  (255)   , 
      alunos_matriculados_ef integer  (11)   , 
      alunos_matriculados_em integer  (11)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_mesorregiao( 
      id  integer generated by default as identity primary key     NOT NULL , 
      siges_estados_id integer    NOT NULL , 
      codigo integer  (11)    NOT NULL , 
      mesorregiao varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_microrregiao( 
      id  integer generated by default as identity primary key     NOT NULL , 
      siges_estados_id integer    NOT NULL , 
      codigo integer  (11)    NOT NULL , 
      microrregiao varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_modalidades( 
      id  integer generated by default as identity primary key     NOT NULL , 
      modalidade varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_momento_treino( 
      id  integer generated by default as identity primary key     NOT NULL , 
      opcoes varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_moradores_casa( 
      id  integer generated by default as identity primary key     NOT NULL , 
      tipo varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_nivel_escolariade( 
      id  integer generated by default as identity primary key     NOT NULL , 
      nivel_escolaridade varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_participa_outras_competicoes( 
      id  integer generated by default as identity primary key     NOT NULL , 
      opcoes varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_pesquisas( 
      id  integer generated by default as identity primary key     NOT NULL , 
      titulo varchar  (255)   , 
      subtitulo varchar  (255)   , 
      instrucoes blob sub_type 1   , 
      data_criacao date   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_questionarios( 
      id  integer generated by default as identity primary key     NOT NULL , 
      siges_pesquisas_id integer    NOT NULL , 
      questoes blob sub_type 1   , 
      tipo varchar  (255)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_raca( 
      id  integer generated by default as identity primary key     NOT NULL , 
      raca varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_regioes_esportivas( 
      id  integer generated by default as identity primary key     NOT NULL , 
      siges_estados_id integer    NOT NULL , 
      nr_regiao integer  (3)    NOT NULL , 
      regiao varchar  (25)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_responsaveis_competicoes( 
      id  integer generated by default as identity primary key     NOT NULL , 
      opcoes varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_serie_escolar( 
      id  integer generated by default as identity primary key     NOT NULL , 
      nivel varchar  (255)    NOT NULL , 
      serie varchar  (255)    NOT NULL , 
      idade varchar  (255)    NOT NULL , 
      active char  (1)    DEFAULT 'Y'  NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_sociodemografico( 
      id  integer generated by default as identity primary key     NOT NULL , 
      system_users_id integer    NOT NULL , 
      siges_tipos_instituicao_id integer    NOT NULL , 
      siges_zona_municipio_id integer    NOT NULL , 
      siges_raca_id integer    NOT NULL , 
      siges_serie_escolar_id integer    NOT NULL , 
      siges_tipo_moradia_id integer    NOT NULL , 
      pessoas_residencia integer  (11)    NOT NULL , 
      siges_moradores_casa_id varchar  (255)    NOT NULL , 
      siges_nivel_escolariade_mae_id integer    NOT NULL , 
      siges_nivel_escolariade_pai_id integer    NOT NULL , 
      siges_responsaveis_competicoes_id varchar  (255)    NOT NULL , 
      participa_aula_ef char  (1)    NOT NULL , 
      participa_aula_ef_sim varchar  (255)   , 
      participa_aula_ef_nao blob sub_type 1   , 
      participa_outras_atividades char  (1)    NOT NULL , 
      participa_outras_atividades_sim blob sub_type 1   , 
      siges_tempo_competicoes_id integer    NOT NULL , 
      treina_outra_modalidade char  (1)    NOT NULL , 
      treina_outra_modalidade_qual varchar  (255)   , 
      treina_outra_modalidade_quantidade varchar  (255)   , 
      treina_outra_modalidade_duracao varchar  (255)   , 
      siges_participa_outras_competicoes_id integer    NOT NULL , 
      siges_apoio_bolsa_id varchar  (255)    NOT NULL , 
      siges_apoio_bolsa_outros blob sub_type 1   , 
      participacao_outros blob sub_type 1    NOT NULL , 
      siges_espaco_treino_id varchar  (255)    NOT NULL , 
      siges_espaco_treino_outros blob sub_type 1   , 
      siges_momento_treino_id integer    NOT NULL , 
      siges_dificuldades_id varchar  (255)    NOT NULL , 
      siges_dificuldades_outros blob sub_type 1   , 
      siges_espaco_treino_comunidade_id varchar  (255)    NOT NULL , 
      siges_espaco_treino_comunidade_outros varchar  (255)   , 
      siges_apoio_responsavel_id varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_tempo_competicoes( 
      id  integer generated by default as identity primary key     NOT NULL , 
      opcoes varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_tipo_contato( 
      id  integer generated by default as identity primary key     NOT NULL , 
      tipo varchar  (100)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_tipo_moradia( 
      id  integer generated by default as identity primary key     NOT NULL , 
      tipo varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_tipo_serie( 
      id  integer generated by default as identity primary key     NOT NULL , 
      tipo varchar  (255)    NOT NULL , 
      sigla varchar  (2)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_tipos_instituicao( 
      id  integer generated by default as identity primary key     NOT NULL , 
      tipo_instituicao varchar  (100)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_zona_municipio( 
      id  integer generated by default as identity primary key     NOT NULL , 
      tipo varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_document( 
      id  integer generated by default as identity primary key     NOT NULL , 
      category_id integer    NOT NULL , 
      title blob sub_type 1    NOT NULL , 
      description date   , 
      submission_date date   , 
      archive_date date   , 
      filename blob sub_type 1   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_document_category( 
      id  integer generated by default as identity primary key     NOT NULL , 
      name blob sub_type 1    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_document_group( 
      id  integer generated by default as identity primary key     NOT NULL , 
      document_id integer    NOT NULL , 
      system_group_id integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_document_user( 
      system_document_id integer    NOT NULL , 
      id  integer generated by default as identity primary key     NOT NULL , 
      system_user_id integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group( 
      id  integer generated by default as identity primary key     NOT NULL , 
      name blob sub_type 1    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group_program( 
      id  integer generated by default as identity primary key     NOT NULL , 
      system_group_id integer    NOT NULL , 
      system_program_id integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_message( 
      id  integer generated by default as identity primary key     NOT NULL , 
      system_user_id integer    NOT NULL , 
      system_user_to_id integer    NOT NULL , 
      subject blob sub_type 1    NOT NULL , 
      message blob sub_type 1   , 
      dt_message date   , 
      checked char  (1)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_notification( 
      id  integer generated by default as identity primary key     NOT NULL , 
      system_user_id integer    NOT NULL , 
      system_user_to_id integer    NOT NULL , 
      subject blob sub_type 1   , 
      message blob sub_type 1   , 
      dt_message date   , 
      action_url blob sub_type 1   , 
      action_label blob sub_type 1   , 
      icon blob sub_type 1   , 
      checked char  (1)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_preference( 
      id blob sub_type 1    NOT NULL , 
      preference blob sub_type 1    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_program( 
      id  integer generated by default as identity primary key     NOT NULL , 
      name blob sub_type 1    NOT NULL , 
      controller blob sub_type 1    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_unit( 
      id  integer generated by default as identity primary key     NOT NULL , 
      name blob sub_type 1    NOT NULL , 
      siges_cidades_id integer   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_group( 
      id  integer generated by default as identity primary key     NOT NULL , 
      system_user_id integer    NOT NULL , 
      system_group_id integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_program( 
      id  integer generated by default as identity primary key     NOT NULL , 
      system_user_id integer    NOT NULL , 
      system_program_id integer    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_users( 
      id  integer generated by default as identity primary key     NOT NULL , 
      name blob sub_type 1    NOT NULL , 
      login blob sub_type 1    NOT NULL , 
      password blob sub_type 1    NOT NULL , 
      email blob sub_type 1   , 
      frontpage_id integer   , 
      system_unit_id integer   , 
      active char  (1)   , 
      cpf varchar  (14)    NOT NULL , 
      genero char  (1)   , 
      nascimento date   , 
      siges_instituicao_id integer   , 
      observacoes blob sub_type 1   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_unit( 
      id  integer generated by default as identity primary key     NOT NULL , 
      system_user_id integer    NOT NULL , 
      system_unit_id integer    NOT NULL , 
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
ALTER TABLE siges_atletas_antropometria ADD CONSTRAINT siges_atletas_antropometria_5ef7ccd6ee3fa FOREIGN KEY (system_users_id) references system_users(id); 
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

  
