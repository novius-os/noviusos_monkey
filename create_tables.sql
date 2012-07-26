
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Structure of the table `nos_monkey`
--

CREATE TABLE IF NOT EXISTS `nos_monkey` (
  `monk_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `monk_lang` varchar(5) NOT NULL,
  `monk_lang_common_id` int(11) NOT NULL,
  `monk_lang_single_id` int(11) DEFAULT NULL,
  `monk_species_id` int(11) NOT NULL,
  `monk_name` varchar(255) NOT NULL DEFAULT '',
  `monk_summary` text,
  `monk_created_at` datetime NOT NULL,
  `monk_updated_at` datetime NOT NULL,
  `monk_publication_start` datetime DEFAULT NULL,
  `monk_publication_end` datetime DEFAULT NULL,
  `monk_published` tinyint(1) NOT NULL DEFAULT '1',
  `monk_virtual_name` varchar(255) NOT NULL,
  PRIMARY KEY (`monk_id`),
  KEY `blog_lang` (`monk_lang`,`monk_lang_common_id`,`monk_lang_single_id`),
  KEY `blog_virtual_name` (`monk_virtual_name`),
  KEY `monk_breed_id` (`monk_species_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure of the table `nos_monkey_species`
--

CREATE TABLE IF NOT EXISTS `nos_monkey_species` (
  `mksp_id` int(11) NOT NULL AUTO_INCREMENT,
  `mksp_lang` varchar(5) NOT NULL,
  `mksp_lang_common_id` int(11) NOT NULL,
  `mksp_lang_single_id` int(11) DEFAULT NULL,
  `mksp_title` varchar(255) NOT NULL DEFAULT '',
  `mksp_virtual_name` varchar(255) NOT NULL,
  `mksp_created_at` datetime NOT NULL,
  `mksp_updated_at` datetime NOT NULL,
  PRIMARY KEY (`mksp_id`),
  KEY `mkbr_lang` (`mksp_lang`),
  KEY `mkbr_virtual_name` (`mksp_virtual_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Contenu de la table `nos_monkey_species`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
