<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Mdunion extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function read_passports($count,$from){
		
		$query = "SELECT register.*,organization.title FROM register LEFT JOIN organization ON register.expert=organization.id ORDER BY register.number DESC,register.organization LIMIT $from,$count";
		$query = $this->db->query($query);
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
}