<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include(dirname(__FILE__).'/Base.php');

class Welcome extends Base {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

	public function index()
	{
        $this->load->templated_view('welcome/index',['content'=>'Welcome']);
	}
}
