CREATE session_masterpasswords (
	id INT(11) PRIMARY KEY AUTO_INCREMENT, 
	master_password VARCHAR(60), 
	user_id INT(11) NULL,
	session_id VARCHAR(36) NOT NULL,
	created_at DATETIME NOT NULL DEFAULT '2023-01-01 00:00:00'
) Engine=InnoDB;
ALTER TABLE session_masterpasswords ADD FULLTEXT INDEX `master_password_fulltext`(`master_password`);
ALTER TABLE session_masterpasswords ADD FULLTEXT INDEX `session_id_fulltext`(`session_id`);

-- lookup ip if session being claimed by user
CREATE session_ips (
	session_id VARCHAR(36) NOT NULL
	ip_address VARCHAR(55) UNSIGNED COMMENT 'help retrieve a  masterpassword with both IP and users session' 
	created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	expire_at DATETIME
) Engine=InnoDB;
ALTER TABLE session_ips ADD FULLTEXT INDEX `ip_address_fulltext`(`ip_address`);
ALTER TABLE session_ips ADD FULLTEXT INDEX `session_id_fulltext`(`session_id`);