
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
	(1,'Admin','admin','admin','admin@admin.com','2014-11-25 10:57:28','2014-11-25 16:44:36');


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
  `status` enum('enable','disable') NOT NULL DEFAULT 'enable',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `avatar`, `address`, `latitude`, `longitude`, `created_at`, `lastlogin_at`, `status`)
VALUES
	(3,'Ajay Kumar Choudhary','ajay138@gmail.com','ajay@froiden.com','123456','noimage.gif','Malviya Nagar, Jaipur, Rajasthan, India','26.8548662','75.82429660000003',NULL,'2014-11-25 16:59:27','enable');


