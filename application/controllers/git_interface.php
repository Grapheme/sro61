<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Git_interface extends MY_Controller {
	
	function __construct(){
		
		parent::__construct();
	}
	
	public function gitDeployProject(){
		
		if($this->uri->segment(3) == '271a10b478a7027c5e11f2d049859203'):
			$config['test_mode'] = TRUE;
		else:
			$config['test_mode'] = FALSE;
		endif;
		$config['post_data'] = $this->input->post('payload');
		$config['git_path'] = '/usr/local/bin/';
		$config['remote'] = 'origin';
		$config['branch'] = $this->uri->segment(2);
		$config['repository_name'] = 'sro61';
		$config['repository_id'] = 2532862;
		$config['user_group'] = 'rikardo';
		$config['user_name'] = 'rikardo';
		$config['set_log'] = FALSE;
		
		$this->load->library('git');
		$this->git->init($config);
		
		if($this->uri->segment(3) == 'test'):
			echo $this->git->testConnect('/usr/bin/ssh -T git@github.com');
		else:
			echo $this->git->execute('git reset --hard HEAD');
			echo "\n";
			echo $this->git->pull();
			echo "\n";
			echo $this->git->setAccessMode();
			echo "\n";
			echo $this->git->setAccessMode('/docs','0777');
		endif;
	}
}