<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Clients_interface extends MY_Controller{
	
	function __construct(){
		
		parent::__construct();
		if(!$this->loginstatus):
			redirect('');
		endif;
	}
	
	public function profile(){
		
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'Личный кабинет | Cмена пароля',
					'baseurl' 		=> base_url(),
					'user'			=> $this->mdusers->read_record($this->user['uid'],'users'),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('submit')):
			unset($_POST['submit']);
			$this->form_validation->set_rules('oldpas',' ','trim');
			$this->form_validation->set_rules('password',' ','trim');
			$this->form_validation->set_rules('confpass',' ','trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Неверно заполены необходимые поля<br/>');
				redirect($this->uri->uri_string());
			else:
				if(!empty($_POST['oldpas']) && !empty($_POST['password']) && !empty($_POST['confpass'])):
					
					if(!$this->mdusers->valid_password($this->user['uid'],'password',md5($_POST['oldpas']))):
						$this->session->set_userdata('msgr',' Не верный старый пароль!');
					elseif($_POST['password']!=$_POST['confpass']):
						$this->session->set_userdata('msgr',' Пароли не совпадают.');
					else:
						$this->mdusers->update_field($this->user['uid'],'password',md5($_POST['password']),'users');
						$this->mdusers->update_field($this->user['uid'],'cryptpassword',$this->encrypt->encode($_POST['password']),'users');
						$this->session->set_userdata('msgs',' Пароль успешно изменен');
					endif;
				endif;
				redirect($this->uri->uri_string());
			endif;
		endif;
		$this->load->view("clients_interface/profile",$pagevar);
	}
	
	public function returnRegister(){
		
		$pagevar = array(
			'description'	=> '',
			'author'		=> '',
			'title'			=> 'Личный кабинет | Возврат паспортов',
			'baseurl' 		=> base_url(),
			'pages'			=> array(),
		);
		$this->load->view("clients_interface/returns",$pagevar);
	}
	
	public function EPRegisterME(){
		
		$pagevar = array(
			'description'	=> '',
			'author'		=> '',
			'title'			=> 'Личный кабинет | ЭП зарегистрированные МЭ',
			'baseurl' 		=> base_url(),
			'pages'			=> array(),
		);
		$this->load->view("clients_interface/ep-register-me",$pagevar);
	}
	
	
	public function available_orders(){
		
		$from = intval($this->uri->segment(5));
		$pagevar = array(
					'description'	=> '',
					'author'		=> '',
					'title'			=> 'Личный кабинет | Доступные заказы',
					'baseurl' 		=> base_url(),
					'orders'		=> $this->mdorders->read_limit_active(10,$from),
					'pages'			=> array(),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$pagevar['pages'] = $this->pagination('cabinet/orders',4,$this->mdorders->count_active_records(),10);
		
		for($i=0;$i<count($pagevar['orders']);$i++):
			$pagevar['orders'][$i]['date'] = $this->operation_date_on_time($pagevar['orders'][$i]['date']);
		endfor;
		$this->session->set_userdata('backpath',$pagevar['baseurl'].$this->uri->uri_string());
		$this->load->view("clients_interface/available-orders",$pagevar);
	}
}