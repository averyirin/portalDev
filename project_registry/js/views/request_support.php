<?php ?>
<!--
Lang - projects:create:project
Add top nav buttons to go back to list of Projects
List of all tasks page
Create task form
-->
<div class='template-header col-lg-12'>
    <h2><?php echo elgg_echo('support_request:request_support'); ?></h2>
    <div class="btn-group">
        <a href='#/projects/projects' class='elgg-button elgg-button-action float-right'><?php echo elgg_echo('support_request:back'); ?></a>
      </div>
</div>

<section class='col-md-1'></section>
<section class='col-md-5'>

      <h1><?php echo elgg_echo('support_request:heading:task'); ?></h1>

    <div   style="min-height:120px">
      Tasks are anything that is less than 80 hours of work.<br/>
      Such as:
        <ul>
          <li>
            Modifying and image
          </li>
            <li>
              Editing section of course
            </li>

              <li>
                Photo op
              </li>

                <li>
                  Small video
                </li>

        </ul>
    </div>
    <a href='#/projects/create_task' style="margin-top:1em"  class='elgg-button elgg-button-action float-left'><?php echo elgg_echo('support_request:create:task'); ?></a>
</section>
<section class='col-md-5 projects'>

      <h1><?php echo elgg_echo('support_request:heading:project'); ?></h1>
      <div   style="min-height:120px">Projects are more than 80 hrs of work. Require scope, cost, time, and risk estimates</div>
      <a href='#/projects/create' style="margin-top:1em" class='elgg-button elgg-button-action float-left'><?php echo elgg_echo('support_request:create:project'); ?></a>



</section>
