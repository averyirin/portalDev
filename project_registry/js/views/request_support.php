<?php ?>
<div class='template-header col-lg-12'>
    <h2><?php echo elgg_echo('projects:all'); ?></h2>

</div>
<section class='col-md-6'>

      <h2><?php echo elgg_echo('Create Task'); ?></h2>

    <div>Tasks are anything that is less than 80 hrs of work</div>
    <div class="btn-group">
        <a href='#/projects/create' class='elgg-button elgg-button-action float-right'><?php echo elgg_echo('projects:create'); ?></a>
          </div>
</section>
<section class='col-md-6 projects'>

      <h2><?php echo elgg_echo('Create Project'); ?></h2>
      <div>Projects are more than 80 hrs of work. Require scope, cost, time, and risk estimates</div>
      <a href='#/projects/requestSupport' class='elgg-button elgg-button-action float-right'><?php echo elgg_echo('Task/Project Support'); ?></a>



</section>
