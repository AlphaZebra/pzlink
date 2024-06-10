<?php

add_action('admin_post_do-link-form', 'do_link_form');
add_action('admin_post_nopriv_do-link-form', 'do_link_form');

/**
 * pz_link_form
 */





function do_link_form () {
	global $wpdb;
	$created = date("m/j/Y");
  
	$item = [];
  
	$item['id'] = sanitize_text_field($_POST['id']);
	$item['app_id'] = isset($_POST['app_ID']) ? sanitize_text_field($_POST['app_ID']) : 'none';
	$item['tenant_ID'] = isset($_POST['tenant_ID']) ? sanitize_text_field($_POST['tenant_ID']) : 'none';
	$item['link_name'] = isset($_POST['link_name']) ? sanitize_text_field($_POST['link_name']) : 'none';
	$item['link_url'] = isset($_POST['link_url']) ? sanitize_text_field($_POST['link_url']) : '';
	$item['link_description'] = isset($_POST['link_description']) ? sanitize_text_field($_POST['link_description']) : '';
	$item['link_tag'] = isset($_POST['link_tag']) ? sanitize_text_field($_POST['link_tag']) : '';
	$item['link_image_url'] = isset($_POST['link_image_url']) ? sanitize_text_field($_POST['link_image_url']) : '';
	$item['live_date'] = isset($_POST['live_date']) ? sanitize_text_field($_POST['live_date']) : '';
	$item['end_date'] = isset($_POST['end_date']) ? sanitize_text_field($_POST['end_date']) : 'none';
	$item['link_owner'] = isset($_POST['link_owner']) ? sanitize_text_field($_POST['link_owner']) : 'none';
	$item['created']= $created;
  
  
	$tablnam = $wpdb->prefix . "pz_link";
	// if we're updating, we'll use a different SQL command
	if(  $_POST['id'] > 0  )  {
		$item['id'] = $_POST['id'];
		
		if ($wpdb->update( $tablnam, $item, array('id' => $item['id']) ) < 0) {
		  var_dump($wpdb);
		  exit;
		}
		$pz_id = $item['id'];
		  
	} else {
		if( $wpdb->insert( $tablnam, $item ) <= 0 ) {  
			var_dump( $wpdb );
			exit;
		}
  
		$pz_id = $wpdb->insert_id;  // this is the id number of the record we just inserted
	}
  
   
	
	wp_redirect( $_POST['redirectURL']);
	exit;
  }