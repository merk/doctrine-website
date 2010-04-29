<?php

require_once(dirname(__FILE__).'/../vendor/geshi/geshi.php');

class DocConverter
{
  static public function renderPdf($name, $version, $language = 'en', $cacheLifeTime = 86400)
  {
    $pdfLocalPath = self::generatePdf($name, $version, $language, $cacheLifeTime);

    header('location: '.$pdfLocalPath);
  }

  public static function renderUserDocPdf($name, $item, $version, $language = 'en', $cacheLifeTime = 86400)
  {
    $name .= '&item='.$item;
    $pdfLocalPath = self::generatePdf($name, $version, $language, $cacheLifeTime);

    header('location: '.$pdfLocalPath);
  }

  static public function generatePdf($name, $version, $language = 'en', $cacheLifeTime = 86400)
  {
    set_time_limit(0);
    ini_set('memory_limit', '512M');

    $request = sfContext::getInstance()->getRequest();
    $fileName = Doctrine_Inflector::urlize($name.'-'.$version.'-'.$language).'.pdf';

    $pdfPath = '/downloads/pdfs/' . $fileName;
    $pdfLocalPath = sfConfig::get('sf_web_dir').$pdfPath;
    $pdfWebPath = $request->getUriPrefix().$request->getRelativeUrlRoot().$pdfPath;
    $pdfSymfonyWebPath = sprintf('http://www.symfony-project.org/get/doctrine_docs/download.php?name=%s&version=%s&language=%s', $name, $version, $language);

    $lastModified = file_exists($pdfLocalPath) ? filemtime($pdfLocalPath):0;
    $tooOld = time() - $cacheLifeTime;
    if (!file_exists($pdfLocalPath) || $lastModified < $tooOld || !filesize($pdfLocalPath))
    {
      file_put_contents($pdfLocalPath, file_get_contents($pdfSymfonyWebPath));
    }
    return $pdfWebPath;
  }

  static public function renderMarkupForPdf($content, $type = 'markdown')
  {
    $html = self::renderMarkup($content, $type);
    $html = str_replace('<span class="default">&lt;?php</span>', '', $html);
    $html = str_replace('<span style="color: #CC8865;">---</span>', '', $html);
    $html = preg_replace('#<a href="http://(.*?)"(?:[^>]*)>(.*?)</a>#', '$2<span class="footnote"><code>http://$1</code></span>', $html);
    return $html;
  }

  static public function renderMarkupForBookPdf($content, $type = 'markdown')
  {
    $html = self::renderMarkupForPdf($content, $type);
    return $html;
  }

  static public function renderMarkup($content, $type = 'markdown')
  {
    if ($content)
    {
      if (strpos($content, '[php]') !== false)
      {
        $type = 'markdown';
      }
      $content = str_replace('<?php', '[php]', $content);

      $name = Doctrine_Inflector::classify($type);
      $func = 'DocConverter::convert' . $name . 'ToHTMLAndEnhance';
      $html = call_user_func($func, $content);

      return '<div class="documentation_markup">' . $html . '</div>';
    }
  }

  static public function convertMarkdownToHTMLAndEnhance($content)
  {
    return self::enhanceHTML(self::convertMarkdownToHTML($content));
  }

  static public function convertTextWikiToHtmlAndEnhance($content)
  {
    return self::enhanceHTML(self::convertTextWikiToHtml($content));
  }

  static public function convertTextWikiToHtml($content)
  {
    $wiki = Text_Wiki::singleton('Doc');
    $wiki->setFormatConf('Xhtml', 'translate', HTML_SPECIALCHARS);

    return $wiki->transform($content);
  }

  static public function convertMarkdownToHTML($content)
  {
    require_once(dirname(__FILE__) . '/Markdown.php');
    return markdown($content);
  }

  static public function enhanceHTML($html)
  {
    // remove ➥ character
    $html = preg_replace('/\n *➥/s', '', $html);

    // change class for command line stuff
    $html = preg_replace('/<pre><code>(\$|&gt;)/s', '<pre class="command-line"><code>$1', $html);

    // change http:// link
    $html = preg_replace('#<pre><code>http\://#s', '<pre class="url"><code>http://', $html);

    // NOTE|CAUTION|TIP Boxes
    $html = preg_replace('#<blockquote>\s*<p><strong>(note|caution|tip)</strong>\:?#sie', '\'<blockquote class="\'.strtolower("$1").\'"><p>\'', $html);

    // SIDEBAR Box
    $html = preg_replace('#<blockquote>\s*<p><strong>sidebar</strong>\s*(.+?)\s*</p>#si', '<blockquote class="sidebar"><p class="title">$1</p>', $html);

    // Fix separator
    $html = str_replace('<p>-</p>', '', $html);

    // Tables
    $html = str_replace('<table', '<table cellspacing="0" class="doc_table"', $html);

    // yntax highlighting
    $html = preg_replace_callback('#<pre><code>(.+?)</code></pre>#s', array('DocConverter', 'geshiCall'), $html);

    // SQL
    $html = preg_replace_callback('#<pre><code>(alter|create|drop|select|update|delete|from|group by|having|where)(.+?)</code></pre>#si', array('DocConverter', 'highlightSql'), $html);

    // Yaml
    $html = preg_replace_callback('#<pre><code>(.+?)</code></pre>#s', array('DocConverter', 'highlightYaml'), $html);

    // Fix a few weird things
    $html = str_replace("<p><br />\n", '<p>', $html);
    $html = str_replace('&nbsp;', '', $html);

    // Remove starting/closing php tag to save space
    $html = str_replace('<span class="default">&lt;?php</span>

', '', $html);
    $html = str_replace('<span class="kw2">?&gt;</span>', '', $html);
    $html = str_replace('<span class="default">?&gt;</span>', '', $html);
    $html = str_replace('

</code></pre>', '</code></pre>', $html);

    // Fix invalid html (<br><img ...>). No closing tag.
    $html = str_replace('<br>', '<br />', $html);
    $html = preg_replace_callback('#<img(.+?)>#', array('DocConverter', 'fixImage'), $html);

    // Remove Figure text 
    $html = preg_replace('#<p class="caption">(.+?)</p>#', '', $html);

    return $html;
  }

  static protected function fixImage($matches)
  {
    $imageHtml = $matches[0];
    $check = substr($imageHtml, strlen($imageHtml) - 2, strlen($imageHtml));
    if ($check != '/>')
    {
      return '<img ' . trim($matches[1]) . ' />';
    } else {
      return $matches[0];
    }
  }

  static protected function highlightYaml($matches)
  {
    $yaml = is_string($matches) ? $matches:$matches[1];

    if ($formatted = sfYamlSyntaxHighlighter::highlight($yaml))
    {
      return $formatted;
    } else {
      return $matches[0];
    }
  }

  static protected function highlightSql($matches)
  {
    $sql = $matches[0];
    $color = "#ffcc66";
    $newSql = $sql;
    $newSql = str_replace("CREATE ", "<span style=\"color: $color;\"><strong>CREATE </strong></span>", $newSql);
    $newSql = str_replace("ALTER ", "<span style=\"color: $color;\"><strong>ALTER </strong></span>", $newSql);
    $newSql = str_replace("TABLE ", "<span style=\"color: $color;\"><strong>TABLE </strong></span>", $newSql);
    $newSql = str_replace("CONSTRAINT ", "<span style=\"color: $color;\"><strong>CONSTRAINT </strong></span>", $newSql);
    $newSql = str_replace("VIEW ", "<span style=\"color: $color;\"><strong> VIEW </strong></span>", $newSql);
    $newSql = str_replace("DROP", "<span style=\"color: $color;\"><strong>DROP </strong></span>", $newSql);
    $newSql = str_replace("SELECT ", "<span style=\"color: $color;\"><strong>SELECT </strong></span><br/>", $newSql);
    //$newSql = preg_replace("/([a-zA-Z0-9._]+) AS ([a-zA-Z0-9._]+), /", "$1 AS $2, <br/>", $newSql);
    $newSql = str_replace(', ', ', <br/>', $newSql);
    $newSql = str_replace("UPDATE ", "<span style=\"color: $color;\"><strong>UPDATE </strong></span>", $newSql);
    $newSql = str_replace("DELETE ", "<span style=\"color: $color;\"><strong>DELETE </strong></span>", $newSql);
    $newSql = str_replace("FROM ", "<br/><span style=\"color: $color;\"><strong>FROM </strong></span>", $newSql);
    $newSql = str_replace("LEFT JOIN ", "<br/><span style=\"color: $color;\"><strong>LEFT JOIN </strong></span>", $newSql);
    $newSql = str_replace("INNER JOIN ", "<br/><span style=\"color: $color;\"><strong>INNER JOIN </strong></span>", $newSql);
    $newSql = str_replace("WHERE ", "<br/><span style=\"color: $color;\"><strong>WHERE </strong></span>", $newSql);
    $newSql = str_replace("GROUP BY ", "<br/><span style=\"color: $color;\"><strong>GROUP BY </strong></span>", $newSql);
    $newSql = str_replace("HAVING ", "<br/><span style=\"color: $color;\"><strong>HAVING </strong></span>", $newSql);
    $newSql = str_replace("AS ", "<span style=\"color: $color;\"><strong>AS </strong></span>", $newSql);
    $newSql = str_replace("ON ", "<span style=\"color: $color;\"><strong>ON </strong></span>", $newSql);
    $newSql = str_replace("ORDER BY ", "<br/><span style=\"color: $color;\"><strong>ORDER BY </strong></span>", $newSql);
    $newSql = str_replace("LIMIT ", "<br/><span style=\"color: $color;\"><strong>LIMIT </strong></span>", $newSql);
    $newSql = str_replace("OFFSET ", "<br/><span style=\"color: $color;\"><strong>OFFSET </strong></span>", $newSql);
    $newSql = str_replace("LIKE ", "<span style=\"color: $color;\"><strong>LIKE </strong></span>", $newSql);
    $newSql = str_replace("PRIMARY KEY", "<span style=\"color: $color;\"><strong>PRIMARY KEY</strong></span>", $newSql);
    $newSql = str_replace("REFERENCES ", "<span style=\"color: $color;\"><strong>REFERENCES </strong></span>", $newSql);
    $newSql = str_replace("INDEX ", "<span style=\"color: $color;\"><strong>INDEX </strong></span>", $newSql);
    $newSql = str_replace("CHECK ", "<span style=\"color: $color;\"><strong>CHECK </strong></span>", $newSql);
    $newSql = str_replace("SET ", "<br/><span style=\"color: $color;\"><strong>SET </strong></span>", $newSql);
    $newSql = str_replace(" AND ", "<br/><span style=\"color: $color;\"><strong>AND </strong></span>", $newSql);
    $newSql = str_replace(" OR ", "<br/><span style=\"color: $color;\"><strong>OR </strong></span>", $newSql);

    $newSql = str_replace(" NOT IN (", " <span style=\"color: $color;\"><strong>NOT IN </strong></span>(", $newSql);
    $newSql = str_replace(" NOT IN(", " <span style=\"color: $color;\"><strong>NOT IN</strong></span>(", $newSql);

    $newSql = str_replace(" IN (", " <span style=\"color: $color;\"><strong>IN </strong></span>(", $newSql);
    $newSql = str_replace(" IN(", " <span style=\"color: $color;\"><strong>IN</strong></span>(", $newSql);

    $newSql = str_replace("EXISTS (", "<span style=\"color: $color;\"><strong>EXISTS </strong></span>(", $newSql);
    $newSql = str_replace("EXISTS(", "<span style=\"color: $color;\"><strong>EXISTS</strong></span>(", $newSql);

    $newSql = str_replace("ALL (", "<span style=\"color: $color;\"><strong>ALL </strong></span>(", $newSql);
    $newSql = str_replace("ALL(", "<span style=\"color: $color;\"><strong>ALL</strong></span>(", $newSql);

    $newSql = str_replace("ANY (", "<span style=\"color: $color;\"><strong>ANY </strong></span>(", $newSql);
    $newSql = str_replace("ANY(", "<span style=\"color: $color;\"><strong>ANY</strong></span>(", $newSql);

    return $newSql;
  }

  static protected function geshiCall($matches, $default = '')
  {
    if (preg_match('/^\[(.+?)\]\s*(.+)$/s', $matches[1], $match))
    {
      if ($match[1] == 'sql')
      {
        return "<pre><code class=\"sql\">".self::highlightSql(array(html_entity_decode($match[2]))).'</code></pre>';
      } else if ($match[1] == 'yaml' || $match[1] == 'yml') {
        return self::highlightYaml($match[2]);
      } else if ($match[1] == 'php') {
        return self::getGeshi("<?php\n\n" . html_entity_decode($match[2]) . "\n?>", 'php');
      } else {
        return self::getGeshi(html_entity_decode($match[2]), $match[1]);
      }
    }
    else
    {
      if ($default)
      {
        return self::getGeshi(html_entity_decode($matches[1]), $default);
      }
      else
      {
        // Remove links for api
        $value = $matches[1];
        $value = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $value);
        return "<pre><code>".$value.'</code></pre>';
      }
    }
  }

  static protected function getGeshi($text, $language)
  {
    if ('html' == $language)
    {
      $language = 'html4strict';
    }

    $geshi = new GeSHi($text, $language);
    $geshi->enable_classes();

    // disable links on PHP functions, HTML tags, ...
    $geshi->enable_keyword_links(false);

    return @$geshi->parse_code();
  }
}
