<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_interface extends MY_Controller {
	
	function __construct(){
		
		parent::__construct();
		if(!$this->loginstatus || $this->user['uid']):
			redirect('');
		endif;
	}
	
	public function control_panel(){
		
		$pagevar = array(
					'baseurl' 		=> base_url(),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$this->load->view("admin_interface/control-panel",$pagevar);
	}

	/***************************************** register **********************************************************/
	
	public function register(){
		
		$from = intval($this->uri->segment(5));
		$pagevar = array(
			'baseurl' 		=> base_url(),
			'register'		=> array(),
			'pages'			=> array(),
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->session->userdata('query_string')):
			$pagevar['register'] = $this->mdregister->query_execute($this->session->userdata('query_string'),"LIMIT $from,10");
			$pagevar['pages'] = $this->pagination('admin-panel/actions/register',5,count($this->mdregister->query_execute($this->session->userdata('query_string'))),10);
		else:
			$pagevar['register'] = $this->mdregister->read_limit_records(10,$from,'register','number','ASC');
			$pagevar['pages'] = $this->pagination('admin-panel/actions/register',5,$this->mdregister->count_all_records('register'),10);
		endif;
		if($this->input->post('scsubmit')):
			unset($_POST['scsubmit']);
			$post = $this->input->post();
			$result = array();
			$conclusion = "AND register.conclusion != ''";
			if(!isset($post['expert'])):
				$conclusion = '';
				$post['expert'] = 0;
			endif;
			$query = "SELECT * FROM register WHERE TRUE $conclusion ORDER BY register.number";
			if(!empty($post['srinn'])):
				$query = "SELECT * FROM register WHERE inn = '".trim($post['srinn'])."' ".$conclusion.' ORDER BY register.number';
				$result = $this->mdregister->query_execute($query);
			else:
				$organization = $this->mdorganization->read_finding_data($post['sroid'],$post['srorgvalue'],'title','id','organization');
				if($organization):
					$org_id = $organization[0]['id'];
					$adding = '';
					if($post['srcid'] && !empty($post['srcusvalue'])):
						$adding = "AND (id =".$post['srcid']." OR customer = '".$post['srcusvalue']."')";
					elseif(!empty($post['srcusvalue'])):
						$adding = "AND customer = '".$post['srcusvalue']."'";
					endif;
					$query = "SELECT * FROM register WHERE organization = $org_id $adding $conclusion ORDER BY register.number";
					$result = $this->mdregister->query_execute($query);
				else:
					$result = $this->mdregister->read_finding_data($post['srcid'],$post['srcusvalue'],'customer','*','register');
					$query = $this->mdregister->search_query($post['srcid'],$post['srcusvalue']);
				endif;
			endif;
			$pagevar['register'] = $result;
			$this->session->set_userdata('query_string',$query);
			redirect('admin-panel/actions/register');
		endif;
		
		$this->session->set_userdata('backpath',$pagevar['baseurl'].$this->uri->uri_string());
		$this->load->view("admin_interface/register/register",$pagevar);
	}
	
	public function full_register_list(){
	
		$this->session->unset_userdata('query_string');
		redirect('admin-panel/actions/register');
	}
	
	public function print_covering_letter(){
		
		$pagevar = array(
					'baseurl' 		=> base_url(),
					'passport'		=> $this->mdregister->read_record($this->uri->segment(6),'register'),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$pagevar['passport']['member'] = $this->mdorganization->read_field($pagevar['passport']['organization'],'organization','title');
		$this->load->view("admin_interface/register/print-covering-letter",$pagevar);
	}
	
	public function downloadCoveringLetter(){
		
		$this->load->library('parser');
		$passport = $this->mdregister->read_record($this->uri->segment(6),'register');
		$passport['member'] = $this->mdorganization->read_field($passport['organization'],'organization','title');
		$parser_data = array(
			'number' => $passport['number'],
			'customer' => $passport['customer'],
			'inn' => $passport['inn'],
			'address' => $passport['address'],
			'member' => $passport['member'],
		);
		$page_content = $this->parser->parse('admin_interface/register/pdf-covering-letter',$parser_data,TRUE);
		include(getcwd().'/mpdf/mpdf.php');
		$mpdf = new mPDF('utf-8','A4','10','',10,10,7,7,10,10);
		$mpdf->SetDisplayMode('fullpage');
		$authorized = file_get_contents(getcwd().'/css/export.css');
		$mpdf->WriteHTML($authorized,1);
		$mpdf->WriteHTML($page_content);
		$filename = $this->translite($passport['number']).'.pdf';
		$filePath = getcwd().'/docs/passports/'.$filename;
		$mpdf->Output($filePath,'F');
		
		header('Pragma: public');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime($filePath)).' GMT');
		header('Cache-Control: private',false);
		header('Content-Type: application/pdf');
		header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
		header('Content-Transfer-Encoding: binary');
		header('Content-Length: '.filesize($filePath));
		header('Connection: close');
		readfile($filePath);
		exit();
		
		/*$this->load->helper('download');
		$fileData = file_get_contents($filePath);
		force_download($filename,$fileData);*/
	}
	
	public function print_sample_notice(){
		
		$pagevar = array(
					'baseurl' 		=> base_url(),
					'passport'		=> $this->mdregister->read_record($this->uri->segment(6),'register'),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		$pagevar['passport']['member'] = $this->mdorganization->read_field($pagevar['passport']['organization'],'organization','title');
		$this->load->view("admin_interface/register/print-sample-notice",$pagevar);
	}
	
	public function add_register(){
		
		$pagevar = array(
			'baseurl' 		=> base_url(),
			'expert'		=> $this->mdorganization->read_experts(),
			'organization'	=> $this->mdorganization->read_organization(),
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('submit')):
			unset($_POST['submit']);
			$this->form_validation->set_rules('number',' ','trim');
			$this->form_validation->set_rules('expert',' ','required|trim');
			$this->form_validation->set_rules('conclusion',' ','trim');
			$this->form_validation->set_rules('register',' ','trim');
			$this->form_validation->set_rules('transfer',' ','trim');
			$this->form_validation->set_rules('organization',' ','required|trim');
			$this->form_validation->set_rules('customer',' ','required|trim');
			$this->form_validation->set_rules('survey',' ','trim');
			$this->form_validation->set_rules('solution',' ','trim');
			$this->form_validation->set_rules('availability',' ','trim');
			$this->form_validation->set_rules('corrections',' ','trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Неверно заполены необходимые поля<br/>');
				$this->add_register();
				return FALSE;
			else:
				$data = $this->input->post();
				if(!isset($data['retested'])):
					$data['retested'] = 0;
				endif;
				$nextnumber = $this->mdorganization->read_field($data['organization'],'organization','docnumber');
				if(empty($data['number'])):
					$data['number'] = 'СРО-Э-101-'.str_pad($data['organization'],3,"0",STR_PAD_LEFT).'-'.str_pad($nextnumber,4,"0",STR_PAD_LEFT);
					$this->mdorganization->update_field($data['organization'],'docnumber',$nextnumber+1,'organization');
				endif;
				if(isset($data['double'])):
					$this->mdregister->insert_record($data);
					$this->session->set_userdata('msgs','Паспорт создан успешно.<br/>Номер паспорта: '.$data['number']);
					redirect($this->uri->uri_string());
				else:
					$data['double'] = 0;
				endif;
				if(!$this->input->post('retested') && ($record = $this->mdregister->record_exist('register','inn',$data['inn']))):
					$data['inn'] = '';
					$passport = $this->mdregister->read_field($record,'register','customer');
					$this->session->set_userdata('msgr',"Внимание. Паспорт создан но ИНН пренадлежит: $passport.<br/>Измените данные паспорта.");
					$id = $this->mdregister->insert_record($data);
					redirect('admin-panel/actions/register/edit/id/'.$id);
				else:
					$this->mdregister->insert_record($data);
					$this->session->set_userdata('msgs','Паспорт создан успешно.<br/>Номер паспорта: '.$data['number']);
					redirect($this->uri->uri_string());
				endif;
			endif;
		endif;
		
		$this->load->view("admin_interface/register/register-add",$pagevar);
	}
	
	public function edit_register(){
		
		$pagevar = array(
			'baseurl' 		=> base_url(),
			'passport'		=> $this->mdregister->read_record($this->uri->segment(6),'register'),
			'expert'		=> $this->mdorganization->read_experts(),
			'organization'	=> $this->mdorganization->read_organization(),
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr')
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('submit')):
			unset($_POST['submit']);
			$this->form_validation->set_rules('number',' ','required|trim');
			$this->form_validation->set_rules('expert',' ','required|trim');
			$this->form_validation->set_rules('conclusion',' ','trim');
			$this->form_validation->set_rules('register',' ','trim');
			$this->form_validation->set_rules('transfer',' ','trim');
			$this->form_validation->set_rules('organization',' ','required|trim');
			$this->form_validation->set_rules('customer',' ','required|trim');
			$this->form_validation->set_rules('survey',' ','trim');
			$this->form_validation->set_rules('solution',' ','trim');
			$this->form_validation->set_rules('availability',' ','trim');
			$this->form_validation->set_rules('corrections',' ','trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Неверно заполены необходимые поля<br/>');
				redirect($this->uri->uri_string());
			else:
				$data = $this->input->post();
				if(!isset($data['retested'])):
					$data['retested'] = 0;
				endif;
				if(isset($data['double'])):
					$this->mdregister->update_record($this->uri->segment(6),$data);
					$this->session->set_userdata('msgs','Запись сохранена успешно.');
					redirect($this->session->userdata('backpath'));
				else:
					$data['double'] = 0;
				endif;
				$record = $this->mdregister->record_exist('register','inn',$data['inn']);
				if(!$this->input->post('retested') && $record != $this->uri->segment(6) && !empty($record) && !empty($data['inn'])):
					$data['inn'] = '';
					$passport = $this->mdregister->read_field($record,'register','customer');
					$this->session->set_userdata('msgr',"Внимание. Паспорт сохранен но ИНН пренадлежит: $passport.<br/>Измените данные паспорта.");
					$this->mdregister->update_record($this->uri->segment(6),$data);
					redirect($this->uri->uri_string());
				else:
					$this->mdregister->update_record($this->uri->segment(6),$data);
					$this->session->set_userdata('msgs','Запись сохранена успешно.');
					redirect($this->session->userdata('backpath'));
				endif;
			endif;
		endif;
		
		$this->load->view("admin_interface/register/register-edit",$pagevar);
	}
	
	public function search_register(){
		
		$statusval = array('status'=>FALSE,'retvalue'=>'');
		$search = $this->input->post('squery');
		$searchfield = $this->input->post('searchfield');
		if(!$search || !$searchfield) show_404();
		$passports = array();
		switch($searchfield):
			case 'customer':
				$result = $this->mdregister->search_data($search,'customer','id,customer','register');
				for($i=0;$i<count($result);$i++):
					$passports[$i]['id'] = $result[$i]['id'];
					$passports[$i]['title'] = $result[$i]['customer'];
				endfor;
				break;
			case 'organization':
				$passports = $this->mdregister->search_data($search,'title','id,title','organization','AND type = 1');
				break;
			default: show_404();
				break;
		endswitch;
		if($passports):
			$statusval['retvalue'] = '<ul>';
			for($i=0;$i<count($passports);$i++):
				$statusval['retvalue'] .= '<li class="resli" data-resid="'.$passports[$i]['id'].'">'.$passports[$i]['title'].'</li>';
			endfor;
			$statusval['retvalue'] .= '</ul>';
			$statusval['status'] = TRUE;
		endif;
		echo json_encode($statusval);
	}
	
	public function delete_register(){
		
		$id = $this->uri->segment(6);
		if($id):
			$register = $this->mdregister->read_record($id,'register');
			$pattern = "/(СРО-Э-101)(-)(\d+)(-)(\d+)/";
			$replacement = "\$5";
			$nexNumber = 1+(int)preg_replace($pattern,$replacement,$register['number']);
			$curDocumentNumber = $this->mdorganization->read_field($register['organization'],'organization','docnumber');
			$result = $this->mdregister->delete_record($id,'register');
			if($result):
				if($nexNumber == $curDocumentNumber):
					$this->mdorganization->update_field($register['organization'],'docnumber',$curDocumentNumber-1,'organization');
				endif;
				$countRegister = $this->mdregister->countRecordsByOrganization($register['organization']);
				if(!$countRegister):
					$this->mdorganization->update_field($register['organization'],'docnumber',1,'organization');
				endif;
			endif;
			$this->session->set_userdata('msgs','Паспорт удален успешно.');
			redirect($this->session->userdata('backpath'));
		else:
			show_404();
		endif;
	}
	
	public function import_csv(){
		
		$registers = $this->mdregister->read_records('register');
		$organizations = $this->mdorganization->read_records('organization');
		$company = array();
		foreach($organizations as $key => $value):
			$company[$value['id']] = $value;
		endforeach;
		$organizations = $company;
		$file_name = getcwd().'/docs/tmp/passports.tmp';
		$fp = fopen($file_name,'w');
		$this->load->helper('download');
		$mass[0] = array(
			'id'=>mb_convert_encoding('№ п/п','Windows-1251','utf-8'),
			'number'=>mb_convert_encoding('Номер энергопаспорта','Windows-1251','utf-8'),
			'expert'=>mb_convert_encoding('Экспертная орган','Windows-1251','utf-8'),
			'conclusion'=>mb_convert_encoding('Дата заключения','Windows-1251','utf-8'),
			'register'=>mb_convert_encoding('Дата регистрации','Windows-1251','utf-8'),
			'survey'=>mb_convert_encoding('Вид обследования','Windows-1251','utf-8'),
			'transfer'=>mb_convert_encoding('Дата передачи','Windows-1251','utf-8'),
			'inn'=>mb_convert_encoding('ИНН','Windows-1251','utf-8'),
			'organization'=>mb_convert_encoding('Член СРО','Windows-1251','utf-8'),
			'customer'=>mb_convert_encoding('Заказчик','Windows-1251','utf-8'),
			'address'=>mb_convert_encoding('Юридический адрес','Windows-1251','utf-8'),
			'solution'=>mb_convert_encoding('Решение Минэнерго','Windows-1251','utf-8'),
			'availability'=>mb_convert_encoding('Наличие','Windows-1251','utf-8'),
			'corrections'=>mb_convert_encoding('Направление в Минэнерго после исправления замечаний в случае обнаружения таковых','Windows-1251','utf-8')
		);
		for($i=0;$i<count($registers);$i++):
			$mass[$i+1]['id'] = $i+1;
			$mass[$i+1]['number'] = mb_convert_encoding($registers[$i]['number'],'Windows-1251','utf-8');
			$mass[$i+1]['expert'] = mb_convert_encoding($organizations[$registers[$i]['expert']]['title'],'Windows-1251','utf-8');
			$mass[$i+1]['conclusion'] = mb_convert_encoding($this->operation_dot_date($registers[$i]['conclusion']),'Windows-1251','utf-8');
			$mass[$i+1]['register'] = mb_convert_encoding($this->operation_dot_date($registers[$i]['register']),'Windows-1251','utf-8');
			$mass[$i+1]['survey'] = mb_convert_encoding($registers[$i]['survey'],'Windows-1251','utf-8');
			$mass[$i+1]['transfer'] = mb_convert_encoding($this->operation_dot_date($registers[$i]['transfer']),'Windows-1251','utf-8');;
			$mass[$i+1]['inn'] = mb_convert_encoding($registers[$i]['inn'],'Windows-1251','utf-8');
			$mass[$i+1]['organization'] = mb_convert_encoding($organizations[$registers[$i]['organization']]['title'],'Windows-1251','utf-8');;
			$mass[$i+1]['customer'] = mb_convert_encoding($registers[$i]['customer'],'Windows-1251','utf-8');
			$mass[$i+1]['address'] = mb_convert_encoding($registers[$i]['address'],'Windows-1251','utf-8');
			$mass[$i+1]['solution'] = mb_convert_encoding($registers[$i]['solution'],'Windows-1251','utf-8');
			$mass[$i+1]['availability'] = mb_convert_encoding($registers[$i]['availability'],'Windows-1251','utf-8');
			$mass[$i+1]['corrections'] = mb_convert_encoding($registers[$i]['corrections'],'Windows-1251','utf-8');
		endfor;
		foreach($mass AS $mas):
			fputcsv($fp,$mas,';');
		endforeach;
		fclose($fp);
		$fdata = file_get_contents($file_name);
		unlink($file_name);
		if($fdata && $file_name):
			force_download('passports.csv',$fdata);
		endif;
	}
	
	public function returnRegister(){
		
		$pagevar = array(
			'baseurl' => base_url(),
		);
		$this->load->view("admin_interface/register/returns",$pagevar);
	}

	public function EPRegisterME(){
		
		$pagevar = array(
			'baseurl' => base_url(),
		);
		$this->load->view("admin_interface/register/ep-register-me",$pagevar);
	}
	
	/******************************************* orders **********************************************************/
	
	public function available_orders(){
		
		$from = intval($this->uri->segment(5));
		$pagevar = array(
					'baseurl' 		=> base_url(),
					'orders'		=> $this->mdorders->read_limit_records(10,$from,'orders','id','DESC'),
					'pages'			=> array(),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$pagevar['pages'] = $this->pagination('admin-panel/actions/orders',5,$this->mdorders->count_all_records('orders'),10);
		
		for($i=0;$i<count($pagevar['orders']);$i++):
			$pagevar['orders'][$i]['date'] = $this->operation_date_on_time($pagevar['orders'][$i]['date']);
		endfor;
		$this->session->set_userdata('backpath',$pagevar['baseurl'].$this->uri->uri_string());
		$this->load->view("admin_interface/available-orders",$pagevar);
	}
	
	public function delete_order(){
		
		$id = $this->uri->segment(6);
		if($id):
			$result = $this->mdorders->delete_record($id,'orders');
			$this->session->set_userdata('msgs','Заявка удалена успешно.');
			redirect($this->session->userdata('backpath'));
		else:
			show_404();
		endif;
	}
	
	public function closed_order(){
		
		$id = $this->uri->segment(6);
		if($id):
			$this->mdorders->update_field($id,'closed',1,'orders');
			$this->session->set_userdata('msgs','Заявка закрыта.');
			redirect($this->session->userdata('backpath'));
		else:
			show_404();
		endif;
	}
	
	/******************************************* forum **********************************************************/
	
	public function forum(){
		
		$from = intval($this->uri->segment(5));
		$pagevar = array(
					'baseurl' 		=> base_url(),
					'questions'		=> $this->mdquestions->read_limit_records(10,$from,'questions','id','DESC'),
					'answers'		=> array(),
					'pages'			=> array(),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$pagevar['pages'] = $this->pagination('admin-panel/actions/forum',5,$this->mdquestions->count_all_records('questions'),10);
		$pagevar['answers'] = $this->mdanswers->read_records_by_questions($pagevar['questions']);
		
		for($i=0;$i<count($pagevar['questions']);$i++):
			$pagevar['questions'][$i]['date'] = $this->operation_date_on_time($pagevar['questions'][$i]['date']);
		endfor;
		for($i=0;$i<count($pagevar['answers']);$i++):
			$pagevar['answers'][$i]['date'] = $this->operation_date_on_time($pagevar['answers'][$i]['date']);
		endfor;
		$this->session->set_userdata('backpath',$pagevar['baseurl'].$this->uri->uri_string());
		$this->load->view("admin_interface/forum",$pagevar);
	}
	
	public function save_forum_text(){
		
		$statusval = array('status'=>FALSE,'retvalue'=>'');
		$text = $this->input->post('text');
		$type = $this->input->post('type');
		$id = $this->input->post('id');
		if(!$text || !$type || !$id):
			show_404();
		endif;
		$model = 'md'.$type;
		$result = $this->$model->update_field($id,'text',$text,$type);
		if($result):
			$statusval['status'] = TRUE;
		endif;
		echo json_encode($statusval);
	}
	
	public function delete_question(){
		
		$id = $this->uri->segment(6);
		if($id):
			$result = $this->mdquestions->delete_record($id,'questions');
			if($result):
				$this->mdanswers->delete_records($id);
			endif;
			$this->session->set_userdata('msgs','Запись удалена успешно.');
			redirect($this->session->userdata('backpath'));
		else:
			show_404();
		endif;
	}
	
	public function delete_answer(){
		
		$id = $this->uri->segment(6);
		if($id):
			$result = $this->mdanswers->delete_record($id,'answers');
			$this->session->set_userdata('msgs','Запись удалена успешно.');
			redirect($this->session->userdata('backpath'));
		else:
			show_404();
		endif;
	}
	
	/******************************************** news **********************************************************/
	
	public function news(){
		
		$from = intval($this->uri->segment(5));
		$pagevar = array(
					'baseurl' 		=> base_url(),
					'news'			=> $this->mdnews->read_limit_records(10,$from,'news','id','DESC'),
					'pages'			=> array(),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$pagevar['pages'] = $this->pagination('admin-panel/actions/news',5,$this->mdnews->count_all_records('news'),10);
		
		for($i=0;$i<count($pagevar['news']);$i++):
			$pagevar['news'][$i]['date'] = $this->operation_dot_date($pagevar['news'][$i]['date']);
		endfor;
		$this->session->set_userdata('backpath',$pagevar['baseurl'].$this->uri->uri_string());
		$this->load->view("admin_interface/news/list-news",$pagevar);
	}
	
	public function add_new(){
		
		$pagevar = array(
			'baseurl'		=> base_url(),
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr'),
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('submit')):
			unset($_POST['submit']);
			$this->form_validation->set_rules('title',' ','required|trim');
			$this->form_validation->set_rules('small_title',' ','required|trim');
			$this->form_validation->set_rules('text',' ','required|trim');
			$this->form_validation->set_rules('small_text',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Неверно заполены необходимые поля<br/>');
				$this->add_new();
				return FALSE;
			else:
				$data = $this->input->post();
				$data['text'] = nl2br($_POST['text']);
				if($_FILES['image']['error'] != 4):
					$data['image'] = file_get_contents($_FILES['image']['tmp_name']);
				else:
					$data['image'] = FALSE;
				endif;
				$translit = $this->translite($data['small_title']);
				$result = $this->mdnews->insert_record($data,$translit);
				if($result):
					$this->session->set_userdata('msgs','Запись создана успешно.');
				endif;
				redirect($this->uri->uri_string());
			endif;
		endif;
		
		$this->load->view("admin_interface/news/add-news",$pagevar);
	}
	
	public function edit_news(){
		
		$nid = $this->uri->segment(6);
		$pagevar = array(
			'baseurl'		=> base_url(),
			'news'			=> $this->mdnews->read_record($nid,'news'),
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr'),
		);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('submit')):
			unset($_POST['submit']);
			$this->form_validation->set_rules('title',' ','required|trim');
			$this->form_validation->set_rules('small_title',' ','required|trim');
			$this->form_validation->set_rules('text',' ','required|trim');
			$this->form_validation->set_rules('small_text',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Неверно заполены необходимые поля<br/>');
				$this->edit_news();
				return FALSE;
			else:
				$data = $this->input->post();
				$data['text'] = nl2br($_POST['text']);
				if($_FILES['image']['error'] != 4):
					$data['image'] = file_get_contents($_FILES['image']['tmp_name']);
				endif;
				if(isset($data['noimage'])):
					$noimage = 1;
				else:
					$noimage = 0;
				endif;
				$translit = $this->translite($data['small_title']);
				$result = $this->mdnews->update_record($nid,$data,$translit,$noimage);
				if($result):
					$this->session->set_userdata('msgs','Запись сохранена успешно.');
				endif;
				redirect($this->session->userdata('backpath'));
			endif;
		endif;
		$pagevar['news'] = preg_replace('/(\<br \/\>)+/','',$pagevar['news']);
		$this->load->view("admin_interface/news/edit-news",$pagevar);
	}
	
	public function delete_news(){
		
		$nid = $this->uri->segment(6);
		if($nid):
			$result = $this->mdnews->delete_record($nid,'news');
			if($result):
				$this->session->set_userdata('msgs','Запись удалена успешно.');
			else:
				$this->session->set_userdata('msgr','Запись не удалена.');
			endif;
			redirect($this->session->userdata('backpath'));
		else:
			show_404();
		endif;
	}
	
	/******************************************* users **********************************************************/
	
	public function actions_users(){
		
		$from = intval($this->uri->segment(5));
		$pagevar = array(
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'users'			=> $this->mdusers->read_limit_records(10,$from,'users','org_id','ASC'),
					'pages'			=> array(),
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$pagevar['pages'] = $this->pagination('admin-panel/actions/users',5,$this->mdusers->count_all_records('users'),10);
		
		for($i=0;$i<count($pagevar['users']);$i++):
			$pagevar['users'][$i]['password'] = $this->encrypt->decode($pagevar['users'][$i]['cryptpassword']);
		endfor;
		
		$this->session->set_userdata('backpath',$pagevar['baseurl'].$this->uri->uri_string());
		$this->load->view("admin_interface/users/users",$pagevar);
	}
	
	public function user_add(){
		
		$pagevar = array(
					'baseurl' 		=> base_url(),
					'userinfo'		=> $this->user,
					'msgs'			=> $this->session->userdata('msgs'),
					'msgr'			=> $this->session->userdata('msgr')
			);
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		if($this->input->post('submit')):
			unset($_POST['submit']);
			$this->form_validation->set_rules('id',' ','required|trim');
			$this->form_validation->set_rules('organization',' ','required|trim|xss_clean');
			$this->form_validation->set_rules('title',' ','required|trim|xss_clean');
			$this->form_validation->set_rules('status',' ','trim|xss_clean');
			$this->form_validation->set_rules('grn',' ','required|trim');
			$this->form_validation->set_rules('inn',' ','required|trim');
			$this->form_validation->set_rules('number',' ','required|trim');
			$this->form_validation->set_rules('address',' ','required|trim');
			$this->form_validation->set_rules('phones',' ','trim');
			$this->form_validation->set_rules('email',' ','required|trim');
			$this->form_validation->set_rules('login',' ','required|trim');
			$this->form_validation->set_rules('password',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Неверно заполены необходимые поля<br/>');
				$this->user_add();
				return FALSE;
			else:
				$insert = $this->input->post();
				if($this->mdorganization->record_exist('organization','id',$insert['id'])):
					$this->session->set_userdata('msgr','Номер организации занят. Повторите ввод!');
					redirect($this->uri->uri_string());
				endif;
				if($insert['class']):
					$this->mdorganization->insert_record($insert['id'],$insert['title'],$insert['class']);
					$this->mdusers->insert_record($insert);
				else:
					$this->mdorganization->insert_record($insert['id'],$insert['title'],$insert['class']);
				endif;
				$this->session->set_userdata('msgs','Запись создана успешно.');
				redirect($this->uri->uri_string());
			endif;
		endif;
		
		$this->load->view("admin_interface/users/user-add",$pagevar);
	}
	
	public function user_edit(){
		
		$pagevar = array(
			'baseurl' 		=> base_url(),
			'userinfo'		=> $this->user,
			'user'			=> $this->mdusers->read_record($this->uri->segment(6),'users'),
			'msgs'			=> $this->session->userdata('msgs'),
			'msgr'			=> $this->session->userdata('msgr')
		);
		$pagevar['user']['document'] = 0;
		if($organization = $this->mdorganization->read_record($pagevar['user']['org_id'],'organization')):
			if($organization['type'] == 1):
				$pagevar['user']['document'] = $organization['docnumber'];
			endif;
		endif;
		$this->session->unset_userdata('msgs');
		$this->session->unset_userdata('msgr');
		
		$pagevar['user']['title'] = $this->mdorganization->read_field($pagevar['user']['org_id'],'organization','title');
		
		if($this->input->post('submit')):
			unset($_POST['submit']);
			$this->form_validation->set_rules('orgid',' ','required|trim|xss_clean');
			$this->form_validation->set_rules('organization',' ','required|trim|xss_clean');
			$this->form_validation->set_rules('title',' ','required|trim|xss_clean');
			$this->form_validation->set_rules('grn',' ','required|trim');
			$this->form_validation->set_rules('inn',' ','required|trim');
			$this->form_validation->set_rules('number',' ','required|trim');
			$this->form_validation->set_rules('address',' ','required|trim');
			$this->form_validation->set_rules('phones',' ','trim');
			$this->form_validation->set_rules('login',' ','required|trim');
			$this->form_validation->set_rules('password',' ','required|trim');
			if(!$this->form_validation->run()):
				$this->session->set_userdata('msgr','Ошибка. Неверно заполены необходимые поля<br/>');
				$this->user_edit();
				return FALSE;
			else:
				$this->mdusers->update_record($this->uri->segment(6),$_POST);
				$this->mdorganization->update_field($pagevar['user']['org_id'],'docnumber',$_POST['document'],'organization');
				if($pagevar['user']['org_id']):
					$this->mdorganization->update_field($pagevar['user']['org_id'],'title',$_POST['title'],'organization');
				endif;
				$this->session->set_userdata('msgs','Запись сохранена успешно.');
				if(!$this->mdusers->record_exist('users','org_id',$_POST['orgid'])):
					$this->mdusers->update_field($this->uri->segment(6),'org_id',$_POST['orgid'],'users');
					$this->mdorganization->update_field($pagevar['user']['org_id'],'id',$_POST['orgid'],'organization');
				elseif($pagevar['user']['org_id'] != $_POST['orgid']):
					$this->session->set_userdata('msgr','Запись сохранена. Но номер организации уже cуществует!');
				endif;
				redirect($this->session->userdata('backpath'));
			endif;
		endif;
		$pagevar['user']['pass'] = $this->encrypt->decode($pagevar['user']['cryptpassword']);
		$this->load->view("admin_interface/users/user-edit",$pagevar);
	}
	
	public function user_delete(){
		
		$id = $this->uri->segment(6);
		if($id):
			$result = $this->mdusers->delete_record($id,'users');
			$this->session->set_userdata('msgs','Пользователь удален успешно.');
			redirect($this->session->userdata('backpath'));
		else:
			show_404();
		endif;
	}
	
}