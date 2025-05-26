CREATE DATABASE IF NOT EXISTS scirh;

USE scirh;

CREATE TABLE `user` (
  `user_id` int unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_firstname` varchar(100) NOT NULL,
  `user_lastname` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_avatar` varchar(255),
  `user_password` varchar(255) NOT NULL,
  `user_is_actif` tinyint(1) NOT NULL,
  `user_created_at` datetime NOT NULL,
  `user_updated_at` datetime
);

CREATE TABLE `employ` (
  `employ_id` int unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `service_id` int unsigned NOT NULL,
  `contrat_id` int unsigned NOT NULL,
  `employ_firstname` varchar(100) NOT NULL,
  `employ_lastname` varchar(100) NOT NULL,
  `employ_service_email` varchar(100) NOT NULL,
  `employ_personal_email` varchar(100),
  `employ_service_telephone` varchar(50),
  `employ_personal_telephone` varchar(50),
  `employ_manager_id` int unsigned NOT NULL,
  `employ_title` varchar(100) NOT NULL,
  `employ_begin_at` datetime NOT NULL,
  `employ_end_at` datetime,
  `employ_is_actif` tinyint(1) NOT NULL,
  `employ_created_at` datetime NOT NULL,
  `employ_updated_at` datetime
);

CREATE TABLE `service` (
  `service_id` int unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `service_name` varchar(100) NOT NULL,
  `service_code` varchar(20) NOT NULL,
  `service_is_actif` tinyint(1) NOT NULL,
  `service_created_at` datetime NOT NULL,
  `service_updated_at` datetime
);

CREATE TABLE `contrat` (
  `contrat_id` int unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `contrat_attribut` varchar(20) NOT NULL,
  `contrat_created_at` datetime NOT NULL,
  `contrat_updated_at` datetime
);

CREATE TABLE `user_role` (
  `role_id` int unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `role_attribut` varchar(50) NOT NULL,
  `role_created_at` datetime NOT NULL,
  `role_updated_at` datetime
);

ALTER TABLE `employ` ADD CONSTRAINT `user` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`);

ALTER TABLE `employ` ADD FOREIGN KEY (`contrat_id`) REFERENCES `contrat` (`contrat_id`);

ALTER TABLE `user` ADD FOREIGN KEY (`user_id`) REFERENCES `user_role` (`user_id`);

ALTER TABLE `employ` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `employ` ADD FOREIGN KEY (`employ_manager_id`) REFERENCES `employ` (`employ_id`);
