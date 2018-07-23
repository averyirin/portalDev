<?php ?>
<div class='template-header col-lg-12'>
    <h2><?php echo elgg_echo('support_request:request_support'); ?></h2>

</div>

<section class='col-md-1'></section>
<section class='col-md-5'>

      <h1><?php echo elgg_echo('support_request:heading:task'); ?></h1>

    <div>
      Tasks are anything that is less than 80 hours of work.

    </div>
    <a href='#/projects/create_task' style="margin-top:1em"  class='elgg-button elgg-button-action float-left'><?php echo elgg_echo('support_request:create:task'); ?></a>
</section>
<section class='col-md-5 projects'>

      <h1><?php echo elgg_echo('support_request:heading:project'); ?></h1>
      <div>Projects are more than 80 hrs of work. Require scope, cost, time, and risk estimates</div>
      <a href='#/projects/create' style="margin-top:1em" class='elgg-button elgg-button-action float-left'><?php echo elgg_echo('projects:create:project'); ?></a>



</section>
