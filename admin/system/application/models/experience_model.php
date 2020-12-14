<?php

class Experience_model extends Model
{

    function Experience_model()
    {
        parent::Model();
        $this->load->helper('url');

        $this->db_prefix = $this->db->dbprefix;
        $this->experience = $this->config->item($this->db->dbprefix . 'experience');

        $this->experience_table = $this->db->db_prefix . 'experience';
    }

    function get_data($offset = 0, $row_count = 0, $session_keyword = '')
    {
        if ($this->session->userdata($session_keyword) != "") {
            $this->db->where('language', $this->session->userdata($session_keyword));
        } else {
            $this->db->where_in('language', array($this->config->item('system_lang'),));
        }
        $this->db->orderby('experience_id', 'asc');
        if ($offset >= 0 AND $row_count > 0) {
            $query = $this->db->get($this->experience_table, $row_count, $offset);
        } else {
            $query = $this->db->get($this->experience_table);
        }
        return $query;
    }

    function getExpDetails($offset = 0, $row_count = 0, $session_keyword)
    {


        if ($this->session->userdata($session_keyword) != "") {
            $query = 'spa IN(SELECT promotion_id from ' . $this->promotions_language . ' WHERE language="' . $this->session->userdata($session_keyword) . '")';
        } else {
            $query = $this->experience . 'experience';
        }
        $this->db->from($query);
        $this->db->where('language', $this->config->item('system_lang'));
        $this->db->orderby('experience_id', 'asc');
        if ($offset >= 0 AND $row_count > 0) {
            $query = $this->db->get($this->experience, $row_count, $offset);
        } else {
            $query = $this->db->get($this->experience);
        }


        return $query;
    }

    function add($img_data)
    {

        $lang = $this->input->post('language');
        $experience_type = $this->input->post('experience_type');
        $experience_image = $img_data;
        $description = $this->input->post('description');

        if (!$this->input->post('language')) {
            $lang = 'en';
        }


        $data = array(
            'experience_type' => $experience_type,
            'experience_img_url' => $experience_image,
            'description' => $description,
            'date_added' => $this->TVclass->current_date(),
            'language' => $lang
        );
        $this->db->insert($this->experience_table, $data);

    }

    function getExpDetailsByID($id)
    {

        $query = $query = $this->db->getwhere($this->experience_table, array('experience_id' => $id));
        return $query;

    }

    function update_experience($img_data, $id)
    {

        $lang = $this->input->post('language');
        $experience_type = $this->input->post('experience_type');
        $experience_image = $img_data;
        $description = $this->input->post('description');


        if (!$this->input->post('language')) {
            $lang = 'en';
        }


        $data = array(
            'experience_type' => $experience_type,
            'experience_img_url' => $experience_image,
            'description' => $description,
            'date_added' => $this->TVclass->current_date(),
            'language' => $lang
        );

        $this->db->where('experience_id', $id);
        $this->db->update($this->experience_table, $data);
    }

    function delete_experience($id)
    {
        $this->db->where('experience_id', $id);
        $this->db->delete($this->experience_table);
    }


}

?>

