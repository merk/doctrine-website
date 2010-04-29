<?php

/**
 * BlogPost form.
 *
 * @package    form
 * @subpackage BlogPost
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class BlogPostForm extends BaseBlogPostForm
{
  public function configure()
  {
    unset($this['updated_at']);

    $this->widgetSchema->setLabels(
        array('sf_guard_user_id' => 'User',
              'is_published'     => 'Published')
      );

    $this->setWidgetAttribute('name', 'size', 55);
    $this->setWidgetAttributes('body', array('cols' => 80, 'rows' => 18));

    $this->widgetSchema['tags_list'] = new sfWidgetFormTagString();
    $this->validatorSchema['tags_list'] = new sfValidatorTagString(array('required' => false));

    $q = Doctrine_Query::create()
      ->select('u.id, u.username')
      ->from('sfGuardUser u')
      ->leftJoin('u.groups g')
      ->leftJoin('g.permissions p')
      ->where('p.name = ? OR u.is_super_admin = 1', 'blog_posts');

    $this->widgetSchema['sf_guard_user_id']->setOption('query', $q);

    $this->addRequiredFields(
      array(
        'name',
        'body',
        'sf_guard_user_id' => 'You must select a user.')
      );
  }
}