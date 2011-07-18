# sql file for ol_search_open_learn module

CREATE TABLE `ol_search_open_learn` (
      `id` mediumint(8) unsigned NOT NULL,
      `identifier` varchar (768),
	 `datestamp` varchar (768),
	 `catalog` varchar (768),
	 `entry` varchar (768),
	 `title` blob ,
	 `description` blob ,
	 `keywords` blob ,
	 `website` varchar (768),
	 `cc` varchar (768),
	 `cp` varchar (768),
      PRIMARY KEY ( `id` )
   
);

#language text
INSERT INTO `language_text` VALUES ('en', '_module','ol_search_open_learn','Search OpenLearn',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','update_param','Update Parameters',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_search_open_learn_tool','Search OpenLearn Content Tool',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_search_open_learn_text','A sample Search OpenLearn text for detailed homepage.',NOW(),'');

INSERT INTO `language_text` VALUES ('en', '_module','ol_update','Update Now',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_last_update','Last Updated',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_repo_url','Repository URL',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_cron_interval','CRON interval',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_min','minutes',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_change','Change',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_max_reco','Maximum Records',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_order','Order By',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_bool','Boolean Operation',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_or','OR',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_and','AND',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_def','Default',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_title_asc','Title Ascending',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_title_desc','Title Descending',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_date_asc','Date Ascending',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_module','ol_date_desc','Date Descending',NOW(),'');

#adding feedback messages
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_OL_DB_UPDATED','Database updated successfully',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_OL_DB_NOT_UPDATED','Error in updating database',NOW(),'');
INSERT INTO `language_text` VALUES ('en', '_msgs','AT_FEEDBACK_SETTINGS_CHANGED','Settings changed successfully',NOW(),'');



#configuration data
INSERT INTO `config` VALUES ('ol_url','http://openlearn.open.ac.uk/local/oai/oai2.php?verb=ListRecords&metadataPrefix=oai_ilox');
INSERT INTO `config` VALUES ('ol_last_updation','');



