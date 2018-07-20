<?php ?>
<div class='template-header'>
    <h2><?php echo elgg_echo('tasks:add'); ?></h2>
    <a href='#/tasks' class='elgg-button elgg-button-action'><?php echo elgg_echo('tasks:all:list'); ?></a>
</div>
<div class="row">
    <div class="col-sm-4">
        <div ng-include="'tasks/toc'">
        </div>
    </div>
    <div class='task-form task col-sm-7'>
        <form name='taskForm' ng-submit="vm.createTask(taskForm.$valid)" ng-focus-error="" novalidate>
            <div class='row form-row' data-row-id="title">
                <div class='col-sm-12 field-header'>
                    <label><?php echo elgg_echo('tasks:title'); ?></label>
                </div>

                <div class='col-sm-12 field-body'>
                    <input type='text' class='' name='title' ng-model='vm.task.title' required/>
                    <div ng-messages="taskForm.title.$error" ng-if="(taskForm.title.$touched) || (taskForm.$submitted)">
                        <div ng-messages-include="tasks/messages"></div>
                    </div>
                </div>
            </div>
            <div class='row form-row' data-row-id="course">
                <div class='col-sm-12 field-header'>
                    <label><?php echo elgg_echo('tasks:course'); ?></label>
                </div>
                <div class='col-sm-12 field-body'>
                    <input type='text' class='' name='course' ng-model='vm.task.course'/>
                </div>
            </div>
            <div class='row form-row' data-row-id="org">
                <div class='col-sm-12 field-header'>
                    <label><?php echo elgg_echo('tasks:org'); ?></label>
                </div>
                <div class='col-sm-12 field-body'>
                    <input type='text' class='' name="org" ng-model='vm.task.org' required/>
                    <div ng-messages="taskForm.org.$error" ng-if="(taskForm.org.$touched) || (taskForm.$submitted)">
                        <div ng-messages-include="tasks/messages"></div>
                    </div>
                </div>
            </div>
            <div class='row form-row' data-row-id="ta">
                <div class='col-sm-12 field-header'>
                    <label><?php echo elgg_echo('tasks:ta'); ?></label>
                </div>
                <div class='col-sm-12 field-body'>
                    <select ng-model='vm.task.ta' ng-options='option for option in vm.ta_options.values' ng-change='vm.setDepartmentOwner(vm.task.ta)' required></select>
                    <div ng-messages="taskForm.scope.$error" ng-if="(taskForm.$submitted)">
                        <div ng-messages-include="tasks/messages"></div>
                    </div>
                </div>
            </div>
            <div class='row form-row' data-row-id="type">
                <div class='col-sm-12 field-header'>
                    <label>Department Owner</label>
                </div>
                <div class='col-sm-12 field-body'>
                    <input type='text' class='' name='department_owner' ng-model='vm.task.department_owner' disabled="disabled"/>
                </div>
            </div>
            <div class='row form-row' data-row-id="type">
                <div class='col-sm-12 field-header'>
                    <label><?php echo elgg_echo('tasks:type'); ?></label>
                </div>
                <div class='col-sm-12 field-body'>
                    <select ng-model=vm.task.task_type ng-options='type for type in vm.taskTypes.values'>
                    </select>
                </div>
            </div>
            <div class='row form-row' data-row-id="description">
                <div class='col-sm-12 field-header'>
                    <label><?php echo elgg_echo('tasks:description'); ?></label>
                    <p><?php echo elgg_echo('tasks:description:helptext'); ?></p>
                </div>
                <div class='col-sm-12 field-body'>
                    <textarea mce-init="description" id="description" name='description' ng-model='vm.task.description'></textarea>
                </div>
            </div>
            <div class='row form-row' data-row-id="scope">
                <div class='col-sm-12 field-header'>
                    <label><?php echo elgg_echo('tasks:scope'); ?></label>
                    <div class="help-text">
                        <p><?php echo elgg_echo('tasks:scope:helptext:header'); ?></p>
                        <ul>
                            <li><?php echo elgg_echo('tasks:scope:helptext:listItem1'); ?></li>
                            <li><?php echo elgg_echo('tasks:scope:helptext:listItem2'); ?></li>
                            <li><?php echo elgg_echo('tasks:scope:helptext:listItem3'); ?></li>
                            <li><?php echo elgg_echo('tasks:scope:helptext:listItem4'); ?></li>
                            <li><?php echo elgg_echo('tasks:scope:helptext:listItem5'); ?></li>
                            <li><?php echo elgg_echo('tasks:scope:helptext:listItem6'); ?></li>
                            <li><?php echo elgg_echo('tasks:scope:helptext:listItem7'); ?></li>
                        </ul>
                    </div>
                </div>
                <div class='col-sm-12 field-body'>
                    <textarea name="scope" ng-model='vm.task.scope' required></textarea>
                    <div ng-messages="taskForm.scope.$error" ng-if="(taskForm.scope.$touched) || (taskForm.$submitted)">
                        <div ng-messages-include="tasks/messages"></div>
                    </div>
                </div>
            </div>
            <div class='row form-row' data-row-id="opi">
                <div class='col-sm-12 field-header'>
                    <label><?php echo elgg_echo('tasks:opi'); ?></label>
                    <div class="help-text">
                        <p><?php echo elgg_echo('tasks:opi:helptext'); ?></p>
                    </div>
                </div>
                <div class='col-lg-12'>
                    <div class='col-lg-12 field-body'>
                        <div class='row form-row' ng-repeat='(key, opi) in vm.opis'>

                            <div class='col-sm-12 field-header'>
                                <h5><?php echo elgg_echo('tasks:opi:title'); ?> {{key + 1}}</h5>
                                <a class='glyphicon remove-button' ng-click='vm.removeContact(key)'></a>
                            </div>

                            <div class='col-sm-12 field-body'>
                                <div class='row'>
                                    <div class='col-sm-3'>
                                        <label><?php echo elgg_echo('tasks:rank'); ?>:</label>
                                    </div>
                                    <div class='col-sm-9'>
                                        <input type='text' class='' name='opi_rank' ng-model='opi.rank' required/>
                                        <div ng-messages="taskForm.opi_rank.$error" ng-if="(taskForm.opi_rank.$touched) || (taskForm.$submitted)">
                                            <div ng-messages-include="tasks/messages"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-sm-3'>
                                        <label><?php echo elgg_echo('tasks:name'); ?>:</label>
                                    </div>
                                    <div class='col-sm-9'>
                                        <input type='text' class='' name='opi_name' ng-model='opi.name' required/>
                                        <div ng-messages="taskForm.opi_name.$error" ng-if="(taskForm.opi_name.$touched) || (taskForm.$submitted)">
                                            <div ng-messages-include="tasks/messages"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-sm-3'>
                                        <label><?php echo elgg_echo('tasks:phone'); ?>:</label>
                                    </div>
                                    <div class='col-sm-9'>
                                        <input type='text' class='' name='opi_phone' ng-model='opi.phone' required/>
                                        <div ng-messages="taskForm.opi_phone.$error" ng-if="(taskForm.opi_phone.$touched) || (taskForm.$submitted)">
                                            <div ng-messages-include="tasks/messages"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-sm-3'>
                                        <label><?php echo elgg_echo('tasks:email'); ?>:</label>
                                    </div>
                                    <div class='col-sm-9'>
                                        <input type='email' class='' name='opi_email' ng-model='opi.email' required/>
                                        <div ng-messages="taskForm.opi_email.$error" ng-if="(taskForm.opi_email.$touched) || (taskForm.$submitted)">
                                            <div ng-messages-include="tasks/messages"></div>
                                        </div>
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
            <div class='row form-row' data-row-id="priority">
                <div class='col-lg-12 field-header'>
                    <label><?php echo elgg_echo('tasks:briefExplain'); ?></label>
                    <div class="help-text">
                        <p><?php echo elgg_echo('tasks:briefExplain:helptext:header'); ?></p>
                        <ul>
                            <li><?php echo elgg_echo('tasks:briefExplain:helptext:listItem1'); ?></li>
                            <li><?php echo elgg_echo('tasks:briefExplain:helptext:listItem2'); ?></li>
                            <li><?php echo elgg_echo('tasks:briefExplain:helptext:listItem3'); ?>
                                <ol>
                                    <li><?php echo elgg_echo('tasks:briefExplain:helptext:subListItem1'); ?></li>
                                    <li><?php echo elgg_echo('tasks:briefExplain:helptext:subListItem2'); ?></li>
                                    <li><?php echo elgg_echo('tasks:briefExplain:helptext:subListItem3'); ?></li>
                                    <li><?php echo elgg_echo('tasks:briefExplain:helptext:subListItem4'); ?></li>
                                    <li><?php echo elgg_echo('tasks:briefExplain:helptext:subListItem5'); ?></li>
                                </ol>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class='col-lg-12 field-body'>
                    <textarea ng-model='vm.task.priority'></textarea>
                </div>
            </div>
            <div class='row form-row' data-row-id="sme">
                <div class='col-lg-12 field-header'>
                    <label><?php echo elgg_echo('tasks:isSme'); ?></label>
                </div>
                <div class='col-lg-12 field-body'>
                    <select ng-model='vm.task.is_sme_avail' ng-options='option for option in vm.booleanOptions.values'></select>

                    <div class='col-lg-12' id='sme' ng-show=vm.boolOption(vm.task.is_sme_avail)>
                        <div class='row form-row'>
                            <div class='col-lg-12 field-header'>
                                <label><?php echo elgg_echo('tasks:sme'); ?></label>
                            </div>

                            <div class='col-sm-12 field-body'>
                                <div class='row'>
                                    <div class='col-sm-3'>
                                        <label><?php echo elgg_echo('tasks:rank'); ?>:</label>
                                    </div>
                                    <div class='col-sm-9'>
                                        <input type='text' class='' ng-model='vm.task.sme.rank'/>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-sm-3'>
                                        <label><?php echo elgg_echo('tasks:name'); ?>:</label>
                                    </div>
                                    <div class='col-sm-9'>
                                        <input type='text' class='' ng-model='vm.task.sme.name'/>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-sm-3'>
                                        <label><?php echo elgg_echo('tasks:phone'); ?>:</label>
                                    </div>
                                    <div class='col-sm-9'>
                                        <input type='text' class='' ng-model='vm.task.sme.phone'/>
                                    </div>
                                </div>
                                <div class='row'>
                                    <div class='col-sm-3'>
                                        <label><?php echo elgg_echo('tasks:email'); ?>:</label>
                                    </div>
                                    <div class='col-sm-9'>
                                        <input type='email' name='sme_email' class='' ng-model='vm.task.sme.email'/>
                                        <div ng-messages="taskForm.sme_email.$error" ng-if="(taskForm.sme_email.$dirty) || (taskForm.$submitted)">
                                            <div ng-messages-include="tasks/messages"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class='row form-row' data-row-id="is_limitation">
                <div class='col-lg-12 field-header'>
                    <label><?php echo elgg_echo('tasks:isLimitation'); ?></label>
                </div>
                <div class='col-sm-12 field-body'>
                    <select ng-model='vm.task.is_limitation' ng-options='option for option in vm.booleanOptions.values'></select>
                </div>
            </div>

            <div class='row form-row' data-row-id="update_existing_product">
                <div class='col-lg-12 field-header'>
                    <label><?php echo elgg_echo('tasks:updateExistingProduct'); ?></label>
                </div>
                <div class='col-sm-12 field-body'>
                    <select ng-model='vm.task.update_existing_product' ng-options='option for option in vm.multiOptions.values'></select>
                </div>
            </div>

            <div class='row form-row' data-row-id="life_expectancy">
                <div class='col-lg-12 field-header'>
                    <label><?php echo elgg_echo('tasks:lifeExpectancy'); ?></label>
                </div>
                <div class='col-sm-12 field-body'>
                    <input type='text' name='lifeExpectancy' ng-model='vm.task.life_expectancy'/>
                </div>
            </div>

            <div class='row form-row' data-row-id="usa">
                <div class='col-lg-12 field-header'>
                    <label><?php echo elgg_echo('tasks:usa'); ?></label>
                    <div class="help-text">
                        <p><?php echo elgg_echo('tasks:email:notification') ?></p>
                        <p><?php echo elgg_echo('tasks:usa:helptext'); ?></p>
                    </div>
                </div>
                <div class='col-sm-12 field-body'>
                    <div class='col-sm-3'>
                        <label><?php echo elgg_echo('tasks:rank'); ?>:</label>
                    </div>
                    <div class='col-sm-9'>
                        <input type='text' class='' name='usa_rank' ng-model='vm.task.usa.rank' required/>
                        <div ng-messages="taskForm.usa_rank.$error" ng-if="taskForm.usa_rank.$touched || taskForm.$submitted">
                            <div ng-messages-include='tasks/messages'></div>
                        </div>
                    </div>
                    <div class='col-sm-3'>
                        <label><?php echo elgg_echo('tasks:name'); ?>:</label>
                    </div>
                    <div class='col-sm-9'>
                        <input type='text' class='' name='usa_name' ng-model='vm.task.usa.name' required/>
                        <div ng-messages="taskForm.usa_name.$error" ng-if="(taskForm.usa_name.$touched) || (taskForm.$submitted)">
                            <div ng-messages-include="tasks/messages"></div>
                        </div>
                    </div>
                    <div class='col-sm-3'>
                        <label><?php echo elgg_echo('tasks:position'); ?>:</label>
                    </div>
                    <div class='col-sm-9'>
                        <input type='text' class='' name='usa_position' ng-model='vm.task.usa.position' required/>
                        <div ng-messages="taskForm.usa_position.$error" ng-if="(taskForm.usa_position.$touched) || (taskForm.$submitted)">
                            <div ng-messages-include="tasks/messages"></div>
                        </div>
                    </div>
                    <div class='col-sm-3'>
                        <label><?php echo elgg_echo('tasks:email'); ?>:</label>
                    </div>
                    <div class='col-sm-9'>
                        <input type='email' class='' name='usa_email' ng-model='vm.task.usa.email' required/>
                        <div ng-messages="taskForm.usa_email.$error" ng-if="(taskForm.usa_email.$touched) || (taskForm.$submitted)">
                            <div ng-messages-include="tasks/messages"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class='row form-row' data-row-id="comments">
                <div class='col-lg-12 field-header'>
                    <label><?php echo elgg_echo('tasks:comments'); ?></label>
                </div>
                <div class='col-sm-12 field-body'>
                    <textarea ng-model='vm.task.comments'></textarea>
                </div>
            </div>

            <div class='row form-row' data-row-id="investment">
                <div class='col-lg-12 field-header'>
                    <label><?php echo elgg_echo('tasks:investment'); ?></label>

                    <div class="help-text">
                        <p><?php echo elgg_echo('tasks:investment:helptext'); ?></p>
                    </div>

                </div>
                <div class='col-sm-12 field-body'>
                    <textarea ng-model='vm.task.investment'></textarea>
                </div>
            </div>

            <div class='row form-row' data-row-id="risk">
                <div class='col-lg-12 field-header'>
                    <label><?php echo elgg_echo('tasks:risk'); ?></label>

                    <div class="help-text">
                        <p><?php echo elgg_echo('tasks:risk:helptext'); ?></p>
                    </div>

                </div>
                <div class='col-sm-12 field-body'>
                    <textarea ng-model='vm.task.risk'></textarea>
                </div>
            </div>

            <div class='row form-row' data-row-id="timeline">
                <div class='col-lg-12 field-header'>
                    <label><?php echo elgg_echo('tasks:timeline'); ?></label>

                    <div class="help-text">
                        <p><?php echo elgg_echo('tasks:timeline:helptext'); ?></p>
                    </div>

                </div>
                <div class='col-sm-12 field-body'>
                    <textarea ng-model='vm.task.timeline'></textarea>
                </div>
            </div>

            <div class='row form-row' data-row-id="impact">
                <div class='col-lg-12 field-header'>
                    <label><?php echo elgg_echo('tasks:impact'); ?></label>

                    <div class="help-text">
                        <p><?php echo elgg_echo('tasks:impact:helptext:header'); ?></p>
                        <ul>
                            <li><?php echo elgg_echo('tasks:impact:helptext:listItem1'); ?></li>
                            <li><?php echo elgg_echo('tasks:impact:helptext:listItem2'); ?></li>
                            <li><?php echo elgg_echo('tasks:impact:helptext:listItem3'); ?></li>
                        </ul>
                    </div>

                </div>
                <div class='col-sm-12 field-body'>
                    <textarea ng-model='vm.task.impact'></textarea>
                </div>
            </div>

            <div class='row form-row' data-row-id="savings">
                <div class='col-lg-12 field-header'>

                    <label><?php echo elgg_echo('tasks:savings'); ?></label>

                    <div class="help-text">
                        <p><?php echo elgg_echo('tasks:savings:helpText'); ?></p>
                    </div>

                </div>

                <div class='col-sm-12 field-body'>

                    <div class='row'>
                        <div class='col-lg-12'>
                            <label><?php echo elgg_echo('tasks:savings:label'); ?>:</label>
                        </div>
                        <div class='col-lg-12'>
                            <label ng-repeat="(key, choice) in vm.choices"><input type='checkbox' ng-model='choice.selected' value={{choice.title}}>{{choice.title}}</label>
                        </div>
                    </div>

                    <label><?php echo elgg_echo('tasks:savings:substantiation'); ?>:</label>
                    <textarea ng-model='vm.task.savings.substantiation'></textarea>

                </div>
            </div>

            <div class='row form-row' data-row-id="attachments">
                <div class='col-lg-12 field-header'>
                    <label><?php echo elgg_echo('tasks:files'); ?></label>
                </div>
                <div class='col-sm-12 field-body'>
                    <input type="file" ngf-select="" ng-model="vm.files" name="file" ngf-multiple="true">
                </div>
            </div>


            <button type='submit' class='elgg-button elgg-button-action'><?php echo elgg_echo('tasks:submit'); ?></button>
        </form>
    </div>
</div>
