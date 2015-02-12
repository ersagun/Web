-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 21, 2014 at 12:23 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ersagun`
--
CREATE DATABASE IF NOT EXISTS `ersagun_fr` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ersagun_fr`;

-- --------------------------------------------------------

--
-- Table structure for table `billets`
--

CREATE TABLE IF NOT EXISTS `billets` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `titre` varchar(64) DEFAULT NULL,
  `body` text,
  `cat_id` int(11) DEFAULT '1',
  `date` datetime DEFAULT NULL,
  `auteur` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `billets`
--

INSERT INTO `billets` (`id`, `titre`, `body`, `cat_id`, `date`, `auteur`) VALUES
(1, 'La ligne verte', 'ce film est vraiment trop bien je conseil a tout le monde voir.', 1, '2014-01-16 00:10:44', 2),
(2, 'Noki 5000', 'ce telephone est vraiment g?nial....', 8, '2014-01-16 00:11:34', 2),
(3, 'Cornichons', 'je n''aime pas du tout les cornichons.', 5, '2014-01-16 00:12:25', 2),
(4, 'Coldplay', 'Coldplay viens a Nancy le 14 Novembre 2015.', 7, '2014-01-16 00:13:28', 2),
(5, 'Mozart ', 'Mozart est mort. Et j''ai pas d''inspiration pour faire des commentaire.. :D', 7, '2014-01-16 00:14:17', 2),
(6, 'Je veux me rencontrer avec quelqu''un', 'Mais je suis pas tres beau, tant pis c''est pas grave.', 12, '2014-01-16 00:21:12', 3),
(7, 'XXX president ', 'Ce president est tres moche, ', 15, '2014-01-16 00:21:48', 3),
(8, 'p?tanque', 'La France est le pays ou il y a plein de gens qui fait du p?tanque . :D', 4, '2014-01-16 00:22:48', 3),
(9, 'Socrates', 'La vie de socrates est represent? dans le th?atre de Paris.', 2, '2014-01-16 00:23:55', 3),
(10, 'Am?lie Poulain', 'Je ne l''aime pas . mais bon, elle s''en fout de toute facon:D', 1, '2014-01-16 00:24:31', 3),
(11, 'Fast and Furious 11', 'Alors demain je vais aller voir FF 11 avec ma copine .. Je m''ennui trop..', 3, '2014-01-16 00:25:24', 3),
(12, 'Go go go', 'Tim Burtooooooon <3', 1, '2014-01-16 00:29:13', 5),
(13, 'QUESTION !', 'est ce que quelqu''un sait comment faire pousser des carrotes', 11, '2014-01-16 00:30:00', 5),
(14, 'Poulet est un oeuf', 'Oeuf est un poulet aussi.', 14, '2014-01-16 00:30:33', 5),
(15, 'asus', 'tres bon marque', 10, '2014-01-16 01:00:29', 6),
(16, 'mac', 'y''a pas mieux que mac aussi', 10, '2014-01-16 01:00:45', 6),
(17, 'XRay', 'je ne sais plus quoi dire :p', 8, '2014-01-16 01:01:56', 6),
(18, 'M*** Le***P****', 'peut etre peut etre pas ... ^^', 15, '2014-01-16 01:05:01', 7),
(19, 'les fumeurs de cigarettes ', 'ils vont crever trop rapidement comme moi :o', 14, '2014-01-16 01:06:16', 7),
(20, '2200m', 'c''est difficile de courir 2 km', 4, '2014-01-16 01:06:47', 7),
(21, 'Children of bodom arrive bientot', 'COD concert!!! venez nombreux', 7, '2014-01-16 01:07:27', 7),
(22, 'Metallica', 'Maestro du rock !!! ', 7, '2014-01-16 01:08:05', 7),
(23, 'boing', 'les avions volents,', 9, '2014-01-16 01:16:17', 2);

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `titre` varchar(64) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id`, `titre`, `description`) VALUES
(1, 'Film', 'Les Films'),
(2, 'Theatre', 'Les theatres'),
(3, 'Cinema', 'Tout sur le Cin'),
(4, 'Sport', 'Tout sur le sport'),
(5, 'Cuisin ', 'Tout sur la cuisine'),
(6, 'Art', 'De l''art'),
(7, 'Musique', 'Les musiques'),
(8, 'Technologie', 'la Tech'),
(9, 'Science', 'Science'),
(10, 'Informatique', 'Info'),
(11, 'Agriculture', 'Tout sur l''agriculture'),
(12, 'Rencontre', 'toute les rencontres se passe ici'),
(13, 'Architectural', 'les architectures sont ici.'),
(14, 'Debat', 'les debats ce passe ici.'),
(15, 'Politique', 'La politique ici.');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `email`, `password`) VALUES
(1, 'mod', 'root', 'mod@root.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(2, 'Albert', 'Vincent', 'ab@ok.com', 'f47de373dc275d4aae9591071d845541606a178d'),
(3, 'verhoof', 'tom', 'vt@ok.com', '6f0179c78c19c896abf478785283768080523714'),
(4, 'inconnu', 'quiveutsquater', 'iq@ok.com', '4e40db30207e22502aeb59668e419c06d3685cf5'),
(5, 'alex', 'daus', 'ad@ok.com', '0aebf3a9339a0d976e082525062cb64cfc9ba651'),
(6, 'azerty', 'qwerty', 'azerty@ok.com', '103536ca769dac0e5306efca049963b9c7bfd99d'),
(7, 'dernier', 'samurai', 'dernier@ok.com', 'e0378b5e85cf38d9f6f45581708ef693095d03b6'),
(8, 'yalcintepe', 'ersagun', 'ersagunyalcintepe@gmail.com', 'e3d9d95962c452f35e4ce7166b8d584f7b43adf0');

-- --------------------------------------------------------

--
-- Table structure for table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `id_com` int(20) NOT NULL AUTO_INCREMENT,
  `auteur` varchar(40) NOT NULL,
  `text` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `id_billet` int(40) NOT NULL,
  PRIMARY KEY (`id_com`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `commentaire`
--

INSERT INTO `commentaire` (`id_com`, `auteur`, `text`, `date`, `id_billet`) VALUES
(1, 'alex', 'c boooo', '2014-01-16', 1),
(2, 'alex', 'ta fausse', '2014-01-16', 9),
(3, 'alex', 'cest bien', '2014-01-16', 11),
(4, 'alex', 'genial', '2014-01-16', 8),
(5, 'alex', 'ok', '2014-01-16', 2),
(6, 'alex', 'ne fait pas de politique cest pas bien.', '2014-01-16', 7),
(7, 'azerty', 'vaut mieux rien dire que dire de la **', '2014-01-16', 4),
(8, 'azerty', 'arret tes blaques', '2014-01-16', 14),
(9, 'azerty', 'c''est beau ce film', '2014-01-16', 12),
(10, 'dernier', 'Ca va bien ?', '2014-01-16', 1),
(11, 'dernier', 'je ne veux pas', '2014-01-16', 12),
(12, 'dernier', 'alex daus t''es nul', '2014-01-16', 13),
(13, 'Albert', 'qsdsfsdgfdg POLLUTION', '2014-01-16', 22),
(14, 'Albert', 'je mennuiiii', '2014-01-16', 15),
(15, 'Albert', ':000', '2014-01-16', 11),
(16, 'alex', 'cest beau', '2014-01-16', 2),
(17, 'alex', 'ok.', '2014-01-16', 17);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
