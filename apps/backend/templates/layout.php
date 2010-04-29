<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />


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
              <?php echo $e[1]; ?>
            <?php elseif (isset($e[0])): ?>
              <?php echo $e[0]; ?>
            <?php endif; ?>
          <?php endif; ?>
        </h1>

      	<div id="logo">
      		<?php echo link_to('Doctrine - Backend', '@homepage'); ?>
      	</div>
      </div>

      <div id="nav" class="cls">
      	<div class="tl cls">
      	  <ul>
        	  <?php if ($sf_user->isAuthenticated()): ?>
              <li><?php echo link_to('Logout', '@logout', 'confirm=Are you sure?'); ?></li>
            <?php else: ?>
              <li><?php echo link_to('Login', '@login'); ?></li>
            <?php endif; ?>
      	  </ul>
      	</div>
      </div>

      <?php if ($sf_user->isAuthenticated()): ?>
        <?php slot('right') ?>
        <br/>
          <ul>
            <?php
            $modules = array(
              'Site Data' => array(
                'comments' => 'Comments',
                'blog_posts' => 'Blog',
                'contributors' => 'Contributors',
                'faqs' => 'Faqs',
              ),
              'Security' => array(
                'users' => 'Users',
                'groups' => 'Groups',
                'permissions' => 'Permissions',
              ),
            );
            ?>
            <?php foreach ($modules as $module => $name): ?>
              <?php if (is_array($name)): ?>
                <h3><?php echo $module ?></h3>

                <?php foreach ($name as $k => $v): ?>
                  <?php if ($sf_user->hasCredential($k)): ?>
                    <li><?php echo link_to($v, '@' . $k, array('class' => ($module == $sf_request->getParameter('module') ? 'current':null))); ?></li>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php else: ?>
                <?php if ($sf_user->hasCredential($module)): ?>
                  <li><?php echo link_to($name, '@' . $module, array('class' => ($module == $sf_request->getParameter('module') ? 'current':null))); ?></li>
                <?php endif; ?>
              <?php endif; ?>
            <?php endforeach; ?>
          </ul>
        <?php end_slot() ?>
      <?php endif; ?>

      <?php if (has_slot('top1') || has_slot('top1_left') || has_slot('top1_right')): ?>
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

            <?php if (has_slot('top1_right')): ?>
              <div id="top1_right">
                <?php echo get_slot('top1_right') ?>
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

    	<?php echo $sf_content ?>
    </div>

  	<div id="bot-rcnr">
  		<div class="tl"><!-- corner --></div>
  	</div>
  </div>

</body>
</html>