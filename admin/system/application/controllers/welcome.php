<?php

class Welcome extends Controller {

    var $title = '';
    var $image_width = 375;
    var $image_height = 555;
    var $image_width_th = 105;
    var $image_height_th = 105;
    var $image_width_tv = 250;
    var $image_height_tv = 250;

    function Welcome() {
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
        $this->load->model('RGenre');
        //$this->load->model('TVclass');

        $this->dx_auth->check_uri_permissions();
        if (in_array($this->uri->segment(1), unserialize(BLOCKED_MODULES))) {
            redirect('', 'refresh');
        }
    }

    function index() {
        redirect('welcome/Tv/all/0', 'redirect');
    }

    function product($var1 = false, $var2 = false, $var3 = false) {
        $base_url = "$var1/$var2";

        // Get offset and limit for page viewing
        $offset = (int) $this->uri->segment(5);

        // Number of record showing per page
        $row_count = RECORDS_PERPAGE;

        // Get all companies
        $data['product'] = $this->MProducts->getAllProducts($offset, $row_count, $var2, $var3)->result();

        // Pagination config
        $p_config['base_url'] = base_url() . 'index.php/welcome/product/' . $base_url;
        $p_config['uri_segment'] = 5;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->MProducts->getAllProducts(false, false, $var2, $var3)->num_rows();
        $p_config['per_page'] = $row_count;

        // Init pagination
        $this->pagination->initialize($p_config);

        // Create pagination links
        $data['pagination'] = $this->pagination->create_links();

        $data['title'] = 'Movies';
        $data['main'] = 'product';
        $this->load->vars($data);
        $this->load->view('template');
    }

    function addproduct() {
        $data['genreName'] = "";
        $data['name'] = "";
        $data['GndrId'] = "";
        $data['prLevel'] = "";
        $data['prName'] = "";
        $data['path'] = "";
        $data['runtime'] = "";
        $data['description'] = "";
        $data['LangID'] = "";
        $data['mrl_t'] = "";

        $data['image_width'] = $this->image_width;
        $data['image_height'] = $this->image_height;
        $data['image_width_th'] = $this->image_width_th;
        $data['image_height_th'] = $this->image_height_th;

        $data['upload_file_error'] = "";
        $is_error = 0;

        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('name', 'Movie', 'required');
            $this->form_validation->set_rules('path', 'Path', 'required');
            $this->form_validation->set_rules('GndrId', 'Genre', 'required');

            $this->form_validation->set_rules('runtime', 'Duration', 'is_numeric|required');

            if ($this->input->post('prLevel')) {
                $this->form_validation->set_rules('prLevel', 'Parental Number', 'is_numeric');
            }
            $this->load->library('upload');
            $image_data = array();

            if (!empty($_FILES['icon']['name'])) {
                //print 'First';
                $config['upload_path'] = './icons/VOD/';
                $config['allowed_types'] = 'gif|jpg|png';
                //$config['max_size'] = '200';
                $config['remove_spaces'] = true;
                $config['overwrite'] = false;
                $config['max_width'] = $data['image_width'];
                $config['max_height'] = $data['image_height'];

                $this->upload->initialize($config);

                if ($this->form_validation->run() == TRUE) {
                    if (!$this->upload->do_upload('icon')) {
                        $error = $this->upload->display_errors();
                        $data['upload_file_error'] = $error;
                        $is_error = 1;
                    } else {
                        $image = $this->upload->data();
                        $image_data['logo'] = $image['file_name'];
                        $is_error = 0;
                    }
                }
            }

            if (!empty($_FILES['thumbnail']['name'])) {
                //print 'second';
                $config['upload_path'] = './icons/VOD/thumbnail/';
                $config['allowed_types'] = 'gif|jpg|png';
                //$config['max_size'] = '200';
                $config['remove_spaces'] = true;
                $config['overwrite'] = false;
                $config['max_width'] = $data['image_width_th'];
                $config['max_height'] = $data['image_height_th'];

                $this->upload->initialize($config);

                if ($this->form_validation->run() == TRUE) {
                    if (!$this->upload->do_upload('thumbnail')) {
                        $error = $this->upload->display_errors();
                        $data['upload_file_error_thumbnail'] = $error;
                        $is_error = 1;
                    } else {
                        $image = $this->upload->data();
                        $image_data['thumbnail'] = $image['file_name'];
                        $is_error = 0;
                    }
                }
            }

            if ($this->form_validation->run() == FALSE || $is_error == 1) {
                $data['genreName'] = $this->input->post('genreName');
                $data['name'] = $this->TVclass->Unhtmlentities($this->input->post('name'));
                $data['GndrId'] = $this->input->post('GndrId');
                $data['prLevel'] = $this->input->post('prLevel');
                $data['prName'] = $this->input->post('prName');
                $data['path'] = $this->input->post('path');
                $data['mrl_t'] = $this->input->post('mrl_trailer');
                $data['runtime'] = $this->input->post('runtime');
                $data['description'] = $this->input->post('description');
                $data['LangID'] = $this->input->post('LangID');
            } else {
                $this->MProducts->add($image_data);
                $this->session->set_flashdata('movie_c', "Movie created");
                redirect('welcome/product', 'location');
            }
        }

        $data['M_genre'] = $this->MovieGenre->vod_genreDropDown();
        $data['pRating'] = $this->MovieGenre->getpRatingDropDown();
        $data['title'] = "Create Movie";
        $data['main'] = 'createProduct';
        $this->load->vars($data);
        $this->load->view('template');
    }

    function edit($id = 0, $id_MG = 0) {
        $data['genreName'] = "";
        $data['name'] = "";
        $data['GndrId'] = "";
        $data['prLevel'] = "";
        $data['prName'] = "";
        $data['path'] = "";
        $data['runtime'] = "";
        $data['description'] = "";
        $data['LangID'] = "";

        $data['image_width'] = $this->image_width;
        $data['image_height'] = $this->image_height;
        $data['image_width_th'] = $this->image_width_th;
        $data['image_height_th'] = $this->image_height_th;

        $data['upload_file_error'] = "";
        $is_error = 0;

        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('name', 'Movie ', 'required');
            $this->form_validation->set_rules('path', 'Path', 'required');
            $this->form_validation->set_rules('GndrId', 'Genre', 'required');
            //$this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('runtime', 'Duration', 'required');

            if ($this->input->post('prLevel')) {
                $this->form_validation->set_rules('prLevel', 'Parental Number', 'is_numeric');
            }

            if ($this->input->post('runtime')) {
                $this->form_validation->set_rules('runtime', 'Duration', 'is_numeric');
            }

            $this->load->library('upload');
            $image_data = array();

            if (!empty($_FILES['icon']['name'])) {
                $config['upload_path'] = './icons/VOD/';
                $config['allowed_types'] = 'gif|jpg|png';
                //$config['max_size'] = '200';
                $config['remove_spaces'] = true;
                $config['overwrite'] = false;
                //$config['max_size']	= '100';
                $config['max_width'] = $data['image_width'];
                $config['max_height'] = $data['image_height'];

                $this->upload->initialize($config);

                if ($this->form_validation->run() == TRUE) {
                    if (!$this->upload->do_upload('icon')) {
                        $error = $this->upload->display_errors();
                        $data['upload_file_error'] = $error;
                        $is_error = 1;
                    } else {
                        //$filename = MOVIE_PATH . "\\" . $this->input->post('file_img_name');
                        $filename = './icons/VOD/' . $this->input->post('file_img_name');
                        if (file_exists($filename)) {
                            unlink($filename);
                        }
                        $image = $this->upload->data();
                        $image_data['logo'] = $image['file_name'];

                        $is_error = 0;
                    }
                }
            }

            if (!empty($_FILES['thumbnail']['name'])) {
                $config['upload_path'] = './icons/VOD/thumbnail/';
                $config['allowed_types'] = 'gif|jpg|png';
                //$config['max_size'] = '200';
                $config['remove_spaces'] = true;
                $config['overwrite'] = false;
                //$config['max_size']	= '100';
                $config['max_width'] = $data['image_width_th'];
                $config['max_height'] = $data['image_height_th'];
                $this->upload->initialize($config);

                if ($this->form_validation->run() == TRUE) {
                    if (!$this->upload->do_upload('thumbnail')) {
                        $error = $this->upload->display_errors();
                        $data['upload_file_error_thumbnail'] = $error;
                        $is_error = 1;
                    } else {
                        //$filename = MOVIE_PATH . "\\" . $this->input->post('file_img_name');
                        $filename = './icons/VOD/thumbnail/' . $this->input->post('file_thumbnailimg_name');
                        if (file_exists($filename)) {
                            unlink($filename);
                        }
                        $image = $this->upload->data();
                        $image_data['thumbnail'] = $image['file_name'];
                        $is_error = 0;
                    }
                }
            }

            if ($this->form_validation->run() == FALSE || $is_error == 1) {
                $data['genreName'] = $this->input->post('genreName');
                $data['name'] = $this->input->post('name');
                $data['GndrId'] = $this->input->post('GndrId');
                $data['prLevel'] = $this->input->post('prLevel');
                $data['prName'] = $this->input->post('prName');
                $data['path'] = $this->input->post('path');
                $data['runtime'] = $this->input->post('runtime');
                $data['description'] = $this->input->post('description');
                $data['LangID'] = $this->input->post('LangID');
            } else {
                $this->MProducts->Update($image_data);
                $this->session->set_flashdata('movie_u', 'Movie updated');
                redirect('welcome/product', 'location');
            }
        }

        $data['title'] = "Edit movie";
        $data['main'] = 'edit';
        //$data['M_genre'] = $this->MovieGenre->getGenreDropDown();
        $data['M_genre'] = $this->MovieGenre->vod_genreDropDown();
        $data['category'] = $this->MProducts->getCategory($id);
        $data['pRating'] = $this->MovieGenre->getpRatingDropDown();
        $this->load->vars($data);
        $this->load->view('template');
    }

    function delete($id, $id_g) {
        $this->MProducts->deleteMovie($id, $id_g);
        $this->session->set_flashdata('movie_d', 'Movie deleted');
        redirect('welcome/product/0', 'location');
    }

    function Tv($var1 = false, $var2 = false, $var3 = false) {
        $base_url = "$var1/$var2";

        // Get offset and limit for page viewing
        $offset = (int) $this->uri->segment(5);

        // Number of record showing per page
        $row_count = RECORDS_PERPAGE;

        // Get all companies
        $data['tv'] = $this->MTV->getAllTv($offset, $row_count, $var2, $var3)->result();

        // Pagination config
        $p_config['base_url'] = base_url() . 'index.php/welcome/Tv/' . $base_url;
        $p_config['uri_segment'] = 5;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->MTV->getAllTv(false, false, $var2, $var3)->num_rows();
        $p_config['per_page'] = $row_count;

        // Init pagination
        $this->pagination->initialize($p_config);

        // Create pagination links
        $data['pagination'] = $this->pagination->create_links();

        $data['title'] = 'Tv Channels';
        $data['main'] = 'tv';
        $this->load->vars($data);
        $this->load->view('template');
    }

    function addtv() {
        //echo $tv;
        $data['name'] = "";
        $data['ChNum'] = "";
        $data['GndrId'] = "";
        $data['prLevel'] = "";
        $data['prName'] = "";
        $data['eitxml'] = "";
        $data['epgxml'] = "";
        $data['path'] = "";
        $data['description'] = "";
        $data['genreName'] = "";
        $data['LangID'] = "";

        $data['image_width_tv'] = $this->image_width_tv;
        $data['image_height_tv'] = $this->image_height_tv;

        $data['upload_file_error'] = "";
        $is_error = 0;

        if (isset($_POST['submit'])) {

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('ChNum', 'Channel Number', 'required');
            $this->form_validation->set_rules('GndrId[]', 'Genre', 'required');
            $this->form_validation->set_rules('eitxml', 'Eit XML', 'valid_url');
            $this->form_validation->set_rules('epgxml', 'Epg XML', 'valid_url');
            $this->form_validation->set_rules('path', 'Path', 'required');
            //$this->form_validation->set_rules('description', 'Description', 'required');

            if ($this->input->post('ChNum')) {
                $this->form_validation->set_rules('ChNum', 'Channel Number', 'is_numeric');
            }

            if ($this->input->post('prLevel')) {
                $this->form_validation->set_rules('prLevel', 'Parental Number', 'is_numeric');
            }

            //$config['upload_path'] = TV_PATH;
            $config['upload_path'] = './icons/TV/';
            $config['allowed_types'] = 'gif|jpg|png';
            //$config['max_size'] = '200';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            //$config['max_size']	= '100';
            $config['max_width'] = $data['image_width_tv'];
            $config['max_height'] = $data['image_height_tv'];
            $this->load->library('upload', $config);


            if (!$this->upload->do_upload('icon')) {
                $error = $this->upload->display_errors();
                $data['upload_file_error'] = $error;
                $is_error = 1;
            } else {
                $is_error = 0;
            }

            if ($this->form_validation->run() == FALSE || $is_error == 1) {
                $data['name'] = $this->TVclass->Unhtmlentities($this->input->post('name'));
                $data['ChNum'] = $this->input->post('ChNum');
                $data['GndrId'] = $this->input->post('GndrId');
                $data['prLevel'] = $this->input->post('prLevel');
                $data['prName'] = $this->input->post('prName');
                $data['eitxml'] = $this->input->post('eitxml');
                $data['epgxml'] = $this->input->post('epgxml');
                $data['path'] = $this->input->post('path');
                $data['description'] = $this->input->post('description');
                $data['genreName'] = $this->input->post('genreName');
                $data['LangID'] = $this->input->post('LangID');
            } else {
                $this->MTV->addTv();
                $this->session->set_flashdata('tv_c', "Tv created");
                redirect('welcome/Tv/all/0', 'location');
            }
        }

        $data['title'] = "Create Tv";
        $data['main'] = 'tv_create';
        $data['genre'] = $this->MovieGenre->getGenreDropDown();
        $data['pRating'] = $this->MovieGenre->getpRatingDropDown();
        $this->load->view('template', $data);
    }

    function tv_edit($id = 0, $id_g = 0) {
        $data['upload_file_error'] = "";
        $is_error = 0;

        $data['image_width_tv'] = $this->image_width_tv;
        $data['image_height_tv'] = $this->image_height_tv;

        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('ChNum', 'Channel Number', 'required');
            $this->form_validation->set_rules('GndrId', 'Genre', 'required');
            //$this->form_validation->set_rules('eitxml', 'Eit XML', 'valid_url');
            //$this->form_validation->set_rules('epgxml', 'Epg XML', 'valid_url');
            $this->form_validation->set_rules('path', 'Path', 'required');
            //$this->form_validation->set_rules('description', 'Description', 'required');

            if ($this->input->post('ChNum')) {
                $this->form_validation->set_rules('ChNum', 'Channel Number', 'is_numeric');
            }

            if ($this->input->post('prLevel')) {
                $this->form_validation->set_rules('prLevel', 'Parental Number', 'is_numeric');
            }

            if (!empty($_FILES['icon']['name'])) {
                $config['upload_path'] = './icons/TV/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '200';
                $config['remove_spaces'] = true;
                $config['overwrite'] = false;
                //$config['max_size']	= '100';
                $config['max_width'] = $data['image_width_tv'];
                $config['max_height'] = $data['image_height_tv'];

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('icon')) {
                    $error = $this->upload->display_errors();
                    $data['upload_file_error'] = $error;
                    $is_error = 1;
                } else {
                    $filename = './icons/TV/' . $this->input->post('file_img_name');
                    if (file_exists($filename)) {
                        unlink($filename);
                    }
                    $is_error = 0;
                }
            }

            if ($this->form_validation->run() == TRUE && $is_error == 0) {
                $this->MTV->UpdateTv();
                $this->session->set_flashdata('tv_u', 'TV updated');
                redirect('welcome/Tv/all/0', 'location');
            }
        }

        $data['genre'] = $this->MovieGenre->getGenreDropDown();
        $data['get_genre_lists'] = $this->MTV->get_channel_gerne_lists($id);
        $data['pRating'] = $this->MovieGenre->getpRatingDropDown();
        $data['title'] = "Edit TV";
        $data['main'] = 'tv_edit';
        $data['category'] = $this->MTV->getTv($id);
        $this->load->view('template', $data);
    }

    function deletetv($id, $id_g) {
        $this->MTV->deleteTV($id, $id_g);
        $this->session->set_flashdata('tv_d', 'TV deleted');
        redirect('welcome/Tv/0', 'location');
    }

    function games() {
        $config['base_url'] = base_url() . 'index.php/welcome/games/';
        $config['total_rows'] = $this->db->count_all('games');
        $config['per_page'] = RECORDS_PERPAGE;
        $this->pagination->initialize($config);
        $data['pageination'] = $this->pagination->create_links();
        $data['games'] = $this->MGAMES->getgames($config['per_page'], $this->uri->segment(3));
        $data['main'] = 'games';
        $this->load->vars($data);
        $this->load->view('template');
    }

    function addgame() {
        if ($this->input->post('name') && $this->input->post('description') && $this->input->post('path') && $this->input->post('year') && $this->input->post('dateadded')) {
            $this->MGAMES->addgames();
            $this->session->set_flashdata('game_c', "Game created");
            redirect('welcome/games', 'location');
        } else {
            $rules['name'] = "required";
            $rules['description'] = "required";
            $rules['icon'] = "required";
            $rules['path'] = "required";
            $rules['year'] = "required";
            $rules['dateadded'] = "required";

            $this->validation->set_rules($rules);
            $this->validation->set_error_delimiters('<div id="msg">', '</div>');
            if ($this->validation->run() == FALSE) {
                $data['title'] = "Create Games";
                $data['main'] = 'create_games';
                $this->load->vars($data);
                $this->load->view('template');
            }
        }
    }

    function game_edit($id = 0) {
        if ($this->input->post('name')) {
            $this->MGAMES->UpdateGames();
            $this->session->set_flashdata('game_u', 'Game updated');
            redirect('welcome/games', 'location');
        } else {
            $data['title'] = "Edit Games";
            $data['main'] = 'game_edit';
            $data['category'] = $this->MGAMES->getgame($id);
            $this->load->vars($data);
            $this->load->view('template');
        }
    }

    function game_delete($id) {
        $this->MGAMES->deleteGame($id);
        $this->session->set_flashdata('game_d', 'Game deleted');
        redirect('welcome/games', 'location');
    }

    function restaurent() {
        $config['base_url'] = base_url() . 'index.php/welcome/restaurent/';
        $config['total_rows'] = $this->db->count_all('restaurent');
        $config['per_page'] = RECORDS_PERPAGE;
        $this->pagination->initialize($config);
        $data['pageination'] = $this->pagination->create_links();
        $data['res'] = $this->MRestaurent->getAllrestaurent($config['per_page'], $this->uri->segment(3));
        $data['main'] = 'restaurent';
        $this->load->vars($data);
        $this->load->view('template');
    }

    function res_add() {
        if ($this->input->post('name') && $this->input->post('description') && $this->input->post('path') && $this->input->post('year') && $this->input->post('dateadded')) {
            $this->MRestaurent->addrestaurent();
            $this->session->set_flashdata('res_c', "Restaurent created");
            redirect('welcome/restaurent', 'location');
        } else {

            $rules['name'] = "required";
            $rules['description'] = "required";
            $rules['icon'] = "required";
            $rules['path'] = "required";
            $rules['year'] = "required";
            $rules['dateadded'] = "required";
            $this->validation->set_rules($rules);
            $this->validation->set_error_delimiters('<div id="msg">', '</div>');
            if ($this->validation->run() == FALSE) {
                $data['title'] = "Create Restaurent";
                $data['main'] = 'create_restaurent';
                //$data['categories'] = $this->MCats->getTopCategories();
                $this->load->vars($data);
                $this->load->view('template');
            }
        }
    }

    function res_edit($id = 0) {
        if ($this->input->post('name')) {
            $this->MRestaurent->UpdateRestaurent();
            $this->session->set_flashdata('res_u', 'Restaurent updated');
            redirect('welcome/restaurent', 'location');
        } else {
            $data['title'] = "Edit restaurent";
            $data['main'] = 'res_edit';
            $data['category'] = $this->MRestaurent->getRestaurent($id);
            $this->load->vars($data);
            $this->load->view('template');
        }
    }

    function res_delete($id) {
        $this->MRestaurent->deleteRestaurent($id);
        $this->session->set_flashdata('res_d', 'Restaurent deleted');
        redirect('welcome/restaurent', 'location');
    }

    function artist() {
        $config['base_url'] = base_url() . 'index.php/welcome/artist/';
        $config['total_rows'] = $this->db->count_all('artist');
        $config['per_page'] = RECORDS_PERPAGE;
        $this->pagination->initialize($config);
        $data['pageination'] = $this->pagination->create_links();
        $data['art'] = $this->MArtist->getAllartist($config['per_page'], $this->uri->segment(3));
        $data['main'] = 'artist';
        $this->load->vars($data);
        $this->load->view('template');
    }

    function addartist() {
        if ($this->input->post('name') && $this->input->post('description')) {
            $this->MArtist->addartist();
            $this->session->set_flashdata('art_c', "Artist created");
            redirect('welcome/artist', 'location');
        } else {

            $rules['name'] = "required";
            $rules['description'] = "required";
            $this->validation->set_rules($rules);
            $this->validation->set_error_delimiters('<div id="msg">', '</div>');
            if ($this->validation->run() == FALSE) {
                $data['title'] = "Create Artist";
                $data['main'] = 'create_artist';
                //$data['categories'] = $this->MCats->getTopCategories();
                $this->load->vars($data);
                $this->load->view('template');
            }
        }
    }

    function art_edit($id = 0) {
        if ($this->input->post('name')) {
            $this->MArtist->UpdateArtist();
            $this->session->set_flashdata('art_u', 'Artist updated');
            redirect('welcome/artist', 'location');
        } else {
            $data['title'] = "Edit Artist";
            $data['main'] = 'edit_art';
            $data['category'] = $this->MArtist->getArtist($id);
            $this->load->vars($data);
            $this->load->view('template');
        }
    }

    function art_delete($id) {
        $this->MArtist->deleteArtist($id);
        $this->session->set_flashdata('art_d', 'Artist deleted');
        redirect('welcome/artist', 'location');
    }

    function tvgenre() {
        $offset = (int) $this->uri->segment(3);

        $row_count = 10;

        $data['gen'] = $this->MGenre->getAllgenre($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/welcome/tvgenre/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->MGenre->getAllgenre()->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['title'] = 'TV Genre';
        $data['main'] = 'genre';
        $this->load->vars($data);
        $this->load->view('template');
    }

    function addgenre() {
        $data['name'] = "";
        $data['LangID'] = "";
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            //$this->form_validation->set_rules('url', 'URL', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['name'] = $this->TVclass->Unhtmlentities($this->input->post('name'));
                $data['LangID'] = $this->input->post('LangID');
            } else {
                $this->MGenre->addgenre();
                $this->session->set_flashdata('gen_c', "Genre created");
                redirect('welcome/tvgenre', 'location');
            }
        }

        $data['title'] = "Create Genre";
        $data['main'] = 'create_genre';
        $this->load->vars($data);
        $this->load->view('template');
    }

    function gen_edit($id = 0) {
        $data['name'] = "";
        $data['LangID'] = "";
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            //$this->form_validation->set_rules('url', 'URL', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['name'] = $this->input->post('name');
                $data['LangID'] = $this->input->post('LangID');
            } else {
                $this->MGenre->UpdateGenre();
                $this->session->set_flashdata('gen_u', 'Genre updated');
                redirect('welcome/tvgenre', 'location');
            }
        }

        $data['title'] = "Edit TV Genre";
        $data['main'] = 'edit_genre';
        $data['category'] = $this->MGenre->getGenret($id);
        $this->load->vars($data);
        $this->load->view('template');
    }

    function gen_delete($id) {
        $this->MGenre->deleteGenre($id);
        $this->session->set_flashdata('gen_d', 'Genre deleted');
        redirect('welcome/tvgenre', 'location');
    }

    function radiogenre() {
        $offset = (int) $this->uri->segment(3);

        $row_count = 10;

        $data['gen'] = $this->RGenre->getAllgenre($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/welcome/radiogenre/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->RGenre->getAllgenre()->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['title'] = 'Radio Genre';
        $data['main'] = 'rgenre';
        $this->load->vars($data);
        $this->load->view('template');
    }

    function addradiogenre() {
        $data['name'] = "";
        $data['LangID'] = "";
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            //$this->form_validation->set_rules('url', 'URL', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['name'] = $this->TVclass->Unhtmlentities($this->input->post('name'));
                $data['LangID'] = $this->input->post('LangID');
            } else {
                $this->RGenre->addgenre();
                $this->session->set_flashdata('gen_c', "Genre created");
                redirect('welcome/radiogenre', 'location');
            }
        }

        $data['title'] = "Create Radio Genre";
        $data['main'] = 'create_rgenre';
        $this->load->vars($data);
        $this->load->view('template');
    }

    function gen_radio_edit($id = 0) {
        $data['name'] = "";
        $data['LangID'] = "";
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            //$this->form_validation->set_rules('url', 'URL', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['name'] = $this->input->post('name');
                $data['LangID'] = $this->input->post('LangID');
            } else {
                $this->RGenre->UpdateGenre();
                $this->session->set_flashdata('gen_u', 'Genre updated');
                redirect('welcome/radiogenre', 'location');
            }
        }

        $data['title'] = "Edit Radio Genre";
        $data['main'] = 'edit_rgenre';
        $data['category'] = $this->RGenre->getGenret($id);
        $this->load->vars($data);
        $this->load->view('template');
    }

    function gen_radio_delete($id) {
        $this->RGenre->deleteGenre($id);
        $this->session->set_flashdata('gen_u', 'Genre deleted');
        redirect('welcome/radiogenre', 'location');
    }

    function album() {
        if (!$this->uri->segment(3)) {
            $limit = 0;
        } else {
            $limit = $this->uri->segment(3);
        }
        $config['base_url'] = base_url() . 'index.php/welcome/album/';
        $config['total_rows'] = $this->db->count_all('album');
        $config['per_page'] = RECORDS_PERPAGE;
        $this->pagination->initialize($config);
        $data['pageination'] = $this->pagination->create_links();
        $data['alb'] = $this->MAlbum->getAllalbum($limit, $config['per_page']);
        $data['main'] = 'album';
        $this->load->vars($data);
        $this->load->view('template');
    }

    function addalbum() {
        if ($this->input->post('name') && $this->input->post('description')) {
            $this->MAlbum->addalbum();
            $this->session->set_flashdata('alb_c', "Album created");
            redirect('welcome/album', 'location');
        } else {

            $rules['name'] = "required";
            $rules['description'] = "required";
            $this->validation->set_rules($rules);
            $this->validation->set_error_delimiters('<div id="msg">', '</div>');
            if ($this->validation->run() == FALSE) {
                $data['title'] = "Create Album";
                $data['main'] = 'create_album';
                $data['artist'] = $this->MArtist->getArtistDropDown();
                $data['genre'] = $this->MGenre->getGenreDropDown();
                $this->load->vars($data);
                $this->load->view('template');
            }
        }
    }

    function alb_edit($id = 0, $id_a = 0, $id_g = 0) {
        if ($this->input->post('name') && $this->input->post('description')) {
            $this->MAlbum->UpdateAlbum();
            $this->session->set_flashdata('alb_u', 'Album updated');
            redirect('welcome/album', 'location');
        } else {
            $data['title'] = "Edit Album";
            $data['main'] = 'edit_album';
            $data['category'] = $this->MAlbum->getAlbum($id);
            $data['artist'] = $this->MArtist->getArtist($id_a);
            $data['Artist'] = $this->MArtist->getArtistDropDown();
            $data['genre'] = $this->MGenre->getGenret($id_g);
            $data['Genre'] = $this->MGenre->getGenreDropDown();
            $this->load->vars($data);
            $this->load->view('template');
        }
    }

    function alb_delete($id) {
        $this->MAlbum->deleteAlbum($id);
        $this->session->set_flashdata('alb_d', 'Album deleted');
        redirect('welcome/album', 'location');
    }

    function song() {
        if (!$this->uri->segment(3)) {
            $limit = 0;
        } else {
            $limit = $this->uri->segment(3);
        }
        $config['base_url'] = base_url() . 'index.php/welcome/song/';
        $config['total_rows'] = $this->db->count_all('song');
        $config['per_page'] = RECORDS_PERPAGE;
        $this->pagination->initialize($config);
        $data['pageination'] = $this->pagination->create_links();
        $data['song'] = $this->MSong->getAllsong($limit, $config['per_page']);
        $data['main'] = 'song';
        $this->load->vars($data);
        $this->load->view('template');
    }

    function addsong() {
        if ($this->input->post('name') && $this->input->post('path') && $this->input->post('description')) {
            $this->MSong->addSong();
            $this->session->set_flashdata('song_c', "Song created");
            redirect('welcome/song', 'location');
        } else {

            $rules['name'] = "required";
            $rules['path'] = "required";
            $rules['description'] = "required";
            $this->validation->set_rules($rules);
            $this->validation->set_error_delimiters('<div id="msg">', '</div>');
            if ($this->validation->run() == FALSE) {
                $data['title'] = "Create Song";
                $data['main'] = 'create_song';
                $data['artist'] = $this->MArtist->getArtistDropDown();
                $data['genre'] = $this->MGenre->getGenreDropDown();
                $data['album'] = $this->MAlbum->getAlbumDropDown();
                $this->load->vars($data);
                $this->load->view('template');
            }
        }
    }

    function song_edit($id = 0, $id_a = 0, $id_g = 0, $id_al = 0) {
        if ($this->input->post('name') && $this->input->post('description') && $this->input->post('path')) {
            $this->MSong->UpdateSong();
            $this->session->set_flashdata('song_u', 'Song updated');
            redirect('welcome/song', 'location');
        } else {
            $data['title'] = "Edit Song";
            $data['main'] = 'edit_song';
            $data['category'] = $this->MSong->getSong($id);
            $data['artist'] = $this->MArtist->getArtist($id_a);
            $data['Artist'] = $this->MArtist->getArtistDropDown();
            $data['genre'] = $this->MGenre->getGenret($id_g);
            $data['Genre'] = $this->MGenre->getGenreDropDown();
            $data['album'] = $this->MAlbum->getAlbum($id_al);
            $data['Album'] = $this->MAlbum->getAlbumDropDown();
            $this->load->vars($data);
            $this->load->view('template');
        }
    }

    function song_delete($id) {
        $this->MSong->deleteSong($id);
        $this->session->set_flashdata('song_d', 'Song deleted');
        redirect('welcome/song', 'location');
    }

    function MovieGenre() {
        /* $config['base_url'] = base_url().'index.php/welcome/MovieGenre/';
          $config['total_rows'] = $this->db->count_all('itvmoviecategory');
          $config['per_page'] = '3';
          $this->pagination->initialize($config);
          $data['pageination']=$this->pagination->create_links();
          $data['gen'] = $this->MovieGenre->getAllgenre($config['per_page'],$this->uri->segment(3)); */
        $data['gen'] = $this->MovieGenre->getAllgenre();
        $data['title'] = 'MovieGenre';
        $data['main'] = 'M_genre';
        $this->load->vars($data);
        $this->load->view('template');
    }

    function addMovieGenre() {
        if ($this->input->post('name')) {
            $this->MovieGenre->addgenre();
            $this->session->set_flashdata('gen_c', "Genre created");
            redirect('welcome/MovieGenre', 'location');
        } else {

            $rules['name'] = "required";
            $this->validation->set_rules($rules);
            $this->validation->set_error_delimiters('<div id="msg">', '</div>');
            if ($this->validation->run() == FALSE) {
                $data['title'] = "Create Genre";
                $data['main'] = 'create_Moviegenre';
                //$data['categories'] = $this->MCats->getTopCategories();
                $this->load->vars($data);
                $this->load->view('template');
            }
        }
    }

    function editMovieGenre($id = 0) {
        if ($this->input->post('name')) {
            $this->MovieGenre->UpdateGenre();
            $this->session->set_flashdata('gen_u', 'Genre updated');
            redirect('welcome/MovieGenre', 'location');
        } else {
            $data['title'] = "Edit MovieGenre";
            $data['main'] = 'edit_Moviegenre';
            $data['category'] = $this->MovieGenre->getGenre($id);
            $this->load->vars($data);
            $this->load->view('template');
        }
    }

    function deleteMovieGenre($id) {
        $this->MovieGenre->deleteGenre($id);
        $this->session->set_flashdata('gen_d', 'Genre deleted');
        redirect('welcome/MovieGenre', 'location');
    }

    /* new funtion for add,edite,delete epg */

    function epg() {
        $config['base_url'] = base_url() . 'index.php/welcome/epg/';
        $config['total_rows'] = $this->db->count_all('epgfiles');
        $config['per_page'] = RECORDS_PERPAGE;
        $this->pagination->initialize($config);
        $data['pageination'] = $this->pagination->create_links();
        $data['epg'] = $this->EPG->getAllepg($config['per_page'], $this->uri->segment(3));
        $data['title'] = 'Epg';
        $data['main'] = 'epg';
        $this->load->vars($data);
        $this->load->view('template');
    }

    function addepg() {
        if ($this->input->post('path')) {
            $this->EPG->addepg();
            $this->session->set_flashdata('epg_c', "Epg created");
            redirect('welcome/epg', 'location');
        } else {

            $rules['path'] = "required";
            $this->validation->set_rules($rules);
            $this->validation->set_error_delimiters('<div id="msg">', '</div>');
            if ($this->validation->run() == FALSE) {
                $data['channels'] = $this->EPG->getChannelsDropDown();
                $data['title'] = "Create Epg";
                $data['main'] = 'create_epg';
                $this->load->vars($data);
                $this->load->view('template');
            }
        }
    }

    function editepg($id = 0, $Id = 0) {
        if ($this->input->post('path')) {
            $this->EPG->Updateepg();
            $this->session->set_flashdata('epg_u', 'EPG updated');
            redirect('welcome/epg', 'location');
        } else {
            $data['channels'] = $this->EPG->getChannelsDropDown();
            $data['channel'] = $this->EPG->getselectedchannel($Id);
            $data['category'] = $this->EPG->getepg($id);
            $data['title'] = "Edit Epg";
            $data['main'] = 'edit_epg';
            $this->load->vars($data);
            $this->load->view('template');
        }
    }

    function deleteepg($id) {
        $this->EPG->deleteepg($id);
        $this->session->set_flashdata('epg_d', 'EPG deleted');
        redirect('welcome/epg', 'location');
    }

    /* till here */

    function metadata() {
        $config['base_url'] = base_url() . 'index.php/welcome/metadata/';
        $config['total_rows'] = $this->db->count_all('metadata');
        $config['per_page'] = RECORDS_PERPAGE;
        $this->pagination->initialize($config);
        $data['pageination'] = $this->pagination->create_links();
        $data['metadata'] = $this->Metadata->getAllMetadata($config['per_page'], $this->uri->segment(3));
        $data['title'] = "Metadata";
        $data['main'] = "viewmetadata";
        $this->load->view('template', $data);
    }

    function addMetada() {
        $data['LangID'] = "";
        $data['dirname'] = "";
        $data['cast'] = "";

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('dirname', 'Director Name', 'required');
            $this->form_validation->set_rules('cast', 'Cast', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['dirname'] = $this->TVclass->Unhtmlentities($this->input->post('dirname'));
                $data['cast'] = $this->input->post('cast');
                $data['LangID'] = $this->input->post('LangID');
            } else {
                $this->Metadata->addmetadata();
                $this->session->set_flashdata('metadata_c', 'Metadata created');
                redirect('welcome/metadata', 'location');
            }
        }

        $data['title'] = "Add Metadata";
        $data['main'] = "addmetadata";
        $this->load->view('template', $data);
    }

    function editmetadata($id = '0') {
        $data['LangID'] = "";
        $data['dirname'] = "";
        $data['cast'] = "";

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('dirname', 'Director Name', 'required');
            $this->form_validation->set_rules('cast', 'Cast', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['dirname'] = $this->input->post('dirname');
                $data['cast'] = $this->input->post('cast');
                $data['LangID'] = $this->input->post('LangID');
            } else {
                $this->Metadata->UpdateMetadata();
                $this->session->set_flashdata('metadata_u', 'Metadata Updated');
                redirect('welcome/metadata', 'location');
            }
        }

        $data['title'] = "Edit Metadata";
        $data['main'] = "editmetadata";
        $data['category'] = $this->Metadata->getMetadata($id);
        $this->load->view('template', $data);
    }

    function deletemetadata($id) {
        $this->Metadata->deleteMetadata($id);
        $this->session->set_flashdata('metadata_d', 'Metadata deleted');
        redirect('welcome/metadata', 'location');
    }

    function pRating() {
        $config['base_url'] = base_url() . 'index.php/welcome/pRating/';
        $config['total_rows'] = $this->db->count_all('parentalrating');
        $config['per_page'] = RECORDS_PERPAGE;
        $this->pagination->initialize($config);
        $data['pageination'] = $this->pagination->create_links();
        $data['prating'] = $this->PRating->getAllPRating($config['per_page'], $this->uri->segment(3));
        $data['title'] = "Parental Rating";
        $data['main'] = "viewprating";
        $this->load->view('template', $data);
    }

    function addpRating() {
        $data['name'] = "";
        $data['level'] = "";
        $data['LangID'] = "";

        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('level', 'Level', 'required');

            if ($this->input->post('level')) {
                $this->form_validation->set_rules('level', 'Level', 'is_numeric');
            }

            if ($this->form_validation->run() == FALSE) {
                $data['name'] = $this->TVclass->Unhtmlentities($this->input->post('name'));
                $data['level'] = $this->input->post('level');
                $data['LangID'] = $this->input->post('LangID');
            } else {
                $this->PRating->addPRating();
                $this->session->set_flashdata('pRating_c', 'Parental Rating created');
                redirect('welcome/pRating', 'location');
            }
        }

        $data['title'] = "Add Parental Rating";
        $data['main'] = "addprating";
        $this->load->view('template', $data);
    }

    function editprating($id = '0') {
        $data['name'] = "";
        $data['level'] = "";
        $data['LangID'] = "";

        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('level', 'Level', 'required');

            if ($this->input->post('level')) {
                $this->form_validation->set_rules('level', 'Level', 'is_numeric');
            }

            if ($this->form_validation->run() == FALSE) {
                $data['name'] = $this->input->post('name');
                $data['level'] = $this->input->post('level');
                $data['LangID'] = $this->input->post('LangID');
            } else {
                $this->PRating->UpdatePRating();
                $this->session->set_flashdata('pRating_u', 'Parental Rating updated');
                redirect('welcome/pRating', 'location');
            }
        }

        $data['title'] = "Edit Parental Rating";
        $data['main'] = "editprating";
        $data['category'] = $this->PRating->getPRating($id);
        $this->load->view('template', $data);
    }

    function deleteprating($id) {
        $this->PRating->deletePRating($id);
        $this->session->set_flashdata('pRating_d', 'Parental Rating deleted');
        redirect('welcome/pRating', 'location');
    }

    function program() {
        $config['base_url'] = base_url() . 'index.php/welcome/epg/';
        $config['total_rows'] = $this->db->count_all('program');
        $config['per_page'] = RECORDS_PERPAGE;
        $this->pagination->initialize($config);
        $data['pageination'] = $this->pagination->create_links();
        $data['program'] = $this->MProgram->getAllProgram($config['per_page'], $this->uri->segment(3));
        $data['title'] = 'Program';
        $data['main'] = 'program';
        $this->load->vars($data);
        $this->load->view('template');
    }

    function addprogram() {
        $data['proname'] = "";
        $data['Stime'] = "";
        $data['Etime'] = "";
        $data['GndrId'] = "";
        $data['prName'] = "";
        $data['prLevel'] = "";
        $data['description'] = "";
        $data['genreName'] = "";
        $data['LangID'] = "";

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('proname', 'Program name', 'required');
            $this->form_validation->set_rules('Stime', 'Strat Time', 'required');
            $this->form_validation->set_rules('Etime', 'End Time', 'required');
            $this->form_validation->set_rules('GndrId', 'Genre', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');

            if ($this->input->post('Stime')) {
                $this->form_validation->set_rules('Stime', 'Strat Time', 'is_numeric');
            }

            if ($this->input->post('Etime')) {
                $this->form_validation->set_rules('Etime', 'End Time', 'is_numeric');
            }

            if ($this->input->post('prLevel')) {
                $this->form_validation->set_rules('prLevel', 'Parental Level', 'is_numeric');
            }


            if ($this->form_validation->run() == FALSE) {
                $data['proname'] = $this->TVclass->Unhtmlentities($this->input->post('proname'));
                $data['Stime'] = $this->input->post('Stime');
                $data['Etime'] = $this->input->post('Etime');
                $data['GndrId'] = $this->input->post('GndrId');
                $data['prName'] = $this->input->post('prName');
                $data['prLevel'] = $this->input->post('prLevel');
                $data['description'] = $this->input->post('description');
                $data['genreName'] = $this->input->post('genreName');
                $data['LangID'] = $this->input->post('LangID');
            } else {
                $this->MProgram->addProgram();
                $this->session->set_flashdata('Pro_c', "Program created");
                redirect('welcome/program', 'location');
            }
        }

        $data['title'] = "Create Programe";
        $data['main'] = 'create_program';
        $data['genre'] = $this->MovieGenre->getGenreDropDown();
        $data['pRating'] = $this->MovieGenre->getpRatingDropDown();
        $this->load->view('template', $data);
    }

    function editprogram($id = 0, $Id = 0) {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('proname', 'Program name', 'required');
            $this->form_validation->set_rules('Stime', 'Strat Time', 'required');
            $this->form_validation->set_rules('Etime', 'End Time', 'required');
            $this->form_validation->set_rules('GndrId', 'Genre', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');

            if ($this->input->post('Stime')) {
                $this->form_validation->set_rules('Stime', 'Strat Time', 'is_numeric');
            }

            if ($this->input->post('Etime')) {
                $this->form_validation->set_rules('Etime', 'End Time', 'is_numeric');
            }

            if ($this->input->post('prLevel')) {
                $this->form_validation->set_rules('prLevel', 'Parental Level', 'is_numeric');
            }


            if ($this->form_validation->run() == TRUE) {
                $this->MProgram->UpdateProgram();
                $this->session->set_flashdata('Pro_u', 'Program updated');
                redirect('welcome/program', 'location');
            }
        }

        $data['genre'] = $this->MovieGenre->getGenreDropDown();
        $data['pRating'] = $this->MovieGenre->getpRatingDropDown();
        $data['title'] = "Edit Programe";
        $data['main'] = 'edit_program';
        $data['category'] = $this->MProgram->getProgram($id);
        $this->load->view('template', $data);
    }

    function deleteprogram($id) {
        $this->MProgram->deleteProgram($id);
        $this->session->set_flashdata('Pro_d', 'Progam deleted');
        redirect('welcome/program', 'location');
    }

    function full_view($id = false) {
        $data['result'] = $this->NEWS->getnews($id);
        $this->load->view('full_news', $data);
    }

    /** Categories * */
    function addcategory() {
        $this->title = "ADD CATEGORY";
        $this->create_edit_category();
    }

    function editcategory($category_id = false) {
        $this->title = "UPDATE CATEGORY";
        $this->create_edit_category($device_id);
    }

    function deletecategory($category_id = false) {
        $this->Devices->deletecategory($category_id);
        redirect('backend/category', 'location');
    }

    function category() {
        $data['title'] = "Category";

        $offset = (int) $this->uri->segment(3);

        $row_count = 10;

        $data['category'] = $this->Category->get_all($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/backend/category/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->Category->get_all()->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'category';
        $this->load->view('template', $data);
    }

    function create_edit_category($category_id = false) {
        $data['title'] = $this->title;

        if ($this->input->post('submit') || $this->input->post('update')) {
            $this->form_validation->set_rules('UID', 'UID', 'trim|required|xss_clean');
        }

        if ($this->form_validation->run() == TRUE) {
            if ($this->input->post('submit')) {
                $this->Category->insert_data();
                redirect('backend/category', 'location');
            } else if ($this->input->post('update')) {
                $this->Category->update_data($category_id);
                redirect('backend/category', 'location');
            }
        }

        if ($category_id == true) {
            $data['category'] = $this->Category->category_byid($category_id);
        }

        $data['main'] = 'backend/create_edit_category';
        $this->load->view('template', $data);
    }

    function favourites($user_id = false, $channel_id = false) {
        $data['title'] = "Favourites";
        $data['user_id'] = $user_id; // for auto submit
        $this->load->model('Favourites');

        // Uri segment set
        $user_id == false && $channel_id == false ? $num = 3 : "";
        $user_id == true && $channel_id == false ? $num = 4 : "";
        $user_id == true && $channel_id == true ? $num = 5 : "";

        if (isset($_POST['users-changel'])) {

            //$data['fav_array'] = $this->Favourites->get_all(false, false, $user_id)->row_array(); // For fill text box

            $offset = (int) $this->uri->segment($num);
            $row_count = 10;

            $data['favourites'] = $this->Favourites->get_all_favourites($offset, $row_count)->result();
            $p_config['base_url'] = base_url() . 'index.php/welcome/favourites/';
            $p_config['uri_segment'] = $num;
            $p_config['num_links'] = 2;
            $p_config['total_rows'] = $this->Favourites->get_all_favourites()->num_rows();
            $p_config['per_page'] = $row_count;

            $this->pagination->initialize($p_config);

            $data['pagination'] = $this->pagination->create_links();
        }

        if ($user_id == true) {
            if ($this->Favourites->check_user_id($user_id)->num_rows > 0) {
                if ($this->Favourites->get_data_id($user_id)->num_rows > 0) {
                    $this->Favourites->update_data($user_id, $channel_id);
                } else {
                    $this->Favourites->insert_data($user_id, $channel_id);
                }
            }
        }

        $this->load->model('Subscribers');
        $data['users'] = $this->Subscribers->get_all(false, false)->result();
        $data['main'] = 'favourites';
        $this->load->view('template', $data);
    }

    function addfavourites($channel_id) {
        $this->add_favourties($channel_id);
    }

    function deletefavourites($user_id, $channel_id) {
        $this->load->model('Favourites');
        $this->Favourites->delete_data($user_id, $channel_id);
        $this->session->set_flashdata('ae_fav', 'Data deleted');
        redirect('welcome/favourites', 'location');
    }

    function add_favourties($channel_id = false) {
        $this->load->model('Favourites');
        $data['title'] = 'Update Favourites';

        if (isset($_POST['fav-submit'])) {
            $data['msg'] = "Data added.";
            $this->Favourites->insert_data($_POST['users'], $channel_id);
        }

        $this->load->model('Subscribers');
        $data['main'] = 'ae_favourites';
        $data['channel_id'] = $channel_id;
        $data['users'] = $this->Subscribers->get_all(false, false)->result();
        $this->load->view('template', $data);
    }

    function vodgenre() {
        $offset = (int) $this->uri->segment(3);

        $row_count = 10;

        $data['vod_genre'] = $this->MGenre->getAllVODgenre($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/welcome/vodgenre/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->MGenre->getAllVODgenre()->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['title'] = 'VOD Genre';
        $data['main'] = 'vod_genre';
        $this->load->vars($data);
        $this->load->view('template');
    }

    function addvodgenre() {
        $this->title = 'Create VOD Genre';
        $this->addedit_vodgenre();
    }

    function editvodgenre($id) {
        $this->title = 'Edit VOD Genre';
        $this->addedit_vodgenre($id);
    }

    function deletevodgenre($id) {
        $this->MGenre->deletevod_genre($id);
        $this->session->set_flashdata('gen_d', 'VOD Genre Deleted');
        redirect('welcome/vodgenre', 'location');
    }

    function addedit_vodgenre($id = false) {
        $data['name'] = "";
        $data['LangID'] = "";

        $this->form_validation->set_rules('vod_genre', 'VOD Genre', 'required');

        if (isset($_POST['submit'])) {
            if ($this->form_validation->run() == TRUE) {
                $this->MGenre->addvod_genre();
                $this->session->set_flashdata('gen_c', 'VOD Genre Created');
                redirect('welcome/vodgenre', 'location');
            }
        }
        if (isset($_POST['update'])) {
            if ($this->form_validation->run() == TRUE) {
                $this->MGenre->updatevod_genre($id);
                $this->session->set_flashdata('gen_u', 'VOD Genre Updated');
                redirect('welcome/vodgenre', 'location');
            }
        }

        if ($id == true) {
            $data['vodgenre_info'] = $this->MGenre->vodgenre_byid($id)->row_array();
        }

        $data['title'] = $this->title;
        $data['main'] = 'addedit_vod_genre';
        $this->load->view('template', $data);
    }

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */