<?php
// This file declares a managed database record of type "Custom Group".
// The record will be automatically inserted, updated, or deleted from the
// database as appropriate. For more details, see "hook_civicrm_managed" at:
// https://docs.civicrm.org/dev/en/master/hooks/hook_civicrm_managed/
return array (
  0 =>
  array (
    'name' => 'org.leadercenter.volunteer.skillmirror custom group',
    'entity' => 'CustomGroup',
    'params' =>
    array(
      'extends' => 'Volunteer Project',
      'is_reserved' => 0,
      'name' => 'Project_Skills',
      'title' => ts('Skills Needed', array('domain' => 'org.leadercenter.volunteer.skillmirror')),
      'version' => 3,
    ),
  ),
);