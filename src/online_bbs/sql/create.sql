CREATE DATABASE `online_bbs`;

CREATE TABLE `post` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(40),
  `comment` VARCHAR(200),
  `created_at` DATETIME,
  PRIMARY KEY(id)
) ENGINE = INNODB;
