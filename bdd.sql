-- MySQL Script generated by MySQL Workbench
-- Tue Apr 13 08:57:02 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema db-basic-blog
--
-- Tests to build a diagram on db-basic-blog work
-- 
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_basic_blog` DEFAULT CHARACTER SET utf8 ;
USE `db-basic-blog` ;

-- -----------------------------------------------------
-- Table `db-basic-blog`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_basic_blog`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(150) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db-basic-blog`.`post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_basic_blog`.`post` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  `content` LONGTEXT NOT NULL,
  `created_at` DATETIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db-basic-blog`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_basic_blog`.`category` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `slug` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `db-basic-blog`.`post_category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_basic_blog`.`post_category` (
  `post_id` INT NOT NULL,
  `category_id` INT NOT NULL,
  PRIMARY KEY (`post_id`, `category_id`),
  CONSTRAINT `fk_post`
    FOREIGN KEY (`post_id`)
    REFERENCES `db_basic_blog`.`post` (`id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT,
  CONSTRAINT `fk__category`
    FOREIGN KEY (`category_id`)
    REFERENCES `db_basic_blog`.`category` (`id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;