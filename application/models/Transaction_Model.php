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

}

/* End of file Transaction_Model.php */
