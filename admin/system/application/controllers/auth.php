<?php
class Auth extends Controller
{
	// Used for registering and changing password form validation
	var $min_username = 4;
	var $max_username = 20;
	var $min_password = 4;
	var $max_password = 20;

	function Auth()
	{
		parent::Controller();
                $this->load->library('Table');
		$this->load->library('Pagination');
		$this->load->library('Form_validation');
		$this->load->library('DX_Auth');			
		
		$this->load->helper('url');
		$this->load->helper('form');
                //$this->dx_auth->check_uri_permissions();
                //BLOCKED_MODULES
                /*
                if (in_array($this->uri->segment(1), unserialize(BLOCKED_MODULES))){
                    redirect('index.php','refresh');
                }
                 * 
                 */
	}
	
	function index()
	{
		$this->login();
	}
	
	/* Callback function */
	
	function username_check($username)
	{
		$result = $this->dx_auth->is_username_available($username);
		if ( ! $result)
		{
			$this->form_validation->set_message('username_check', 'Username already exist. Please choose another username.');
		}
				
		return $result;
	}

	function email_check($email)
	{
		$result = $this->dx_auth->is_email_available($email);
		if ( ! $result)
		{
			$this->form_validation->set_message('email_check', 'Email is already used by another user. Please choose another email address.');
		}
				
		return $result;
	}

	function captcha_check($code)
	{
		$result = TRUE;
		
		if ($this->dx_auth->is_captcha_expired())
		{
			// Will replace this error msg with $lang
			$this->form_validation->set_message('captcha_check', 'Your confirmation code has expired. Please try again.');			
			$result = FALSE;
		}
		elseif ( ! $this->dx_auth->is_captcha_match($code))
		{
			$this->form_validation->set_message('captcha_check', 'Your confirmation code does not match.');			
			$result = FALSE;
		}

		return $result;
	}
	
	function recaptcha_check()
	{
		$result = $this->dx_auth->is_recaptcha_match();		
		if ( ! $result)
		{
			$this->form_validation->set_message('recaptcha_check', 'Your confirmation code does not match.');
		}
		
		return $result;
	}	
	
	/* End of Callback function */
	
	function login()
	{

            $data['title'] = $this->lang->line('title_login');
		if ( ! $this->dx_auth->is_logged_in())
		{
			$val = $this->form_validation;
			
			// Set form validation rules
			$val->set_rules('username', 'Username', 'trim|required|xss_clean');
			$val->set_rules('password', 'Password', 'trim|required|xss_clean');
			$val->set_rules('remember', 'Remember me', 'integer');

			// Set captcha rules if login attempts exceed max attempts in config
			/**
			if ($this->dx_auth->is_max_login_attempts_exceeded())
			{
				$val->set_rules('captcha', 'Confirmation Code', 'trim|required|xss_clean|callback_captcha_check');
			}
			**/
				
			if ($val->run() AND $this->dx_auth->login($val->set_value('username'), $val->set_value('password'), $val->set_value('remember')))
			{
				// Redirect to homepage
				redirect('', 'location');
			}
			else
			{
				// Check if the user is failed logged in because user is banned user or not
				if ($this->dx_auth->is_banned())
				{
					// Redirect to banned uri
					//$this->dx_auth->deny_access('banned');
					$data['bannedMsg'] = "You don't have permission to login yet.";
					$data['main'] =$this->dx_auth->login_view;
					$this->load->view('template',$data);
				}
				else
				{						
                                        // Default is we don't show captcha until max login attempts eceeded
					$data['show_captcha'] = FALSE;
				
					// Show captcha if login attempts exceed max attempts in config
					if ($this->dx_auth->is_max_login_attempts_exceeded())
					{
						// Create catpcha						
						$this->dx_auth->captcha();
						
						// Set view data to show captcha on view file
						$data['show_captcha'] = FALSE;
					}
					
					// Load login page view
					//$this->load->view($this->dx_auth->login_view, $data);
					$data['main'] =$this->dx_auth->login_view;
					$this->load->vars($data);
					$this->load->view('template',$data);
				}
			}
		}
		else
		{
			$data['auth_message'] = 'You are already logged in.';
			//$this->load->view($this->dx_auth->logged_in_view, $data);
			$data['main'] =$this->dx_auth->logged_in_view;
			$this->load->vars($data);
			$this->load->view('template',$data);
		}
	}
	
	function logout()
	{
		$this->dx_auth->logout();
			
		$this->load->view($this->dx_auth->logout_view);
		
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
			$val->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback_email_check');
			//$val->set_rules('company', 'Company', 'required');
			$val->set_rules('role', 'Group', 'trim|required|xss_clean');
			if ($this->dx_auth->captcha_registration)
			{
				$val->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback_captcha_check');
			}

			// Run form validation and register user if it's pass the validation
			if ($val->run() AND $this->dx_auth->register($val->set_value('username'), $val->set_value('password'), $val->set_value('contact_no'), $val->set_value('email'),  $val->set_value('role')))
			{	
				if($this->dx_auth->is_logged_in())
				{
					redirect('auth/users/added','location');
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
			if (   $val->run() AND  $this->dx_auth->edit_ip($this->input->post('user_id'), $val->set_value('username'), $val->set_value('password'), $val->set_value('contact_no'), $val->set_value('email'), $val->set_value('role')))
			{	
				//redirect('backend/users', 'location');
				if($this->dx_auth->is_logged_in())
				{
					redirect('auth/users/updated','location');
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
				$data['user_email']				= $this->input->post('email');
				$data['user_role']				= $this->input->post('role');
				
				$data['main'] = $this->dx_auth->update_view;
				$this->load->vars($data);
				$this->load->view('template',$data);
			}
			$data['auth_message'] = 'Registration has been disabled.';
	}
	
	
	function register_recaptcha()
	{
		if ( ! $this->dx_auth->is_logged_in() AND $this->dx_auth->allow_registration)
		{	
			$val = $this->form_validation;
			
			// Set form validation rules
			$val->set_rules('username', 'Username', 'trim|required|xss_clean|min_length['.$this->min_username.']|max_length['.$this->max_username.']|callback_username_check|alpha_dash');
			$val->set_rules('password', 'Password', 'trim|required|xss_clean|min_length['.$this->min_password.']|max_length['.$this->max_password.']|matches[confirm_password]');
			$val->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean');
			$val->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback_email_check');
			
			// Is registration using captcha
			if ($this->dx_auth->captcha_registration)
			{
				// Set recaptcha rules.
				// IMPORTANT: Do not change 'recaptcha_response_field' because it's used by reCAPTCHA API,
				// This is because the limitation of reCAPTCHA, not DX Auth library
				$val->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback_recaptcha_check');
			}

			// Run form validation and register user if it's pass the validation
			if ($val->run() AND $this->dx_auth->register($val->set_value('username'), $val->set_value('password'), $val->set_value('email')))
			{	
				// Set success message accordingly
				if ($this->dx_auth->email_activation)
				{
					$data['auth_message'] = 'You have successfully registered. Check your email address to activate your account.';
				}
				else
				{					
					$data['auth_message'] = 'You have successfully registered. '.anchor(site_url($this->dx_auth->login_uri), 'Login');
				}
				
				// Load registration success page
				$this->load->view($this->dx_auth->register_success_view, $data);
			}
			else
			{
				// Load registration page
				$this->load->view('auth/register_recaptcha_form');
			}
		}
		elseif ( ! $this->dx_auth->allow_registration)
		{
			$data['auth_message'] = 'Registration has been disabled.';
			$this->load->view($this->dx_auth->register_disabled_view, $data);
		}
		else
		{
			$data['auth_message'] = 'You have to logout first, before registering.';
			$this->load->view($this->dx_auth->logged_in_view, $data);
		}
	}
	
	function activate()
	{
		// Get username and key
		$username = $this->uri->segment(3);
		$key = $this->uri->segment(4);

		// Activate user
		if ($this->dx_auth->activate($username, $key)) 
		{
			$data['auth_message'] = 'Your account have been successfully activated. '.anchor(site_url($this->dx_auth->login_uri), 'Login');
			$this->load->view($this->dx_auth->activate_success_view, $data);
		}
		else
		{
			$data['auth_message'] = 'The activation code you entered was incorrect. Please check your email again.';
			$this->load->view($this->dx_auth->activate_failed_view, $data);
		}
	}
	
	function forgot_password()
	{
		$data['title'] = $this->lang->line('title_forgotpsd');
		$val = $this->form_validation;
		
		// Set form validation rules
		$val->set_rules('login', 'text', 'trim|required|xss_clean');

		// Validate rules and call forgot password function
		if ($val->run() AND $this->dx_auth->forgot_password($val->set_value('login')))
		{
			$data['auth_message'] = 'An email has been sent to your email with instructions with how to activate your new password.';
			$data['main'] = $this->dx_auth->forgot_password_success_view;
			$this->load->view('template', $data);
		}
		else
		{
			$data['main'] = $this->dx_auth->forgot_password_view;
			$this->load->view('template', $data);
		}
	}
	
	function reset_password()
	{
		// Get username and key
		$username = $this->uri->segment(3);
		$key = $this->uri->segment(4);

		// Reset password
		if ($this->dx_auth->reset_password($username, $key))
		{
			$data['auth_message'] = 'You have successfully reset you password, '.anchor(site_url($this->dx_auth->login_uri), 'Login');
			$this->load->view($this->dx_auth->reset_password_success_view, $data);
		}
		else
		{
			$data['auth_message'] = 'Reset failed. Your username and key are incorrect. Please check your email again and follow the instructions.';
			$this->load->view($this->dx_auth->reset_password_failed_view, $data);
		}
	}
	
	function change_password()
	{
		// Check if user logged in or not
		if ($this->dx_auth->is_logged_in())
		{			
			$val = $this->form_validation;
			
			// Set form validation
			$val->set_rules('old_password', 'Old Password', 'trim|required|xss_clean|min_length['.$this->min_password.']|max_length['.$this->max_password.']');
			$val->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->min_password.']|max_length['.$this->max_password.']|matches[confirm_new_password]');
			$val->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean');
			
			// Validate rules and change password
			if ($val->run() AND $this->dx_auth->change_password($val->set_value('old_password'), $val->set_value('new_password')))
			{
				$data['auth_message'] = 'Your password has successfully been changed.';
				$this->load->view($this->dx_auth->change_password_success_view, $data);
			}
			else
			{
				$this->load->view($this->dx_auth->change_password_view);
			}
		}
		else
		{
			// Redirect to login page
			$this->dx_auth->deny_access('login');
		}
	}	
	
	function cancel_account()
	{
		// Check if user logged in or not
		if ($this->dx_auth->is_logged_in())
		{			
			$val = $this->form_validation;
			
			// Set form validation rules
			$val->set_rules('password', 'Password', "trim|required|xss_clean");
			
			// Validate rules and change password
			if ($val->run() AND $this->dx_auth->cancel_account($val->set_value('password')))
			{
				// Redirect to homepage
				redirect('', 'location');
			}
			else
			{
				$this->load->view($this->dx_auth->cancel_account_view);
			}
		}
		else
		{
			// Redirect to login page
			$this->dx_auth->deny_access('login');
		}
	}

	// Example how to get permissions you set permission in /backend/custom_permissions/
	/*function custom_permissions()
	{
		if ($this->dx_auth->is_logged_in())
		{
			echo 'My role: '.$this->dx_auth->get_role_name().'<br/>';
			echo 'My permission: <br/>';
			
			if ($this->dx_auth->get_permission_value('edit') != NULL AND $this->dx_auth->get_permission_value('edit'))
			{
				echo 'Edit is allowed';
			}
			else
			{
				echo 'Edit is not allowed';
			}
			
			echo '<br/>';
			
			if ($this->dx_auth->get_permission_value('delete') != NULL AND $this->dx_auth->get_permission_value('delete'))
			{
				echo 'Delete is allowed';
			}
			else
			{
				echo 'Delete is not allowed';
			}
		}
	}
	*/
	function deny()
	{
		$data['title']	= "Access Denied";
		$data['main']	= "deny";
		$this->load->view('template', $data);
	}
        
    
	
	/** Enable or disable users from the application */
	function unactivated_users()
	{
		$this->load->model('dx_auth/user_temp', 'user_temp');
		
		/* Database related */
		
		// If activate button pressed
		if ($this->input->post('activate'))
		{
			// Search checkbox in post array
			foreach ($_POST as $key => $value)
			{
				// If checkbox found
				if (substr($key, 0, 9) == 'checkbox_')
				{
					// Check if user exist, $value is username
					if ($query = $this->user_temp->get_login($value) AND $query->num_rows() == 1)
					{
						// Activate user
						$this->dx_auth->activate($value, $query->row()->activation_key);
					}
				}				
			}
		}
		
		/* Showing page to user */
		
		// Get offset and limit for page viewing
		$offset = (int) $this->uri->segment(3);
		// Number of record showing per page
		$row_count = 10;
		
		// Get all unactivated users
		$data['users'] = $this->user_temp->get_all($offset, $row_count)->result();
		
		// Pagination config
		$p_config['base_url'] = '/auth/unactivated_users/';
		$p_config['uri_segment'] = 3;
		$p_config['num_links'] = 2;
		$p_config['total_rows'] = $this->user_temp->get_all()->num_rows();
		$p_config['per_page'] = $row_count;
				
		// Init pagination
		$this->pagination->initialize($p_config);		
		// Create pagination links
		$data['pagination'] = $this->pagination->create_links();
		
		// Load view
		$this->load->view('backend/unactivated_users', $data);
	}
	
	
}
?>