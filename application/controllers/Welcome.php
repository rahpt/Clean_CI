<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function index()
    {
        // $i = $this->Users->is_logged_in();
        $data = array(
            'is_logged_in' => $this->session->userdata('isUserLoggedIn')
        );

        $this->load->view('elements/header', $data);
        $this->load->view('welcome_message', $data);
        $this->load->view('elements/footer');
    }
}
