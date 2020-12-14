<?php

class Home extends Controller {

    var $title = "";

    function Home() {
        parent::Controller();

        $this->load->library('Table');
        $this->load->library('Pagination');
        $this->load->library('DX_Auth');
        $this->load->library('Form_validation');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('Skins');
        $this->load->model('Language');
        $this->load->model('Subscribers');
        $this->load->model('mgenre');
        $this->load->model('Occation');
        $this->load->model('greeting');
        $this->load->model('rooms');
        $this->load->model('message');
        $this->load->model('Devices');
        $this->load->model('dx_auth/users');
        $this->load->model('restaurant');
        $this->load->model('themes/Themes_model');
        $this->dx_auth->check_uri_permissions();
    }

    function index() {
        $data['main'] = 'home';
        $this->load->view('template', $data);
    }

}

?>