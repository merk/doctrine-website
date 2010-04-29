<?php

/**
 * DocItemTranslation filter form base class.
 *
 * @package    doctrine_website
 * @subpackage filter
 * @author     Jonathan H. Wage
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseDocItemTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'    => new sfWidgetFormFilterInput(),
      'subtitle' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'title'    => new sfValidatorPass(array('required' => false)),
      'subtitle' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('doc_item_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'DocItemTranslation';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'title'    => 'Text',
      'subtitle' => 'Text',
      'lang'     => 'Text',
    );
  }
}
