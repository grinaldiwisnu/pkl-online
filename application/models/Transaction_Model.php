<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_Model extends CI_Model {

    public function getProducts()
    {
        $id = $this->session->userdata('id');
        $query = $this->db->query("SELECT * FROM USER_PRODUCT UP JOIN PRODUCT P ON UP.PRODUCT_ID = P.PRODUCT_ID WHERE UP.USER_ID = $id");
        if ($query) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function checkInPaymentTrans()
    {
        $id = $this->session->userdata('id');
        $query = $this->db->where('TRANSACTION_STATUS <', 2)->get('TRANSACTION');
        if ($query->num_rows() > 3) {
            return false;
        } else {
            return true;
        }
    }

    public function createTrans($data)
    {
        $query = $this->db->insert('TRANSACTION', $data);
        if ($query) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function getTransacions()
    {
        $id = $this->session->userdata('id');
        $query = $this->db->where(array('USER_ID' => $id))->order_by('TRANSACTION_DATE', 'ASC')->get('TRANSACTION');
        return $query->result();
    }
}

/* End of file Transaction_Model.php */
