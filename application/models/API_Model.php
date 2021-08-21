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

	public function checkEmail($email)
    {
        $query = $this->db->where('USER_EMAIL', $email)->get('USER');
		if ($this->db->affected_rows() == 1) {
			return true;
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

	public function getUserRow($id = null)
	{
		if ($id == null)
			$query = $this->db->get('USER')->num_rows();
		else
			$query = $this->db->where(array('INSTITUTION_ID' => $id))->get('USER')->num_rows();

		return $query;
	}

	public function getSellingRow($id = null, $iid = null)
	{
		if ($id == null && $iid == null) {
			$query = $this->db->get('TRANSACTION')->num_rows();
		} else if ($id == null && $iid != null) {
			$query = $this->db->query("SELECT * FROM USER U JOIN TRANSACTION T ON U.USER_ID = T.USER_ID WHERE U.INSTITUTION_ID = $iid")->num_rows();
		} else {
			$query = $this->db->where('USER_ID', $id)->get('TRANSACTION')->num_rows();
		}

		return $query;
	}

	public function getProductRow($uid = null)
	{
		if ($uid != null) {
			$query = $this->db->where('USER_ID', $uid)->get('USER_PRODUCT')->num_rows();

			return $query;
		} else {
			$query = $this->db->get('PRODUCT')->num_rows();

			return $query;
		}
	}

	public function getCompanyRow()
	{
		$query = $this->db->get('COMPANY')->num_rows();

		return $query;
	}

	public function getSellingAdmin($id = null)
	{
		if ($id == null)
			$query = $this->db->query('SELECT T.TRANSACTION_ID, T.TRANSACTION_DATE, T.TRANSACTION_CODE, T.TRANSACTION_STATUS, P.PRODUCT_NAME, U.USER_FULLNAME, PP.PAYMENT_TOTAL, PP.PAYMENT_NAME, PP.PAYMENT_METHOD, PP.PAYMENT_PROOF, PP.PAYMENT_AS_NAME, PP.PAYMENT_NO_REK FROM TRANSACTION T JOIN PRODUCT P ON P.PRODUCT_ID = T.PRODUCT_ID JOIN PAYMENT PP ON PP.PAYMENT_ID = T.PAYMENT_ID JOIN USER U ON U.USER_ID = T.USER_ID WHERE T.TRANSACTION_STATUS = 5')->result();
		else
			$query = $this->db->query('SELECT T.TRANSACTION_ID, T.TRANSACTION_DATE, T.TRANSACTION_CODE, T.TRANSACTION_STATUS, P.PRODUCT_NAME, U.USER_FULLNAME, PP.PAYMENT_TOTAL, PP.PAYMENT_NAME, PP.PAYMENT_METHOD, PP.PAYMENT_PROOF, PP.PAYMENT_AS_NAME, PP.PAYMENT_NO_REK FROM TRANSACTION T JOIN PRODUCT P ON P.PRODUCT_ID = T.PRODUCT_ID JOIN PAYMENT PP ON PP.PAYMENT_ID = T.PAYMENT_ID JOIN USER U ON U.USER_ID = T.USER_ID WHERE U.INSTITUTION_ID = '.$id)->result();

		return $query;
	}

	public function getBuyAdmin()
	{
		$query = $this->db->query('SELECT T.TRANSACTION_ID, T.TRANSACTION_DATE, T.TRANSACTION_CODE, T.TRANSACTION_STATUS, P.PRODUCT_NAME, U.USER_FULLNAME, PP.PAYMENT_TOTAL, PP.PAYMENT_NAME, PP.PAYMENT_METHOD, PP.PAYMENT_PROOF, PP.PAYMENT_AS_NAME, PP.PAYMENT_NO_REK FROM TRANSACTION T JOIN PRODUCT P ON P.PRODUCT_ID = T.PRODUCT_ID JOIN PAYMENT PP ON PP.PAYMENT_ID = T.PAYMENT_ID JOIN USER U ON U.USER_ID = T.USER_ID WHERE T.TRANSACTION_STATUS < 5')->result();

		return $query;
	}

	public function getInstitution($id = null)
	{
		if ($id == null)
			$query = $this->db->get('INSTITUTION')->result();
		else
			$query = $this->db->where('INSTITUTION_ID', $id)->get('INSTITUTION')->result();

		return $query;
	}

	public function insert($data, $table)
	{
		$query = $this->db->insert($table, $data);
		if ($query) {
			return $this->db->insert_id();
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
			return $query;
		}
	}

	public function getJoinUser($data)
	{
		$query = $this->db->select()->from('USER')->join('COMPANY', 'COMPANY.COMPANY_ID = USER.COMPANY_ID')
		->where('USER_ID', $data)->get()->row();

		return $query;
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

	public function getFirstChildById($data, $table)
	{
		$query = $this->db->where($data)->get($table)->row();
		
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

	public function getProductDistinct($id, $companyId)
	{
		$query = $this->db->query("SELECT * FROM PRODUCT WHERE COMPANY_ID = $companyId AND PRODUCT_ID NOT IN (SELECT PRODUCT_ID FROM USER_PRODUCT WHERE USER_ID = $id)");
		return $query->result();
	}

	public function getJobsHome()
	{
		$query = $this->db->order_by('JOB_ID', 'DESC')->limit(5)->get('JOB');
		return $query->result();
	}
}

/* End of file API_Model.php */
