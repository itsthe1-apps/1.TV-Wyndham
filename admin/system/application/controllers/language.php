<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Language extends Controller
{	
	function Language(){
		parent::Controller();
		$this->load->library('DX_Auth');
		$this->dx_auth->check_uri_permissions();
		$this->load->helper('form');
		$this->load->helper('url');
	}
	
	function LanguageChanger(){
		$key = isset($_POST['language']) ? $_POST['language'] : $this->config->item('system_lang');
		$session_keyword = isset($_POST['sessionkey']) ? $_POST['sessionkey'] : '';
		if($session_keyword!=""){
			$this->session->set_userdata($session_keyword,$key);
			print 1;
		}
	}
}