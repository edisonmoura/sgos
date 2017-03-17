CREATE TABLE secretaria
(
  id_secretaria SERIAL,
  nome VARCHAR(255),
  PRIMARY KEY (id_secretaria)
);

CREATE TABLE departamento
(
  id_departamento SERIAL,
  id_secretaria INTEGER,
  nome VARCHAR(255),
  PRIMARY KEY (id_departamento),
  FOREIGN KEY (id_secretaria)
    REFERENCES secretaria (id_secretaria)
);

CREATE TABLE cargo
(
  id_cargo SERIAL,
  nome VARCHAR(255),
  PRIMARY KEY (id_cargo)
);

CREATE TABLE cliente
(
  id_cliente SERIAL,
  id_cargo INTEGER,
  id_departamento INTEGER,
  nome VARCHAR(255),
  e_mail VARCHAR(255),
  telefone VARCHAR(255),
  PRIMARY KEY (id_cliente),
  FOREIGN KEY (id_cargo) 
    REFERENCES cargo (id_cargo),
  FOREIGN KEY (id_departamento) 
    REFERENCES departamento (id_departamento)
);

CREATE TABLE tipo
(
  id_tipo SERIAL,
  nome VARCHAR(255),
  PRIMARY KEY (id_tipo)
);

CREATE TABLE os
(
  id_os SERIAL,
  id_tipo INTEGER,
  id_cliente INTEGER,  
  nome VARCHAR(255),
  descricao TEXT,
  prioridade VARCHAR(255),
  data_hora_abertura TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  data_hora_cancelada TIMESTAMP DEFAULT NULL,
  data_hora_finalizada TIMESTAMP DEFAULT NULL,
  satisfacao INTEGER,
  PRIMARY KEY (id_os),
  FOREIGN KEY (id_tipo)
    REFERENCES tipo (id_tipo),
  FOREIGN KEY (id_cliente)
    REFERENCES cliente (id_cliente)
);

CREATE TABLE os_anexo
(
  id_registro SERIAL,
  id_os INTEGER,
  data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  nome VARCHAR(255),
  PRIMARY KEY (id_registro),
  FOREIGN KEY (id_os)
    REFERENCES os (id_os)
);

CREATE TABLE os_registro
(
  id_registro SERIAL,
  id_os INTEGER,
  data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  descricao TEXT,
  PRIMARY KEY (id_registro),
  FOREIGN KEY (id_os)
    REFERENCES os (id_os)
);

