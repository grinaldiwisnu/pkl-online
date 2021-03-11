<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_logged_in')) {
            redirect('auth','refresh');
        }
    }
    
    public function index()
    {
        $data = array(
			'title' => "Dashboard"
		);
		$this->load->view('dist/index', $data);
    }

}

/* End of file Home.php */
