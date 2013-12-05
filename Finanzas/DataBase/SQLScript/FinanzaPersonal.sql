SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `FinanzaPersonal` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `FinanzaPersonal` ;

-- -----------------------------------------------------
-- Table `FinanzaPersonal`.`Usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `FinanzaPersonal`.`Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(50) NOT NULL ,
  `password` VARCHAR(50) NOT NULL ,
  `fbook` VARCHAR(50) NOT NULL ,
  PRIMARY KEY (`idUsuario`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `FinanzaPersonal`.`Rubros`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `FinanzaPersonal`.`Rubros` (
  `idRubros` INT NOT NULL AUTO_INCREMENT ,
  `descripcion` VARCHAR(50) NOT NULL ,
  `libro` TINYINT(1) NOT NULL ,
  `Usuario_idUsuario` INT NOT NULL ,
  PRIMARY KEY (`idRubros`, `Usuario_idUsuario`) ,
  INDEX `fk_Rubros_Usuario1_idx` (`Usuario_idUsuario` ASC) ,
  CONSTRAINT `fk_Rubros_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario` )
    REFERENCES `FinanzaPersonal`.`Usuario` (`idUsuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `FinanzaPersonal`.`Transaccion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `FinanzaPersonal`.`Transaccion` (
  `idTransaccion` INT NOT NULL AUTO_INCREMENT ,
  `fecha` DATE NOT NULL ,
  `Rubros_idRubros` INT NOT NULL ,
  `Usuario_idUsuario` INT NOT NULL ,
  PRIMARY KEY (`idTransaccion`, `Rubros_idRubros`, `Usuario_idUsuario`) ,
  INDEX `fk_Transaccion_Rubros1_idx` (`Rubros_idRubros` ASC) ,
  INDEX `fk_Transaccion_Usuario1_idx` (`Usuario_idUsuario` ASC) ,
  CONSTRAINT `fk_Transaccion_Rubros1`
    FOREIGN KEY (`Rubros_idRubros` )
    REFERENCES `FinanzaPersonal`.`Rubros` (`idRubros` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Transaccion_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario` )
    REFERENCES `FinanzaPersonal`.`Usuario` (`idUsuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `FinanzaPersonal`.`DetalleTransaccion`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `FinanzaPersonal`.`DetalleTransaccion` (
  `idDetalleTransaccion` INT NOT NULL AUTO_INCREMENT ,
  `detalle` VARCHAR(50) NOT NULL ,
  `monto` DOUBLE NOT NULL ,
  `Transaccion_idTransaccion` INT NOT NULL ,
  `Usuario_idUsuario` INT NOT NULL ,
  PRIMARY KEY (`idDetalleTransaccion`, `Transaccion_idTransaccion`, `Usuario_idUsuario`) ,
  INDEX `fk_DetalleTransaccion_Transaccion_idx` (`Transaccion_idTransaccion` ASC) ,
  INDEX `fk_DetalleTransaccion_Usuario1_idx` (`Usuario_idUsuario` ASC) ,
  CONSTRAINT `fk_DetalleTransaccion_Transaccion`
    FOREIGN KEY (`Transaccion_idTransaccion` )
    REFERENCES `FinanzaPersonal`.`Transaccion` (`idTransaccion` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DetalleTransaccion_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario` )
    REFERENCES `FinanzaPersonal`.`Usuario` (`idUsuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `FinanzaPersonal` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
