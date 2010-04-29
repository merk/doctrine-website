<?php

class mainComponents extends sfComponents
{
  public function executeTrainings()
  {
    $feed = simplexml_load_file('http://trainings.sensiolabs.com/api/trainings.xml');
    $this->sessions = array();
    foreach ($feed->session as $session)
    {
      if (stristr($session->attributes()->name, 'doctrine') && count($this->sessions) < 6)
      {
        $this->sessions[] = (array) $session;
      }
    }

    if (count($this->sessions) < 5)
    {
      foreach ($feed->session as $session)
      {
        if (!stristr($session->attributes()->name, 'doctrine') && count($this->sessions) < 6)
        {
          $this->sessions[] = (array) $session;
        }
      }
    }
  }
}
