<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * UserDocItemTranslation filter form base class.
 *
 * @package    filters
 * @subpackage UserDocItemTranslation *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseUserDocItemTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'    => new sfWidgetFormFilterInput(),
      'subtitle' => new sfWidgetFormFilterInput(),
      'body'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'title'    => new sfValidatorPass(array('required' => false)),
      'subtitle' => new sfValidatorPass(array('required' => false)),
      'body'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_doc_item_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserDocItemTranslation';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'title'    => 'Text',
      'subtitle' => 'Text',
      'body'     => 'Text',
      'lang'     => 'Text',
    );
  }
}