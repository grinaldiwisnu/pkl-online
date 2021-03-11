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

}

/* End of file Auth.php */
