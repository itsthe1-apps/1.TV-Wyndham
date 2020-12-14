<?php

class Backgrounds_model extends Model {

    function Backgrounds_model() {
        parent::Model();
        $this->load->helper('url');
        $this->db_prefix = $this->db->dbprefix;
        $this->backgrounds = $this->db_prefix . 'backgrounds';
    }

    function get_all_data($offset = 0, $row_count = 0) {
        if ($offset >= 0 AND $row_count > 0) {
            $query = $this->db->get($this->backgrounds, $row_count, $offset);
        } else {
            $query = $this->db->get($this->backgrounds);
        }
        return $query;
    }

    function get_enum_values($col) {
        $data = array();
        $type = $this->db->query("SHOW COLUMNS FROM $this->backgrounds WHERE Field = '$col'")->row(0)->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);
        foreach ($enum as $val) {
            $data["$val"] = $val;
        }
        return $data;
    }

    function insert_data($filename) {
        $data = array(
            'background_module' => $this->input->post('background_module'),
            'background_image' => $filename,
            'language' => $this->input->post('language'),
        );
        $this->db->insert($this->backgrounds, $data);
    }

    function update_data($filename, $background_id) {
        $data = array(
            'background_module' => $this->input->post('background_module'),
            'background_image' => $filename,
            'language' => $this->input->post('language'),
        );
        $this->db->where('background_id', $background_id);
        $this->db->update($this->backgrounds, $data);
    }

    function delete_data($background_id) {
        $this->db->where('background_id', $background_id);
        $this->db->delete($this->backgrounds);
    }

    function get_data_byid($background_id = false) {
        $data = array();
        $this->db->where('background_id', $background_id);
        $query = $this->db->get($this->backgrounds);
        if ($query->num_rows() > 0) {
            $data = $query->row_array();
        }
        $query->free_result();
        return $data;
    }

}