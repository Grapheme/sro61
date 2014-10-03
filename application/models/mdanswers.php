<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Mdanswers extends MY_Model{
	
	var $id   		= 0;
	var $question	= 0;
	var $name		= '';
	var $email 		= '';
	var $date 		= '';
	var $text 		= '';
	var $comment 	= '';
	var $user_ip 	= '';
	
	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data){
			
		$this->question	= $data['qid'];
		$this->name		= $data['name'];
		$this->email	= $data['email'];
		$this->date		= date("Y-m-d H:i:s");
		$this->text		= $data['text'];
		$this->comment	= $data['comment'];
		$this->user_ip	= $data['ip'];
		
		$this->db->insert('answers',$this);
		return $this->db->insert_id();
	}
	
	function delete_records($question){
	
		$this->db->where('question',$question);
		$this->db->delete('answers');
		return $this->db->affected_rows();
	}
	
	function update_record($id,$data){
			
		$this->db->set('text',$data['text']);
		$this->db->where('id',$id);
		$this->db->update('answers');
		return $this->db->affected_rows();
	}
	
	function read_records_by_questions($question){
			
		if(!$question):
			return NULL;
		endif;
		$query = 'SELECT * FROM answers WHERE question IN (';
		for($i=0;$i<count($question);$i++):
			$query .= $question[$i]['id'];
			if($i+1<count($question)):
				$query.=',';
			else:
				$query.=') ORDER BY id';
			endif;
		endfor;
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
}