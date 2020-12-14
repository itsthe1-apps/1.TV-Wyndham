<?php

class NEWS extends Model {

    function NEWS() {
        parent::Model();
        $this->load->helper('url');

        $this->db_prefix = $this->db->dbprefix;
        $this->news = $this->config->item($this->db->dbprefix . 'news');
    }

    function getAllnews($num, $offset, $session_keyword) {
        $data = array();
        //$this->db->select('* , DATE_FORMAT(dateadded,\'%d-%m-%Y\') as add_date',FALSE);
        //$this->db->where('status', 'active');
        $this->db->select('id,title,summary,fullnews,date_added as add_date', FALSE);
        if ($this->session->userdata($session_keyword) != "") {
            $this->db->where('language', $this->session->userdata($session_keyword));
        } else {
            $this->db->where('language', $this->config->item('system_lang'));
        }
        $Q = $this->db->get($this->news, $num, $offset);

        //print $offset;
        //$Q = $this->db->get('news',$num,$offset);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function getnews($id) {
        $data = array();
        $options = array('id' => $id);
        $Q = $this->db->getwhere($this->news, $options, 1);
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }

    function addnews() {
        $quotes = array('/"/', "/'/", "//");
        $_POST['summary'] = preg_replace($quotes, '', $_POST['summary']);
        //$_POST['summary'] = ereg_replace("/\n\r|\r\n|\n|\r/", "", $_POST['summary']);

        $_POST['fullnews'] = preg_replace($quotes, '', $_POST['fullnews']);
        //$_POST['fullnews'] = ereg_replace("/\n\r|\r\n|\n|\r/", "", $_POST['fullnews']);

        $date_added = time() . "000";

        $data = array(
            'title' => $_POST['title'],
            'summary' => $_POST['summary'],
            'fullnews' => utf8_encode($_POST['fullnews']),
            'language' => $this->input->post('language'),
            'date_added' => $date_added
        );
        $this->db->insert($this->news, $data);
        $this->TVclass->update_flag('news');
    }

    function Updatenews() {
        $quotes = array('/"/', "/'/", "//");
        $_POST['summary'] = preg_replace($quotes, '', $_POST['summary']);
        $_POST['summary'] = ereg_replace("/\n\r|\r\n|\n|\r/", "", $_POST['summary']);
        $_POST['fullnews'] = preg_replace($quotes, '', $_POST['fullnews']);
        $_POST['fullnews'] = ereg_replace("/\n\r|\r\n|\n|\r/", "", $_POST['fullnews']);
        $date_added = time() . "000";
        $data = array(
            'title' => $_POST['title'],
            'summary' => $_POST['summary'],
            'fullnews' => $_POST['fullnews'],
            'language' => $this->input->post('language'),
            'date_updated' => $this->TVclass->current_date()
        );
        $this->db->where('id', $_POST['id']);
        $this->db->update($this->news, $data);
        //$this->db->query('update newsflag set flag=now()');
        $this->TVclass->update_flag('news');
    }

    function deletenews($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->news);
        //$this->db->query('update newsflag set flag=now()');		
        $this->TVclass->update_flag('news');
    }

}
