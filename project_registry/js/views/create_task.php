<?php
?>
	<div>Create task form</div>
<div ng-show='vm.loaded'>
	<div class='template-header'>
		<h2>{{vm.project.title}} Title</h2>
		<a href='#/projects' class='elgg-button elgg-button-action'><?php echo elgg_echo('projects:all:list'); ?></a>
        <a ng-click="vm.print()" href='' target='_blank' class='elgg-button elgg-button-action'><?php echo elgg_echo('projects:print'); ?></a>
		<div class="project-brief-info">
			<div class='submitted' ng-if="vm.project.status=='Submitted'">
				<span class='glyphicon exclamation'></span>
				<p>{{vm.project.status}}</p>
			</div>
			<div class='under-review' ng-if="vm.project.status=='Under Review'">
				<span class='glyphicon exclamation'></span>
				<p>{{vm.project.status}}</p>
			</div>
			<div class='in-progress' ng-if="vm.project.status=='In Progress'">
				<span class='glyphicon exclamation'></span>
				<p>{{vm.project.status}}</p>
			</div>
			<div class='completed' ng-if="vm.project.status=='Completed'">
				<span class='glyphicon exclamation'></span>
				<p>{{vm.project.status}}</p>
			</div>
			<h4><?php echo elgg_echo('projects:submittedBy');?>: <span>{{vm.project.owner}}</span> <?php echo elgg_echo('projects:on');?> {{vm.project.time_created}}</h4>
		</div>
	</div>
</div>
