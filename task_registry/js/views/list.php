<?php ?>
<div class='template-header col-lg-12'>
    <h2><?php echo elgg_echo('tasks:all'); ?></h2>
    <div class="btn-group">
        <a href='#/tasks/create' class='elgg-button elgg-button-action float-right'><?php echo elgg_echo('tasks:create'); ?></a>
        <a ng-if="user.task_admin" href='#/tasks/dashboard' class='elgg-button elgg-button-action'><?php echo elgg_echo('tasks:dashboard'); ?></a>
        <a ng-if="user.task_admin" href='#/tasks/manage_admins' class='elgg-button elgg-button-action float-left'><?php echo elgg_echo('tasks:manageadmin:addadmin'); ?></a>
        <!-- <a ng-if="user.task_admin" ng-click='vm.printAll("DRT 5.1")' href='' class='elgg-button elgg-button-action'>Print All DRT 5.1</a> -->
    </div>
</div>
<section class='col-md-3'>
    <div ng-include="'tasks/sidebar'"</div>
</section>
<section class='col-md-9 tasks'>
    <div class='wb-tabs'>
        <ul role="tablist" class="generated">
            <li class="active"><a href='' ng-click='vm.filter($event)' data-filter-type="owner_guid" id='all'><?php echo elgg_echo('tasks:label:all'); ?></a></li>
            <li><a href='' ng-click="vm.filter($event)" data-filter-type="owner_guid" id='mine'><?php echo elgg_echo('tasks:label:mine'); ?></a></li>
        </ul>
        <div class="tabpanels">
            <div>
                <table class='data-table' datatable="ng" dt-options="vm.dtOptions">
                    <thead>
                        <tr>
                            <th><?php echo elgg_echo('tasks:title'); ?></th>
                            <th><?php echo elgg_echo('tasks:status'); ?></th>
                            <th><?php echo elgg_echo('tasks:submittedBy'); ?></th>
                            <th><?php echo elgg_echo('tasks:dateSubmitted'); ?></th>
                            <th><?php echo elgg_echo('tasks:departmentOwner'); ?></th>
                            <th><?php echo elgg_echo('tasks:actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='(key,task) in vm.tasks'>
                            <td><a href='#/tasks/view/{{task.id}}'>{{task.title}}</a></td>
                            <td>
                                <select id='statusSelect{{key}}' ng-if="user.task_admin" ng-model='task.status' ng-options='status.name as status.name for status in vm.statuses' ng-change='vm.updateStatus(key)'></select>

                                <span ng-if="!user.task_admin">{{task.status}}</span>
                            </td>
                            <td>{{task.owner}}</td>
                            <td>{{task.time_created}}</td>
                            <td>{{task.department_owner}}</td>
                            <td style="text-align: center;">
                                <a href="#/tasks/view/{{task.id}}" class='glyphicon edit-button action-item' ng-if='task.can_edit'></a>
                                <a class="glyphicon delete-button action-item" ng-if="task.can_edit" ng-click='vm.deleteTask(task.id, key)' ng-delete-once="<?php echo elgg_echo('tasks:deleteConfirm'); ?>"></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
