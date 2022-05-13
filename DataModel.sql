# ************************************************************
# Sequel Pro SQL dump
# Versão 4541.169293
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.37-MariaDB)
# Base de Dados: workcontrol
# Tempo de Geração: 2021-12-28 13:13:00 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump da tabela application
# ------------------------------------------------------------
DROP TABLE IF EXISTS `application`;
CREATE TABLE `application` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `application_name` varchar(255) NOT NULL DEFAULT '',
  `admin_name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `photo` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'registered' COMMENT 'registered, confirmed',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `full_text` (`application_name`,`admin_name`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `application` WRITE;
/*!40000 ALTER TABLE `application` DISABLE KEYS */;


/*!40000 ALTER TABLE `application` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela users
# ------------------------------------------------------------
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) unsigned NOT NULL,
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `level` int(11) NOT NULL DEFAULT '1',
  `forget` varchar(255) DEFAULT NULL,
  `genre` varchar(10) DEFAULT NULL,
  `datebirth` date DEFAULT NULL,
  `document` varchar(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'registered' COMMENT 'registered, confirmed',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_application` (`application_id`),
  UNIQUE KEY `email` (`email`),
  FULLTEXT KEY `full_text` (`first_name`,`last_name`,`email`),
  CONSTRAINT `user_application` FOREIGN KEY (`application_id`) REFERENCES `application` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;


/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela customer
# ------------------------------------------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `document` varchar(25) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `phone1` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `phone2` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `address_street` varchar(255) DEFAULT NULL,
  `address_number` varchar(255) DEFAULT NULL,
  `address_neighborhood` varchar(255) DEFAULT NULL,
  `address_complement` varchar(255) DEFAULT NULL,
  `address_postalcode` varchar(255) DEFAULT NULL,
  `address_city` varchar(255) DEFAULT NULL,
  `address_state` varchar(255) DEFAULT NULL,
  `address_country` varchar(255) DEFAULT NULL,
  `observation` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `agency` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `current_account` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  key customer_application (`application_id`),
  FULLTEXT KEY `full_text` (`name`,`address_street`,`address_number`,`address_complement`,`address_postalcode`,`address_city`,`address_state`,`address_country`),
  CONSTRAINT `customer_application` FOREIGN KEY (`application_id`) REFERENCES `application` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;


/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela works
DROP TABLE IF EXISTS `works`;
CREATE TABLE `works` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `customer_id` int(11) unsigned NOT NULL,
  `wallet_id` int(11) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address_street` varchar(255) DEFAULT NULL,
  `address_number` varchar(255) DEFAULT NULL,
  `address_neighborhood` varchar(30) DEFAULT NULL,
  `address_complement` varchar(255) DEFAULT NULL,
  `address_postalcode` varchar(255) DEFAULT NULL,
  `address_city` varchar(255) DEFAULT NULL,
  `address_state` varchar(255) DEFAULT NULL,
  `address_country` varchar(255) DEFAULT NULL, 
  `observation` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date_initial` varchar(250) NOT NULL,
  `date_final` varchar(250) NOT NULL,
  `projectcost` decimal(10,2) NOT NULL,
  `projectexpenses` decimal(10,2) NOT NULL,
  `projecteincome` decimal(10,2) NOT NULL,
  `photo1` varchar(255) DEFAULT NULL,
  `photo2` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  key work_application (`application_id`),
  key work_customer (`customer_id`),
  FULLTEXT KEY `full_text` (`name`,`address_street`,`address_number`,`address_complement`,`address_postalcode`,`address_city`,`address_state`,`address_country`),
  CONSTRAINT `work_application` FOREIGN KEY (`application_id`) REFERENCES `application` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `work_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `works` WRITE;
/*!40000 ALTER TABLE `works` DISABLE KEYS */;


/*!40000 ALTER TABLE `works` ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS `projectfile`;
CREATE TABLE `projectfile` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `project` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `uri` varchar(255) NOT NULL,
  `subtitle` text NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `video` varchar(50) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `project_file` (`project`),
  KEY `project_application` (`application_id`),
  CONSTRAINT `project_application` FOREIGN KEY (`application_id`) REFERENCES `application` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `project_file` FOREIGN KEY (`project`) REFERENCES `works` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `projectfile` WRITE;
/*!40000 ALTER TABLE `projectfile` DISABLE KEYS */;


/*!40000 ALTER TABLE `projectfile` ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS `stage`;
CREATE TABLE `stage`(
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `work_id` int(11) unsigned NOT NULL,
  `stage_name` varchar(250) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `date_initial` varchar(250) NOT NULL,
  `date_final` varchar(250) NOT NULL,
  `duration` varchar(250) NOT NULL,
  `annotations` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `stage_application` (`application_id`),
  KEY `stage_work` (`work_id`),
  CONSTRAINT `stage_application` FOREIGN KEY (`application_id`) REFERENCES `application` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `stage_work` FOREIGN KEY (`work_id`) REFERENCES `works` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `stage` WRITE;
/*!40000 ALTER TABLE `stage` DISABLE KEYS */;


/*!40000 ALTER TABLE `stage` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `task`;
CREATE TABLE `task`(
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `work_id` int(11) unsigned NOT NULL,
  `task_name` varchar(200) DEFAULT NULL,
  `stage_name` varchar(200) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `date_initial` varchar(250) NOT NULL,
  `date_final` varchar(250) NOT NULL,
  `duration` varchar(250) NOT NULL,
  `annotations` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `task_application` (`application_id`),
  KEY `task_stage` (`stage_name`),
  KEY `task_work` (`work_id`),
  CONSTRAINT `task_application` FOREIGN KEY (`application_id`) REFERENCES `application` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `task_work` FOREIGN KEY (`work_id`) REFERENCES `works` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;


/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

# Dump da tabela supplier_category
# ------------------------------------------------------------
DROP TABLE IF EXISTS `supplier_category`;
CREATE TABLE `supplier_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `supllier_category_application` (`application_id`),
  CONSTRAINT `supllier_category_application` FOREIGN KEY (`application_id`) REFERENCES `application` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `supplier_category` WRITE;
/*!40000 ALTER TABLE `supplier_category` DISABLE KEYS */;


/*!40000 ALTER TABLE `supplier_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela service_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `service_category`;
CREATE TABLE `service_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `servic_category_application` (`application_id`),
  CONSTRAINT `servic_category_application` FOREIGN KEY (`application_id`) REFERENCES `application` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `service_category` WRITE;
/*!40000 ALTER TABLE `service_category` DISABLE KEYS */;


/*!40000 ALTER TABLE `service_category` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `occupation_id` int(11) unsigned NOT NULL,
  `supplier_type` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `document` varchar(25) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `site` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `phone1` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `phone2` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `address_street` varchar(255) DEFAULT NULL,
  `address_number` varchar(255) DEFAULT NULL,
  `address_neighborhood` varchar(30) DEFAULT NULL,
  `address_complement` varchar(255) DEFAULT NULL,
  `address_postalcode` varchar(255) DEFAULT NULL,
  `address_city` varchar(255) DEFAULT NULL,
  `address_state` varchar(255) DEFAULT NULL,
  `address_country` varchar(255) DEFAULT NULL,
  `observation` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `agency` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `current_account` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `document` (`document`),
  FULLTEXT KEY `full_text` (`name`,`document`,`email`, `site`,`phone1`,`mobile`,`phone2`,`fax`,`address_street`,`address_postalcode`,`address_city`,`address_state`,`address_country`),
  KEY `supplier_application` (`application_id`),
  CONSTRAINT `supplier_application` FOREIGN KEY (`application_id`) REFERENCES `application` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;


/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela address
# ------------------------------------------------------------

DROP TABLE IF EXISTS `address`;

CREATE TABLE `address` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `street` varchar(255) NOT NULL DEFAULT '',
  `number` varchar(255) NOT NULL DEFAULT '',
  `complement` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `addr_user` (`user_id`),
  CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;


/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela app_categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `app_categories`;

CREATE TABLE `app_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `sub_of` int(11) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(15) NOT NULL DEFAULT '',
  `order_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sub_of` (`sub_of`),
  CONSTRAINT `sub_of` FOREIGN KEY (`sub_of`) REFERENCES `app_categories` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `app_categories` WRITE;
/*!40000 ALTER TABLE `app_categories` DISABLE KEYS */;


/*!40000 ALTER TABLE `app_categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela app_credit_cards
# ------------------------------------------------------------

DROP TABLE IF EXISTS `app_credit_cards`;

CREATE TABLE `app_credit_cards` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `brand` varchar(20) NOT NULL DEFAULT '',
  `last_digits` varchar(11) NOT NULL DEFAULT '',
  `cvv` varchar(11) NOT NULL DEFAULT '',
  `hash` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(255) DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `credit_cards_user` (`user_id`),
  CONSTRAINT `credit_cards_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `app_credit_cards` WRITE;
/*!40000 ALTER TABLE `app_credit_cards` DISABLE KEYS */;



/*!40000 ALTER TABLE `app_credit_cards` ENABLE KEYS */;
UNLOCK TABLES;

# Dump da tabela app_wallets

DROP TABLE IF EXISTS `app_wallets`;

CREATE TABLE `app_wallets` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `project` int(11) unsigned DEFAULT NULL,
  `wallet` varchar(255) NOT NULL DEFAULT '',
  `free` int(1) NOT NULL DEFAULT '0',
  `status` varchar(255) DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `wallet_application` (`application_id`),
  CONSTRAINT `wallet_application` FOREIGN KEY (`application_id`) REFERENCES `application` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `project` FOREIGN KEY (`project`) REFERENCES `works` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `app_wallets` WRITE;
/*!40000 ALTER TABLE `app_wallets` DISABLE KEYS */;


/*!40000 ALTER TABLE `app_wallets` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela app_invoices
# ------------------------------------------------------------

DROP TABLE IF EXISTS `app_invoices`;

CREATE TABLE `app_invoices` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `wallet_id` int(11) unsigned NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `invoice_of` int(11) unsigned DEFAULT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  `type` varchar(15) NOT NULL DEFAULT '',
  `value` decimal(10,2) NOT NULL,
  `currency` varchar(5) NOT NULL DEFAULT 'BRL',
  `due_at` date NOT NULL,
  `repeat_when` varchar(10) NOT NULL DEFAULT '',
  `period` varchar(10) NOT NULL DEFAULT 'month',
  `enrollments` int(11) DEFAULT NULL,
  `enrollment_of` int(11) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'unpaid',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `app_application` (`application_id`),
  KEY `app_wallet` (`wallet_id`),
  KEY `app_category` (`category_id`),
  KEY `app_invoice` (`invoice_of`),
  CONSTRAINT `app_category` FOREIGN KEY (`category_id`) REFERENCES `app_categories` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `app_application` FOREIGN KEY (`application_id`) REFERENCES `application` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `app_invoice` FOREIGN KEY (`invoice_of`) REFERENCES `app_invoices` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `app_wallet` FOREIGN KEY (`wallet_id`) REFERENCES `app_wallets` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `app_invoices` WRITE;
/*!40000 ALTER TABLE `app_invoices` DISABLE KEYS */;


/*!40000 ALTER TABLE `app_invoices` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela app_subscriptions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `app_subscriptions`;

CREATE TABLE `app_subscriptions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `plan_id` int(11) unsigned DEFAULT NULL,
  `card_id` int(11) unsigned DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'active' COMMENT 'active,inactive,past_due,canceled',
  `pay_status` varchar(10) NOT NULL DEFAULT 'active' COMMENT 'active,inactive,past_due,canceled',
  `started` date NOT NULL,
  `due_day` int(2) NOT NULL,
  `next_due` date NOT NULL,
  `last_charge` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `subscription_user` (`user_id`),
  KEY `subscription_card` (`card_id`),
  KEY `subscription_plan` (`plan_id`),
  CONSTRAINT `subscription_card` FOREIGN KEY (`card_id`) REFERENCES `app_credit_cards` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `subscription_plan` FOREIGN KEY (`plan_id`) REFERENCES `app_plans` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `subscription_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `app_subscriptions` WRITE;
/*!40000 ALTER TABLE `app_subscriptions` DISABLE KEYS */;


/*!40000 ALTER TABLE `app_subscriptions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela app_orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `app_orders`;

CREATE TABLE `app_orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `card_id` int(11) unsigned DEFAULT NULL,
  `subscription_id` int(11) unsigned DEFAULT NULL,
  `transaction` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `orders_user` (`user_id`),
  KEY `orders_credit_card` (`card_id`),
  KEY `orders_subscription` (`subscription_id`),
  CONSTRAINT `orders_credit_card` FOREIGN KEY (`card_id`) REFERENCES `app_credit_cards` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `orders_subscription` FOREIGN KEY (`subscription_id`) REFERENCES `app_subscriptions` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `app_orders` WRITE;
/*!40000 ALTER TABLE `app_orders` DISABLE KEYS */;



/*!40000 ALTER TABLE `app_orders` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela app_plans
# ------------------------------------------------------------

DROP TABLE IF EXISTS `app_plans`;

CREATE TABLE `app_plans` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `period` varchar(11) NOT NULL DEFAULT '',
  `period_str` varchar(11) NOT NULL DEFAULT '',
  `price` decimal(10,2) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `app_plans` WRITE;
/*!40000 ALTER TABLE `app_plans` DISABLE KEYS */;

INSERT INTO `app_plans` (`id`, `name`, `period`, `period_str`, `price`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'PRO','1month','mês',5.00,'active','2018-12-21 07:02:22','2019-01-03 16:45:18'),
	(2,'PRO','1year','ano',50.00,'active','2018-12-21 07:02:57','2019-02-06 05:57:49'),
	(3,'EXPERT','1month','mês',75.00,'inactive','2018-12-21 07:04:02','2018-12-23 19:56:33');

/*!40000 ALTER TABLE `app_plans` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `uri` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `type` varchar(50) NOT NULL DEFAULT 'post' COMMENT 'post, page, etc',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;

INSERT INTO `categories` (`id`, `title`, `uri`, `description`, `cover`, `type`, `created_at`, `updated_at`)
VALUES
	(1,'Controle','controle','Dicas e sacadas sobre como controlar suas contas com CaféControl. Vamos tomar um ótimo café?',NULL,'post','2018-10-22 15:24:12','2018-10-22 15:24:12'),
	(2,'Contas','contas','Dicas e sacadas sobre como controlar suas contas com CaféControl. Vamos tomar um ótimo café?','images/2018/10/aprenda-a-criar-um-componente-de-notificacao-para-seu-site-1527515035.jpg','post','2018-11-01 16:32:57','2019-02-07 07:35:54'),
	(3,'Finanças','financas','Dicas e sacadas sobre como controlar suas contas com CaféControl. Vamos tomar um ótimo café?',NULL,'post','2018-11-01 16:33:05','2018-11-01 16:33:27');

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela faq_channels
# ------------------------------------------------------------

DROP TABLE IF EXISTS `faq_channels`;

CREATE TABLE `faq_channels` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `channel` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `faq_channels` WRITE;
/*!40000 ALTER TABLE `faq_channels` DISABLE KEYS */;

INSERT INTO `faq_channels` (`id`, `channel`, `description`, `created_at`, `updated_at`)
VALUES
	(1,'Sobre o CaféControl','Saiba mais sobre o CaféControl','2018-10-21 09:24:51','2018-10-21 09:27:21'),
	(10,'Sobre CMS CaféAdmin','Canal criado apenas para gerar paginação na implementação da tela de FAQs','2019-02-07 08:05:31','2019-02-07 08:33:16');

/*!40000 ALTER TABLE `faq_channels` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela faq_questions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `faq_questions`;

CREATE TABLE `faq_questions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `channel_id` int(11) unsigned NOT NULL,
  `question` varchar(255) NOT NULL DEFAULT '',
  `response` text NOT NULL,
  `order_by` int(11) unsigned DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `channel_id` (`channel_id`),
  CONSTRAINT `channel_id` FOREIGN KEY (`channel_id`) REFERENCES `faq_channels` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `faq_questions` WRITE;
/*!40000 ALTER TABLE `faq_questions` DISABLE KEYS */;

INSERT INTO `faq_questions` (`id`, `channel_id`, `question`, `response`, `order_by`, `created_at`, `updated_at`)
VALUES
	(1,1,'O CaféControl é gratuito?','<p>Sim, o CaféControl é gratuito e com ele você pode usar os recursos de controle e automação sem qualquer custo ou cobrança.</p><p>No futuro pretendemos ter planos com recursos premium onde você terá ainda mais controle, este será um plano pago, mas você poderá optar por usa-lo ou continuar no plano gratuito.</p>',1,'2018-10-21 09:28:11','2018-10-21 09:48:41'),
	(2,1,'O que fazer com o CaféControl?','<p>Com o CaféControl você pode lançar suas contas a receber ou a pagar, além disso pode lançar recorrências e usufruir de poderosas automações de controle, tudo de forma muito simples.</p><p>Com as contas organizadas em seu painel, você passa a ter acesso a relatórios e gráficos incríveis, além de ser notificado sempre que uma ação for necessária, como validar ou pagar uma conta.</p>',2,'2018-10-21 09:30:04','2018-10-21 09:49:17'),
	(4,1,'Como usar o CaféControl?','<p>Para usar o CaféControl é simples, basta se cadastrar em nossa plataforma e começar a cadastrar suas contas.</p><p>Detalhando contas rotineiras e recorentes, todas com valor, categorias e informações de controle. A partir disso nosso APP vai gerar automações e relatórios para te ajudar a controlar.</p><p>Simples, fácil e gratuito!</p>',3,'2018-10-22 08:04:00','2018-10-22 08:06:41'),
	(5,1,'De onde surgiu o CaféControl?','<p>O CaféControl é um projeto desenvolvido na formação Full Stack PHP Developer da UpInside Treinamentos, onde o aluno tem acesso do zero ao expert em uma formação completa sobre ferramentas, HTML, CSS e jQuery.</p><p>Uma formação aprofundada com foco em PHP onde desenvolvemos esse e vários outros projetos a partir do zero.</p><p>Quer saber mais? <a target=\'_blank\' href=\'https://www.upinside.com.br/fsphp\' title=\'Full Stack PHP Developer\'>Acesse aqui</a> e conheça a formação!</p>',4,'2018-10-22 08:07:01','2018-10-22 08:09:46'),
	(6,1,'Sobre a UpInside Treinamentos','<p>A UpInside Treinamentos é uma escola de formação profissional em desenvolvimento web e programação. Hoje eleita a melhor do Brasil no segmento, tendo reconhecimento em mais de 17 países da AL.</p>',5,'2018-10-22 08:10:32','2018-10-22 08:11:35'),
	(8,1,'Ainda com dúvidas?','<p>Caso ainda tenha qualquer dúvida, fique a vontade para entrar em contato consoco em nossos canais de atendimento. Estamos aqui para te ajudar a controlar suas contas enquanto toma um ótimo café :)</p>',6,'2018-10-22 08:11:58','2018-10-22 08:12:42'),
	(9,10,'Tudo já está implementado e testado?','Todo o MVP do painel foi implementado e testado. Óbvio que cabe a cada um melhorar e gerar mais valor nessa que pode ser uma incrível ferramenta.',1,'2019-02-07 08:34:10','2019-02-07 11:57:57'),
	(10,10,'Teremos mais implementações no curso?','No curso não, mas teremos HandOns (lives) de implementação para que possamos nos aprofundar cada vez mais na ferramenta.',1,'2019-02-07 08:35:06','2019-02-07 11:57:59');

/*!40000 ALTER TABLE `faq_questions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela mail_queue
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mail_queue`;

CREATE TABLE `mail_queue` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `from_email` varchar(255) NOT NULL DEFAULT '',
  `from_name` varchar(255) NOT NULL DEFAULT '',
  `recipient_email` varchar(255) NOT NULL DEFAULT '',
  `recipient_name` varchar(255) NOT NULL DEFAULT '',
  `sent_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `mail_queue` WRITE;
/*!40000 ALTER TABLE `mail_queue` DISABLE KEYS */;

INSERT INTO `mail_queue` (`id`, `subject`, `body`, `from_email`, `from_name`, `recipient_email`, `recipient_name`, `sent_at`, `created_at`, `updated_at`)
VALUES
	(1,'[PAGAMENTO CONFIRMADO] Obrigado por assinar o CaféApp','<!doctype html>\n<html>\n<head>\n    <meta name=\"viewport\" content=\"width=device-width\"/>\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"/>\n    <title>[PAGAMENTO CONFIRMADO] Obrigado por assinar o CaféApp</title>\n    <style>\n        body {\n            -webkit-box-sizing: border-box;\n            -moz-box-sizing: border-box;\n            box-sizing: border-box;\n            font-family: Helvetica, sans-serif;\n        }\n\n        table {\n            max-width: 500px;\n            padding: 0 10px;\n            background: #ffffff;\n        }\n\n        .content {\n            font-size: 16px;\n            margin-bottom: 25px;\n            padding-bottom: 5px;\n            border-bottom: 1px solid #EEEEEE;\n        }\n\n        .content p {\n            margin: 25px 0;\n        }\n\n        .footer {\n            font-size: 14px;\n            color: #888888;\n            font-style: italic;\n        }\n\n        .footer p {\n            margin: 0 0 2px 0;\n        }\n    </style>\n</head>\n<body>\n<table role=\"presentation\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n    <tr>\n        <td>\n            <div class=\"content\">\n                \n<h3>Obrigado Robson!</h3><p>Estamos passando apenas para agradecer por você ser um assinante CaféApp PRO.</p><p>Sua fatura deste mês venceu hoje e já está paga de acordo com seu plano. Qualquer dúvida estamos a disposição.</p>                <p>Atenciosamente, equipe CaféControl.</p>\n            </div>\n            <div class=\"footer\">\n                <p>CaféControl - Gerencie suas contas com o melhor café</p>\n                <p>SC 406 - Rod. Drº Antônio Luiz Moura Gonzaga                    , 3339, Bloco A, Sala 208</p>\n                <p>Florianópolis/SC - 88048-301</p>\n            </div>\n        </td>\n    </tr>\n</table>\n</body>\n</html>\n','cursos@upinside.com.br','Robson V. Leite','robsonvleite@gmail.com','Robson Leite','2019-01-31 14:23:54','2019-01-04 11:13:11','2019-02-07 11:57:26'),
	(2,'[PAGAMENTO RECUSADO] Sua conta CaféApp precisa de atenção','<!doctype html>\n<html>\n<head>\n    <meta name=\"viewport\" content=\"width=device-width\"/>\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"/>\n    <title>[PAGAMENTO RECUSADO] Sua conta CaféApp precisa de atenção</title>\n    <style>\n        body {\n            -webkit-box-sizing: border-box;\n            -moz-box-sizing: border-box;\n            box-sizing: border-box;\n            font-family: Helvetica, sans-serif;\n        }\n\n        table {\n            max-width: 500px;\n            padding: 0 10px;\n            background: #ffffff;\n        }\n\n        .content {\n            font-size: 16px;\n            margin-bottom: 25px;\n            padding-bottom: 5px;\n            border-bottom: 1px solid #EEEEEE;\n        }\n\n        .content p {\n            margin: 25px 0;\n        }\n\n        .footer {\n            font-size: 14px;\n            color: #888888;\n            font-style: italic;\n        }\n\n        .footer p {\n            margin: 0 0 2px 0;\n        }\n    </style>\n</head>\n<body>\n<table role=\"presentation\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n    <tr>\n        <td>\n            <div class=\"content\">\n                \n<h3>Presado Robson!</h3><p>Não conseguimos cobrar seu cartão referênte a fatura deste mês para sua assinatura CaféApp. Precisamos que você veja isso.</p><p>Acesse sua conta para atualizar seus dados de pagamento, você pode cadastrar outro cartão.</p><p>Se não fizer nada agora uma nova tentativa de cobrança será feita em 3 dias. Se não der certo, sua assinatura será cancelada :/</p><p>Qualquer dúvida estamos a disposição.</p>                <p>Atenciosamente, equipe CaféControl.</p>\n            </div>\n            <div class=\"footer\">\n                <p>CaféControl - Gerencie suas contas com o melhor café</p>\n                <p>SC 406 - Rod. Drº Antônio Luiz Moura Gonzaga                    , 3339, Bloco A, Sala 208</p>\n                <p>Florianópolis/SC - 88048-301</p>\n            </div>\n        </td>\n    </tr>\n</table>\n</body>\n</html>\n','cursos@upinside.com.br','Robson V. Leite','robsonvleite@gmail.com','Robson Leite','2019-01-11 12:43:45','2019-01-04 11:19:54','2019-02-07 11:57:27'),
	(3,'[ASSINATURA CANCELADA] Sua conta CaféApp agora é FREE','<!doctype html>\n<html>\n<head>\n    <meta name=\"viewport\" content=\"width=device-width\"/>\n    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\"/>\n    <title>[ASSINATURA CANCELADA] Sua conta CaféApp agora é FREE</title>\n    <style>\n        body {\n            -webkit-box-sizing: border-box;\n            -moz-box-sizing: border-box;\n            box-sizing: border-box;\n            font-family: Helvetica, sans-serif;\n        }\n\n        table {\n            max-width: 500px;\n            padding: 0 10px;\n            background: #ffffff;\n        }\n\n        .content {\n            font-size: 16px;\n            margin-bottom: 25px;\n            padding-bottom: 5px;\n            border-bottom: 1px solid #EEEEEE;\n        }\n\n        .content p {\n            margin: 25px 0;\n        }\n\n        .footer {\n            font-size: 14px;\n            color: #888888;\n            font-style: italic;\n        }\n\n        .footer p {\n            margin: 0 0 2px 0;\n        }\n    </style>\n</head>\n<body>\n<table role=\"presentation\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">\n    <tr>\n        <td>\n            <div class=\"content\">\n                \n<h3>Que pena Robson :/</h3><p>Tentamos efetuar mais uma cobrança para sua assinatura PRO hoje, mas sem sucesso.</p><p>Como essa já é uma segunda tentativa, infelismente sua assinatura foi cancelada. Mas calma, você pode assinar novamente a qualquer momento.</p><p>Continue controlando com os recursos FREE, e assim que quiser basta assinar novamente e voltar de onde parou :)</p>                <p>Atenciosamente, equipe CaféControl.</p>\n            </div>\n            <div class=\"footer\">\n                <p>CaféControl - Gerencie suas contas com o melhor café</p>\n                <p>SC 406 - Rod. Drº Antônio Luiz Moura Gonzaga                    , 3339, Bloco A, Sala 208</p>\n                <p>Florianópolis/SC - 88048-301</p>\n            </div>\n        </td>\n    </tr>\n</table>\n</body>\n</html>\n','cursos@upinside.com.br','Robson V. Leite','robsonvleite@gmail.com','Robson Leite','2019-01-11 12:43:49','2019-01-04 11:34:01','2019-02-07 11:57:28');

/*!40000 ALTER TABLE `mail_queue` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela notifications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notifications`;

CREATE TABLE `notifications` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `view` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;

INSERT INTO `notifications` (`id`, `image`, `title`, `link`, `view`, `created_at`, `updated_at`)
VALUES
	(1,'https://www.localhost/phptest/fsphplib/themes/cafeadm/assets/images/notify.jpg','Robson V. Leite assinou o plano PRO de R$ 5,00/mês','https://www.localhost/fsphp/admin/control/subscription/4',0,'2019-02-11 08:53:35','2019-02-12 08:53:15'),
	(2,'https://www.localhost/phptest/fsphplib/themes/cafeadm/assets/images/notify.jpg','Eleno Santos assinou o plano PRO de R$ 50,00/ano','https://www.localhost/fsphp/admin/control/subscription/5',0,'2019-02-11 08:53:49','2019-02-12 08:53:15'),
	(3,'https://www.localhost/phptest/fsphplib/themes/cafeadm/assets/images/notify.jpg','Alexandre Santos assinou o plano PRO de R$ 5,00/mês','https://www.localhost/fsphp/admin/control/subscription/6',0,'2019-02-11 09:44:59','2019-02-12 08:53:15'),
	(4,'https://www.localhost/phptest/fsphplib/themes/cafeadm/assets/images/notify.jpg','Willian Santos assinou o plano PRO de R$ 5,00/mês','https://www.localhost/fsphp/admin/control/subscription/7',0,'2019-02-11 09:44:59','2019-02-12 08:53:15'),
	(5,'https://www.localhost/phptest/fsphplib/themes/cafeadm/assets/images/notify.jpg','Eduardo Santos assinou o plano PRO de R$ 5,00/mês','https://www.localhost/fsphp/admin/control/subscription/8',0,'2019-02-11 08:53:35','2019-02-12 08:53:16'),
	(6,'https://www.localhost/phptest/fsphplib/themes/cafeadm/assets/images/notify.jpg','Mateus Santos assinou o plano PRO de R$ 5,00/mês','https://www.localhost/fsphp/admin/control/subscription/4',0,'2019-02-11 09:44:59','2019-02-12 08:53:16'),
	(7,'https://www.localhost/phptest/fsphplib/themes/cafeadm/assets/images/notify.jpg','Felipe Santos assinou o plano PRO de R$ 5,00/mês','https://www.localhost/fsphp/admin/control/subscription/5',0,'2019-02-11 08:53:35','2019-02-12 08:53:16'),
	(8,'https://www.localhost/phptest/fsphplib/themes/cafeadm/assets/images/notify.jpg','Elton Santos assinou o plano PRO de R$ 5,00/mês','https://www.localhost/fsphp/admin/control/subscription/6',0,'2019-02-11 09:44:59','2019-02-12 08:53:16'),
	(9,'https://www.localhost/phptest/fsphplib/themes/cafeadm/assets/images/notify.jpg','Roddrigo Santos assinou o plano PRO de R$ 5,00/mês','https://www.localhost/fsphp/admin/control/subscription/7',0,'2019-02-11 09:44:59','2019-02-12 08:53:16'),
	(10,'https://www.localhost/phptest/fsphplib/themes/cafeadm/assets/images/notify.jpg','Fernanda Santos assinou o plano PRO de R$ 5,00/mês','https://www.localhost/fsphp/admin/control/subscription/8',0,'2019-02-11 09:44:59','2019-02-12 08:53:17'),
	(11,'https://www.localhost/phptest/fsphplib/themes/cafeadm/assets/images/notify.jpg','Bia Santos assinou o plano PRO de R$ 5,00/mês','https://www.localhost/fsphp/admin/control/subscription/4',0,'2019-02-11 08:53:35','2019-02-12 08:53:17'),
	(12,'https://www.localhost/phptest/fsphplib/themes/cafeadm/assets/images/notify.jpg','Maria Santos assinou o plano PRO de R$ 5,00/mês','https://www.localhost/fsphp/admin/control/subscription/5',0,'2019-02-11 08:53:35','2019-02-12 08:53:17');

/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author` int(11) unsigned DEFAULT NULL,
  `category` int(11) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `uri` varchar(255) NOT NULL,
  `subtitle` text NOT NULL,
  `content` text NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `video` varchar(50) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `status` varchar(20) NOT NULL DEFAULT 'draft' COMMENT 'post, draft, trash ',
  `post_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category`),
  KEY `user_id` (`author`),
  FULLTEXT KEY `full_text` (`title`,`subtitle`),
  CONSTRAINT `category_id` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `user_id` FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;


/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela report_access
# ------------------------------------------------------------

DROP TABLE IF EXISTS `report_access`;

CREATE TABLE `report_access` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `users` int(11) NOT NULL DEFAULT '1',
  `views` int(11) NOT NULL DEFAULT '1',
  `pages` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `report_access` WRITE;
/*!40000 ALTER TABLE `report_access` DISABLE KEYS */;


/*!40000 ALTER TABLE `report_access` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela report_online
# ------------------------------------------------------------

DROP TABLE IF EXISTS `report_online`;

CREATE TABLE `report_online` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(11) unsigned DEFAULT NULL,
  `ip` varchar(50) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `agent` varchar(255) NOT NULL DEFAULT '',
  `pages` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `report_online` WRITE;
/*!40000 ALTER TABLE `report_online` DISABLE KEYS */;

INSERT INTO `report_online` (`id`, `user`, `ip`, `url`, `agent`, `pages`, `created_at`, `updated_at`)
VALUES
	(4,51,'::1','/app','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36',31,'2019-02-14 13:37:38','2019-02-14 13:39:23');

/*!40000 ALTER TABLE `report_online` ENABLE KEYS */;
UNLOCK TABLES;

# -------------Modulo MAnutenção----------------------------------


# Dump da tabela collaborator_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `collaborator_category`;
CREATE TABLE `collaborator_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `application_id` int(11) unsigned NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `collaborator_category` WRITE;
/*!40000 ALTER TABLE `collaborator_category` DISABLE KEYS */;

/*!40000 ALTER TABLE `collaborator_category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela occupation_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `occupation_category`;
CREATE TABLE `occupation_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `application_id` int(11) unsigned NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `occupation_category` WRITE;
/*!40000 ALTER TABLE `occupation_category` DISABLE KEYS */;

/*!40000 ALTER TABLE `occupation_category` ENABLE KEYS */;
UNLOCK TABLES;

# Dump da tabela service_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `service_category`;
CREATE TABLE `service_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `application_id` int(11) unsigned NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `service_category` WRITE;
/*!40000 ALTER TABLE `service_category` DISABLE KEYS */;

/*!40000 ALTER TABLE `service_category` ENABLE KEYS */;
UNLOCK TABLES;

# Dump da tabela equipment_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `equipment_category`;
CREATE TABLE `equipment_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `application_id` int(11) unsigned NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `equipment_category` WRITE;
/*!40000 ALTER TABLE `equipment_category` DISABLE KEYS */;

/*!40000 ALTER TABLE `equipment_category` ENABLE KEYS */;
UNLOCK TABLES;



# Dump da tabela payment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment`(
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `application_id` int(11) unsigned NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;

/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

# Dump da tabela status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;

INSERT INTO `status` (`id`, `name`, `created_at`, `updated_at`)
VALUES
	(1,'AGENDADA','2021-03-17 18:57:00','2021-03-17 18:57:00'),(2,'FINALIZADA','2021-03-17 18:57:00','2021-03-17 18:57:00'),(3,'CANCELADA','2021-03-17 18:57:00','2021-03-17 18:57:00');

/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;




# Dump da tabela employee
# ------------------------------------------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `application_id` int(11) unsigned NOT NULL,
  `occupation_id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `document` varchar(25) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `phone1` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `phone2` varchar(50) DEFAULT NULL,
  `phone3` varchar(50) DEFAULT NULL,
  `address_street` varchar(255) DEFAULT NULL,
  `address_number` varchar(255) DEFAULT NULL,
  `address_neighborhood` varchar(30) DEFAULT NULL,
  `address_complement` varchar(255) DEFAULT NULL,
  `address_postalcode` varchar(255) DEFAULT NULL,
  `address_city` varchar(255) DEFAULT NULL,
  `address_state` varchar(255) DEFAULT NULL,
  `address_country` varchar(255) DEFAULT NULL,
  `observation` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;


/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;


# Dump da tabela equipments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `equipments`;

CREATE TABLE `equipments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `application_id` int(11) unsigned NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `supplier_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `localization` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `full_text` (`name`,`localization`,`tag`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `equipments` WRITE;
/*!40000 ALTER TABLE `equipments` DISABLE KEYS */;


/*!40000 ALTER TABLE `equipments` ENABLE KEYS */;
UNLOCK TABLES;

# Dump da tabela maintenance
# ------------------------------------------------------------

DROP TABLE IF EXISTS `maintenance`;
CREATE TABLE `maintenance`(
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `application_id` int(11) unsigned NOT NULL,
  `equipment_id` int(11) unsigned NOT NULL,
  `service_id` int(11) unsigned NOT NULL,
  `status_id` int(11) unsigned NOT NULL,
  `maintenance_type` varchar(255) NOT NULL,
  `date_initial` varchar(250) NOT NULL,
  `time_initial` varchar(250) NOT NULL,
  `date_final` varchar(250) NOT NULL,
  `time_final` varchar(250) NOT NULL,
  `annotations` varchar(255) DEFAULT NULL,
  `type_collaborator` varchar(25) DEFAULT NULL,
  `collaborator_name` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `maintenance_equipment` (`equipment_id`),
  KEY `maintenance_service` (`service_id`),
  CONSTRAINT `maintenance_equipment` FOREIGN KEY (`equipment_id`) REFERENCES `equipments` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `maintenance_service` FOREIGN KEY (`service_id`) REFERENCES `service_category` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `maintenance` WRITE;
/*!40000 ALTER TABLE `maintenance` DISABLE KEYS */;


/*!40000 ALTER TABLE `maintenance` ENABLE KEYS */;
UNLOCK TABLES;


DROP TABLE IF EXISTS `equipmentfile`;
CREATE TABLE `equipmentfile` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `application_id` int(11) unsigned NOT NULL,
  `equipment_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `uri` varchar(255) NOT NULL,
  `subtitle` text NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `video` varchar(50) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `equipment_file` (`equipment_id`),
  CONSTRAINT `equipment_file` FOREIGN KEY (`equipment_id`) REFERENCES `equipments` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `equipmentfile` WRITE;
/*!40000 ALTER TABLE `equipmentfile` DISABLE KEYS */;


/*!40000 ALTER TABLE `equipmentfile` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `equipmentworker`;
CREATE TABLE `equipmentworker` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `application_id` int(11) unsigned NOT NULL,
  `equipment_id` int(11) unsigned NOT NULL,
  `employee_id` int(11) unsigned NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `observation` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `equipmentworker` WRITE;
/*!40000 ALTER TABLE `equipmentworker` DISABLE KEYS */;

/*!40000 ALTER TABLE `equipmentworker` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `equipment_qrcode`;
CREATE TABLE `equipment_qrcode` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `application_id` int(11) unsigned NOT NULL,
  `equipment_id` int(11) UNSIGNED NOT NULL,
  `uri` varchar(255) DEFAULT NULL,
  `info` varchar(255) DEFAULT NULL,
  `support` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `qrcode_equipment` (`equipment_id`),
  CONSTRAINT `qrcode_equipment` FOREIGN KEY (`equipment_id`) REFERENCES `equipments` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `equipment_qrcode` WRITE;
/*!40000 ALTER TABLE `equipment_qrcode` DISABLE KEYS */;

/*!40000 ALTER TABLE `equipment_qrcode` ENABLE KEYS */;
UNLOCK TABLES;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

