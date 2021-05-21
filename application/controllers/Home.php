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
        $isAdmin = $this->API->checkAdmin(array('ADMIN_ID' => $this->session->userdata('id')));
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

    public function logout()
    {
        session_destroy();

        redirect('auth','refresh');
    }
}

/* End of file Home.php */
