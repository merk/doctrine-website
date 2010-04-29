<?php

/**
 * Permission form base class.
 *
 * @package    form
 * @subpackage permission
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BasePermissionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'username' => new sfWidgetFormInputText(),
      'action'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorDoctrineChoice(array('model' => 'Permission', 'column' => 'id', 'required' => false)),
      'username' => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'action'   => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('permission[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Permission';
  }

}