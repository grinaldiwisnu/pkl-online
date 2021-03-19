<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function index()
    {
        $data = array(
			'title' => "Login"
		);
		$this->load->view('dist/auth-login', $data);
    }

    public function register()
    {
        $data = array(
			'title' => "Login"
		);
		$this->load->view('dist/auth-register', $data);
    }

    public function forgotPassword()
    {
        $data = array(
			'title' => "Forgot Password"
		);
		$this->load->view('dist/auth-forgot-password', $data);
    }
}

/* End of file Auth.php */
