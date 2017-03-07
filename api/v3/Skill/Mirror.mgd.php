<?php
// This file declares a managed database record of type "Job".
// The record will be automatically inserted, updated, or deleted from the
// database as appropriate. For more details, see "hook_civicrm_managed" at:
// https://docs.civicrm.org/dev/en/master/hooks/hook_civicrm_managed/
return array (
  0 => 
  array (
    'name' => 'Cron:Skill.Mirror',
    'entity' => 'Job',
    'params' => 
    array (
      'version' => 3,
      'name' => 'Skill.Mirror',
      'description' => ts('Creates a custom field on the volunteer project entity for each skill-related custom field on volunteer contacts. Can be run safely (i.e., without creating duplicates) multiple times, but need only be run when there are unmirrored skills on the contact.', array('domain' => 'org.leadercenter.volunteer.skillmirror')),
      'run_frequency' => 'Always',
      'api_entity' => 'Skill',
      'api_action' => 'Mirror',
      'parameters' => '',
    ),
  ),
);