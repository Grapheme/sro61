<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Mdnews extends MY_Model{
	
	var $id			= 0;
	var $title		= '';
	var $small_title= '';
	var $translit	= '';
	var $text 		= '';
	var $small_text = '';
	var $date		= '';
	var $image		= '';
	var $noimage	= 0;
	
	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data,$translit){
			
		$this->title		= $data['title'];
		$this->small_title	= $data['small_title'];
		$this->translit		= $translit;
		$this->text			= $data['text'];
		$this->small_text	= $data['small_text'];
		$this->date			= date("Y-m-d");
		if($data['image']):
			$this->image	= $data['image'];
			$this->noimage = 0;
		else:
			$this->image = '';
			$this->noimage = 1;
		endif;
		
		$this->db->insert('news',$this);
		return $this->db->insert_id();
	}
	
	function update_record($id,$data,$translit,$noimage){
		
		$this->db->set('title',$data['title']);
		$this->db->set('small_title',$data['small_title']);
		$this->db->set('translit',$translit);
		$this->db->set('text',$data['text']);
		$this->db->set('small_text',$data['small_text']);
		$this->db->set('noimage',$noimage);
		if(isset($data['image'])):
			$this->db->set('image',$data['image']);
		endif;
		$this->db->where('id',$id);
		$this->db->update('news');
		return $this->db->affected_rows();
	}
}