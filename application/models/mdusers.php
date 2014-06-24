<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Mdusers extends MY_Model{

	var $id   			= 0;
	var $org_id			= 0;
	var $organization	= '';
	var $access			= 1;
	var $grn			= '';
	var $inn			= '';
	var $number			= '';
	var $status			= '';
	var $login 			= '';
	var $address		= '';
	var $email			= '';
	var $cryptpassword 	= '';
	var $password 		= '';
	var $phones  		= '';
	var $signdate  		= '0000-00-00';

	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data){

		$this->org_id 			= $data['id'];
		$this->organization 	= $data['organization'];
		$this->grn 				= $data['grn'];
		$this->inn 				= $data['inn'];
		$this->number 			= $data['number'];
		$this->status 			= $data['status'];
		$this->address 			= $data['address'];
		$this->login 			= $data['login'];
		$this->cryptpassword	= $this->encrypt->encode($data['password']);
		$this->password			= md5($data['password']);
		$this->email 			= $data['email'];
		$this->phones 			= $data['phones'];
		$this->signdate 		= date("Y-m-d");
		
		$this->db->insert('users',$this);
		return $this->db->insert_id();
	}
	
	function update_record($id,$data){
		
		$this->db->set('organization',$data['organization']);
		$this->db->set('grn',$data['grn']);
		$this->db->set('inn',$data['inn']);
		$this->db->set('number',$data['number']);
		$this->db->set('status',$data['status']);
		$this->db->set('address',$data['address']);
		$this->db->set('login',$data['login']);
		$this->db->set('cryptpassword',$this->encrypt->encode($data['password']));
		$this->db->set('password',md5($data['password']));
		$this->db->set('email',$data['email']);
		$this->db->set('phones',$data['phones']);
		$this->db->where('id',$id);
		$this->db->update('users');
		return $this->db->affected_rows();
	}
	
	function auth_user($login,$password){
		
		$this->db->where('login',$login);
		$this->db->where('password',md5($password));
		$query = $this->db->get('users',1);
		$data = $query->result_array();
		if(isset($data[0])) return $data[0];
		return NULL;
	}

	function user_exist($field,$parameter){
			
		$this->db->where($field,$parameter);
		$query = $this->db->get('users',1);
		$data = $query->result_array();
		if(count($data)) return $data[0]['id'];
		return FALSE;
	}

	function valid_password($id,$field,$parameter){
			
		$this->db->where('id',$id);
		$this->db->where($field,$parameter);
		$query = $this->db->get('users',1);
		$data = $query->result_array();
		if(count($data)) return $data[0]['id'];
		return FALSE;
	}

	function read_limit_members($count,$from){
		
		$this->db->where("id >",0);
		$this->db->order_by('id','ASC');
		$this->db->limit($count,$from);
		$query = $this->db->get('users');
		$data = $query->result_array();
		if(count($data)) return $data;
		return NULL;
	}
	
	function count_members(){
		
		$this->db->select("COUNT(*) AS cnt");
		$this->db->where("id >",1);
		$query = $this->db->get('users');
		$data = $query->result_array();
		if(isset($data[0])) return $data[0]['cnt'];
		return 0;
	}
	
}