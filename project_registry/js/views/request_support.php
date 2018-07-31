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
        <a href='#/projects/projects' class='elgg-button elgg-button-action float-right'><?php echo elgg_echo('projects:all:list'); ?></a>
      </div>
</div>

<section class='col-md-1'></section>
<section class='col-md-4'>
  <div class='row form-row' data-row-id="title">
      <div class='col-sm-12 field-header' style="text-align:center;" >
          <label><?php echo elgg_echo('support_request:heading:task'); ?></label>
      </div>
      <div class='col-sm-12 field-body'>
        <div >
          Tasks are anything that is less than 80 hours of work.<br/>
          Such as:
            <ul>
              <li>Modifying and image</li>
              <li>Editing section of course</li>
              <li>Photo op</li>
              <li>Small video</li>
            </ul>
        </div>
        <a href='#/projects/create_task'  class='elgg-button elgg-button-action'><?php echo elgg_echo('support_request:create:task'); ?></a>
      </div>
  </div>
</section>
<section class='col-md-1'></section>
<section class='col-md-4 projects'>

    <div class='row form-row' data-row-id="title">
        <div class='col-sm-12 field-header' style="text-align:center;" >
            <label><?php echo elgg_echo('support_request:heading:project'); ?></label>
        </div>
        <div class='col-sm-12 field-body'>
          <div>
            Projects are more than 80 hrs of work. Require scope, cost, time, and risk estimates
          </div>
        </div>
        <div class='col-sm-12 field-body' style="text-align:center;">
          <a href='#/projects/create' class='elgg-button elgg-button-action'><?php echo elgg_echo('support_request:create:project'); ?></a>
        </div>
    </div>
</section>
