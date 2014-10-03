<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Mdregister extends MY_Model{
	
	var $id   		= 0;
	var $number		= 0;
	var $expert 	= 0;
	var $conclusion = '';
	var $register 	= '';
	var $transfer	= '';
	var $organization= 0;
	var $customer	= '';
	var $address	= '';
	var $survey	= '';
	var $solution	= '';
	var $availability	= '';
	var $corrections	= '';
	var $inn			= '';
	var $double			= 0;
	
	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data){
			
		$this->number		= $data['number'];
		$this->expert		= $data['expert'];
		$this->conclusion	= $data['conclusion'];
		$this->register		= $data['register'];
		$this->transfer		= $data['transfer'];
		$this->organization	= $data['organization'];
		$this->customer		= $data['customer'];
		$this->address		= $data['address'];
		$this->survey		= $data['survey'];
		$this->solution		= $data['solution'];
		$this->availability	= $data['availability'];
		$this->corrections	= $data['corrections'];
		$this->inn			= $data['inn'];
		$this->double		= $data['double'];
		
		$this->db->insert('register',$this);
		return $this->db->insert_id();
	}
	
	function update_record($id,$data){
			
		$this->db->set('number',$data['number']);
		$this->db->set('expert',$data['expert']);
		$this->db->set('conclusion',$data['conclusion']);
		$this->db->set('register',$data['register']);
		$this->db->set('transfer',$data['transfer']);
		$this->db->set('organization',$data['organization']);
		$this->db->set('customer',$data['customer']);
		$this->db->set('address',$data['address']);
		$this->db->set('survey',$data['survey']);
		$this->db->set('solution',$data['solution']);
		$this->db->set('availability',$data['availability']);
		$this->db->set('corrections',$data['corrections']);
		$this->db->set('inn',$data['inn']);
		$this->db->set('double',$data['double']);
		$this->db->set('retested',$data['retested']);
		$this->db->where('id',$id);
		$this->db->update('register');
		return $this->db->affected_rows();
	}

	function search_query($id = FALSE,$search){
		
		if($id):
			$query = "SELECT * FROM register WHERE (id = $id OR customer = '$search')";
		else:
			$query = "SELECT * FROM register WHERE customer = '$search'";
		endif;
		return $query;
	}

	function countRecordsByOrganization($organization){
		
		$this->db->select('COUNT(*) AS cnt');
		$query = $this->db->get_where('register',array('organization'=>$organization));
		$data = $query->result_array();
		if($data) return $data[0]['cnt'];
		return 0;
	}
}