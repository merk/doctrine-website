<?php use_stylesheet('documentation') ?>
<?php use_stylesheet('download') ?>

<ul id="breadcrumb_trail">
  <li><?php echo link_to('Home', '@homepage') ?></li>
  <li><?php echo link_to('Projects', '@projects') ?></li>
  <li><?php echo link_to($project->getTitle(), $project->getRoute()) ?></li>
  <li class="last">Download</li>
</ul>

<div id="download">
  <p>Browse the available versions below and click for more detail on how to download that version.</p>

  <?php foreach ($versions as $version) :?>
    <a name="<?php echo $version->getSlug() ?>"></a>
    <h3>Download <?php echo $version->getSlug() ?> (<?php echo $version->getStability() ?>)</h3>

    <?php if ($releases = $version->getReleases()): ?>
      <?php if ($command = $version->getSvnCheckoutCommand()): ?>
        <h5>Checkout from Subversion</h5>
        <pre class="command-line"><code>$ <?php echo $command ?></code></pre>
      <?php endif; ?>
      <?php if ($command = $version->getGitCheckoutCommand()): ?>
        <h5>Checkout from github</h5>
        <pre class="command-line"><code>$ <?php echo $command ?></code></pre>
      <?php endif; ?>
      
      <h5>Packages</h5>
      <ul>
        <?php foreach ($releases as $release): ?>
          <li><?php echo link_to('Download '.$release->getSlug().' Package', $release->getPackageLink()) ?> &nbsp; (<?php echo link_to('more download options', '@download_release?slug='.$project->getSlug().'&version='.$version->getSlug().'&release='.$release->getSlug()) ?>)</li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <?php if ($command = $version->getSvnCheckoutCommand()): ?>
        <h5>Checkout from Subversion</h5>
        <pre class="command-line"><code>$ <?php echo $command ?></code></pre>
      <?php endif; ?>
      <?php if ($command = $version->getGitCheckoutCommand()): ?>
        <h5>Checkout from github</h5>
        <pre class="command-line"><code>$ <?php echo $command ?></code></pre>
      <?php endif; ?>
    <?php endif; ?>
  <?php endforeach; ?>
</div>