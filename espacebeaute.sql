-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: espacebeaute
-- ------------------------------------------------------
-- Server version	5.5.38-0+wheezy1

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `mdp` varchar(30) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'espace','espace33','administrateur'),(2,'admin','admin335','ico');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `catproduct`
--

DROP TABLE IF EXISTS `catproduct`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `catproduct` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `ordre_affichage` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catproduct`
--

LOCK TABLES `catproduct` WRITE;
/*!40000 ALTER TABLE `catproduct` DISABLE KEYS */;
INSERT INTO `catproduct` VALUES (41,0,'Aménagements bois','/_MG_5081-41.jpg',2),(43,0,'Aménagements modulaires','/_MG_5255-43.jpg',1),(50,43,'Bois de chène...','',1),(51,43,'Bois de l\'érable du coin','',2),(54,0,'Autres','',3);
/*!40000 ALTER TABLE `catproduct` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(250) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `adresse` varchar(250) NOT NULL,
  `cp` varchar(10) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `message` text,
  `newsletter` tinyint(4) NOT NULL DEFAULT '0',
  `fromgoldbook` tinyint(4) NOT NULL DEFAULT '0',
  `fromcontact` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (3,'test','test','t','e','s','franck_langleron@hotmail.com','test','qq',0,1,1);
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_categorie`
--

DROP TABLE IF EXISTS `contact_categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_categorie` (
  `id_contact` int(11) unsigned NOT NULL,
  `id_categorie` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_categorie`
--

LOCK TABLES `contact_categorie` WRITE;
/*!40000 ALTER TABLE `contact_categorie` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goldbook`
--

DROP TABLE IF EXISTS `goldbook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goldbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `nom` varchar(250) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` text,
  `online` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goldbook`
--

LOCK TABLES `goldbook` WRITE;
/*!40000 ALTER TABLE `goldbook` DISABLE KEYS */;
INSERT INTO `goldbook` VALUES (1,'2015-09-06 00:00:00','Franck Langleron','franck_langleron@hotmail.com','Très professionnel ! je recommande!!',0),(2,'2015-09-07 00:00:00','Xavier Gonzalez','xavier@gonzalez.pm','Prestation nickel, très pro, très satisfait',1),(3,'2015-11-07 00:00:00','L\'angléron','franck_langleron@hotmail.com','mon message \r\nc\'est ça!!!',1),(4,'2015-11-22 00:00:00','L\'angléron','franck_langleron@hotmail.com','Blablabla...',1);
/*!40000 ALTER TABLE `goldbook` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_news`
--

DROP TABLE IF EXISTS `media_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_news` int(11) NOT NULL,
  `url_media` varchar(250) NOT NULL,
  `url_apercu` varchar(250) NOT NULL,
  `type_media` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`id_news`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_news`
--

LOCK TABLES `media_news` WRITE;
/*!40000 ALTER TABLE `media_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `media_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id_news` int(11) NOT NULL AUTO_INCREMENT,
  `date_news` datetime NOT NULL,
  `titre` varchar(250) NOT NULL,
  `contenu` text,
  `image1` varchar(250) DEFAULT NULL,
  `online` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_news`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (30,'2016-01-07 00:00:00','Nouveaux produits','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','/SallyHayden_Guinot3-30.jpg',1),(31,'2015-11-22 00:00:00','L\'autre jour...',' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pellentesque ut risus id aliquam. Duis dapibus rhoncus neque ac tempus. Nunc laoreet tincidunt libero, a fermentum lacus semper ac. Donec lobortis pretium urna euismod auctor. Duis ut mattis metus, ac ultricies eros. Etiam a porta purus, efficitur pulvinar nibh. Mauris a rutrum quam. In arcu leo, egestas vitae mi a, viverra finibus mauris. Nunc consectetur tellus at ligula pulvinar sodales efficitur quis est. Proin porttitor massa mauris, ut vulputate nulla malesuada sed. Mauris fermentum fermentum rhoncus. Nullam convallis at enim at placerat. Nulla ut augue tincidunt diam egestas luctus. Sed orci justo, pellentesque vel aliquet non, ornare id est. Donec dui sapien, varius eu lectus at, ullamcorper ornare nunc. Quisque a sollicitudin metus.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque non blandit ligula, eu congue elit. Etiam tempor tortor non ante placerat placerat. Quisque convallis porttitor nisi, nec euismod velit sollicitudin at. Duis pretium ex sed enim consectetur, eu egestas diam vestibulum. Aliquam vulputate turpis et risus congue interdum. Fusce molestie, magna vel interdum volutpat, purus est lobortis erat, eget interdum lorem massa sed risus. Morbi justo dolor, convallis eget cursus eu, luctus eu lectus. Vestibulum mi risus, condimentum a nibh vel, imperdiet consectetur purus. Praesent vel ante erat. In hac habitasse platea dictumst. Aenean pellentesque enim nisi, vel varius justo fringilla in. Vestibulum scelerisque pretium dolor, vel pretium metus dapibus sed. Aenean gravida, erat quis tempus pulvinar, ligula odio imperdiet velit, in semper leo augue id neque. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;\r\n\r\nNam nec odio ut erat rutrum tempor. Etiam luctus, ante nec sodales lobortis, ipsum sapien ultricies orci, nec blandit odio nunc in ligula. Mauris a egestas turpis, a tristique libero. Proin aliquam ex ac feugiat pellentesque. Aliquam ac nibh sit amet nunc sodales tincidunt. Aenean nec facilisis tortor, porta iaculis dui. Aliquam id iaculis purus. Praesent id mi sed turpis eleifend interdum. Pellentesque ac fringilla ex. ','/soin_corps_guinot-31.jpg',1),(32,'2016-03-07 00:00:00','Gamme complete des produits solaire','Longue vie soleil,\r\nUni bronze,\r\nGrand soin après soleil,\r\nSctik indice 50 visage, \r\nCreme visage 50 \r\nSpray protestion corps ','/images_4_-.jpg',1),(33,'2016-03-07 00:00:00','Baume Nutri Logic douceur et confort pour le corps','Adoucit et réconforte la peau immédiatement,nourrit la peau durablement,protége la peau toute la journée','/568e48fcd199c-.jpg',1),(34,'2016-03-05 00:00:00','Minceur Rapide','La solution simple rapide et efficace,\r\ndiminution de l\'aspect visible de la cellulite,\r\nAnti -gras bruleur de  graisses\r\nAnti-eau drainage minceur','/1618_66398c-.png',1),(35,'2016-03-03 00:00:00','Poudre soleil et le Gloss été','Effet bronzé naturellement et le gloss pour apporter le coté glamour \r\n','/10093295_duo_poudre_teint_soleil-.jpg',1),(36,'2016-03-03 00:00:00','Sérum Bioxygene','Hydratation de la peau et  redonne de éclat du teint  pour une peau en pleine forme,défatigue les traits pour un teint frais et reposé\r\nConcentré éclat et vitalité','/1626_db7ff0-.png',1),(37,'2016-03-01 00:00:00','400 ml PROMO Gommage facile et hydrazone corps','GOMMAGE EXFOLIANT ET LE LAIT HYDRAZONE ','/56c6f2c58fec3-.jpg',1),(38,'2016-03-04 00:00:00','Hydraderm Energy Cellular','NOUVEL APPAREIL POUR LES SOINS STAR GUINOT','/images_1_-.jpg',1);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter`
--

DROP TABLE IF EXISTS `newsletter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `titre` varchar(250) DEFAULT NULL,
  `bas_page` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter`
--

LOCK TABLES `newsletter` WRITE;
/*!40000 ALTER TABLE `newsletter` DISABLE KEYS */;
INSERT INTO `newsletter` VALUES (12,'2015-01-01 00:00:00','Ceci est la toute nouvelle actu',' ');
/*!40000 ALTER TABLE `newsletter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter_detail`
--

DROP TABLE IF EXISTS `newsletter_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_newsletter` int(10) unsigned NOT NULL,
  `titre` varchar(250) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `texte` text,
  PRIMARY KEY (`id`,`id_newsletter`)
) ENGINE=InnoDB AUTO_INCREMENT=327 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter_detail`
--

LOCK TABLES `newsletter_detail` WRITE;
/*!40000 ALTER TABLE `newsletter_detail` DISABLE KEYS */;
INSERT INTO `newsletter_detail` VALUES (326,12,'','/IMG_5187-12.jpg','http://dev.votreimmopro.com','');
/*!40000 ALTER TABLE `newsletter_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `soin`
--

DROP TABLE IF EXISTS `soin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `soin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categorie` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `texte` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `online` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `soin`
--

LOCK TABLES `soin` WRITE;
/*!40000 ALTER TABLE `soin` DISABLE KEYS */;
INSERT INTO `soin` VALUES (1,1,'Peel\'in / Peel\'out','Le gel peel\'in aux acides de fruits dissocie les cellules mortes des cellules vivantes et la mousse peel\'out exfolie les cellules mortes pour faire renaitre l\'éclat d\'une peau neuve','/35e221e3ebd787de0636cac049b9461d-1.jpg','1'),(7,7,'Douceur Relaxant  (californien ,sportifs,balinais)','Succombez à une merveilleuse sensation de bien être et de détente\r\nSoin manuel délassant détoxifie la peau et vous procure un instant de détente et de plénitude absolue.','/GUINOT_MASSAGE-7.jpg','1'),(9,6,'Soin Minceur ','30 min le soin traite toutes les surfaces du corps  et permet de réduire la cellulite partout ou elle se trouve en instant sur les zones critiques telles que le ventre,les hanches et les cuisses \r\nréduit visiblement l\'aspect capitonné de la peau et agit au coeur des cellules.\r\nVotre silhouette  retrouve ses formes','/images_3_-9.jpg','1'),(10,4,'Soin Pro-collagène ','50 Min le soin Liftosome est un soin dédié 100% à la fermeté et la jeunesse de la peau ;aide votre peau à retrouver toutes son élasticité.','/35e221e3ebd787de0636cac049b9461d-10.jpg','1'),(12,13,'Hydradermie Lift','60 Min le visage parait plus jeune la peau est raffermie,les traits sont remontés.\r\nil agit profondément en remontant les traits par la stimulation des muscles le visage est visiblement lifté\r\nSoin effet lifting en institut ,si puissant qu\'il défie instantanément la chirurgie esthetique','','1'),(13,15,'Hydraderm','60 min Hydradermie la star des soins \r\nle soin sur mesure pour une peau éclatante de beauté\r\nle soin se décline avec des objectifs beauté et le type de peau \r\n*Hydratation\r\n*Pureté\r\n*Nutrition\r\n*Prepartion/ Réparation solaire','','1'),(14,15,'Hydradermie Jeunesse','60 min Hydradermie la star des soins \r\nle soin sur mesure pour une peau éclatante de beauté\r\nle soin se décline avec des objectifs beauté et le type de peau \r\n*Anti Rides','/84201c33_5a8a_470d_955c_b1fb9d78-14.jpg','1'),(15,15,'Hydradermie Lift','60 Min le visage parait plus jeune la peau est raffermie,les traits sont remontés.\r\nil agit profondément en remontant les traits par la stimulation des muscles le visage est visiblement lifté\r\nSoin effet lifting en institut ,si puissant qu\'il défie instantanément la chirurgie esthetique.\r\n*Age Logic Anti -Age','/84201c33_5a8a_470d_955c_b1fb9d78-15.jpg','1'),(16,16,'Eye logic','Soin du contour des yeux\r\ncible les rides et ridules (patte d\'oie ride du lion)\r\ncible les cernes et les poches du contour des yeux','/images-16.jpg','1'),(17,17,'Age Summum','50 Min pour enlever les années à votre visage\r\ndes actifs puissants,gommage dermabrasion ,vitamine C pure hautement concentrée,sérum age summum enrichi a l\'acide hyaluronique,puis le masque éclat au pro collagène\r\nDes la fin du soin,la peau parait visiblement plus jeunes et les signes de l\'age sont atténués','/soin_guinot_summum-17.jpg','1'),(18,5,'Visage et Corps','Sourcils ou Lèvre\r\nMenton\r\nJoues\r\nDemi Jambes\r\nJambes Entières\r\nAisselles\r\nMaillot Normal,Semi,Intégrale\r\nTrose /Dos\r\n\r\n\r\n','/technispa_minceur_guinot_beaut_-18.jpg','1'),(19,18,'Maquillage','Mariée ,\r\nJour,\r\nSoirée,\r\nRéveillon de nouvel année\r\n','/Fotolia_39356433_XS-.jpg','1'),(20,18,'Soin des Mains et Soin des Pieds','Mise en beauté des ongles avec ou sans pose de vernis','/SallyHayden_Guinot3-20.jpg','1');
/*!40000 ALTER TABLE `soin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `soin_categorie`
--

DROP TABLE IF EXISTS `soin_categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `soin_categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `sous_titre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `soin_categorie`
--

LOCK TABLES `soin_categorie` WRITE;
/*!40000 ALTER TABLE `soin_categorie` DISABLE KEYS */;
INSERT INTO `soin_categorie` VALUES (1,'Beauté neuve','Les secrets du soin'),(4,'Liftosome','Les secrets du soin'),(5,'Epilation','Plus nette, plus longtemps'),(6,'Soin Minceur ',' Corps Amincissant'),(7,'Douceur et détente','Massage du  corps'),(9,'Eye logic','soin contour des yeux'),(10,'Age Summum','50 min pour gommer les signes de l\'age'),(15,'Soin Visage',''),(16,'Traintement des yeux',''),(17,'Traitement des signes de l\' age','Age Summum'),(18,'Mise en Beaute','');
/*!40000 ALTER TABLE `soin_categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarif`
--

DROP TABLE IF EXISTS `tarif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tarif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categorie` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `texte` text NOT NULL,
  `prix` float NOT NULL,
  `image` varchar(50) NOT NULL,
  `online` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarif`
--

LOCK TABLES `tarif` WRITE;
/*!40000 ALTER TABLE `tarif` DISABLE KEYS */;
INSERT INTO `tarif` VALUES (4,2,'fini les poils','Possibilite epilaction sur zones\r\nFORFAIT 5 SEANCES\r\n*Maillot\r\n*Aisselles\r\n*Jambes\r\n*Torse/dos\r\n*Levre/Menton',250,'/369x200-4.jpg','1'),(5,9,'Age Summum','50 Min pour enlever les années à votre visage\r\ndes actifs puissants,gommage dermabrasion ,vitamine C pure hautement concentrée,sérum age summum enrichi a l\'acide hyaluronique,puis le masque éclat au pro collagène\r\nDes la fin du soin,la peau parait visiblement plus jeunes et les signes de l\'age sont atténués',93,'/soin_guinot_summum-5.jpg','1'),(7,4,'Lifting Immediat','60 Min le visage parait plus jeune la peau est raffermie,les traits sont remontés.\r\nil agit profondément en remontant les traits par la stimulation des muscles le visage est visiblement lifté\r\nSoin effet lifting en institut ,si puissant qu\'il défie instantanément la chirurgie esthetique',91,'','1'),(8,7,'Soin Pro-collagène ','50 Min le soin Liftosome est un soin dédié 100% à la fermeté et la jeunesse de la peau ;aide votre peau à retrouver toutes son élasticité.',79,'/SOIN_GUINOT-8.jpg','1'),(9,5,'Douceur Relaxant (californien ,sportifs,balinais)','Succombez à une merveilleuse sensation de bien être et de détente\r\nSoin manuel délassant détoxifie la peau et vous procure un instant de détente et de plénitude absolue.',78,'/soin_corps_guinot-9.jpg','1'),(10,1,'Minceur','30 min le soin traite toutes les surfaces du corps et permet de réduire la cellulite partout ou elle se trouve en instant sur les zones critiques telles que le ventre,les hanches et les cuisses \r\nréduit visiblement l\'aspect capitonné de la peau et agit au coeur des cellules.\r\nVotre silhouette retrouve ses formes',30,'/images_3_-10.jpg','1'),(11,4,'Hydraderm','60 min Hydradermie la star des soins \r\nle soin sur mesure pour une peau éclatante de beauté\r\nle soin se décline avec des objectifs beauté et le type de peau \r\n*Hydratation\r\n*Pureté\r\n*Nutrition\r\n*Prepartion/ Réparation solaire',65,'','1'),(12,4,'Hydradermie Jeunesse','60 min Hydradermie la star des soins \r\nle soin sur mesure pour une peau éclatante de beauté\r\nle soin se décline avec des objectifs beauté et le type de peau \r\n*Anti Rides\r\n',79,'','1'),(13,9,'Eye logic','Soin du contour des yeux\r\ncible les rides etridules (patte d\'oie, ride du lion)\r\ncible les cernes et les poches du contour des yeux',56,'/images-13.jpg','1');
/*!40000 ALTER TABLE `tarif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarif_categorie`
--

DROP TABLE IF EXISTS `tarif_categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tarif_categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarif_categorie`
--

LOCK TABLES `tarif_categorie` WRITE;
/*!40000 ALTER TABLE `tarif_categorie` DISABLE KEYS */;
INSERT INTO `tarif_categorie` VALUES (1,'Corps'),(2,'Epilaction'),(4,'Soin Visage'),(5,'Soin Detente'),(6,'Soin Minceur '),(7,'Liftosome'),(8,'Hydradermie Lift'),(9,'Soin traitant les signes de l\'age');
/*!40000 ALTER TABLE `tarif_categorie` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-13 15:54:27
