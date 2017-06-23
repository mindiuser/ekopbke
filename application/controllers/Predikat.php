<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include(dirname(__FILE__).'/Base.php');

class Predikat extends Base
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('general');
        $this->load->library('session');
        $this->load->model('predikat_model');
    }

    public function kesehatan()
    {
        $this->load->templated_view('predikat/predikat_list');
    }

    public function kesehatan_data()
    {
        $dt = $this->predikat_model->getPredikat();
        if(!empty($dt)){
            foreach($dt as $row){
                $array [] = array(
                    $row->URUT,
                    $row->PREDIKAT,
                    $row->MIN,
                    $row->RMIN,
                    $row->MAKS,
                    $row->RMAKS,
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
        $predikat = trim($this->input->post('predikat'));
        $min = trim($this->input->post('min'));
        $rmin = trim($this->input->post('rmin'));
        $maks = trim($this->input->post('maks'));
        $rmaks = trim($this->input->post('rmaks'));
        list($status,$message) = $this->predikat_model->addPredikat($predikat,$min,$rmin,$maks,$rmaks);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }


    public function kesehatan_delete(){
        $urut = $this->input->post('kode');
        $status = $this->predikat_model->deletePredikat($urut);
        echo $status;
    }

    public function kesehatan_edit(){
        $urut = $this->input->post('kode');
        $predikat = trim($this->input->post('predikat'));
        $min = trim($this->input->post('min'));
        $rmin = trim($this->input->post('rmin'));
        $maks = trim($this->input->post('maks'));
        $rmaks = trim($this->input->post('rmaks'));
        list($status,$message) = $this->predikat_model->editPredikat($urut,$predikat,$min,$rmin,$maks,$rmaks);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }




}