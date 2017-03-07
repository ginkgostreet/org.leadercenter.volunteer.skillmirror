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
      'description' => 'Creates a custom field on the Volunteer Project entity
        for each skill-related custom field on the Volunteer contact type. This
        job can be run safely (i.e., without creating duplicate skills) multiple
        times, but only need to be run when there are skills on the contact that
        are not reflected on the project.',
      'run_frequency' => 'Always',
      'api_entity' => 'Skill',
      'api_action' => 'Mirror',
      'parameters' => '',
    ),
  ),
);