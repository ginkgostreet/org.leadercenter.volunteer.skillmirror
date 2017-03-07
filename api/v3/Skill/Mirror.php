<?php

/**
 * Skill.Mirror API specification
 * This is used for documentation and validation.
 *
 * TODO: This would be more extensible if the source and target custom groups
 * were parameterized rather than assumed.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC/API+Architecture+Standards
 */
function _civicrm_api3_skill_Mirror_spec(&$spec) {
  $spec['field'] = array(
    'api.default' => 'all',
    'title' => 'Field Name',
    'description' => 'Which field is being mirrored? "All" will cause all the
      fields in the source custom group to be evaluated.',
    'type' => CRM_Utils_Type::T_STRING,
  );
}

/**
 * Skill.Mirror API
 *
 * @param array $params
 * @return array
 *   The custom field meta data for each newly created field.
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_skill_Mirror($params) {
  $field = CRM_Utils_Array::value('field', $params);
  $source = CRM_Utils_Array::value('source', $params, 'Volunteer_Skills');
  $target = CRM_Utils_Array::value('target', $params, 'Project_Skills');

  if ($field == 'all') {
    $result = array();
    return civicrm_api3_create_success($result, $params, 'Skill', 'Mirror');
  } else {
    throw new API_Exception("Support for mirroring individual fields hasn't been
        implemented yet");
  }
}
