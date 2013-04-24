ALTER TABLE `nos_monkey`
  ADD `monk_publication_start` DATETIME NULL DEFAULT NULL AFTER `monk_published` ,
  ADD `monk_publication_end` DATETIME NULL DEFAULT NULL AFTER `monk_publication_start`;
