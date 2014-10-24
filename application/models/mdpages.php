<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Mdpages extends MY_Model{
	
	var $id   			= 0;
	var $url			= '';
	var $title 			= '';
	var $description 	= '';
	var $keywords 		= '';
	var $content		= '';
	
	function __construct(){
		parent::__construct();
	}
	
	function read_fields_url($url,$fields,$table){
			
		$this->db->select($fields);
		$this->db->where('url',$url);
		$query = $this->db->get($table,1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return FALSE;
	}
	
}