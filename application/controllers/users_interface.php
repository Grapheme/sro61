<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Users_interface extends MY_Controller {
	
	function __construct(){
		
		parent::__construct();
		
	}
	
	public function index(){
		
		$this->pages($this->uri->uri_string());
	}
	
	public function send_order(){
		
		$statusval = array('status'=>FALSE,'message'=>'Сообщение не отправлено');
		$data = trim($this->input->post('postdata'));
		if(!$data):
			show_404();
		endif;
		$data = preg_split("/&/",$data);
		for($i=0;$i<count($data);$i++):
			$dataid = preg_split("/=/",$data[$i]);
			$dataval[$i] = $dataid[1];
		endfor;
		if($dataval):
			$this->mdorders->insert_record($dataval);
			ob_start();
			?>
			<img src="<?=base_url();?>images/logo.png" alt="" />
			<p>Сообщение от <?=$dataval[0];?></p>
			<p>Email: <?=$dataval[1];?></p>
			<p>Контактный номер: <?=$dataval[2];?></p>
			<p>Адрес объекта: <?=$dataval[3];?></p>
			<p>Сообщение: <?=$dataval[4];?></p>
			<br/><br/><p><a href="<?=base_url();?>">С уважением администрация СРО «Энергоаудит»</a></p>
			<?
			$mailtext = ob_get_clean();
			$users = $this->mdusers->read_records('users');
			for($i=0;$i<count($users);$i++):
				$statusval['status'] = $this->send_mail($users[$i]['email'],'robot@sro61.ru','СРО «Энергоаудит»','Новая заявка на sro61.ru',$mailtext);
			endfor;
		endif;
		echo json_encode($statusval);
	}
	
	public function send_order_audit(){
		
		$statusval = array('status'=>FALSE,'message'=>'Ваша заявка принята');
		$data = trim($this->input->post('postdata'));
		if(!$data):
			show_404();
		endif;
		$data = preg_split("/&/",$data);
		for($i=0;$i<count($data);$i++):
			$dataid = preg_split("/=/",$data[$i]);
			$dataval[$i] = $dataid[1];
		endfor;
		if($dataval):
			$this->mdorders->insert_record($dataval);
			ob_start();
			?>
			<img src="<?=base_url();?>images/logo.png" alt="" />
			<p>Название организации / контактное лицо: <?=$dataval[0];?></p>
			<p>Email: <?=$dataval[1];?></p>
			<p>Телефон для связи: <?=$dataval[2];?></p>
			<p>Федеральный округ: <?=$dataval[3];?></p>
			<p>Область, населенный пункт: <?=$dataval[4];?></p>
			<p>Описание объекта (название, площадь объекта, ТЭР):<br/> <?=$dataval[5];?></p>
			<p>Заказать полный сметный расчет (услуга платная): <?=$dataval[6];?></p>
			<?
			$mailtext = ob_get_clean();
			$statusval['status'] = $this->send_mail('sro61@mail.ru','robot@sro61.ru','СРО «Энергоаудит»','Заявка на проведение энергоаудита',$mailtext);
		endif;
		echo json_encode($statusval);
	}
	
	public function send_energy_passport(){
		
		$statusval = array('status'=>FALSE,'message'=>'Ваша заявка принята');
		$data = trim($this->input->post('postdata'));
		if(!$data):
			show_404();
		endif;
		$data = preg_split("/&/",$data);
		for($i=0;$i<count($data);$i++):
			$dataid = preg_split("/=/",$data[$i]);
			$dataval[$i] = $dataid[1];
		endfor;
		if($dataval):
			ob_start();
			?>
			<img src="<?=base_url();?>images/logo.png" alt="" />
			<p>1.Наименование Организации (Исполнителя работ по энергетическому обследованию)<br/>в реестре СРО (№ свидетельства о членстве в СРО): <?=$dataval[0];?></p>
			<p>2.Вид энергетического обследования: <?=$dataval[1];?></p>
			<p>3.Дата заключения договора на проведение энергетического обследования: <?=$dataval[2].'.'.$dataval[3].'.'.$dataval[4];?></p>
			<p>4.Номер договора на проведение энергетического обследования: <?=$dataval[5];?></p>
			<p>5.Наименование организации Заказчика проведения Энергетического обследования: <?=$dataval[6];?></p>
			<p>6.Форма собственности обследуемого юридического лица: <?=$dataval[7];?></p>
			<p>7.Стоимость Договора на проведение Энергетического обследования (в тыс.руб.):<br/> <?=$dataval[8];?></p>
			<p>8.Данные о количестве объектов, принадлежащих данному юридическому лицу: <?=$dataval[9];?></p>
			<p>9.Стоимость потребления топливно-энергетических ресурсов (ТЭР) за год. (в тыс.руб.): <?=$dataval[10];?></p>
			<p>10.Контактные данные(реквизиты для договора),электронная почта заявителя: <?=$dataval[11];?></p>
			<?
			$mailtext = ob_get_clean();
			$statusval['status'] = $this->send_mail('energoresurs@energoresurs61.ru','robot@sro61.ru','СРО «Энергоаудит»','Заявка на проведение энергоаудита',$mailtext);
		endif;
		echo json_encode($statusval);
	}
	
	public function pages($page_url = ''){
		
		$page_data = $this->mdpages->read_fields_url($page_url,'*','pages');
		
		if(!$page_data):
			show_404();
		endif;
		
		$pagevar = array(
			'title'			=> $page_data['title'],
			'description'	=> $page_data['description'],
			'keywords'		=> $page_data['keywords'],
			'content'		=> $page_data['content'],
			'baseurl' 		=> base_url(),
			'news' 			=> $this->mdnews->read_limit_records(3,0,'news','id','DESC'),
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		for($i=0;$i<count($pagevar['news']);$i++):
			$pagevar['news'][$i]['date'] = $this->operation_dot_date($pagevar['news'][$i]['date']);
		endfor;
		
		$this->load->view("users_interface/pages",$pagevar);
	}
	
	public function news(){
	
		$from = intval($this->uri->segment(3));
		$pagevar = array(
			'title'			=> 'СРО НП «Энергоаудит» в Ростове, Элисте, Краснодаре, Сочи: энергетический паспорт, энергетическое обследование',
			'description'	=> 'СРО ЮФО – некоммерческая саморегулируемая организация в Ростове на Дону, которая предлагает оформить энергетический паспорт.',
			'keywords'		=> 'сро юфо, вступить в, стоимость энергопаспорта, ростов на дону, энергосбережение, ставрополь, энергетический паспорт, краснодар, программа энергосбережения, сочи, обследования, астрахань, обязательное энергетическое обследование, пятигорск, энергоаудит, элиста, нп обинж энерго, майкоп, энергопаспорт, гильдия энергоаудиторов, волгоград, махачкала',
			'baseurl' 		=> base_url(),
			'allnews'		=> $this->mdnews->read_limit_records(5,$from,'news','id','DESC'),
			'news' 			=> NULL,
			'pages'			=> array(),
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$pagevar['pages'] = $this->pagination('news',3,$this->mdnews->count_all_records('news'),5);
		
		for($i=0;$i<count($pagevar['allnews']);$i++):
			$pagevar['allnews'][$i]['date'] = $this->operation_dot_date($pagevar['allnews'][$i]['date']);
		endfor;
		
		$this->load->view("users_interface/news",$pagevar);
	}
	
	public function register_members(){
	
		$from = intval($this->uri->segment(3));
		$pagevar = array(
			'title'			=> 'СРО НП «Энергоаудит» в Ростове, Элисте, Краснодаре, Сочи: энергетический паспорт, энергетическое обследование',
			'description'	=> 'СРО ЮФО – некоммерческая саморегулируемая организация в Ростове на Дону, которая предлагает оформить энергетический паспорт.',
			'keywords'		=> 'сро юфо, вступить в, стоимость энергопаспорта, ростов на дону, энергосбережение, ставрополь, энергетический паспорт, краснодар, программа энергосбережения, сочи, обследования, астрахань, обязательное энергетическое обследование, пятигорск, энергоаудит, элиста, нп обинж энерго, майкоп, энергопаспорт, гильдия энергоаудиторов, волгоград, махачкала',
			'baseurl' 		=> base_url(),
			'register'		=> $this->mdusers->read_limit_members(25,$from),
			'news' 			=> NULL,
			'pages'			=> array(),
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$pagevar['pages'] = $this->pagination('register-members',3,$this->mdusers->count_members(),25);
		
		$this->load->view("users_interface/register-members",$pagevar);
	}
	
	public function register_passports(){
	
		$from = intval($this->uri->segment(3));
		$pagevar = array(
			'title'			=> 'СРО НП «Энергоаудит» в Ростове, Элисте, Краснодаре, Сочи: энергетический паспорт, энергетическое обследование',
			'description'	=> 'СРО ЮФО – некоммерческая саморегулируемая организация в Ростове на Дону, которая предлагает оформить энергетический паспорт.',
			'keywords'		=> 'сро юфо, вступить в, стоимость энергопаспорта, ростов на дону, энергосбережение, ставрополь, энергетический паспорт, краснодар, программа энергосбережения, сочи, обследования, астрахань, обязательное энергетическое обследование, пятигорск, энергоаудит, элиста, нп обинж энерго, майкоп, энергопаспорт, гильдия энергоаудиторов, волгоград, махачкала',
			'baseurl' 		=> base_url(),
			'passports'		=> $this->mdunion->read_passports(25,$from),
			'news' 			=> NULL,
			'pages'			=> array(),
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$pagevar['pages'] = $this->pagination('register-passports',3,$this->mdregister->count_all_records('register'),25);
		
		$organization = $this->mdorganization->read_records('organization');
		
		for($i=0;$i<count($pagevar['passports']);$i++):
			for($j=0;$j<count($organization);$j++):
				if($pagevar['passports'][$i]['organization'] == $organization[$j]['id']):
					$pagevar['passports'][$i]['organization'] = $organization[$j]['title'];
				endif;
			endfor;
		endfor;
		$this->load->view("users_interface/register-passports",$pagevar);
	}
	
	public function forum(){
		
		$from = intval($this->uri->segment(3));
		$pagevar = array(
			'title'			=> 'СРО НП «Энергоаудит» в Ростове, Элисте, Краснодаре, Сочи: энергетический паспорт, энергетическое обследование',
			'description'	=> 'СРО ЮФО – некоммерческая саморегулируемая организация в Ростове на Дону, которая предлагает оформить энергетический паспорт.',
			'keywords'		=> 'сро юфо, вступить в, стоимость энергопаспорта, ростов на дону, энергосбережение, ставрополь, энергетический паспорт, краснодар, программа энергосбережения, сочи, обследования, астрахань, обязательное энергетическое обследование, пятигорск, энергоаудит, элиста, нп обинж энерго, майкоп, энергопаспорт, гильдия энергоаудиторов, волгоград, махачкала',
			'baseurl' 		=> base_url(),
			'questions'		=> $this->mdquestions->read_limit_records(10,$from,'questions','id','DESC'),
			'answers' 		=> array(),
			'news' 			=> $this->mdnews->read_limit_records(3,0,'news','id','DESC'),
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('qsubmit')):
			unset($_POST['qsubmit']);
			$this->form_validation->set_rules('name',' ','required|trim');
			$this->form_validation->set_rules('email',' ','required|valid_email|trim');
			$this->form_validation->set_rules('text',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Неверно заполены необходимые поля<br/>');
				$this->forum();
				return FALSE;
			else:
				$data = $this->input->post();
				if($this->loginstatus):
					$user = $this->mdusers->read_record($this->user['uid'],'users');
					$data['comment'] = $user['organization'].' '.$user['phones'];
				else:
					$data['comment'] = '';
				endif;
				$data['ip'] = $_SERVER['REMOTE_ADDR'];
				$this->mdquestions->insert_record($data);
				$this->session->set_userdata('msgs','Запись создана успешно.');
				redirect($this->uri->uri_string());
			endif;
		endif;
		if($this->input->post('asubmit') && $this->loginstatus):
			unset($_POST['asubmit']);
			$this->form_validation->set_rules('uid',' ','required|trim');
			$this->form_validation->set_rules('qid',' ','required|trim');
			$this->form_validation->set_rules('text',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Неверно заполены необходимые поля<br/>');
				$this->forum();
				return FALSE;
			else:
				$data = $this->input->post();
				$user = $this->mdusers->read_record($this->user['uid'],'users');
				$data['name'] = $user['login'];
				$data['email'] = $user['email'];
				$data['comment'] = $user['organization'].' '.$user['phones'];
				$data['ip'] = $_SERVER['REMOTE_ADDR'];
				$this->mdanswers->insert_record($data);
				$this->session->set_userdata('msgs','Запись создана успешно.');
				redirect($this->uri->uri_string());
			endif;
		endif;
		
		$pagevar['pages'] = $this->pagination('forum',3,$this->mdquestions->count_all_records('questions'),10);
		$pagevar['answers'] = $this->mdanswers->read_records_by_questions($pagevar['questions']);
		for($i=0;$i<count($pagevar['questions']);$i++):
			$pagevar['questions'][$i]['date'] = $this->operation_date_on_time($pagevar['questions'][$i]['date']);
		endfor;
		for($i=0;$i<count($pagevar['answers']);$i++):
			$pagevar['answers'][$i]['date'] = $this->operation_date_on_time($pagevar['answers'][$i]['date']);
		endfor;
		
		$this->load->view("users_interface/forum",$pagevar);
	}
	
	public function logoff(){
		
		$this->session->sess_destroy();
		redirect('');
	}
	
	public function login(){
		
		$statusval = array('status'=>FALSE,'message'=>'Авторизация невозможна','newlink'=>'');
		$data = trim($this->input->post('postdata'));
		if(!$data):
			show_404();
		endif;
		$data = preg_split("/&/",$data);
		for($i=0;$i<count($data);$i++):
			$dataid = preg_split("/=/",$data[$i]);
			$dataval[$i] = $dataid[1];
		endfor;
		if($dataval):
			$user = $this->mdusers->auth_user($dataval[0],$dataval[1]);
			if($user):
				$statusval['status'] = TRUE;
				$statusval['message'] = '';
				$session_data = array('logon'=>md5($user['login']),'userid'=>$user['id']);
				$this->session->set_userdata($session_data);
				if($user['id']):
					$statusval['newlink'] = '<a id="action-cabinet" href="'.base_url().'cabinet/orders">Личный кабинет</a>';
				else:
					$statusval['newlink'] = '<a id="action-cabinet" href="'.base_url().'admin-panel/actions/orders">Личный кабинет</a>';
				endif;
			endif;
		endif;
		echo json_encode($statusval);
	}
}