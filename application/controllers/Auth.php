<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('general');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('auth_model');
    }

    public function login()
    {

        $this->load->public_templated_view('auth/login');
    }


    function do_login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if($this->form_validation->run() == FALSE)
        {
            redirect('login');
        }
        else
        {
            $result = $this->auth_model->checkLogin($this->input->post('username'),$this->input->post('password'));
            if(!empty($result) && count($result) == 1){
                $this->session;
                $this->session->set_userdata('name',$result[0]->NAMA);
                $this->session->set_userdata('logged_in',TRUE);
                $this->session->set_userdata('uid',$result[0]->UID);
                $this->session->set_userdata('cif',$result[0]->CIF);
                $this->session->set_userdata('jabatan',$result[0]->JABATAN);
                $this->session->set_userdata('bagian',$result[0]->BAGIAN);
                $this->session->set_userdata('menu-active','');
                redirect('welcome');
            }
            else {
                redirect('login');
            }
        }

    }

    function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect('/login/');
    }

    function update_password(){
        $this->load->templated_view('auth/change_password');
    }

    function do_update_password()
    {
        $username = $this->session->userdata('name');
        $pwd_current = $this->input->post('lama');
        $pwd_new = $this->input->post('baru');
        list($status,$message) = $this->auth_model->updatePassword($username,$pwd_current,$pwd_new);
        echo json_encode(array('status'=>$status,'message'=>$message));

    }


}
