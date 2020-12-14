<?php

//Edit by Yesh 
class exitmsgmodel extends Model {

    function exitmsgmodel() {
        parent::Model();
        $this->load->database();
        $this->db_prefix = 'mw_';
        $this->exit = $this->db_prefix . 'exit';
    }

    /** Emergency Message * */
    function exitmsg_all($offset = 0, $row_count = 0) {
        if ($offset >= 0 AND $row_count > 0) {
            $this->db->orderby('id', 'asc');
            $query = $this->db->get($this->exit, $row_count, $offset);
        } else {
            $this->db->orderby('id', 'asc');
            $query = $this->db->get($this->exit);
        }
        return $query;
    }

    function exitmsg_insert_data() {
        $image_path = "";
        $image = null;
        if ($this->upload) {
            $image = $this->upload->data();
        }
        if ($image != null && $image['file_name']) {
            $filename = EXIT_PATH . "\\" . $this->input->post('file_img_name');
            if (file_exists($filename)) {
                unlink($filename);
            }
            $image_path = $image['file_name'];
        }

        $data = array(
            'message' => $this->input->post('message'),
            'rtsp' => $this->input->post('rtsp'),
            'status' => $this->input->post('status'),
            'image_path' => $image_path,
            'date_added' => $this->TVclass->current_date()
        );
        $this->db->insert($this->exit, $data);
    }

    function exitmsg_update_data($dev_type_id) {
        $image_path = "";
        $image = null;
        if ($this->upload) {
            $image = $this->upload->data();
        }
        if ($image != null && $image['file_name']) {
            $filename = EXIT_PATH . "\\" . $this->input->post('file_img_name');
            if (file_exists($filename)) {
                unlink($filename);
            }
            $image_path = $image['file_name'];
        }
        if ($image_path != null) {
            $data = array(
                'message' => $this->input->post('message'),
                'rtsp' => $this->input->post('rtsp'),
                'status' => $this->input->post('status'),
                'image_path' => $image_path,
                'date_updated' => $this->TVclass->current_date()
            );
        } else {
            $data = array(
                'message' => $this->input->post('message'),
                'rtsp' => $this->input->post('rtsp'),
                'status' => $this->input->post('status'),
                'date_updated' => $this->TVclass->current_date()
            );
        }
        $this->db->where('id', $dev_type_id);
        $this->db->update($this->exit, $data);
    }

    function delete_exitmsg($dev_type_id) {
        $get_image = $this->exitmsg_byid($dev_type_id);
        $filename = './icons/EXIT/' . $get_image['image_path'];
        if (file_exists($filename)) {
            unlink($filename);
        }

        $this->db->where('id', $dev_type_id);
        $this->db->delete($this->exit);
    }

    function exitmsg_byid($id) {
        $data = array();
        $this->db->where('id', $id);
        $Q = $this->db->get($this->exit);
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }

}