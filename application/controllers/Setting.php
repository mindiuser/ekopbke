<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('general');
        $this->load->library('session');
        $this->load->model('setting_model');
    }

    public function bagian()
    {
        $this->load->templated_view('setting/bagian_list');
    }

    public function bagian_data()
    {
        $dt = $this->setting_model->getBagian();
        if(!empty($dt)){
            foreach($dt as $row){
                $array [] = array(
                    $row->URUT,
                    $row->BAGIAN,
                    ''
                );
            }
            $data = array('data'=>$array);
        }
        else {
            $data=array('data'=>[]);
        }
        echo json_encode($data);

    }

    public function bagian_add(){
        $urut = trim($this->input->post('urut'));
        $bagian = trim($this->input->post('bagian'));
        list($status,$message) = $this->setting_model->addBagian($urut,$bagian);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }

    public function bagian_edit(){
        $urut = trim($this->input->post('urut'));
        $bagian = trim($this->input->post('bagian'));
        $urut_old = trim($this->input->post('urut_old'));
        $bagian_old = trim($this->input->post('bagian_old'));
        list($status,$message) = $this->setting_model->editBagian($urut,$bagian,$urut_old,$bagian_old);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }

    public function bagian_delete(){
        $urut = $this->input->post('urut');
        $bagian = $this->input->post('bagian');
        $status = $this->setting_model->deleteBagian($urut,$bagian);
        echo $status;
    }

    public function jabatan()
    {
        $data = [];
        $data['bagian'] = $this->setting_model->getBagian();
        $this->load->templated_view('setting/jabatan_list', $data);
    }

    public function jabatan_data()
    {
        if($this->input->post('bagian')){
            $bagian = trim($this->input->post('bagian'));
            $dt = $this->setting_model->getJabatan($bagian);
            if(!empty($dt)){
                foreach($dt as $row){
                    $array [] = array(
                        $row->URUT,
                        $row->JABATAN,
                        $row->BAGIAN,
                    );
                }
                $data = array('data'=>$array);
            }
            else {
                $data=array('data'=>[]);
            }
            echo json_encode($data);
        }
        else {
            $data=array('data'=>[]);
            echo json_encode($data);
        }

    }

    public function jabatan_add(){
        $bagian = trim($this->input->post('bagian'));
        $urut = trim($this->input->post('urut'));
        $jabatan = trim($this->input->post('jabatan'));
        list($status,$message) = $this->setting_model->addJabatan($bagian,$urut,$jabatan);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }

    public function jabatan_edit(){
        $bagian = trim($this->input->post('bagian'));
        $urut = trim($this->input->post('urut'));
        $jabatan = trim($this->input->post('jabatan'));
        $urut_old = trim($this->input->post('urut_old'));
        $jabatan_old = trim($this->input->post('jabatan_old'));
        list($status,$message) = $this->setting_model->editJabatan($bagian,$urut,$jabatan,$urut_old,$jabatan_old);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }

    public function jabatan_delete(){
        $urut = $this->input->post('urut');
        $bagian = $this->input->post('bagian');
        $jabatan = $this->input->post('jabatan');
        $status = $this->setting_model->deleteJabatan($urut,$bagian,$jabatan);
        echo $status;
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