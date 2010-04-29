<?php

/**
 * BlogPostTag filter form base class.
 *
 * @package    doctrine_website
 * @subpackage filter
 * @author     Jonathan H. Wage
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseBlogPostTagFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('blog_post_tag_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'BlogPostTag';
  }

  public function getFields()
  {
    return array(
      'blog_post_id' => 'Number',
      'tag_id'       => 'Number',
    );
  }
}
