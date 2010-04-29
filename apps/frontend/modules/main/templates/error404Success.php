<?php use_helper('I18N'); ?>

<h2><?php echo __('Oops! The page you asked for could not be found.'); ?></h2>

<p><?php echo sfContext::getInstance()->getRequest()->getUri(); ?></p>

<p><?php echo button_to(__('Go Back'), '#', array('onClick' => 'history.go(-1);')); ?></p>