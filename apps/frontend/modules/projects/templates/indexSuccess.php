<ul id="breadcrumb_trail">
  <li><?php echo link_to('Home', '@homepage') ?></li>
  <li class="last">Projects</li>
</ul>

<div id="projects">
  <ul>
    <?php foreach ($projects as $project) :?>
      <?php echo get_partial('projects/row', array('project' => $project)) ?>
    <?php endforeach; ?>
  </ul>
</div>