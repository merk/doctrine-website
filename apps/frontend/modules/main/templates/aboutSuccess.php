<?php use_stylesheet('contributors.css') ?>
<?php use_helper('I18N', 'Contributor', 'Text'); ?>

<ul id="breadcrumb_trail">
  <li><?php echo link_to('Home', '@homepage', 'class=cms_page_navigation') ?></li>
  <li class="last">About</li>
</ul>

<h2>About the Doctrine Project</h2>

<p>The Doctrine Project is the home of a selected set of PHP libraries primarily
focused on providing persistence services and related functionality.</p>

<h2>Core Team</h2>

<div id="core_team">
  <?php foreach ($contributors as $contributor): ?>
    <div class="contributor_box">
      <?php echo contributor_photo($contributor); ?>
      <div class="info">
        <span class="name" title="<?php echo $contributor->getNick(); ?>"><?php echo $contributor->getName(); ?></span>
        <span class="role"><?php echo $contributor->getRole(); ?></span>
        <span class="about" id="<?php echo $contributor->getId(); ?>_about">
          <?php if ($about = $contributor->getAbout()): ?>
            <?php echo nl2br($about); ?>
          <?php endif; ?>
        </span>

        <?php if ($email = $contributor->getEmail()): ?>
          <span class="email">You can reach <?php echo $contributor->getNick(); ?> at <?php echo mail_to($email, $email); ?></span>
        <?php endif; ?>

        <?php if ( ! $contributor->getActive()): ?>
          <span class="inactive">In-Active</span>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<div id="other_contributors">
  <h2>Other Contributors</h2>
  <ul>
    <?php foreach ($otherContributors as $contributor): ?>
      <li>
        <?php echo $contributor->getName() ?> (<?php echo $contributor->getNick() ?>)
        <p><?php echo $contributor->getRole(); ?>. <?php echo $contributor->getAbout() ?></p>
      </li>
    <?php endforeach; ?>
  </ul>
</div>