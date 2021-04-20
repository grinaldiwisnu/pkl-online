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
            $data = array(
                'title' => "Admin Dashboard"
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
