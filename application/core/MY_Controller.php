<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	public $data;
	
	public function __construct()
	{
		parent::__construct();

		$language = ($this->session->site_lang) ? $this->session->site_lang : $this->config->item('language');
		
		$this->session->set_userdata('site_lang', $language);

		$this->lang->load('auth', $language);

		$this->lang->load('job', 'malagasy');
		$this->lang->load('job', 'french');
	}
}

/**
 * Admin Controller
 */
class Admin_Controller extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		
		if(!$this->ion_auth->is_admin())
			redirect('/', 'refresh');
	}
}

/**
 * Company Controller
 */
class CompanyAdmin_Controller extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$id_company = $this->config->item('loharano_company');
		
		if(!$this->ion_auth->in_group($id_company))
			redirect('/', 'refresh');
		
	}
}

/**
 * Operator Controller
 */
class Operator_Controller extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$id_company = $this->config->item('loharano_operator');
		
		if(!$this->ion_auth->in_group($id_company))
			redirect('/', 'refresh');

			
		$this->lang->load('company', $this->session->site_lang);
		
	}
}

