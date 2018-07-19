<?php

/* * **********************************************************************
 * Task Resigtry Plugin
 * ********************************************************************** */

elgg_register_event_handler('init', 'system', 'task_registry_init');

/**
 * Initialize the task registry plug-in
 */
function task_registry_init() {

    // register a library of helper functions
    elgg_register_library('elgg:task_registry', elgg_get_plugins_path() . 'task_registry/lib/task_registry.php');

    //register entity type for search
    elgg_register_entity_type('object', 'task_registry');

    // Set up the menu
    $item = new ElggMenuItem('task_registry', elgg_echo('tasks'), 'tasks');
    elgg_register_menu_item('site', $item);

    // register a task handler, so we can have nice URLs
    elgg_register_page_handler('tasks', 'tasks_page_handler');

    // Register URL handlers for tasks
    elgg_register_entity_url_handler('object', 'task_registry', 'tasks_url');

    // Register some actions
    //$action_base = elgg_get_plugins_path() . 'task_registry/actions/task_registry';
    //elgg_register_action("tasks/edit", "$action_base/edit.php");
    //elgg_register_action("tasks/delete", "$action_base/delete.php");
    //elgg_register_action("requests/add", "$action_base/add.php");
}

/**
 * Override the task url
 *
 * @param ElggObject $entity Page object
 * @return string
 */
function tasks_url($entity) {
    $title = elgg_get_friendly_title($entity->title);

    return "tasks/view/{$entity->guid}/$title";
}

/**
 *
 * @param array $task
 * @return bool
 */
function tasks_page_handler($task) {

    if (!isset($task[0])) {
        $task[0] = 'all';
    }

    elgg_push_breadcrumb(elgg_echo('tasks'), 'tasks');

    $base_dir    = elgg_get_plugins_path() . 'task_registry/pages/task_registry';
    $angular_dir = elgg_get_plugins_path() . 'task_registry/js/views';

    switch ($task[0]) {
        case 'all':
            include "$base_dir/all.php";
            break;
        case 'list':
            include "$angular_dir/list.php";
            break;
        case 'add':
            include "$angular_dir/add.php";
            break;
        case 'view':
            include "$angular_dir/view.php";
            break;
        case 'edit':
            include "$angular_dir/edit.php";
            break;
        case 'sidebar':
            include "$angular_dir/sidebar.php";
            break;
        case 'toc':
            include "$angular_dir/toc.php";
            break;
        case 'messages':
            include "$angular_dir/messages.php";
            break;
        case 'add_admin':
            include "$angular_dir/add_admin.php";
            break;
        case 'manage_admins':
            include "$angular_dir/manage_admins.php";
            break;
        case 'dashboard':
            include "$angular_dir/dashboard.php";
            break;
        default:
            return false;
    }

    return true;
}
