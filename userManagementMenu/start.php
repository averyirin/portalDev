<?php
/**
 * Elgg Webservice plugin
 *
 * @package Webservice
 * @author Mark Harding (based on work started by Saket Saurabh)
 *
 */
function userManagementMenuInit() {

  if (elgg_is_admin_logged_in() && ((elgg_get_context()=='admin')) {
      
  }
  /*
    $item = new ElggMenuItem('test', "Test Link", elgg_get_site_url().'usermgmt/all');
    elgg_register_menu_item('page',$item);
  }
  */
}

elgg_register_event_handler('init', 'system', 'userManagementMenuInit');
