/*
SQLyog Community v13.2.0 (64 bit)
MySQL - 5.7.41-log : Database - crud_vmarket
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`crud_vmarket` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `crud_vmarket`;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `fornecedor_produto` */

DROP TABLE IF EXISTS `fornecedor_produto`;

CREATE TABLE `fornecedor_produto` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_produto` bigint(20) unsigned NOT NULL,
  `id_fornecedor` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fornecedor_produto_id_produto_foreign` (`id_produto`),
  KEY `fornecedor_produto_id_fornecedor_foreign` (`id_fornecedor`),
  CONSTRAINT `fornecedor_produto_id_fornecedor_foreign` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fornecedor_produto_id_produto_foreign` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `fornecedor_produto` */

insert  into `fornecedor_produto`(`id`,`id_produto`,`id_fornecedor`,`created_at`,`updated_at`) values 
(1,1,1,'2024-10-02 01:25:04','2024-10-02 01:25:04'),
(2,1,3,'2024-10-02 01:25:04','2024-10-02 01:25:04'),
(3,2,1,'2024-10-02 01:25:55','2024-10-02 01:25:55'),
(4,2,2,'2024-10-02 01:25:55','2024-10-02 01:25:55'),
(5,3,1,'2024-10-02 01:26:40','2024-10-02 01:26:40'),
(6,3,4,'2024-10-02 01:26:40','2024-10-02 01:26:40'),
(7,4,3,'2024-10-02 01:27:16','2024-10-02 01:27:16'),
(8,4,4,'2024-10-02 01:27:16','2024-10-02 01:27:16');

/*Table structure for table `fornecedores` */

DROP TABLE IF EXISTS `fornecedores`;

CREATE TABLE `fornecedores` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cep` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bairro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnpj` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('ativo','inativo') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fornecedores_email_unique` (`email`),
  UNIQUE KEY `fornecedores_cnpj_unique` (`cnpj`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `fornecedores` */

insert  into `fornecedores`(`id`,`nome`,`email`,`telefone`,`cep`,`endereco`,`bairro`,`numero`,`cidade`,`estado`,`cnpj`,`status`,`created_at`,`updated_at`) values 
(1,'Fornecedor A','fornecedorA@fornecedores.com','(11) 11111-1111','12210-170','Praça Doutor João Mendes','Centro','11','São José dos Campos','SP','11.111.111/1111-11','ativo','2024-10-01 21:29:16','2024-10-01 21:29:16'),
(2,'Fornecedor B','fornecedorB@fornecedores.com','(22) 22222-2222','12210-040','Rua Antônio Saes','Centro','22','São José dos Campos','SP','22.222.222/2222-22','ativo','2024-10-01 21:31:01','2024-10-01 21:31:01'),
(3,'Fornecedor C','fornecedorC@fornecedores.com','(33) 33333-3333','12209-390','Rua Carvalho de Araújo','Vila Maria','33','São José dos Campos','SP','33.333.333/3333-33','ativo','2024-10-01 21:32:23','2024-10-01 21:32:23'),
(4,'Fornecedor D','fornecedorD@fornecedores.com','(44) 44444-4444','12209-700','Rua Recife','Vila Terezinha','44','São José dos Campos','SP','44.444.444/4444-44','ativo','2024-10-01 21:33:26','2024-10-01 21:33:26');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_reset_tokens_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2024_09_30_135208_create_fornecedores_table',1),
(6,'2024_09_30_135219_create_produtos_table',1),
(7,'2024_09_30_135239_create_fornecedor_produto_table',1);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `produtos` */

DROP TABLE IF EXISTS `produtos`;

CREATE TABLE `produtos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `preco` decimal(8,2) NOT NULL,
  `qtd` int(11) NOT NULL,
  `status` enum('ativo','inativo') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `produtos` */

insert  into `produtos`(`id`,`nome`,`descricao`,`preco`,`qtd`,`status`,`created_at`,`updated_at`) values 
(1,'Smartfone X','Smartphone com 128GB de armazenamento, tela de 6.5 polegadas',2990.00,50,'ativo','2024-10-02 01:25:04','2024-10-02 01:25:04'),
(2,'Notebook Pro','Notebook com processador Intel i7, 16GB RAM, 512GB SSD',4055.00,20,'ativo','2024-10-02 01:25:55','2024-10-02 01:25:55'),
(3,'Monitor','Monitor de 34 polegadas com resolução QHD e taxa de 144Hz',680.00,10,'ativo','2024-10-02 01:26:40','2024-10-02 01:26:40'),
(4,'Teclado','Teclado mecânico com iluminação RGB e switches azuis',450.00,20,'ativo','2024-10-02 01:27:16','2024-10-02 01:27:16');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'teste','teste@teste.com.br',NULL,'$2y$10$73mmZFK67gvUqiy7MzxY.udUBFFG1OQ37s888KF3OX2mYZmZJf8e2',NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
