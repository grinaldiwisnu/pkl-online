<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('auth','refresh');
        }
        $this->load->model('API_Model', 'API');
    }
    
    public function index()
    {
        $isAdmin = $this->session->userdata('admin');
        if ($isAdmin) {
            $totalUser = $this->API->getUserRow();
            $totalCompany = $this->API->getCompanyRow();
            $totalProduct = $this->API->getProductRow();
            $totalSelling = $this->API->getSellingRow();

            $data = array(
                'title' => "Admin Dashboard",
                'total_user' => $totalUser,
                'total_company' => $totalCompany,
                'total_product' => $totalProduct,
                'total_selling' => $totalSelling
            );
            $this->load->view('dist/index-admin', $data);
        } else {
            $data = array(
                'title' => "Dashboard"
            );
            $this->load->view('dist/index', $data);
        }
    }

    public function product()
    {
        $isAdmin = $this->session->userdata('admin');
        if (!$isAdmin) {
            $totalProduct = $this->API->getProductRow($this->session->userdata('id'));
            $user = $this->API->getById(array('USER_ID' => $this->session->userdata('id')), 'USER');
            $products = $this->API->getChildById(array('USER_ID' => $this->session->userdata('id')), 'USER_PRODUCT');
            for ($i=0; $i < count($products); $i++) { 
                $products[$i]->PRODUCT = $this->API->getChildById(array('PRODUCT_ID' => $products[$i].PRODUCT_ID), 'PRODUCT');
            }

            $data = array(
                'title' => "Produk Saya",
                'total_product' => $totalProduct,
                'products' => $products,
                'isAvailable' => $user->COMPANY_ID != null ? true : false
            );
            $this->load->view('dist/modules-product-user', $data);
        }
    }

    public function logout()
    {
        session_destroy();

        redirect('auth','refresh');
    }
}

/* End of file Home.php */
