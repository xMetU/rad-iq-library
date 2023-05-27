DROP TABLE IF EXISTS `#__myImageViewer_image`;
DROP TABLE IF EXISTS `#__myImageViewer_imageCategory`;

CREATE TABLE IF NOT EXISTS `#__myImageViewer_imageCategory` (
	`id` SERIAL NOT NULL,
	`categoryName` VARCHAR(30) NOT NULL UNIQUE,
	PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `#__myImageViewer_image` (
	`id` SERIAL NOT NULL,
	`imageName` VARCHAR(60) NOT NULL,
	`categoryId` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
	`imageDescription` VARCHAR(12000),
	`imageUrl` VARCHAR(200) NOT NULL,
	`isHidden` BOOLEAN NOT NULL DEFAULT 0,
	PRIMARY KEY (`id`),
	FOREIGN KEY (`categoryId`) REFERENCES `#__myImageViewer_imageCategory` (`id`),
	UNIQUE KEY `unique_imageName_categoryId` (`imageName`, `categoryId`)
) ENGINE = InnoDB;

INSERT INTO `#__myImageViewer_imageCategory` (`categoryName`) VALUES
	('Hip'),
	('Acetabulum'),
    ('Abdomen'),
    ('Ankle'),
	('Calcaneum'),
	('Tibia-Fibula'),
	('Knee'),
	('Femur'),
	('Pelvis'),
	('AC Joints'),
	('Chest'),
	('Ribs'),
	('Sternum'),
	('SC Joints'),
	('Toes'),
	('Foot'),
	('Forearm'),
	('Elbow'),
	('Shoulder'),
	('Scapula'),
	('Humerus'),
	('Clavicle'),
	('Thumb'),
	('Finger'),
	('Hand'),
	('Norgaard\'s'),
	('Wrist'),
	('Scaphoid');