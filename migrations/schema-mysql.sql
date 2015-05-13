
drop table if exists `auth_user`;

CREATE TABLE `auth_user` (
  `id`                    integer NOT NULL AUTO_INCREMENT,
  `username`              varchar(128) NOT NULL,
  `password_hash`         char(60) NOT NULL,
  `password_reset_token`  char(43) NOT NULL DEFAULT '',
  `email`                 varchar(32) NOT NULL,
  `access_token`          char(60) NOT NULL DEFAULT '',
  `auth_key`              varchar(32) NOT NULL,
  `status`                tinyint(3) unsigned DEFAULT '10',
  `created_at`            integer unsigned DEFAULT '0',
  `updated_at`            integer unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user-username` (`username`),
  UNIQUE KEY `user-email` (`email`)
) ENGINE=InnoDB;