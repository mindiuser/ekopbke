<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyPage extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('general');
    }

    public function my404()
    {
        $this->output->set_status_header('404');
        $this->load->view('errors/my404');//loading in custom error view
    }

}
