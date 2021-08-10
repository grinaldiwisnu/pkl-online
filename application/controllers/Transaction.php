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
        $addr = $this->input->post('address');
        $source = $this->input->post('reference');
        $reference = $this->input->post('reff');
        $name = $this->input->post('name');

        $note = $this->input->post('note');

        if (empty($name) || empty($user) || empty($qty) || empty($addr) || empty($source) || empty($reference)) {
            $this->msg = array('status' => false, 'message' => 'Data transaksi ada yang masih kosong', 'data' => $this->input->post());
        } else {

            $productReff = $this->db->where('REFF_ID', $reference)->get('USER_PRODUCT')->row();
            $product = $this->db->where('PRODUCT_ID', $productReff->PRODUCT_ID)->get('PRODUCT')->row();
            
            $payment = array(
                'PAYMENT_NAME' => "PAID-".strtoupper(uniqid()),
                'PAYMENT_TOTAL' => $product->PRODUCT_PRICE * $qty,
                'PAYMENT_METHOD' => 'BCA',
                'PAYMENT_PROOF' => '',
            );

            $paymentSave = $this->Transaction->insertPayment($payment);

            $data = array(
                'TRANSACTION_DATE' => date('Y-m-d H:i:s'),
                'TRANSACTION_CODE' => "TRANSID-".strtoupper(uniqid()),
                'TRANSACTION_NAME' => $name,
                'TRANSACTION_STATUS' => 1,
                'TRANSACTION_ADDRESS' => $addr,
                'TRANSACTION_NOTE' => $note,
                'TRANSACTION_QTY' => $qty,
                'TRANSACTION_REFERENCE' => $source,
                'REFF_ID' => $reference,
                'USER_ID' => $user,
                'PRODUCT_ID' => $productReff->PRODUCT_ID,
                'PAYMENT_ID' => $paymentSave
            );

            if (!$this->Transaction->checkInPaymentTrans()) {
                $this->msg = array('status' => false, 'message' => 'Tolong selesaikan pembayaran transaksi sebelumnya', 'data' => null);
            } else {
                $store = $this->Transaction->createTrans($data);
                if (!$store) {
                    $this->msg = array('status' => false, 'message' => 'Internal server error', 'data' => null);
                } else {
                    $data['CALLBACK'] = base_url().'transaction/detail/'.$store;
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

    public function detail()
    {
        $id = $this->uri->segment(3);
        $transaction = $this->Transaction->getTransacion($id);
    
        $data = array(
            'title' => $transaction->TRANSACTION_CODE,
            'transaction' => $transaction
        );
        $this->load->view('dist/modules-invoices', $data);
    }

    public function confirm_payment()
    {
        $id = $this->input->post('id');
        $trxId = $this->input->post('trans_id');
        $paymentName = $this->input->post('name');
        $paymentNorek = $this->input->post('norek');

        if (empty($id) || empty($trxId) || empty($paymentName) || empty($paymentNorek)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field empty', 'data' => null)
            );
        } else {
            $config['upload_path']="./upload/proof"; //path folder file upload
            $config['allowed_types']='gif|jpg|png'; //type file yang boleh di upload
            $config['encrypt_name'] = TRUE; //enkripsi file name upload
            
            $this->load->library('upload',$config); //call library upload 
            if($this->upload->do_upload("proof")){ //upload file
                $data = array('upload_data' => $this->upload->data()); //ambil file name yang diupload
    
                $image= $data['upload_data']['file_name']; //set file name ke variable image

                $data = array(
                    'PAYMENT_AS_NAME' => $paymentName,
                    'PAYMENT_NO_REK' => $paymentNorek,
                    'PAYMENT_PROOF' => $image,
                );

                $result = $this->API->update(array('PAYMENT_ID' => $id), $data, 'PAYMENT');
                if (!$result) {
                    echo json_encode(
                        array('status' => false, 'message' => 'Failed to store on server', 'data' => null)
                    );
                } else {
                    $result = $this->API->update(array('TRANSACTION_ID' => $trxId), array('TRANSACTION_STATUS' => 2), 'TRANSACTION');
                    if ($result) {
                        echo json_encode(
                            array('status' => true, 'message' => 'Update payment success', 'data' => $data)
                        );
                    }
                }
            } else {
                echo json_encode(
                    array('status' => false, 'message' => 'Failed to upload image for payment', 'data' => null)
                );
            }
        }
    }

    public function update_status()
    {
        $status = $this->input->post('status');
        $trxId = $this->input->post('trans_id');

        if (empty($status) || empty($trxId)) {
            echo json_encode(
                array('status' => false, 'message' => 'Field empty', 'data' => null)
            );
        } else {
            $payload = array(
                'TRANSACTION_STATUS' => $status
            );

            $result = $this->API->update(array('TRANSACTION_ID' => $trxId), $payload, 'TRANSACTION');
            if (!$result) {
                echo json_encode(
                    array('status' => false, 'message' => 'Failed to store on server', 'data' => null)
                );
            } else {
                echo json_encode(
                    array('status' => true, 'message' => 'Success update status', 'data' => null)
                );
            }
        }
    }
}

/* End of file Transaction.php */
