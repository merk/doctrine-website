<?php use_helper('Date') ?>
<?php use_stylesheet('home') ?>

<h1>Welcome to the Doctrine Project</h1>

<p>
  The Doctrine Project is the home of a selected set of PHP libraries primarily
  focused on providing persistence services and related functionality. Its prize
  projects are a Object Relational Mapper and the Database Abstraction Layer
  it is built on top of. You can read more about the projects below or view a 
  list of all <?php echo link_to('projects', '@projects') ?>.
</p>

<div id="projects">
  <ul>
    <?php foreach ($projects as $project) :?>
      <?php echo get_partial('projects/row', array('project' => $project)) ?>
    <?php endforeach; ?>
  </ul>
</div>

<?php slot('right') ?>
  <h2>Latest Blog Posts</h2>

  <ul>
    <?php foreach ($blogPosts as $blogPost): ?>
      <li>
        <strong><?php echo link_to($blogPost->getName(), $blogPost->getRoute()) ?></strong>
        <br/><small>Posted on <?php echo format_date($blogPost->getCreatedAt()) ?></small>
      </li>
    <?php endforeach; ?>
  </ul>
  
  <h2>Trainings</h2>
  <?php echo get_component('main', 'trainings') ?>
<?php end_slot() ?>