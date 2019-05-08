CREATE TABLE IF NOT EXISTS `#__rekrutacja` (
	`id` int(10) NOT NULL AUTO_INCREMENT,
	`login` text NOT NULL,
	`password` char(76) NOT NULL,
	`schoolName` char(50),
	`tOfSchool` char(50),
	`tOfClass` char(50),
	`superadmin` tinyint(1) NOT NULL DEFAULT 0,
	`active` tinyint(1) NOT NULL DEFAULT 0,
	`dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `#__konkursy` (
	`id` int(10) NOT NULL AUTO_INCREMENT,
	`name` text NOT NULL,
	`id_grkonkursy` int(10),
	`timeOfEvent` TIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `#__grkonkursy` (
	`id` int(10) NOT NULL AUTO_INCREMENT,
	`nazwa` text NOT NULL,
	`onlyOnce` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `#__przypisane` (
	`id` int(10) NOT NULL AUTO_INCREMENT,
	`id_rekrutacja` int(10) NOT NULL,
	`id_konkursy` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

#INSERT INTO `#__rekrutacja` (`login`, `password`) VALUES ('piotrgrohs@gmail.com', 'adminUser123#');
