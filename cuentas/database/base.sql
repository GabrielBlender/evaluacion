CREATE DATABASE evaluacion;

CREATE TABLE `evaluacion`.`c_banco` (
    `id` SMALLINT(6) NOT NULL AUTO_INCREMENT,
    `clave` VARCHAR(50) NOT NULL ,
    `nombre_corto` VARCHAR(50) NOT NULL ,
    `banco` TEXT NOT NULL , 
    `id_status` TINYINT(4) NOT NULL , 
    `orden` SMALLINT(6) NOT NULL , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `evaluacion`.`c_cuentas_bancarias` (
    `id` INT(11) NOT NULL ,
    `alias` VARCHAR(50) NOT NULL ,
    `id_banco` SMALLINT(6) NOT NULL , 
    `ultimos_digitos` VARCHAR(10) NOT NULL ,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE c_cuentas_bancarias ADD FOREIGN KEY (id_banco) REFERENCES c_banco(id);