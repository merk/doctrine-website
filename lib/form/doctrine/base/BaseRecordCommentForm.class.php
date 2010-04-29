<?php

/**
 * RecordComment form base class.
 *
 * @method RecordComment getObject() Returns the current form's model object
 *
 * @package    doctrine_website
 * @subpackage form
 * @author     Jonathan H. Wage
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRecordCommentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'record_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('BlogPost'), 'add_empty' => true)),
      'record_type' => new sfWidgetFormInputText(),
      'poster'      => new sfWidgetFormInputText(),
      'subject'     => new sfWidgetFormInputText(),
      'body'        => new sfWidgetFormTextarea(),
      'slug'        => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'record_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('BlogPost'), 'required' => false)),
      'record_type' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'poster'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'subject'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'body'        => new sfValidatorString(array('required' => false)),
      'slug'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'RecordComment', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('record_comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RecordComment';
  }

}
