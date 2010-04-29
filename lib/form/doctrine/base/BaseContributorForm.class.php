<?php

/**
 * Contributor form base class.
 *
 * @method Contributor getObject() Returns the current form's model object
 *
 * @package    doctrine_website
 * @subpackage form
 * @author     Jonathan H. Wage
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseContributorForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'name'       => new sfWidgetFormInputText(),
      'nick'       => new sfWidgetFormInputText(),
      'role'       => new sfWidgetFormInputText(),
      'email'      => new sfWidgetFormInputText(),
      'about'      => new sfWidgetFormTextarea(),
      'core'       => new sfWidgetFormInputCheckbox(),
      'active'     => new sfWidgetFormInputCheckbox(),
      'slug'       => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'nick'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'role'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'about'      => new sfValidatorString(array('required' => false)),
      'core'       => new sfValidatorBoolean(array('required' => false)),
      'active'     => new sfValidatorBoolean(array('required' => false)),
      'slug'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Contributor', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('contributor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contributor';
  }

}
