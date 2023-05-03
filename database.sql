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
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `photo_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `photo_id` (`photo_id`),
  CONSTRAINT `fav_photo_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fav_photo_ibfk_4` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `fav_photo` (`id`, `user_id`, `photo_id`) VALUES
(22,	18,	1),
(26,	16,	5),
(27,	16,	16),
(34,	19,	14),
(36,	19,	15),
(37,	19,	7),
(38,	19,	17),
(39,	19,	8),
(40,	19,	23),
(45,	16,	23),
(46,	16,	14),
(47,	16,	25),
(48,	18,	27),
(49,	20,	28),
(50,	20,	12),
(51,	20,	29),
(52,	20,	31),
(57,	18,	34),
(58,	18,	33),
(60,	18,	31);

DROP TABLE IF EXISTS `follower_followed`;
CREATE TABLE `follower_followed` (
  `id` int NOT NULL AUTO_INCREMENT,
  `follower_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `following_id` (`user_id`),
  CONSTRAINT `follower_followed_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `follower_followed` (`id`, `follower_id`, `user_id`) VALUES
(1,	20,	16);

DROP TABLE IF EXISTS `photo`;
CREATE TABLE `photo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `link` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prompt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `photo_user_id` (`user_id`),
  CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `photo` (`id`, `title`, `link`, `prompt`, `description`, `date`, `user_id`) VALUES
(1,	'mini dark vador',	'https://image.lexica.art/full_jpg/a164f6cf-9e0e-4f5d-bd60-a1e99b307c12',	'darth vader dj com fone de ouvido, tocando em festa',	'dark vador is the DJ',	'2023-04-18 23:42:18',	16),
(2,	'comic book character',	'https://image.lexica.art/full_jpg/e863d213-0a7c-43a1-b84e-fe297522719b',	'epic comic book cover',	'comic book character',	'2023-04-18 23:42:18',	16),
(3,	'Goth woman',	'https://mpost.io/wp-content/uploads/image-46-38.jpg',	'a vibrant professional studio portrait photography of a young, pale, goth, attractive, friendly, casual, delightful, intricate, gorgeous, female, piercing green eyes, wears a gold ankh necklace, femme fatale, nouveau, curated collection, annie leibovitz, nikon, award winning, breathtaking, groundbreaking, superb, outstanding, lensculture portrait awards, photoshopped, dramatic lighting, 8 k, hi res –testp –ar 3:4 –upbeta',	'A portrait of woman',	'2023-04-18 23:42:18',	16),
(5,	'Greek temple ruines',	'https://mpost.io/wp-content/uploads/image-46-48.jpg',	'temple in ruines, forest, stairs, columns, cinematic, detailed, atmospheric, epic, concept art, Matte painting, background, mist, photo-realistic, concept art, volumetric light, cinematic epic + rule of thirds octane render, 8k, corona render, movie concept art, octane render, cinematic, trending on artstation, movie concept art, cinematic composition , ultra-detailed, realistic , hyper-realistic , volumetric lighting, 8k –ar 2:3 –test –uplight',	'Greek old temple',	'2023-04-18 23:42:18',	18),
(7,	'Cutie fox',	'https://image.lexica.art/full_jpg/fdc66817-abe9-468a-88bb-21ec0ca738e3',	'Cute small fox waving at me and smiling greeting me in front of theater door, unreal engine, cozy indoor lighting, artstation, detailed, digital painting, cinematic, character design by mark ryden and pixar and hayao miyazaki, unreal 5, daz, hyperrealistic, octane render',	'Cute small fox',	'2023-04-18 23:42:18',	18),
(8,	'Huge pizza in the kitchen',	'https://stablediffusion.fr/assets/2023-02/380383665-a%20highly%20detailed%20matte%20painting%20of%20pizza%20by%20studio%20ghibli,%20makoto%20shinkai,%20by%20artgerm,%20by%20wlop,%20by%20greg%20rutkowski,%20volumetric%20l.webp',	'a highly detailed matte painting of pizza by studio ghibli, makoto shinkai, by artgerm, by wlop, by greg rutkowski, volumetric',	'A boy looking for a big pizza',	'2023-04-18 23:42:18',	18),
(10,	'Luke at the dinner',	'https://stablediffusion.fr/assets/2023-03/1551426893-Luke Skywalker ordering a burger and fries from the Death Star canteen.webp',	'Luke Skywalker ordering a burger and fries from the Death Star canteen',	'Luke Skywalker ordering a burger',	'2023-04-18 23:42:18',	16),
(12,	'Fluffy mouse',	'https://image.lexica.art/full_jpg/e4b2754f-fcea-49c2-bcc6-51cfd9fd6885',	'Cute and adorable cartoon fluffy baby rhea, fantasy, dreamlike, surrealism, super cute, trending on artstation',	'Cute and adorable cartoon fluffy baby rhea',	'2023-04-18 23:42:18',	16),
(13,	'Game board',	'https://image.lexica.art/full_jpg/65a02cc1-217c-40fe-bfe2-6ba54d16c7a9',	'Archeology game item by blizzard entertainment, mobile game asset, isometric, centralised, low details, no background, no shadow',	'Archeology game item by blizzard ',	'2023-04-18 23:42:18',	16),
(14,	'a little cow5',	'https://image.lexica.art/full_jpg/bfcbf7a1-2c9b-4d54-a50a-83480fa89663',	'a little cow with hat and icecream realistic',	'a little cow',	'2023-04-18 23:42:18',	18),
(15,	'Wedding astronaut',	'https://image.lexica.art/full_jpg/165e1775-6172-45ab-8718-eb4dd42418db',	'An astronaut in a rose garden on a spring day, by white woman and wlop : : ornate, dynamic, particulate, rich colors, intricate, elegant, highly detailed, harper\'s bazaar art, fashion magazine, smooth, sharp focus, 8 k, octane render',	'An astronaut',	'2023-04-18 23:42:18',	18),
(16,	'Nintendo award',	'https://image.lexica.art/full_jpg/9fca43d4-84fd-4e05-b516-de094f28756f',	'Stunning detailed golden nintendo, trending on ArtStation',	'A golden jewel',	'2023-04-18 23:42:18',	16),
(17,	'Penguin in a jar',	'https://image.lexica.art/full_jpg/b4fe36da-8470-45c7-814b-06c3a3eaee5e',	'cute penguin in a jar on the ice',	'Cute penguin',	'2023-04-18 23:42:18',	18),
(18,	'My blue goldfish',	'https://cdn.openai.com/labs/images/3D%20render%20of%20a%20cute%20tropical%20fish%20in%20an%20aquarium%20on%20a%20dark%20blue%20background,%20digital%20art.webp?v=1',	'3D render of a blue goldfish in a bowl',	'Blue goldfish',	'2023-04-18 23:42:18',	16),
(19,	'Motoko Kusanagi',	'https://image.lexica.art/full_jpg/5ec3f9fd-9adb-4050-9325-77768b2ca4da',	'Motoko Kusanagi in Blade Runner (1982), neo noir, cyberpunk, traditional art',	'Ghost in the Shell x Blade Runner',	'2023-04-18 23:42:18',	16),
(23,	'titre',	'https://image.lexica.art/full_jpg/5517e8d4-7ab7-4a45-95e7-c16d8af27f64',	'pixel art, cyberpunk synthwave style. sloth hanging from a tree out at a gas station in the jungle. deep pinks and purple colors.',	'sloth hanging from a tree',	'2023-04-22 22:15:08',	18),
(25,	'a little dino',	'https://image.lexica.art/full_jpg/0be6509d-68e7-4c7a-bb3f-cf9d6ecc3456',	'CUTE AND ADORABLE CARTOON FLUFFY dinosaur, SILVER, GLITTER, TREASURE, DREAMLIKE, SURREALISM, SUPER CUTE, TRENDING ON ARTSTATION',	'a little dino',	'2023-04-23 18:53:13',	18),
(27,	'Bracelet',	'https://stablediffusion.fr/assets/prompt/crane%20buckskin%20bracelet%20with%20crane%20features,%20rich%20details,%20fine%20carvings,%20studio%20lighting.webp',	'crane buckskin bracelet with crane features, rich details, fine carvings, studio lighting',	'bracelet',	'2023-04-27 22:06:10',	16),
(28,	'Dinosaur Skeleton',	'https://stablediffusion.fr/assets/prompt/Simplified_technical_drawing_Leonardo_da_Vinci_Dinosaur_Skeleton_Hand_drawn_illustration.webp',	'Simplified technical drawing, Leonardo da Vinci, Mechanical Dinosaur Skeleton, Minimalistic annotations, Hand-drawn illustrations, Basic design and engineering, Wonder and curiosity',	'Dinosaur Skeleton',	'2023-04-27 22:07:15',	16),
(29,	'Small owl',	'https://stablediffusion.fr/assets/prompt/cute_toy_owl_made_of_suede_geometric_accurate_relief_on_skin_plastic_relief_surface_of_body.webp',	'cute toy owl made of suede, geometric accurate, relief on skin, plastic relief surface of body, intricate details, cinematic,',	'Small owl',	'2023-04-27 22:09:27',	16),
(31,	'beautiful eagle2',	'https://stablediffusion.fr/assets/prompt/eagle_framed_vector_flowers_shiny_floral.webp',	'overwhelmingly beautiful eagle framed with vector flowers, long shiny wavy flowing hair, polished, ultra detailed vector floral illustration mixed with hyper realism, muted pastel colors, vector floral details in background, muted colors, hyper detailed ultra intricate overwhelming realism in detailed complex scene with magical fantasy atmosphere, no signature, no watermark',	'beautiful eagle',	'2023-04-27 22:13:24',	18),
(32,	'a man on a hill watching a rocket launch',	'https://stablediffusion.fr/assets/prompt/painting_man_hill_watching_rocket_launch.webp',	'a highly detailed matte painting of a man on a hill watching a rocket launch in the distance by studio ghibli, makoto shinkai, by artgerm, by wlop, by greg rutkowski, volumetric lighting, octane render, 4 k resolution, trending on artstation, masterpiece | hyperrealism| highly detailed| insanely detailed| intricate| cinematic lighting| depth of field',	'a man on a hill watching a rocket launch',	'2023-04-27 22:16:07',	20),
(33,	'underwater world',	'https://stablediffusion.fr/assets/prompt/underwater_world_plants_flowers_shells.webp',	'underwater world, plants, flowers, shells, creatures, high detail, sharp focus, 4k',	'underwater world',	'2023-04-27 22:17:00',	20),
(34,	'pocket watch',	'https://stablediffusion.fr/assets/prompt/industrial_age_brass_watch.webp',	'industrial age, (pocket watch), 35mm, sharp, high gloss, brass, gears wallpaper, cinematic atmosphere, panoramic',	'pocket watch',	'2023-04-27 22:18:48',	20);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
(16,	'user2',	'$2y$10$R1Ejw/ERinvjQ3rCkg/73eIDTHtwicbshPdeKfRGco//arP6WYtXi',	'user'),
(18,	'user',	'$2y$10$9eQWWXRGG9sP0Dv8CM6fEeMMCsfDqUyjA0TDwZBdP6Y5g6BLu8Jd.',	'user'),
(19,	'fred',	'$2y$10$7G3M3IsobtUNemUIyZtnH.lWDlRcvlFJhDu6KmzByBLMzwMUftPQC',	'user'),
(20,	'user3',	'$2y$10$sbKiQoqmAuc4SsyarxH2n.aPW15VmwlROyFlDTDVV9pf7jQdDoVma',	'user');

DROP TABLE IF EXISTS `vote`;
CREATE TABLE `vote` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vote` int NOT NULL,
  `photo_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `photo_id` (`photo_id`),
  CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- 2023-05-03 11:00:46
