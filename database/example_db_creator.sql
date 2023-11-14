create database inet;
use inet;

DROP TABLE IF EXISTS oferta_formativa;
DROP TABLE IF EXISTS contacto;
DROP VIEW IF EXISTS aula_movil_list_overview;
DROP VIEW IF EXISTS aula_movil_map_overview;
DROP TABLE IF EXISTS  ubicacion_aula_x_fecha;
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
    descripcion VARCHAR(10000) NOT NULL,
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

CREATE VIEW aula_movil_list_overview AS
SELECT n_atm, o.familia_profesional, o.nombre, o.fecha_inicio, o.fecha_fin
FROM aula_movil_details a
JOIN oferta_formativa o ON a.n_atm = o.n_aula_movil;

CREATE VIEW aula_movil_map_overview AS 
SELECT n_atm, estado 
FROM aula_movil_details;


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



INSERT INTO aula_movil_details VALUES ("24","62251206","1","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("29","62251205","1","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("68","62251208","1","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("71","62251207","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("73","A SOLICICTAR","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("97","62251209","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("108","","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("113","62251211","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("117","62251210","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("165","62251213","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("166","62251214","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("167","62251212","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("168","62251217","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("169","62251215","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("170","62251216","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("36","100090302","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("46","100090303","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("55","100090301","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("75","100090304","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("99","100090306","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("119","100090305","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("140","100090307","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("8","220216203","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("26","220216200","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("77","220216202","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("79","220216201","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("83","220216204","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("125","220216205","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("135","A SOLICICTAR ","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("2","260078507","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("23","260078501","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("44","260078502","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("47","260078503","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("74","260078506","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("82","260078504","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("85","260078505","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("13","140546827","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("48","140546801","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("57","140546802","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("76","140546826","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("103","140546828","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("110","140546829","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("121","140546830","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("150","140546831","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("156","A SOLICICTAR ","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("3","180182604","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("4","180182605","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("5","180182602","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("6","180182603","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("7","180182601","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("89","180182606","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("90","180182607","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("116","180182608","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("149","180182609","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("157","180182610","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("16","300336006","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("67","300336005","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("91","300336001","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("92","300336002","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("93","300336003","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("147","300336007","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("158","A SOLICICTAR ","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("10 (FLUVIAL)","300336004","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("35","340115101","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("37","340115103","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("62","340115102","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("94","340115104","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("100","340115105","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("129","340115106","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("152","A SOLICICTAR ","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("15","3800945-05","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("32","3800945-01","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("38","3800945-02","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("96","3800945-04","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("148","","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("159","A SOLICICTAR ","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("11","420097200","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("12","420097300","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("22","420099800","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("56","420097700","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("84","420099900","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("139","A SOLICICTAR ","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("61","460086901","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("78","460086903","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("101","460086902","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("109","460086904","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("153","A SOLICICTAR ","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("39","500266802","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("45","500266803","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("53","500266801","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("60","500266807","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("95","500266805","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("104","500266804","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("114","500266806","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("161","A SOLICICTAR ","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("41","540120201","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("59","540120202","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("69","540120203","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("80","540120204","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("107","540120205","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("122","540120206","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("146","540120207","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("162","A SOLICICTAR ","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("18","580124106","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("49","5800124102","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("54","580124101","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("106","580124103","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("118","580124104","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("136","580124107","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("123","A SOLICICTAR ","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("50","620107401","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("70","620107404","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("86","620107402","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("105","620107403","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("120","620107405","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("130","620107407","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("143","620107406","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("43","660160502","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("52","660160503","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("98","660160505","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("112","660160504","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("17 (TRAILER)","660160501","2","2023-10-28:13-15-00");
INSERT INTO aula_movil_details VALUES ("164","A SOLICICTAR","2","2023-10-28:13-15-00");

INSERT INTO contacto VALUES ("112", "aulainformaticaejemplo@gmail.com", "+5491144445555");
INSERT INTO contacto VALUES ("29", "aulainformaticaejempl2o@gmail.com", "+5491144445557");

INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("24", "2023-10-28", "2023-11-30", "-36.6969815180527", "-60.6088319815719", "Urquiza", "Buenos Aires", "7600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("29", "2023-10-28", "2023-11-30", "-36.7769015180527", "-60.5088319815719", "Villa Pueyrredón", "Buenos Aires", "7600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("68", "2023-10-28", "2023-11-30", "-36.9779415180527", "-60.5528319815719", "Caballito", "Buenos Aires", "7600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("71", "2023-10-28", "2023-11-30", "-36.6769415180527", "-60.5588319815719", "No especificada", "Buenos Aires", "7600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("73", "2023-10-28", "2023-11-30", "-36.6769415180527", "-60.5588319815719", "No especificada", "Buenos Aires", "7600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("97", "2023-10-28", "2023-11-30", "-36.6769415180527", "-60.5588319815719", "No especificada", "Buenos Aires", "7600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("108", "2023-10-28", "2023-11-30", "-36.6769415180527", "-60.5588319815719", "No especificada", "Buenos Aires", "7600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("113", "2023-10-28", "2023-11-30", "-36.6769415180527", "-60.5588319815719", "No especificada", "Buenos Aires", "7600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("117", "2023-10-28", "2023-11-30", "-36.6769415180527", "-60.5588319815719", "No especificada", "Buenos Aires", "7600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("165", "2023-10-28", "2023-11-30", "-36.6769415180527", "-60.5588319815719", "No especificada", "Buenos Aires", "7600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("166", "2023-10-28", "2023-11-30", "-36.6769415180527", "-60.5588319815719", "No especificada", "Buenos Aires", "7600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("167", "2023-10-28", "2023-11-30", "-36.6769415180527", "-60.5588319815719", "No especificada", "Buenos Aires", "7600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("168", "2023-10-28", "2023-11-30", "-36.6769415180527", "-60.5588319815719", "No especificada", "Buenos Aires", "7600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("169", "2023-10-28", "2023-11-30", "-36.6769415180527", "-60.5588319815719", "No especificada", "Buenos Aires", "7600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("170", "2023-10-28", "2023-11-30", "-36.6769415180527", "-60.5588319815719", "No especificada", "Buenos Aires", "7600");

INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("36", "2023-10-28", "2023-11-30", "-27.3358332810217", "-66.9476824299928", "No especificada", "Catamarca", "4700");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("46", "2023-10-28", "2023-11-30", "-27.3358332810217", "-66.9476824299928", "No especificada", "Catamarca", "4700");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("55", "2023-10-28", "2023-11-30", "-27.3358332810217", "-66.9476824299928", "No especificada", "Catamarca", "4700");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("75", "2023-10-28", "2023-11-30", "-27.3358332810217", "-66.9476824299928", "No especificada", "Catamarca", "4700");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("99", "2023-10-28", "2023-11-30", "-27.3358332810217", "-66.9476824299928", "No especificada", "Catamarca", "4700");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("119", "2023-10-28", "2023-11-30", "-27.3358332810217", "-66.9476824299928", "No especificada", "Catamarca", "4700");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("140", "2023-10-28", "2023-11-30", "-27.3358332810217", "-66.9476824299928", "No especificada", "Catamarca", "4700");

INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("8", "2023-10-28", "2023-11-30", "-26.3864309061226", "-60.7658307438603", "No especificada", "Chaco", "3500");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("26", "2023-10-28", "2023-11-30", "-26.3864309061226", "-60.7658307438603", "No especificada", "Chaco", "3500");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("77", "2023-10-28", "2023-11-30", "-26.3864309061226", "-60.7658307438603", "No especificada", "Chaco", "3500");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("79", "2023-10-28", "2023-11-30", "-26.3864309061226", "-60.7658307438603", "No especificada", "Chaco", "3500");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("83", "2023-10-28", "2023-11-30", "-26.3864309061226", "-60.7658307438603", "No especificada", "Chaco", "3500");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("125", "2023-10-28", "2023-11-30", "-26.3864309061226", "-60.7658307438603", "No especificada", "Chaco", "3500");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("135", "2023-10-28", "2023-11-30", "-26.3864309061226", "-60.7658307438603", "No especificada", "Chaco", "3500");

INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("2", "2023-10-28", "2023-11-30", "-43.7886233529878", "-68.5267593943345", "No especificada", "Chubut", "9103");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("23", "2023-10-28", "2023-11-30", "-43.7886233529878", "-68.5267593943345", "No especificada", "Chubut", "9103");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("44", "2023-10-28", "2023-11-30", "-43.7886233529878", "-68.5267593943345", "No especificada", "Chubut", "9103");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("47", "2023-10-28", "2023-11-30", "-43.7886233529878", "-68.5267593943345", "No especificada", "Chubut", "9103");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("74", "2023-10-28", "2023-11-30", "-43.7886233529878", "-68.5267593943345", "No especificada", "Chubut", "9103");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("82", "2023-10-28", "2023-11-30", "-43.7886233529878", "-68.5267593943345", "No especificada", "Chubut", "9103");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("85", "2023-10-28", "2023-11-30", "-43.7886233529878", "-68.5267593943345", "No especificada", "Chubut", "9103");

INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("13", "2023-10-28", "2023-11-30", "-32.142932663607", "-63.8017532741662", "No especificada", "Córdoba", "5000");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("48", "2023-10-28", "2023-11-30", "-32.142932663607", "-63.8017532741662", "No especificada", "Córdoba", "5000");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("57", "2023-10-28", "2023-11-30", "-32.142932663607", "-63.8017532741662", "No especificada", "Córdoba", "5000");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("76", "2023-10-28", "2023-11-30", "-32.142932663607", "-63.8017532741662", "No especificada", "Córdoba", "5000");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("103", "2023-10-28", "2023-11-30", "-32.142932663607", "-63.8017532741662", "No especificada", "Córdoba", "5000");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("110", "2023-10-28", "2023-11-30", "-32.142932663607", "-63.8017532741662", "No especificada", "Córdoba", "5000");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("121", "2023-10-28", "2023-11-30", "-32.142932663607", "-63.8017532741662", "No especificada", "Córdoba", "5000");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("150", "2023-10-28", "2023-11-30", "-32.142932663607", "-63.8017532741662", "No especificada", "Córdoba", "5000");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("156", "2023-10-28", "2023-11-30", "-32.142932663607", "-63.8017532741662", "No especificada", "Córdoba", "5000");

INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("3", "2023-10-28", "2023-11-30", "-28.7743047046407", "-57.8012191977913", "No especificada", "Corrientes", "3400");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("4", "2023-10-28", "2023-11-30", "-28.7743047046407", "-57.8012191977913", "No especificada", "Corrientes", "3400");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("5", "2023-10-28", "2023-11-30", "-28.7743047046407", "-57.8012191977913", "No especificada", "Corrientes", "3400");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("6", "2023-10-28", "2023-11-30", "-28.7743047046407", "-57.8012191977913", "No especificada", "Corrientes", "3400");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("7", "2023-10-28", "2023-11-30", "-28.7743047046407", "-57.8012191977913", "No especificada", "Corrientes", "3400");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("89", "2023-10-28", "2023-11-30", "-28.7743047046407", "-57.8012191977913", "No especificada", "Corrientes", "3400");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("90", "2023-10-28", "2023-11-30", "-28.1743047046407", "-58.8012191977913", "General Alvear", "Corrientes", "3400");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("116", "2023-10-28", "2023-11-30", "-28.7743047046407", "-57.8012191977913", "No especificada", "Corrientes", "3400");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("149", "2023-10-28", "2023-11-30", "-28.7743047046407", "-57.8012191977913", "No especificada", "Corrientes", "3400");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("157", "2023-10-28", "2023-11-30", "-28.7743047046407", "-57.8012191977913", "No especificada", "Corrientes", "3400");

INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("16", "2023-10-28", "2023-11-30", "-32.0588735436448", "-59.2014475514635", "No especificada", "Entre Ríos", "3100");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("67", "2023-10-28", "2023-11-30", "-32.0588735436448", "-59.2014475514635", "No especificada", "Entre Ríos", "3100");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("91", "2023-10-28", "2023-11-30", "-32.0588735436448", "-59.2014475514635", "No especificada", "Entre Ríos", "3100");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("92", "2023-10-28", "2023-11-30", "-32.0588735436448", "-59.2014475514635", "No especificada", "Entre Ríos", "3100");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("93", "2023-10-28", "2023-11-30", "-32.0588735436448", "-59.2014475514635", "No especificada", "Entre Ríos", "3100");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("147", "2023-10-28", "2023-11-30", "-32.0588735436448", "-59.2014475514635", "No especificada", "Entre Ríos", "3100");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("158", "2023-10-28", "2023-11-30", "-32.0588735436448", "-59.2014475514635", "No especificada", "Entre Ríos", "3100");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("10 (FLUVIAL)", "2023-10-28", "2023-11-30", "-32.0588735436448", "-59.2014475514635", "No especificada", "Entre Ríos", "3100");

INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("35", "2023-10-28", "2023-11-30", "-24.894972594871", "-59.9324405800872", "No especificada", "Formosa", "3600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("37", "2023-10-28", "2023-11-30", "-24.894972594871", "-59.9324405800872", "No especificada", "Formosa", "3600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("62", "2023-10-28", "2023-11-30", "-24.894972594871", "-59.9324405800872", "No especificada", "Formosa", "3600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("94", "2023-10-28", "2023-11-30", "-24.894972594871", "-59.9324405800872", "No especificada", "Formosa", "3600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("100", "2023-10-28", "2023-11-30", "-24.894972594871", "-59.9324405800872", "No especificada", "Formosa", "3600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("129", "2023-10-28", "2023-11-30", "-24.894972594871", "-59.9324405800872", "No especificada", "Formosa", "3600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("152", "2023-10-28", "2023-11-30", "-24.894972594871", "-59.9324405800872", "No especificada", "Formosa", "3600");


INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("15", "2023-10-28", "2023-11-30", "-23.3200784211351", "-65.7642522180337", "No especificada", "Jujuy", "4600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("32", "2023-10-28", "2023-11-30", "-23.3200784211351", "-65.7642522180337", "No especificada", "Jujuy", "4600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("38", "2023-10-28", "2023-11-30", "-23.3200784211351", "-65.7642522180337", "No especificada", "Jujuy", "4600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("96", "2023-10-28", "2023-11-30", "-23.3200784211351", "-65.7642522180337", "No especificada", "Jujuy", "4600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("148", "2023-10-28", "2023-11-30", "-23.3200784211351", "-65.7642522180337", "No especificada", "Jujuy", "4600");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("159", "2023-10-28", "2023-11-30", "-23.3200784211351", "-65.7642522180337", "No especificada", "Jujuy", "4600");


INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("11", "2023-10-28", "2023-11-30", "-37.1315537735949", "-65.4466546606951", "No especificada", "La Pampa", "6300");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("12", "2023-10-28", "2023-11-30", "-37.1315537735949", "-65.4466546606951", "No especificada", "La Pampa", "6300");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("22", "2023-10-28", "2023-11-30", "-37.1315537735949", "-65.4466546606951", "No especificada", "La Pampa", "6300");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("56", "2023-10-28", "2023-11-30", "-37.1315537735949", "-65.4466546606951", "No especificada", "La Pampa", "6300");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("84", "2023-10-28", "2023-11-30", "-37.1315537735949", "-65.4466546606951", "No especificada", "La Pampa", "6300");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("139", "2023-10-28", "2023-11-30", "-37.1315537735949", "-65.4466546606951", "No especificada", "La Pampa", "6300");

INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("61", "2023-10-28", "2023-11-30", "-29.685776298315", "-67.1817359694432", "No especificada", "La Rioja", "5300");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("78", "2023-10-28", "2023-11-30", "-29.685776298315", "-67.1817359694432", "No especificada", "La Rioja", "5300");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("101", "2023-10-28", "2023-11-30", "-29.685776298315", "-67.1817359694432", "No especificada", "La Rioja", "5300");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("109", "2023-10-28", "2023-11-30", "-29.685776298315", "-67.1817359694432", "No especificada", "La Rioja", "5300");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("153", "2023-10-28", "2023-11-30", "-29.685776298315", "-67.1817359694432", "No especificada", "La Rioja", "5300");

INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("39", "2023-10-28", "2023-11-30", "-34.6298873058957", "-68.5831228183798", "No especificada", "Mendoza", "5500");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("45", "2023-10-28", "2023-11-30", "-34.6298873058957", "-68.5831228183798", "No especificada", "Mendoza", "5500");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("53", "2023-10-28", "2023-11-30", "-34.6298873058957", "-68.5831228183798", "No especificada", "Mendoza", "5500");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("60", "2023-10-28", "2023-11-30", "-34.6298873058957", "-68.5831228183798", "No especificada", "Mendoza", "5500");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("95", "2023-10-28", "2023-11-30", "-34.6298873058957", "-68.5831228183798", "No especificada", "Mendoza", "5500");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("104", "2023-10-28", "2023-11-30", "-34.6298873058957", "-68.5831228183798", "No especificada", "Mendoza", "5500");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("114", "2023-10-28", "2023-11-30", "-34.6298873058957", "-68.5831228183798", "No especificada", "Mendoza", "5500");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("161", "2023-10-28", "2023-11-30", "-34.6298873058957", "-68.5831228183798", "No especificada", "Mendoza", "5500");

INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("41", "2023-10-28", "2023-11-30", "-34.6298873058957", "-68.5831228183798", "No especificada", "Misiones", "3300");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("59", "2023-10-28", "2023-11-30", "-34.6298873058957", "-68.5831228183798", "No especificada", "Misiones", "3300");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("69", "2023-10-28", "2023-11-30", "-34.6298873058957", "-68.5831228183798", "No especificada", "Misiones", "3300");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("80", "2023-10-28", "2023-11-30", "-34.6298873058957", "-68.5831228183798", "No especificada", "Misiones", "3300");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("107", "2023-10-28", "2023-11-30", "-34.6298873058957", "-68.5831228183798", "No especificada", "Misiones", "3300");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("122", "2023-10-28", "2023-11-30", "-34.6298873058957", "-68.5831228183798", "No especificada", "Misiones", "3300");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("146", "2023-10-28", "2023-11-30", "-34.6298873058957", "-68.5831228183798", "No especificada", "Misiones", "3300");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("162", "2023-10-28", "2023-11-30", "-34.6298873058957", "-68.5831228183798", "No especificada", "Misiones", "3300");

INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("18", "2023-10-28", "2023-11-30", "-38.6417575824599", "-70.1185705180601", "No especificada", "Neuquén", "8300");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("49", "2023-10-28", "2023-11-30", "-38.6417575824599", "-70.1185705180601", "No especificada", "Neuquén", "8300");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("54", "2023-10-28", "2023-11-30", "-38.6417575824599", "-70.1185705180601", "No especificada", "Neuquén", "8300");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("106", "2023-10-28", "2023-11-30", "-38.6417575824599", "-70.1185705180601", "No especificada", "Neuquén", "8300");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("118", "2023-10-28", "2023-11-30", "-38.6417575824599", "-70.1185705180601", "No especificada", "Neuquén", "8300");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("136", "2023-10-28", "2023-11-30", "-38.6417575824599", "-70.1185705180601", "No especificada", "Neuquén", "8300");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("123", "2023-10-28", "2023-11-30", "-38.6417575824599", "-70.1185705180601", "No especificada", "Neuquén", "8300");

INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("50", "2023-10-28", "2023-11-30", "-40.4057957178801", "-67.229329893694", "No especificada", "Río Negro", "8500");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("70", "2023-10-28", "2023-11-30", "-40.4057957178801", "-67.229329893694", "No especificada", "Río Negro", "8500");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("86", "2023-10-28", "2023-11-30", "-40.4057957178801", "-67.229329893694", "No especificada", "Río Negro", "8500");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("105", "2023-10-28", "2023-11-30", "-40.4057957178801", "-67.229329893694", "No especificada", "Río Negro", "8500");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("120", "2023-10-28", "2023-11-30", "-40.4057957178801", "-67.229329893694", "No especificada", "Río Negro", "8500");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("130", "2023-10-28", "2023-11-30", "-40.4057957178801", "-67.229329893694", "No especificada", "Río Negro", "8500");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("143", "2023-10-28", "2023-11-30", "-40.4057957178801", "-67.229329893694", "No especificada", "Río Negro", "8500");

INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("43", "2023-10-28", "2023-11-30", "-24.2991344492002", "-64.8144629600627", "No especificada", "Salta", "4400");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("52", "2023-10-28", "2023-11-30", "-24.2991344492002", "-64.8144629600627", "No especificada", "Salta", "4400");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("98", "2023-10-28", "2023-11-30", "-24.2991344492002", "-64.8144629600627", "No especificada", "Salta", "4400");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("112", "2023-10-28", "2023-11-30", "-24.2991344492002", "-64.8144629600627", "No especificada", "Salta", "4400");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("17 (TRAILER)", "2023-10-28", "2023-11-30", "-24.2991344492002", "-64.8144629600627", "No especificada", "Salta", "4400");
INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("164", "2023-10-28", "2023-11-30", "-24.2991344492002", "-64.8144629600627", "No especificada", "Salta", "4400");

INSERT INTO  ubicacion_aula_x_fecha (n_aula_movil, fecha_inicio, fecha_fin, longitud, latitud, localidad, provincia, codigo_postal) VALUES ("29", "2024-01-01", "2024-04-30", "-36.7769015180527", "-60.5088319815719", "Villa Pueyrredón", "Buenos Aires", "7600");




INSERT INTO oferta_formativa (n_aula_movil, familia_profesional, nombre, descripcion, fecha_inicio, fecha_fin) VALUES
(24, "Instalaciones domiciliarias", "Instalaciones de aires acondicionados", "Lorem ipsum dolor sit amet consectetur, adipiscing elit felis risus placerat, fusce faucibus sollicitudin dictum. Sem metus phasellus quis lectus malesuada sapien tempor curabitur, auctor himenaeos erat aliquet tellus consequat cras mattis, taciti praesent faucibus interdum fermentum ligula aenean. Himenaeos consequat blandit odio ullamcorper tempor luctus, etiam hendrerit per potenti rutrum mollis, tempus facilisis quisque duis semper.", "2024-03-05", "2024-06-05");
INSERT INTO oferta_formativa (n_aula_movil, familia_profesional, nombre, descripcion, fecha_inicio, fecha_fin) VALUES
(29, "Informática, redes y reparación de PC", "Taller de Linux (principiantes)", "Lorem ipsum dolor sit amet consectetur, adipiscing elit felis risus placerat, fusce faucibus sollicitudin dictum. Sem metus phasellus quis lectus malesuada sapien tempor curabitur, auctor himenaeos erat aliquet tellus consequat cras mattis, taciti praesent faucibus interdum fermentum ligula aenean. Himenaeos consequat blandit odio ullamcorper tempor luctus, etiam hendrerit per potenti rutrum mollis, tempus facilisis quisque duis semper.", "2024-03-05", "2024-04-05");

INSERT INTO oferta_formativa (n_aula_movil, familia_profesional, nombre, descripcion, fecha_inicio, fecha_fin) VALUES
(90, "Soldadura", "Soldaduras (intermedio)", "Lorem ipsum dolor sit amet consectetur, adipiscing elit felis risus placerat, fusce faucibus sollicitudin dictum. Sem metus phasellus quis lectus malesuada sapien tempor curabitur, auctor himenaeos erat aliquet tellus consequat cras mattis, taciti praesent faucibus interdum fermentum ligula aenean. Himenaeos consequat blandit odio ullamcorper tempor luctus, etiam hendrerit per potenti rutrum mollis, tempus facilisis quisque duis semper.", "2024-03-05", "2024-04-05");
INSERT INTO oferta_formativa (n_aula_movil, familia_profesional, nombre, descripcion, fecha_inicio, fecha_fin) VALUES
(90, "Genérica", "Formación básica de física y matemáticas", "Aprende o repasa las basaes de la física y la matemática, nivel pre-universitario. Duración: 1 mes Modalidad: virtual", "2024-03-05", "2024-04-05");
INSERT INTO oferta_formativa (n_aula_movil, familia_profesional, nombre, descripcion, fecha_inicio, fecha_fin) VALUES
(90, "Metalmecánica", "Manejo de tornos", "Aprende a manejar tornos para trabajar en la industria. Duración: 1 mes Modalidad: virtual", "2024-03-05", "2024-04-05");




