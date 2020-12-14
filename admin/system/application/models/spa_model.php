<?php

class Spa_model extends Model
{

    function Spa_model()
    {
        parent::Model();
        $this->load->helper('url');
        $this->db_prefix = $this->db->dbprefix;
        $this->spa = $this->config->item($this->db->dbprefix . 'spa');
        $this->spa_table = $this->db->db_prefix . 'spa';
    }

    function get_data($offset = 0, $row_count = 0, $session_keyword = '')
    {
        if ($this->session->userdata($session_keyword) != "") {
            $this->db->where('language', $this->session->userdata($session_keyword));
        } else {
            $this->db->where_in('language', array($this->config->item('system_lang'),));
        }

        $this->db->orderby('spa_id', 'asc');
        if ($offset >= 0 AND $row_count > 0) {
            $query = $this->db->get($this->spa_table, $row_count, $offset);
        } else {
            $query = $this->db->get($this->spa_table);
        }
        return $query;
    }

//    function getSpaDetails($offset = 0, $row_count = 0, $session_keyword)
//    {
//        if ($this->session->userdata($session_keyword) != "") {
//            $query = 'spa IN(SELECT promotion_id from ' . $this->promotions_language . ' WHERE language="' . $this->session->userdata($session_keyword) . '")';
//        } else {
//            $query = $this->spa . 'spa';
//        }
//        $this->db->from($query);
//        $this->db->where('language', $this->config->item('system_lang'));
//        $this->db->orderby('spa_id', 'asc');
//        if ($offset >= 0 AND $row_count > 0) {
//            $query = $this->db->get($this->spa, $row_count, $offset);
//        } else {
//            $query = $this->db->get($this->spa);
//        }
//
//
//        return $query;
//    }

    function add($img_data)
    {

        $lang = $this->input->post('language');
        $spa_type = $this->input->post('spa_type');
        $spa_image = $img_data;
        $description = $this->input->post('description');

        if (!$this->input->post('language')) {
            $lang = 'en';
        }


        $data = array(
            'spa_type' => $spa_type,
            'spa_img_url' => $spa_image,
            'description' => $description,
            'date_added' => $this->TVclass->current_date(),
            'language' => $lang
        );
        $this->db->insert($this->spa_table, $data);

    }

    function getSpaDetailsByID($id)
    {

        $query = $query = $this->db->getwhere($this->spa_table, array('spa_id' => $id));
        return $query;

    }

    function update_spa($img_data, $id)
    {

        $lang = $this->input->post('language');
        $spa_type = $this->input->post('spa_type');
        $spa_image = $img_data;
        $description = $this->input->post('description');


        if (!$this->input->post('language')) {
            $lang = 'en';
        }


        $data = array(
            'spa_type' => $spa_type,
            'spa_img_url' => $spa_image,
            'description' => $description,
            'date_added' => $this->TVclass->current_date(),
            'language' => $lang
        );

        $this->db->where('spa_id', $id);
        $this->db->update($this->spa_table, $data);
    }

    function delete_spa($id)
    {
        $this->db->where('spa_id', $id);
        $this->db->delete($this->spa_table);
    }

}

?>

