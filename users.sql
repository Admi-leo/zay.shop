create database zay;
use zay;



CREATE TABLE `banners` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(249) NOT NULL,
  `description` text(200) DEFAULT NULL,
  `image` varchar(32) DEFAULT NULL,
  `public` varchar(10) NOT NULL DEFAULT 'public',
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_update` timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
);



CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(249) NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `year` date DEFAULT NULL,
  `sex` tinyint(2) unsigned DEFAULT '0',
  `image` varchar(20) DEFAULT NULL,
  `buy` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `verified` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `resettable` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `roles_mask` int(10) unsigned NOT NULL DEFAULT '0',
  `registered` int(10) unsigned NOT NULL,
  `last_login` int(10) unsigned DEFAULT NULL,
  `force_logout` mediumint(7) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
);


CREATE TABLE IF NOT EXISTS `users_confirmations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `email` varchar(249) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selector` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `email_expires` (`email`,`expires`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `users_remembered` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL,
  `selector` varchar(24) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `user` (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `users_resets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL,
  `selector` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `user_expires` (`user`,`expires`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `users_throttling` (
  `bucket` varchar(44) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `tokens` float unsigned NOT NULL,
  `replenished_at` int(10) unsigned NOT NULL,
  `expires_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`bucket`),
  KEY `expires_at` (`expires_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


create table categories (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `image` varchar(64) DEFAULT NULL,
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_update` timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY(id),
  UNIQUE KEY `title` (`title`)
);
create table brands (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `image` varchar(64) DEFAULT NULL,
  `link` varchar(64) NOT NULL DEFAULT '/',
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_update` timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY(id),
  UNIQUE KEY `title` (`title`)
);

CREATE TABLE products (
  `id` int unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_tm` decimal(10, 2) unsigned DEFAULT 0,
  `price_usd` decimal(10, 2) unsigned DEFAULT 0,
  `quantity` int(11) unsigned DEFAULT 0,
  `totalQuantity` int(11) unsigned DEFAULT 0,
  `description` text NOT NULL COLLATE utf8mb4_unicode_ci,
  `image_1` varchar(32),
  `image_2` varchar(32),
  `image_3` varchar(32),
  `image_4` varchar(32),
  `rating` float(2, 1) DEFAULT 0,
  `likes` int(5) unsigned DEFAULT 0,
  `reviews` int(11) unsigned DEFAULT 0,
  `sold` int(50) unsigned DEFAULT 0,
  `color` varchar(64) DEFAULT NULL,
  `public` varchar(32) DEFAULT 'private',
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_update` timestamp ON UPDATE CURRENT_TIMESTAMP,
  `category_id` int(32) unsigned,
  `brand_id` int(32) unsigned,
  `user_id` int(11) unsigned NOT NULL,
  FOREIGN KEY (`category_id`) REFERENCES categories(`id`)
  ON DELETE RESTRICT,
  FOREIGN KEY (`brand_id`) REFERENCES brands(`id`)
  ON DELETE RESTRICT
);


CREATE FULLTEXT INDEX idx_name ON products(name);


CREATE TABLE cart (
  `id` int unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `product` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int unsigned DEFAULT '0',
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_update` timestamp ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int unsigned NOT NULL,
  `product_id` int unsigned NOT NULL,
  FOREIGN KEY (`product_id`) REFERENCES products(`id`)
  ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES users(`id`)
  ON DELETE RESTRICT
);

CREATE TABLE comments (
  `id` int unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `comment` text(249) NOT NULL,
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_update` timestamp ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int unsigned NOT NULL,
  `product_id` int unsigned NOT NULL,
  FOREIGN KEY (`product_id`) REFERENCES products(`id`)
  ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES users(`id`)
  ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE support (
  `id` int unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `message` text(249) NOT NULL,
  `answer` text(249) NULL,
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_answer` varchar(32) NULL,
  `status` varchar(32) NOT NULL DEFAULT "open",
  `user_id` int unsigned NOT NULL,
  `answer_user_id` int unsigned NULL,
  FOREIGN KEY (`user_id`) REFERENCES users(`id`)
  ON DELETE CASCADE
  ON UPDATE CASCADE
);


CREATE TABLE likes (
  `id` int(100) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(5) unsigned NOT NULL,
  `product_id` int(5) unsigned NOT NULL,
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES users(`id`)
  ON DELETE CASCADE,
  FOREIGN KEY (`product_id`) REFERENCES products(`id`)
  ON DELETE CASCADE
);


CREATE TABLE reviews (
  `id` int(100) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` int(5) unsigned NOT NULL,
  `product_id` int(5) unsigned NOT NULL,
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`user_id`) REFERENCES users(`id`)
  ON DELETE CASCADE,
  FOREIGN KEY (`product_id`) REFERENCES products(`id`)
  ON DELETE CASCADE
);
