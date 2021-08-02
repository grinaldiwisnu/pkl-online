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
        $query = $this->db->query("
            SELECT * FROM TRANSACTION T 
            JOIN PRODUCT P ON T.PRODUCT_ID = P.PRODUCT_ID 
            JOIN PAYMENT PY ON T.PAYMENT_ID = PY.PAYMENT_ID
            JOIN USER U ON T.USER_ID = U.USER_ID
            WHERE T.USER_ID = $id
            ORDER BY T.TRANSACTION_DATE ASC
        ");
        return $query->result();
    }

    public function getTransacion($transId)
    {
        $id = $this->session->userdata('id');
        $query = $this->db->query("
            SELECT * FROM TRANSACTION T 
            JOIN PRODUCT P ON T.PRODUCT_ID = P.PRODUCT_ID 
            JOIN PAYMENT PY ON T.PAYMENT_ID = PY.PAYMENT_ID
            JOIN USER U ON T.USER_ID = U.USER_ID
            WHERE T.USER_ID = $id AND T.TRANSACTION_ID = $transId
            ORDER BY T.TRANSACTION_DATE ASC
        ");
        return $query->row();
    }

    public function insertPayment($data)
    {
        $query = $this->db->insert('PAYMENT', $data);
        if ($query) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
}

/* End of file Transaction_Model.php */
