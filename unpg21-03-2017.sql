# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Hôte: localhost (MySQL 5.5.42)
# Base de données: unpg
# Temps de génération: 2017-03-21 09:47:05 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Affichage de la table categorie
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categorie`;

CREATE TABLE `categorie` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) DEFAULT '0',
  `titre` text,
  `ordre` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `categorie` WRITE;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;

INSERT INTO `categorie` (`id`, `id_parent`, `titre`, `ordre`)
VALUES
	(1,0,'CA-Bureau-CP',0),
	(2,0,'Commissions',1),
	(3,0,'GT',2),
	(4,1,'Conseil d’administration',0),
	(5,1,'Bureau',1),
	(6,1,'Comité permanent',2),
	(8,3,'GT Communication',0),
	(10,2,'Commission Financière',0),
	(11,2,'Commission Granulats marins',0),
	(12,2,'Commission Roches massives',0),
	(13,2,'Commission Roches meubles',0),
	(14,2,'Commission Environnement',0),
	(15,2,'Commission Technique',0),
	(16,2,'Commission Transport & Logistique',0),
	(17,2,'Commission Santé & Sécurité',0),
	(18,2,'Commission Législation & Réglementation',0),
	(19,3,'GT Biodiversité',0),
	(20,3,'GT Process',0),
	(21,3,'GT NRQC',0),
	(22,3,'GT URGERA',0),
	(23,0,'TEST BAT',0);

/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table contacts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contacts`;

CREATE TABLE `contacts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_ent` int(11) DEFAULT NULL,
  `civ` int(11) DEFAULT NULL,
  `nom` text,
  `prenom` text,
  `fonction` text,
  `tel` text,
  `fax` text,
  `email` text,
  `mobile` text,
  `num_voie` text,
  `nom_voie` text,
  `lieu_dit` text,
  `bp` text,
  `cp` text,
  `ville` text,
  `cedex` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;

INSERT INTO `contacts` (`id`, `id_ent`, `civ`, `nom`, `prenom`, `fonction`, `tel`, `fax`, `email`, `mobile`, `num_voie`, `nom_voie`, `lieu_dit`, `bp`, `cp`, `ville`, `cedex`)
VALUES
	(2,5,1,'Debruyne','Pierre','Dev','01 opoMLKML','MLK','MLK',NULL,'MLKMLK','MLK','MLK','MLKML','KMLK','MLKMLK','MLKLMK'),
	(527,NULL,2,'ALLIONE','Guy',NULL,'04 91 17 08 17','04 91 26 03 40','guy.allione@colas-mm.com','06 59 67 42 91',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(528,0,2,'ANDRE','Michel','Président','01 49 79 44 14','01 49 79 47 32','michel.andre@cemex.com',NULL,'','','','','','',''),
	(529,NULL,2,'AUBIN','Patrick','Directeur','02 41 76 18 86','02 41 76 19 35','paubin.scs@groupe-pigeon.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(530,NULL,1,'AUBRIEUX GONTERO','Marie-Thérèse','Présidente','04 42 81 69 34','04 42 07 17 44','mt.aubrieux.gontero@carrieres-gontero.com','06 23 34 01 17',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(531,NULL,2,'AUDEMARD','Philippe',NULL,'04 93 29 11 29','04 93 29 11 39','pha@audemard.com','06 85 11 01 60',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(532,NULL,2,'AUDOIN','Vincent',NULL,'05 45 97 05 11','05 45 97 35 30','sa-audoin@wanadoo.fr','06 09 74 01 34',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(533,NULL,2,'BEAULIEU','Pierre-Yves','Directeur technique','04 42 73 49 50',NULL,'pybeaulieu@wanadoo.fr','06 60 30 00 92',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(534,NULL,2,'BERANGER','Christian','Directeur Développement Durable','01 49 79 44 91','01 49 79 47 32','christian.beranger@cemex.com','06 09 80 76 60',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(535,NULL,2,'BERBEY','Hugues',NULL,'05 55 49 90 10','05 55 49 90 09','hugues.berbey@eurovia.com','06 76 58 55 80',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(536,NULL,2,'BERGOUIGNON','Jean','Directeur Général des activités granulats','01 49 79 44 49','01 49 79 47 32','jean.bergouignan@cemex.com','06 17 48 39 05',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(537,NULL,2,'BERTHE','Sébastien','Directeur région ouest','02 31 15 36 00','02 31 15 36 09','sebastien.berthe@eiffage.com','06 07 94 21 47',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(538,NULL,2,'BLANC','Marc','Directeur régional','03 83 15 26 02','03 83 57 67 04','mblanc@gsm-granulats.fr','06 07 46 47 79',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(539,NULL,2,'BODY','Serge','Directeur','05 49 67 54 33','05 49 67 54 08','serge.body@carrieresroy.com','06 61 00 27 98',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(540,NULL,2,'BOISSELON','Alain','Directeur Général adjoint ','04 74 27 59 89','04 74 27 59 90','a.boisselon@vicat.fr','06 80 16 01 66',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(541,NULL,1,'BONIN','Catherine','Directrice régionale','02 38 56 80 00','02 38 56 80 31','catherine.bonin@cemex.com','06 23 05 87 76',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(542,NULL,2,'BRIDIER','Thierry',NULL,'02 31 78 71 18','02 31 72 54 42','thierry.bridier@eurovia.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(543,NULL,2,'CANCEDDA','Marco','Directeur de secteur','01 58 00 62 55',NULL,'marco.cancedda@lafargeholcim.com','06 72 86 65 21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(544,NULL,2,'CARAYON','Arnaud',NULL,'05 63 98 66 66','05 63 98 99 99','arnaud.carayon@carayon.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(545,NULL,2,'CARENCO','Eric','Directeur du développement','04 77 54 48 09','04 77 54 59 31','eric.carenco@carrieresdelaloire.com','06 08 85 72 70',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(546,NULL,2,'CHABAUD','Jean-François',NULL,'04 42 67 09 30','04 42 67 09 31','jean-francois.chabaud@eurovia.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(547,NULL,2,'CHAIGNON','Jean-Paul','Directeur Général adjoint ','01 41 37 99 33',NULL,'jean-paul.chaignon@lafargeholcim.com','06 07 41 60 56',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(548,NULL,2,'CHAMBON','Jean-Pierre',NULL,'04 37 65 55 30',NULL,'jeanpierre.chambon@colas-ra.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(549,NULL,2,'CHARBONNEAU','Stéphane','Responsable secteur',NULL,NULL,'stephane.charbonneau@vicat.fr','06 80 34 89 86',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(550,NULL,1,'CHARLE','Anne-Marie','Président Directeur Général','01 60 58 54 90','01 60 58 54 94','am.charle@a2c-materiaux.com','06 07 28 92 09',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(551,NULL,2,'CHARPENTIER','Fabrice',NULL,'05 61 37 36 36','05 61 09 51 37','fabrice.charpentier@cemex.com','06 22 58 79 35',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(552,NULL,2,'CHARRIE THOLLOT','Jean-Jacques',NULL,'04 78 03 64 01','04 78 03 64 19','jean-jacques.charriethollot@eiffage.com','06 09 59 86 07',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(553,NULL,2,'CHÂTEAU','Christian',NULL,'04 70 44 34 76','04 70 44 46 72','christian.chateau@wanadoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(554,NULL,2,'CHOUVET','Eric','Président Directeur Général','03 44 07 70 29','03 44 07 78 86','eric.chouvet@wanadoo.fr','06 86 16 30 17',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(555,NULL,2,'COLIN','Geoffroy','Directeur','02 33 67 88 05','02 33 35 28 92','geoffroy.colin@carrieresdelouest.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(556,NULL,2,'COLSON','Arnaud','Directeur Développement Durable et Environnement','01 58 00 64 89',NULL,'arnaud.colson@lafargeholcim.com','06 07 80 89 57',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(557,NULL,2,'COURANT','Joseph',NULL,'02 41 64 38 51',NULL,'courant.joseph@orange.fr','06 09 39 13 61',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(558,NULL,2,'DAUNE','Philippe',NULL,'03 83 17 82 00','03 83 39 88 30','philippe.daune@colas-est.com','06 60 30 15 82',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(559,NULL,1,'de BONNECHOSE','Bénédicte','Directeur général granulats France','01 58 00 64 14',NULL,'benedicte.de.bonnechose@lafargeholcim.com','06 20 01 20 05',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(560,NULL,2,'de PAUL','Camille','Responsable foncier & environnement','02 48 70 07 79','02 48 70 01 13','cdepaul@gsm-granulats.fr','06 70 94 94 21',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(561,NULL,2,'DELAFOND','Laurent',NULL,'03 80 54 35 10',NULL,'laurent.delafond@eqiom.com','06 33 53 97 09',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(562,NULL,2,'DELANNE','Alain',NULL,'05 55 48 33 04','05 55 48 34 35','a.delanne@carrieresdefeytiat.com','06 82 74 14 14',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(563,NULL,2,'DELORME','Alain',NULL,'02 32 14 42 00','02 32 14 42 19','alain.delorme@eurovia.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(564,NULL,2,'DELSINNE','Nicolas',NULL,'02 40 41 73 03',NULL,'nicolas.delsinne@cemex.com','06 25 19 57 50',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(565,NULL,2,'DESVIGNES','Philippe',NULL,NULL,NULL,'philippe.desvignes@cemex.com','06 23 07 43 75',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(566,NULL,2,'DETREZ','Pascal',NULL,NULL,NULL,'pascal.detrez@eiffage.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(567,NULL,2,'DIDIER','Frédéric','Directeur région Est','03 88 10 33 20','03 88 10 33 29','frederic.didier@eqiom.com','06 08 24 71 31',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(568,NULL,2,'DUCASSE','Michel',NULL,'01 47 16 45 41','01 47 49 59 53','michel.ducasse@eurovia.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(569,NULL,1,'DUMONT','Annick',NULL,'01 49 79 44 44',NULL,'annick.dumont@cemex.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(570,NULL,2,'DURAND GUYOMARD','Stéphane','Directeur foncier et environnement','02 40 13 60 15',NULL,'stephane.durandguyomard@colas-co.com','06 67 96 61 72',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(571,NULL,2,'DURON','Dominique',NULL,'04 73 97 42 04','04 73 97 49 97','dom.duron@orange.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(572,NULL,2,'FARDOIT','Bruno',NULL,'05 49 96 66 90','05 49 96 07 56','bruno.fardoit@eurovia.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(573,NULL,2,'FAROCHE','Emmanuel',NULL,'03 85 23 94 00',NULL,'emmanuel.faroche@trmc.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(574,NULL,2,'FAURE','Emmanuel',NULL,'04 67 83 12 54','04 67 83 67 82','efaure@carriereslrm.fr','06 07 27 27 21 18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(575,NULL,2,'FINELLO','Christian','Directeur','03 27 66 84 84',NULL,'cfinello@gagneraud.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(576,NULL,2,'FLAMARY','Henri',NULL,'05 55 28 00 16','05 55 28 81 62','henri.flamary@flamary.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(577,NULL,2,'GABENS','Olivier','Chef du département foncier & environnement','01 60 74 99 79','01 60 74 99 88','ogabens@gsm-granulats.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(578,NULL,2,'GARCIA','Sylvain','Directeur département matériaux','05 61 15 93 00','05 61 78 22 54','s.garcia@razel-bec.fayat.com','06 74 00 80 15',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(579,NULL,2,'GAZZARIN','Patrice','Directeur régional','05 56 15 10 20','05 56 15 15 64','pgazzarin@gsm-granulats.fr','06 09 82 01 70',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(580,NULL,2,'GERMAIN','Bernard',NULL,'04 37 65 20 10','04 37 55 57 01','bernard.germain@colas-ra.com','06 63 99 19 58',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(581,NULL,2,'GIROU','Laurent','Directeur Général délégué pôle route région','01 71 59 17 58',NULL,'laurent.girou@eiffage.com','06 11 62 58 22',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(582,NULL,2,'GORIOUX','Philippe',NULL,NULL,NULL,'philippe.gorioux@fr.lafarge.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(583,NULL,2,'GROUSSAUD','Frédéric','Directeur Général','01 30 98 72 00','01 30 98 72 87','fgroussaud@gsm-granulats.fr','06 12 30 29 73',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(584,NULL,2,'GUISE','Olivier',NULL,'04 42 25 98 67',NULL,'olivier.guise@lafargeholcim.com','07 60 21 67 23',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(585,NULL,2,'HELMBACHER','Stephan',NULL,'03 88 08 79 79','03 88 08 79 70','stephan.helmbacher@wanadoo.fr','06 13 45 38 52',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(586,NULL,2,'HENRY','David','Directeur Général','02 99 98 82 18','02 99 98 92 75','david.henry@henryfreres.fr','06 11 30 20 26',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(587,NULL,2,'HIRSCH','Michel',NULL,'03 22 67 19 68','03 22 67 19 51','mhirsch@gsm-granulats.fr','06 75 22 54 37',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(588,NULL,2,'HOESTLANDT','Dominique',NULL,NULL,NULL,'dominique.hoestlandt@sigmaconseil.fr','06 07 98 55 86',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(589,NULL,2,'HUCHER','Dominique',NULL,'02 35 17 60 00',NULL,'dominique.hucher@lhotellier.fr','06 03 79 32 79',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(590,NULL,2,'HUCHON','Philippe',NULL,'03 83 15 26 25',NULL,'phuchon@gsm-granulats.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(591,NULL,2,'HUVELIN','Bruno','Directeur régional granulats Val de Seine','01 64 11 88 17','01 64 11 88 48','bruno.huvelin@cemex.com','06 22 74 83 13',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(592,NULL,1,'HUYGENS','Sophie',NULL,'03 21 99 19 42','03 21 99 67 10','shuygens@groupecb.com','06 77 45 18 26',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(593,NULL,2,'IRIBARREN','Jean-François',NULL,'05 49 59 53 31','05 49 59 57 78','francois@iribarren.fr','06 80 90 00 12',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(594,NULL,2,'JOZON','Christophe','Directeur régional des industries','01 47 16 49 77','01 47 49 46 44','christophe.jozon@eurovia.com','06 18 06 53 04',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(595,NULL,2,'KERYELL','Laurent',NULL,'02 98 90 24 89','02 98 53 23 10','laurent.keryell@colas-co.com','06 61 03 10 51',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(596,NULL,2,'KOSZUL','Etienne','Responsable bassin Alsace Belfort','03 88 96 85 21','03 88 96 91 56','ekoszul@gsm-granulats.fr','06 79 49 30 00',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(597,NULL,2,'LAPORTE','François',NULL,'01 41 06 12 01','01 41 06 12 02','francois.laporte@eqiom.com','06 70 20 73 72',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(598,NULL,2,'LAURENT','Jacques','Chef d\'agence Sacer Paris Nord Est','03 81 48 15 10','03 81 48 15 11','jacques.laurent@colas-est.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(599,NULL,1,'LEBON','Raphaëlle',NULL,'05 49 86 41 27','05 49 86 60 81','raphaelle.lebon@fr.lafarge.com','06 23 79 23 47',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(600,NULL,2,'LECOMTE','Patrick',NULL,'02 40 92 96 16','02 40 92 12 58','plecomte@sablimaris.com','06 80 73 20 27',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(601,NULL,2,'LEFEBVRE','Claude',NULL,'02 33 67 68 00',NULL,'claude.lefebvre@carrieresdelouest.fr','06 79 59 17 61',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(602,NULL,2,'LEPROVAUX','Christophe',NULL,'05 55 49 90 10','05 55 49 90 09','christophe.leprovaux@eurovia.com','06 77 05 27 57',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(603,NULL,2,'LEROY','François',NULL,'01 30 98 72 16',NULL,'fleroy@gsm-granulats.fr','06 74 90 95 56',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(604,NULL,2,'LIGLET','Eric',NULL,'02 47 32 26 03','02 47 44 87 41','eric.liglet@ligerienne-granulats.fr','06 11 04 77 53',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(605,NULL,2,'LOMBERTY','Michel',NULL,'01 43 97 17 62',NULL,'lomberty@stonelog.fr','06 75 72 20 41',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(606,NULL,2,'MANO','Michel',NULL,'05 61 72 80 20','05 61 72 80 29','mmano@sogefima.fr','06 03 85 67 39',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(607,NULL,2,'MEILLAND-REY','Thierry',NULL,'04 74 27 59 00',NULL,'t.meillandrey@vicat.fr','06 08 65 67 65',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(608,NULL,2,'MENEAU','Patrick',NULL,'05 46 25 02 38','05 46 25 01 81','meneau.patrick@wanadoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(609,NULL,2,'MERCIER','François-Régis','Directeur d\'exploitation','01 56 71 83 21','01 56 71 83 29','francois-regis.mercier@eurovia.com','06 09 02 62 02',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(610,NULL,2,'MERCIER','Jean-Yves','Directeur','02 23 27 01 27','02 23 27 09 09','jean-yves.mercier@lafarge.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(611,NULL,2,'MINIER','Francis',NULL,'02 54 73 40 41','02 54 73 11 12','francis@minier.fr','06 74 36 94 45',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(612,NULL,2,'MOREIRA','Abilio','Chef d\'Agence','03 88 98 79 79','03 88 98 79 70','abilio.moreira@colas-est.com','06 61 06 79 79',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(613,NULL,2,'MOREL','Arnaud','Directeur région Méditerranée','04 42 10 11 12',NULL,'arnaud.morel@eiffage.com','06 26 97 71 24',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(614,NULL,2,'MORIAME','Richard',NULL,'04 76 27 84 00','04 76 27 84 11','richard.moriame@lhoist.com','06 07 64 47 59',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(615,NULL,2,'MORONI','Rémy',NULL,'03 26 87 02 66','03 26 05 07 61','rmoroni@wanadoo.fr','06 73 61 49 64',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(616,NULL,2,'NEYER','Marc','Directeur','03 89 49 90 63','03 89 49 43 44','mneyer@waibel.fr','06 09 84 09 48',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(617,NULL,2,'OESCH','Jean-Jacques','Directeur Général','03 88 35 36 88','03 88 24 10 89','sabliereoesch@wanadoo.fr','06 71 01 63 18',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(618,NULL,2,'PASERI','Jean-Pierre','Directeur Général délégué','01 47 16 49 77','01 47 49 46 44','jean-pierre.paseri@eurovia.com','06 09 62 48 49',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(619,NULL,2,'PAWLICKI','Patrick',NULL,'03 20 22 79 71','03 20 22 79 98','patrick.pawlicki@eurovia.com','06 03 78 77 50',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(620,NULL,2,'PECOUT','Pierre',NULL,'05 58 71 59 60','05 58 71 69 03','pierre.pecout@colas-so.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(621,NULL,2,'PETIGNY','Daniel','Directeur matériaux France','01 47 61 76 59','01 47 61 74 86','daniel.petigny@colas.com','06 61 66 36 37',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(622,NULL,2,'PIGEON','Laurent',NULL,'02 43 53 11 45','02 43 98 30 10','laurent.pigeon@wanadoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(623,NULL,1,'PIGNET','Gaëlle','Directrice Générale','02 31 46 17 30','02 31 94 41 54','gpignet@gfcie.fr','06 71 18 17 57',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(624,NULL,2,'PIKETTY','Christian',NULL,NULL,NULL,'christian.piketty@gmail.com','06 80 06 59 58',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(625,NULL,2,'POULAIN','Olivier',NULL,NULL,NULL,'opoulain@groupecb.com','06 85 23 02 42',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(626,NULL,2,'POULAIN','Gilles','Président','03 21 99 67 00','03 21 99 67 10','gpoulain@groupecb.com','06 07 95 27 7',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(627,NULL,2,'POUXVIEL','Jean-Claude',NULL,'05 57 92 47 00','05 57 92 47 01','jean-claude.pouxviel@eurovia.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(628,NULL,2,'PRIEUR','Eric',NULL,'01 58 00 64 14',NULL,'eric.prieur@lafargeholcim.com','06 21 40 10 03',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(629,NULL,2,'RABRET','Fabrice',NULL,'05 61 60 32 78','05 61 60 37 71','fabrice.rabret@colas-so.com','06 60 25 12 72',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(630,NULL,2,'REITER','Olivier',NULL,'05 45 89 01 49','05 45 89 03 39','olivier.reiter@colas-so.com','06 60 30 86 76',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(631,NULL,2,'RINGOT','Pascal','Directeur','04 67 78 15 11','04 67 78 56 73','pascal.ringot@lafargeholcim.com','06 12 07 36 65',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(632,NULL,2,'RIOU','Didier',NULL,NULL,NULL,'didier.riou@lafargeholcim.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(633,NULL,2,'RIVAIN','Yves',NULL,'02 43 06 70 00','02 43 06 48 77','yves.rivain@star-tp.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(634,NULL,2,'ROCAUD','Patrick',NULL,'03 26 21 80 68','03 26 21 80 69','patrick.rocaud@colas-est.com','06 60 35 42 37',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(635,NULL,2,'ROUX','Sébastien','Responsable environnement','04 76 05 02 14','04 76 65 62 73','sebastien.roux2@eiffage.com','06 74 45 82 10',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(636,NULL,2,'RUAS','Christophe',NULL,'04 66 61 77 93','04 66 61 03 22','cruas.src@orange.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(637,NULL,2,'SALMON LEGAGNEUR','Xavier',NULL,NULL,NULL,'xsalmonlegagneur@free.fr','06 63 99 86 83',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(638,NULL,2,'SAUBOI','Bernard',NULL,'05 53 77 55 90','05 53 77 55 91','gsl.granulats@wanadoo.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(639,NULL,2,'SCHMITT','Dominique',NULL,'04 37 65 20 10','04 37 27 09 71','dominique.schmitt@colas-ra.com','06 65 51 10 08',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(640,NULL,2,'SICAMOIS','Emmanuel','Chef de centre Carrières','04 37 25 38 10','04 78 21 24 19','emmanuel.sicamois@colas-ra.com','06 99 81 37 97',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(641,NULL,1,'SIORAT','Corinne',NULL,NULL,NULL,'corinne.siorat@orange.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(642,NULL,2,'SOULAS','Bernard',NULL,'04 42 22 30 42','04 42 22 17 59','b-soulas@ejl.fr','06 14 67 65 68',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(643,NULL,2,'SOULIE','Frédéric',NULL,NULL,NULL,'soulie@someca.eu',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(644,NULL,2,'TANNEUR','Pascal',NULL,'03 83 44 07 33','03 83 44 06 98','p.tanneur@vicat.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(645,NULL,2,'TARTAGLIA','Vincent',NULL,'03 89 69 17 95','03 89 69 22 43','vincent.tartaglia@eiffage.com','06 10 52 11 69',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(646,NULL,2,'TENNIERE','Emmanuel',NULL,'02 99 14 04 14','02 99 14 04 20','emmanuel.tenniere@eurovia.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(647,NULL,2,'THOLLARD','Jean-Pierre',NULL,'03 25 79 90 19','03 25 78 07 37','jean-pierre.thollard@eurovia.com','06 80 42 89 67',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(648,NULL,2,'TOFFOLINI','Philippe',NULL,'03 83 17 82 00','03 83 17 82 93','philippe.toffolini@colas-est.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(649,NULL,1,'TOURRE','Anne','Président Directeur Général','01 42 89 51 89','01 42 25 20 94','a.tourre@basaltes.com','06 07 30 07 38',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(650,NULL,2,'TOUX','Lucien',NULL,'01 60 74 99 75','01 60 74 99 98','ltoux@gsm-granulats.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(651,NULL,2,'TOVAR','Angel','Directeur du développement industriel des carrières','01 49 44 98 66',NULL,'angel.tovar@eiffage.com','06 35 32 62 20',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(652,NULL,2,'TUGEND','Alan','Coordinateur santé & sécurité','03 90 29 55 33','03 88 10 33 29','alan.tugend@eqiom.com','06 79 73 96 42',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(653,NULL,2,'VERACHTEN','Roberto',NULL,'02 40 92 96 10','02 40 92 12 58','rverachten@gsm-granulats.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(654,NULL,2,'VERHAGUE','Christophe',NULL,'02 51 70 67 25','02 51 70 67 47','christophe.verhague@lafargeholcim.com','06 17 31 60 65',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(655,NULL,2,'VERNIER','Emmanuel','Directeur commercial','04 76 50 54 90',NULL,'emmanuel.vernier@rhonealpesagregats.fr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(656,NULL,2,'VUILLIER','Nicolas','Directeur Développement Durable','01 34 77 76 06','01 30 98 72 87','n.vuillier@itcgr.net','06 77 79 76 80',NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	(657,0,2,'HIBLOT ','Mathieu ','','','','mathieu.hiblot@unicem.fr ',NULL,'','','','','','',''),
	(658,0,2,'Debruyne','Pierre','','','','pierre0@me.com',NULL,'','','','','','',''),
	(659,0,2,'DEB','Pierre','','','','pierre.atman@gmail.com',NULL,'','','','','','',''),
	(660,0,2,'Tougard','Samuel','','','','samuel.tougard@gmail.com',NULL,'','','','','','','');

/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table contacts_cat
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contacts_cat`;

CREATE TABLE `contacts_cat` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_cat` int(11) DEFAULT NULL,
  `id_contact` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `contacts_cat` WRITE;
/*!40000 ALTER TABLE `contacts_cat` DISABLE KEYS */;

INSERT INTO `contacts_cat` (`id`, `id_cat`, `id_contact`)
VALUES
	(1,1,527),
	(2,11,527),
	(5,1,529),
	(6,11,529),
	(7,1,530),
	(8,11,530),
	(9,1,531),
	(10,11,531),
	(11,1,532),
	(12,11,532),
	(13,1,533),
	(14,11,533),
	(15,1,534),
	(16,11,534),
	(17,1,535),
	(18,11,535),
	(19,1,536),
	(20,11,536),
	(21,1,537),
	(22,11,537),
	(23,1,538),
	(24,11,538),
	(25,1,539),
	(26,11,539),
	(27,1,540),
	(28,11,540),
	(29,1,541),
	(30,11,541),
	(31,1,542),
	(32,11,542),
	(33,1,543),
	(34,11,543),
	(35,1,544),
	(36,11,544),
	(37,1,545),
	(38,11,545),
	(39,1,546),
	(40,11,546),
	(41,1,547),
	(42,11,547),
	(43,1,548),
	(44,11,548),
	(45,1,549),
	(46,11,549),
	(47,1,550),
	(48,11,550),
	(49,1,551),
	(50,11,551),
	(51,1,552),
	(52,11,552),
	(53,1,553),
	(54,11,553),
	(55,1,554),
	(56,11,554),
	(57,1,555),
	(58,11,555),
	(59,1,556),
	(60,11,556),
	(61,1,557),
	(62,11,557),
	(63,1,558),
	(64,11,558),
	(65,1,559),
	(66,11,559),
	(67,1,560),
	(68,11,560),
	(69,1,561),
	(70,11,561),
	(71,1,562),
	(72,11,562),
	(73,1,563),
	(74,11,563),
	(75,1,564),
	(76,11,564),
	(77,1,565),
	(78,11,565),
	(79,1,566),
	(80,11,566),
	(81,1,567),
	(82,11,567),
	(83,1,568),
	(84,11,568),
	(85,1,569),
	(86,11,569),
	(87,1,570),
	(88,11,570),
	(89,1,571),
	(90,11,571),
	(91,1,572),
	(92,11,572),
	(93,1,573),
	(94,11,573),
	(95,1,574),
	(96,11,574),
	(97,1,575),
	(98,11,575),
	(99,1,576),
	(100,11,576),
	(101,1,577),
	(102,11,577),
	(103,1,578),
	(104,11,578),
	(105,1,579),
	(106,11,579),
	(107,1,580),
	(108,11,580),
	(109,1,581),
	(110,11,581),
	(111,1,582),
	(112,11,582),
	(113,1,583),
	(114,11,583),
	(115,1,584),
	(116,11,584),
	(117,1,585),
	(118,11,585),
	(119,1,586),
	(120,11,586),
	(121,1,587),
	(122,11,587),
	(123,1,588),
	(124,11,588),
	(125,1,589),
	(126,11,589),
	(127,1,590),
	(128,11,590),
	(129,1,591),
	(130,11,591),
	(131,1,592),
	(132,11,592),
	(133,1,593),
	(134,11,593),
	(135,1,594),
	(136,11,594),
	(137,1,595),
	(138,11,595),
	(139,1,596),
	(140,11,596),
	(141,1,597),
	(142,11,597),
	(143,1,598),
	(144,11,598),
	(145,1,599),
	(146,11,599),
	(147,1,600),
	(148,11,600),
	(149,1,601),
	(150,11,601),
	(151,1,602),
	(152,11,602),
	(153,1,603),
	(154,11,603),
	(155,1,604),
	(156,11,604),
	(157,1,605),
	(158,11,605),
	(159,1,606),
	(160,11,606),
	(161,1,607),
	(162,11,607),
	(163,1,608),
	(164,11,608),
	(165,1,609),
	(166,11,609),
	(167,1,610),
	(168,11,610),
	(169,1,611),
	(170,11,611),
	(171,1,612),
	(172,11,612),
	(173,1,613),
	(174,11,613),
	(175,1,614),
	(176,11,614),
	(177,1,615),
	(178,11,615),
	(179,1,616),
	(180,11,616),
	(181,1,617),
	(182,11,617),
	(183,1,618),
	(184,11,618),
	(185,1,619),
	(186,11,619),
	(187,1,620),
	(188,11,620),
	(189,1,621),
	(190,11,621),
	(191,1,622),
	(192,11,622),
	(193,1,623),
	(194,11,623),
	(195,1,624),
	(196,11,624),
	(197,1,625),
	(198,11,625),
	(199,1,626),
	(200,11,626),
	(201,1,627),
	(202,11,627),
	(203,1,628),
	(204,11,628),
	(205,1,629),
	(206,11,629),
	(207,1,630),
	(208,11,630),
	(209,1,631),
	(210,11,631),
	(211,1,632),
	(212,11,632),
	(213,1,633),
	(214,11,633),
	(215,1,634),
	(216,11,634),
	(217,1,635),
	(218,11,635),
	(219,1,636),
	(220,11,636),
	(221,1,637),
	(222,11,637),
	(223,1,638),
	(224,11,638),
	(225,1,639),
	(226,11,639),
	(227,1,640),
	(228,11,640),
	(229,1,641),
	(230,11,641),
	(231,1,642),
	(232,11,642),
	(233,1,643),
	(234,11,643),
	(235,1,644),
	(236,11,644),
	(237,1,645),
	(238,11,645),
	(239,1,646),
	(240,11,646),
	(241,1,647),
	(242,11,647),
	(243,1,648),
	(244,11,648),
	(245,1,649),
	(246,11,649),
	(247,1,650),
	(248,11,650),
	(249,1,651),
	(250,11,651),
	(251,1,652),
	(252,11,652),
	(253,1,653),
	(254,11,653),
	(255,1,654),
	(256,11,654),
	(257,1,655),
	(258,11,655),
	(259,1,656),
	(260,11,656),
	(267,5,528),
	(268,1,528),
	(269,6,528),
	(270,11,528),
	(272,23,659),
	(273,23,658),
	(274,23,660),
	(275,5,657),
	(276,1,657),
	(277,6,657),
	(278,14,657),
	(279,10,657),
	(280,11,657),
	(281,18,657),
	(282,12,657),
	(283,13,657),
	(284,17,657),
	(285,16,657),
	(286,2,657),
	(287,4,657),
	(288,19,657),
	(289,8,657);

/*!40000 ALTER TABLE `contacts_cat` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table entreprises
# ------------------------------------------------------------

DROP TABLE IF EXISTS `entreprises`;

CREATE TABLE `entreprises` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) DEFAULT '0',
  `raison_sociale` text,
  `siret` text,
  `tel` text,
  `fax` text,
  `email` text,
  `site_web` text,
  `num_voie` text,
  `nom_voie` text,
  `lieu_dit` text,
  `bp` text,
  `cp` text,
  `ville` text,
  `cedex` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `entreprises` WRITE;
/*!40000 ALTER TABLE `entreprises` DISABLE KEYS */;

INSERT INTO `entreprises` (`id`, `id_parent`, `raison_sociale`, `siret`, `tel`, `fax`, `email`, `site_web`, `num_voie`, `nom_voie`, `lieu_dit`, `bp`, `cp`, `ville`, `cedex`)
VALUES
	(1,0,'lmklmk','mlkmlk','lmklmk','mlkmlk','mlkmlkml','kmlklmk','mlklm','klmkmlk','mlkmlk','mlkmlk','mlkmlk','mlkmlkmlk','mlkmlk'),
	(2,1,'mkmk','mlkmlk','mlk','mlkml','kmlkmlk','mlkmlk','mlk','mlkmlk','mlklm','kml','kml','kmlk','mlkmlk'),
	(3,2,'sfsmdlfklm','mlkmlk','mlkmlkml','kmlkmlk','mlklmk','mlkmlk','mlkmlkml','kmlkmlk','mlkml','kmlkml','kmlkmk','mlkmlkm','lkmlk'),
	(5,3,'COX','12345798765','01 42 42 42','smdlfksmdlkf','mlkmlk','mklmk','','sdfsdùmfl','ùlmùl','lùmlùml','ùmlùml','ùlùml','mùl');

/*!40000 ALTER TABLE `entreprises` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table entreprises_cat
# ------------------------------------------------------------

DROP TABLE IF EXISTS `entreprises_cat`;

CREATE TABLE `entreprises_cat` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_ent` int(11) DEFAULT NULL,
  `id_cat` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `entreprises_cat` WRITE;
/*!40000 ALTER TABLE `entreprises_cat` DISABLE KEYS */;

INSERT INTO `entreprises_cat` (`id`, `id_ent`, `id_cat`)
VALUES
	(10,5,2),
	(11,5,4);

/*!40000 ALTER TABLE `entreprises_cat` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table liste
# ------------------------------------------------------------

DROP TABLE IF EXISTS `liste`;

CREATE TABLE `liste` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `titre` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `liste` WRITE;
/*!40000 ALTER TABLE `liste` DISABLE KEYS */;

INSERT INTO `liste` (`id`, `titre`)
VALUES
	(1,'sdfsdfsdf'),
	(2,'sdfsdfsdf'),
	(3,'sfsdf'),
	(5,'Tous'),
	(10,'modif 2'),
	(11,'TEST BAT');

/*!40000 ALTER TABLE `liste` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table liste_cat
# ------------------------------------------------------------

DROP TABLE IF EXISTS `liste_cat`;

CREATE TABLE `liste_cat` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_liste` int(11) DEFAULT NULL,
  `id_cat` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `liste_cat` WRITE;
/*!40000 ALTER TABLE `liste_cat` DISABLE KEYS */;

INSERT INTO `liste_cat` (`id`, `id_liste`, `id_cat`)
VALUES
	(4,5,1),
	(5,5,5),
	(6,5,6),
	(7,5,4),
	(8,5,2),
	(9,5,14),
	(10,5,10),
	(11,5,11),
	(12,5,18),
	(13,5,12),
	(14,5,13),
	(15,5,17),
	(16,5,15),
	(17,5,16),
	(18,5,3),
	(19,5,19),
	(20,5,8),
	(21,5,21),
	(22,5,20),
	(23,5,22),
	(52,10,1),
	(53,10,5),
	(54,10,6),
	(55,10,4),
	(56,10,14),
	(57,10,10),
	(58,10,3),
	(59,11,23);

/*!40000 ALTER TABLE `liste_cat` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `login` text,
  `password` text,
  `email` text,
  `nom` text,
  `prenom` text,
  `rang` smallint(11) DEFAULT NULL,
  `admin` int(11) DEFAULT NULL,
  `actif` smallint(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `login`, `password`, `email`, `nom`, `prenom`, `rang`, `admin`, `actif`)
VALUES
	(1,'pierre','$1$suUT6mCy$0MtEiKlgC1tjT4JdaQJQ4/','pierre@coxdigital.fr','Debruyne','Pierre',10,1,1),
	(2,'admin','$1$suUT6mCy$0MtEiKlgC1tjT4JdaQJQ4/',NULL,'Admin','Admin',10,1,1);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
