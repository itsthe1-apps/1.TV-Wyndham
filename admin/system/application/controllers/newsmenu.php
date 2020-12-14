<?php

class NewsMenu extends Controller {

    var $title = "";
    var $session_keyword = "newsmenu";

    function NewsMenu() {
        parent::Controller();
        $this->load->library('DX_Auth');
        $this->load->library('Form_validation');
        $this->load->library('Validation');
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('MAdmins');
        $this->load->model('MAlbum');
        $this->load->model('MArtist');
        $this->load->model('MGames');
        $this->load->model('MGenre');
        $this->load->model('MovieGenre');
        $this->load->model('MProducts');
        $this->load->model('MRestaurent');
        $this->load->model('MSong');
        $this->load->model('NEWS');
        $this->load->model('MTV');
        $this->load->model('EPG');
        $this->load->model('Metadata');
        $this->load->model('PRating');
        $this->load->model('MProgram');
        $this->load->model('Category');
        $this->load->model('Leftmenu');
        //$this->load->model('TVclass');

        $this->dx_auth->check_uri_permissions();
        if (in_array($this->uri->segment(1), unserialize(BLOCKED_MODULES))) {
            redirect('', 'refresh');
        }
    }

    function index() {
        $data['session_keyword'] = $this->session_keyword;
        $config['base_url'] = base_url() . 'index.php/newsmenu/';
        $config['total_rows'] = $this->db->count_all('news');
        $config['per_page'] = RECORDS_PERPAGE;
        $this->pagination->initialize($config);
        $data['pageination'] = $this->pagination->create_links();
        $data['tv'] = $this->NEWS->getAllnews($config['per_page'], $this->uri->segment(3), $data['session_keyword']);
        $data['title'] = 'News';
        $data['main'] = 'news';
        $this->load->vars($data);
        $this->load->view('template');
    }

    //subscribers = guest 

    function addnews() {
        $data['session_keyword'] = $this->session_keyword;
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('summary', 'Summary', 'required');
            //$this->form_validation->set_rules('fullnews', 'Full News', 'required');

            if ($this->form_validation->run() == TRUE) {
                $this->NEWS->addnews();
                $this->session->set_flashdata('tv_c', "News created");
                redirect('newsmenu', 'location');
            }
        }

        $data['title'] = "Create News";
        $data['main'] = 'create_news';
        $this->load->vars($data);
        $this->load->view('template');
    }

    function editnews($id = 0) {
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('summary', 'Summary', 'required');
            //$this->form_validation->set_rules('fullnews', 'Full News', 'required');

            if ($this->form_validation->run() == TRUE) {
                $this->NEWS->Updatenews();
                $this->session->set_flashdata('tv_c', "News updated");
                redirect('newsmenu', 'location');
            }
        }

        $data['title'] = "Edit News";
        $data['main'] = 'edit_news';
        $data['category'] = $this->NEWS->getnews($id);
        $this->load->vars($data);
        $this->load->view('template');
    }

    function deletenews($id) {
        $this->NEWS->deletenews($id);
        $this->session->set_flashdata('tv_d', 'News deleted');
        redirect('newsmenu', 'location');
    }

}

?>