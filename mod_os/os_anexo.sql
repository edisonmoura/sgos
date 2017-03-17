DROP TABLE os_anexo;

CREATE TABLE os_anexo
(
  id_anexo SERIAL,
  id_os INTEGER,
  data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  nome VARCHAR(255),
  PRIMARY KEY (id_anexo),
  FOREIGN KEY (id_os)
    REFERENCES os (id_os)
);
