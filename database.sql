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
(61,	24,	15),
(62,	24,	31),
(63,	24,	19),
(64,	24,	1),
(65,	24,	36),
(66,	21,	36),
(67,	21,	29),
(68,	21,	28),
(69,	21,	37),
(70,	21,	38),
(71,	21,	39),
(72,	22,	40),
(73,	22,	3),
(74,	22,	39),
(75,	22,	37),
(76,	23,	42),
(77,	23,	41),
(78,	23,	36),
(79,	23,	43),
(80,	25,	45),
(81,	25,	41),
(82,	25,	42),
(83,	25,	38);

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
(6,	24,	23),
(7,	24,	22),
(8,	24,	21),
(9,	24,	25),
(10,	21,	24),
(11,	21,	22),
(12,	22,	21),
(13,	22,	24),
(14,	22,	25),
(15,	23,	21),
(16,	23,	24),
(17,	23,	22),
(18,	25,	23),
(19,	25,	22),
(20,	21,	25);

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
(1,	'mini dark vador2',	'https://image.lexica.art/full_jpg/a164f6cf-9e0e-4f5d-bd60-a1e99b307c12',	'darth vader dj com fone de ouvido, tocando em festa',	'dark vador is the DJ',	'2023-04-18 23:42:18',	21),
(2,	'comic book character',	'https://image.lexica.art/full_jpg/e863d213-0a7c-43a1-b84e-fe297522719b',	'epic comic book cover',	'comic book character',	'2023-04-18 23:42:18',	21),
(3,	'Goth woman',	'https://mpost.io/wp-content/uploads/image-46-38.jpg',	'a vibrant professional studio portrait photography of a young, pale, goth, attractive, friendly, casual, delightful, intricate, gorgeous, female, piercing green eyes, wears a gold ankh necklace, femme fatale, nouveau, curated collection, annie leibovitz, nikon, award winning, breathtaking, groundbreaking, superb, outstanding, lensculture portrait awards, photoshopped, dramatic lighting, 8 k, hi res –testp –ar 3:4 –upbeta',	'A portrait of woman',	'2023-04-18 23:42:18',	21),
(5,	'Greek temple ruines',	'https://mpost.io/wp-content/uploads/image-46-48.jpg',	'temple in ruines, forest, stairs, columns, cinematic, detailed, atmospheric, epic, concept art, Matte painting, background, mist, photo-realistic, concept art, volumetric light, cinematic epic + rule of thirds octane render, 8k, corona render, movie concept art, octane render, cinematic, trending on artstation, movie concept art, cinematic composition , ultra-detailed, realistic , hyper-realistic , volumetric lighting, 8k –ar 2:3 –test –uplight',	'Greek old temple',	'2023-04-18 23:42:18',	22),
(7,	'Cutie fox',	'https://image.lexica.art/full_jpg/fdc66817-abe9-468a-88bb-21ec0ca738e3',	'Cute small fox waving at me and smiling greeting me in front of theater door, unreal engine, cozy indoor lighting, artstation, detailed, digital painting, cinematic, character design by mark ryden and pixar and hayao miyazaki, unreal 5, daz, hyperrealistic, octane render',	'Cute small fox',	'2023-04-18 23:42:18',	22),
(8,	'Huge pizza in the kitchen',	'https://stablediffusion.fr/assets/2023-02/380383665-a%20highly%20detailed%20matte%20painting%20of%20pizza%20by%20studio%20ghibli,%20makoto%20shinkai,%20by%20artgerm,%20by%20wlop,%20by%20greg%20rutkowski,%20volumetric%20l.webp',	'a highly detailed matte painting of pizza by studio ghibli, makoto shinkai, by artgerm, by wlop, by greg rutkowski, volumetric',	'A boy looking for a big pizza',	'2023-04-18 23:42:18',	22),
(10,	'Luke at the dinner',	'https://stablediffusion.fr/assets/2023-03/1551426893-Luke Skywalker ordering a burger and fries from the Death Star canteen.webp',	'Luke Skywalker ordering a burger and fries from the Death Star canteen',	'Luke Skywalker ordering a burger',	'2023-04-18 23:42:18',	23),
(12,	'Fluffy mouse',	'https://image.lexica.art/full_jpg/e4b2754f-fcea-49c2-bcc6-51cfd9fd6885',	'Cute and adorable cartoon fluffy baby rhea, fantasy, dreamlike, surrealism, super cute, trending on artstation',	'Cute and adorable cartoon fluffy baby rhea',	'2023-04-18 23:42:18',	23),
(13,	'Game board',	'https://image.lexica.art/full_jpg/65a02cc1-217c-40fe-bfe2-6ba54d16c7a9',	'Archeology game item by blizzard entertainment, mobile game asset, isometric, centralised, low details, no background, no shadow',	'Archeology game item by blizzard ',	'2023-04-18 23:42:18',	23),
(14,	'a little cow5',	'https://image.lexica.art/full_jpg/bfcbf7a1-2c9b-4d54-a50a-83480fa89663',	'a little cow with hat and icecream realistic',	'a little cow',	'2023-04-18 23:42:18',	24),
(15,	'Wedding astronaut',	'https://image.lexica.art/full_jpg/165e1775-6172-45ab-8718-eb4dd42418db',	'An astronaut in a rose garden on a spring day, by white woman and wlop : : ornate, dynamic, particulate, rich colors, intricate, elegant, highly detailed, harper\'s bazaar art, fashion magazine, smooth, sharp focus, 8 k, octane render',	'An astronaut',	'2023-04-18 23:42:18',	24),
(16,	'Nintendo award',	'https://image.lexica.art/full_jpg/9fca43d4-84fd-4e05-b516-de094f28756f',	'Stunning detailed golden nintendo, trending on ArtStation',	'A golden jewel',	'2023-04-18 23:42:18',	24),
(17,	'Penguin in a jar',	'https://image.lexica.art/full_jpg/b4fe36da-8470-45c7-814b-06c3a3eaee5e',	'cute penguin in a jar on the ice',	'Cute penguin',	'2023-04-18 23:42:18',	25),
(18,	'My blue goldfish',	'https://cdn.openai.com/labs/images/3D%20render%20of%20a%20cute%20tropical%20fish%20in%20an%20aquarium%20on%20a%20dark%20blue%20background,%20digital%20art.webp?v=1',	'3D render of a blue goldfish in a bowl',	'Blue goldfish',	'2023-04-18 23:42:18',	25),
(19,	'Motoko Kusanagi',	'https://image.lexica.art/full_jpg/5ec3f9fd-9adb-4050-9325-77768b2ca4da',	'Motoko Kusanagi in Blade Runner (1982), neo noir, cyberpunk, traditional art',	'Ghost in the Shell x Blade Runner',	'2023-04-18 23:42:18',	25),
(23,	'titre',	'https://image.lexica.art/full_jpg/5517e8d4-7ab7-4a45-95e7-c16d8af27f64',	'pixel art, cyberpunk synthwave style. sloth hanging from a tree out at a gas station in the jungle. deep pinks and purple colors.',	'sloth hanging from a tree',	'2023-04-22 22:15:08',	21),
(25,	'a little dino',	'https://image.lexica.art/full_jpg/0be6509d-68e7-4c7a-bb3f-cf9d6ecc3456',	'CUTE AND ADORABLE CARTOON FLUFFY dinosaur, SILVER, GLITTER, TREASURE, DREAMLIKE, SURREALISM, SUPER CUTE, TRENDING ON ARTSTATION',	'a little dino',	'2023-04-23 18:53:13',	21),
(27,	'Bracelet',	'https://stablediffusion.fr/assets/prompt/crane%20buckskin%20bracelet%20with%20crane%20features,%20rich%20details,%20fine%20carvings,%20studio%20lighting.webp',	'crane buckskin bracelet with crane features, rich details, fine carvings, studio lighting',	'bracelet',	'2023-04-27 22:06:10',	22),
(28,	'Dinosaur Skeleton',	'https://stablediffusion.fr/assets/prompt/Simplified_technical_drawing_Leonardo_da_Vinci_Dinosaur_Skeleton_Hand_drawn_illustration.webp',	'Simplified technical drawing, Leonardo da Vinci, Mechanical Dinosaur Skeleton, Minimalistic annotations, Hand-drawn illustrations, Basic design and engineering, Wonder and curiosity',	'Dinosaur Skeleton',	'2023-04-27 22:07:15',	22),
(29,	'Small owl',	'https://stablediffusion.fr/assets/prompt/cute_toy_owl_made_of_suede_geometric_accurate_relief_on_skin_plastic_relief_surface_of_body.webp',	'cute toy owl made of suede, geometric accurate, relief on skin, plastic relief surface of body, intricate details, cinematic,',	'Small owl',	'2023-04-27 22:09:27',	23),
(31,	'beautiful eagle2',	'https://stablediffusion.fr/assets/prompt/eagle_framed_vector_flowers_shiny_floral.webp',	'overwhelmingly beautiful eagle framed with vector flowers, long shiny wavy flowing hair, polished, ultra detailed vector floral illustration mixed with hyper realism, muted pastel colors, vector floral details in background, muted colors, hyper detailed ultra intricate overwhelming realism in detailed complex scene with magical fantasy atmosphere, no signature, no watermark',	'beautiful eagle',	'2023-04-27 22:13:24',	23),
(32,	'a man on a hill watching a rocket launch',	'https://stablediffusion.fr/assets/prompt/painting_man_hill_watching_rocket_launch.webp',	'a highly detailed matte painting of a man on a hill watching a rocket launch in the distance by studio ghibli, makoto shinkai, by artgerm, by wlop, by greg rutkowski, volumetric lighting, octane render, 4 k resolution, trending on artstation, masterpiece | hyperrealism| highly detailed| insanely detailed| intricate| cinematic lighting| depth of field',	'a man on a hill watching a rocket launch',	'2023-04-27 22:16:07',	24),
(33,	'underwater world',	'https://stablediffusion.fr/assets/prompt/underwater_world_plants_flowers_shells.webp',	'underwater world, plants, flowers, shells, creatures, high detail, sharp focus, 4k',	'underwater world',	'2023-04-27 22:17:00',	24),
(34,	'pocket watch',	'https://stablediffusion.fr/assets/prompt/industrial_age_brass_watch.webp',	'industrial age, (pocket watch), 35mm, sharp, high gloss, brass, gears wallpaper, cinematic atmosphere, panoramic',	'pocket watch',	'2023-04-27 22:18:48',	25),
(36,	'Teddy bear on skateboard',	'https://cdn.openai.com/labs/images/A%20photo%20of%20a%20teddy%20bear%20on%20a%20skateboard%20in%20Times%20Square.webp?v=1',	'A teddy bear on a skateboard in a crowded Times Square',	'Teddy bear skateboarding in Times Square',	'2023-05-09 11:32:04',	24),
(37,	'Balloon above a lake',	'https://cdn.openai.com/labs/images/A%203D%20render%20of%20a%20rainbow%20colored%20hot%20air%20balloon%20flying%20above%20a%20reflective%20lake.webp?v=1',	'A 3D render of a rainbow colored hot air balloon flying above a reflective lake',	'Balloon above lake',	'2023-05-09 11:33:20',	21),
(38,	'Fur monster',	'https://cdn.openai.com/labs/images/A%20photo%20of%20a%20white%20fur%20monster%20standing%20in%20a%20purple%20room.webp?v=1',	'A photo of a white fur monster standing in a purple room',	'Fur monster',	'2023-05-09 11:35:58',	21),
(39,	'Blue orange',	'https://cdn.openai.com/labs/images/A%20blue%20orange%20sliced%20in%20half%20laying%20on%20a%20blue%20floor%20in%20front%20of%20a%20blue%20wall.webp?v=1',	'A blue orange sliced in half laying on a blue floor in front of a blue wall',	'The earth',	'2023-05-09 11:36:34',	21),
(40,	'Desert night',	'https://cdn.openai.com/labs/images/A%20photo%20of%20a%20silhouette%20of%20a%20person%20in%20a%20color%20lit%20desert%20at%20night.webp?v=1',	'A photo of a silhouette of a person in a color lit desert at night',	'Desert night with a person',	'2023-05-09 11:37:21',	22),
(41,	'Astro Monkey',	'https://cdn.openai.com/labs/images/High%20quality%20photo%20of%20a%20monkey%20astronaut.webp?v=1',	'High quality photo of a monkey astronaut',	'Astro Monkey !',	'2023-05-09 11:40:00',	23),
(42,	'Futuristic city',	'https://cdn.openai.com/labs/images/Two%20futuristic%20towers%20with%20a%20skybridge%20covered%20in%20lush%20foliage,%20digital%20art.webp?v=1',	'Two futuristic towers with a skybridge covered in lush foliage, digital art',	'Green Futuristic city',	'2023-05-09 11:41:00',	23),
(43,	'Computer from the 90s',	'https://cdn.openai.com/labs/images/A%20computer%20from%20the%2090s%20in%20the%20style%20of%20vaporwave.webp?v=1',	'A computer from the 90s in the style of vaporwave',	'Computer from the 90s',	'2023-05-09 11:42:12',	23),
(44,	'Robot chess player',	'https://cdn.openai.com/labs/images/An%20oil%20painting%20by%20Matisse%20of%20a%20humanoid%20robot%20playing%20chess.webp?v=1',	'An oil painting by Matisse of a humanoid robot playing chess',	'Robot playing chess',	'2023-05-09 11:43:50',	23),
(45,	'Boat on the see',	'https://cdn.openai.com/labs/images/A%20hand-drawn%20sailboat%20circled%20by%20birds%20on%20the%20sea%20at%20sunrise.webp?v=1',	'A hand-drawn sailboat circled by birds on the sea at sunrise',	'Drawing of a boat on the see',	'2023-05-09 11:48:11',	25),
(46,	'Abstract river',	'https://cdn.openai.com/labs/images/An%20abstract%20oil%20painting%20of%20a%20river.webp?v=1',	'An abstract oil painting of a river',	'Oil painting river abstract',	'2023-05-09 11:50:14',	25);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `user` (`id`, `username`, `password`, `role`) VALUES
(21,	'Archi',	'$2y$10$PaOWQPCsLqxq6Bz6I8h8LOC13/BprPPcPRLRf53Xhdt36zTefr6yO',	'user'),
(22,	'Zooloo',	'$2y$10$f.QYU0.5vqf9psVMVWlnVegzKyC8awuSgqUY9YAzX9sDi3RiLgPmO',	'user'),
(23,	'Rob',	'$2y$10$l602/6mhcc9Qm3ypR3Pr6OEzRyLfpKH0R1dKv8nHU9gkdDk.x5s.a',	'user'),
(24,	'Roxx',	'$2y$10$H1mmmpocYXKesM.WzDyojemA6jO0nCt5NTjlaKYQYPfY81EJqw9Hm',	'user'),
(25,	'Johnny',	'$2y$10$0m70Egn.0Cherw1bCvTI/.O78AA61poWsz5m0FS/mdyux54uVWe6y',	'user');

DROP TABLE IF EXISTS `vote`;
CREATE TABLE `vote` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `photo_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `photo_id` (`photo_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id`) ON DELETE CASCADE,
  CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `vote_ibfk_3` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `vote` (`id`, `user_id`, `photo_id`) VALUES
(1,	21,	31),
(2,	21,	34);

-- 2023-05-09 10:34:44
