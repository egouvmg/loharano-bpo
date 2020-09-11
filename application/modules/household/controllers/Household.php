<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Household extends Admin_Controller
{
	public function __construct(){
		parent::__construct();

		$this->load->model('household_model','household');
		$this->load->model('admin/admin_model','admin');
		$this->load->model('company/company_model','company');
		$this->load->model('territory/province_model', 'province');
		$this->load->model('territory/region_model', 'region');
		$this->load->model('territory/district_model', 'district');
		$this->load->model('territory/common_model', 'common');
		$this->load->model('territory/fokontany_model', 'fokontany');
		$this->load->model('job/job_model', 'job');

		$this->lang->load('operator', $this->session->site_lang);
	}

	public function index()
	{	
        $this->data['provinces'] = $this->province->get_all();
        $this->data['regions'] = $this->region->get_all(['province_id' => $this->data['provinces'][0]->id]);
        $this->data['districts'] = $this->district->get_all(['region_id' => $this->data['regions'][0]->id]);
        $this->data['commons'] = $this->common->get_all(['district_id' => $this->data['districts'][0]->id]);
		$this->data['fokontanies'] = $this->fokontany->get_all(['common_id' => $this->data['commons'][0]->id]);
		
		$this->data['jobs'] = $this->job->get_all();

		$this->load->view('index', $this->data);	
	}

	public function duplicate()
	{	
		$this->data['jobs'] = $this->job->get_all();

		$this->load->view('duplicate', $this->data);	
	}

	public function get_duplicate()
	{
        if (!$this->input->is_ajax_request()) {
            exit('Very ianao :O');
		}
		
		$persons =  $this->household->duplicate();

		echo json_encode($persons);	
	}

	public function get_same_perons()
	{
        if (!$this->input->is_ajax_request()) {
            exit('Very ianao :O');
		}
		
		$criteria = $this->input->get('criteria');

		$persons =  $this->household->get_all(['TRIM(LOWER(CONCAT(last_name, first_name, birth, birth_place, mother))) = ' => $criteria]);

		echo json_encode($persons);	
	}
	
	public function people_list()
	{
        if (!$this->input->is_ajax_request()) {
            exit('Very ianao :O');
		}
		
		$fokontany_id = $this->input->post('fokontany_id');
		$list = [];

		if(!empty($fokontany_id))
			$list = $this->household->get_all(['fokontany_id'=>$fokontany_id]);
		
		echo json_encode($list);
	}

	public function fokontany_people()
	{
        if (!$this->input->is_ajax_request()) {
            exit('Very ianao :O');
		}

		$fokontany_id = $this->input->get('fokontany_id');

		if(!empty($fokontany_id)){
			$fk = $this->fokontany->person_treaty_by_fokontany(['fokontany_id'=>$fokontany_id]);
			if($fk)
				echo json_encode(['success' => 1, 'fokontany' => $fk]);
			else echo json_encode(['error' => 1, 'people' => 0]);
		}
		else echo json_encode(['error' => 1, 'people' => 0]);
	}
}
