<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('setting_model');
    }

    public function bagian()
    {
        $data = [];
        $data['data'] = $this->setting_model->getBagian();
        $this->load->templated_view('setting/bagian_list', $data);
    }

    public function jabatan()
    {
        $data = [];
        $data['data'] = $this->setting_model->getJabatan();
        $this->load->templated_view('setting/jabatan_list', $data);
    }

    public function profile()
    {
        $data = [];
        $data['data'] = $this->setting_model->getUsers();
        $this->load->templated_view('setting/user_list', $data);
    }

    public function log()
    {
        $data = [];
        //$data['data'] = $this->setting_model->getLog();
        $this->load->templated_view('setting/log_list', $data);
    }

}
