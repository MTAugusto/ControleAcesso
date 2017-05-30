-- MySQL Script generated by MySQL Workbench
-- Ter 30 Mai 2017 00:41:48 BRT
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema controleacesso
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `controleacesso` ;

-- -----------------------------------------------------
-- Schema controleacesso
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `controleacesso` DEFAULT CHARACTER SET utf8 ;
USE `controleacesso` ;

-- -----------------------------------------------------
-- Table `controleacesso`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controleacesso`.`clientes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `cpf` VARCHAR(255) NOT NULL,
  `telefone` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `controleacesso`.`tipos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controleacesso`.`tipos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `valorporhora` DECIMAL(10,2) NOT NULL,
  `valorpormes` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `controleacesso`.`veiculos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controleacesso`.`veiculos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo` INT NOT NULL,
  `placa` VARCHAR(45) NOT NULL,
  `modelo` VARCHAR(255) NOT NULL,
  `cor` VARCHAR(255) NOT NULL,
  `ismensal` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`, `tipo`),
  INDEX `fk_veiculos_tipos1_idx` (`tipo` ASC),
  UNIQUE INDEX `placa_UNIQUE` (`placa` ASC),
  CONSTRAINT `fk_veiculos_tipos1`
    FOREIGN KEY (`tipo`)
    REFERENCES `controleacesso`.`tipos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `controleacesso`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controleacesso`.`usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `usuario` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `status` TINYINT(1) NOT NULL,
  `admin` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `controleacesso`.`caixadiarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controleacesso`.`caixadiarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario` INT NOT NULL,
  `abertura` TIMESTAMP NULL,
  `fechamento` TIMESTAMP NULL,
  `valortotal` DECIMAL(10,2) NULL,
  `data` DATE NOT NULL,
  `isfechado` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`, `usuario`),
  INDEX `fk_caixadiarios_usuarios1_idx` (`usuario` ASC),
  CONSTRAINT `fk_caixadiarios_usuarios1`
    FOREIGN KEY (`usuario`)
    REFERENCES `controleacesso`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `controleacesso`.`clientes_veiculos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controleacesso`.`clientes_veiculos` (
  `cliente` INT NOT NULL AUTO_INCREMENT,
  `veiculo` INT NOT NULL,
  PRIMARY KEY (`cliente`, `veiculo`),
  INDEX `fk_clientes_has_veiculos_veiculos1_idx` (`veiculo` ASC),
  INDEX `fk_clientes_has_veiculos_clientes1_idx` (`cliente` ASC),
  CONSTRAINT `fk_clientes_has_veiculos_clientes1`
    FOREIGN KEY (`cliente`)
    REFERENCES `controleacesso`.`clientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_clientes_has_veiculos_veiculos1`
    FOREIGN KEY (`veiculo`)
    REFERENCES `controleacesso`.`veiculos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `controleacesso`.`entradas_veiculos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controleacesso`.`entradas_veiculos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario` INT NOT NULL,
  `veiculo` INT NOT NULL,
  `data` TIMESTAMP NULL,
  `jasaiu` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`, `usuario`, `veiculo`),
  INDEX `fk_entradas_veiculos_usuarios1_idx` (`usuario` ASC),
  INDEX `fk_entradas_veiculos_veiculos1_idx` (`veiculo` ASC),
  CONSTRAINT `fk_entradas_veiculos_usuarios1`
    FOREIGN KEY (`usuario`)
    REFERENCES `controleacesso`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_entradas_veiculos_veiculos1`
    FOREIGN KEY (`veiculo`)
    REFERENCES `controleacesso`.`veiculos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `controleacesso`.`saidas_veiculos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controleacesso`.`saidas_veiculos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `entrada_veiculo` INT NOT NULL,
  `usuario` INT NOT NULL,
  `data` TIMESTAMP NULL,
  `valor` DECIMAL(10,2) NOT NULL,
  `iscortesia` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`, `entrada_veiculo`, `usuario`),
  INDEX `fk_saidas_usuarios1_idx` (`usuario` ASC),
  INDEX `fk_saidas_veiculos_entradas_veiculos1_idx` (`entrada_veiculo` ASC),
  CONSTRAINT `fk_saidas_usuarios1`
    FOREIGN KEY (`usuario`)
    REFERENCES `controleacesso`.`usuarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_saidas_veiculos_entradas_veiculos1`
    FOREIGN KEY (`entrada_veiculo`)
    REFERENCES `controleacesso`.`entradas_veiculos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `controleacesso`.`mensalidades`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controleacesso`.`mensalidades` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cliente` INT NOT NULL,
  `veiculo` INT NOT NULL,
  `datavencimento` DATE NOT NULL,
  PRIMARY KEY (`id`, `cliente`, `veiculo`),
  INDEX `fk_mensalidade_veiculos1_idx` (`veiculo` ASC),
  INDEX `fk_mensalidade_clientes1_idx` (`cliente` ASC),
  CONSTRAINT `fk_mensalidade_veiculos1`
    FOREIGN KEY (`veiculo`)
    REFERENCES `controleacesso`.`veiculos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_mensalidade_clientes1`
    FOREIGN KEY (`cliente`)
    REFERENCES `controleacesso`.`clientes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `controleacesso`.`movimentacao_caixadiario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controleacesso`.`movimentacao_caixadiario` (
  `saida_veiculo` INT NOT NULL,
  `caixadiario` INT NOT NULL,
  PRIMARY KEY (`saida_veiculo`, `caixadiario`),
  INDEX `fk_saida_veiculos_has_caixadiario_caixadiario1_idx` (`caixadiario` ASC),
  INDEX `fk_saida_veiculos_has_caixadiario_saida_veiculos1_idx` (`saida_veiculo` ASC),
  CONSTRAINT `fk_saida_veiculos_has_caixadiario_saida_veiculos1`
    FOREIGN KEY (`saida_veiculo`)
    REFERENCES `controleacesso`.`saidas_veiculos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_saida_veiculos_has_caixadiario_caixadiario1`
    FOREIGN KEY (`caixadiario`)
    REFERENCES `controleacesso`.`caixadiarios` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
