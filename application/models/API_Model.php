<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class API_Model extends CI_Model {

    public function auth($params)
    {
        $query = $this->db->where($params)->get('USER');
		if ($this->db->affected_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
    }

	public function register($params)
	{
		$query = $this->db->insert('USER', $params);
		if ($this->db->affected_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function getAllInstitution()
	{
		$query = $this->db->get('INSTITUTION')->result();

		return $query;
	}

}

/* End of file API_Model.php */
