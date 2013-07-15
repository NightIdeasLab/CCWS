SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `s4r` ;
CREATE SCHEMA IF NOT EXISTS `s4r` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `s4r` ;

-- -----------------------------------------------------
-- Table `s4r`.`Users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `s4r`.`Users` ;

CREATE  TABLE IF NOT EXISTS `s4r`.`Users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `uuid` VARCHAR(100) NOT NULL ,
  `age` INT NOT NULL ,
  `nationality` VARCHAR(100) NOT NULL ,
  `gender` VARCHAR(3) NOT NULL ,
  `native` VARCHAR(5) NOT NULL ,
  `language_proficiency` VARCHAR(100) NOT NULL ,
  `speech_experience` VARCHAR(100) NOT NULL ,
  `background` VARCHAR(50) NOT NULL ,
  `microphone` VARCHAR(10) NOT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s4r`.`Tasks`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `s4r`.`Tasks` ;

CREATE  TABLE IF NOT EXISTS `s4r`.`Tasks` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s4r`.`TaskUserSentences`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `s4r`.`TaskUserSentences` ;

CREATE  TABLE IF NOT EXISTS `s4r`.`TaskUserSentences` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `uuid` VARCHAR(100) NOT NULL ,
  `task_id` INT NOT NULL ,
  `sentence_id` INT NOT NULL ,
  `sentence` VARCHAR(255) NOT NULL ,
  `audio_filename` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s4r`.`AudioFiles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `s4r`.`AudioFiles` ;

CREATE  TABLE IF NOT EXISTS `s4r`.`AudioFiles` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `uuid` VARCHAR(100) NOT NULL ,
  `step_number` VARCHAR(15) NOT NULL ,
  `audio_filename` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s4r`.`GrammarSentences`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `s4r`.`GrammarSentences` ;

CREATE  TABLE IF NOT EXISTS `s4r`.`GrammarSentences` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `sentence` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s4r`.`UsersTasks`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `s4r`.`UsersTasks` ;

CREATE  TABLE IF NOT EXISTS `s4r`.`UsersTasks` (
  `user_id` INT NOT NULL ,
  `task_id` INT NOT NULL ,
  PRIMARY KEY (`user_id`, `task_id`) ,
  INDEX `fk_UsersTasks_1_idx` (`user_id` ASC) ,
  INDEX `fk_UsersTasks_2_idx` (`task_id` ASC) ,
  CONSTRAINT `fk_UsersTasks_1`
    FOREIGN KEY (`user_id` )
    REFERENCES `s4r`.`Users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_UsersTasks_2`
    FOREIGN KEY (`task_id` )
    REFERENCES `s4r`.`Tasks` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s4r`.`UsersAudioFiles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `s4r`.`UsersAudioFiles` ;

CREATE  TABLE IF NOT EXISTS `s4r`.`UsersAudioFiles` (
  `user_id` INT NOT NULL ,
  `file_id` INT NOT NULL ,
  `uuid` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`user_id`, `file_id`) ,
  INDEX `fk_UsersAudioFiles_1_idx` (`user_id` ASC) ,
  INDEX `fk_UsersAudioFiles_2_idx` (`file_id` ASC) ,
  CONSTRAINT `fk_UsersAudioFiles_1`
    FOREIGN KEY (`user_id` )
    REFERENCES `s4r`.`Users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_UsersAudioFiles_2`
    FOREIGN KEY (`file_id` )
    REFERENCES `s4r`.`AudioFiles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s4r`.`GrammarSentencesAudioFiles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `s4r`.`GrammarSentencesAudioFiles` ;

CREATE  TABLE IF NOT EXISTS `s4r`.`GrammarSentencesAudioFiles` (
  `sentence_id` INT NOT NULL ,
  `file_id` INT NOT NULL ,
  PRIMARY KEY (`sentence_id`, `file_id`) ,
  INDEX `fk_GrammarSentencesAudioFiles_1_idx` (`sentence_id` ASC) ,
  INDEX `fk_GrammarSentencesAudioFiles_2_idx` (`file_id` ASC) ,
  CONSTRAINT `fk_GrammarSentencesAudioFiles_1`
    FOREIGN KEY (`sentence_id` )
    REFERENCES `s4r`.`GrammarSentences` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_GrammarSentencesAudioFiles_2`
    FOREIGN KEY (`file_id` )
    REFERENCES `s4r`.`AudioFiles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s4r`.`TaskSentencesAudioFiles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `s4r`.`TaskSentencesAudioFiles` ;

CREATE  TABLE IF NOT EXISTS `s4r`.`TaskSentencesAudioFiles` (
  `sentence_id` INT NOT NULL ,
  `file_id` INT NOT NULL ,
  PRIMARY KEY (`sentence_id`, `file_id`) ,
  INDEX `fk_TaskSentencesAudioFiles_1_idx` (`sentence_id` ASC) ,
  INDEX `fk_TaskSentencesAudioFiles_2_idx` (`file_id` ASC) ,
  CONSTRAINT `fk_TaskSentencesAudioFiles_1`
    FOREIGN KEY (`sentence_id` )
    REFERENCES `s4r`.`TaskUserSentences` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_TaskSentencesAudioFiles_2`
    FOREIGN KEY (`file_id` )
    REFERENCES `s4r`.`AudioFiles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s4r`.`TasksTaskSentences`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `s4r`.`TasksTaskSentences` ;

CREATE  TABLE IF NOT EXISTS `s4r`.`TasksTaskSentences` (
  `task_id` INT NOT NULL ,
  `sentence_id` INT NOT NULL ,
  PRIMARY KEY (`task_id`, `sentence_id`) ,
  INDEX `fk_TasksTaskSentences_1_idx` (`task_id` ASC) ,
  CONSTRAINT `fk_TasksTaskSentences_1`
    FOREIGN KEY (`task_id` )
    REFERENCES `s4r`.`Tasks` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s4r`.`GrammarUserSentences`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `s4r`.`GrammarUserSentences` ;

CREATE  TABLE IF NOT EXISTS `s4r`.`GrammarUserSentences` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `uuid` VARCHAR(100) NOT NULL ,
  `task_id` INT NOT NULL ,
  `sentence_id` INT NOT NULL ,
  `sentence` VARCHAR(255) NOT NULL ,
  `audio_filename` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `s4r`.`ICAPS_Sentences`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `s4r`.`ICAPS_Sentences` ;

CREATE  TABLE IF NOT EXISTS `s4r`.`ICAPS_Sentences` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `uuid` VARCHAR(100) NOT NULL ,
  `sentence` VARCHAR(255) NOT NULL ,
  `audio_filename` VARCHAR(255) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

USE `s4r` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `s4r`.`Users`
-- -----------------------------------------------------
START TRANSACTION;
USE `s4r`;
INSERT INTO `s4r`.`Users` (`id`, `uuid`, `age`, `nationality`, `gender`, `native`, `language_proficiency`, `speech_experience`, `background`, `microphone`, `name`) VALUES (1, '0', 0, 'none', 'none', 'none', 'none', 'none', 'none', 'none', 'none');

COMMIT;

-- -----------------------------------------------------
-- Data for table `s4r`.`Tasks`
-- -----------------------------------------------------
START TRANSACTION;
USE `s4r`;
INSERT INTO `s4r`.`Tasks` (`id`, `description`) VALUES (1, 'Reach a place, with/without speed options, with/without trajectory options');
INSERT INTO `s4r`.`Tasks` (`id`, `description`) VALUES (2, 'Follow people, with/without speed options, with/without additional options');
INSERT INTO `s4r`.`Tasks` (`id`, `description`) VALUES (3, 'Talk to people, either to ask them for something or to report some sentence instructed by the user');
INSERT INTO `s4r`.`Tasks` (`id`, `description`) VALUES (4, 'Check and search for people, objects, areas, or their status');
INSERT INTO `s4r`.`Tasks` (`id`, `description`) VALUES (5, 'Carry objects, with/without object specification, with/without destination options');

COMMIT;

-- -----------------------------------------------------
-- Data for table `s4r`.`TaskUserSentences`
-- -----------------------------------------------------
START TRANSACTION;
USE `s4r`;
INSERT INTO `s4r`.`TaskUserSentences` (`id`, `uuid`, `task_id`, `sentence_id`, `sentence`, `audio_filename`) VALUES (1, '0', 0, 0, 'catch the phone at the right of the desk', '0');
INSERT INTO `s4r`.`TaskUserSentences` (`id`, `uuid`, `task_id`, `sentence_id`, `sentence`, `audio_filename`) VALUES (2, '0', 0, 0, 'bring the pillow to the couch of the bedroom', '0');
INSERT INTO `s4r`.`TaskUserSentences` (`id`, `uuid`, `task_id`, `sentence_id`, `sentence`, `audio_filename`) VALUES (3, '0', 0, 0, 'activate the television at the right of the console', '0');
INSERT INTO `s4r`.`TaskUserSentences` (`id`, `uuid`, `task_id`, `sentence_id`, `sentence`, `audio_filename`) VALUES (4, '0', 0, 0, 'move near the television of the kitchen', '0');

COMMIT;

-- -----------------------------------------------------
-- Data for table `s4r`.`GrammarSentences`
-- -----------------------------------------------------
START TRANSACTION;
USE `s4r`;
INSERT INTO `s4r`.`GrammarSentences` (`id`, `sentence`) VALUES (1, 'grab the box on the left of the desktop');
INSERT INTO `s4r`.`GrammarSentences` (`id`, `sentence`) VALUES (2, 'disconnect from the laptop at the right of the counter');
INSERT INTO `s4r`.`GrammarSentences` (`id`, `sentence`) VALUES (3, 'bring the cigarettes near the counter on the right');
INSERT INTO `s4r`.`GrammarSentences` (`id`, `sentence`) VALUES (4, 'bring slowly the box near the counter of the kitchen');
INSERT INTO `s4r`.`GrammarSentences` (`id`, `sentence`) VALUES (5, 'search for the television at the left in the corridor');
INSERT INTO `s4r`.`GrammarSentences` (`id`, `sentence`) VALUES (6, 'disconnect from the router at the console');
INSERT INTO `s4r`.`GrammarSentences` (`id`, `sentence`) VALUES (7, 'go to the bathroom, take the rag, go to the hall and clean the mirror');
INSERT INTO `s4r`.`GrammarSentences` (`id`, `sentence`) VALUES (8, 'go to the kitchen');
INSERT INTO `s4r`.`GrammarSentences` (`id`, `sentence`) VALUES (9, 'take the remote control and turn on the TV');
INSERT INTO `s4r`.`GrammarSentences` (`id`, `sentence`) VALUES (10, 'go to living room and turn on the TV');
INSERT INTO `s4r`.`GrammarSentences` (`id`, `sentence`) VALUES (11, 'check the toilet paper');
INSERT INTO `s4r`.`GrammarSentences` (`id`, `sentence`) VALUES (12, 'show me a snapshot of the food cooking on the burner');
INSERT INTO `s4r`.`GrammarSentences` (`id`, `sentence`) VALUES (13, 'bring me my towel that is in the bathroom');
INSERT INTO `s4r`.`GrammarSentences` (`id`, `sentence`) VALUES (14, 'hang my coat in the closet in my bedroom');
INSERT INTO `s4r`.`GrammarSentences` (`id`, `sentence`) VALUES (15, 'check main door status');
INSERT INTO `s4r`.`GrammarSentences` (`id`, `sentence`) VALUES (16, 'go the main door and open it');
INSERT INTO `s4r`.`GrammarSentences` (`id`, `sentence`) VALUES (17, 'could you please move the trash bin from the kitchen to the studio?');
INSERT INTO `s4r`.`GrammarSentences` (`id`, `sentence`) VALUES (18, 'hang my coat in the closet in my bedroom');
INSERT INTO `s4r`.`GrammarSentences` (`id`, `sentence`) VALUES (19, 'could you please check if the coffee is ready?');
INSERT INTO `s4r`.`GrammarSentences` (`id`, `sentence`) VALUES (20, 'deliver this message to the person in the living room');

COMMIT;
