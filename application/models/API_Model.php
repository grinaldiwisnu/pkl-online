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

	public function authAdmin($params)
    {
        $query = $this->db->where($params)->get('ADMIN');
		if ($this->db->affected_rows() == 1) {
			return $query->row();
		} else {
			return false;
		}
    }

	public function checkAdmin($params)
	{
		$query = $this->db->where($params)->get('ADMIN');
		if ($this->db->affected_rows() == 1) {
			return true;
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

	public function getUserRow()
	{
		$query = $this->db->get('USER')->num_rows();

		return $query;
	}

	public function getSellingRow()
	{
		$query = $this->db->get('TRANSACTION')->num_rows();

		return $query;
	}

	public function getProductRow()
	{
		$query = $this->db->get('PRODUCT')->num_rows();

		return $query;
	}

	public function getCompanyRow()
	{
		$query = $this->db->get('COMPANY')->num_rows();

		return $query;
	}

	public function getSellingAdmin()
	{
		$query = $this->db->query('SELECT T.TRANSACTION_ID, T.TRANSACTION_DATE, T.TRANSACTION_CODE, T.TRANSACTION_STATUS, P.PRODUCT_NAME, U.USER_FULLNAME, PP.PAYMENT_TOTAL, PP.PAYMENT_NAME, PP.PAYMENT_METHOD FROM TRANSACTION T JOIN PRODUCT P ON P.PRODUCT_ID = T.PRODUCT_ID JOIN PAYMENT PP ON PP.PAYMENT_ID = T.PAYMENT_ID JOIN USER U ON U.USER_ID = T.USER_ID')->result();

		return $query;
	}

	public function getInstitution()
	{
		$query = $this->db->get('INSTITUTION')->result();

		return $query;
	}

	public function insert($data, $table)
	{
		$query = $this->db->insert($table, $data);
		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function get($table)
	{
		$query = $this->db->get($table)->result();

		return $query;
	}

	public function getById($data, $table)
	{
		$query = $this->db->where($data)->get($table)->row();
		
		if ($query) {
			return $query;
		} else {
			return false;
		}
	}

	public function getChildById($data, $table)
	{
		$query = $this->db->where($data)->get($table)->result();
		
		if ($query) {
			return $query;
		} else {
			return [];
		}
	}

	public function update($where, $data, $table)
	{
		$query = $this->db->where($where)->update($table, $data);

		if ($query) {
			return true;
		} else {
			return false;
		}
	}

	public function delete($where, $table)
	{
		$query = $this->db->where($where)->delete($table);

		if ($query) {
			return true;
		} else {
			return false;
		}
	}
}

/* End of file API_Model.php */
