create database inet;
use inet;


DROP TABLE IF EXISTS oferta_formativa;
DROP TABLE IF EXISTS contacto;
DROP VIEW IF EXISTS aula_movil_list_overview;
DROP VIEW IF EXISTS aula_movil_map_overview;
DROP TABLE IF EXISTS ubicacion_aula_x_fecha;
DROP TABLE IF EXISTS aula_movil_details;

CREATE TABLE aula_movil_details (
    n_atm VARCHAR(20) NOT NULL,
    CUE VARCHAR(15),
    estado int NOT NULL,
    fecha_ult_actualizacion DATETIME NOT NULL,
    
    PRIMARY KEY (n_atm),
    CHECK (estado IN (1,2))
);

CREATE TABLE oferta_formativa (
	id INT NOT NULL AUTO_INCREMENT,
    n_aula_movil VARCHAR(20) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(1000) NOT NULL,
    familia_profesional VARCHAR(100) NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,

	PRIMARY KEY (id),
    CONSTRAINT FOREIGN KEY (n_aula_movil) REFERENCES aula_movil_details(n_atm)
);

CREATE TABLE contacto (
    n_aula_movil VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    tel VARCHAR(50) NOT NULL,

	PRIMARY KEY (n_aula_movil),
    CONSTRAINT FOREIGN KEY (n_aula_movil) REFERENCES aula_movil_details(n_atm)
);

CREATE VIEW aula_movil_map_overview AS 
SELECT n_atm, estado FROM aula_movil_details;

CREATE VIEW aula_movil_list_overview AS
SELECT n_atm, estado, oferta_formativa.familia_profesional, oferta_formativa.nombre FROM aula_movil_details
JOIN oferta_formativa ON aula_movil_details.n_atm = oferta_formativa.n_aula_movil;



CREATE TABLE ubicacion_aula_x_fecha(
	id INT AUTO_INCREMENT NOT NULL,
    n_aula_movil VARCHAR(20) NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    longitud FLOAT NOT NULL,
    latitud FLOAT NOT NULL,
    localidad VARCHAR(50) NOT NULL,
    provincia VARCHAR(50) NOT NULL,
    codigo_postal VARCHAR(20) NOT NULL,

    PRIMARY KEY (id),
    CONSTRAINT FOREIGN KEY (n_aula_movil) REFERENCES aula_movil_details(n_atm)
);

