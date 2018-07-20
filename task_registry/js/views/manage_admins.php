<?php ?>

<div class='template-header'>
    <h2><?php echo elgg_echo('tasks:manageadmin:title') ?></h2>
    <a href='#/tasks' class='elgg-button elgg-button-action'><?php echo elgg_echo('tasks:all:list'); ?></a>
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="col-sm-12">
            <h3><?php echo elgg_echo('tasks:manageadmin:typeusersname') ?></h3>
            <input type="text" ng-model="selected_user" uib-typeahead="user as user.name for user in vm.users | filter:$viewValue | limitTo:8" class="form-control" id="name">
        </div>
        <div class="col-sm-12 mrgn-bttm-md" ng-show="selected_user.id">
            <h2><?php echo elgg_echo('tasks:manageadmin:name') ?> {{selected_user.name}}</h2>
            <h2><?php echo elgg_echo('tasks:manageadmin:username') ?> {{selected_user.name}}</h2>
            <h2><?php echo elgg_echo('tasks:manageadmin:email') ?> {{selected_user.email}}</h2>
            <h2><?php echo elgg_echo('tasks:manageadmin:departments') ?>:</h2>
            <div ng-repeat="(key, val) in selected_user.department_owner track by $index">
                {{val}}
            </div>
        </div>
    </div>
    <div class="col-sm-6" ng-show="selected_user.id">
        <div class="col-sm-12 mrgn-bttm-md">
            <h3><?php echo elgg_echo('tasks:manageadmin:departments') ?></h3>
            <select class="lp-department-options-select" ng-model=vm.types ng-options='type for type in vm.department_options.values' multiple></select>
        </div>
        <div data-row-id="selected_user" ng-show="selected_user">
            <div class="col-sm-12">
                <a class='elgg-button elgg-button-action elgg-button-accept' ng-click="vm.addTaskAdmin(selected_user.id)"><?php echo elgg_echo('tasks:manageadmin:updatedepartments') ?></a>
            </div>
        </div>
    </div>
</div>
