<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include(dirname(__FILE__).'/Base.php');

class Predikat extends Base {

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
