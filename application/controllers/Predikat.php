<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Predikat extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('general');
        $this->load->library('session');
        $this->load->model('predikat_model');
    }

	public function predikat_kesehatan()
	{
        $this->load->templated_view('predikat_kesehatan/index',['content'=>'Predikat Kesehatan ....']);
	}
}
