<?php
?>
<div>
Create Task form

</div>
<div ng-show='vm.loaded'>

	<div class='template-header'>
		<h2>{{vm.task.title}} Create Task Title</h2>
		<a href='#/tasks' class='elgg-button elgg-button-action'><?php echo elgg_echo('tasks:all:list'); ?></a>
        <a ng-click="vm.print()" href='' target='_blank' class='elgg-button elgg-button-action'><?php echo elgg_echo('tasks:print'); ?></a>

   <!-- Confluence Integration for only task admins -->
        <div ng-if="user.task_admin">

            <!-- Confluence Integration Modal  ------------------------------------>
            <script type="text/ng-template" id="confluenceModal.html">
                <div class="row modal-header">
                    <div class="col-xs-11">
                        <h3 class="modal-title" style="margin-top: 0px;"><?php echo elgg_echo('tasks:confluence:modal:title'); ?></h3>
                    </div>
                    <div class="col-xs-1" id="closeHeader"><a style="" class="elgg-button elgg-button-cancel"
                                                              type="button" ng-click="cancel()"><?php echo elgg_echo('tasks:confluence:modal:x'); ?></a>
                    </div>
                </div>
                <div class="row  modal-body">
                    <p><?php echo elgg_echo('tasks:confluence:modal:whereAddTo'); ?></p>
                    <div class="col-sm-6">
                        <label><input type="radio" ng-model="spaceType" value="new"><?php echo elgg_echo('tasks:confluence:modal:newSpace'); ?></label>
                        <p><?php echo elgg_echo('tasks:confluence:modal:newSpaceDesc'); ?></p>
                    </div>
                    <div class="col-sm-6">
                        <label><input type="radio" ng-model="spaceType" value="old"><?php echo elgg_echo('tasks:confluence:modal:existingSpace'); ?></label>
                        <select style="width:100%;max-width:100%;margin-top:5px;" ng-disabled="spaceType == 'new'" ng-model="selectSpace"
                                ng-options='obj.key as obj.name for obj in allSpaces'>
                        </select>
                    </div>
                </div>
                <div class="row modal-footer">
                    <div ng-if="spaceType == 'new'">
                        <a class="elgg-button elgg-button-action" type="button" ng-click="ok()"><?php echo elgg_echo('tasks:confluence:modal:createNewSpace'); ?></a>
                    </div>
                    <div ng-if="spaceType == 'old'">
                        <a class="elgg-button elgg-button-action" type="button" ng-click="ok()"><?php echo elgg_echo('tasks:confluence:modal:addExistingSpace'); ?></a>
                    </div>
                </div>
            </script>
            <!-- Confluence Integration Modal  ------------------------------------------------->
            <!--    Already added to confluence btn     -->
            <div  ng-show="vm.inConfluence">
                <a target="_blank"   href="{{vm.confluenceUrl}}"
                   id="confluenceAlreadyBtn"
                   class='elgg-button elgg-button-action elgg-button-cancel'>
                    <?php echo elgg_echo('tasks:confluence:view'); ?></a>
            </div>
            <!--    Add to confluence btn     -->
            <div ng-show="!vm.inConfluence">
                <a  id="confluenceAddBtn" ng-click="vm.addConfluence()" href=''
                    class='elgg-button elgg-button-action'>
                    <?php echo elgg_echo('tasks:confluence:add'); ?></a>
            </div>

        </div>
        <!-- End confluence integration -->

		<div class="task-brief-info">
			<div class='submitted' ng-if="vm.task.status=='Submitted'">
				<span class='glyphicon exclamation'></span>
				<p>{{vm.task.status}}</p>
			</div>
			<div class='under-review' ng-if="vm.task.status=='Under Review'">
				<span class='glyphicon exclamation'></span>
				<p>{{vm.task.status}}</p>
			</div>
			<div class='in-progress' ng-if="vm.task.status=='In Progress'">
				<span class='glyphicon exclamation'></span>
				<p>{{vm.task.status}}</p>
			</div>
			<div class='completed' ng-if="vm.task.status=='Completed'">
				<span class='glyphicon exclamation'></span>
				<p>{{vm.task.status}}</p>
			</div>
			<h4><?php echo elgg_echo('tasks:submittedBy');?>: <span>{{vm.task.owner}}</span> <?php echo elgg_echo('tasks:on');?> {{vm.task.time_created}}</h4>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-3">
			<div ng-include="'tasks/toc'">
			</div>
		</div>
		<div class='task col-sm-6'>
			<div class='form-row clearfix' data-row-id="title">
				<div class='col-sm-12 field-header'>
					<label><?php echo elgg_echo('tasks:title');?></label>
					<a class='glyphicon edit-button title' data-id ="title" ng-if='vm.task.can_edit' ng-click="vm.toggleEditMode($event)"></a>
				</div>
				<div class='col-sm-12 field-body'>
					<p data-field-id="title">{{vm.task.title}}</p>

					<div ng-if="vm.task.editable['title']">
						<input type='text' class='' name='title' ng-model='vm.title' required />
						<div ng-messages="taskForm.title.$error" ng-if="(taskForm.title.$dirty) || (taskForm.$submitted)">
							<div ng-messages-include="tasks/messages"></div>
						</div>
						<div class='editable-content-buttons'>
							<a class='elgg-button elgg-button-action elgg-button-cancel' data-id ="title" ng-click="vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:cancel'); ?></a>
							<a class='elgg-button elgg-button-action elgg-button-accept' data-id ="title" ng-click="vm.update('title'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
						</div>
					</div>
				</div>
			</div>
			<div class='form-row clearfix' data-row-id="course">
				<div class='col-sm-12 field-header'>
					<label><?php echo elgg_echo('tasks:course');?></label>
					<a class='glyphicon edit-button course' data-id ="course" ng-if='vm.task.can_edit' ng-click="vm.toggleEditMode($event)"></a>
				</div>
				<div class='col-sm-12 field-body'>
					<p data-field-id="course">{{vm.task.course}}</p>

					<div ng-if="vm.task.editable['course']">
						<input type='text' class='' name='course' ng-model='vm.course' />
						<div class='editable-content-buttons'>
							<a class='elgg-button elgg-button-action elgg-button-cancel' data-id ="course" ng-click="vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:cancel'); ?></a>
							<a class='elgg-button elgg-button-action elgg-button-accept' data-id ="course" ng-click="vm.update('course'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
						</div>
					</div>
				</div>
			</div>
			<div class='form-row clearfix' data-row-id="org">
				<div class='col-sm-12 field-header'>
					<label><?php echo elgg_echo('tasks:org');?></label>
					<a class='glyphicon edit-button org' data-id ="org" ng-if='vm.task.can_edit' ng-click="vm.toggleEditMode($event)"></a>
				</div>
				<div class='col-sm-12 field-body'>
					<p data-field-id="org">{{vm.task.org}}</p>

					<div ng-if="vm.task.editable['org']">
						<input type='text' class='' name='org' ng-model='vm.org' required />
						<div ng-messages="taskForm.org.$error" ng-if="(taskForm.org.$dirty) || (taskForm.$submitted)">
							<div ng-messages-include="tasks/messages"></div>
						</div>
						<div class='editable-content-buttons'>
							<a class='elgg-button elgg-button-action elgg-button-cancel' data-id ="org" ng-click="vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:cancel'); ?></a>
							<a class='elgg-button elgg-button-action elgg-button-accept' data-id ="org" ng-click="vm.update('org'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
						</div>
					</div>
				</div>
			</div>
			<div class='form-row clearfix' data-row-id="ta">
				<div class='col-sm-12 field-header'>
					<label><?php echo elgg_echo('tasks:ta');?></label>
					<a class='glyphicon edit-button ta' data-id ="ta" ng-if='vm.task.can_edit' ng-click="vm.toggleEditMode($event)"></a>
				</div>
				<div class='col-sm-12 field-body'>
					<p data-field-id="ta">{{vm.ta}}</p>

					<div ng-if="vm.task.editable['ta']">
						{{vm.ta.values}}
						<select ng-model="vm.ta" ng-options='ta for ta in vm.ta_options.values'>
						</select>
						<div class='editable-content-buttons'>
							<a class='elgg-button elgg-button-action elgg-button-cancel' data-id ="ta" ng-click="vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:cancel'); ?></a>
							<a class='elgg-button elgg-button-action elgg-button-accept' data-id ="ta" ng-click="vm.update('ta'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
						</div>
					</div>
				</div>
			</div>
			<div class='form-row clearfix' data-row-id="type">
				<div class='col-sm-12 field-header'>
					<label><?php echo elgg_echo('tasks:type');?></label>
					<a class='glyphicon edit-button task_type' data-id ="task_type" ng-if='vm.task.can_edit' ng-click="vm.toggleEditMode($event)"></a>
				</div>
				<div class='col-sm-12 field-body'>
					<p data-field-id="task_type">{{vm.task_type}}</p>

					<div ng-if="vm.task.editable['task_type']">
						<select ng-model="vm.task_type" ng-options='type for type in vm.taskTypes.values'>
						</select>
						<div class='editable-content-buttons'>
							<a class='elgg-button elgg-button-action elgg-button-cancel' data-id ="task_type" ng-click="vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:cancel'); ?></a>
							<a class='elgg-button elgg-button-action elgg-button-accept' data-id ="task_type" ng-click="vm.update('task_type'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
						</div>
					</div>
				</div>
			</div>

			<div class='form-row clearfix' data-row-id="description">
				<div class='col-sm-12 field-header'>
					<label><?php echo elgg_echo('tasks:description');?></label>
					<a class='glyphicon edit-button description' data-id ="description" ng-if='vm.task.can_edit' ng-click="vm.toggleEditMode($event)"></a>
					<p><?php echo elgg_echo('tasks:description:helptext');?></p>
				</div>
				<div class='col-sm-12 field-body'>
                    <div class="elgg-output" data-field-id="description" ng-bind-html="vm.task.description"></div>

					<div ng-show="vm.task.editable['description']">
						<textarea mce-init="description" id="description" name='description' ng-model='vm.description'></textarea>
						<div ng-messages="taskForm.description.$error" ng-if="(taskForm.description.$dirty) || (taskForm.$submitted)">
							<div ng-messages-include="tasks/messages"></div>
						</div>
						<div class='editable-content-buttons'>
							<a class='elgg-button elgg-button-action elgg-button-cancel' data-id ="description" ng-click="vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:cancel'); ?></a>
							<a class='elgg-button elgg-button-action elgg-button-accept' data-id ="description" ng-click="vm.update('description'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
						</div>
					</div>
				</div>
			</div>

			<div class='form-row clearfix' data-row-id="scope">
				<div class='col-sm-12 field-header'>
					<label><?php echo elgg_echo('tasks:scope'); ?></label>
					<a class='glyphicon edit-button scope' data-id ="scope" ng-if='vm.task.can_edit' ng-click="vm.toggleEditMode($event)"></a>
					<div class="help-text">
						<p><?php echo elgg_echo('tasks:scope:helptext:header');?></p>
						<ul>
							<li><?php echo elgg_echo('tasks:scope:helptext:listItem1');?></li>
							<li><?php echo elgg_echo('tasks:scope:helptext:listItem2');?></li>
							<li><?php echo elgg_echo('tasks:scope:helptext:listItem3');?></li>
							<li><?php echo elgg_echo('tasks:scope:helptext:listItem4');?></li>
							<li><?php echo elgg_echo('tasks:scope:helptext:listItem5');?></li>
							<li><?php echo elgg_echo('tasks:scope:helptext:listItem6');?></li>
                            <li><?php echo elgg_echo('tasks:scope:helptext:listItem7');?></li>
						</ul>
					</div>
				</div>
				<div class='col-sm-12 field-body'>
					<p data-field-id="scope">{{vm.task.scope}}</p>

					<div ng-if="vm.task.editable['scope']">
						<textarea name='scope' ng-model='vm.scope' required></textarea>
						<div ng-messages="taskForm.scope.$error" ng-if="(taskForm.scope.$dirty) || (taskForm.$submitted)">
							<div ng-messages-include="tasks/messages"></div>
						</div>
						<div class='editable-content-buttons'>
							<a class='elgg-button elgg-button-action elgg-button-cancel' data-id ="scope" ng-click="vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:cancel'); ?></a>
							<a class='elgg-button elgg-button-action elgg-button-accept' data-id ="scope" ng-click="vm.update('scope'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
						</div>
					</div>
				</div>
			</div>

			<div class='form-row clearfix' data-row-id="opi">
				<div class='col-sm-12 field-header'>
					<label><?php echo elgg_echo('tasks:opi');?></label>
					<div class="help-text">
						<p><?php echo elgg_echo('tasks:opi:helptext'); ?></p>
					</div>
				</div>
				<div class='col-lg-12'>
					<div class='col-sm-12 field-body'>
						<div class='form-row clearfix' ng-repeat='(key, opi) in vm.opis'>

							<div class='col-sm-12 field-header'>
								<h5><?php echo elgg_echo('tasks:opi:title'); ?> {{$index+1}}</h5>
								<a class='glyphicon edit-button opi' data-id ="opi" ng-if='vm.task.can_edit' ng-click="vm.toggleEditMode($event, $index)"></a>
								<a class='glyphicon remove-button' ng-click='vm.removeContact(key)'></a>
							</div>

							<div class='col-sm-12 field-body' data-field-id="opi">
								<div class='row'>
									<div class='col-sm-3'>
										<label><?php echo elgg_echo('tasks:rank');?>:</label>
									</div>
									<div class='col-sm-9'>
										<p>{{opi.rank}}</p>
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-3'>
										<label><?php echo elgg_echo('tasks:name');?>:</label>
									</div>
									<div class='col-sm-9'>
										<p>{{opi.name}}</p>
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-3'>
										<label><?php echo elgg_echo('tasks:phone');?>:</label>
									</div>
									<div class='col-sm-9'>
										<p>{{opi.phone}}</p>
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-3'>
										<label><?php echo elgg_echo('tasks:email'); ?>:</label>
									</div>
									<div class='col-sm-9'>
										<p>{{opi.email}}</p>
									</div>
								</div>
							</div>

							<div class="col-lg-12 field-body" ng-if="vm.task.editable['opi'][$index]">
								<div class='row'>
									<div class='col-sm-3'>
										<label><?php echo elgg_echo('tasks:rank'); ?>:</label>
									</div>
									<div class='col-sm-9'>
										<input type='text' class='' name='opi_rank' ng-model='opi.rank' required />
										<div ng-messages="taskForm.opi_rank.$error" ng-if="(taskForm.opi_rank.$dirty) || (taskForm.$submitted)">
											<div ng-messages-include="tasks/messages"></div>
										</div>
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-3'>
										<label><?php echo elgg_echo('tasks:name'); ?>:</label>
									</div>
									<div class='col-sm-9'>
										<input type='text' name='opi_name' class='' ng-model='opi.name' required />
										<div ng-messages="taskForm.opi_name.$error" ng-if="(taskForm.opi_name.$dirty) || (taskForm.$submitted)">
											<div ng-messages-include="tasks/messages"></div>
										</div>
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-3'>
										<label><?php echo elgg_echo('tasks:phone'); ?>:</label>
									</div>
									<div class='col-sm-9'>
										<input type='text' name='opi_phone' class='' ng-model='opi.phone' required />
										<div ng-messages="taskForm.opi_phone.$error" ng-if="(taskForm.opi_phone.$dirty) || (taskForm.$submitted)">
											<div ng-messages-include="tasks/messages"></div>
										</div>
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-3'>
										<label><?php echo elgg_echo('tasks:email'); ?>:</label>
									</div>
									<div class='col-sm-9'>
										<input type='email' name='opi_email' class='' ng-model='opi.email' required />
										<div ng-messages="taskForm.opi_email.$error" ng-if="(taskForm.opi_email.$dirty) || (taskForm.$submitted)">
											<div ng-messages-include="tasks/messages"></div>
										</div>
									</div>
								</div>
								<div class='editable-content-buttons'>
									<a class='elgg-button elgg-button-action elgg-button-cancel' data-id ="opi" ng-click="vm.toggleEditMode($event, $index)"><?php echo elgg_echo('tasks:cancel'); ?></a>
									<a class='elgg-button elgg-button-action elgg-button-accept' data-id ="opi" ng-click="vm.update('opis'); vm.toggleEditMode($event, $index)"><?php echo elgg_echo('tasks:accept'); ?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="form-row clearfix" data-row-id="priority">
				<div class='col-sm-12 field-header'>
					<label><?php echo elgg_echo('tasks:briefExplain'); ?></label>
					<a class='glyphicon edit-button priority' data-id ="priority" ng-if='vm.task.can_edit' ng-click="vm.toggleEditMode($event)"></a>
					<div class="help-text">
						<p><?php echo elgg_echo('tasks:briefExplain:helptext:header');?></p>
						<ul>
							<li><?php echo elgg_echo('tasks:briefExplain:helptext:listItem1');?></li>
							<li><?php echo elgg_echo('tasks:briefExplain:helptext:listItem2');?></li>
							<li><?php echo elgg_echo('tasks:briefExplain:helptext:listItem3');?>
								<ol>
									<li><?php echo elgg_echo('tasks:briefExplain:helptext:subListItem1');?></li>
									<li><?php echo elgg_echo('tasks:briefExplain:helptext:subListItem2');?></li>
									<li><?php echo elgg_echo('tasks:briefExplain:helptext:subListItem3');?></li>
									<li><?php echo elgg_echo('tasks:briefExplain:helptext:subListItem4');?></li>
									<li><?php echo elgg_echo('tasks:briefExplain:helptext:subListItem5');?></li>
								</ol>
							</li>
						</ul>
					</div>
				</div>
				<div class='col-sm-12 field-body'>

                    <div data-field-id="priority">
                        <p>{{vm.task.priority}}</p>
                    </div>

					<div ng-if="vm.task.editable['priority']">

						<textarea ng-model='vm.priority' value='{{vm.task.priority}}'></textarea>
						<div class='editable-content-buttons'>
							<a class='elgg-button elgg-button-action elgg-button-cancel' data-id="priority" ng-click="vm.toggleEditMode($event)">Cancel</a>
							<a class='elgg-button elgg-button-action elgg-button-accept' data-id="priority" ng-click="vm.update('priority'); vm.update('op_mandate'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
						</div>
					</div>
				</div>
			</div>

			<div class='form-row clearfix' data-row-id="sme">
				<div class='col-sm-12 field-header'>
					<label><?php echo elgg_echo('tasks:isSme'); ?></label>
					<a class='glyphicon edit-button is_sme_avail' data-id ="is_sme_avail" ng-if='vm.task.can_edit' ng-click="vm.toggleEditMode($event)"></a>
				</div>
				<div class='col-sm-12 field-body'>
					<p data-field-id="is_sme_avail">{{vm.task.is_sme_avail}}</p>

					<div ng-if="vm.task.editable['is_sme_avail']">
						<select ng-model='vm.is_sme_avail' ng-options='option for option in vm.booleanOptions.values'></select>
						<div class='editable-content-buttons'>
							<a class='elgg-button elgg-button-action elgg-button-cancel' data-id="is_sme_avail" ng-click="vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:cancel'); ?></a>
							<a class='elgg-button elgg-button-action elgg-button-accept' data-id="is_sme_avail" ng-click="vm.update('is_sme_avail'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
						</div>
					</div>

					<div class='col-lg-12' id='sme' ng-show=vm.boolOption(vm.task.is_sme_avail)>
						<div class='form-row clearfix'>
							<div class='col-sm-12 field-header'>
								<label><?php echo elgg_echo('tasks:sme'); ?></label>
								<a class='glyphicon edit-button sme' data-id ="sme" ng-if='vm.task.can_edit' ng-click="vm.toggleEditMode($event)"></a>
							</div>

							<div class='col-sm-12 field-body' data-field-id="sme">
								<div class='row'>
									<div class='col-sm-3'>
										<label><?php echo elgg_echo('tasks:rank'); ?> :</label>
									</div>
									<div class='col-sm-9'>
										<p>{{vm.task.sme.rank}}</p>
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-3'>
										<label><?php echo elgg_echo('tasks:name');?> :</label>
									</div>
									<div class='col-sm-9'>
										<p>{{vm.task.sme.name}}</p>
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-3'>
										<label><?php echo elgg_echo('tasks:phone');?> :</label>
									</div>
									<div class='col-sm-9'>
										<p>{{vm.task.sme.phone}}</p>
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-3'>
										<label><?php echo elgg_echo('tasks:email'); ?> :</label>
									</div>
									<div class='col-sm-9'>
										<p>{{vm.task.sme.email}}</p>
									</div>
								</div>
							</div>

							<div class="col-sm-12 field-body" ng-if="vm.task.editable['sme']">
								<div class='row'>
									<div class='col-sm-3'>
										<label><?php echo elgg_echo('tasks:rank'); ?>:</label>
									</div>
									<div class='col-sm-9'>
										<input type='text' class='' ng-model='vm.sme.rank' />
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-3'>
										<label><?php echo elgg_echo('tasks:name'); ?>:</label>
									</div>
									<div class='col-sm-9'>
										<input type='text' class='' ng-model='vm.sme.name' />
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-3'>
										<label><?php echo elgg_echo('tasks:phone'); ?>:</label>
									</div>
									<div class='col-sm-9'>
										<input type='text' class='' ng-model='vm.sme.phone' />
									</div>
								</div>
								<div class='row'>
									<div class='col-sm-3'>
										<label><?php echo elgg_echo('tasks:email'); ?>:</label>
									</div>
									<div class='col-sm-9'>
										<input type='email' name='sme_email' class='' ng-model='vm.sme.email' />
										<div ng-messages="taskForm.sme_email.$error" ng-if="(taskForm.sme_email.$dirty) || (taskForm.$submitted)">
											<div ng-messages-include="tasks/messages"></div>
										</div>
									</div>
								</div>
								<div class='editable-content-buttons'>
									<a class='elgg-button elgg-button-action elgg-button-cancel' data-id="sme" ng-click="vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:cancel'); ?></a>
									<a class='elgg-button elgg-button-action elgg-button-accept' data-id="sme" ng-click="vm.update('sme'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class='form-row clearfix' data-row-id="is_limitation">
				<div class='col-sm-12 field-header'>
					<label><?php echo elgg_echo('tasks:isLimitation'); ?></label>
					<a class='glyphicon edit-button is_limitation' data-id="is_limitation" ng-if='vm.task.can_edit' ng-click="vm.toggleEditMode($event)"></a>
				</div>
				<div class='col-sm-12 field-body'>
					<p data-field-id="is_limitation">{{vm.task.is_limitation}}</p>

					<div ng-if="vm.task.editable['is_limitation']">
						<select ng-model='vm.is_limitation' ng-options='option for option in vm.booleanOptions.values'></select>
						<div class='editable-content-buttons'>
							<a class='elgg-button elgg-button-action elgg-button-cancel' data-id="is_limitation" ng-click="vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:cancel'); ?></a>
							<a class='elgg-button elgg-button-action elgg-button-accept' data-id="is_limitation" ng-click="vm.update('is_limitation'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
						</div>
					</div>
				</div>
			</div>

			<div class='form-row clearfix' data-row-id="update_existing_product">
				<div class='col-sm-12 field-header'>
					<label><?php echo elgg_echo('tasks:updateExistingProduct'); ?></label>
					<a class='glyphicon edit-button update_existing_product' data-id="update_existing_product" ng-if='vm.task.can_edit' ng-click="vm.toggleEditMode($event)"></a>
				</div>
				<div class='col-sm-12 field-body'>
					<p data-field-id="update_existing_product">{{vm.task.update_existing_product}}</p>

					<div ng-if="vm.task.editable['update_existing_product']">
						<select ng-model='vm.update_existing_product' ng-options='option for option in vm.multiOptions.values'></select>
						<div class='editable-content-buttons'>
							<a class='elgg-button elgg-button-action elgg-button-cancel' data-id="update_existing_product" ng-click="vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:cancel'); ?></a>
							<a class='elgg-button elgg-button-action elgg-button-accept' data-id="update_existing_product" ng-click="vm.update('update_existing_product'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
						</div>
					</div>
				</div>
			</div>

			<div class='form-row clearfix' data-row-id="life_expectancy">
				<div class='col-sm-12 field-header'>
					<label><?php echo elgg_echo('tasks:lifeExpectancy');?></label>
					<a class='glyphicon edit-button life_expectancy' data-id="life_expectancy" ng-if='vm.task.can_edit' ng-click="vm.toggleEditMode($event)"></a>
				</div>
				<div class='col-sm-12 field-body'>
					<p data-field-id="life_expectancy">{{vm.task.life_expectancy}}</p>

					<div ng-if="vm.task.editable['life_expectancy']">
						<input type='text' name='life_expectancy' ng-model='vm.life_expectancy' />
						<div class='editable-content-buttons'>
							<a class='elgg-button elgg-button-action elgg-button-cancel' data-id="life_expectancy" ng-click="vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:cancel'); ?></a>
							<a class='elgg-button elgg-button-action elgg-button-accept' data-id="life_expectancy" ng-click="vm.update('life_expectancy'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
						</div>
					</div>
				</div>
			</div>

			<div class='form-row clearfix' data-row-id="usa">
				<div class='col-sm-12 field-header'>
					<label><?php echo elgg_echo('tasks:usa'); ?></label>
					<a class='glyphicon edit-button usa' data-id="usa" ng-if='user.task_admin' ng-click="vm.toggleEditMode($event)"></a>
					<div class="help-text">
						<p><?php echo elgg_echo('tasks:usa:helptext'); ?></p>
					</div>
				</div>

				<div class='col-sm-12 field-body' data-field-id='usa'>
					<div class='row'>
						<div class='col-sm-3'>
							<label><?php echo elgg_echo('tasks:rank');?> :</label>
						</div>
						<div class='col-sm-9'>
							<p>{{vm.task.usa.rank}}</p>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3'>
							<label><?php echo elgg_echo('tasks:name');?> :</label>
						</div>
						<div class='col-sm-9'>
							<p>{{vm.task.usa.name}}</p>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3'>
							<label><?php echo elgg_echo('tasks:position'); ?> :</label>
						</div>
						<div class='col-sm-9'>
							<p>{{vm.task.usa.position}}</p>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3'>
							<label><?php echo elgg_echo('tasks:email');?> :</label>
						</div>
						<div class='col-sm-9'>
							<p>{{vm.task.usa.email}}</p>
						</div>
					</div>
				</div>

				<div class='col-sm-12 field-body' ng-if="vm.task.editable['usa']">
					<div class='row'>
						<div class='col-sm-3'>
							<label><?php echo elgg_echo('tasks:rank');?> :</label>
						</div>

						<div class='col-sm-9'>
							<input type='text' class='' name='usa_rank' ng-model='vm.usa.rank' required/>

							<div ng-messages="taskForm.usa_rank.$error" ng-if="taskForm.usa_rank.$touched || taskForm.$submitted">
								<div ng-messages-include='tasks/messages'></div>
							</div>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3'>
							<label><?php echo elgg_echo('tasks:name');?> :</label>
						</div>

						<div class='col-sm-9'>
							<input type='text' class='' name='usa_name' ng-model='vm.usa.name' required/>

							<div ng-messages="taskForm.usa_name.$error" ng-if="(taskForm.usa_name.$touched) || (taskForm.$submitted)">
								<div ng-messages-include="tasks/messages"></div>
							</div>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3'>
							<label><?php echo elgg_echo('tasks:position'); ?> :</label>
						</div>

						<div class='col-sm-9'>
							<input type='text' class='' name='usa_position' ng-model='vm.usa.position' required/>

							<div ng-messages="taskForm.usa_position.$error" ng-if="(taskForm.usa_position.$touched) || (taskForm.$submitted)">
								<div ng-messages-include="tasks/messages"></div>
							</div>
						</div>
					</div>
					<div class='row'>
						<div class='col-sm-3'>
							<label><?php echo elgg_echo('tasks:email');?> :</label>
						</div>
						<div class='col-sm-9'>
							<input type='email' class='' name='usa_email' ng-model='vm.usa.email' required/>
							<div ng-messages="taskForm.usa_email.$error" ng-if="(taskForm.usa_email.$touched) || (taskForm.$submitted)">
								<div ng-messages-include="tasks/messages"></div>
							</div>
						</div>
					</div>

					<div class='editable-content-buttons'>
						<a class='elgg-button elgg-button-action elgg-button-cancel' data-id="usa" ng-click="vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:cancel'); ?></a>
						<a class='elgg-button elgg-button-action elgg-button-accept' data-id="usa" ng-click="vm.update('usa'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
					</div>
				</div>

			</div>

			<div class='form-row clearfix' data-row-id="comments">
				<div class='col-sm-12 field-header'>
					<label><?php echo elgg_echo('tasks:comments'); ?></label>
					<a class='glyphicon edit-button comments' data-id="comments" ng-if='vm.task.can_edit' ng-click="vm.toggleEditMode($event)"></a>
				</div>
				<div class='col-sm-12 field-body'>
					<p data-field-id="comments">{{vm.task.comments}}</p>

					<div ng-if="vm.task.editable['comments']">
						<input type='text' name='comments' ng-model='vm.comments' />
						<div class='editable-content-buttons'>
							<a class='elgg-button elgg-button-action elgg-button-cancel' data-id="comments" ng-click="vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:cancel'); ?></a>
							<a class='elgg-button elgg-button-action elgg-button-accept' data-id="comments" ng-click="vm.update('comments'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
						</div>
					</div>
				</div>
			</div>

            <div class='form-row clearfix' data-row-id="investment">
				<div class='col-sm-12 field-header'>
					<label><?php echo elgg_echo('tasks:investment'); ?></label>

                    <div class="help-text">
						<p><?php echo elgg_echo('tasks:investment:helptext');?></p>
                    </div>

					<a class='glyphicon edit-button investment' data-id="investment" ng-if='vm.task.can_edit' ng-click="vm.toggleEditMode($event)"></a>
				</div>
				<div class='col-sm-12 field-body'>
					<p data-field-id="investment">{{vm.task.investment}}</p>

					<div ng-if="vm.task.editable['investment']">
                        <textarea ng-model='vm.investment' value="{{vm.task.investment}}"></textarea>
						<div class='editable-content-buttons'>
							<a class='elgg-button elgg-button-action elgg-button-cancel' data-id="investment" ng-click="vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:cancel'); ?></a>
							<a class='elgg-button elgg-button-action elgg-button-accept' data-id="investment" ng-click="vm.update('investment'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
						</div>
					</div>
				</div>
			</div>

            <div class='form-row clearfix' data-row-id="risk">
				<div class='col-sm-12 field-header'>
					<label><?php echo elgg_echo('tasks:risk'); ?></label>

                    <div class="help-text">
						<p><?php echo elgg_echo('tasks:risk:helptext');?></p>
                    </div>

					<a class='glyphicon edit-button risk' data-id="risk" ng-if='vm.task.can_edit' ng-click="vm.toggleEditMode($event)"></a>
				</div>
				<div class='col-sm-12 field-body'>
					<p data-field-id="risk">{{vm.task.risk}}</p>

					<div ng-if="vm.task.editable['risk']">
                        <textarea ng-model='vm.risk' value="{{vm.task.risk}}"></textarea>
						<div class='editable-content-buttons'>
							<a class='elgg-button elgg-button-action elgg-button-cancel' data-id="risk" ng-click="vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:cancel'); ?></a>
							<a class='elgg-button elgg-button-action elgg-button-accept' data-id="risk" ng-click="vm.update('risk'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
						</div>
					</div>
				</div>
			</div>

            <div class='form-row clearfix' data-row-id="timeline">
				<div class='col-sm-12 field-header'>
					<label><?php echo elgg_echo('tasks:timeline'); ?></label>

                    <div class="help-text">
						<p><?php echo elgg_echo('tasks:timeline:helptext');?></p>
                    </div>

					<a class='glyphicon edit-button timeline' data-id="timeline" ng-if='vm.task.can_edit' ng-click="vm.toggleEditMode($event)"></a>
				</div>
				<div class='col-sm-12 field-body'>
					<p data-field-id="timeline">{{vm.task.timeline}}</p>

					<div ng-if="vm.task.editable['timeline']">
                        <textarea ng-model='vm.timeline' value="{{vm.task.timeline}}"></textarea>
						<div class='editable-content-buttons'>
							<a class='elgg-button elgg-button-action elgg-button-cancel' data-id="timeline" ng-click="vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:cancel'); ?></a>
							<a class='elgg-button elgg-button-action elgg-button-accept' data-id="timeline" ng-click="vm.update('timeline'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
						</div>
					</div>
				</div>
			</div>

            <div class='form-row clearfix' data-row-id="impact">
				<div class='col-sm-12 field-header'>
					<label><?php echo elgg_echo('tasks:impact'); ?></label>
					<a class='glyphicon edit-button impact' data-id="impact" ng-if='vm.task.can_edit' ng-click="vm.toggleEditMode($event)"></a>
				</div>
				<div class='col-sm-12 field-body'>
					<p data-field-id="impact">{{vm.task.impact}}</p>

					<div ng-if="vm.task.editable['impact']">
                        <textarea ng-model='vm.impact' value="{{vm.task.impact}}"></textarea>
						<div class='editable-content-buttons'>
							<a class='elgg-button elgg-button-action elgg-button-cancel' data-id="impact" ng-click="vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:cancel'); ?></a>
							<a class='elgg-button elgg-button-action elgg-button-accept' data-id="impact" ng-click="vm.update('impact'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
						</div>
					</div>
				</div>
			</div>

			<div class='form-row clearfix' data-row-id="savings">
				<div class='col-sm-12 field-header'>
                    <label><?php echo elgg_echo('tasks:savings'); ?></label>

                    <div class="help-text">
						<p><?php echo elgg_echo('tasks:savings:helpText');?></p>
                    </div>

                    <a class='glyphicon edit-button savings' data-id ="savings" ng-if='vm.task.can_edit' ng-click="vm.toggleEditMode($event)"></a>
                </div>

                <div class='col-sm-12 field-body' data-field-id="savings">
                    <div class='row'>
                        <div class='col-sm-3'>
                            <label><?php echo elgg_echo('tasks:savings:label');?>:</label>
                        </div>
                        <div class='col-sm-9'>
                            <p style='margin-bottom:.444rem;' ng-repeat='(key, choice) in vm.task.savings.choices'><span ng-if='choice.selected'>{{choice.title}}</span></p>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col-sm-3'>
                            <label><?php echo elgg_echo('tasks:savings:substantiation');?>:</label>
                        </div>
                        <div class='col-sm-9'>
                            <p>{{vm.task.savings.substantiation}}</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 field-body" ng-if="vm.task.editable['savings']">

                    <div class='col-sm-12 field-body'>

                        <div class='row'>
                            <div class='col-lg-12'>
                                <label><?php echo elgg_echo('tasks:savings:label');?>:</label>
                            </div>
                            <div class='col-lg-12'>
                                <label ng-repeat="(key, choice) in vm.choices"><input type='checkbox' ng-model='choice.selected' value={{choice.title}}>{{choice.title}}</label>
                            </div>
                        </div>

                        <label><?php echo elgg_echo('tasks:savings:substantiation');?>:</label>
                        <textarea ng-model='vm.savings.substantiation'></textarea>

                    </div>

                    <div class='editable-content-buttons'>
                        <a class='elgg-button elgg-button-action elgg-button-cancel' data-id="savings" ng-click="vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:cancel'); ?></a>
                        <a class='elgg-button elgg-button-action elgg-button-accept' data-id="savings" ng-click="vm.update('savings'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
                    </div>

                </div>

            </div>

			<div class='form-row clearfix' data-row-id="attachments">
				<div class='col-sm-12 field-header'>
					<label><?php echo elgg_echo('tasks:files'); ?></label>
				</div>
				<div class='col-sm-12 field-body'>
					<div ng-repeat='attachment in vm.task.attachments'>
						<a href='{{attachment.url}}' >{{attachment.title}}</a>
					</div>
				</div>
			</div>
		</div>

		<div class='task task-sidebar col-sm-3' style="float:right;">
			<div class="task-sidebar-row clearfix">
				<div class="col-sm-12 field-header">
					<label><?php echo elgg_echo('tasks:classification'); ?></label>
					<a class='glyphicon edit-button classification' data-id="classification" ng-if="user.task_admin" ng-click="vm.toggleEditMode($event)"></a>
				</div>
				<div class="col-sm-12 field-body">
					<p data-field-id="classification">{{vm.task.classification}}</p>

					<div ng-if="vm.task.editable['classification']">
						<select ng-model='vm.classification' ng-options='option for option in vm.classification_options.values'></select>
						<div class='editable-content-buttons'>
							<a class='elgg-button elgg-button-action elgg-button-cancel' data-id="classification" ng-click="vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:cancel'); ?></a>
							<a class='elgg-button elgg-button-action elgg-button-accept' data-id="classification" ng-click="vm.update('classification'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
						</div>
					</div>
				</div>
			</div>

			<div class="task-sidebar-row clearfix">
				<div class="col-sm-12 field-header">
					<label><?php echo elgg_echo('tasks:departmentOwner'); ?></label>
					<a class='glyphicon edit-button department_owner' data-id="department_owner" ng-if="user.task_admin" ng-click="vm.toggleEditMode($event)"></a>
				</div>
				<div class="col-sm-12 field-body">
					<p data-field-id="department_owner">{{vm.task.department_owner}}</p>

					<div ng-if="vm.task.editable['department_owner']">
						<select ng-model='vm.department_owner' ng-options='option for option in vm.department_options.values'></select>
						<div class='editable-content-buttons'>
							<a class='elgg-button elgg-button-action elgg-button-cancel' data-id="department_owner" ng-click="vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:cancel'); ?></a>
							<a class='elgg-button elgg-button-action elgg-button-accept' data-id="department_owner" ng-click="vm.update('department_owner'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
						</div>
					</div>
				</div>
			</div>

			<div class="task-sidebar-row clearfix">
				<div class="col-sm-12 field-header">
					<label><?php echo elgg_echo('tasks:status'); ?></label>
					<a class='glyphicon edit-button status' data-id="status" ng-if="user.task_admin" ng-click="vm.toggleEditMode($event)"></a>
				</div>
				<div class="col-sm-12 field-body">
					<p data-field-id="status">{{vm.task.status}}</p>

					<div ng-if="vm.task.editable['status']">
						<select ng-model='vm.status' ng-options='status.name as status.name for status in vm.statuses'></select>
						<div class='editable-content-buttons'>
							<a class='elgg-button elgg-button-action elgg-button-cancel' data-id="status" ng-click="vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:cancel'); ?></a>
							<a class='elgg-button elgg-button-action elgg-button-accept' data-id="status" ng-click="vm.update('status'); vm.toggleEditMode($event)"><?php echo elgg_echo('tasks:accept'); ?></a>
						</div>
					</div>
				</div>
			</div>

			<div class="task-sidebar-row clearfix">
				<div class="col-sm-12 field-header">
					<label><?php echo elgg_echo('tasks:percentage'); ?></label>
						<a class='glyphicon edit-button percentage fade' data-id="percentage" ng-show="!vm.task.editable['percentage'] && vm.task.status=='In Progress' && user.task_admin" ng-click="vm.toggleEditMode_variant($event)"></a>
						<a class='glyphicon success-button percentage fade' data-id="percentage" ng-show="vm.task.editable['percentage']" ng-click="vm.update('percentage'); vm.toggleEditMode_variant($event)"></a>
				</div>
				<div class="col-sm-12 field-body">
					<p data-field-id="percentage">{{vm.percentage}}</p>
					<div class="fade" ng-if="vm.task.editable['percentage']">
						<div ui-slider data-min="0" data-max="100" data-step="5" data-tick ng-model="vm.percentage"></div>
						<p class="helper-text"><?php echo elgg_echo('tasks:checkmark:helper');?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
