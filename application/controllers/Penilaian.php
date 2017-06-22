<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('general');
        $this->load->library('session');
        $this->load->model('penilaian_model');
    }

	public function penilaian_kesehatan()
	{
        $this->load->templated_view('penilaian_kesehatan/index',['content'=>'Penilaian Kesehatan ....']);
	}
}
