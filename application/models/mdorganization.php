<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Mdorganization extends MY_Model{
	
	var $id			= 0;
	var $docnumber  = 1;
	var $title		= 0;
	var $type		= 0;
	
	function __construct(){
		parent::__construct();
	}
	
	function insert_record($id,$title,$type){

		$this->id = $id;
		$this->title = $title;
		$this->type = $type;
		$this->db->insert('organization',$this);
	}
	
	function update_record($id,$title){

		$this->db->set('title',$title);
		$this->db->where('id',$id);
		$this->db->update('organization');
		return $this->db->affected_rows();
	}
	
	function read_experts(){
		
		$this->db->order_by('id');
		$this->db->where('type',0);
		$this->db->or_where('id',0);
		$query = $this->db->get('organization');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function read_organization(){
		
		$this->db->order_by('id');
		$this->db->where('type',1);
		$this->db->or_where('id',0);
		$query = $this->db->get('organization');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
}