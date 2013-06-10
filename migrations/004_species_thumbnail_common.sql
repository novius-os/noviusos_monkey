UPDATE `nos_monkey` SET `monk_species_id` = (SELECT `mksp_context_common_id` FROM `nos_monkey_species` WHERE `mksp_id` = `monk_species_id`);

ALTER TABLE `nos_monkey` CHANGE `monk_species_id` `monk_species_common_id` INT( 11 ) NOT NULL;

UPDATE `nos_media_link`, `nos_monkey`
SET `medil_foreign_context_common_id` = `monk_context_common_id`, `medil_foreign_id` = NULL
WHERE `medil_foreign_id` = `monk_id`
AND `medil_from_table` = 'nos_monkey'
AND `medil_key` = 'thumbnail';
