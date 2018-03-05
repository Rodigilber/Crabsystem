CREATE DATABASE  IF NOT EXISTS `simple_invoice` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `simple_invoice`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: simple_invoice
-- ------------------------------------------------------
-- Server version	5.7.19-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cliente` varchar(255) NOT NULL,
  `initservprof_clientes` varchar(45) NOT NULL,
  `finservprof_clientes` varchar(45) NOT NULL,
  `regimen_fiscal_cliente` varchar(255) NOT NULL,
  `contabilidad_cliente` varchar(255) NOT NULL,
  `obligaciones_fisc_cliente` varchar(255) NOT NULL,
  `auxiliar_cliente_cliente` varchar(255) NOT NULL,
  `rfc_cliente_cliente` varchar(255) NOT NULL,
  `contr_rfc_cliente` varchar(255) NOT NULL,
  `contr_efirma_cliente` varchar(255) NOT NULL,
  `vigencia_efirma_cliente` varchar(255) NOT NULL,
  `nrp_cliente` varchar(255) NOT NULL,
  `fiel_imss_cliente` varchar(255) NOT NULL,
  `imss_patrones_cliente` varchar(255) NOT NULL,
  `infonavit_patrones_cliente` varchar(255) NOT NULL,
  `telefono_cliente` char(30) NOT NULL,
  `email_cliente` varchar(64) NOT NULL,
  `direccion_cliente` varchar(255) NOT NULL,
  `status_cliente` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `codigo_producto` (`nombre_cliente`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Rodigilber gonzalez','','','','','','','','','','','','','','','9991163510','rodigilber.gonzalez@gmail.com','dom con',1,'2018-01-03 08:33:46'),(2,'Mono loco','','','','','','','','','','','','','','','9991113322','mono@mail.com','selva',1,'2018-01-03 08:41:39'),(3,'leslie','','','','','','','','','','','','','','','9183929384','leslie@mail.com','dom X de Y xD',1,'2018-01-05 08:34:20'),(4,'Jhon Carpenter','','','','','','','','','','','','','','','9283749384','jhn@mail.com','dom desx X',1,'2018-01-05 08:39:42'),(5,'Evaristo Paramos','','','','','','','','','','','','','','','9991163419','evari@mail.com','Dom X de Y',1,'2018-01-09 02:02:57'),(6,'Hecto Salamanca','','','','','','','','','','','','','','','9991113294','hsa@mail.com','X dom',1,'2018-01-09 02:05:40'),(7,'Karla M Ehuan','','','','','','','','','','','','','','','9991163511','km@email.com','dom con X',1,'2018-01-09 02:12:07'),(9,'Albert Ali','','','','','','','','','','','','','','','98312398323','alber@mail.com','dom xx uPDATEd 23',1,'2018-01-09 02:31:21'),(10,'Juan Only','','','','','','','','','','','','','','','77712309823','juan@mail.com','dom x',1,'2018-01-09 02:34:15'),(11,'php man','','','','','','','','','','','','','','','9991152382','phpma@mail.com','dom cx ',1,'2018-01-09 02:55:27'),(12,'Mid Barrera','','','','','','','','','','','','','','','9183847364','dor@mail.com','dom c x',1,'2018-01-09 02:57:32'),(13,'lucie bi','','','','','','','','','','','','','','','9183749283','lu@mail.com','dom x f',1,'2018-01-09 02:59:08'),(14,'clear cache','','','','','','','','','','','','','','','9283746394','demos@user','enrique segoviano',1,'2018-01-09 03:01:09'),(15,'succes client','','','','','','','','','','','','','','','92837462034','clientescc@mail.com','dom ckk',1,'2018-01-09 03:55:14'),(16,'lion king','','','','','','','','','','','','','','','1093847263','lionk@mail.com','domjungle@mail.com',1,'2018-01-09 04:01:05'),(17,'gen tile','','','','','','','','','','','','','','','0193838475','geentl@mail.com','dome far',1,'2018-01-09 04:04:18'),(18,'gent le man','','','','','','','','','','','','','','','0284738920','gentleman@mail.com','dom x far',1,'2018-01-09 04:06:55'),(20,'after reestart ','','','RIF','DESC. XML','IVA','update','rfc updated','cont','cont','date','nrs','mucho txt','mucho txt','mucho txt','9284738473','afertreestart@mail.com','dom after reestart',1,'2018-01-09 04:10:32'),(21,'perrro verde','','','','','','','','','','','','','','','1083947283','perrov@mail.com','dom perr x',1,'2018-01-09 04:15:37'),(22,'pain user','','','','','','','','','','','','','','','1092839483','emailpain@mail.com','dom cdf',1,'2018-01-09 04:17:09'),(23,'test no succes','','','','','','','','','','','','','','','1930495830','nosucces@mail.com','no dom',1,'2018-01-09 04:18:31'),(24,'no succes two','','','','','','','','','','','','','','','9383847262','mailnosucc@mail.com','no scces',1,'2018-01-09 04:19:39'),(25,'completed ah','','','','','','','','','','','','','','','19283749540','completed@mail.com','dom',1,'2018-01-09 04:21:35'),(26,'no succes three','','','','','','','','','','','','','','','8372938374','nosucces3@mail.com','ajax test for succes function()',1,'2018-01-09 04:31:19'),(27,'no cache ','','','','','','','','','','','','','','','6383947384','nocache@mail.com','no cache incognito',1,'2018-01-09 04:35:38'),(28,'no cache 2','','','','','','','','','','','','','','','0009998887','nocache2@mail.com','no cache test2',1,'2018-01-09 04:38:03'),(29,'nombre solo test','','','','','','','','','','','','','','','','','',1,'2018-01-09 04:38:56'),(30,'no load function','','','','','','','','','','','','','','','1029223347','noloadfunction@mail.com','no load function to see what happens',1,'2018-01-09 04:41:24'),(31,'no','','','','','','','','','','','','','','','no','','no',1,'2018-01-09 04:45:58'),(32,'cliente modelo completo','','','Reg. De Sueldos y Salarios','DESC. XML','ISR','yoplis','1233403493','contraseña del rfd','contrasena de e firma','vigemcia temporal field','nrp ejemplo','mucho texto del fiel imss','imss patrones mucho texto\r\nddksjd','infonavit patrones mucho texto','9999999991','clientecompleto@mail.com','dom z cliente  dfd',1,'2018-01-13 04:18:12'),(33,'juan x','','','PF con Activ. Emp. y Prof.','DESC. XML','IEPS','com','fr','dedkej','dldaskjkwdk','06/30/2018','sdw','fefe','fefe','fefe','fefef','fefe@gmail.com','fefef',1,'2018-01-19 06:07:42'),(34,'nombre','','','RIF','DESC. XML','ISR','desc','rsdlskjldk','dmslkj','fdkdlf','01/31/2018','msdñk','ñkded','ññefñefjñ','','fjelfjel','correonuevo@gmail.com','rer',1,'2018-01-23 10:24:46'),(35,'wd','','','RIF','DESC. XML','IVA','dwd','wdw','dwd','wdwd','01/09/2018','dwdw','dwdw','dwdw','dwdw','dwdw','dwd@mail.com','dwd',1,'2018-01-25 06:19:28'),(36,'new model ','','','ISR,IVA,IEPS','DESC. XML','ISR,IEPS,ISR RETENIDO,IVA RETENIDO AL 16%','homero','no tiene','no tiene','sin contrasena','01/01/2018','NRP x','FIELD DEL IMSS','IMSS PATRONES ','INFO PATRONES','9999991111','newmodel@mail.com','dom new model',1,'2018-01-30 04:20:22'),(37,'new model 2','','','ISR,IEPS,ISR RETENIDO','DESC. XML','ISR,IEPS,IVA RETENIDO AL 16%','nope','fkdjfk','fkeofk','foekfoe','01/29/2018','efefe','fefe','fefefe','fefe','fefef','fefef@mail.com','fefef',1,'2018-01-30 04:21:25'),(38,'new model 3','','','ISR,IEPS','CONTPAQ','ISR','nana','ldk','lk','fefef','01/04/2018','efefe','fefef','efefef','fefef','1010119983','mail@me.com','efif',1,'2018-01-30 04:23:20'),(39,'final model','01/01/2018','01/29/2018','RIF,Régimen de Arrendamiento,Sector Primario','DESC. XML','ISR,IVA,ISR POR SUELDOS Y SALARIOS,IVA RETENIDO AL 16%','rat','rerje','ofj','pjp','01/31/2018','keff','p','´fk','	jefjpejpfjepfi','j','final@modelmail.com','feokfj',1,'2018-01-30 04:44:41'),(40,'final model2','01/01/2017','01/29/2017','RIF','DESC. XML','ISR','rat','rerje','ofj','pjp','01/31/2017','keff','p','´fk','	jefjpejpfjepfi','j','final@modelmail.com','actualizada',1,'2018-01-30 04:44:57'),(41,'angie','01/01/2018','02/28/2018','RIF,PF con Activ. Emp. y Prof.','DESC. XML','IEPS,ISR RETENIDO,IVA RETENIDO AL 16%','nop','11019jdksjkj','dksjfksj','skjfskjfksq','01/02/2018','sfsfsf','fwfefe','fefefe','fefef','efefe','angie@mail.com','fefe',1,'2018-01-31 05:59:14');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `precision` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thousand_separator` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `decimal_separator` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'US Dollar','$','2',',','.','USD'),(2,'Libra Esterlina','&pound;','2',',','.','GBP'),(3,'Euro','â‚¬','2','.',',','EUR'),(4,'South African Rand','R','2','.',',','ZAR'),(5,'Danish Krone','kr ','2','.',',','DKK'),(6,'Israeli Shekel','NIS ','2',',','.','ILS'),(7,'Swedish Krona','kr ','2','.',',','SEK'),(8,'Kenyan Shilling','KSh ','2',',','.','KES'),(9,'Canadian Dollar','C$','2',',','.','CAD'),(10,'Philippine Peso','P ','2',',','.','PHP'),(11,'Indian Rupee','Rs. ','2',',','.','INR'),(12,'Australian Dollar','$','2',',','.','AUD'),(13,'Singapore Dollar','SGD ','2',',','.','SGD'),(14,'Norske Kroner','kr ','2','.',',','NOK'),(15,'New Zealand Dollar','$','2',',','.','NZD'),(16,'Vietnamese Dong','VND ','0','.',',','VND'),(17,'Swiss Franc','CHF ','2','\'','.','CHF'),(18,'Quetzal Guatemalteco','Q','2',',','.','GTQ'),(19,'Malaysian Ringgit','RM','2',',','.','MYR'),(20,'Real Brasile&ntilde;o','R$','2','.',',','BRL'),(21,'Thai Baht','THB ','2',',','.','THB'),(22,'Nigerian Naira','NGN ','2',',','.','NGN'),(23,'Peso Argentino','$','2','.',',','ARS'),(24,'Bangladeshi Taka','Tk','2',',','.','BDT'),(25,'United Arab Emirates Dirham','DH ','2',',','.','AED'),(26,'Hong Kong Dollar','$','2',',','.','HKD'),(27,'Indonesian Rupiah','Rp','2',',','.','IDR'),(28,'Peso Mexicano','$','2',',','.','MXN'),(29,'Egyptian Pound','&pound;','2',',','.','EGP'),(30,'Peso Colombiano','$','2','.',',','COP'),(31,'West African Franc','CFA ','2',',','.','XOF'),(32,'Chinese Renminbi','RMB ','2',',','.','CNY');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_factura`
--

DROP TABLE IF EXISTS `detalle_factura`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle_factura` (
  `id_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `numero_factura` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` double NOT NULL,
  PRIMARY KEY (`id_detalle`),
  KEY `numero_cotizacion` (`numero_factura`,`id_producto`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_factura`
--

LOCK TABLES `detalle_factura` WRITE;
/*!40000 ALTER TABLE `detalle_factura` DISABLE KEYS */;
INSERT INTO `detalle_factura` VALUES (71,1,4,1,35),(70,1,2,1,20),(74,1,2,1,20),(73,1,2,1,20),(78,1,2,1,20),(72,1,2,1,20),(77,1,2,1,20),(76,1,2,1,20),(81,1,2,1,20),(80,1,2,1,20),(79,1,2,1,20),(75,1,2,1,20),(83,1,2,1,20),(82,1,2,1,20),(86,1,2,1,20),(85,1,2,1,20),(84,1,2,1,20);
/*!40000 ALTER TABLE `detalle_factura` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturas`
--

DROP TABLE IF EXISTS `facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facturas` (
  `id_factura` int(11) NOT NULL AUTO_INCREMENT,
  `numero_factura` int(11) NOT NULL,
  `fecha_factura` datetime NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `condiciones` varchar(30) NOT NULL,
  `total_venta` varchar(20) NOT NULL,
  `estado_factura` tinyint(1) NOT NULL,
  `saldo` decimal(9,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id_factura`),
  UNIQUE KEY `numero_cotizacion` (`numero_factura`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturas`
--

LOCK TABLES `facturas` WRITE;
/*!40000 ALTER TABLE `facturas` DISABLE KEYS */;
INSERT INTO `facturas` VALUES (3,1,'2018-02-26 16:57:23',12,1,'1','40.00',1,0.00);
/*!40000 ALTER TABLE `facturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(150) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `codigo_postal` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(64) NOT NULL,
  `impuesto` int(2) NOT NULL,
  `moneda` varchar(6) NOT NULL,
  `logo_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` VALUES (1,'CRAB SYSTEMS','Fracc las Americas Merida Yuc','Merida','27000','Merida','9991163510','rodigilber.gonzalez@gmail.com',16,'$','img/1514964635_crab-tech-logo.jpg');
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_producto` char(20) NOT NULL,
  `nombre_producto` char(255) NOT NULL,
  `status_producto` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL,
  `precio_producto` double NOT NULL,
  PRIMARY KEY (`id_producto`),
  UNIQUE KEY `codigo_producto` (`codigo_producto`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'01','ejemplo cobro',1,'2018-01-03 08:34:48',200),(2,'02','bananas',1,'2018-01-03 08:42:03',20),(3,'5','cobro de honorarios',1,'2018-01-13 04:26:27',3500),(4,'03','cobrando test',1,'2018-01-23 05:11:24',35);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblpagos`
--

DROP TABLE IF EXISTS `tblpagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblpagos` (
  `idPago` int(255) NOT NULL AUTO_INCREMENT,
  `idFactura` int(255) NOT NULL,
  `idVendedor` int(255) NOT NULL,
  `fechaPago` date NOT NULL,
  `montoPagado` decimal(9,2) NOT NULL DEFAULT '0.00',
  `saldoAnterior` decimal(9,2) NOT NULL DEFAULT '0.00',
  `saldoActual` decimal(9,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`idPago`),
  KEY `idFactura` (`idFactura`),
  CONSTRAINT `Factura` FOREIGN KEY (`idFactura`) REFERENCES `facturas` (`id_factura`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblpagos`
--

LOCK TABLES `tblpagos` WRITE;
/*!40000 ALTER TABLE `tblpagos` DISABLE KEYS */;
INSERT INTO `tblpagos` VALUES (16,3,1,'2018-02-26',10.00,40.00,30.00),(17,3,1,'2018-02-26',30.00,30.00,0.00);
/*!40000 ALTER TABLE `tblpagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tmp`
--

DROP TABLE IF EXISTS `tmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tmp` (
  `id_tmp` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `cantidad_tmp` int(11) NOT NULL,
  `precio_tmp` double(8,2) DEFAULT NULL,
  `session_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_tmp`)
) ENGINE=MyISAM AUTO_INCREMENT=243 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tmp`
--

LOCK TABLES `tmp` WRITE;
/*!40000 ALTER TABLE `tmp` DISABLE KEYS */;
INSERT INTO `tmp` VALUES (213,2,1,20.00,'uca8vlqllr60et59kfpg0j6kj1'),(212,2,1,20.00,'uca8vlqllr60et59kfpg0j6kj1'),(211,2,1,20.00,'uca8vlqllr60et59kfpg0j6kj1'),(185,1,1,200.00,'fumq7k4n1q2mho9oahts8d46e4'),(184,1,1,200.00,'fumq7k4n1q2mho9oahts8d46e4'),(182,1,1,200.00,'fumq7k4n1q2mho9oahts8d46e4'),(183,2,1,20.00,'fumq7k4n1q2mho9oahts8d46e4'),(181,1,1,200.00,'fumq7k4n1q2mho9oahts8d46e4'),(209,2,1,20.00,'uca8vlqllr60et59kfpg0j6kj1'),(210,2,1,20.00,'uca8vlqllr60et59kfpg0j6kj1'),(208,2,1,20.00,'uca8vlqllr60et59kfpg0j6kj1'),(242,2,1,20.00,'bv4e4sr6mbmvmlks0iqpll9f15');
/*!40000 ALTER TABLE `tmp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `firstname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'rodi','gonzalez','admin','$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO','admin@admin.com','2016-05-21 15:06:00'),(2,'Rodigilber','Gonzalez','demo','$2y$10$wIo/2d.yEhIcHbuFKysjo.TMbkuLBxdKUrlAL5URymGUfZh4Un3cK','rodigilber.gonzalez@gmail.com','2018-01-03 08:32:41'),(3,'Empleado1','abc defg','empleado','$2y$10$wzYf1h6HSbMnag3HpuGQ..cs0uKwjrPaSQf.yGJhywjSou3TEgSEm','empleado@mail.com','2018-01-03 09:54:36'),(4,'Mariana','x','mariana','$2y$10$/erY2SX8F/H2NLW5DyJ7ieTZi.Ab.Ii8bauavqQk6UKPlez4shW/W','mariana@ventas.com','2018-01-23 05:24:05'),(5,'Carlos','Godines Bravo','carlos','$2y$10$M46sOnV8tl8owrqNeY5eoOMxRPRvSoDZIklbzwaAFGpsQKB4GmpC6','carlos@mail.com','2018-02-03 05:37:59');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-26 22:48:53
