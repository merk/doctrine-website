<?php

/**
 * UserDocItemTranslation form base class.
 *
 * @package    form
 * @subpackage user_doc_item_translation
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseUserDocItemTranslationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'title'    => new sfWidgetFormInputText(),
      'subtitle' => new sfWidgetFormInputText(),
      'body'     => new sfWidgetFormTextarea(),
      'lang'     => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorDoctrineChoice(array('model' => 'UserDocItemTranslation', 'column' => 'id', 'required' => false)),
      'title'    => new sfValidatorString(array('max_length' => 255)),
      'subtitle' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'body'     => new sfValidatorString(array('required' => false)),
      'lang'     => new sfValidatorDoctrineChoice(array('model' => 'UserDocItemTranslation', 'column' => 'lang', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_doc_item_translation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserDocItemTranslation';
  }

}
