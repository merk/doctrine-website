<?php

/**
 * BlogPostTag form base class.
 *
 * @method BlogPostTag getObject() Returns the current form's model object
 *
 * @package    doctrine_website
 * @subpackage form
 * @author     Jonathan H. Wage
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseBlogPostTagForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'blog_post_id' => new sfWidgetFormInputHidden(),
      'tag_id'       => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'blog_post_id' => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'blog_post_id', 'required' => false)),
      'tag_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'tag_id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('blog_post_tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BlogPostTag';
  }

}
