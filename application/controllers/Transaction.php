<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('auth','refresh');
        }
        $this->load->model('Transaction_Model', 'Transaction');
        $this->load->model('API_Model', 'API');
    }

    public function index()
    {
        $data = array(
            'title' => "Buat Transaksi",
            'products' => $this->Transaction->getProducts()
        );
        $this->load->view('dist/modules-transaction', $data);
    }

    public function create()
    {
        $user = $this->input->post('uid');
        $qty = $this->input->post('qty');
        $note = $this->input->post('note');
        $addr = $this->input->post('address');
        $reference = $this->input->post('reff');
        $source = $this->input->post('reference');

        if (empty($user) || empty($qty) || empty($addr) || $reference) {
            $this->msg = array('status' => false, 'message' => 'Data transaksi ada yang masih kosong', 'data' => null);
        } else {

            $product = $this->db->where('REFF_ID', $reference)->get('USER_PRODUCT')->row();
            $data = array(
                'TRANSACTION_DATE' => date('Y-m-d H:i:s'),
                'TRANSACTION_CODE' => "TRANSID-".strtoupper(uniqid()),
                'TRANSACTION_STATUS' => 1,
                'TRANSACTION_ADDRESS' => $addr,
                'TRANSACTION_NOTE' => $note,
                'TRANSACTION_QTY' => $qty,
                'TRANSACTION_REFERENCE' => $source,
                'REFF_ID' => $reference,
                'USER_ID' => $user,
                'PRODUCT_ID' => $product->PRODUCT_ID,
            );

            if (!$this->Transaction->checkInPaymentTrans()) {
                $this->msg = array('status' => false, 'message' => 'Tolong selesaikan pembayaran transaksi sebelumnya', 'data' => null);
            } else {
                $store = $this->Transaction->createTrans($data);
                if (!$store) {
                    $this->msg = array('status' => false, 'message' => 'Internal server error', 'data' => null);
                } else {
                    $this->msg = array('status' => true, 'message' => 'Transaksi berhasil dibuat, silahkan lakukan pembayaran.', 'data' => $data);
                }
            }
        }

        echo json_encode($this->msg);
    }

    public function history()
    {
        $data = array(
            'title' => "Riwayat Transaksi",
            'transactions' => $this->Transaction->getTransacions()
        );
        $this->load->view('dist/modules-history', $data);
    }
}

/* End of file Transaction.php */
