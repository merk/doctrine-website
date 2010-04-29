<?php

class DocItemRenderer extends Sensei_Doc_Renderer_Xhtml
{
  protected $_documentationItem;
  protected $_project;
  protected $_version;
  protected $_markupParser = 'Text_Wiki';
  protected $_renderForPdf = false;
  protected $_renderForBookPdf = false;

  public function __construct($documentationItem, $language, $user, array $options = array())
  {
    $this->_documentationItem = $documentationItem;
    $this->_project = $documentationItem->getProject();
    $this->_version = $documentationItem->getVersion();
    $this->_toc = $documentationItem->getTableOfContents($language, $user);
    $this->_toc = $this->_toc ? $this->_toc : new Sensei_Doc_Toc(null);
    parent::__construct($this->_toc, $options);
  }

  public function getChapter()
  {
    return $this->_options['section'];
  }

  public function getDocumentationItem()
  {
    return $this->_documentationItem;
  }

  public function getProject()
  {
    return $this->_project;
  }

  public function getVersion()
  {
    return $this->_version;
  }

  public function setRenderForPdf($bool)
  {
    $this->_renderForPdf = $bool;
  }

  public function setRenderForBookPdf($bool)
  {
    $this->_renderForBookPdf = $bool;
  }

  public function setMarkupParser($markupParser)
  {
    $this->_markupParser = $markupParser;
  }

  public function getMarkupParser()
  {
    return $this->_markupParser;
  }

  public function getToc()
  {
    return $this->_toc;
  }

  public function makeUrl($section)
  {
      if ($section instanceof Sensei_Doc_Section) {
          $path = $section->getPath();
      } else {
          $path = $section;
      }

      $e = explode(':', $path);
      $chapter = $e[0];

      $url = url_for('@project_documentation_item_chapter?slug='.$this->_project->getSlug().'&version='.$this->_version->getSlug().'&item='.$this->_documentationItem->getSlug().'&chapter='.$chapter);

      $anchor = $this->makeAnchor($section);
      if ($anchor !== '') {
          $url .= '#' . $anchor;
      }

      return $url;
  }

  protected function _renderToc($section)
  {
      $output = '';

      if ($section instanceof Sensei_Doc_Toc) {
          $class = ' class="tree"';
      } elseif ($section !== $this->_options['section']) {
          $class = ' class="closed"';
      } else {
          $class = '';
      }

      if (!$section instanceof Sensei_Doc_Toc) {
          $output .= '<ul' . $class . '>' . "\n";       
      }

      for ($i = 0; $i < $section->count(); $i++) {
          $child = $section->getChild($i);

          $text = $child->getName();
          $href = $this->makeUrl($child);

          $output .= '<li><a href="' . $href . '">' . $text . '</a>';

          if ($child->count() > 0) {
              $output .= "\n";
              $output .= $this->_renderToc($child);
          }

          $output .= '</li>' . "\n";
      }

      if (!$section instanceof Sensei_Doc_Toc) {
        $output .= '</ul>' . "\n";
      }
  
      return $output;
  }

  public function renderMainToc()
  {
      $section = $this->_toc;
      $output = '';

      for ($i = 0; $i < $section->count(); $i++) {
          $child = $section->getChild($i);

          $text = $child->getName();
          $href = $this->makeUrl($child);

          $output .= '<li><a href="' . $href . '">' . $text . '</a> <span class="chapter_note"><a href="' . $href . '">Chapter ' . $child->getIndex() . '</a></span></li>';
      }

      return $output;
  }

  public function makeAnchor($section)
  {
      if ($section instanceof Sensei_Doc_Section) {
          $path = $section->getPath();
      } else {
          $path = $section;
      }
      $path = str_replace('-&-', '-', $path);
      if ($this->_options['section'] instanceof Sensei_Doc_Section) {
          $level = $this->_options['section']->getLevel();
          return implode(':', array_slice(explode(':', $path), $level));
      } else {
          return $path;
      }
  }

  protected function _renderSection(Sensei_Doc_Section $section)
  {
    $output = '';

    $level = $section->getLevel();
    
    $title = $section->getName();

    if ($level === 1) {
        $class = ' class="chapter"';
    } else {
        $class = ' class="section"';
    }

    $output .= '<div' . $class .'>' . "\n";

    $output .= "<h$level>";

    if ( ! ($this->_options['section'] instanceof Sensei_Doc_Section)
    || ($level > $this->_options['section']->getLevel())) {
        $anchor = $this->makeAnchor($section);
        $output .= '<a href="#' . $anchor . '" id="' . $anchor . '">';
        $output .= $title . '</a>';
    } else {
        $output .= $title;
    }

    $output .= "</h$level>";

    $output .= $this->_renderMarkup($section->getText());

    // Render children of this section recursively
    for ($i = 0; $i < count($section); $i++) {
        $output .= $this->_renderSection($section->getChild($i));
    }

    $output .= '</div>' . "\n";

    return $output;
  }

  protected function _renderMarkup($markup)
  {
    // Transform section contents from wiki syntax to XHTML
    if ($this->_renderForPdf)
    {
      return DocConverter::renderMarkupForPdf($markup, $this->_markupParser);
    } else if ($this->_renderForBookPdf) {
      return DocConverter::renderMarkupForBookPdf($markup, $this->_markupParser);
    } else {
      return DocConverter::renderMarkup($markup, $this->_markupParser);
    }
  }

  public function __toString()
  {
    return (string) $this->render();
  }
}