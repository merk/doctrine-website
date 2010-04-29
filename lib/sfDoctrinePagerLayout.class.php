<?php
class sfDoctrinePagerLayout extends Doctrine_Pager_Layout
{
  public function __construct($pager, $pagerRange, $urlMask)
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url', 'Tag'));
    parent::__construct($pager, $pagerRange, $urlMask);
  }

  protected function _parseTemplate($options = array())
  {
    $str = parent::_parseTemplate($options);

    return preg_replace(
      '/\{link_to\}(.*?)\{\/link_to\}/', link_to('$1', $this->_parseUrl($options)), $str
    );
  }
}