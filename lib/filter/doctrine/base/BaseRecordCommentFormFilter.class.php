<?php

/**
 * RecordComment filter form base class.
 *
 * @package    doctrine_website
 * @subpackage filter
 * @author     Jonathan H. Wage
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRecordCommentFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'record_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('BlogPost'), 'add_empty' => true)),
      'record_type' => new sfWidgetFormFilterInput(),
      'poster'      => new sfWidgetFormFilterInput(),
      'subject'     => new sfWidgetFormFilterInput(),
      'body'        => new sfWidgetFormFilterInput(),
      'slug'        => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'record_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('BlogPost'), 'column' => 'id')),
      'record_type' => new sfValidatorPass(array('required' => false)),
      'poster'      => new sfValidatorPass(array('required' => false)),
      'subject'     => new sfValidatorPass(array('required' => false)),
      'body'        => new sfValidatorPass(array('required' => false)),
      'slug'        => new sfValidatorPass(array('required' => false)),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('record_comment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'RecordComment';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'record_id'   => 'ForeignKey',
      'record_type' => 'Text',
      'poster'      => 'Text',
      'subject'     => 'Text',
      'body'        => 'Text',
      'slug'        => 'Text',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}
