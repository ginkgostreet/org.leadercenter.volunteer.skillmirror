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
  $toMirror = CRM_Utils_Array::value('field', $params);
  $sourceGroup = CRM_Utils_Array::value('source', $params, 'Volunteer_Skills');
  $targetGroup = CRM_Utils_Array::value('target', $params, 'Project_Skills');
  // api.CustomField.create doesn't seem to accept custom group name, so get the ID
  $context['target_group_id'] = civicrm_api3('CustomGroup', 'getvalue', array(
    'extends' => 'VolunteerProject',
    'name' => $targetGroup,
    'return' => 'id',
  ));

  if ($toMirror === 'all') {
    $result = array();

    $sourceFields = civicrm_api3('CustomField', 'get', array(
      'custom_group_id' => $sourceGroup,
      'options' => array('limit' => 0),
    ));
    foreach ($sourceFields['values'] as $sourceField) {
      // TODO: to make this more extensible, the transform function could be
      // registered via hook rather than hardcoded
      $mirroredField = _skill_mirror_transform($sourceField, $context);
      $exists = civicrm_api3('CustomField', 'getcount', array(
        'custom_group_id' => $mirroredField['custom_group_id'],
        'name' => $mirroredField['name'],
      ));
      if (!$exists) {
        $create = civicrm_api3('CustomField', 'create', $mirroredField);
        $result[$create['id']] = $create['values'];
      }
    }

    return civicrm_api3_create_success($result, $params, 'Skill', 'Mirror');
  } else {
    throw new API_Exception("Support for mirroring individual fields hasn't been
        implemented yet");
  }
}

/**
 * Transforms parameters from the fetched (to be mirrored) field for use in
 * creating the new field.
 *
 * @param array $field
 *   The original field, to be mirrored.
 * @param array $context
 *   Context from the calling function which may aid in transformation.
 * @return array
 *   An API-ready set of customField parameters.
 */
function _skill_mirror_transform(array $field, array $context) {
  // Make sure we don't update the source field.
  unset($field['id']);

  $field['custom_group_id'] = $context['target_group_id'];

  // on the project entity (compared to the contact) the meaning of the skill
  // field changes slightly -- we want to know the *minimum* level required,
  // so a scalar value is more appropriate than a range
  $field['html_type'] = 'Select';

  return $field;
}
