<?php

$pdo = new PDO('mysql:host=localhost;port=8889;dbname=whrwe', 'fred', 'zap');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*
CREATE DATABASE whrwe DEFAULT CHARACTER SET utf8 ;

GRANT ALL ON whrwe.* TO 'fred'@'localhost' IDENTIFIED BY 'zap';
GRANT ALL ON whrwe.* TO 'fred'@'127.0.0.1' IDENTIFIED BY 'zap';

drop table if exists user;
drop table if exists context;
drop table if exists context_map;

create table user (
    user_id             INTEGER NOT NULL AUTO_INCREMENT,
    user_sha256         CHAR(64) NOT NULL,
    user_key            TEXT NOT NULL,

    key_id              INTEGER NOT NULL,
    profile_id          INTEGER NULL,

    displayname         TEXT NULL,
    email               TEXT NULL,

    json                TEXT NULL,
    login_at            DATETIME NULL,

    entity_version      INTEGER NOT NULL DEFAULT 0,

    created_at          TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at          TIMESTAMP NOT NULL DEFAULT 0,

    UNIQUE(user_sha256),
    PRIMARY KEY(user_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

create table context (
    context_id          INTEGER NOT NULL AUTO_INCREMENT,
    context_sha256      CHAR(64) NOT NULL,
    context_key         TEXT NOT NULL,

    title               TEXT NULL,

    json                TEXT NULL,
    settings            TEXT NULL,
    settings_url        TEXT NULL,
    entity_version      INTEGER NOT NULL DEFAULT 0,
    created_at          TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at          TIMESTAMP NOT NULL DEFAULT 0,

    UNIQUE(context_sha256),
    PRIMARY KEY (context_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

INSERT INTO context (context_sha256, context_key) VALUES ('a','a');

create table context_map (
    context_id  INTEGER NOT NULL,
    user_id     INTEGER NOT NULL,
    lat         FLOAT,
    lng         FLOAT,
    color       INTEGER,
    email       TINYINT,
    name        TINYINT,
    first       TINYINT,
    updated_at  DATETIME NOT NULL,

    CONSTRAINT `context_map_ibfk_1`
        FOREIGN KEY (`context_id`)
        REFERENCES `context` (`context_id`)
        ON DELETE CASCADE ON UPDATE CASCADE,

    CONSTRAINT `context_map_ibfk_2`
        FOREIGN KEY (`user_id`)
        REFERENCES `user` (`user_id`)
        ON DELETE CASCADE ON UPDATE CASCADE,

    UNIQUE(context_id, user_id)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

*/
