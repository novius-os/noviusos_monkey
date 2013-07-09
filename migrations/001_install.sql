/**
 * NOVIUS OS - Web OS for digital communication
 *
 * @copyright  2011 Novius
 * @license    GNU Affero General Public License v3 or (at your option) any later version
 *             http://www.gnu.org/licenses/agpl-3.0.html
 * @link http://www.novius-os.org
 */

CREATE TABLE IF NOT EXISTS `nos_monkey` (
  `monk_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `monk_lang` varchar(5) NOT NULL,
  `monk_lang_common_id` int(11) NOT NULL,
  `monk_lang_is_main` tinyint(1) NOT NULL DEFAULT '0',
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
  KEY `monk_lang` (`monk_lang`),
  KEY `monk_lang_common_id` (`monk_lang_common_id`, `monk_lang_is_main`),
  KEY `monk_lang_is_main` (`monk_lang_is_main`),
  KEY `monk_virtual_name` (`monk_virtual_name`),
  KEY `monk_species_id` (`monk_species_id`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `nos_monkey_species` (
  `mksp_id` int(11) NOT NULL AUTO_INCREMENT,
  `mksp_lang` varchar(5) NOT NULL,
  `mksp_lang_common_id` int(11) NOT NULL,
  `mksp_lang_is_main` tinyint(1) NOT NULL DEFAULT '0',
  `mksp_title` varchar(255) NOT NULL DEFAULT '',
  `mksp_virtual_name` varchar(255) NOT NULL,
  `mksp_created_at` datetime NOT NULL,
  `mksp_updated_at` datetime NOT NULL,
  PRIMARY KEY (`mksp_id`),
  KEY `mksp_lang` (`mksp_lang`),
  KEY `mksp_lang_common_id` (`mksp_lang_common_id`, `mksp_lang_is_main`),
  KEY `mksp_lang_is_main` (`mksp_lang_is_main`),
  KEY `mksp_virtual_name` (`mksp_virtual_name`)
) DEFAULT CHARSET=utf8;
