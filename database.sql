-- Adminer 4.8.1 MySQL 8.0.32-0ubuntu0.22.04.2 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `projet2`;
CREATE DATABASE `projet2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `projet2`;

DROP TABLE IF EXISTS `fav_photo`;
CREATE TABLE `fav_photo` (
  `fav_id` int NOT NULL AUTO_INCREMENT,
  `fav_user_id` int NOT NULL,
  `fav_photo_id` int NOT NULL,
  PRIMARY KEY (`fav_id`),
  KEY `user_id` (`fav_user_id`),
  KEY `photo_id` (`fav_photo_id`),
  CONSTRAINT `fav_photo_ibfk_1` FOREIGN KEY (`fav_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `fav_photo_ibfk_2` FOREIGN KEY (`fav_photo_id`) REFERENCES `photo` (`photo_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `fav_photo` (`fav_id`, `fav_user_id`, `fav_photo_id`) VALUES
(1,	1,	3),
(12,	1,	8),
(14,	1,	6),
(15,	1,	10);

DROP TABLE IF EXISTS `photo`;
CREATE TABLE `photo` (
  `photo_id` int NOT NULL AUTO_INCREMENT,
  `photo_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `photo_link` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `photo_prompt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `photo_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `photo_date` datetime DEFAULT NULL,
  `photo_user_id` int DEFAULT NULL,
  PRIMARY KEY (`photo_id`),
  KEY `photo_user_id` (`photo_user_id`),
  CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`photo_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `photo` (`photo_id`, `photo_title`, `photo_link`, `photo_prompt`, `photo_description`, `photo_date`, `photo_user_id`) VALUES
(1,	'mini dark vador',	'https://image.lexica.art/full_jpg/a164f6cf-9e0e-4f5d-bd60-a1e99b307c12',	'darth vader dj com fone de ouvido, tocando em festa',	'dark vador',	'2023-04-18 23:42:18',	NULL),
(2,	'comic book character',	'https://image.lexica.art/full_jpg/e863d213-0a7c-43a1-b84e-fe297522719b',	'epic comic book cover',	'comic book character',	'2023-04-18 23:42:18',	NULL),
(3,	'blabla',	'https://mpost.io/wp-content/uploads/image-46-38.jpg',	'a vibrant professional studio portrait photography of a young, pale, goth, attractive, friendly, casual, delightful, intricate, gorgeous, female, piercing green eyes, wears a gold ankh necklace, femme fatale, nouveau, curated collection, annie leibovitz, nikon, award winning, breathtaking, groundbreaking, superb, outstanding, lensculture portrait awards, photoshopped, dramatic lighting, 8 k, hi res –testp –ar 3:4 –upbeta',	'A portrait of woman',	'2023-04-18 23:42:18',	NULL),
(5,	'blabla',	'https://mpost.io/wp-content/uploads/image-46-48.jpg',	'temple in ruines, forest, stairs, columns, cinematic, detailed, atmospheric, epic, concept art, Matte painting, background, mist, photo-realistic, concept art, volumetric light, cinematic epic + rule of thirds octane render, 8k, corona render, movie concept art, octane render, cinematic, trending on artstation, movie concept art, cinematic composition , ultra-detailed, realistic , hyper-realistic , volumetric lighting, 8k –ar 2:3 –test –uplight',	'Greek old temple',	'2023-04-18 23:42:18',	NULL),
(6,	'blabla',	'https://mpost.io/wp-content/uploads/image-46-54.jpg',	'a cute magical flying dog, fantasy art drawn by disney concept artists, golden colour, high quality, highly detailed, elegant, sharp focus, concept art, character concepts, digital painting, mystery, adventure',	'My cute little dog',	'2023-04-18 23:42:18',	NULL),
(7,	'blabla',	'https://image.lexica.art/full_jpg/fdc66817-abe9-468a-88bb-21ec0ca738e3',	'Cute small fox waving at me and smiling greeting me in front of theater door, unreal engine, cozy indoor lighting, artstation, detailed, digital painting, cinematic, character design by mark ryden and pixar and hayao miyazaki, unreal 5, daz, hyperrealistic, octane render',	'Cute small fox',	'2023-04-18 23:42:18',	NULL),
(8,	'blabla',	'https://stablediffusion.fr/assets/2023-02/380383665-a%20highly%20detailed%20matte%20painting%20of%20pizza%20by%20studio%20ghibli,%20makoto%20shinkai,%20by%20artgerm,%20by%20wlop,%20by%20greg%20rutkowski,%20volumetric%20l.webp',	'a highly detailed matte painting of pizza by studio ghibli, makoto shinkai, by artgerm, by wlop, by greg rutkowski, volumetric',	'A boy looking for a big pizza',	'2023-04-18 23:42:18',	NULL),
(9,	'blabla',	'https://stablediffusion.fr/assets/2023-03/1031297738-oul painting, a portrait of george clooney in 19th century, beautiful painting with highly detailed face by greg rutkowski and m.webp',	'oul painting, a portrait of george clooney in 19th century, beautiful painting with highly detailed face by greg rutkowski and',	'George clooney',	'2023-04-18 23:42:18',	NULL),
(10,	'blabla',	'https://stablediffusion.fr/assets/2023-03/1551426893-Luke Skywalker ordering a burger and fries from the Death Star canteen.webp',	'Luke Skywalker ordering a burger and fries from the Death Star canteen',	'Luke Skywalker ordering a burger',	'2023-04-18 23:42:18',	NULL),
(12,	'blabla',	'https://image.lexica.art/full_jpg/e4b2754f-fcea-49c2-bcc6-51cfd9fd6885',	'Cute and adorable cartoon fluffy baby rhea, fantasy, dreamlike, surrealism, super cute, trending on artstation',	'Cute and adorable cartoon fluffy baby rhea',	'2023-04-18 23:42:18',	NULL),
(13,	'blabla',	'https://image.lexica.art/full_jpg/65a02cc1-217c-40fe-bfe2-6ba54d16c7a9',	'Archeology game item by blizzard entertainment, mobile game asset, isometric, centralised, low details, no background, no shadow',	'Archeology game item by blizzard ',	'2023-04-18 23:42:18',	NULL),
(14,	'a little cow',	'https://image.lexica.art/full_jpg/bfcbf7a1-2c9b-4d54-a50a-83480fa89663',	'a little cow with hat and icecream realistic',	'a little cow',	'2023-04-18 23:42:18',	NULL),
(15,	'blabla',	'https://image.lexica.art/full_jpg/165e1775-6172-45ab-8718-eb4dd42418db',	'An astronaut in a rose garden on a spring day, by white woman and wlop : : ornate, dynamic, particulate, rich colors, intricate, elegant, highly detailed, harper\'s bazaar art, fashion magazine, smooth, sharp focus, 8 k, octane render',	'An astronaut',	'2023-04-18 23:42:18',	NULL),
(16,	'blabla',	'https://image.lexica.art/full_jpg/9fca43d4-84fd-4e05-b516-de094f28756f',	'Stunning detailed golden nintendo, trending on ArtStation',	'A golden jewel',	'2023-04-18 23:42:18',	NULL),
(17,	'blabla',	'https://image.lexica.art/full_jpg/b4fe36da-8470-45c7-814b-06c3a3eaee5e',	'cute penguin in a jar',	'Mr pinguin',	'2023-04-18 23:42:18',	NULL),
(18,	'blabla',	'https://cdn.openai.com/labs/images/3D%20render%20of%20a%20cute%20tropical%20fish%20in%20an%20aquarium%20on%20a%20dark%20blue%20background,%20digital%20art.webp?v=1',	'dgfggfgfgfg',	'fjfjjf',	'2023-04-18 23:42:18',	NULL),
(19,	'blabla',	'https://image.lexica.art/full_jpg/5ec3f9fd-9adb-4050-9325-77768b2ca4da',	'Motoko Kusanagi in Blade Runner (1982), neo noir, cyberpunk, traditional art',	'ffffff',	'2023-04-18 23:42:18',	NULL);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role` varchar(20) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `user` (`user_id`, `user_name`, `user_password`, `user_role`) VALUES
(1,	'user',	'password',	'user');

-- 2023-04-20 08:23:08
