<?php

class Promotions_model extends Model {

    function Promotions_model() {
        parent::Model();
        $this->load->helper('url');

        $this->db_prefix = $this->db->dbprefix;
        $this->promotions = $this->config->item($this->db->dbprefix . 'promotions');
        $this->promotions_language = $this->db->dbprefix . 'promotions_language';
        $this->ticker_promo = $this->db->db_prefix . 'ticker_promo';
    }

    function getAllPromotions($offset = 0, $row_count = 0, $session_keyword) {
        if ($this->session->userdata($session_keyword) != "") {
            $query = 'pr_id IN(SELECT promotion_id from ' . $this->promotions_language . ' WHERE language="' . $this->session->userdata($session_keyword) . '")';
        } else {
            $query = 'pr_id IN(SELECT promotion_id from ' . $this->promotions_language . ' WHERE language="' . $this->config->item('system_lang') . '")';
        }
        $this->db->where($query);
        $this->db->orderby($this->promotions . '.pr_id', 'asc');
        if ($offset >= 0 AND $row_count > 0) {
            $query = $this->db->get($this->promotions, $row_count, $offset);
        } else {
            $query = $this->db->get($this->promotions);
        }
        return $query;
    }

    function insert_promotion_language($promotion_id) {
        $this->delete_promotion_language($promotion_id);
        if (isset($_POST['language'])) {
            for ($i = 0; $i < count($_POST['language']); $i++) {
                $data = array(
                    'promotion_id' => $promotion_id,
                    'language' => $_POST['language'][$i]
                );
                $this->db->insert($this->promotions_language, $data);
            }
        }
    }

    function get_promotion_language($promotion_id) {
        $this->db->where('promotion_id', $promotion_id);
        $query = $this->db->get($this->promotions_language);
        return $query;
    }

    function delete_promotion_language($promotion_id) {
        $this->db->where('promotion_id', $promotion_id);
        $this->db->delete($this->promotions_language);
    }

    function add($img_data) {
        //print_r($img_data);
        $data = array(
            'pr_type' => $this->input->post('pr_type'),
            'pr_width' => isset($img_data['image_width']) ? $img_data['image_width'] : '',
            'pr_height' => isset($img_data['image_height']) ? $img_data['image_height'] : '',
            'pr_url' => $this->input->post('pr_type') == "image" ? $img_data['file_name'] : $this->input->post('pr_url'),
            'pr_duration' => $this->input->post('pr_duration'),
            'pr_date_added' => $this->TVclass->current_date(),
        );
        $this->db->insert($this->promotions, $data);
        $promotion_id = $this->db->insert_id();
        $this->insert_promotion_language($promotion_id);
        $this->TVclass->update_flag('promotions');
    }

    function Update($img_data, $id) {
        if (isset($img_data) && count($img_data) > 0) {
            $data = array(
                'pr_type' => $this->input->post('pr_type'),
                'pr_width' => isset($img_data['image_width']) ? $img_data['image_width'] : '',
                'pr_height' => isset($img_data['image_height']) ? $img_data['image_height'] : '',
                'pr_url' => $img_data['file_name'],
                'pr_duration' => $this->input->post('pr_duration'),
                'pr_date_modified' => $this->TVclass->current_date(),
            );
        } else {
            $data = array(
                'pr_type' => $this->input->post('pr_type'),
                'pr_url' => $this->input->post('pr_type') == "image" ? $this->input->post('file_img_name1') : $this->input->post('pr_url'),
                'pr_duration' => $this->input->post('pr_duration'),
                'pr_date_modified' => $this->TVclass->current_date(),
            );
        }

        $this->db->where('pr_id', $id);
        $this->db->update($this->promotions, $data);
        $this->insert_promotion_language($id);
        $this->TVclass->update_flag('promotions');
    }

    function getPromotions($id) {
        $data = array();
        $this->db->where('pr_id', $id);
        $Q = $this->db->get('promotions');
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        $Q->free_result();

        return $data;
    }

    function delete_data($id) {
        $get_image = $this->getPromotions($id);
        $this->delete_promotion_language($id);
        $filename = './icons/PROMOTIONS/' . $get_image['pr_url'];
        //print $filename;
        if (file_exists($filename)) {
            unlink($filename);
        }

        $this->db->where('pr_id', $id);
        $this->db->delete('promotions');
        $this->TVclass->update_flag('promotions');
    }

    function getAllTickerPromo($offset = 0, $row_count = 0) {
        if ($offset >= 0 AND $row_count > 0) {
            $query = $this->db->get($this->ticker_promo, $row_count, $offset);
        } else {
            $query = $this->db->get($this->ticker_promo);
        }
        return $query;
    }

    function insert_ticker_promo() {      
        $data = array(
            'restaurant_id' => $this->input->post('restaurant_id'),
            'ticker_promo_txt' => $this->input->post('ticker_promo_txt')
        );
        $this->db->insert($this->ticker_promo, $data);
        $this->TVclass->update_flag('promotions');
    }

    function delete_ticker_promo($ticker_promoId) {
        $this->db->where('ticker_promo_id', $ticker_promoId);
        $this->db->delete($this->ticker_promo);
        $this->TVclass->update_flag('promotions');
    }

    function getTickerPromoById($ticker_promoId) {
        $data = array();
        $this->db->where('ticker_promo_id', $ticker_promoId);
        $Q = $this->db->get($this->ticker_promo);
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        $Q->free_result();

        return $data;
    }

    function update_ticker_promo($ticker_promoId) {
        $data = array(
            'restaurant_id' => $this->input->post('restaurant_id'),
            'ticker_promo_txt' => $this->input->post('ticker_promo_txt')
        );
        $this->db->where('ticker_promo_id', $ticker_promoId);
        $this->db->update($this->ticker_promo, $data);
        $this->TVclass->update_flag('promotions');
    }

}
