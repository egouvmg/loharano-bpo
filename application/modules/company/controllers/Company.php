<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CompanyAdmin_Controller
{
	public function __construct(){
		parent::__construct();

		$this->load->model('company_model','company');
		$this->load->model('territory/fokontany_model','fokontany');
		$this->load->model('household/household_model','household');
		$this->load->model('person/person_model','person');
		$this->load->model('job/job_model', 'job');

		$this->lang->load('operator', $this->session->site_lang);
	}

	public function index()
	{
		$company_details = $this->company->get_user_company($this->session->user_id);
		$number_fokontany_done = 0;

		$fokontany_id_list = $this->company->get_allIdFokontanyCompany($company_details->id);
		if(!empty($fokontany_id_list)){
			foreach($fokontany_id_list as $value){
				$number_register_fokontany = $this->company->get_register_fokontany($value->fokontany_id);
				$number_register_treated_fokontany = $this->company->count_register_treated_fokontany($value->fokontany_id);
				
				if($number_register_treated_fokontany >= $number_register_fokontany){
					$number_fokontany_done += 1; 
				}
			}
		}
		$this->data['number_fokontany_done'] = $number_fokontany_done;

		//Fokontany/Registre/Personnes à traiter
		$this->data['start_company'] = $this->company->get_start_company(['company_id' => $company_details->id]);
		
		//Fokontany/Registre/Personnes traité
		$this->data['done_company'] = $this->company->get_done_company(['company_id' => $company_details->id]);
		
		$fk_rg = $this->company->countCompanyFokontanyRegister(['company_id' => $company_details->id]);

		if(!empty($fk_rg)){
			$treaty_registers = 0;
			$start_register = 0;

			$this->data['total_drf'] = $this->company->total_ddr(['company_id' => $company_details->id, 'day_done <=' => $fk_rg[0]->day_done]);

            foreach($this->data['total_drf'] as $key => $drf){
                $_fr = $this->fokontany->get_fokontany_register_one(['fokontany_id' => $drf->fokontany_id]);
				$this->data['total_drf'][$key]->t_register = $_fr->nbr_register;
				
				$treaty_registers += $drf->nbr_register;
			}

			$rate = ($treaty_registers/$this->data['start_company']->nbr_register) * 100;

			$this->data['fr_details'] = [
				'day_done' => $fk_rg[0]->day_done,
				'nbr_fokontany' => $fk_rg[0]->nbr_fokontany,
				'nbr_register' => $fk_rg[0]->nbr_register,
				'treaty_registers' => $treaty_registers,
				'start_register' => $this->data['start_company']->nbr_register,
				'rate' => $rate
			];

			$this->data['firms_registers'] = $this->load->view('firm_register_item', $this->data, TRUE);
		}
		else
			$this->data['firms_registers'] = 'Traitement encours.';

		$this->data['company_details'] = $company_details;

		$this->data['fk_rg'] = $fk_rg;
		$this->data['fk_rg'] = $this->load->view('firm_item', $this->data, TRUE);

		$this->load->view('index', $this->data);
	}

	public function fokontany_register()
	{
		if (!$this->input->is_ajax_request()) {
            exit('Very ianao :O');
        }

        $data = $this->input->post();
		$company_id = $this->input->post('company_id');
		$day_done = $this->input->post('day_done');
		

        if(!empty($data)) {
			$fr_details = $this->company->countCompanyFokontanyRegisterOne($data);
			$start_company = $this->company->get_start_company(['company_id' => $company_id]);

			$this->data['total_drf'] = $this->company->total_ddr(['company_id' => $company_id, 'day_done <=' => $day_done]);

			$treaty_registers = 0;
            
            foreach($this->data['total_drf'] as $key => $drf){
                $_fr = $this->fokontany->get_fokontany_register_one(['fokontany_id' => $drf->fokontany_id]);
				$this->data['total_drf'][$key]->t_register = $_fr->nbr_register;
				
				$treaty_registers += $drf->nbr_register;
			}

			$rate = ($treaty_registers/$start_company->nbr_register) * 100;

			$this->data['fr_details'] = [
				'day_done' => $fr_details->day_done,
				'nbr_fokontany' => $fr_details->nbr_fokontany,
				'nbr_register' => $fr_details->nbr_register,
				'treaty_registers' => $treaty_registers,
				'start_register' => $start_company->nbr_register,
				'rate' => $rate
			];

			$firms_registers = $this->load->view('firm_register_item', $this->data, TRUE);

			echo json_encode(['success' => 1, 'html' => $firms_registers]);
        }
        else
        	echo json_encode(['error'=>1, 'msg'=>'Paramètres non définis.']);
	 }
	 
	public function list_persons()
	{
		$this->data['jobs'] = $this->job->get_all();
		
		$fokontany = $this->fokontany->get_fokontany_user_id();

		$this->data['total_drf'] = $this->company->total_ddr_one(['company_id' => $fokontany[0]->company_id, 'fokontany_id' => $fokontany[0]->fokontany_id]);

		$this->data['fokontany'] = $fokontany;

		$this->load->view('people_list', $this->data);
	}

	public function get_people_fokontany()
	{
        if (!$this->input->is_ajax_request()) {
            exit('Very ianao :O');
		}
		$fokontany_id = $this->input->get('fokontany_id');
		
		$total_drf = $this->company->total_ddr_one(['fokontany_id' => $fokontany_id]);
		
		if($total_drf)
			echo json_encode(['success' => 1, 'total_drf' => $total_drf]);
		else echo json_encode(['success' => 1, 'total_drf' => ['nbr_people' => 0]]); 
	}
	
	public function get_list_persons()
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

	public function check_fields()
	{
        if (!$this->input->is_ajax_request()) {
            exit('Very ianao :O');
		}

		$data = $this->input->post();
		$person_id = $this->input->post('person_id');
		$missing_fields = [];

		if(!empty($data)){
			if($data['address'] == '') $missing_fields[] = 'address';
			if($data['pdf_file'] == '') $missing_fields[] = 'pdf_file';
			if($data['last_name'] == '') $missing_fields[] = 'last_name';
			if($data['birth'] == '') $missing_fields[] = 'birth';
			if($data['birth_place'] == '') $missing_fields[] = 'birth_place';
			if($data['cin'] != ''){
				if($data['cin_place'] == '') $missing_fields[] = 'cin_place';
				if($data['cin_date'] == '') $missing_fields[] = 'cin_date';
			}

			if($data['passport_date'] == "") unset($data['passport_date']);
            
            if($data['nationality'] != "Malgache"){
                $data['cin'] = '';
                $data['cin_date'] = '';
                $data['cin_place'] = '';
            }else{
				$data['passport'] = '';
				unset($data['passport_date']);
				$data['passport_place'] = '';
			}
            if($data['parent_link'] == 'autre')
				$data['parent_link'] = $data['other_pl'];

			if(!empty($missing_fields))
				echo json_encode(['required' => 1, 'missing' => $missing_fields]);
			else{
				unset($data['person_id'], $data['other_pl'], $data['other_job']);

				if($data['cin_date'] == '') unset($data['cin_date']); 

				if($this->person->update($data, $person_id))
					echo json_encode(['success' => 1]);
				else echo json_encode(['error' => 1, 'msg' => 'Modification impossible.']);
			}
		}
		else echo json_encode(['error' => 1, 'msg' => 'Aucune donnée à enregistrer.']);
	}

	public function get_cmp_fokontanyTreaty(){
		if (!$this->input->is_ajax_request()) {
            exit('Very ianao :O');
		}

		$company_details = $this->company->get_user_company($this->session->user_id);
		$list_fokontany_treaty = array();

		$fokontany_id_list = $this->company->get_allIdFokontanyCompany($company_details->id);
		if(!empty($fokontany_id_list)){
			foreach($fokontany_id_list as $value){
				$number_register_fokontany = $this->company->get_register_fokontany($value->fokontany_id);
				$number_register_treated_fokontany = $this->company->count_register_treated_fokontany($value->fokontany_id);
				
				if($number_register_treated_fokontany >= $number_register_fokontany){
					$ftk_treaty = $this->fokontany->get_fokontany_treaty_by_id($value->fokontany_id);
					if(!empty($ftk_treaty))array_push($list_fokontany_treaty, $ftk_treaty[0]);
				}
			}
		}
		echo json_encode($list_fokontany_treaty);
	}

	public function get_cmp_fokontanyNeedTreat(){
		if (!$this->input->is_ajax_request()) {
            exit('Very ianao :O');
		}
		
		$company_details = $this->company->get_user_company($this->session->user_id);
		$list_fokontany_treaty = array();
		$list_fokontany_process = array(); 

		$fokontany_id_list = $this->company->get_allIdFokontanyCompany($company_details->id);
		if(!empty($fokontany_id_list)){
			foreach($fokontany_id_list as $value){
				$number_register_fokontany = $this->company->get_register_fokontany($value->fokontany_id);
				$number_register_treated_fokontany = $this->company->count_register_treated_fokontany($value->fokontany_id);
				
				if($number_register_treated_fokontany < $number_register_fokontany){
					$fkt_affected = $this->fokontany->get_fokontany_treaty_by_id($value->fokontany_id);
					if(!empty($fkt_affected))array_push($list_fokontany_process, $fkt_affected[0]);
				}
			}
		}

		echo json_encode($list_fokontany_process);
		
	}

	public function get_cmp_peopleTreaty(){
		if (!$this->input->is_ajax_request()) {
            exit('Very ianao :O');
		}

		$company_details = $this->company->get_user_company($this->session->user_id);
		$list_peopleTreaty = array();

		$fokontany_id_list = $this->company->get_allIdFokontanyCompany($company_details->id);

		if(!empty($fokontany_id_list)){
			foreach($fokontany_id_list as $value){
				$person_treaty_fkt = $this->person->get_person_treaty_by_fokontany($value->fokontany_id);
				if(!empty($person_treaty_fkt)){
					foreach($person_treaty_fkt as $person){
						if(!empty($person))array_push($list_peopleTreaty, $person);
					}
				}
			}
		}
		echo json_encode($list_peopleTreaty);
	}
    
    public function get_people_treaty_daily()
    {
		if (!$this->input->is_ajax_request()) {
            exit('Very ianao :O');
        }
        
        $day = $this->input->get('day');
        $company_id = $this->input->get('company_id');

        if(empty($day) || empty($company_id))
            echo json_encode(['lol']);
        else{

            $users = $this->ion_auth->users($this->config->item('loharano_operator'))->result();
            $key = array_search($company_id, array_column($users, 'company_id'));
            
            $peopleTreaty = $this->person->get_all(['created_on <=' => $day, 'created_by' => $users[$key]->id]);
            echo json_encode($peopleTreaty);
        }
    }
}
