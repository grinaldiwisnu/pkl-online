<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class API extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('API_Model', 'API');
    }

    public function index()
    {
        echo "Hello geeks!";
    }

    public function authAPI()
    {
        $email = $this->input->post('email');
		$password = $this->input->post('password');
		if ($email == '' || $password == '') {
			$this->msg = array('status' => false, 'message' => 'Payload empty', 'data' => null);
		} else {
			$data = array('USER_EMAIL' => $email, 'USER_PASSWORD' => $password);
			if ( $do = $this->API->Auth($data)) {
				$arr = array('login' => true, 'session' => $email, 'name' => $do->name, 'id' => $do->idadmin);
				$this->session->set_userdata($arr);
				$this->msg = array('status' => true, 'message' => 'User logged', 'data' => $do);
			} else {
				$this->msg = array('login' => false, 'message' => 'Internal server error', 'data' => null);
			}
		}
		echo json_encode($this->msg);
    }
}

/* End of file API.php */
