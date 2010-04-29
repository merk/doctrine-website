<?php

/**
 * comment actions.
 *
 * @package    symfony
 * @subpackage comment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class commentActions extends sfActions
{
  public function executeDelete(sfWebRequest $request)
  {
    $comment = $this->getRoute()->getObject();
    if (!$comment)
    {
      $this->redirect('@homepage');
    }
    $comment->delete();
    $record = $comment->getRecord();

    $this->redirect($record->getRoute().'#comments');
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = new NewCommentForm(new RecordComment());
    $this->comment = $this->form->getObject();

    $captcha = array(
      'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
      'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field'),
    );
    $this->form->bind(array_merge($request->getParameter($this->form->getName()), array('captcha' => $captcha)));

    if ($this->form->isValid())
    {
      $this->form->save();

      $record = $this->comment->getRecord();
      $message = $this->getMailer()->compose(
        array('jonwage@gmail.com' => 'Jonathan H. Wage'),
        array('jonwage@gmail.com', 'mkaatman@gmail.com'),
        sprintf('New Doctrine Blog Comment on "%s"', $record->getName()),
        sprintf('A new comment has been posted on the Doctrine blog for the post "%s"

Subject: %s

Body:
%s

IP Address: %s

Delete: %s
',
          $record->getName(),
          $this->comment->getSubject(),
          $this->comment->getBody(),
          $request->getHttpHeader('addr', 'remote'),
          'http://www.doctrine-project.org/comments/'.$this->comment->id.'/delete'
        )
      );

      $this->getMailer()->send($message);


      $this->redirect($this->getRequest()->getParameter('referer') . '#comment_' . $this->comment->getId());
    }

    $this->values = $request->getParameter('record_comment');
    $this->record = Doctrine::getTable($this->values['record_type'])->find($this->values['record_id']);
    $this->comments = RecordCommentTable::retrieveRecordComments($this->comment->record_id, $this->comment->record_type);
  }

  public function executeFeed()
  {
    $latestComments = RecordCommentTable::getLatestComments(10);

    $feed = new sfAtom1Feed();
    $feed->setTitle('Doctrine User Comments');
    $feed->setLink('http://www.doctrine-project.org/comments/feed');
    
    foreach($latestComments as $comment)
    {
      $i = new sfFeedItem();
      $i->setPubDate(strtotime($comment->getCreatedAt()));
      $i->setTitle($comment->getTitle());
      $i->setDescription($comment->getBody());
      $i->setLink($comment->getRecordRoute());
      $i->setUniqueId(md5($comment->getRecordRoute()));

      $feed->addItem($i);
    }
    $this->feed = $feed;
  }
}