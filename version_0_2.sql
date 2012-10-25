ALTER TABLE `nos_monkey` CHANGE `monk_lang` `monk_context` VARCHAR( 25 ) NOT NULL, CHANGE `monk_lang_common_id` `monk_context_common_id` INT( 11 ) NOT NULL, CHANGE `monk_lang_is_main` `monk_context_is_main` TINYINT( 1 ) NOT NULL DEFAULT '0';
ALTER TABLE `nos_monkey_species` CHANGE `mksp_lang` `mksp_context` VARCHAR( 25 ) NOT NULL, CHANGE `mksp_lang_common_id` `mksp_context_common_id` INT( 11 ) NOT NULL, CHANGE `mksp_lang_is_main` `mksp_context_is_main` TINYINT( 1 ) NOT NULL DEFAULT '0';

UPDATE `nos_monkey` SET `monk_context` = CONCAT('main::', `monk_context`);
UPDATE `nos_monkey_species` SET `mksp_context` = CONCAT('main::', `mksp_context`);

