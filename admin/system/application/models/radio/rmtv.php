<?php
class RMTV extends Model{

	function RMTV(){
		parent::Model();
		$this->load->helper('url');
		
		$this->db_prefix		= $this->db->dbprefix;
		$this->channel			= $this->db->dbprefix.'r_channel';
		$this->itvtv_bygenre	= $this->db->dbprefix.'r_itvtv_bygenre';
		$this->CI = & get_instance();
	}
	
	function getAllTv($offset = 0, $row_count = 0, $var1=false, $var2=false){
		if($var1>0){;
			$this->db->join($this->itvtv_bygenre,$this->itvtv_bygenre.'.TVChannelID='.$this->channel.'.id','left');
			$this->db->where($this->itvtv_bygenre.'.TVGenreID',$var1);
			$this->db->where($this->itvtv_bygenre.'.TVChannelID IS NOT NULL', null, false);
			$this->db->group_by($this->itvtv_bygenre.'.TVChannelID');
		}
		
		if ($offset >= 0 AND $row_count > 0){
			$this->db->orderby($this->channel.'.id','asc');
			$query = $this->db->get($this->channel, $row_count, $offset);
		}else{				
			$this->db->orderby($this->channel.'.id','asc');
			$query = $this->db->get($this->channel);
		}
		
		//print_r($this->db->last_query()."<br>");
		return $query;
	}	
		
	function getAllChannels(){
		$data = array();
			
		$this->db->select('id,name,number');
		$this->db->from($this->channel);
		$this->db->order_by("number", "asc"); 

		$Q = $this->db->get();
		if ($Q-> num_rows() > 0)
		{
			foreach ($Q->result_array() as $row)	
			{
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}			
		
	function getTv($id){
		$data = array();		
		$options = array('id'=>$id);
		$Q = $this->db->getwhere($this->channel,$options,1);
		if ($Q->num_rows() > 0)
		{
			$data = $Q->row_array();
		}
		$Q->free_result();
		return $data;
	}	
		
	function get_channel_gerne_lists($channel_id){
		$this->db->where('TVChannelID',$channel_id);
		$query = $this->db->get($this->itvtv_bygenre);
		return $query;
	}
		
	function addTv(){
		$this->load->library('upload');
		if(isset($_POST['prLevel'])){ $level=$_POST['prLevel'];}else{ $level="0";}	
		$data = array(
			'name' 			=> $this->TVclass->Replacechar($_POST['name']),
			'number' 		=> $_POST['ChNum'],
			//'genreId'		=> $_POST['GndrId'],
			'genreName' 	=> $_POST['genreName'],
			'mrl' 			=> $_POST['path'],
			'description' 	=> $this->TVclass->Replacechar($_POST['description']),
			'language' 		=> $_POST['LangID'],
			'prLevel' 		=> $level,
			'prName' 		=> $_POST['prName'],
			'eitXML'		=> $_POST['eitxml'],
			'epgXML' 		=> $_POST['epgxml'],
			'date_added'	=> $this->TVclass->current_date()
		);
				
		$image = $this->upload->data();	
		if ($image['file_name']){
			//$data['logo'] = TV_PATH.$image['file_name'];
			$data['logo'] = $image['file_name'];
			//$data['icon'] = $image['file_name'];
		}
				
		$this->db->insert($this->channel, $data);
		/**
		$data = array(
			'TVChannelID' => $this->db->insert_id(),
			'TVGenreID' => $_POST['GndrId']
		);
		**/
		$last_id 		= $this->db->insert_id();
		$data_mgenre	= $this->input->post('GndrId');
		if(count($data_mgenre)>0){
			for($i=0;$i<count($data_mgenre);$i++){
				$ins_data = array('TVChannelID' => $last_id, 'TVGenreID' => $data_mgenre[$i]);
				$this->db->insert($this->itvtv_bygenre, $ins_data);
			}
		}
		$this->TVclass->update_flag('tv');
	}	
		
	function UpdateTv(){
		$this->load->library('upload');
		if(isset($_POST['prLevel']) && $_POST['prLevel']!=""){ $level=$_POST['prLevel'];}else{ $level="0";}
		$data = array(
				'name' 			=> $this->TVclass->Replacechar($_POST['name']),
				'number' 		=> $_POST['ChNum'],
				//'genreId' 		=> $_POST['GndrId'],
				'genreName' 	=> $_POST['genreName'],
				'mrl' 			=> $_POST['path'],
				'description' 	=> $this->TVclass->Replacechar($_POST['description']),
				'language' 		=> $_POST['LangID'],
				'prLevel' 		=> $level,
				'prName' 		=> $_POST['prName'],
				'eitXML' 		=> $_POST['eitxml'],
				'epgXML' 		=> $_POST['epgxml'],
				'date_modified'	=> $this->TVclass->current_date()
			);
				
				$image = $this->upload->data();
				//print_r ($image);
				if ($image['file_name'])
				{
					$filename = './icons/RADIO/'.$this->input->post('file_img_name');
					if(file_exists($filename)){
						unlink($filename);
					}
					$data['logo'] =$image['file_name'];
					//$data['icon'] = $image['file_name'];
					//$data['path'] = $config['upload_path'];
				}
					
				$this->db->where('id',$_POST['Id']);
				$this->db->update($this->channel, $data);
				/**
				$data = array(
					'TVGenreID' => $_POST['GndrId']
				);
				**/
				$this->delete_channel_genre($_POST['Id']);
				$last_id 		= $_POST['Id'];
				$data_mgenre	= $this->input->post('GndrId');
				if(count($data_mgenre)>0){
					for($i=0;$i<count($data_mgenre);$i++){
						$ins_data = array('TVChannelID' => $last_id, 'TVGenreID' => $data_mgenre[$i]);
						$this->db->insert($this->itvtv_bygenre, $ins_data);
					}
				}
			$this->TVclass->update_flag('tv');
		}
	
	function delete_channel_genre($channel_id){
		$this->db->where('TVChannelID',$channel_id);
		$this->db->delete($this->itvtv_bygenre);
	}
		
	function deleteTV($id,$id_g){
			$get_image = $this->getTv($id);
			$filename 	= './icons/RADIO/'.$get_image['logo'];	
			if(file_exists($filename)) {
				unlink($filename);
			}
			
			$this->delete_channel_genre($id);
			$this->CI->load->model('RFavourites');
			$this->CI->RFavourites->delete_bychannel_id($id);
			$this->db->where('id', $id);
			$this->db->delete($this->channel);
				//$this->db->where('TVChannelID', $id);
				//$this->db->where('TVGenreID', $id_g);
				//$this->db->delete('itvtv_bygenre');
			$this->TVclass->update_flag('tv');
		}		
		
	function delete_bygenre($genre_id){
		$this->db->where('TVGenreID',$genre_id);
		$Q = $this->db->get($this->itvtv_bygenre);
		if($Q->num_rows()>0){
			foreach($Q->result() as $row){
				$this->deleteTV($row->TVChannelID,0);
			}
		}
		$this->db->where('TVGenreID',$genre_id);
		$this->db->delete($this->itvtv_bygenre);
	}
	
}	