<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Person_model extends CI_Model
{
	private $_table = "person";
	private $_duplicate = "duplicate_person";
	private $_register = "register";
	private $_fokontany = "fokontany";

	private $_v_duplicates = "v_duplicates"; 
	private $_v_people = "v_people"; 
	

	public function __construct(){      
        $this->load->database();
    }

	public function get_all($criteria = array()) {
		$this->db->select('*');
		$this->db->from($this->_table);
		
		if(!empty($criteria)){
			$this->db->where($criteria);
		}
		
		$this->db->order_by('reference', 'asc');
		
		$query = $this->db->get();

		return $query->result();
	}

	public function insert($data) {
		$this->db->insert($this->_table, $data);
		return $this->db->insert_id();
	}

	public function insert_register($data){
		return $this->db->insert($this->_register, $data);
	}

	public function insert_datas($data) {
		return $this->db->insert_batch($this->_table, $data); 
	}

	public function insert_duplicates($data) {
		return $this->db->insert_batch($this->_duplicate, $data); 
	}

	public function get_duplicates($criteria) {
		$this->db->select('*');
		$this->db->from($this->_v_duplicates);
		
		if(!empty($criteria)){
			$this->db->where($criteria);
		}
		
		$this->db->order_by('id', 'asc');
		
		$query = $this->db->get();

		return $query->result(); 
	}

	public function update($data, $id)
	{
		$this->db->where('id', $id);
		return $this->db->update($this->_table, $data);
	}
	
	public function get_person_treaty(){
		$this->db->select('reference as reference , first_name as first_name, last_name as last_name, address as address');
		$this->db->from($this->_table);

		$query = $this->db->get();

		return $query->result(); 
	}

	public function get_person_treaty_by_fokontany($id_fokontany = 0){
		$this->db->select('person.reference as reference , person.first_name as first_name, person.last_name as last_name, person.address as address, fokontany.name as fokontany');
		$this->db->from($this->_table);
		$this->db->join($this->_fokontany, $this->_table.'.fokontany_id = '.$this->_fokontany.'.id');

		if(!empty($id_fokontany)){
			$this->db->where('fokontany_id',$id_fokontany);
		}

		$query = $this->db->get();

		return $query->result(); 
	}

	public function get_all_duplicated_persons(){
		$this->db->select('v_people.*, fokontany.name as fokontany_name');
		$this->db->from($this->_v_people);
		$this->db->join($this->_duplicate,  $this->_v_people.'.person_id = '.$this->_duplicate.'.person_id');
		$this->db->join($this->_fokontany, $this->_v_people.'.fokontany_id = '.$this->_fokontany.'.id');

		$query = $this->db->get();

		return $query->result();
	}
}
