<?php
/**
 * Tasks search
 *
 */
$url = elgg_get_site_url() . 'tasks/search';
$body = elgg_view_form('task_registry/find', array(
	'action' => $url,
	'method' => 'get',
	'disable_security' => true,
));

echo elgg_view_module('aside', elgg_echo('tasks:searchname'), $body);
