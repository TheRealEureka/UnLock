DROP DATABASE IF EXISTS `unlock`;
CREATE DATABASE `unlock`;
USE `unlock`;

DROP TABLE IF EXISTS `game`;

CREATE TABLE `game` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `id_user` int(11) NOT NULL,
                        `currents_cards` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
                        `user_penality` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
                        `user_time` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
                        PRIMARY KEY (`id`),
                        UNIQUE KEY `UNIQ_232B318C6B3CA4B` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `username` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
                        `password` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
                        PRIMARY KEY (`id`),
                        UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `card`;

CREATE TABLE `card` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `numCarte` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
                        `image` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
                        `image_back` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
                        `type` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
                        `use` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
                        `require` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
                        PRIMARY KEY (`id`),
                        UNIQUE KEY `UNIQ_161498D3174EA90C` (`numCarte`),
                        UNIQUE KEY `UNIQ_161498D3C53D045F` (`image`),
                        UNIQUE KEY `UNIQ_161498D39FF42BA9` (`image_back`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;




