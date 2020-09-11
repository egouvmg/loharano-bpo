<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Person extends Operator_Controller
{
	public function __construct(){
		parent::__construct();

		$this->load->model('territory/province_model', 'province');
		$this->load->model('territory/region_model', 'region');
		$this->load->model('territory/district_model', 'district');
		$this->load->model('territory/common_model', 'common');
		$this->load->model('territory/fokontany_model', 'fokontany');
		$this->load->model('territory/territory_model', 'territory');
		$this->load->model('job/job_model', 'job');
		$this->load->model('person_model', 'person');
		$this->load->model('company/company_model', 'company');

		$this->lang->load('operator', $this->session->site_lang);
	}

	public function household()
	{
		$company = $this->company->get_user_company($this->session->user_id);
		$this->data['company'] = $company;
		$provinces = $this->province->get_all();
		$commun = null;
		$fokotany_user = $this->fokontany->get_fokontany_user_id();

		if(!empty($fokotany_user)){
			$commun = $this->common->get_common_fokontany($fokotany_user[0]->id);
		}

		foreach($fokotany_user as $key => $value){
			$number_register_fokontany = $this->company->get_register_fokontany($value->fokontany_id);
			$number_register_treated_fokontany = $this->company->count_register_treated_fokontany($value->fokontany_id);
			
			if($number_register_treated_fokontany >= $number_register_fokontany)
				$fokotany_user[$key]->treaty = true;
			else $fokotany_user[$key]->treaty = false; 
		}

		$this->data['provinces'] = $provinces;

		$this->data['fokotanys_user'] = $fokotany_user;
		$this->data['commun_'] = $commun;

		$this->load->view('household', $this->data);
	}

	public function reset_session(){
		if(empty($this->session->userdata("hs_done"))){
			redirect('taille_menage', 'refresh');
		}

		//Suppressions
		$hs_done = $this->session->userdata("household_size");

		$array_items = array('resume','fokotany_id','household_size','hs_done','sector_locality','notebook_fkt','address','persons');

		$this->session->unset_userdata($array_items);

		redirect('taille_menage', 'refresh');
	}

	public function index()
	{
		$company = $this->company->get_user_company($this->session->user_id);
		$provinces = $this->province->get_all();
		$regions = $this->region->get_all(['province_id' => $provinces[0]->id]);
		$districts = $this->district->get_all(['region_id' => $regions[0]->id]);
		$commons = $this->common->get_all(['district_id' => $districts[0]->id]);
		$fokontanys = $this->fokontany->get_all(['common_id' => $commons[0]->id]);

		$this->data['provinces'] = $provinces;
		$this->data['regions'] = $regions;
		$this->data['districts'] = $districts;
		$this->data['commons'] = $commons;
		$this->data['fokontanys'] = $fokontanys;

		$this->data['hs_done'] = $this->session->userdata('hs_done');

		$this->data['jobs'] = $this->job->get_all();

		$this->data['company'] = $company;
		//Préparations Tabs
		$tabs_number = $this->session->userdata('household_size');


		$tabs_nav = [];
		$tabs_content = [];

		$this->data['tab_number'] = $tabs_number;

		for ($i=1; $i <= $tabs_number; $i++){
			$this->data['tab_index'] = $i;
			$tabs_nav[]= $this->load->view('tab_nav', $this->data, TRUE);
			if(empty($this->session->persons))
				$tabs_content[]= $this->load->view('tab_content', $this->data, TRUE);
			else{
				if(isset($this->session->persons[$i-1])){
					$this->data['person'] = $this->session->persons[$i-1];
					$tabs_content[]= $this->load->view('tab_content_fill', $this->data, TRUE);
				}else
						$tabs_content[]= $this->load->view('tab_content', $this->data, TRUE);
			}
		}

		$this->data['tabs_nav'] = $tabs_nav;
		$this->data['tabs_content'] = $tabs_content;
		$this->load->view('index', $this->data);
	}

	public function valid_household_size()
	{
		if (!$this->input->is_ajax_request()) {
            exit('Very ianao :O');
        }

        $data_insert = $this->input->get();

		$province = $this->input->get('province');
		$region = $this->input->get('region');
		$district = $this->input->get('district');
		$common = $this->input->get('common');
		$fokontany = $this->input->get('fokontany');

		$sector_locality = $this->input->get('sector_locality');
		$notebook_fkt = $this->input->get('notebook_fkt');
		$address = $this->input->get('address');
		$pdf_file = $this->input->get('pdf_file');

		$household_size = $this->input->get('household_size');

		/*
		 * Checking required fields
		 */

		$missing_fields = [];

		if(empty($pdf_file))
			$missing_fields[] = 'pdf_file';
		if(empty($household_size))
			$missing_fields[] = 'household_size';
		if(empty($address))
			$missing_fields[] = 'address';

		if(!empty($missing_fields)){
		 	echo json_encode(['invalid_field' => 1, 'fields' => $missing_fields]);
		 	return false;
		}

		$newdata = array(
	        'fokotany_id' => $fokontany,
	        'household_size' => $household_size,
	        'hs_done' => 1,
	        'sector_locality' => $sector_locality,
	        'notebook_fkt' => $notebook_fkt,
	        'address' => $address,
	        'pdf_file' => $pdf_file
		);

		$this->session->set_userdata($newdata);

		echo json_encode(['success' => 1, 'next_step' => 'ajout_individu']);
	}
	/**
	*
	*/
	public function canEditPersonNumber(){
		if (!$this->input->is_ajax_request()) {
            exit('Very ianao :O');
    	}
		$tabs_number = $this->session->userdata('household_size');
		if (!empty($tabs_number)) {
			echo json_encode(['error' => 0, 'nb_person' => $tabs_number]);
		}
	}
	public function sychrPersonNumber(){
		if (!$this->input->is_ajax_request()) {
            exit('Very ianao :O');
    	}
		
		$person_size = $this->input->post('number');
		$operation = $this->input->post('operation');

		if(!empty($person_size)){	
			$current_person_size = $this->session->household_size;
			if($operation == 1){
				$tabs_nav = '';
				$tabs_content = '';

				$this->data['tab_number'] = $person_size;

				for ($i=$current_person_size+1; $i <= $person_size; $i++){
					$this->data['tab_index'] = $i;
				
					$tabs_nav .= $this->load->view('tab_nav', $this->data, TRUE);
					$tabs_content .= $this->load->view('tab_content', $this->data, TRUE);
				}

				$this->session->set_userdata('household_size', $person_size);

				echo json_encode(['success' => 1, 'tabs_nav' => $tabs_nav, 'tabs_content' => $tabs_content]);
			}
			else if($operation == -1){
				if($person_size >= 1){
					$this->session->set_userdata('household_size', $person_size);
					echo json_encode(['success' => 1, 'index_remove' => $current_person_size]);
				}
				else echo json_encode(['error' => 1, 'msg'=> 'La taille de ménage doit être supérieur ou égale à 1.']);
			}
			else echo json_encode(['error' => 1, 'msg'=> 'La taille de ménage ne peut être réduite.']);
		}
		else echo json_encode(['error' => 1, 'msg' => "Changement de la taille de ménage impossible."]);

	}

	public function enter_data()
	{
        if (!$this->input->is_ajax_request()) {
            exit('Very ianao :O');
		}

        $this->load->helper('array');

		$data_insert = $this->input->post();

		$last_name = $this->input->post('last_name');
		$first_name = $this->input->post('first_name');
		$household_head = $this->input->post('household_head');
		$parent_link = $this->input->post('parent_link');
		$birth = $this->input->post('birth');
		$birth_place = $this->input->post('birth_place');
		$sexe = $this->input->post('sexe');
		$marital_status = $this->input->post('marital_status');
		$cin = $this->input->post('cin');
		$cin_date = $this->input->post('cin_date');
		$cin_place = $this->input->post('cin_place');
		$phone = $this->input->post('phone');
		$job = $this->input->post('job');
		$job_status = $this->input->post('job_status');
		$observation = $this->input->post('observation');
		$handicapped = $this->input->post('handicapped');
		$nationality = $this->input->post('nationality');

		$other_pl = $this->input->post('other_pl');
		$other_job = $this->input->post('other_job');

		$job_other = [];

		$size_household_head = count($household_head);

		foreach($household_head as $hh)
			if($hh == 0) $size_household_head--;

		if($size_household_head == 0){
			echo json_encode(['error' => 0, 'msg' => 'Veuillez choisir un chef de ménage.']);
			return false;
		}

		/*
		 * Checking required fields
		 */
		$missing_fields = [];

		if(contentEmpty($last_name))
			$missing_fields[] = 'last_name';
		if(contentEmptyNotZero($household_head))
			$missing_fields[] = 'household_head';
		if(contentEmpty($parent_link)){
			if(contentEmptyNotZero($other_pl))
				$missing_fields[] = 'parent_link';
		}
		if(contentEmpty($birth))
			$missing_fields[] = 'birth';
		if(contentEmpty($birth_place))
			$missing_fields[] = 'birth_place';
		if(contentEmptyNotZero($sexe))
			$missing_fields[] = 'sexe';
		if(contentEmpty($job)){
			if(contentEmptyNotZero($other_job))
				$missing_fields[] = 'job';
		}

		if(!empty($missing_fields)){
			echo json_encode(['invalid_field' => 1, 'fields' => $missing_fields]);
		}
		else
			echo json_encode(['success' => 1, 'msg' => 'Data corect']);
	}

	public function resume_finale(){
		$company = $this->company->get_user_company($this->session->user_id);
		$data = $this->input->post();
		$mode = $this->session->userdata('mode');

		if(empty($data) && empty($this->session->userdata('persons')))
			redirect('ajout_individus', 'refresh');

		$fokontany_id = $this->session->userdata('fokotany_id');
		$household_size = $this->session->userdata('household_size');

		if(empty($fokontany_id))
			return false;

		$this->data['territory'] = $this->territory->get_name_by_fokotany($fokontany_id);

		$this->data['jobs'] = $this->job->get_all();

		if(!empty($data)){
			$persons = [];
			for ($i=0; $i < $household_size; $i++) {
				$tmp_data = [];

				if(!isset($data['household_head'][$i]))
					$data['household_head'][$i] = 0;

				if($data['parent_link'][$i] == 'autre')
					$data['parent_link'][$i] = $data['other_pl'][$i];

				$tmp_data['household_head'] = $data['household_head'][$i];
				$tmp_data['last_name'] = strtoupper($data['last_name'][$i]);
				$tmp_data['first_name'] = $data['first_name'][$i];
				$tmp_data['marital_status'] = $data['marital_status'][$i];
				$tmp_data['parent_link'] = $data['parent_link'][$i];
				$tmp_data['birth'] = $data['birth'][$i];
				$tmp_data['birth_place'] = $data['birth_place'][$i];
				$tmp_data['father'] = $data['father'][$i];
				$tmp_data['mother'] = $data['mother'][$i];
				$tmp_data['father_status'] = $data['father_status'][$i];
				$tmp_data['mother_status'] = $data['mother_status'][$i];
				$tmp_data['sexe'] = $data['sexe'][$i];
				$tmp_data['handicapped'] = $data['handicapped'][$i];
				$tmp_data['cin'] = $data['cin'][$i];
				$tmp_data['cin_date'] = $data['cin_date'][$i];
				$tmp_data['cin_place'] = $data['cin_place'][$i];
				$tmp_data['nationality'] = $data['nationality'][$i];
				$tmp_data['phone'] = $data['phone'][$i];
				$tmp_data['job'] = $data['job'][$i];
				$tmp_data['job_status'] = $data['job_status'][$i];
				$tmp_data['job_other'] = ($data['job'][$i]) ? "" : $data['other_job'][$i];
				$tmp_data['passport'] = $data['passport'][$i];
				$tmp_data['passport_date'] = $data['passport_date'][$i];
				$tmp_data['passport_place'] = $data['passport_place'][$i];

				if($tmp_data['nationality'] == "Malgache" || $tmp_data['nationality'] == '0'){
					$tmp_data['passport'] = '';
					$tmp_data['passport_date'] = '';
					$tmp_data['passport_place'] = '';
				}else{
					$tmp_data['cin'] = '';
					$tmp_data['cin_date'] = '';
					$tmp_data['cin_place'] = '';
				}

				$tmp_data['observation'] = $data['observation'][$i];

				$persons[] = $tmp_data;
			}

			$this->data['persons'] = $persons;

			$this->session->set_userdata('persons', $persons);
		}
		else{
			$this->data['persons'] = $this->session->userdata('persons');
		}
		$this->data['company'] = $company;
		$this->load->view('resume', $this->data);
	}

	public function save_all(){
		if (!$this->input->is_ajax_request()) {
            exit('Very ianao :O');
        }
        if(empty($this->session->userdata('persons')))
			echo json_encode(['error'=>1]);
		else{
			$persons = $this->session->userdata('persons');
			$errors = [];

	        /*
			 * Generate reference
			 */

			$register_reference = 'R';

	        foreach ($persons as $key => $person) {
				$reference_start = substr(strtoupper($person['last_name']), 0, 4);
				$reference = str_pad($reference_start,4,"0");

				//Add month/year
				$reference .= date("mY");

				$duplicate_reference = $this->person->get_all(['reference LIKE' => $reference.'%']);

				if($duplicate_reference)
					$reference .= str_pad((count($duplicate_reference) + 1), 7, "0", STR_PAD_LEFT);
				else
					$reference .= str_pad(1, 7, "0", STR_PAD_LEFT);

				$persons[$key]['reference'] = $reference;
				$persons[$key]['fokontany_id'] = $this->session->userdata("fokotany_id");
				$persons[$key]['pdf_file'] = $this->session->pdf_file;
				$persons[$key]['address'] = $this->session->userdata("address");
				$persons[$key]['notebook_fkt'] = $this->session->userdata("notebook_fkt");
				$persons[$key]['sector_locality'] = $this->session->userdata("sector_locality");
				$persons[$key]['household_size'] = $this->session->userdata("household_size");
				$persons[$key]['created_by'] = $this->session->user_id;

				$_cin_date = $persons[$key]['cin_date'];
				$_passport_date = $persons[$key]['passport_date'];
				$_birth = $persons[$key]['birth'];

				if($_cin_date == "") unset($persons[$key]['cin_date']);
				if($_passport_date == "") unset($persons[$key]['passport_date']);
				if($_birth == "") unset($persons[$key]['birth']);

				$id_insert = $this->person->insert($persons[$key]);

				if(!empty($id_insert)){
					//Save person to register
					if($key == 0) $register_reference .= $reference;
					$this->person->insert_register(['fokontany_id' => $this->session->userdata("fokotany_id") ,'reference'=>$register_reference, 'person_id' => $id_insert]);

					$criteria = $persons[$key]['last_name'];
					$criteria .= $persons[$key]['first_name'];
					$criteria .= $persons[$key]['birth'];
					$criteria .= $persons[$key]['birth_place'];

					$criteria = strtolower($criteria);

					$duplicates = false;//$this->person->get_duplicates(['criteria' => $criteria, 'id !=' => $id_insert]);

					if(!empty($duplicates)){
						$ids = [];
						foreach ($duplicates as $duplicate)
							$ids[] = ['person_id' => $id_insert, 'duplicate_id' => $duplicate->id];

						if(!empty($ids))
							$this->person->insert_duplicates($ids);
					}
				}
				else $errors[] = $reference;
			}

			if(empty($errors))
				echo json_encode(['success'=>1]);
			else
				echo json_encode(['error'=>1]);

		}
	}

	public function check_fiedl(){
		if (!$this->input->is_ajax_request()) {
            exit('Very ianao :O');
		}

        $last_name = $this->input->get('last_name');
        $birth = $this->input->get('birth');
        $birth_place = $this->input->get('birth_place');
        $first_name = $this->input->get('first_name');
        $parent_link = $this->input->get('parent_link');
        $job = $this->input->get('job');
        $cin = $this->input->get('cin');
        $cin_date = $this->input->get('cin_date');
        $cin_place = $this->input->get('cin_place');

        if(empty($last_name) && empty($first_name) && empty($birth) && empty($parent_link) && empty($job))
        	echo json_encode(['error' => 1, 'all_empty' => 1]);
        else if(empty($last_name) && empty($first_name))
        	echo json_encode(['error' => 1, 'name_empty' => 1]);
		else if(empty($birth))
			echo json_encode(['error' => 1, 'birth_empty' => 1]);
		else if(empty($birth_place))
			echo json_encode(['error' => 1, 'birth_place_empty' => 1]);
        else if(!empty($cin)){
        	$cin = str_replace(' ', '', $cin);
        	$cin = intval($cin);

        	if($cin <= 100000000000 || $cin >= 999999999999)
        		echo json_encode(['error' => 1, 'cin_empty' => 1]);
        	else echo json_encode(['success' => 1, 'msg' => 'Champs OK']);
		}
		else if(!empty($cin) || !empty($cin_date) || !empty($cin_place)){
			if(empty($cin))
				echo json_encode(['error' => 1, 'cin_must' => 1]);
			else if(empty($cin_date))
				echo json_encode(['error' => 1, 'cin_date_must' => 1]);
			else if(empty($cin_place))
				echo json_encode(['error' => 1, 'cin_place_must' => 1]);
			else
				echo json_encode(['success' => 1, 'msg' => 'Champs OK']);
		}
        else
        	echo json_encode(['success' => 1, 'msg' => 'Champs OK']);
	}

	public function get_all_duplicated_persons(){
		if (!$this->input->is_ajax_request()) {
            exit('Very ianao :O');
		}

		$duplicates_persons = $this->person->get_all_duplicated_persons();

		echo json_encode($duplicates_persons);
	}
}
