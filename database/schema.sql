DROP TABLE IF EXISTS `message`;
DROP TABLE IF EXISTS `hangman`;
DROP TABLE IF EXISTS `chat`;

CREATE TABLE `message`(
	message_id		INT UNSIGNED	NOT NULL	AUTO_INCREMENT,
	Sid				VARCHAR(50)		NOT NULL,
	date_created    VARCHAR(50)		NOT NULL,
	date_updated    VARCHAR(50)		NOT NULL,
	date_sent       VARCHAR(50)		NOT NULL,
	account_sid     VARCHAR(50)		NOT NULL,
	message_from    VARCHAR(50)		NOT NULL,
	message_to      VARCHAR(50)		NOT NULL,
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

CREATE TABLE `hangman` (
    game_id         INT UNSIGNED            NOT NULL AUTO_INCREMENT,
    message_from    VARCHAR(50)             NOT NULL,
    guesses         INT                     NOT NULL,
    word            varchar(50)             NOT NULL,
    current_word    varchar(50)             NOT NULL,
    PRIMARY KEY     (game_id)
);

CREATE TABLE `chat` (
    `id`            INT(11)                 NOT NULL AUTO_INCREMENT,
    `number`        INT(15)                 NOT NULL,
    `data`          longtext                NOT NULL,
    `room`          longtext                NOT NULL,
    PRIMARY KEY     (`id`),
    KEY     `id` (`id`)
);