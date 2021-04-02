<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login')) {
            redirect('home','refresh');
        }
    }

    public function index()
    {
        $data = array(
          'title' => "Masuk"
        );
		$this->load->view('dist/auth-login', $data);
    }

    public function register()
    {
        $data = array(
          'title' => "Mendaftar"
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
