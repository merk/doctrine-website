<?php

class sfGuardUserAdminForm extends BasesfGuardUserAdminForm
{
  public function configure()
  {
    parent::configure();

    $choices = sfGuardUser::getSvnAccessItems();
    $this->widgetSchema['svn_access'] = new sfWidgetFormSelectMany(array('multiple' => true, 'choices' => $choices));
  }
}