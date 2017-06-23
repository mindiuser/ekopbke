<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $logged_in = $this->session->userdata('logged_in');
        if($logged_in == FALSE) {
            $this->session;
            $this->session->set_userdata('firsturl',$_SERVER['REQUEST_URI']);
            redirect('login');
        }
    }

}
