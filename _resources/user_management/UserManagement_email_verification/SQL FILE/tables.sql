
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastlogin_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `admin` (`id`, `name`, `username`, `password`, `email`, `created_at`, `lastlogin_at`)
VALUES
  (1,'Admin','admin','admin','admin@admin.com','2014-11-25 10:57:28','2014-12-08 10:23:20'),
  (2,'Admin','admin','d033e22ae348aeb5660fc2140aec35850c4da997','admin@admin.com','2014-11-25 10:57:28','2014-12-08 10:23:20');


CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `avatar` varchar(30) DEFAULT 'noimage.gif',
  `address` varchar(200) DEFAULT NULL,
  `latitude` varchar(20) DEFAULT NULL,
  `longitude` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `lastlogin_at` varchar(30) DEFAULT NULL,
  `status` enum('enable','disable') NOT NULL DEFAULT 'disable',
  `key` varchar(100) DEFAULT NULL,
  `email_verified` enum('yes','no') NOT NULL DEFAULT 'no',
  `forget_key` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
