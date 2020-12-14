<?php

class Newsnpromo_model extends Model
{

    function Newsnpromo_model()
    {
        parent::Model();
        $this->load->helper('url');

        $this->db_prefix = $this->db->dbprefix;
        $this->newsnpromo = $this->config->item($this->db->dbprefix . 'newsnpromo');
        $this->newsnpromo_menus = $this->config->item($this->db->dbprefix . 'newsnpromo_menus');
    }

    function get_data($offset = 0, $row_count = 0, $session_keyword = '')
    {
        if ($session_keyword != 'dp' && $this->session->userdata($session_keyword) != "") {
            $this->db->where('language', $this->session->userdata($session_keyword));
        } else if ($session_keyword == 'dp') {
            // Nothing do here
        } else {
            $this->db->where_in('language', array($this->config->item('system_lang'),));
        }

        $this->db->orderby('name', 'asc');
        if ($offset >= 0 AND $row_count > 0) {
            $query = $this->db->get($this->newsnpromo, $row_count, $offset);
        } else {
            $query = $this->db->get($this->newsnpromo);
        }
        return $query;
    }

    function insert_data($img_data)
    {
        $data = array(
            'name' => $this->input->post('name'),
            'image' => isset($img_data['file_name']) ? $img_data['file_name'] : '',
            'description' => htmlentities($this->input->post('description'), ENT_QUOTES, "UTF-8"),
            'date_added' => $this->TVclass->current_date(),
            'language' => $this->input->post('language')
        );
        $this->db->insert($this->newsnpromo, $data);
        $this->TVclass->update_flag('newsnpromo');
    }

    function update_data($img_data, $id)
    {
        $data = array(
            'name' => $this->input->post('name'),
            'image' => isset($img_data['file_name']) ? $img_data['file_name'] : '',
            'description' => htmlentities($this->input->post('description'), ENT_QUOTES, "UTF-8"),
            'date_modified' => $this->TVclass->current_date(),
            'language' => $this->input->post('language')
        );
        $this->db->where('id', $id);
        $this->db->update($this->newsnpromo, $data);
        $this->TVclass->update_flag('newsnpromo');
    }

    function delete_data($id)
    {
        $get_image = $this->get_data_byid($id)->row_array();
        $filename = './icons/NEWSNPROMO/' . $get_image['image'];
        if (file_exists($filename)) {
            unlink($filename);
        }

        $this->db->where('id', $id);
        $this->db->delete($this->newsnpromo);
        $this->TVclass->update_flag('newsnpromo');
    }

    function get_data_byid($id = false)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->newsnpromo);
        return $query;
    }

    /** Menu **/

    function get_data_menu($offset = 0, $row_count = 0)
    {
        $this->db->orderby('name', 'asc');
        if ($offset >= 0 AND $row_count > 0) {
            $query = $this->db->get($this->newsnpromo_menus, $row_count, $offset);
        } else {
            $query = $this->db->get($this->newsnpromo_menus);
        }
        return $query;
    }

    function insert_data_menu($img_data)
    {
        $data = array(
            'name' => $this->input->post('name'),
            'description' => htmlentities($this->input->post('description'), ENT_QUOTES, "UTF-8"),
            'newsnpromo' => $this->input->post('newsnpromo'),
            'date_added' => $this->TVclass->current_date(),
            'image' => isset($img_data['file_name']) ? $img_data['file_name'] : '',
        );
        $this->db->insert($this->newsnpromo_menus, $data);
        $this->TVclass->update_flag('newsnpromo');
    }

    function update_data_menu($img_data, $id)
    {
        $data = array(
            'name' => $this->input->post('name'),
            'description' => htmlentities($this->input->post('description'), ENT_QUOTES, "UTF-8"),
            'newsnpromo' => $this->input->post('newsnpromo'),
            'image' => isset($img_data['file_name']) ? $img_data['file_name'] : '',
            'date_modified' => $this->TVclass->current_date(),
        );
        $this->db->where('id', $id);
        $this->db->update($this->newsnpromo_menus, $data);
        $this->TVclass->update_flag('newsnpromo');
    }

    function delete_data_menu($id)
    {
        $get_image = $this->get_data_by_menuid($id)->row_array();
        $filename = './icons/NEWSNPROMO/' . $get_image['image'];
        if (file_exists($filename)) {
            unlink($filename);
        }

        $this->db->where('id', $id);
        $this->db->delete($this->newsnpromo_menus);
        $this->TVclass->update_flag('newsnpromo');
    }

    function get_data_by_menuid($id = false)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->newsnpromo_menus);
        return $query;
    }
}

?>