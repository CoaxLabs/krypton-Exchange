// Création table users

	CREATE TABLE IF NOT EXISTS `users` (
  		id int(11) NOT NULL AUTO_INCREMENT,
  		username varchar(100) NOT NULL,
  		password varchar(255) NOT NULL,
  		email varchar(255) NOT NULL,
  		admin enum('1','2','3') DEFAULT '1',
  		created_at datetime DEFAULT CURRENT_TIMESTAMP,
  	PRIMARY KEY (`id`),
  	UNIQUE KEY `username` (`username`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

// Reset auto-increment to 1

	ALTER TABLES users 
	MODIFY id AUTO_INCREMENT=1 ;

// Requête pour set admin un membre

	UPDATE `users` SET `admin` = '1' WHERE `users`.`id` = 1

// Création table currencies
 
	CREATE TABLE IF NOT EXISTS `currencies` (
		id_crypto int(11) NOT NULL AUTO_INCREMENT,
		name_crypto varchar(100) NOT NULL,
		acronyme char(3) NOT NULL,
		price bigint(7) NOT NULL,
		capacity bigint(10) NOT NULL,
	PRIMARY KEY (`id_crypto`),
	UNIQUE KEY `uk_name_crypto` (`name_crypto`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT = 1;

// Création de la table portefeuille

	CREATE TABLE IF NOT EXISTS `balance`(
		id_user int(11),
		id_currency int(11),
		quantity bigint(10),
		balance int(255) DEFAULT NULL,
		CONSTRAINT `FK_id` FOREIGN KEY (`id_user`) REFERENCES `users`(`id`),
		CONSTRAINT `FK_id_crypto` FOREIGN KEY (`id_currency`) REFERENCES `currencies`(`id_crypto`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

// Requête pour modifier une crypto

	SELECT id FROM   
	MODIFY price  