<?php

/**
 * Project form base class.
 *
 * @package    form
 * @version    SVN: $Id: sfDoctrineFormBaseTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
abstract class BaseFormDoctrine extends sfFormDoctrine
{
  public function setup()
  {
  }

  public function requireAllFields(array $messages = array())
  {
    foreach ($this->widgetSchema as $name => $widgetSchema)
    {
      $message = isset($messages[$name]) ? $messages[$name]:null;
      $this->addRequiredField($name, $message);
    }
  }

  public function addRequiredFields(array $requiredFields)
  {
    foreach ($requiredFields as $name => $message)
    {
      if (is_integer($name))
      {
        $name = $message;
        $message = null;
      }
      $this->addRequiredField($name, $message);
    }
  }

  public function addRequiredField($widgetName, $message = null)
  {
    $message = $message ? $message:sprintf('The %s field is required.', $this->widgetSchema[$widgetName]->getLabel());
    $this->validatorSchema[$widgetName]->setOption('required', true);
    $this->validatorSchema[$widgetName]->addMessage('required', $message);
  }

  public function setWidgetAttributes($widgetName, array $widgetAttributes)
  {
    foreach ($widgetAttributes as $name => $value)
    {
      $this->setWidgetAttribute($widgetName, $name, $value);
    }
  }

  public function setWidgetAttribute($widgetName, $name, $value)
  {
    $this->widgetSchema[$widgetName]->setAttribute($name, $value);
  }

  public function setWidgetOptions($widgetName, array $widgetOptions)
  {
    foreach ($widgetOptions as $name => $value)
    {
      $this->setWidgetOption($widgetName, $name, $value);
    }
  }

  public function setWidgetOption($widgetName, $name, $value)
  {
    $this->widgetSchema[$widgetName]->setAttribute($name, $value);
  }

  public function setValidatorOptions($validatorName, array $validatorOptions)
  {
    foreach ($validatorOptions as $name => $value)
    {
      $this->validatorSchema[$validatorName]->setAttribute($name, $value);
    }
  }

  public function setValidatorOption($validatorName, $name, $value)
  {
    $this->validatorSchema[$validatorName]->setAttribute($name, $value);
  }

  public function setValidatorMessages($validatorName, array $validatorMessages)
  {
    foreach ($validatorMessages as $name => $validatorMessage)
    {
      $this->validatorSchema[$validatorName]->addMessage($name, $validatorMessage);
    }
  }

  public function setValidatorMessage($validatorName, $name, $value)
  {
    $this->validatorSchema[$validatorName]->addMessage($name, $value);
  }
}