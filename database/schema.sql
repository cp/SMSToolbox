DROP TABLE IF EXISTS `message`;

CREATE TABLE `message`(
	message_id		INT UNSIGNED	NOT NULL	AUTO_INCREMENT,
	Sid				VARCHAR(50)		NOT NULL,
	date_created    VARCHAR(50)		NOT NULL,
	date_updated    VARCHAR(50)		NOT NULL,
	date_sent       VARCHAR(50)		NOT NULL,
	account_sid     VARCHAR(50)		NOT NULL,
	message_from    VARCHAR(50)		NOT NULL,
	message_to      VARCHAR(50)		NOT NULL,
	message_body    TEXT			NOT NULL,
	status          VARCHAR(50)		NOT NULL,
	direction       VARCHAR(50)		NOT NULL,
	price           VARCHAR(50)		NOT NULL,
	api_version      VARCHAR(50)		NOT NULL,
	uri             VARCHAR(50)		NOT NULL,
	app             VARCHAR(50)		NOT NULL,
	feature         VARCHAR(50)		NOT NULL,
	command         TEXT			NOT NULL,

	PRIMARY KEY		(message_id)		
);
