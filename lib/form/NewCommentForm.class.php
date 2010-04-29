<?php
class NewCommentForm extends RecordCommentForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at'], $this['slug']);

    $this->widgetSchema['body']->setAttribute('cols', 60);
    $this->widgetSchema['body']->setAttribute('rows', 10);
    $this->widgetSchema['record_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['record_type'] = new sfWidgetFormInputHidden();

    $this->validatorSchema['record_id'] = new sfValidatorInteger(array('required' => true));
    $this->validatorSchema['record_type'] = new sfValidatorString(array('required' => true));
    $this->validatorSchema['poster']->setOption('required', true);
    $this->validatorSchema['subject']->setOption('required', true);
    $this->validatorSchema['body']->setOption('required', true);

    $publicKey = '6Ld2DgQAAAAAAApXLteupHPcbSxbSHkhNTuYLChX';
    $privateKey = '6Ld2DgQAAAAAANIbaXJsFEBOyg56CL_ljy3APlPb';

    $this->widgetSchema['captcha'] = new sfWidgetFormReCaptcha(array(
      'public_key' => $publicKey
    ));

    $this->validatorSchema['captcha'] = new sfValidatorReCaptcha(array(
      'private_key' => $privateKey
    ));
  }
}