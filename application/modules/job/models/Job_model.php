<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Job_model extends CI_Model
{
	private $_table = "profession";

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

		$this->db->order_by('name', 'asc');

		return $query->result();
	}
}