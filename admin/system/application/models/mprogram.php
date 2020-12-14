<?php
class MProgram extends Model{

	function MProgram()
		{
			parent::Model();
		}
	function getAllProgram($num,$offset)
		{
			$data = array();
			//$this->db->select('* , DATE_FORMAT(dateadded,\'%d-%m-%Y\') as add_date',FALSE);
			//$this->db->where('status', 'active');
			$Q = $this->db->get('program',$num,$offset);
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
		
	function getAllPrograms()
		{
			$data = array();
			
			$this->db->select('id,name,number');
			$this->db->from('program');
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
		
	function getProgram($id)
		{
			$data = array();
			$options = array('id'=>$id);
			$Q = $this->db->getwhere('program',$options,1);
			if ($Q->num_rows() > 0)
				{
					$data = $Q->row_array();
				}
			$Q->free_result();
			return $data;
		}	
		
	function addProgram()
		{
			if($_POST['prLevel']!=""){ $level=$_POST['prLevel'];}else{ $level="0";}
			$data = array(
				'name' => $this->TVclass->Replacechar($_POST['proname']),
				'startTime' => $_POST['Stime'],
				'endTime' => $_POST['Etime'],
				'genreId' => $_POST['GndrId'],
				'genreName' => $_POST['genreName'],
				'description' => $this->TVclass->Replacechar($_POST['description']),
				'language' => $_POST['LangID'],
				'prLevel' => $level,
				'prName' => $_POST['prName']
					);
				///print_r ($data);
			$this->db->insert('program', $data);
			/*
			$data = array(
				'TVChannelID' => $this->db->insert_id(),
				'TVGenreID' => $_POST['GndrId']
				); 
			$this->db->insert('itvtv_bygenre', $data);
			*/
		}	
		
	function UpdateProgram()
		{
			if($_POST['prLevel']!=""){ $level=$_POST['prLevel'];}else{ $level="0";}
		$data = array(
				'name' => $this->TVclass->Replacechar($_POST['proname']),
				'startTime' => $_POST['Stime'],
				'endTime' => $_POST['Etime'],
				'genreId' => $_POST['GndrId'],
				'genreName' => $_POST['genreName'],
				'description' => $this->TVclass->Replacechar($_POST['description']),
				'language' => $_POST['LangID'],
				'prLevel' => $level,
				'prName' => $_POST['prName']
					);
				
				$this->db->where('id',$_POST['Id']);
				$this->db->update('program', $data);
		}
		
	function deleteProgram($id)
		{
			
				$this->db->where('id', $id);
				$this->db->delete('program');
				
				
		}		
	
}	