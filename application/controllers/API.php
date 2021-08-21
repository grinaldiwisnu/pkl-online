<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class API extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('API_Model', 'API');
		$this->output->set_content_type('application/json');
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
			$this->msg = array('status' => false, 'message' => 'Email/password kosong', 'data' => null);
		} else {
			if ( $do = $this->API->Auth(array('USER_EMAIL' => $email, 'USER_PASSWORD' => $password))) {
				$arr = array('login' => true, 'session' => $email, 'name' => $do->USER_FULLNAME, 'id' => $do->USER_ID);
				$this->session->set_userdata($arr);
				$this->msg = array('status' => true, 'message' => 'Login berhasil, mengarahkan ke dashboard ...', 'data' => $do);
			} else if ($do = $this->API->AuthAdmin(array('ADMIN_EMAIL' => $email, 'ADMIN_PASSWORD' => $password))) {
				$arr = array('login' => true, 'admin' => true, 'session' => $email, 'name' => $do->ADMIN_NAME, 'id' => $do->ADMIN_ID, 'data' => $do);
				$this->session->set_userdata($arr);
				$this->msg = array('status' => true, 'message' => 'Login berhasil, mengarahkan ke dashboard ...', 'data' => $do);
			} else {
				$this->msg = array('status' => false, 'message' => 'Email/password salah', 'data' => null);
			}
		}
		echo json_encode($this->msg);
    }

	public function registerAPI()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$phone = $this->input->post('phone');
		$institution = $this->input->post('institution');

		if ($email == '' || $password == '' || $name == '' || $phone == '' || $institution == '') {
			$this->msg = array('status' => false, 'message' => 'Data registrasi masih kosong', 'data' => null);
		} else {
			if ($this->API->checkEmail($email)) {
				$this->msg = array('status' => false, 'message' => 'Email sudah digunakan', 'data' => null);
			} else {
				$data = array(
					'USER_FULLNAME' => $name,
					'USER_EMAIL' => $email, 
					'USER_PASSWORD' => $password,
					'USER_PHONE' => $phone,
					'USER_STATUS' => 10,
					'INSTITUTION_ID' => $institution,
				);
	
				if ( $do = $this->API->Register($data)) {
					$this->msg = array('status' => true, 'message' => 'User created', 'data' => $data);
				} else {
					$this->msg = array('status' => false, 'message' => 'Internal server error', 'data' => null);
				}
			}
			
		}

		echo json_encode($this->msg);
	}

	public function getInstitutionAPI()
	{
		$result = $this->API->getAllInstitution();

		$this->msg = array('status' => true, 'message' => 'get Institution success', 'data' => $result);

		echo json_encode($this->msg);
	}

	public function getJobsAPI()
	{
		$result = $this->API->get('JOB');

		$this->msg = array('status' => true, 'message' => 'get Jobs success', 'data' => $result);

		echo json_encode($this->msg);
	}
}

/* End of file API.php */
