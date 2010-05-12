<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />
<link rel="alternate" type="application/rss+xml" href="<?php echo url_for('@blog_feed'); ?>" title="Doctrine Blog RSS feed" />
<link rel="search" type="application/opensearchdescription+xml" title="Doctrine API Documentation" href="https://addons.mozilla.org/en-US/firefox/downloads/file/67525/doctrine_1.1_api-20091022.xml?confirmed">

<?php include_stylesheets() ?>
<?php include_javascripts() ?>
</head>
<body>

  <div id="wrapper">
    <?php if (!$sf_request->hasParameter('print')): ?>
      <div id="header">
        <h1 id="h1title">
          <?php if (has_slot('title')): ?>
            <?php echo get_slot('title') ?>
          <?php else: ?>
            <?php $e = explode(' - ', $sf_response->getTitle()) ?>
            <?php if (isset($e[1])): ?>
              <?php echo end($e); ?>
            <?php elseif (isset($e[0])): ?>
              <?php echo $e[0]; ?>
            <?php endif; ?>
          <?php endif; ?>
        </h1>

      	<div id="logo">
      		<?php echo link_to('Doctrine - PHP Database Libraries', '@homepage'); ?>
      	</div>
      </div>

      <div id="nav" class="cls">
      	<div class="tl cls">
      	  <?php echo get_partial('global/menu') ?>
      	</div>
      </div>

      <?php
      $projects = Project::getPrimaryProjects();
      foreach ($projects as $project)
      {
        if ($sf_request->getParameter('slug') == $project->getSlug())
        {
          $currentProject = $project;
        }
      }
      ?>
      <?php if (has_slot('top1') || has_slot('top1_left') || has_slot('top1_right') || isset($currentProject)): ?>
        <div id="top1">
          <div class="content">
            <?php if (has_slot('top1')): ?>
              <?php echo get_slot('top1') ?>
            <?php endif; ?>

            <?php if (has_slot('top1_left')): ?>
              <div id="top1_left">
                <?php echo get_slot('top1_left') ?>
              </div>
            <?php endif; ?>

            <?php if (has_slot('top1_right') || isset($currentProject)): ?>
              <div id="top1_right">
                <?php if (isset($currentProject)): ?>
                  <?php echo get_partial('global/project_menu', array('project' => $currentProject)) ?>
                <?php else: ?>
                  <?php echo get_slot('top1_right') ?>
                <?php endif; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>

      <?php if (has_slot('top2')): ?>
        <div id="top2">
          <div class="content">
            <?php echo get_slot('top2') ?>
          </div>
        </div>
      <?php endif; ?>
    <?php endif; ?>

    <div id="content" class="cls">
      <?php if (has_slot('right')): ?>
        <?php $sf_response->addStylesheet('layout_right', 'last'); ?>
      	<div id="sidebar">
          <div class="cls">
          	<div class="bd cls">
              <?php echo get_slot('right'); ?>
          	</div>
          	<div class="ft"><!-- foot --></div>
          </div>
      	</div>
      <?php endif; ?>

      <?php if ($sf_user->hasFlash('notice') || $sf_user->hasFlash('error')): ?>
        <div id="flash">
          <?php if ($sf_user->hasFlash('notice')): ?>
            <div class="notice"><?php echo $sf_user->getFlash('notice') ?></div>
          <?php endif; ?>

          <?php if ($sf_user->hasFlash('error')): ?>
            <div class="error"><?php echo $sf_user->getFlash('error') ?></div>
          <?php endif; ?>
        </div>

        <script type="text/javascript">
        var interval = setInterval(hideFlash, 10000);
        function hideFlash()
        {
      	   document.getElementById('flash').style.display = 'none';
        }
        </script>
      <?php endif; ?>

    	<?php echo $sf_content ?>
    </div>

	  <div id="bot-rcnr">
		  <div class="tl"><!-- corner --></div>
	  </div>

    <div id="footer">
      <br/>
      <?php echo link_to(image_tag('servergrove.jpg'), 'http://www.servergrove.com', 'target=_BLANK') ?>
    </div>
  </div>

<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-288343-7";
urchinTracker();
</script>

</body>
</html>