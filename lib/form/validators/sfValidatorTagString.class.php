<?php
class sfValidatorTagString extends sfValidatorBase
{
  protected function doClean($value)
  {
    return Doctrine::getTable('Tag')->getTagIdsFromString($value);
  }
}