<?php
/**
 * Plugin Name:       pzlink
 * Description:       Block that creates data grid for the link table.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.0.1
 * Author:            Robert Richardson
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       pzgrid
 *
 * @package           pzcontact
 */



 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define('PZ_LINK_PLUGIN_DIR', plugin_dir_path(__FILE__));

// links
include( PZ_LINK_PLUGIN_DIR . 'includes/link-rest.php');
include( PZ_LINK_PLUGIN_DIR . 'includes/pz-link-form.php');


/**
 * --------------------------------------------------------------------------------------
 * Build database at plugin activation... 
 */

 register_activation_hook(
	__FILE__,
	'pz_link_onActivate'
);

function pz_link_onActivate() {
  global $wpdb;
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php');

  $charset = $wpdb->get_charset_collate();

  
// link
$table_name = $wpdb->prefix . "pz_link";

$item = array();
$item['id'] = null;
$item['table_name'] = 'pz_link';
$item['field_string'] = "CREATE TABLE $table_name (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  tenant_id varchar(20) NOT NULL DEFAULT '',
  app_id varchar(20) NOT NULL DEFAULT '',
  link_name varchar(200) NOT NULL DEFAULT '',
  link_url varchar(255) NOT NULL DEFAULT '',
  link_image_url varchar(255) NOT NULL DEFAULT '',
  link_description varchar(800) NOT NULL DEFAULT '',
  link_tag varchar(120) NOT NULL DEFAULT '',
  live_date varchar(12) NOT NULL DEFAULT '',
  end_date varchar(12) NOT NULL DEFAULT '',
  link_owner varchar(180) NOT NULL DEFAULT 'unassigned',
  created varchar(12) NOT NULL DEFAULT '',
  PRIMARY KEY  (id)
) $charset;";

handle_def_record($item);
dbDelta($item['field_string']);

}

function create_block_pzlinkgrid_block_init() {
	register_block_type( __DIR__ . '/build/blocks/pzlinkgrid' );
}
add_action( 'init', 'create_block_pzlinkgrid_block_init' );

function create_block_pzlinkform_block_init() {
	register_block_type( __DIR__ . '/build/blocks/pzlinkform' );
}
add_action( 'init', 'create_block_pzlinkform_block_init' );




