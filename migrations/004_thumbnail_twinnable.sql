UPDATE `nos_media_link`, `nos_monkey`
SET `medil_foreign_context_common_id` = `monk_context_common_id`
, `medil_foreign_id` = NULL
WHERE `medil_foreign_id` = `monk_id`
AND `medil_from_table` = 'nos_monkey'
AND `medil_key` = 'thumbnail';
