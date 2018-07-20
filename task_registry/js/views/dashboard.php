<?php
?>
<div class='template-header col-lg-12'>
    <h2><?php echo elgg_echo('tasks:dashboard:title');?></h2>
    <div class="btn-group">
            <a href='#/tasks/create' class='elgg-button elgg-button-action'><?php echo elgg_echo('tasks:create');?></a>
            <a href='#/tasks' class='elgg-button elgg-button-action'><?php echo elgg_echo('tasks:all:list');?></a>
        </div>
</div>

<section class="col-lg-12">
    <div class='wb-tabs'>

        <ul role="tablist" class="generated">
            <li ng-repeat="filter in vm.filterTabs | orderBy:'title'" ng-class="{active:$first}">
                <a href='' ng-click="vm.filterTasks(filter.id); vm.toggleFilterTab($event);" id='all'>{{filter.title}}</a>
            </li>
        </ul>

        <div class="tabpanels">
            <div>
                <table class='data-table' datatable="ng" dt-options="vm.dtOptions">
                    <thead>
                        <tr>
                            <th><?php echo elgg_echo('tasks:departmentOwner'); ?></th>
                            <th><?php echo elgg_echo('tasks:title'); ?></th>
                            <th><?php echo elgg_echo('tasks:status'); ?></th>
                            <th><?php echo elgg_echo('tasks:percentage'); ?></th>
                            <th><?php echo elgg_echo('tasks:submittedBy'); ?></th>
                            <th><?php echo elgg_echo('tasks:dateSubmitted'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat='(key,task) in vm.tasks'>
                            <td>{{task.department_owner}}</td>
                            <td><a ng-click="vm.selectTask(task)" href="">{{task.title}}</a></td>
                            <td>{{task.status}}</td>
                            <td>{{task.percentage}}</td>
                            <td>{{task.owner}}</td>
                            <td>{{task.time_created}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>

<div class="full-screen" ng-if="vm.task">

    <section class="modal-screen typography">

        <h2>{{vm.task.title}}</h2>

        <div class="row">

            <div class="col-sm-4">
                <label><?php echo elgg_echo('tasks:description');?></label>
                <p>{{vm.task.description}}</p>
            </div>

            <div class="col-sm-4">
                <label><?php echo elgg_echo('tasks:description');?></label>
                <p>{{vm.task.investment}}</p>
            </div>

            <div class="col-sm-4">
                <label><?php echo elgg_echo('tasks:description');?></label>
                <p>{{vm.task.risk}}</p>
            </div>

        </div>

    </section>

</div>
