<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regulasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('general');
        $this->load->library('session');
        $this->load->model('regulasi_model');
    }

    public function regulasi_acuan()
    {
        $this->load->templated_view('regulasi/regulasi_list');
    }

    public function regulasi_acuan_data()
    {
        $dt = $this->regulasi_model->getRegulasi();
        if(!empty($dt)){
            foreach($dt as $row){
                $array [] = array(
                    $row->IDE,
                    $row->TEMA,
                    $row->KETERANGAN,
                    $row->NAMA_FILE,
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
}