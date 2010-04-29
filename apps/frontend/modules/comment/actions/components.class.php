<?php
class commentComponents extends sfComponents
{
  public function executeComments()
  {
    $this->comments = RecordCommentTable::retrieveRecordComments($this->record_id, $this->record_type);
  }

  public function executeComments_list()
  {
  }

  public function executeCreate()
  {
    $array = $this->getRequestParameter('record_comment', array());
    if ($this->record_id)
    {
      $array['record_id'] = $this->record_id;
    }
    if ($this->record_type)
    {
      $array['record_type'] = $this->record_type;
    }

    $this->comment = new RecordComment();
    $this->comment->fromArray($array);

    $this->form = new NewCommentForm($this->comment);
    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->form->bind($array);
    }
  }
}