CREATE TABLE siges_alternativas( 
      id number(10)    NOT NULL , 
      valor_alternativa varchar  (10)   , 
      alternativa varchar  (255)   , 
      siges_pesquisas_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_apoio_bolsa( 
      id number(10)    NOT NULL , 
      opcao varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_apoio_responsavel( 
      id number(10)    NOT NULL , 
      opcoes varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_atleta_pesquisa( 
      id number(10)    NOT NULL , 
      siges_pesquisas_id number(10)    NOT NULL , 
      resposta CLOB   , 
      system_users_id number(10)    NOT NULL , 
      data_pesquisa date   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_atletas_analises( 
      id number(10)    NOT NULL , 
      ano_inicio date   , 
      menarca date   , 
      menarca_idate varchar  (255)   , 
      treino_avaliacao char  (1)   , 
      treino_avaliacao_quais CLOB   , 
      observacoes CLOB   , 
      problema_saude char  (1)   , 
      problema_saude_quais CLOB   , 
      afastado_treino char  (1)   , 
      afastado_treino_lesao CLOB   , 
      afastado_treino_tempo varchar  (255)   , 
      presenciou_trote char  (1)   , 
      presenciou_trotes_quais CLOB   , 
      status_cadastro char  (1)    DEFAULT 'N'  NOT NULL , 
      system_users_id number(10)    NOT NULL , 
      data_analise date   , 
      active char  (1)    DEFAULT 'Y'  NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_atletas_antropometria( 
      id number(10)    NOT NULL , 
      data_pesquisa date   , 
      estatura binary_double   , 
      envergadura binary_double   , 
      massa_corporal binary_double   , 
      imc binary_double   , 
      diametro_u binary_double   , 
      diametro_f binary_double   , 
      c_abdominal binary_double   , 
      c_quadril binary_double   , 
      c_cintura binary_double   , 
      dc_subescapular binary_double   , 
      dc_triciptal binary_double   , 
      dc_panturrilha_medial binary_double   , 
      dc_suprailiaca binary_double   , 
      dc_biceps binary_double   , 
      dc_abdominal binary_double   , 
      pas binary_double   , 
      pad binary_double   , 
      fc binary_double   , 
      observacoes CLOB   , 
      status_cadastro char  (1)    DEFAULT 'N'  NOT NULL , 
      system_users_id number(10)    NOT NULL , 
      active char  (1)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_atletas_modalidades( 
      id number(10)    NOT NULL , 
      siges_modalidades_id number(10)    NOT NULL , 
      system_users_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_cidades( 
      id number(10)    NOT NULL , 
      codigo_cidade varchar  (7)    NOT NULL , 
      codigo_siges varchar  (3)   , 
      municipio varchar  (40)    NOT NULL , 
      siges_estados_id number(10)    NOT NULL , 
      siges_regioes_esportivas_id number(10)    NOT NULL , 
      active char    NOT NULL , 
      gentilico varchar  (255)   , 
      prefeito varchar  (255)   , 
      populacao number(10)  (11)   , 
      area_territorial binary_double   , 
      pib number(10)   , 
      mapa varchar  (255)   , 
      brasao varchar  (255)   , 
      bandeira varchar  (255)   , 
      siges_mesorregiao_id number(10)    NOT NULL , 
      siges_microrregiao_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_cidades_idh( 
      id number(10)    NOT NULL , 
      siges_cidades_id number(10)    NOT NULL , 
      ano varchar  (4)    NOT NULL , 
      idhm binary_double   , 
      idhm_renda binary_double   , 
      idhm_long binary_double   , 
      idhm_educacao binary_double   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_contato_instituicao( 
      id number(10)    NOT NULL , 
      siges_tipo_contato_id number(10)    NOT NULL , 
      info_contato varchar  (255)    NOT NULL , 
      siges_instituicao_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_contato_users( 
      id number(10)    NOT NULL , 
      info_contato varchar  (255)    NOT NULL , 
      system_users_id number(10)    NOT NULL , 
      siges_tipo_contato_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_dificuldades( 
      id number(10)    NOT NULL , 
      opcoes varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_espaco_treino( 
      id number(10)    NOT NULL , 
      opcoes varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_estados( 
      id number(10)    NOT NULL , 
      codigo_estado varchar  (2)    NOT NULL , 
      sigla varchar  (2)    NOT NULL , 
      estado varchar  (25)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_faixa_idh( 
      id number(10)    NOT NULL , 
      faixa varchar  (20)    NOT NULL , 
      classificacao number(10)  (3)    NOT NULL , 
      limite_inferior binary_double   , 
      limite_superior binary_double   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_ideb( 
      id number(10)    NOT NULL , 
      siges_instituicao_id number(10)    NOT NULL , 
      siges_tipo_serie_id number(10)    NOT NULL , 
      ano_ref varchar  (4)    NOT NULL , 
      ideb binary_double    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_instituicao( 
      id number(10)    NOT NULL , 
      codigo_instituicao varchar  (15)   , 
      cnpj varchar  (31)   , 
      instituicao_ensino varchar  (255)    NOT NULL , 
      endereco varchar  (255)   , 
      complemento varchar  (255)   , 
      cep varchar  (10)   , 
      status char  (1)   , 
      siges_cidades_id number(10)    NOT NULL , 
      siges_tipos_instituicao_id number(10)    NOT NULL , 
      responsavel varchar  (255)   , 
      alunos_matriculados_ef number(10)  (11)   , 
      alunos_matriculados_em number(10)  (11)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_mesorregiao( 
      id number(10)    NOT NULL , 
      siges_estados_id number(10)    NOT NULL , 
      codigo number(10)  (11)    NOT NULL , 
      mesorregiao varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_microrregiao( 
      id number(10)    NOT NULL , 
      siges_estados_id number(10)    NOT NULL , 
      codigo number(10)  (11)    NOT NULL , 
      microrregiao varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_modalidades( 
      id number(10)    NOT NULL , 
      modalidade varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_momento_treino( 
      id number(10)    NOT NULL , 
      opcoes varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_moradores_casa( 
      id number(10)    NOT NULL , 
      tipo varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_nivel_escolariade( 
      id number(10)    NOT NULL , 
      nivel_escolaridade varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_participa_outras_competicoes( 
      id number(10)    NOT NULL , 
      opcoes varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_pesquisas( 
      id number(10)    NOT NULL , 
      titulo varchar  (255)   , 
      subtitulo varchar  (255)   , 
      instrucoes CLOB   , 
      data_criacao date   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_questionarios( 
      id number(10)    NOT NULL , 
      siges_pesquisas_id number(10)    NOT NULL , 
      questoes CLOB   , 
      tipo varchar  (255)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_raca( 
      id number(10)    NOT NULL , 
      raca varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_regioes_esportivas( 
      id number(10)    NOT NULL , 
      siges_estados_id number(10)    NOT NULL , 
      nr_regiao number(10)  (3)    NOT NULL , 
      regiao varchar  (25)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_responsaveis_competicoes( 
      id number(10)    NOT NULL , 
      opcoes varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_serie_escolar( 
      id number(10)    NOT NULL , 
      nivel varchar  (255)    NOT NULL , 
      serie varchar  (255)    NOT NULL , 
      idade varchar  (255)    NOT NULL , 
      active char  (1)    DEFAULT 'Y'  NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_sociodemografico( 
      id number(10)    NOT NULL , 
      system_users_id number(10)    NOT NULL , 
      siges_tipos_instituicao_id number(10)    NOT NULL , 
      siges_zona_municipio_id number(10)    NOT NULL , 
      siges_raca_id number(10)    NOT NULL , 
      siges_serie_escolar_id number(10)    NOT NULL , 
      siges_tipo_moradia_id number(10)    NOT NULL , 
      pessoas_residencia number(10)  (11)    NOT NULL , 
      siges_moradores_casa_id varchar  (255)    NOT NULL , 
      siges_nivel_escolariade_mae_id number(10)    NOT NULL , 
      siges_nivel_escolariade_pai_id number(10)    NOT NULL , 
      siges_responsaveis_competicoes_id varchar  (255)    NOT NULL , 
      participa_aula_ef char  (1)    NOT NULL , 
      participa_aula_ef_sim varchar  (255)   , 
      participa_aula_ef_nao CLOB   , 
      participa_outras_atividades char  (1)    NOT NULL , 
      participa_outras_atividades_sim CLOB   , 
      siges_tempo_competicoes_id number(10)    NOT NULL , 
      treina_outra_modalidade char  (1)    NOT NULL , 
      treina_outra_modalidade_qual varchar  (255)   , 
      treina_outra_modalidade_quantidade varchar  (255)   , 
      treina_outra_modalidade_duracao varchar  (255)   , 
      siges_participa_outras_competicoes_id number(10)    NOT NULL , 
      siges_apoio_bolsa_id varchar  (255)    NOT NULL , 
      siges_apoio_bolsa_outros CLOB   , 
      participacao_outros CLOB    NOT NULL , 
      siges_espaco_treino_id varchar  (255)    NOT NULL , 
      siges_espaco_treino_outros CLOB   , 
      siges_momento_treino_id number(10)    NOT NULL , 
      siges_dificuldades_id varchar  (255)    NOT NULL , 
      siges_dificuldades_outros CLOB   , 
      siges_espaco_treino_comunidade_id varchar  (255)    NOT NULL , 
      siges_espaco_treino_comunidade_outros varchar  (255)   , 
      siges_apoio_responsavel_id varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_tempo_competicoes( 
      id number(10)    NOT NULL , 
      opcoes varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_tipo_contato( 
      id number(10)    NOT NULL , 
      tipo varchar  (100)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_tipo_moradia( 
      id number(10)    NOT NULL , 
      tipo varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_tipo_serie( 
      id number(10)    NOT NULL , 
      tipo varchar  (255)    NOT NULL , 
      sigla varchar  (2)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_tipos_instituicao( 
      id number(10)    NOT NULL , 
      tipo_instituicao varchar  (100)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE siges_zona_municipio( 
      id number(10)    NOT NULL , 
      tipo varchar  (255)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_document( 
      id number(10)    NOT NULL , 
      category_id number(10)    NOT NULL , 
      title CLOB    NOT NULL , 
      description date   , 
      submission_date date   , 
      archive_date date   , 
      filename CLOB   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_document_category( 
      id number(10)    NOT NULL , 
      name CLOB    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_document_group( 
      id number(10)    NOT NULL , 
      document_id number(10)    NOT NULL , 
      system_group_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_document_user( 
      system_document_id number(10)    NOT NULL , 
      id number(10)    NOT NULL , 
      system_user_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group( 
      id number(10)    NOT NULL , 
      name CLOB    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_group_program( 
      id number(10)    NOT NULL , 
      system_group_id number(10)    NOT NULL , 
      system_program_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_message( 
      id number(10)    NOT NULL , 
      system_user_id number(10)    NOT NULL , 
      system_user_to_id number(10)    NOT NULL , 
      subject CLOB    NOT NULL , 
      message CLOB   , 
      dt_message date   , 
      checked char  (1)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_notification( 
      id number(10)    NOT NULL , 
      system_user_id number(10)    NOT NULL , 
      system_user_to_id number(10)    NOT NULL , 
      subject CLOB   , 
      message CLOB   , 
      dt_message date   , 
      action_url CLOB   , 
      action_label CLOB   , 
      icon CLOB   , 
      checked char  (1)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_preference( 
      id CLOB    NOT NULL , 
      preference CLOB    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_program( 
      id number(10)    NOT NULL , 
      name CLOB    NOT NULL , 
      controller CLOB    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_unit( 
      id number(10)    NOT NULL , 
      name CLOB    NOT NULL , 
      siges_cidades_id number(10)   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_group( 
      id number(10)    NOT NULL , 
      system_user_id number(10)    NOT NULL , 
      system_group_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_program( 
      id number(10)    NOT NULL , 
      system_user_id number(10)    NOT NULL , 
      system_program_id number(10)    NOT NULL , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_users( 
      id number(10)    NOT NULL , 
      name CLOB    NOT NULL , 
      login CLOB    NOT NULL , 
      password CLOB    NOT NULL , 
      email CLOB   , 
      frontpage_id number(10)   , 
      system_unit_id number(10)   , 
      active char  (1)   , 
      cpf varchar  (14)    NOT NULL , 
      genero char  (1)   , 
      nascimento date   , 
      siges_instituicao_id number(10)   , 
      observacoes CLOB   , 
 PRIMARY KEY (id)) ; 

CREATE TABLE system_user_unit( 
      id number(10)    NOT NULL , 
      system_user_id number(10)    NOT NULL , 
      system_unit_id number(10)    NOT NULL , 
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
 CREATE SEQUENCE siges_alternativas_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_alternativas_id_seq_tr 

BEFORE INSERT ON siges_alternativas FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_alternativas_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_apoio_bolsa_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_apoio_bolsa_id_seq_tr 

BEFORE INSERT ON siges_apoio_bolsa FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_apoio_bolsa_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_apoio_responsavel_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_apoio_responsavel_id_seq_tr 

BEFORE INSERT ON siges_apoio_responsavel FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_apoio_responsavel_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_atleta_pesquisa_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_atleta_pesquisa_id_seq_tr 

BEFORE INSERT ON siges_atleta_pesquisa FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_atleta_pesquisa_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_atletas_analises_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_atletas_analises_id_seq_tr 

BEFORE INSERT ON siges_atletas_analises FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_atletas_analises_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_atletas_antropometria_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_atletas_antropometria_id_seq_tr 

BEFORE INSERT ON siges_atletas_antropometria FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_atletas_antropometria_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_atletas_modalidades_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_atletas_modalidades_id_seq_tr 

BEFORE INSERT ON siges_atletas_modalidades FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_atletas_modalidades_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_cidades_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_cidades_id_seq_tr 

BEFORE INSERT ON siges_cidades FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_cidades_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_cidades_idh_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_cidades_idh_id_seq_tr 

BEFORE INSERT ON siges_cidades_idh FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_cidades_idh_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_contato_instituicao_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_contato_instituicao_id_seq_tr 

BEFORE INSERT ON siges_contato_instituicao FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_contato_instituicao_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_contato_users_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_contato_users_id_seq_tr 

BEFORE INSERT ON siges_contato_users FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_contato_users_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_dificuldades_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_dificuldades_id_seq_tr 

BEFORE INSERT ON siges_dificuldades FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_dificuldades_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_espaco_treino_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_espaco_treino_id_seq_tr 

BEFORE INSERT ON siges_espaco_treino FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_espaco_treino_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_estados_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_estados_id_seq_tr 

BEFORE INSERT ON siges_estados FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_estados_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_faixa_idh_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_faixa_idh_id_seq_tr 

BEFORE INSERT ON siges_faixa_idh FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_faixa_idh_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_ideb_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_ideb_id_seq_tr 

BEFORE INSERT ON siges_ideb FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_ideb_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_instituicao_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_instituicao_id_seq_tr 

BEFORE INSERT ON siges_instituicao FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_instituicao_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_mesorregiao_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_mesorregiao_id_seq_tr 

BEFORE INSERT ON siges_mesorregiao FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_mesorregiao_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_microrregiao_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_microrregiao_id_seq_tr 

BEFORE INSERT ON siges_microrregiao FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_microrregiao_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_modalidades_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_modalidades_id_seq_tr 

BEFORE INSERT ON siges_modalidades FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_modalidades_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_momento_treino_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_momento_treino_id_seq_tr 

BEFORE INSERT ON siges_momento_treino FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_momento_treino_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_moradores_casa_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_moradores_casa_id_seq_tr 

BEFORE INSERT ON siges_moradores_casa FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_moradores_casa_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_nivel_escolariade_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_nivel_escolariade_id_seq_tr 

BEFORE INSERT ON siges_nivel_escolariade FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_nivel_escolariade_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_participa_outras_competicoes_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_participa_outras_competicoes_id_seq_tr 

BEFORE INSERT ON siges_participa_outras_competicoes FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_participa_outras_competicoes_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_pesquisas_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_pesquisas_id_seq_tr 

BEFORE INSERT ON siges_pesquisas FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_pesquisas_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_questionarios_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_questionarios_id_seq_tr 

BEFORE INSERT ON siges_questionarios FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_questionarios_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_raca_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_raca_id_seq_tr 

BEFORE INSERT ON siges_raca FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_raca_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_regioes_esportivas_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_regioes_esportivas_id_seq_tr 

BEFORE INSERT ON siges_regioes_esportivas FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_regioes_esportivas_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_responsaveis_competicoes_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_responsaveis_competicoes_id_seq_tr 

BEFORE INSERT ON siges_responsaveis_competicoes FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_responsaveis_competicoes_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_serie_escolar_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_serie_escolar_id_seq_tr 

BEFORE INSERT ON siges_serie_escolar FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_serie_escolar_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_sociodemografico_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_sociodemografico_id_seq_tr 

BEFORE INSERT ON siges_sociodemografico FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_sociodemografico_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_tempo_competicoes_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_tempo_competicoes_id_seq_tr 

BEFORE INSERT ON siges_tempo_competicoes FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_tempo_competicoes_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_tipo_contato_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_tipo_contato_id_seq_tr 

BEFORE INSERT ON siges_tipo_contato FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_tipo_contato_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_tipo_moradia_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_tipo_moradia_id_seq_tr 

BEFORE INSERT ON siges_tipo_moradia FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_tipo_moradia_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_tipo_serie_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_tipo_serie_id_seq_tr 

BEFORE INSERT ON siges_tipo_serie FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_tipo_serie_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_tipos_instituicao_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_tipos_instituicao_id_seq_tr 

BEFORE INSERT ON siges_tipos_instituicao FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_tipos_instituicao_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE siges_zona_municipio_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER siges_zona_municipio_id_seq_tr 

BEFORE INSERT ON siges_zona_municipio FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT siges_zona_municipio_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE system_document_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER system_document_id_seq_tr 

BEFORE INSERT ON system_document FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT system_document_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE system_document_category_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER system_document_category_id_seq_tr 

BEFORE INSERT ON system_document_category FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT system_document_category_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE system_document_group_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER system_document_group_id_seq_tr 

BEFORE INSERT ON system_document_group FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT system_document_group_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE system_document_user_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER system_document_user_id_seq_tr 

BEFORE INSERT ON system_document_user FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT system_document_user_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE system_group_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER system_group_id_seq_tr 

BEFORE INSERT ON system_group FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT system_group_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE system_group_program_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER system_group_program_id_seq_tr 

BEFORE INSERT ON system_group_program FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT system_group_program_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE system_message_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER system_message_id_seq_tr 

BEFORE INSERT ON system_message FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT system_message_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE system_notification_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER system_notification_id_seq_tr 

BEFORE INSERT ON system_notification FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT system_notification_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE system_program_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER system_program_id_seq_tr 

BEFORE INSERT ON system_program FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT system_program_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE system_unit_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER system_unit_id_seq_tr 

BEFORE INSERT ON system_unit FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT system_unit_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE system_user_group_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER system_user_group_id_seq_tr 

BEFORE INSERT ON system_user_group FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT system_user_group_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE system_user_program_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER system_user_program_id_seq_tr 

BEFORE INSERT ON system_user_program FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT system_user_program_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE system_users_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER system_users_id_seq_tr 

BEFORE INSERT ON system_users FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT system_users_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
CREATE SEQUENCE system_user_unit_id_seq START WITH 1 INCREMENT BY 1; 

CREATE OR REPLACE TRIGGER system_user_unit_id_seq_tr 

BEFORE INSERT ON system_user_unit FOR EACH ROW 

WHEN 

(NEW.id IS NULL) 

BEGIN 

SELECT system_user_unit_id_seq.NEXTVAL INTO :NEW.id FROM DUAL; 

END;
 
  
