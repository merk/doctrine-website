<?php

/**
 * DocItemTranslation form.
 *
 * @package    form
 * @subpackage DocItemTranslation
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class DocItemTranslationForm extends BaseDocItemTranslationForm
{
  public function configure()
  {
    unset($this['slug']);
  }
}