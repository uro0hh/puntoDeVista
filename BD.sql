CREATE TABLE `phpmyadmin`.`alumno` (
  `runAlumno` INT(8) NOT NULL,
  `dvAlumno` INT(1) NOT NULL,
  `nombreAlumno` VARCHAR(45) NOT NULL,
  `apellidoAlumno` VARCHAR(45) NOT NULL,
  `carreraAlumno` VARCHAR(45) NOT NULL,
  `anioIngresoAlumno` INT(4) NOT NULL,
  PRIMARY KEY (`runAlumno`));

CREATE TABLE `puntodevista`.`categoria_objeto` (
  `idCategoria_objeto` INT NOT NULL AUTO_INCREMENT,
  `nombreCategoria_objeto` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idCategoria_objeto`));

INSERT INTO `puntodevista`.`categoria_objeto` (`nombreCategoria_objeto`) VALUES ('Llaves');
INSERT INTO `puntodevista`.`categoria_objeto` (`nombreCategoria_objeto`) VALUES ('Mochila');
INSERT INTO `puntodevista`.`categoria_objeto` (`nombreCategoria_objeto`) VALUES ('Ropa');
INSERT INTO `puntodevista`.`categoria_objeto` (`nombreCategoria_objeto`) VALUES ('Libros');
INSERT INTO `puntodevista`.`categoria_objeto` (`nombreCategoria_objeto`) VALUES ('Cargador');
INSERT INTO `puntodevista`.`categoria_objeto` (`nombreCategoria_objeto`) VALUES ('Tarjeta de identificación');
INSERT INTO `puntodevista`.`categoria_objeto` (`nombreCategoria_objeto`) VALUES ('Gafas');
INSERT INTO `puntodevista`.`categoria_objeto` (`nombreCategoria_objeto`) VALUES ('audifonos');
INSERT INTO `puntodevista`.`categoria_objeto` (`nombreCategoria_objeto`) VALUES ('Calculadora');
INSERT INTO `puntodevista`.`categoria_objeto` (`nombreCategoria_objeto`) VALUES ('Joya');
INSERT INTO `puntodevista`.`categoria_objeto` (`nombreCategoria_objeto`) VALUES ('Notebook');
INSERT INTO `puntodevista`.`categoria_objeto` (`nombreCategoria_objeto`) VALUES ('accesorios pc');

CREATE TABLE `puntodevista`.`estado_objeto` (
  `idEstado_objeto` INT NOT NULL AUTO_INCREMENT,
  `nombreEstado_objeto` VARCHAR(50) NULL,
  PRIMARY KEY (`idEstado_objeto`));

INSERT INTO `puntodevista`.`estado_objeto` (`nombreEstado_objeto`) VALUES ('Punto Estudiantil');
INSERT INTO `puntodevista`.`estado_objeto` (`nombreEstado_objeto`) VALUES ('Perdido');
INSERT INTO `puntodevista`.`estado_objeto` (`nombreEstado_objeto`) VALUES ('Encontrado');


CREATE TABLE `puntodevista`.`objeto` (
  `idObjeto` INT NOT NULL AUTO_INCREMENT,
    `categoria_objeto_idCategoria_objeto` INT NOT NULL,
  `descripcionObjeto` VARCHAR(220) NOT NULL,
  `fechaIngresoObjeto` VARCHAR(45) NOT NULL,
  `salonObjeto` VARCHAR(45) NOT NULL,
  `imagenObjeto` LONGBLOB NOT NULL,
  `estado_objeto_idEstado_objeto` INT NOT NULL,
  PRIMARY KEY (`idObjeto`));

ALTER TABLE `puntodevista`.`objeto` 
ADD INDEX `fk_categoria_objeto_idCategoria_objeto_idx` (`categoria_objeto_idCategoria_objeto` ASC),
ADD INDEX `fk_estado_objeto_idEstado_objeto_idx` (`estado_objeto_idEstado_objeto` ASC);

ALTER TABLE `puntodevista`.`objeto` 
ADD CONSTRAINT `fk_categoria_objeto_idCategoria_objeto1`
  FOREIGN KEY (`categoria_objeto_idCategoria_objeto`)
  REFERENCES `puntodevista`.`categoria_objeto` (`idCategoria_objeto`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_estado_objeto_idEstado_objeto1`
  FOREIGN KEY (`estado_objeto_idEstado_objeto`)
  REFERENCES `puntodevista`.`estado_objeto` (`idEstado_objeto`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;



INSERT INTO `puntodevista`.`objeto` 
(`categoria_objeto_idCategoria_objeto`, `descripcionObjeto`, `fechaIngresoObjeto`, `salonObjeto`, `estado_objeto_idEstado_objeto`)
VALUES ('11', 'compu hp', '12-15-2024', 'w607', '3');


 












CREATE TABLE IF NOT EXISTS formulario2 (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    carrera VARCHAR(50) NOT NULL,
    objeto VARCHAR(100) NOT NULL
);
