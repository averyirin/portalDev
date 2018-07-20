<?php

?>
<nav id="sidebar">
    <div>
        <h3><?php echo elgg_echo('tasks:filterByStatus'); ?></h3>
        <ul>
            <li>
                <a class="list-group-item active" href="" ng-click='vm.filter($event)' id="All" data-filter-type="status"><?php echo elgg_echo('tasks:label:all'); ?></a>
            </li>
            <li>
                <a class="list-group-item" href="" ng-click='vm.filter($event)' id="Submitted" data-filter-type="status"><?php echo elgg_echo('tasks:label:submitted'); ?></a>
            </li>
            <li>
                <a class="list-group-item" href="" ng-click='vm.filter($event)' id="Under Review" data-filter-type="status"><?php echo elgg_echo('tasks:label:underreview'); ?></a>
            </li>
            <li>
                <a class="list-group-item" href="" ng-click='vm.filter($event)' id="In Progress" data-filter-type="status"><?php echo elgg_echo('tasks:label:inprogress'); ?></a>
            </li>
            <li>
                <a class="list-group-item" href="" ng-click='vm.filter($event)' id="Completed" data-filter-type="status"><?php echo elgg_echo('tasks:label:completed'); ?></a>
            </li>
        </ul>
    </div>

    <div>
        <h3><?php echo elgg_echo('tasks:filterByDepartment'); ?></h3>
        <ul>
            <li>
                <a class="list-group-item active" href="" ng-click='vm.filter($event)' id="All" data-filter-type="department_owner"><?php echo elgg_echo('tasks:label:all'); ?></a>
            </li>
            <li>
                <a class="list-group-item" href="" ng-click='vm.filter($event)' id="Learning Technologies" data-filter-type="department_owner"><?php echo elgg_echo('tasks:owner:learning_technologies'); ?></a>
            </li>
            <li>
                <a class="list-group-item" href="" ng-click='vm.filter($event)' id="RCAF Learning Support Centre" data-filter-type="department_owner"><?php echo elgg_echo('tasks:owner:alsc'); ?></a>
            </li>
            <li>
                <a class="list-group-item" href="" ng-click='vm.filter($event)' id="Learning Support Centre" data-filter-type="department_owner"><?php echo elgg_echo('tasks:owner:lsc'); ?></a>
            </li>
            <li>
                <a class="list-group-item" href="" ng-click='vm.filter($event)' id="LT/LSC" data-filter-type="department_owner"><?php echo elgg_echo('tasks:owner:lt_lsc'); ?></a>
            </li>
            <li>
                <a class="list-group-item" href="" ng-click='vm.filter($event)' id="IT&E Modernization" data-filter-type="department_owner"><?php echo elgg_echo('tasks:owner:modernization'); ?></a>
            </li>
            <li>
                <a class="list-group-item" href="" ng-click='vm.filter($event)' id="IT&E Programmes" data-filter-type="department_owner"><?php echo elgg_echo('tasks:owner:programmes'); ?></a>
            </li>
            <li>
                <a class="list-group-item" href="" ng-click='vm.filter($event)' id="Unassigned" data-filter-type="department_owner"><?php echo elgg_echo('tasks:owner:unassigned'); ?></a>
            </li>
        </ul>
    </div>

    <div>
        <h3><?php echo elgg_echo('tasks:filterByType'); ?></h3>
        <ul>
            <li>
                <a class="list-group-item active" href="" ng-click='vm.filter($event)' id="All" data-filter-type="task_type"><?php echo elgg_echo('tasks:label:all'); ?></a>
            </li>
            <li>
                <a class="list-group-item" href="" ng-click='vm.filter($event)' id="Courseware" data-filter-type="task_type"><?php echo elgg_echo('tasks:types:courseware'); ?></a>
            </li>
            <li>
                <a class="list-group-item" href="" ng-click='vm.filter($event)' id="Enterprise Learning Applications" data-filter-type="task_type"><?php echo elgg_echo('tasks:types:enterprise_apps'); ?></a>
            </li>
            <li>
                <a class="list-group-item" href="" ng-click='vm.filter($event)' id="Instructor Support" data-filter-type="task_type"><?php echo elgg_echo('tasks:types:instructor_support'); ?></a>
            </li>
            <li>
                <a class="list-group-item" href="" ng-click='vm.filter($event)' id="Learning Application" data-filter-type="task_type"><?php echo elgg_echo('tasks:types:learning_application'); ?></a>
            </li>
            <li>
                <a class="list-group-item" href="" ng-click='vm.filter($event)' id="Learning Technologies" data-filter-type="task_type"><?php echo elgg_echo('tasks:types:learning_technologies'); ?></a>
            </li>
            <li>
                <a class="list-group-item" href="" ng-click='vm.filter($event)' id="Mobile" data-filter-type="task_type"><?php echo elgg_echo('tasks:types:mobile'); ?></a>
            </li>
            <li>
                <a class="list-group-item" href="" ng-click='vm.filter($event)' id="Modelling and Simulation" data-filter-type="task_type"><?php echo elgg_echo('tasks:types:modelling'); ?></a>
            </li>
            <li>
                <a class="list-group-item" href="" ng-click='vm.filter($event)' id="R and D" data-filter-type="task_type"><?php echo elgg_echo('tasks:types:rnd'); ?></a>
            </li>
            <li>
                <a class="list-group-item" href="" ng-click='vm.filter($event)' id="Serious Gaming" data-filter-type="task_type"><?php echo elgg_echo('tasks:types:gaming'); ?></a>
            </li>
            <li>
                <a class="list-group-item" href="" ng-click='vm.filter($event)' id="Support" data-filter-type="task_type"><?php echo elgg_echo('tasks:types:support'); ?></a>
            </li>
        </ul>
    </div>

</nav>
