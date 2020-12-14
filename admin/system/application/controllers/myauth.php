<?php
class MyAuth extends Controller
{
	// Used for registering and changing password form validation
	var $min_username = 4;
	var $max_username = 20;
	var $min_password = 4;
	var $max_password = 20;

	function MyAuth()
	{
		parent::Controller();
                $this->load->library('Table');
		$this->load->library('Pagination');
		$this->load->library('Form_validation');
		$this->load->library('DX_Auth');			
		
		$this->load->helper('url');
		$this->load->helper('form');
                $this->dx_auth->check_uri_permissions();
                //BLOCKED_MODULES        
                if (in_array($this->uri->segment(1), unserialize(BLOCKED_MODULES))){
                    redirect('','refresh');
                }   
	}
	
	function index()
	{
		$this->users();
	}
	
	/* Callback function */
	
        
        function users($msg=FALSE)
	{
		$data['title'] = $this->lang->line('title_users'); 
		$this->load->model('dx_auth/users', 'users');
					
		/** Setting orderby */
		$order_val = $this->input->post('order_val');
		if(!empty($order_val))
		{
			$exp 	= explode("-",$order_val);
			if($exp[0]=="ob"){
				$this->session->set_userdata('orderby', $exp[1].' asc'); 
			}else if($exp[0]=="remove")
			{
				$this->session->set_userdata('orderby', $exp[1].' desc'); 
			}
		}
		
		if (isset($_POST['user_register']))
		{
			redirect('/myauth/register','location');
		}else if(isset($_POST['user_edit']))
		{
			redirect('/myauth/edit/'.$_POST['clicked_user'],'location');
		}
		
		//Display message
		$count = count($_POST);
		
		if(isset($_POST['user_delete']) && $count==1){
			$data['not_found'] = "User cannot be found to delete."; 
		}else if(isset($_POST['ban']) && $count==1){
			$data['not_found'] = "User cannot be found to block."; 
		}else if(isset($_POST['unban']) && $count==1){
			$data['not_found'] = "User cannot be found to allow."; 
		}
		
		// Search checkbox in post array
		foreach ($_POST as $key => $value)
		{
			// If checkbox found
			if (substr($key, 0, 9) == 'checkbox_')
			{
				// If ban button pressed
				if (isset($_POST['ban']))
				{
					// Ban user based on checkbox value (id)
					$msg=FALSE;
					$this->users->ban_user($value);
				}
				// If unban button pressed
				else if (isset($_POST['unban']))
				{
					// Unban user
					$msg=FALSE;
					$this->users->unban_user($value);
				}
				else if (isset($_POST['user_delete']))
				{
					// Delete user
					$msg=FALSE;
					$this->users->delete_user($value);
				}
				
				
				// If unban button pressed
				
				else if (isset($_POST['reset_pass']))
				{
					// Set default message
					$data['reset_message'] = 'Reset password failed';
				
					// Get user and check if User ID exist
					if ($query = $this->users->get_user_by_id($value) AND $query->num_rows() == 1)
					{		
						// Get user record				
						$user = $query->row();
						// Create new key, password and send email to user
						if ($this->dx_auth->forgot_password($user->username))
						{
							// Query once again, because the database is updated after calling forgot_password.
							$query = $this->users->get_user_by_id($value);
							// Get user record
							$user = $query->row();
														
							// Reset the password
							if ($this->dx_auth->reset_password($user->username, $user->newpass_key))
							{							
								$data['reset_message'] = 'Reset password success';
							}
						}
					}
				}
			}				
		}
		
		//Display success message
		if($msg==TRUE)
			{
				if($msg=="added")
					$data['msg'] = "User added.";
				else if($msg=="updated")
					$data['msg'] = "User updated.";
			}
		
		/* Showing page to user */
		
		// Get offset and limit for page viewing
		$offset = (int) $this->uri->segment(3);
		// Number of record showing per page
		$row_count = 20;
		// Get all users
		$data['users'] = $this->users->get_all($offset, $row_count)->result();
 
		// Pagination config
		$p_config['base_url'] = base_url().'index.php/myauth/users/';
		$p_config['uri_segment'] = 3;
		$p_config['num_links'] = 2;
		$p_config['total_rows'] = $this->users->get_all()->num_rows();
		$p_config['per_page'] = $row_count;
				
		// Init pagination
		$this->pagination->initialize($p_config);		
		// Create pagination links
		$data['pagination'] = $this->pagination->create_links();
		
		// Load view
		//$this->load->view('backend/users', $data);
		$data['main'] ='backend/users';
		$this->load->vars($data);
		$this->load->view('template',$data);
	}
	
	
	/** Internely call to another method for add user groups or roles */
	function addroles()
	{
		$this->title 	= $this->lang->line('usr_group_add_title');
		$this->heading	= $this->lang->line('usr_group_add_heding');
		
		$this->addeditroles(); 
	}
	
	/** Internely call to another method with selected role or group id for edit */
	function editroles($id)
	{
		$this->title 	= $this->lang->line('usr_group_edit_title');
		$this->heading	= $this->lang->line('usr_group_edit_heding');
		
		$this->addeditroles($id);
	}
	
	/** Load user roles or groups which are available in the application */
	function roles($msg=FALSE)
	{		
		$this->load->model('dx_auth/roles', 'roles');
		$data['title'] = $this->lang->line('usr_group_title');
		/* Database related */
		/** Setting orderby */
			$order_val = $this->input->post('order_val');
			if(!empty($order_val))
			{
				$exp 	= explode("-",$order_val);
				if($exp[0]=="ob"){
					$this->session->set_userdata('orderby', $exp[1].' asc'); 
				}else if($exp[0]=="remove")
				{
					$this->session->set_userdata('orderby', $exp[1].' desc'); 
				}
			}
		// Redirect add roles[group] page
		$count = count($_POST);
		if($this->input->post('addGroup'))
		{
			redirect('myauth/addroles','location');
		}else if($this->input->post('editGroup'))
		{
			redirect('myauth/editroles/'.$this->input->post('group_id'),'location');
		}

		else if ($this->input->post('delete'))
		{				
			// Loop trough $_POST array and delete checked checkbox
				if($this->input->post('checkbox_me'))
				{
					$delete_value = $this->input->post('checkbox_me');
					
					foreach ($delete_value as $key => $value)
						{
							$msg=FALSE;
							// Check delete roles whether connected with tickets or not.
							$is_groups = $this->roles->groups_exist_users($value);
														 
							if($is_groups>0)
							{
								$data['not_found']= "Faild to delete using groups!";
							}
							if($is_groups==0)
							{
								$this->roles->delete_role($value);
							}
						}
					
				}else{
					$data['not_found'] = "Data cannot be found to delete.";
				}
		}
		
		// Display added or updated message
			if($msg==TRUE)
			{
				if($msg=="added")
					$data['msg'] = "Group added.";
				else if($msg=="updated")
					$data['msg'] = "Group updated.";
			}
		
		/* Showing page to user */
	
		// Get all roles from database
		$data['roles'] = $this->roles->get_all()->result();
		
		// Load view
		//$this->load->view('backend/roles', $data);
		$data['main'] = 'backend/roles';
		$this->load->vars($data);
		$this->load->view('template',$data);
	}
	
	/** This method for add/edit user roles or groups */
	function addeditroles($id=FALSE)
	{
		$data['title']	 = $this->title;
		$data['heading'] = $this->heading;
		
		$this->load->model('dx_auth/roles', 'roles');
		
			// If Add role button pressed
		if ($this->input->post('add') || $this->input->post('edit'))
		{
			// Validation
			$this->form_validation->set_rules('role_name', 'Group name', 'trim|required|xss_clean');
		}
		
		if ($this->input->post('add'))
		{
			// Create role
			if ($this->form_validation->run() == TRUE)
			{
				$this->roles->create_role($this->input->post('role_name'), $this->input->post('role_parent'));
				redirect('myauth/roles/added','location');
			}
		}
		
		// Update group
		if($id==TRUE)
		{
			// Retrive for edit
			foreach ($this->roles->get_role_by_id($id)->result() as $row)
			{
				if($this->input->post('getId')=="")
				{
					$data['role_id'] = $row->id;
					$data['name']    = $row->name;
				}
			}
						
			if($this->input->post('edit'))
				{
					if ($this->form_validation->run() == TRUE)
					{
						$this->roles->updateRole($id);
						redirect('myauth/roles/updated','location');
					}
				}
			
		}
		$data['main']  = 'backend/add_edit_roles';
		$this->load->vars($data);
		$this->load->view('template',$data);
	}
	
	function user_view($id)
	{
		$this->load->model('dx_auth/users', 'users');
		$data['users']	= $this->users->get_user_view($id)->result();
		//print_r($data['users']);
		$this->load->view('backend/user_view.php', $data);
	}
	
	/** Set user uri permissions */
	function uri_permissions()
	{
		$data['title'] 	= $this->lang->line('perm_title');
		$data['heading']= $this->lang->line('perm_heading');
				
		function trim_value(&$value) 
		{ 
			$value = trim($value); 
		}
	
		$this->load->model('dx_auth/roles', 'roles');
		$this->load->model('dx_auth/permissions', 'permissions');
		
		if ($this->input->post('is_submit')!="")
		{
			// Convert back text area into array to be stored in permission data
			$allowed_uris = explode("\n", $this->input->post('allowed_uris'));
			
			// Remove white space if available
			array_walk($allowed_uris, 'trim_value');
		
			// Set URI permission data
			// IMPORTANT: uri permission data, is saved using 'uri' as key.
			// So this key name is preserved, if you want to use custom permission use other key.
			$this->permissions->set_permission_value($this->input->post('role'), 'uri', $allowed_uris);
		}
		
		/* Showing page to user */		
		
		$data['tabs'] = $this->roles->tabs()->result();
		
		// Default role_id that will be showed
		$role_id = $this->input->post('role') ? $this->input->post('role') : 1;
		
		// Get all role from database
		$data['roles'] = $this->roles->get_all()->result();
		// Get allowed uri permissions
		
		$data['allowed_uris'] = $this->permissions->get_permission_value($role_id, 'uri');
		
		// Load view
		
		//	$this->load->view('backend/uri_permissions', $data);
		$data['main'] = 'backend/uri_permissions';
		$this->load->vars($data);
		$this->load->view('template',$data);
	}
	
	/** Set custom permissions */
	function custom_permissions()
	{
		redirect('','location');
		// Load models
		$this->load->model('dx_auth/roles', 'roles');
		$this->load->model('dx_auth/permissions', 'permissions');
	
		/* Get post input and apply it to database */
		
		// If button save pressed
		if ($this->input->post('save'))
		{
			// Note: Since in this case we want to insert two key with each value at once,
			// it's not advisable using set_permission_value() function						
			// If you calling that function twice that means, you will query database 4 times,
			// because set_permission_value() will access table 2 times, 
			// one for get previous permission and the other one is to save it.
			
			// For this case (or you need to insert few key with each value at once) 
			// Use the example below
		
			// Get role_id permission data first. 
			// So the previously set permission array key won't be overwritten with new array with key $key only, 
			// when calling set_permission_data later.
			$permission_data = $this->permissions->get_permission_data($this->input->post('role'));
		
			// Set value in permission data array
			$permission_data['edit'] = $this->input->post('edit');
			$permission_data['delete'] = $this->input->post('delete');
			
			// Set permission data for role_id
			$this->permissions->set_permission_data($this->input->post('role'), $permission_data);
		}
	
		/* Showing page to user */		
		
		// Default role_id that will be showed
		$role_id = $this->input->post('role') ? $this->input->post('role') : 1;
		
		// Get all role from database
		$data['roles'] = $this->roles->get_all()->result();
		// Get edit and delete permissions
		$data['edit'] = $this->permissions->get_permission_value($role_id, 'edit');
		$data['delete'] = $this->permissions->get_permission_value($role_id, 'delete');
	
		// Load view
		$this->load->view('backend/custom_permissions', $data);
	}
        
        function register()
	{		
		if ($this->dx_auth->is_logged_in() && $this->dx_auth->is_admin())
		{
			
			$data['title'] = $this->lang->line('title_register');	
			$this->load->model('dx_auth/roles', 'roles');
			
			$val = $this->form_validation;
			
			// Set form validation rules			
			$val->set_rules('username', 'Username', 'trim|required|xss_clean|min_length['.$this->min_username.']|max_length['.$this->max_username.']|callback_username_check|alpha_dash');
			$val->set_rules('password', 'Password', 'trim|required|xss_clean|min_length['.$this->min_password.']|max_length['.$this->max_password.']|matches[confirm_password]');
			$val->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean');
			if($this->input->post('contact_no')!="")
			{
				$this->form_validation->set_rules('contact_no', 'Contact', 'trim|required|xss_clean|is_numeric');
			}
                        if($this->input->post('staff_code')!="")
			{
				$this->form_validation->set_rules('staff_code', 'Staff Code', 'trim');
			}
			$val->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback_email_check');
			//$val->set_rules('company', 'Company', 'required');
			$val->set_rules('role', 'Group', 'trim|required|xss_clean');
			if ($this->dx_auth->captcha_registration)
			{
				$val->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback_captcha_check');
			}

			// Run form validation and register user if it's pass the validation
			if ($val->run() AND $this->dx_auth->register($val->set_value('username'), $val->set_value('password'), $val->set_value('contact_no'), $val->set_value('email'),  $val->set_value('role'),$val->set_value('staff_code')))
			{	
				if($this->dx_auth->is_logged_in())
				{
					redirect('myauth/users/added','location');
				}else{
					$data['auth_message'] = 'User added.';
					$data['main'] = $this->dx_auth->register_success_view;
					$this->load->vars($data);
					$this->load->view('template',$data);
				}
			}
			else
			{
				// Is registration using captcha
				if ($this->dx_auth->captcha_registration)
				{
					$this->dx_auth->captcha();										
				}

				$data['roles'] 		= $this->roles->get_all()->result();
				//$data['companies']  = $this->roles->get_companies()->result();
				//$data['location']	= $this->roles->get_location()->result();
				// Load registration page
				//$this->load->view($this->dx_auth->register_view);
				$data['main'] = $this->dx_auth->register_view;
				$this->load->vars($data);
				$this->load->view('template',$data);
			}
		}else{
			redirect('index.php','refresh');
		}
		//elseif ( ! $this->dx_auth->allow_registration)
		//{
			$data['auth_message'] = 'Registration has been disabled.';
		//	$this->load->view($this->dx_auth->register_disabled_view, $data);
		//}
		//else
		//{
		//	$data['auth_message'] = 'You have to logout first, before registering.';
		//	$this->load->view($this->dx_auth->logged_in_view, $data);
		//}
	}
        
	function edit($id=false)
	{		
			$data['title'] = $this->lang->line('title_users_update');
			$val = $this->form_validation;
						
			// Run form validation and register user if it's pass the validation
			$val->set_rules('username', 'Username', 'trim|required|xss_clean|min_length['.$this->min_username.']|max_length['.$this->max_username.']|alpha_dash');
			$val->set_rules('password', 'Password', 'trim|required|xss_clean|matches[confirm_password]');
			$val->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean');
			if($this->input->post('contact_no')!="")
			{
				$this->form_validation->set_rules('contact_no', 'Contact', 'trim|required|xss_clean|is_numeric');
			}
			$val->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
			//$val->set_rules('company', 'Company', 'required');
			$val->set_rules('role', 'Group', 'trim|required|xss_clean');
			
			//Group Type
			$this->load->model('dx_auth/roles', 'roles');
			$data['admin_id']	= $id;
			$data['roles'] 		= $this->roles->get_all()->result();
			//print_r($data['roles']);
                        //$data['companies']  = $this->roles->get_companies()->result();
			//$data['location']	= $this->roles->get_location()->result();
			
			if ($this->dx_auth->captcha_registration)
			{
				$val->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback_captcha_check');
			}
			
			// Run form validation and register user if it's pass the validation
			if (   $val->run() AND  $this->dx_auth->edit_ip($this->input->post('user_id'), $val->set_value('username'), $val->set_value('password'), $val->set_value('contact_no'), $val->set_value('email'), $val->set_value('role'),$this->input->post('staff_code')))
			{	
				//redirect('backend/users', 'location');
				if($this->dx_auth->is_logged_in())
				{
					redirect('myauth/users/updated','location');
				}else{
					$data['auth_message'] = 'User updated.';
					$data['main'] = $this->dx_auth->register_success_view;
					$this->load->vars($data);
					$this->load->view('template',$data);
				}
			}
			else
			{
					$id = $this->uri->segment(3);
					$data['user']=array();
					if(!empty($id))
					{
		  				$user= $this->dx_auth->get_user_by_id($id);
						$data['user']=$user;
                                                //print_r($data);
					}
					
				
				// Is registration using captcha
				if ($this->dx_auth->captcha_registration)
				{
					$this->dx_auth->captcha();										
				}

				// Load registration page
				//$this->load->view($this->dx_auth->register_view);
				
				$data['user_post'] 				= $this->input->post('username');
				$data['user_passwd']			= $this->input->post('password');
				$data['user_confirm_password']	= $this->input->post('confirm_password');
				$data['user_contact']			= $this->input->post('contact_no');
                                $data['staff_code']			= $this->input->post('staff_code');
				$data['user_email']				= $this->input->post('email');
				$data['user_role']				= $this->input->post('role');
				
				$data['main'] = $this->dx_auth->update_view;
				$this->load->vars($data);
				$this->load->view('template',$data);
			}
			$data['auth_message'] = 'Registration has been disabled.';
	}
	
	
}
?>