<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include(dirname(__FILE__).'/Base.php');

class Penilaian extends Base
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('general');
        $this->load->library('session');
        $this->load->model('penilaian_model');
    }

    public function kesehatan()
    {
        $this->load->templated_view('penilaian/kesehatan_list');
    }

    public function kesehatan_data()
    {
        $dt = $this->penilaian_model->getPenilaian();
        if(!empty($dt)){
            foreach($dt as $row){
                $array [] = array(
                    $row->KODE,
                    $row->ASPEK,
                    $row->BOBOT_ASPEK,
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

    public function kesehatan_add(){
        $id = trim($this->input->post('kode'));
        $aspek = trim($this->input->post('aspek'));
        $bobot = trim($this->input->post('bobot'));
        list($status,$message) = $this->penilaian_model->addPenilaian($id,$aspek,$bobot);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }


    public function kesehatan_delete(){
        $id = $this->input->post('kode');
        $status = $this->penilaian_model->deletePenilaian($id);
        echo $status;
    }

    public function kesehatan_edit(){
        $id = trim($this->input->post('kode'));
        $aspek = trim($this->input->post('aspek'));
        $bobot = trim($this->input->post('bobot'));
        list($status,$message) = $this->penilaian_model->editPenilaian($id,$aspek,$bobot);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }




}