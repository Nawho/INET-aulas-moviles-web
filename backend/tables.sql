create database inet;
use inet;

DROP TABLE IF EXISTS oferta_formativa;
DROP TABLE IF EXISTS contacto;
DROP VIEW IF EXISTS aula_movil_overview;
DROP TABLE IF EXISTS ubicacion_aula_x_fecha;
DROP TABLE IF EXISTS aula_movil_details;

CREATE TABLE aula_movil_details (
    n_ATM VARCHAR(20) NOT NULL,
    CUE VARCHAR(15),
    estado int NOT NULL,
    especialidad_formativa VARCHAR(100) NOT NULL,
    fecha_ult_actualizacion DATETIME NOT NULL,
    
    PRIMARY KEY (n_ATM),
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
    CONSTRAINT FOREIGN KEY (n_aula_movil) REFERENCES aula_movil_details(n_ATM)
);

CREATE TABLE contacto (
    n_aula_movil VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    tel VARCHAR(50) NOT NULL,

	PRIMARY KEY (n_aula_movil),
    CONSTRAINT FOREIGN KEY (n_aula_movil) REFERENCES aula_movil_details(n_ATM)
);

CREATE VIEW aula_movil_overview AS 
SELECT n_ATM, estado, especialidad_formativa FROM aula_movil_details;

CREATE TABLE ubicacion_aula_x_fecha(
    n_aula_movil VARCHAR(20) NOT NULL,
    fecha DATE NOT NULL,
    longitud FLOAT NOT NULL,
    latitud FLOAT NOT NULL,
    localidad VARCHAR(50) NOT NULL,
    provincia VARCHAR(50) NOT NULL,
    codigo_postal VARCHAR(20) NOT NULL,

    PRIMARY KEY (n_aula_movil, fecha),
    CONSTRAINT FOREIGN KEY (n_aula_movil) REFERENCES aula_movil_details(n_ATM)
);

INSERT INTO aula_movil_details VALUES ("24","62251206","2","INSTALACIONES DOMICILIARIAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("29","62251205","2","INFORMÁTICA, REDES Y REPARACIÓN DE PC","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("68","62251208","2","INSTALACIONES DOMICILIARIAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("71","62251207","2","GENÉRICA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("73","A SOLICICTAR ","2","INFORMÁTICA, REDES Y REPARACIÓN DE PC -   GENERICA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("97","62251209","2","SOLDADURA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("108","","2","REPARACIÓN DE AUTOS Y MOTOS ","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("113","62251211","2","ENERGÍAS RENOVABLES Y ALTERNATIVAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("117","62251210","2","REFRIGERACIÓN Y CLIMATIZACIÓN","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("165","62251213","2","AUTOMATIZACIÓN INDUSTRIAL","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("166","62251214","2","AUTOMATIZACIÓN INDUSTRIAL","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("167","62251212","2","ENERGÍAS RENOVABLES Y ALTERNATIVAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("168","62251217","2","GENÉRICA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("169","62251215","2","GENERICA - EX BIOTECNOLOGÍA VEGETAL ","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("170","62251216","2","GENERICA - EX BIOTECNOLOGÍA VEGETAL ","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("36","100090302","2","INSTALACIONES DOMICILIARIAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("46","100090303","2","GASTRONOMÍA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("55","100090301","2","TEXTIL E INDUMENTARIA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("75","100090304","2","REFRIGERACIÓN Y CLIMATIZACIÓN","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("99","100090306","2","REPARACIÓN DE AUTOS Y MOTOS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("119","100090305","2","SOLDADURA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("140","100090307","2","SOLDADURA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("8","220216203","2","TEXTIL E INDUMENTARIA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("26","220216200","2","INSTALACIONES DOMICILIARIAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("77","220216202","2","INFORMÁTICA, REDES Y REPARACIÓN DE PC","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("79","220216201","2","SOLDADURA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("83","220216204","2","AUTOMATIZACIÓN INDUSTRIAL","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("125","220216205","2","REFRIGERACIÓN Y CLIMATIZACIÓN","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("135","A SOLICICTAR ","2","REPARACIÓN DE AUTOS Y MOTOS (EX MECANICA DE AUTOS Y MOTOS )","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("2","260078507","2","GASTRONOMÍA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("23","260078501","2","INFORMÁTICA, REDES Y REPARACIÓN DE PC","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("44","260078502","2","INSTALACIONES DOMICILIARIAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("47","260078503","2","INSTALACIONES DOMICILIARIAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("74","260078506","2","SOLDADURA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("82","260078504","2","REFRIGERACIÓN Y CLIMATIZACIÓN","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("85","260078505","2","REPARACIÓN DE AUTOS Y MOTOS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("13","140546827","2","METALMECÁNICA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("48","140546801","2","INSTALACIONES DOMICILIARIAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("57","140546802","2","INSTALACIONES DOMICILIARIAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("76","140546826","2","AUTOMATIZACIÓN INDUSTRIAL","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("103","140546828","2","SOLDADURA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("110","140546829","2","REPARACIÓN DE AUTOS Y MOTOS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("121","140546830","2","ENERGÍAS RENOVABLES Y ALTERNATIVAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("150","140546831","2","GASTRONOMÍA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("156","A SOLICICTAR ","2","SABERES DIGITALES","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("3","180182604","2","INSTALACIONES DOMICILIARIAS (EX CONSTRUCCIONES, GENÉRICA)","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("4","180182605","2","INSTALACIONES DOMICILIARIAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("5","180182602","2","METALMECANICA  (SOLDADURA - GENÉRICA )","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("6","180182603","2","INFORMÁTICA, REDES Y REPARACIÓN DE PC, GENÉRICA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("7","180182601","2","INSTALACIONES DOMICILIARIAS ","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("89","180182606","2","TEXTIL E INDUMENTARIA - GENÉRICA,","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("90","180182607","2","SOLDADURA - GENÉRICA, METALMECÁNICA, ","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("116","180182608","2","SOLDADURA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("149","180182609","2","GASTRONOMÍA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("157","180182610","2","SABERES DIGITALES","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("16","300336006","2","TEXTIL E INDUMENTARIA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("67","300336005","2","AUTOMATIZACIÓN INDUSTRIAL","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("91","300336001","2","INSTALACIONES DOMICILIARIAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("92","300336002","2","INSTALACIONES DOMICILIARIAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("93","300336003","2","REPARACIÓN DE AUTOS Y MOTOS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("147","300336007","2","GASTRONOMÍA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("158","A SOLICICTAR ","2","SISTEMAS TECNOLOGICOS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("10 FLUVIAL","300336004","2","ENERGÍAS RENOVABLES Y ALTERNATIVAS  ( MECÁNICO DE MOTORES NÁUTICOS )","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("35","340115101","2","INFORMÁTICA, REDES Y REPARACIÓN DE PC","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("37","340115103","2","TEXTIL E INDUMENTARIA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("62","340115102","2","INSTALACIONES DOMICILIARIAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("94","340115104","2","INSTALACIONES DOMICILIARIAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("100","340115105","2","REPARACIÓN DE AUTOS Y MOTOS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("129","340115106","2","ENERGÍAS RENOVABLES Y ALTERNATIVAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("152","A SOLICICTAR ","2","GASTRONOMIA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("15","3800945-05","2","ENERGÍAS RENOVABLES Y ALTERNATIVAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("32","3800945-01","2","INSTALACIONES DOMICILIARIAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("38","3800945-02","2","INFORMÁTICA, REDES Y REPARACIÓN DE PC","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("96","3800945-04","2","REPARACIÓN DE AUTOS Y MOTOS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("148","","2","GASTRONOMIA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("159","A SOLICICTAR ","2","SISTEMAS TECNOLOGICOS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("11","420097200","2","INFORMÁTICA, REDES Y REPARACIÓN DE PC","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("12","420097300","2","INSTALACIONES DOMICILIARIAS (MANTENIMIENTO )","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("22","420099800","2","REFRIGERACIÓN Y CLIMATIZACIÓN","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("56","420097700","2","GASTRONOMÍA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("84","420099900","2","REPARACIÓN DE AUTOS Y MOTOS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("139","A SOLICICTAR ","2","SOLDADURA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("61","460086901","2","INSTALACIONES DOMICILIARIAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("78","460086903","2","TEXTIL E INDUMENTARIA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("101","460086902","2","REPARACIÓN DE AUTOS Y MOTOS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("109","460086904","2","SOLDADURA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("153","A SOLICICTAR ","2","GASTRONOMIA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("39","500266802","2","INSTALACIONES DOMICILIARIAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("45","500266803","2","TEXTIL E INDUMENTARIA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("53","500266801","2","INFORMÁTICA, REDES Y REPARACIÓN DE PC","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("60","500266807","2","REFRIGERACIÓN Y CLIMATIZACIÓN","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("95","500266805","2","GASTRONOMÍA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("104","500266804","2","SOLDADURA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("114","500266806","2","REPARACIÓN DE AUTOS Y MOTOS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("161","A SOLICICTAR ","2","SABERES DIGITALES","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("41","540120201","2","BIOTECNOLOGIA VEGETAL (EX AGROPECUARIA ) ","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("59","540120202","2","INSTALACIONES DOMICILIARIAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("69","540120203","2","REPARACIÓN DE AUTOS Y MOTOS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("80","540120204","2","REFRIGERACIÓN Y CLIMATIZACIÓN","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("107","540120205","2","GASTRONOMÍA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("122","540120206","2","ENERGÍAS RENOVABLES Y ALTERNATIVAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("146","540120207","2","GASTRONOMÍA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("162","A SOLICICTAR ","2","SABERES DIGITALES","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("18","580124106","2","TEXTIL E INDUMENTARIA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("49","5800124102","2","SOLDADURA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("54","580124101","2","INSTALACIONES DOMICILIARIAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("106","580124103","2","METALMECÁNICA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("118","580124104","2","ENERGÍAS RENOVABLES Y ALTERNATIVAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("136","580124107","2","REPARACIÓN DE AUTOS Y MOTOS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("123","A SOLICICTAR ","2","SOLDADURA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("50","620107401","2","REFRIGERACIÓN Y CLIMATIZACIÓN","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("70","620107404","2","ENERGÍAS RENOVABLES Y ALTERNATIVAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("86","620107402","2","GASTRONOMÍA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("105","620107403","2","SOLDADURA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("120","620107405","2","REPARACIÓN DE AUTOS Y MOTOS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("130","620107407","2","METALMECÁNICA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("143","620107406","2","GASTRONOMÍA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("43","660160502","2","INFORMÁTICA, REDES Y REPARACIÓN DE PC","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("52","660160503","2","REFRIGERACIÓN Y CLIMATIZACIÓN","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("98","660160505","2","REPARACIÓN DE AUTOS Y MOTOS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("112","660160504","2","SOLDADURA","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("17 (TRAILER )","660160501","2","INSTALACIONES DOMICILIARIAS","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("164","A SOLICICTAR","2","SISTEMAS TECNOLOGICOS","2023-10-28:13-15-00");

INSERT INTO contacto VALUES ("112", "aulainformaticaejemplo@gmail.com", "+5491144445555");

INSERT INTO ubicacion_aula_x_fecha VALUES ("112", "2023-10-28", "-34.58290" ,"-58.47923", "Villa del Parque", "CABA", "1419");