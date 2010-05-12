<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <style type="text/css">
    body { margin: 0; padding: 0; font:13px/1.231 "Lucida Grande",verdana,arial,helvetica,clean,sans-serif;*font-size:small;*font:x-small;}table {font-size:inherit;font:100%;}pre,code,kbd,samp,tt{font-family:monospace;*font-size:108%;line-height:100%;}

    a:link, a:visited, a:active { text-decoration:none; color:#3370C9; outline:none; border:0; }
    a:hover  { color: #00508c; text-decoration:underline; border:0; }
    
    ul {
      float: right;
    }
    ul, li, h3 {
      
      margin: 0;
      padding: 0;
    }
    h3 {
      float: left;
      padding: 6px;
      margin: 0;
    }
    ul {
      padding: 6px;
      margin: 0;
    }
    ul li {
      float: left;
      list-style-type: none;
      margin-right: 10px;
    }
    ul li a.current {
      font-weight: bold;
    }
    #menu {
      background-color: #F8FFBC;
      height: 35px;
    }
    #project_menu {
      background-color: #ccc;
      height: 30px;
    }
    #breadcrumb_trail {
      float: left;
      margin: 0;
      padding: 0;
      margin-left: 10px;
      padding-top: 8px;
    }
    #breadcrumb_trail li {
      list-style-type: none;
      margin: 0 !important;
      padding: 0 !important;
      text-indent: 20px;
      margin-right: 15px !important;
      float: left;
      background: url(http://www.doctrine-project.org/sf/sf_admin/images/next.png) no-repeat 0px -2px;
      line-height: 12px;
      font-size: 11px;
    }
    #breadcrumb_trail li a {
      font-weight: bold;
    }
    #logo {
      float: left;
      width: 50px;
      margin-top: 5px;
    }
  </style>
</head>
<body>
  <a href="<?php echo url_for('@homepage') ?>" target="_top"><img src="http://www.doctrine-project.org/logo/mediconlogo.png" id="logo" border="0" /></a>
  <h3>Doctrine <?php echo $project->getTitle() ?> API Documentation (<?php echo $version->getSlug() ?>)</h3>
  <div id="menu">  
    <?php echo get_partial('global/menu') ?>
  </div>
  <div id="project_menu">
    
    <ul id="breadcrumb_trail">
      <li><?php echo link_to('Home', '@homepage', array('target' => '_top')) ?></li>
      <li><?php echo link_to('Projects', '@projects', array('target' => '_top')) ?></li>
      <li><?php echo link_to($project->getTitle(), $project->getRoute(), array('target' => '_top')) ?></li>
      <li><?php echo link_to('Documentation', '@project_documentation?slug='.$project->getSlug().'&version='.$project->getLatestVersion()->getSlug(), array('target' => '_top')) ?></li>
      <li class="last">API Documentation</li>
    </ul>

    <?php echo get_partial('global/project_menu', array('project' => $project)) ?>
  </div>
</body>
</html>