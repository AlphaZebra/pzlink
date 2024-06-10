<?php

	global $wpdb;


	$item = array(
		'id' => 0,
		'tenant_ID' =>  '',
		'app_id' => '',
		'link_name' => '',
		'link_url' => '',
		'link_image_url' => '',
		'link_description' => '',
		'link_tag' => '',
		'live_date' => '',
		'end_date' => '',
		'link_owner' => '',
		'created' => '',
	);
	
	if(isset($_GET['link'])) {
		$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}pz_link WHERE id = {$_GET['link']}", ARRAY_A );

		$item = $results[0];
	} else {
		
	}

	

	?>
	
	<form action="<?php echo esc_url(admin_url('admin-post.php')) ?>" method="POST" class="form-style-1">
		<input type="hidden" name="action" value="do-link-form" required>
		<input type="hidden" name="id" value="<?php echo $item['id'] ?>" required>
		<input type="hidden" name="tenant_ID" value="<?php echo $item['tenant_ID'] ?>" required>
		<input type="hidden" name="redirectURL" value="<?php echo $attributes['redirectURL'] ?>" required>
			
		
			<label>Link</label>
			<input type="text" name="link_name" class="field-long" value="<?php echo $item['link_name'] ?>" />
			<label>Link URL</label>
			<input type="text" name="link_url" class="field-long" value="<?php echo $item['link_url'] ?>" />
			
			<label>Link image URL</label>
			<input type="text" name="link_image_url" class="field-long" value="<?php echo $item['link_image_url'] ?>"  />
			<label>Link description</label>
			<input type="text" name="link_description" class="field-long" value="<?php echo $item['link_description'] ?>"  />
			<label>Link tag</label>
			<input type="text" name="link_tag" class="field-long" value="<?php echo $item['link_tag'] ?>"  />
			<label>Live date</label>
			<input type="date" name="live_date" class="field-divided" value="<?php echo $item['live_date'] ?>"  />
			<label>End date</label>
			<input type="date" name="end_date" class="field-divided" value="<?php echo $item['end_date'] ?>"  />
			<input type="submit" value="Save" />
		</form>
	
	

