UPDATE `nos_monkey` SET `monk_species_id` = (SELECT `mksp_context_common_id` FROM `nos_monkey_species` WHERE `mksp_id` = `monk_species_id`);

ALTER TABLE `nos_monkey` CHANGE `monk_species_id` `monk_species_common_id` INT( 11 ) NOT NULL;