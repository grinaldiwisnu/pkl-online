<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class API_Model extends CI_Model {

    public function Auth($params)
    {
        $query = $this->db->where($params)->get('USER');
		if ($this->db->affected_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
    }

	public function Register($params)
	{
		$query = $this->db->insert('USER', $params);
		if ($this->db->affected_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
	}

}

/* End of file API_Model.php */
