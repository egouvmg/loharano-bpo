<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Company_model extends CI_Model
{
	private $_table = "company";
	private $_users = "users";
	private $_inputs = "inputs";
	private $_fokontany_register = "fokontany_register";
	private $_register = "register";
	private $_person = "person";

	private $_v_statdaily = "v_statdaily";
	private $_v_countCompanyFokontanyRegister = "v_countCompanyFokontanyRegister";
	private $_v_companyFokontanyRegister = "v_companyFokontanyRegister";
	private $_v_fokontanyRegister = "v_fokontanyRegistre";

	//New view
	private $_start_company = "v_start_company";
	private $_done_company = "v_done_company";
	private $_v_daily_done_register = "v_daily_done_register";
	private $_v_daily_register_fokontany = "v_daily_register_fokontany";

	public function __construct(){      
        $this->load->database();
    }

	public function get_all($criteria = array()) {
		$this->db->select('*');
		$this->db->from($this->_table);
		
		if(!empty($criteria)){
			$this->db->where($criteria);
		}
		
		$query = $this->db->get();

		return $query->result();
	}

	public function statdaily($criteria = array()) {
		$this->db->select('*');
		$this->db->from($this->_v_statdaily);
		
		if(!empty($criteria)){
			$this->db->where($criteria);
		}

		$this->db->order_by('sd_day', 'DESC');
		
		$query = $this->db->get();

		return $query->result();
	}

	public function daily_register_fokontany($criteria = array()) {
		$this->db->select('*');
		$this->db->from($this->_v_daily_register_fokontany);
		
		if(!empty($criteria)){
			$this->db->where($criteria);
		}

		$this->db->order_by('day_done', 'DESC');
		
		$query = $this->db->get();

		return $query->result();
	}

	public function total_drf($criteria = array()) {
		$this->db->select('fokontany_id, SUM(nbr_register) nbr_register, SUM(nbr_people) nbr_people, company_id, name, t_register, t_people');
		$this->db->from($this->_v_daily_register_fokontany);
		
		if(!empty($criteria)){
			$this->db->where($criteria);
		}

		$this->db->order_by('name', 'ASC');
		$this->db->group_by('fokontany_id, name, t_register, t_people, company_id');
		
		$query = $this->db->get();

		return $query->result();
	}

	public function total_ddr($criteria = array()){
		$this->db->select('fokontany_id, SUM(nbr_register) nbr_register, SUM(nbr_people) nbr_people, name');
		$this->db->from($this->_v_daily_done_register);
		
		if(!empty($criteria)){
			$this->db->where($criteria);
		}

		$this->db->order_by('name', 'ASC');
		$this->db->group_by('fokontany_id, name');
		
		$query = $this->db->get();

		return $query->result();
	}

	public function total_drf_one($criteria = array()) {
		$this->db->select('fokontany_id, SUM(nbr_register) nbr_register, SUM(nbr_people) nbr_people, company_id, name, t_register, t_people');
		$this->db->from($this->_v_daily_register_fokontany);
		
		if(!empty($criteria)){
			$this->db->where($criteria);
		}

		$this->db->group_by('fokontany_id, name, t_register, t_people, company_id');
		
		$query = $this->db->get();

		return  ($query->num_rows() > 0) ? $query->first_row() : false;
	}

	public function total_ddr_one($criteria = array()) {
		$this->db->select('fokontany_id, SUM(nbr_register) nbr_register, SUM(nbr_people) nbr_people, name');
		$this->db->from($this->_v_daily_done_register);
		
		if(!empty($criteria)){
			$this->db->where($criteria);
		}

		$this->db->group_by('fokontany_id, name');
		
		$query = $this->db->get();

		return  ($query->num_rows() > 0) ? $query->first_row() : false;
	}

	public function fokontanyRegister($criteria = array()) {
		$this->db->select('*');
		$this->db->from($this->_v_fokontanyRegister);
		
		if(!empty($criteria)){
			$this->db->where($criteria);
		}

		$this->db->order_by('name', 'ASC');
		
		$query = $this->db->get();

		return $query->result();
	}

	public function countCompanyFokontanyRegister($criteria = array()) {
		$this->db->select('*');
		$this->db->from($this->_v_countCompanyFokontanyRegister);
		
		if(!empty($criteria)){
			$this->db->where($criteria);
		}

		$this->db->order_by('day_done', 'DESC');
		
		$query = $this->db->get();

		return $query->result();
	}

	public function countCompanyFokontanyRegisterOne($criteria = array()) {
		$this->db->select('*');
		$this->db->from($this->_v_countCompanyFokontanyRegister);
		
		if(!empty($criteria)){
			$this->db->where($criteria);
		}
		
		$query = $this->db->get();

		return  ($query->num_rows() > 0) ? $query->first_row() : false;
	}

	public function companyFokontanyRegister($criteria = array()) {
		$this->db->select('*');
		$this->db->from($this->_v_countCompanyFokontanyRegister);
		
		if(!empty($criteria)){
			$this->db->where($criteria);
		}
		
		$query = $this->db->get();

		return $query->result();
	}

	public function get_details($criteria = array()) {
		$this->db->select('*');
		$this->db->from($this->_table);
		
		if(!empty($criteria)){
			$this->db->where($criteria);
		}
		
		$query = $this->db->get();

		return  ($query->num_rows() > 0) ? $query->first_row() : false;
	}

	public function get_start_company($criteria = array()) {
		$this->db->select('*');
		$this->db->from($this->_start_company);
		
		if(!empty($criteria)){
			$this->db->where($criteria);
		}
		
		$query = $this->db->get();

		return  ($query->num_rows() > 0) ? $query->first_row() : false;
	}

	public function get_done_company($criteria = array()) {
		$this->db->select('*');
		$this->db->from($this->_done_company);
		
		if(!empty($criteria)){
			$this->db->where($criteria);
		}
		
		$query = $this->db->get();

		return  ($query->num_rows() > 0) ? $query->first_row() : false;
	}

	public function get_user_company($id = 0) {
		$this->db->select($this->_table.'.*');

		$this->db->from($this->_table);
		$this->db->join($this->_users, $this->_users.'.company_id = '.$this->_table.'.id');
		
		$this->db->where($this->_users.'.id', $id);
		
		$query = $this->db->get();
		return  ($query->num_rows() > 0) ? $query->first_row() : false;
	}

	public function get_number_registers($id_company = 0) {
		$this->db->select('SUM(number) as number_registers');
		$this->db->from($this->_inputs);
		
		if(!empty($id_company))
			$this->db->where('company_id', $id_company);
		
		$query = $this->db->get();

		return  ($query->num_rows() > 0) ? $query->first_row()->number_registers : false;
	}

	public function get_number_fokontany($id_company = 0) {
		$this->db->select('COUNT(fokontany_id) as number_fokotany');
		$this->db->from($this->_inputs);

		if(!empty($id_company))
			$this->db->where('company_id', $id_company);
		
		$query = $this->db->get();

		return  ($query->num_rows() > 0) ? $query->first_row()->number_fokotany : false;
	}

	public function insert($data) {
		$this->db->insert($this->_table, $data);
		return $this->db->insert_id();
	}

	public function insert_datas($data) {
		return $this->db->insert_batch($this->_table, $data); 
	}

	public function get_allIdFokontanyCompany($id_company = 0) {
		$this->db->select('fokontany_id as fokontany_id');
		$this->db->from($this->_inputs);

		if(!empty($id_company))
			$this->db->where('company_id', $id_company);
		
		$query = $this->db->get();

		return $query->result();
	}

	public function get_number_people_fokontany($id_fokontany = 0){
		$this->db->select('SUM(people) as number_people');
		$this->db->from($this->_fokontany_register);
		if(!empty($id_fokontany)){
			$this->db->where('fokontany_id', $id_fokontany);
		}

		$query = $this->db->get();

		return ($query->num_rows() > 0) ? $query->first_row()->number_people: false;
	}

	public function get_register_fokontany($id_fokontany = 0){
		$this->db->select('SUM(nbr_register) AS nbr_register');
		$this->db->from($this->_fokontany_register);
		if(!empty($id_fokontany)){
			$this->db->where('fokontany_id', $id_fokontany);
		}

		$query = $this->db->get();

		return ($query->num_rows() > 0) ? $query->first_row()->nbr_register: false;
	} 

	public function count_person_treated_fokontany($id_fokontany = 0){
		$this->db->select('COUNT(id) as number_person');
		$this->db->from($this->_person);
		if(!empty($id_fokontany)){
			$this->db->where('fokontany_id', $id_fokontany);
		}

		$query = $this->db->get();

		return ($query->num_rows() > 0) ? $query->first_row()->number_person: false;
	}

	public function count_register_treated_fokontany($id_fokontany = 0){
		$this->db->select('COUNT(DISTINCT reference) as done_register');
		$this->db->from($this->_register);
		if(!empty($id_fokontany)){
			$this->db->where('fokontany_id', $id_fokontany);
		}

		$query = $this->db->get();

		return ($query->num_rows() > 0) ? $query->first_row()->done_register: false;
	}


}
