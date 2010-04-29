<?php

/**
 * Contributor form.
 *
 * @package    form
 * @subpackage Contributor
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class ContributorForm extends BaseContributorForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at'], $this['slug']);
    $this->widgetSchema['about']->setAttribute('cols', 100);
    $this->widgetSchema['about']->setAttribute('rows', 20);
  }
}