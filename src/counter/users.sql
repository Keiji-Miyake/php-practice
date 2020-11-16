CREATE TABLE `test`.`users` (
  `user_id` INT(11) UNSIGNED NOT NULL COMMENT 'プライマリキー' ,
  `password` CHAR(60) NOT NULL COMMENT 'パスワード' ,
  `user_name` VARCHAR(64) NOT NULL COMMENT '名前' ,
  `email` VARCHAR(128) NOT NULL COMMENT 'メールアドレス' ,
  `token` CHAR(60) NOT NULL COMMENT 'トークン' ,
  PRIMARY KEY (`user_id`),
  UNIQUE (`email`)
) ENGINE = InnoDB;
