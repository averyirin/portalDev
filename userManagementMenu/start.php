<?php
/**
 * Elgg Webservice plugin
 *
 * @package Webservice
 * @author Mark Harding (based on work started by Saket Saurabh)
 *
 */
function userManagementMenuInit() {

        $item = new ElggMenuItem('test', "Test Link", elgg_get_site_url().'usermgmt/all');
      //  elgg_register_menu_item('page-administer',$item);
      elgg_register_menu_item('test_usermgmt', array(
                             "name" => "digest",
                             "text" => elgg_echo("digest:page_menu:theme_preview"),
                             "href" => "digest/test",
                             "context" => "theme_preview"
                     ));


        elgg_register_admin_menu_item("administer","test_usermgmt");
  /*
    $item = new ElggMenuItem('test', "Test Link", elgg_get_site_url().'usermgmt/all');
    elgg_register_menu_item('page',$item);
  }
  */
}

elgg_register_event_handler('init', 'system', 'userManagementMenuInit');
