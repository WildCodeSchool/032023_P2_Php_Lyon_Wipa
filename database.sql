-- Adminer 4.8.1 MySQL 8.0.32-0ubuntu0.22.04.2 dump
SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';
SET NAMES utf8mb4;
DROP DATABASE IF EXISTS `projet2`;
CREATE DATABASE `projet2`
/*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */
/*!80016 DEFAULT ENCRYPTION='N' */
;
USE `projet2`;
DROP TABLE IF EXISTS `photo`;
CREATE TABLE `photo` (
  `photo_id` int NOT NULL AUTO_INCREMENT,
  `photo_title` varchar(255) NOT NULL,
  `photo_link` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `photo_prompt` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `photo_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`photo_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
INSERT INTO `photo` (
    `photo_id`,
    `photo_title`,
    `photo_link`,
    `photo_prompt`,
    `photo_description`
  )
VALUES (
    1,
    'mini dark vador',
    'https://image.lexica.art/full_jpg/a164f6cf-9e0e-4f5d-bd60-a1e99b307c12',
    'darth vader dj com fone de ouvido, tocando em festa',
    'dark vador'
  ),
  (
    2,
    'comic book character',
    'https://image.lexica.art/full_jpg/e863d213-0a7c-43a1-b84e-fe297522719b',
    'epic comic book cover',
    'comic book character'
  ),
  (
    3,
    '',
    'https://mpost.io/wp-content/uploads/image-46-38.jpg',
    'a vibrant professional studio portrait photography of a young, pale, goth, attractive, friendly, casual, delightful, intricate, gorgeous, female, piercing green eyes, wears a gold ankh necklace, femme fatale, nouveau, curated collection, annie leibovitz, nikon, award winning, breathtaking, groundbreaking, superb, outstanding, lensculture portrait awards, photoshopped, dramatic lighting, 8 k, hi res –testp –ar 3:4 –upbeta',
    'A portrait of woman'
  ),
  (
    4,
    '',
    'https://mpost.io/wp-content/uploads/image-46-44.jpg',
    'very complex hyper-maximalist overdetailed cinematic tribal darkfantasy closeup portrait of a malignant beautiful young dragon queen goddess megan fox with long black windblown hair and dragon scale wings, Magic the gathering, pale skin and dark eyes,flirting smiling succubus confident seductive, gothic, windblown hair, vibrant high contrast, by andrei riabovitchev, tomasz alen kopera,moleksandra shchaslyva, peter mohrbacher, Omnious intricate, octane, moebius, arney freytag, Fashion photo shoot, glamorous pose, trending on ArtStation, dramatic lighting, ice, fire and smoke, orthodox symbolism Diesel punk, mist, ambient occlusion, volumetric lighting, Lord of the rings, BioShock, glamorous, emotional, tattoos,shot in the photo studio, professional studio lighting, backlit, rim lightingDeviant-art, hyper detailed illustration, 8k',
    'portrait of a malignant beautiful young dragon queen'
  ),
  (
    5,
    '',
    'https://mpost.io/wp-content/uploads/image-46-48.jpg',
    'temple in ruines, forest, stairs, columns, cinematic, detailed, atmospheric, epic, concept art, Matte painting, background, mist, photo-realistic, concept art, volumetric light, cinematic epic + rule of thirds octane render, 8k, corona render, movie concept art, octane render, cinematic, trending on artstation, movie concept art, cinematic composition , ultra-detailed, realistic , hyper-realistic , volumetric lighting, 8k –ar 2:3 –test –uplight',
    'Greek old temple'
  ),
  (
    6,
    '',
    'https://mpost.io/wp-content/uploads/image-46-54.jpg',
    'a cute magical flying dog, fantasy art drawn by disney concept artists, golden colour, high quality, highly detailed, elegant, sharp focus, concept art, character concepts, digital painting, mystery, adventure',
    'My cute little dog'
  ),
  (
    7,
    '',
    'https://image.lexica.art/full_jpg/fdc66817-abe9-468a-88bb-21ec0ca738e3',
    'Cute small fox waving at me and smiling greeting me in front of theater door, unreal engine, cozy indoor lighting, artstation, detailed, digital painting, cinematic, character design by mark ryden and pixar and hayao miyazaki, unreal 5, daz, hyperrealistic, octane render',
    'Cute small fox'
  ),
  (
    8,
    '',
    'https://stablediffusion.fr/assets/2023-02/380383665-a%20highly%20detailed%20matte%20painting%20of%20pizza%20by%20studio%20ghibli,%20makoto%20shinkai,%20by%20artgerm,%20by%20wlop,%20by%20greg%20rutkowski,%20volumetric%20l.webp',
    'a highly detailed matte painting of pizza by studio ghibli, makoto shinkai, by artgerm, by wlop, by greg rutkowski, volumetric',
    'A boy looking for a big pizza'
  ),
  (
    9,
    '',
    'https://stablediffusion.fr/assets/2023-03/1031297738-oul painting, a portrait of george clooney in 19th century, beautiful painting with highly detailed face by greg rutkowski and m.webp',
    'oul painting, a portrait of george clooney in 19th century, beautiful painting with highly detailed face by greg rutkowski and',
    'George clooney'
  ),
  (
    10,
    '',
    'https://stablediffusion.fr/assets/2023-03/1551426893-Luke Skywalker ordering a burger and fries from the Death Star canteen.webp',
    'Luke Skywalker ordering a burger and fries from the Death Star canteen',
    'Luke Skywalker ordering a burger'
  ),
  (
    11,
    '',
    'https://image.lexica.art/full_jpg/aaa9134b-d417-490f-bce8-e84e68839f1d',
    'A detailed portrait of pikachu giving thumbs up illustrator, by justin gerard and greg rutkowski, digital art, realistic painting, dnd, character design, trending on artstation',
    'pikachu giving thumbs up'
  ),
  (
    12,
    '',
    'https://image.lexica.art/full_jpg/e4b2754f-fcea-49c2-bcc6-51cfd9fd6885',
    'Cute and adorable cartoon fluffy baby rhea, fantasy, dreamlike, surrealism, super cute, trending on artstation',
    'Cute and adorable cartoon fluffy baby rhea'
  ),
  (
    13,
    '',
    'https://image.lexica.art/full_jpg/65a02cc1-217c-40fe-bfe2-6ba54d16c7a9',
    'Archeology game item by blizzard entertainment, mobile game asset, isometric, centralised, low details, no background, no shadow',
    'Archeology game item by blizzard '
  ),
  (
    14,
    'a little cow',
    'https://image.lexica.art/full_jpg/bfcbf7a1-2c9b-4d54-a50a-83480fa89663',
    'a little cow with hat and icecream realistic',
    'a little cow'
  );
-- 2023-04-12 10:28:28