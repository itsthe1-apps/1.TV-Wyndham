<?php

class MGenre extends Model {

    function MGenre() {
        parent::Model();
		$this->load->helper('url');
		
		$this->db_prefix		= $this->db->dbprefix;
		$this->genre			= $this->config->item($this->db->dbprefix.'genre');
		$this->vod_genre		= $this->config->item($this->db->dbprefix.'vod_genre');
		$this->itvtvgenre		= $this->config->item($this->db->dbprefix.'itvtvgenre');
		$this->movie			= $this->config->item($this->db->dbprefix.'movie');
		$this->itvmovie_bygenre = $this->config->item($this->db->dbprefix.'itvmovie_bygenre');
		
		$this->CI =& get_instance();
    }

    function getAllgenre($offset = 0, $row_count = 0) {
        if ($offset >= 0 AND $row_count > 0) {
            $this->db->orderby('name', 'asc');
            $query = $this->db->get($this->genre, $row_count, $offset);
        } else {
            $this->db->orderby('name', 'asc');
            $query = $this->db->get($this->genre);
        }
        return $query;
    }

	function getAllVODgenre($offset = 0, $row_count = 0) {
        if ($offset >= 0 AND $row_count > 0) {
            $this->db->orderby('name', 'asc');
            $query = $this->db->get($this->vod_genre, $row_count, $offset);
        } else {
            $this->db->orderby('name', 'asc');
            $query = $this->db->get($this->vod_genre);
        }
        return $query;
    }

    function getAllgenre2($offset = 0, $row_count = 0) {
        if ($offset >= 0 AND $row_count > 0) {
            $this->db->orderby('GndrId', 'asc');
            $query = $this->db->get($this->itvtvgenre, $row_count, $offset);
        } else {
            $this->db->orderby('GndrId', 'asc');
            $query = $this->db->get($this->itvtvgenre);
        }
        return $query;
    }

    function getGenret($id) {
        $data = array();
        $options = array('id' => $id);
        $Q = $this->db->getwhere($this->genre, $options, 1);
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }

    function get_record_byid($sub_id) {
        $data = array();
        $this->db->where('GndrId', $sub_id);
        $Q = $this->db->get($this->itvtvgenre);
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }

    function addgenre() {
        $data = array(
            'name'			=> $_POST['name'],
			'url'			=> $_POST['url'],
            'language'		=> $_POST['LangID'],
			'date_added'	=> $this->TVclass->current_date()
        );
        $this->db->insert($this->genre, $data);
    }

    function addgenre2() {
        $data = array(
            'Code'			=> $_POST['name'],
			'date_added'	=> $this->TVclass->current_date()
        );
        $this->db->insert($this->itvtvgenre, $data);
    }

    function UpdateGenre() {
        $data = array(
            'name' 			=> $_POST['name'],
			'url'			=> $_POST['url'],
            'language'		=> $_POST['LangID'],
			'date_updated'	=> $this->TVclass->current_date()
        );
        $this->db->where('id', $_POST['id']);
        $this->db->update($this->genre, $data);
    }

    function UpdateGenre2($id) {
        $data = array(
            'Code' 			=> $_POST['name'],
			'date_updated'	=> $this->TVclass->current_date()
        );
        $this->db->where('GndrId', $id);
        $this->db->update($this->itvtvgenre, $data);
    }

    function deleteGenre($id) {
        //$data = array('status' => 'inactive');
		$this->CI->load->model('MTV');
		$this->CI->MTV->delete_bygenre($id);
		
        $this->db->where('id', $id);
        $this->db->delete($this->genre);
    }

    function deleteGenre2($id) {
        //$data = array('status' => 'inactive');
        $this->db->where('GndrId', $id);
        $this->db->delete($this->itvtvgenre);
    }

    function getGenreDropDown() {
        $data = array();
        $Q = $this->db->get($this->itvtvgenre);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[$row['GndrId']] = $row['GndrNm'];
            }
        }
        $Q->free_result();
        return $data;
    }

	function addvod_genre(){
		$data = array(
			'name'			=> $this->input->post('vod_genre'),
			'url'			=> $this->input->post('url'),
			'language'		=> $this->input->post('language_id'),
			'date_added'	=> $this->TVclass->current_date()
		);
		$this->db->insert($this->vod_genre,$data);
	}

	function updatevod_genre($id){
		$data = array(
			'name'			=> $this->input->post('vod_genre'),
			'url'			=> $this->input->post('url'),
			'language'		=> $this->input->post('language_id'),
			'date_modified'	=> $this->TVclass->current_date()
		);
		$this->db->where('id',$id);
		$this->db->update($this->vod_genre,$data);
	}

	function vodgenre_byid($id){
		$this->db->where('id',$id);
		$query = $this->db->get($this->vod_genre);
		return $query;
	}
	
	function deletevod_genre($id){
		$this->deletevod_movie($id);
		$this->db->where('id',$id);
		$this->db->delete($this->vod_genre);
	}

	function deletevod_movie($id){
		$this->db->where('genreId',$id);
		$movie_data = $this->db->get($this->movie);
		if($movie_data->num_rows()>0){
			foreach($movie_data->result() as $row){
				$filename = './icons/VOD/'.$row->logo;
				@unlink($filename);
				
				$filename = './icons/VOD/thumbnail/'.$row->thumbnail;
				@unlink($filename);
			}
		}
		$this->db->where('genreId',$id);
		$this->db->delete($this->movie);
		
		$this->db->where('GenreID',$id);
		$this->db->delete($this->itvmovie_bygenre);
	}
}

