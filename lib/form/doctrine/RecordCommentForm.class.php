<?php

/**
 * RecordComment form.
 *
 * @package    form
 * @subpackage RecordComment
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class RecordCommentForm extends BaseRecordCommentForm
{
  public function configure()
  {
    unset($this['record_id'], $this['created_at'], $this['updated_at'], $this['slug'], $this['record_type']);

    $this->widgetSchema['poster']->setAttribute('size', 55);
    $this->widgetSchema['subject']->setAttribute('size', 55);
    $this->widgetSchema['body']->setAttribute('cols', 100);
    $this->widgetSchema['body']->setAttribute('rows', 20);

    $this->addRequiredFields(
      array(
        'poster',
        'subject',
        'body'
        )
      );
  }
}