-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: controleacesso
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

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
-- Table structure for table `caixadiarios`
--

DROP TABLE IF EXISTS `caixadiarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caixadiarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `abertura` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fechamento` timestamp NULL DEFAULT NULL,
  `valortotal` decimal(10,2) DEFAULT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caixadiarios`
--

LOCK TABLES `caixadiarios` WRITE;
/*!40000 ALTER TABLE `caixadiarios` DISABLE KEYS */;
INSERT INTO `caixadiarios` VALUES (1,'2017-05-19 20:15:56',NULL,NULL,'2017-05-19'),(2,'2017-05-19 20:20:35',NULL,NULL,'2017-05-19'),(4,'2017-05-19 20:22:58',NULL,NULL,'2017-05-19'),(5,'2017-05-19 21:30:45',NULL,NULL,'2017-05-19');
/*!40000 ALTER TABLE `caixadiarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `telefone` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Lucas','95935475','00 00000-0000'),(2,'','','');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes_veiculos`
--

DROP TABLE IF EXISTS `clientes_veiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes_veiculos` (
  `cliente` int(11) NOT NULL AUTO_INCREMENT,
  `veiculo` int(11) NOT NULL,
  PRIMARY KEY (`cliente`,`veiculo`),
  KEY `fk_clientes_has_veiculos_veiculos1_idx` (`veiculo`),
  KEY `fk_clientes_has_veiculos_clientes1_idx` (`cliente`),
  CONSTRAINT `fk_clientes_has_veiculos_clientes1` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_clientes_has_veiculos_veiculos1` FOREIGN KEY (`veiculo`) REFERENCES `veiculos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes_veiculos`
--

LOCK TABLES `clientes_veiculos` WRITE;
/*!40000 ALTER TABLE `clientes_veiculos` DISABLE KEYS */;
INSERT INTO `clientes_veiculos` VALUES (1,5),(1,9),(1,10),(1,14),(1,16),(1,18),(1,20),(1,21),(1,23),(1,24),(1,25),(1,26),(1,28),(1,29),(1,31),(1,33),(1,34),(1,35),(1,36),(1,37),(1,39);
/*!40000 ALTER TABLE `clientes_veiculos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entradas_veiculos`
--

DROP TABLE IF EXISTS `entradas_veiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entradas_veiculos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `veiculo` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`veiculo`),
  KEY `fk_movimentacao_veiculos1_idx` (`veiculo`),
  CONSTRAINT `fk_movimentacao_veiculos1` FOREIGN KEY (`veiculo`) REFERENCES `veiculos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entradas_veiculos`
--

LOCK TABLES `entradas_veiculos` WRITE;
/*!40000 ALTER TABLE `entradas_veiculos` DISABLE KEYS */;
INSERT INTO `entradas_veiculos` VALUES (1,5,'2017-05-19 20:08:57'),(2,5,'2017-05-19 20:11:08'),(3,5,'2017-05-19 20:11:49'),(4,5,'2017-05-19 20:12:23'),(5,5,'2017-05-19 20:14:24');
/*!40000 ALTER TABLE `entradas_veiculos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensalidades`
--

DROP TABLE IF EXISTS `mensalidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensalidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` int(11) NOT NULL,
  `veiculo` int(11) NOT NULL,
  `datavencimento` date NOT NULL,
  PRIMARY KEY (`id`,`cliente`,`veiculo`),
  KEY `fk_mensalidade_veiculos1_idx` (`veiculo`),
  KEY `fk_mensalidade_clientes1_idx` (`cliente`),
  CONSTRAINT `fk_mensalidade_clientes1` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mensalidade_veiculos1` FOREIGN KEY (`veiculo`) REFERENCES `veiculos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensalidades`
--

LOCK TABLES `mensalidades` WRITE;
/*!40000 ALTER TABLE `mensalidades` DISABLE KEYS */;
INSERT INTO `mensalidades` VALUES (3,1,4,'2017-05-19'),(4,1,34,'2017-05-19'),(5,1,35,'2017-05-19'),(6,1,36,'2017-05-19'),(7,1,37,'2017-05-19');
/*!40000 ALTER TABLE `mensalidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimentacao_caixadiario`
--

DROP TABLE IF EXISTS `movimentacao_caixadiario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movimentacao_caixadiario` (
  `movimentacao_veiculos` int(11) NOT NULL,
  `caixadiario` int(11) NOT NULL,
  PRIMARY KEY (`movimentacao_veiculos`,`caixadiario`),
  KEY `fk_saida_veiculos_has_caixadiario_caixadiario1_idx` (`caixadiario`),
  KEY `fk_saida_veiculos_has_caixadiario_saida_veiculos1_idx` (`movimentacao_veiculos`),
  CONSTRAINT `fk_saida_veiculos_has_caixadiario_caixadiario1` FOREIGN KEY (`caixadiario`) REFERENCES `caixadiarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_saida_veiculos_has_caixadiario_saida_veiculos1` FOREIGN KEY (`movimentacao_veiculos`) REFERENCES `saidas_veiculos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimentacao_caixadiario`
--

LOCK TABLES `movimentacao_caixadiario` WRITE;
/*!40000 ALTER TABLE `movimentacao_caixadiario` DISABLE KEYS */;
/*!40000 ALTER TABLE `movimentacao_caixadiario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saidas_veiculos`
--

DROP TABLE IF EXISTS `saidas_veiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saidas_veiculos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entrada_veiculo` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `valor` decimal(10,2) NOT NULL,
  `iscortesia` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`,`entrada_veiculo`,`usuario`),
  KEY `fk_saidas_usuarios1_idx` (`usuario`),
  KEY `fk_saidas_veiculos_entradas_veiculos1_idx` (`entrada_veiculo`),
  CONSTRAINT `fk_saidas_usuarios1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_saidas_veiculos_entradas_veiculos1` FOREIGN KEY (`entrada_veiculo`) REFERENCES `entradas_veiculos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saidas_veiculos`
--

LOCK TABLES `saidas_veiculos` WRITE;
/*!40000 ALTER TABLE `saidas_veiculos` DISABLE KEYS */;
/*!40000 ALTER TABLE `saidas_veiculos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipos`
--

DROP TABLE IF EXISTS `tipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `valorporhora` decimal(10,2) NOT NULL,
  `valorpormes` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipos`
--

LOCK TABLES `tipos` WRITE;
/*!40000 ALTER TABLE `tipos` DISABLE KEYS */;
INSERT INTO `tipos` VALUES (1,'carro',24.45,536.42);
/*!40000 ALTER TABLE `tipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'test','test','test',1,1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veiculos`
--

DROP TABLE IF EXISTS `veiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `veiculos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) NOT NULL,
  `placa` varchar(45) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `cor` varchar(255) NOT NULL,
  `ismensal` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`,`tipo`),
  UNIQUE KEY `placa_UNIQUE` (`placa`),
  KEY `fk_veiculos_tipos1_idx` (`tipo`),
  CONSTRAINT `fk_veiculos_tipos1` FOREIGN KEY (`tipo`) REFERENCES `tipos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veiculos`
--

LOCK TABLES `veiculos` WRITE;
/*!40000 ALTER TABLE `veiculos` DISABLE KEYS */;
INSERT INTO `veiculos` VALUES (4,1,'fjkshf','afjfhk','{saffs}',0),(5,1,'FSJ-2485','Uno','Branco',1),(9,1,'FSJ-2484','Uno','Branco',1),(10,1,'FSJ-2487','Uno','Branco',1),(14,1,'FSJ-2459','Uno','Branco',1),(16,1,'FSJ-2356','Uno','Branco',1),(18,1,'FSJ-2536','Uno','Branco',1),(20,1,'FSJ-3256','Uno','Branco',1),(21,1,'FSJ-5352','Uno','Branco',1),(23,1,'FSJ-5353','Uno','Branco',1),(24,1,'FSJ-5235536','Uno','Branco',0),(25,1,'FSJ-535621','Uno','Branco',1),(26,1,'FSJ2-535243532535621','Uno','Branco',1),(28,1,'FSJ2-53524535621','Uno','Branco',1),(29,1,'FSJ2-35265','Uno','Branco',1),(31,1,'FSJ2-34642','Uno','Branco',1),(33,1,'FSJ2-34363626747','Uno','Branco',1),(34,1,'FSJ2-343636263535747','Uno','Branco',1),(35,1,'FSJ2-54342','Uno','Branco',1),(36,1,'FSJ2-25467','Uno','Branco',1),(37,1,'FSJ2-53156','Uno','Branco',1),(39,1,'FSJ2-12456','Uno','Branco',0);
/*!40000 ALTER TABLE `veiculos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-22 21:53:52
