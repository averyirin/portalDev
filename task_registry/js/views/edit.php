<?php ?>
<div ng-show='vm.loaded'>
    <div class='template-header'>
        <h2>Edit Task - {{vm.title}}</h2>
        <a href='#/tasks' class='elgg-button elgg-button-action'><?php echo elgg_echo('tasks:all:list'); ?></a>
    </div>
    <div class='task-form task'>
        <form name='taskForm' ng-submit="vm.editTask(taskForm.$valid)" ng-focus-error="" novalidate>
            <div class='row form-row'>
                <div class='col-md-3'>
                    <label><?php echo elgg_echo('tasks:title'); ?></label>
                </div>
                <div class='col-md-6'>
                    <input type='text' class='' name='title' ng-model='vm.title' required />
                    <div ng-messages="taskForm.title.$error" ng-if="(taskForm.title.$dirty) || (taskForm.$submitted)">
                        <div ng-messages-include="tasks/messages"></div>
                    </div>
                </div>
            </div>
            <div class='row form-row'>
                <div class='col-md-3'>
                    <label><?php echo elgg_echo('tasks:course'); ?></label>
                </div>
                <div class='col-md-6'>
                    <input type='text' class='' name='course' ng-model='vm.course' />
                </div>
            </div>
            <div class='row form-row'>
                <div class='col-md-3'>
                    <label><?php echo elgg_echo('tasks:org'); ?></label>
                </div>
                <div class='col-md-6'>
                    <input type='text' class='' name='org' ng-model='vm.org' required />
                    <div ng-messages="taskForm.org.$error" ng-if="(taskForm.org.$dirty) || (taskForm.$submitted)">
                        <div ng-messages-include="tasks/messages"></div>
                    </div>
                </div>
            </div>
            <div class='row form-row'>
                <div class='col-md-3'>
                    <label><?php echo elgg_echo('tasks:type'); ?></label>
                </div>
                <div class='col-md-6'>
                    <select ng-model=vm.task.task_type ng-options='type for type in vm.taskTypes.values'>
                    </select>
                </div>
            </div>
            <div class='row form-row'>
                <div class='col-md-3'>
                    <label><?php echo elgg_echo('tasks:description'); ?></label>
                </div>
                <div class='col-md-6'>
                    <textarea name='description' ng-model='vm.description' ng-minlength='3' ng-maxlength='500' required></textarea>
                    <div ng-messages="taskForm.description.$error" ng-if="(taskForm.description.$dirty) || (taskForm.$submitted)">
                        <div ng-messages-include="tasks/messages"></div>
                    </div>
                </div>
            </div>
            <div class='row form-row'>
                <div class='col-md-3'>
                    <label><?php echo elgg_echo('tasks:scope'); ?></label>
                </div>
                <div class='col-md-6'>
                    <textarea name='scope' ng-model='vm.scope' required></textarea>
                    <div ng-messages="taskForm.scope.$error" ng-if="(taskForm.scope.$dirty) || (taskForm.$submitted)">
                        <div ng-messages-include="tasks/messages"></div>
                    </div>
                </div>
            </div>
            <div class='row form-row'>
                <div class='col-md-3'>
                    <label><?php echo elgg_echo('tasks:opi'); ?></label>
                </div>
                <div class='col-md-6 row sub-row'>
                    <div class='col-lg-12'>
                        <div ng-repeat='(key, opi) in vm.opis'>
                            <div class='col-lg-12 row'>
                                <h5><?php echo elgg_echo('tasks:opi:title'); ?> {{key + 1}}</h5>
                                <button class='elgg-button elgg-button-action form-btn' ng-click='vm.removeContact(key)'><?php echo elgg_echo('tasks:removeContact'); ?></button>
                            </div>

                            <div class='row'>
                                <div class='col-md-3'>
                                    <label><?php echo elgg_echo('tasks:rank'); ?>:</label>
                                </div>
                                <div class='col-md-9'>
                                    <input type='text' class='' name='opi_rank' ng-model='opi.rank' required />
                                    <div ng-messages="taskForm.opi_rank.$error" ng-if="(taskForm.opi_rank.$dirty) || (taskForm.$submitted)">
                                        <div ng-messages-include="tasks/messages"></div>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-3'>
                                    <label><?php echo elgg_echo('tasks:name'); ?>:</label>
                                </div>
                                <div class='col-md-9'>
                                    <input type='text' name='opi_name' class='' ng-model='opi.name' required />
                                    <div ng-messages="taskForm.opi_name.$error" ng-if="(taskForm.opi_name.$dirty) || (taskForm.$submitted)">
                                        <div ng-messages-include="tasks/messages"></div>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-3'>
                                    <label><?php echo elgg_echo('tasks:phone'); ?>:</label>
                                </div>
                                <div class='col-md-9'>
                                    <input type='text' name='opi_phone' class='' ng-model='opi.phone' required />
                                    <div ng-messages="taskForm.opi_phone.$error" ng-if="(taskForm.opi_phone.$dirty) || (taskForm.$submitted)">
                                        <div ng-messages-include="tasks/messages"></div>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-md-3'>
                                    <label><?php echo elgg_echo('tasks:email'); ?>:</label>
                                </div>
                                <div class='col-md-9'>
                                    <input type='email' name='opi_email' class='' ng-model='opi.email' required />
                                    <div ng-messages="taskForm.opi_email.$error" ng-if="(taskForm.opi_email.$dirty) || (taskForm.$submitted)">
                                        <div ng-messages-include="tasks/messages"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-12 row'>
                            <a class='elgg-button elgg-button-action' ng-click='vm.addContact()'><?php echo elgg_echo('tasks:addContact'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class='row form-row'>
                <div class='col-md-3'>
                    <label><?php echo elgg_echo('tasks:isPriority'); ?></label>
                </div>
                <div class='col-md-6'>
                    <select ng-model='vm.isPriority' ng-options='option for option in vm.booleanOptions.values' ng-change=vm.toggleContainer(vm.isPriority, 'briefExplain')></select>
                </div>
            </div>
            <div class='row form-row' id='briefExplain' ng-hide='vm.isPriority == vm.booleanOptions.values[0]'>
                <div class='col-md-3'>
                    <label><?php echo elgg_echo('tasks:briefExplain'); ?></label>
                </div>
                <div class='col-md-6'>
                    <textarea ng-model='vm.priority' value='{{vm.task.priority}}'></textarea>
                </div>
            </div>
            <div class='row form-row'>
                <div class='col-md-3'>
                    <label><?php echo elgg_echo('tasks:isSme'); ?></label>
                </div>
                <div class='col-md-6'>
                    <select ng-model='vm.isSme' ng-options='option for option in vm.booleanOptions.values' ng-change=vm.toggleContainer(vm.isSme, 'sme')></select>
                </div>
            </div>
            <div class='row form-row' id='sme' ng-hide='vm.isSme == vm.booleanOptions.values[0]'>
                <div class='col-md-3'>
                    <label><?php echo elgg_echo('tasks:sme'); ?></label>
                </div>
                <div class='col-md-6 sub-row'>
                    <div class='row'>
                        <div class='col-md-3'>
                            <label><?php echo elgg_echo('tasks:rank'); ?>:</label>
                        </div>
                        <div class='col-md-9'>
                            <input type='text' class='' ng-model='vm.task.sme.rank' />
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-3'>
                            <label><?php echo elgg_echo('tasks:name'); ?>:</label>
                        </div>
                        <div class='col-md-9'>
                            <input type='text' class='' ng-model='vm.task.sme.name' />
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-3'>
                            <label><?php echo elgg_echo('tasks:phone'); ?>:</label>
                        </div>
                        <div class='col-md-9'>
                            <input type='text' class='' ng-model='vm.task.sme.phone' />
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-3'>
                            <label><?php echo elgg_echo('tasks:email'); ?>:</label>
                        </div>
                        <div class='col-md-9'>
                            <input type='email' name='sme_email' class='' ng-model='vm.task.sme.email' />
                            <div ng-messages="taskForm.sme_email.$error" ng-if="(taskForm.sme_email.$dirty) || (taskForm.$submitted)">
                                <div ng-messages-include="tasks/messages"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class='row form-row'>
                <div class='col-md-3'>
                    <label><?php echo elgg_echo('tasks:isLimitation'); ?></label>
                </div>
                <div class='col-md-6'>
                    <select ng-model='vm.task.is_limitation' ng-options='option for option in vm.booleanOptions.values'></select>
                </div>
            </div>

            <div class='row form-row'>
                <div class='col-md-3'>
                    <label><?php echo elgg_echo('tasks:updateExistingProduct'); ?></label>
                </div>
                <div class='col-md-6'>
                    <select ng-model='vm.task.update_existing_product' ng-options='option for option in vm.multiOptions.values'></select>
                </div>
            </div>

            <div class='row form-row'>
                <div class='col-md-3'>
                    <label><?php echo elgg_echo('tasks:lifeExpectancy'); ?></label>
                </div>
                <div class='col-md-6'>
                    <input type='text' name='lifeExpectancy' ng-model='vm.lifeExpectancy' />
                </div>
            </div>

            <div class='row form-row'>
                <div class='col-md-3'>
                    <label><?php echo elgg_echo('tasks:usa'); ?></label>
                </div>
                <div class='col-md-6 sub-row'>
                    <div class='row'>
                        <div class='col-md-3'>
                            <label><?php echo elgg_echo('tasks:rank'); ?>:</label>
                        </div>
                        <div class='col-md-9'>
                            <p>{{vm.task.usa.rank}}</p>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-3'>
                            <label><?php echo elgg_echo('tasks:name'); ?>:</label>
                        </div>
                        <div class='col-md-9'>
                            <p>{{vm.task.usa.name}}</p>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-3'>
                            <label><?php echo elgg_echo('tasks:position'); ?>:</label>
                        </div>
                        <div class='col-md-9'>
                            <p>{{vm.task.usa.position}}</p>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-3'>
                            <label><?php echo elgg_echo('tasks:email'); ?>:</label>
                        </div>
                        <div class='col-md-9'>
                            <p>{{vm.task.usa.email}}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class='row form-row'>
                <div class='col-md-3'>
                    <label><?php echo elgg_echo('tasks:comments'); ?></label>
                </div>
                <div class='col-md-6'>
                    <textarea ng-model='vm.comments'></textarea>
                </div>
            </div>

            <div class='row form-row'>
                <div class='col-md-3'>
                    <label><?php echo elgg_echo('tasks:files'); ?></label>
                </div>
                <div class='col-md-6'>
                    <div class='elgg-button' ngf-select ng-model='vm.files' ngf-multiple='true'>Select</div>
                    Drop files: <div ngf-drop ng-model='files'>Drop</div>
                </div>
            </div>

            <button type='submit' class='elgg-button elgg-button-action'><?php echo elgg_echo('tasks:save'); ?></button>
        </form>
    </div>
</div>
