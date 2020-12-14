<?php
class MProducts extends Model{

	function MProducts(){
		parent::Model();
		$this->load->helper('url');
			
		$this->db_prefix		= $this->db->dbprefix;
		$this->movie			= $this->config->item($this->db->dbprefix.'movie');
		$this->itvmovie_bygenre	= $this->config->item($this->db->dbprefix.'itvmovie_bygenre');
	}
	
	function getAllProducts($offset = 0, $row_count = 0,$var1=false, $var2=false){
		if ($offset >= 0 AND $row_count > 0){
			$var1>0 ? $this->db->where('genreId',$var1) : "";
			$this->db->orderby('id','asc');
			$query = $this->db->get($this->movie, $row_count, $offset);
	
		}else{
			$var1>0 ? $this->db->where('genreId',$var1) : "";
			$this->db->orderby('id','asc');
			$query = $this->db->get($this->movie);
		}
		return $query;
	}	
		
	function getCategory($id){
		$data = array();
		$this->db->where('id',$id);
		$Q = $this->db->get($this->movie);
		if ($Q->num_rows() > 0){
			$data = $Q->row_array();
		}			
		$Q->free_result();	
		return $data;
	}	
		
	function add($image_data){
		$this->load->library('upload');
		if(isset($_POST['prLevel']) && $_POST['prLevel']!=""){ $level=$_POST['prLevel'];}else{ $level="0";}
		$string	=	$_POST['name'];
		$data = array(
			'name'		 	=> $this->TVclass->Replacechar($_POST['name']),
			'genreId' 		=> $_POST['GndrId'],
			'genreName' 	=> $_POST['genreName'],
			'mrl' 			=> $_POST['path'],
			'duration' 		=> $_POST['runtime'],
			'description' 	=> $this->TVclass->Replacechar($_POST['description']),
			'language'		=> $_POST['LangID'],
			'prLevel' 		=> $level,
			'prName' 		=> $_POST['prName'],
			'logo' 			=> isset($image_data['logo']) ? $image_data['logo'] : '',
			'thumbnail' 	=> isset($image_data['thumbnail']) ? $image_data['thumbnail'] : '',
			'mrl_trailer'	=> $_POST['mrl_trailer'],
			'date_added'	=> $this->TVclass->current_date()
		);
				
		$this->db->insert($this->movie, $data);
		
		$data = array(
			'MovieID'		=> $this->db->insert_id(),
			'GenreID'		=> $_POST['GndrId'],
			'date_added'	=> $this->TVclass->current_date()
		);	
		$this->db->insert($this->itvmovie_bygenre, $data);		
		$this->TVclass->update_flag('vod');
	}	
		
	function Update($image_data){
		$this->load->library('upload');
		if(isset($_POST['prLevel']) && $_POST['prLevel']!=""){ $level=$_POST['prLevel'];}else{ $level="0";}
		$string = $_POST['name'];
		$data	= array(
			'name' 			=> $this->TVclass->Replacechar($_POST['name']),
			'genreId' 		=> $_POST['GndrId'],
			'genreName' 	=> $_POST['genreName'],
			'mrl' 			=> $_POST['path'],
			'duration' 		=> $_POST['runtime'],
			'description' 	=> $this->TVclass->Replacechar($_POST['description']),
			'language' 		=> $_POST['LangID'],
			'prLevel' 		=> $level,
			'prName' 		=> $_POST['prName'],
			'mrl_trailer'	=> $_POST['mrl_trailer'],
			'date_updated'	=> $this->TVclass->current_date()
		);
				
		if(isset($image_data['logo'])){
			$data['logo'] = $image_data['logo'];
		}
		
		if(isset($image_data['thumbnail'])){
			$data['thumbnail'] = $image_data['thumbnail'];
		}	
		
		$this->db->where('id',$_POST['id']);
		$this->db->update($this->movie, $data);	
		
		$data = array(
			'GenreID'		=> $_POST['id'],
			'date_added'	=> $this->TVclass->current_date()
		);
		$this->db->where('MovieID',$_POST['id']);
		$this->db->update($this->itvmovie_bygenre, $data);
		$this->TVclass->update_flag('vod');
	}
		
	function deleteMovie($id,$id_g=false){
		//$data = array('status' => 'inactive');
		//$this->db->where('id', $id);
		//$this->db->update('movies', $data);
			
		$query     =  $this->db->get_where($this->movie,array('id' => $id));
		$row       = $query->row();
		@unlink('./icons/VOD/'.$row->logo);
		@unlink('./icons/VOD/thumbnail/'.$row->thumbnail);
		$id_g==true ? $this->db->where('genreId', $id_g) : $this->db->where('id', $id);
		$this->db->delete($this->movie);
		
		$id_g==true ? $this->db->where('GenreID', $id_g) : $this->db->where('MovieID', $id);
		$this->db->delete('itvmovie_bygenre');
		
		$this->TVclass->update_flag('vod');
	}		
		
	function getMGenreDropDown(){
		$data = array();
		$Q = $this->db->get('movies_genre');
		if($Q->num_rows() > 0){
			foreach ($Q->result_array() as $row){
				$data[$row['mg_id']] = $row['mg_name'];
			}
		}
		$Q->free_result();
		return $data;
	}		
}	