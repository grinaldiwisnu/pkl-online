<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('auth','refresh');
        }
        $this->load->model('Transaction_model', 'Transaction');
        $this->load->model('API_model', 'API');
    }

    public function index()
    {
        $data = array(
            'title' => "Buat Transaksi",
            'products' => $this->Transaction->getProducts()
        );
        $this->load->view('dist/modules-transaction', $data);
    }

}

/* End of file Transaction.php */
