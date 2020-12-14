<?php

class Language extends Model {

    function Language() {
        parent::Model();
        $this->load->helper('url');

        $this->db_prefix = $this->db->dbprefix;
        $this->language = $this->config->item($this->db->dbprefix . 'language');
    }

    function insert_data() {
        $data = array(
            'short_label' => $this->input->post('short_label'),
            'desc' => $this->input->post('desc'),
            'hotel_lang_tag' => $this->input->post('hotel_lang_tag'),
            'is_activated' => $this->input->post('is_activated'),
            'dateformat' => $this->input->post('dateformat'),
            'timeformat' => $this->input->post('timeformat'),
            'price_decimals' => $this->input->post('price_decimals'),
            'price_decimal_sign' => $this->input->post('price_decimal_sign'),
            'price_thousand_sign' => $this->input->post('price_thousand_sign'),
            'date_added' => $this->TVclass->current_date()
        );
        $this->db->insert($this->language, $data);
    }

    function update_data($lang_id) {
        $data = array(
            'short_label' => $this->input->post('short_label'),
            'desc' => $this->input->post('desc'),
            'hotel_lang_tag' => $this->input->post('hotel_lang_tag'),
            'is_activated' => $this->input->post('is_activated'),
            'dateformat' => $this->input->post('dateformat'),
            'timeformat' => $this->input->post('timeformat'),
            'price_decimals' => $this->input->post('price_decimals'),
            'price_decimal_sign' => $this->input->post('price_decimal_sign'),
            'price_thousand_sign' => $this->input->post('price_thousand_sign'),
            'date_updated' => $this->TVclass->current_date()
        );

        $this->db->where('id', $lang_id);
        $this->db->update($this->language, $data);
    }

    function delete_language($lang_id) {
        $this->db->where('id', $lang_id);
        $this->db->delete($this->language);
    }

    function get_all($offset = 0, $row_count = 0) {
        if ($offset >= 0 AND $row_count > 0) {
            $this->db->orderby('short_label', 'asc');
            $query = $this->db->get($this->language, $row_count, $offset);
        } else {
            $this->db->orderby('short_label', 'asc');
            $query = $this->db->get($this->language);
        }
        return $query;
    }

    function get_record_byid($id) {
        $data = array();
        $this->db->where('id', $id);
        $Q = $this->db->get($this->language);
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }

}

?>