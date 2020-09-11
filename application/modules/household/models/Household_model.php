<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Household_model extends CI_Model
{
	private $_table = "v_people";
	private $_duplicates = "v_duplicates";
	

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

	public function duplicate($criteria = array())
    {
		$this->db->select('*');
		$this->db->from($this->_duplicates);
		
		if(!empty($criteria)){
			$this->db->where($criteria);
		}
		
		$query = $this->db->get();

		return $query->result();
    }
}