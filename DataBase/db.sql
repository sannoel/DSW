-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema carrinhoCompras
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema carrinhoCompras
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `carrinhoCompras` DEFAULT CHARACTER SET utf8 ;
USE `carrinhoCompras` ;

-- -----------------------------------------------------
-- Table `carrinhoCompras`.`produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `carrinhoCompras`.`produto` (
  `idproduto` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `descricao` VARCHAR(100) NULL,
  `valor` FLOAT NOT NULL,
  `imagem` INT NULL,
  `texto` VARCHAR(2000) NOT NULL,
  PRIMARY KEY (`idproduto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `carrinhoCompras`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `carrinhoCompras`.`cliente` (
  `cpf` VARCHAR(30) NOT NULL,
  `nome` VARCHAR(100) NOT NULL,
  `dataNascimento` VARCHAR(10) NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `endereco` VARCHAR(255) NOT NULL,
  `cep` VARCHAR(9) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `complemento` VARCHAR(255),
  `estado` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`cpf`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `carrinhoCompras`.`carrinho`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `carrinhoCompras`.`carrinho` (
  `idcarrinho` INT NOT NULL AUTO_INCREMENT,
  `cliente_cpf` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idcarrinho`, `cliente_cpf`),
  INDEX `fk_carrinho_cliente1_idx` (`cliente_cpf` ASC),
  CONSTRAINT `fk_carrinho_cliente1`
    FOREIGN KEY (`cliente_cpf`)
    REFERENCES `carrinhoCompras`.`cliente` (`cpf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `carrinhoCompras`.`carrinho_has_produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `carrinhoCompras`.`carrinho_has_produto` (
  `carrinho_idcarrinho` INT NOT NULL,
  `produto_idproduto` INT NOT NULL,
  `quantidade` INT NOT NULL,
  PRIMARY KEY (`carrinho_idcarrinho`, `produto_idproduto`),
  INDEX `fk_carrinho_has_produto_produto1_idx` (`produto_idproduto` ASC),
  INDEX `fk_carrinho_has_produto_carrinho1_idx` (`carrinho_idcarrinho` ASC),
  CONSTRAINT `fk_carrinho_has_produto_carrinho1`
    FOREIGN KEY (`carrinho_idcarrinho`)
    REFERENCES `carrinhoCompras`.`carrinho` (`idcarrinho`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_carrinho_has_produto_produto1`
    FOREIGN KEY (`produto_idproduto`)
    REFERENCES `carrinhoCompras`.`produto` (`idproduto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


insert into produto (nome, descricao, valor, imagem, texto) values ('Iphone 8', 'Iphone 8 amet commodo nulla facilisi nullam', 3400, 1, "Iphone 8 Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Iaculis urna id volutpat lacus laoreet non curabitur gravida. Erat pellentesque adipiscing commodo elit at. Scelerisque in dictum non consectetur a. Auctor neque vitae tempus quam pellentesque nec nam aliquam. Mauris cursus mattis molestie a iaculis at erat pellentesque adipiscing. Egestas tellus rutrum tellus pellentesque eu tincidunt tortor aliquam nulla. Amet commodo nulla facilisi nullam vehicula. Pharetra diam sit amet nisl suscipit adipiscing. Pulvinar elementum integer enim neque volutpat ac tincidunt vitae semper. Pretium aenean pharetra magna ac placerat vestibulum lectus. Quisque egestas diam in arcu. Nulla facilisi etiam dignissim diam quis. Dolor magna eget est lorem ipsum dolor. Elit pellentesque habitant morbi tristique senectus et netus. Quisque sagittis purus sit amet volutpat consequat mauris.");
insert into produto (nome, descricao, valor, imagem, texto) values ('Iphone XR', 'Iphone XR amet commodo nulla facilisi nullam', 3750, 2, "Iphone XR Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Iaculis urna id volutpat lacus laoreet non curabitur gravida. Erat pellentesque adipiscing commodo elit at. Scelerisque in dictum non consectetur a. Auctor neque vitae tempus quam pellentesque nec nam aliquam. Mauris cursus mattis molestie a iaculis at erat pellentesque adipiscing. Egestas tellus rutrum tellus pellentesque eu tincidunt tortor aliquam nulla. Amet commodo nulla facilisi nullam vehicula. Pharetra diam sit amet nisl suscipit adipiscing. Pulvinar elementum integer enim neque volutpat ac tincidunt vitae semper. Pretium aenean pharetra magna ac placerat vestibulum lectus. Quisque egestas diam in arcu. Nulla facilisi etiam dignissim diam quis. Dolor magna eget est lorem ipsum dolor. Elit pellentesque habitant morbi tristique senectus et netus. Quisque sagittis purus sit amet volutpat consequat mauris.");
insert into produto (nome, descricao, valor, imagem, texto) values ('iPhone 6S', 'iPhone 6S amet commodo nulla facilisi nullam', 1600, 3, "iPhone 6S Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Iaculis urna id volutpat lacus laoreet non curabitur gravida. Erat pellentesque adipiscing commodo elit at. Scelerisque in dictum non consectetur a. Auctor neque vitae tempus quam pellentesque nec nam aliquam. Mauris cursus mattis molestie a iaculis at erat pellentesque adipiscing. Egestas tellus rutrum tellus pellentesque eu tincidunt tortor aliquam nulla. Amet commodo nulla facilisi nullam vehicula. Pharetra diam sit amet nisl suscipit adipiscing. Pulvinar elementum integer enim neque volutpat ac tincidunt vitae semper. Pretium aenean pharetra magna ac placerat vestibulum lectus. Quisque egestas diam in arcu. Nulla facilisi etiam dignissim diam quis. Dolor magna eget est lorem ipsum dolor. Elit pellentesque habitant morbi tristique senectus et netus. Quisque sagittis purus sit amet volutpat consequat mauris.");
insert into produto (nome, descricao, valor, imagem, texto) values ('Iphone Xs ', 'Iphone Xs  amet commodo nulla facilisi nullam', 5900, 4, "Iphone Xs  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Iaculis urna id volutpat lacus laoreet non curabitur gravida. Erat pellentesque adipiscing commodo elit at. Scelerisque in dictum non consectetur a. Auctor neque vitae tempus quam pellentesque nec nam aliquam. Mauris cursus mattis molestie a iaculis at erat pellentesque adipiscing. Egestas tellus rutrum tellus pellentesque eu tincidunt tortor aliquam nulla. Amet commodo nulla facilisi nullam vehicula. Pharetra diam sit amet nisl suscipit adipiscing. Pulvinar elementum integer enim neque volutpat ac tincidunt vitae semper. Pretium aenean pharetra magna ac placerat vestibulum lectus. Quisque egestas diam in arcu. Nulla facilisi etiam dignissim diam quis. Dolor magna eget est lorem ipsum dolor. Elit pellentesque habitant morbi tristique senectus et netus. Quisque sagittis purus sit amet volutpat consequat mauris.");
insert into produto (nome, descricao, valor, imagem, texto) values ('Iphone 7', 'Iphone 7 amet commodo nulla facilisi nullam', 3000, 5, "Iphone 7 Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Iaculis urna id volutpat lacus laoreet non curabitur gravida. Erat pellentesque adipiscing commodo elit at. Scelerisque in dictum non consectetur a. Auctor neque vitae tempus quam pellentesque nec nam aliquam. Mauris cursus mattis molestie a iaculis at erat pellentesque adipiscing. Egestas tellus rutrum tellus pellentesque eu tincidunt tortor aliquam nulla. Amet commodo nulla facilisi nullam vehicula. Pharetra diam sit amet nisl suscipit adipiscing. Pulvinar elementum integer enim neque volutpat ac tincidunt vitae semper. Pretium aenean pharetra magna ac placerat vestibulum lectus. Quisque egestas diam in arcu. Nulla facilisi etiam dignissim diam quis. Dolor magna eget est lorem ipsum dolor. Elit pellentesque habitant morbi tristique senectus et netus. Quisque sagittis purus sit amet volutpat consequat mauris.");
insert into produto (nome, descricao, valor, imagem, texto) values ('Iphone 8 Plus', 'Iphone 8 Plus amet commodo nulla facilisi nullam', 3400, 6, "Iphone 8 Plus Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Iaculis urna id volutpat lacus laoreet non curabitur gravida. Erat pellentesque adipiscing commodo elit at. Scelerisque in dictum non consectetur a. Auctor neque vitae tempus quam pellentesque nec nam aliquam. Mauris cursus mattis molestie a iaculis at erat pellentesque adipiscing. Egestas tellus rutrum tellus pellentesque eu tincidunt tortor aliquam nulla. Amet commodo nulla facilisi nullam vehicula. Pharetra diam sit amet nisl suscipit adipiscing. Pulvinar elementum integer enim neque volutpat ac tincidunt vitae semper. Pretium aenean pharetra magna ac placerat vestibulum lectus. Quisque egestas diam in arcu. Nulla facilisi etiam dignissim diam quis. Dolor magna eget est lorem ipsum dolor. Elit pellentesque habitant morbi tristique senectus et netus. Quisque sagittis purus sit amet volutpat consequat mauris.");

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
