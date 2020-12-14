<html>
	<head><title>Manage Channel Permissions</title></head>
	<body>	
	<?php  				
		// Build drop down menu
		foreach ($roles as $role)
		{
			$options[$role->id] = $role->name;
		}

		// Change allowed uri to string to be inserted in text area
		/**
		if ( ! empty($allowed_uris))
		{
			$allowed_uris = implode("\n", $allowed_uris);
		}
		**/
		
		// Build form
		echo form_open($this->uri->uri_string());
		
		echo form_label('Role', 'role_name_label');
		echo form_dropdown('role', $options); 
		echo form_submit('show', 'Show Channel permissions'); 
		
		echo form_label('', 'uri_label');
				
		echo '<hr/>';
				
		echo 'Allowed STB IP (One IP per line) :<br/><br/>';
		
		
		
		echo form_textarea('allowed_uris', $allowed_uris); 
				
		echo '<br/>';
		echo form_submit('save', 'Save Channel Permissions');
		
		echo form_close();
	?>
	</body>
</html>