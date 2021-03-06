<?php ?>
<div class='template-header col-lg-12'>
    <h2><?php echo elgg_echo('projects:all'); ?></h2>
    <div class="btn-group">
        <a href='#/projects/request_support' class='elgg-button elgg-button-action float-right'><?php echo elgg_echo('projects:create'); ?></a>

        <a ng-if="user.project_admin" href='#/projects/dashboard' class='elgg-button elgg-button-action'><?php echo elgg_echo('projects:dashboard'); ?></a>
        <a ng-if="user.project_admin" href='#/projects/manage_admins' class='elgg-button elgg-button-action float-left'><?php echo elgg_echo('projects:manageadmin:addadmin'); ?></a>
        <!-- <a ng-if="user.project_admin" ng-click='vm.printAll("DRT 5.1")' href='' class='elgg-button elgg-button-action'>Print All DRT 5.1</a> -->
    </div>
</div>
<section class='col-md-3'>
    <div ng-include="'projects/sidebar'"</div>
</section>
<section class='col-md-9 projects'>
  <!-- Tab Test
  <div class='wb-tabs'>
      <ul role="tablist" class="generated">
          <li class="active"><a href='' ng-click='vm.filter($event)' data-filter-type="owner_guid" id='all'><?php echo elgg_echo('Projects'); ?></a></li>
          <li><a href='' ng-click="vm.filter($event)" data-filter-type="owner_guid" id='mine'><?php echo elgg_echo('Tasks'); ?></a></li>
      </ul>

    </div>
    <div class="wb-tabs">
   -->
   <div class='wb-tabs'>
     <ul role="tablist" class="generated">
         <li class="active"><a href='' ng-click='vm.filter($event)' data-filter-type="classification" id='All'><?php echo elgg_echo('projects:label:all'); ?></a></li>
         <li><a href='' ng-click="vm.filter($event)" data-filter-type="classification" id='Project'><?php echo elgg_echo('Projects'); ?></a></li>
         <li><a href='' ng-click="vm.filter($event)" data-filter-type="classification" id='Task'><?php echo elgg_echo('Task'); ?></a></li>
         <li><a href='' ng-click="vm.filter($event)" data-filter-type="classification" id='Unassigned'><?php echo elgg_echo('Unassigned'); ?></a></li>
   </ul>
       <div class="tabpanels">
           <div style="padding:0.5rem">
             <div class='wb-tabs'>
                 <ul role="tablist" class="generated">
                     <li class="active"><a href='' ng-click='vm.filter($event)' data-filter-type="owner_guid" id='all'><?php echo elgg_echo('projects:label:all'); ?></a></li>
                     <li><a href='' ng-click="vm.filter($event)" data-filter-type="owner_guid" id='mine'><?php echo elgg_echo('projects:label:mine'); ?></a></li>
                 </ul>
                 <div class="tabpanels">
                     <div>
                         <table class='data-table' datatable="ng" dt-options="vm.dtOptions">
                             <thead>
                                 <tr>
                                     <th><?php echo elgg_echo('projects:title'); ?></th>
                                     <th><?php echo elgg_echo('projects:status'); ?></th>
                                     <th><?php echo elgg_echo('projects:submittedBy'); ?></th>
                                     <th><?php echo elgg_echo('projects:dateSubmitted'); ?></th>
                                     <th><?php echo elgg_echo('projects:departmentOwner'); ?></th>
                                     <th><?php echo elgg_echo('projects:actions'); ?></th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <tr ng-repeat='(key,project) in vm.projects'>
                                    <td ng-if="project.classification == 'Task'">
                                       <a  href='#/projects/view_task/{{project.id}}'>{{project.title}}</a>
                                        </td>
                                    <td ng-if="project.classification !== 'Task'">
                                       <a   href='#/projects/view/{{project.id}}'>{{project.title}}</a>
                                    </td>

                                     <td>
                                         <select id='statusSelect{{key}}' ng-if="user.project_admin" ng-model='project.status' ng-options='status.name as status.name for status in vm.statuses' ng-change='vm.updateStatus(key)'></select>

                                         <span ng-if="!user.project_admin">{{project.status}}</span>
                                     </td>
                                     <td>{{project.owner}}</td>
                                     <td>{{project.time_created}}</td>
                                     <td>{{project.department_owner}}</td>
                                     <td style="text-align: center;">
                                         <a href="#/projects/view/{{project.id}}" class='glyphicon edit-button action-item' ng-if='project.can_edit'></a>
                                         <a class="glyphicon delete-button action-item" ng-if="project.can_edit" ng-click='vm.deleteProject(project.id, key)' ng-delete-once="<?php echo elgg_echo('projects:deleteConfirm'); ?>"></a>
                                     </td>
                                 </tr>
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
           </div>
       </div>
     </div>



</section>
