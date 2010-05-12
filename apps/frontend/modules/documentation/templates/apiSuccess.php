<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>Doctrine <?php echo $project->getTitle() ?> API Documentation (<?php echo $version->getSlug() ?>)</title>
  <frameset cols="100%">

  <frameset rows="65, 100%">
    <frame src="<?php echo url_for('@project_api_documentation_navigation?slug='.$project->getSlug().'&version='.$version->getSlug()) ?>" name="navigation" scrolling="no" frameborder="0">
    <frame src="<?php echo $sf_request->getRelativeUrlRoot() ?>/api/<?php echo $project->getSlug() ?>/<?php echo $version->getSlug() ?>/index.html" name="apidocs" frameborder="0">
  </frameset>

  <noframes>
      <body>
          <h2>Frame Alert</h2>
          <p>This document is designed to be viewed using frames. If you see this message, you are using a non-frame-capable browser.<br>
          Link to <a href="overview-summary.html">Non-frame version</a>.</p>
      </body>
  </noframes>

  </frameset>
</head>
<body>
</body>
</html>