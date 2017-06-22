<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wilayah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('general');
        $this->load->library('session');
        $this->load->model('wilayah_model');
    }

    public function propinsi()
    {
        $data = [];
        $data['data'] = $this->wilayah_model->getPropinsi();
       // print_r($data);die;
        $this->load->templated_view('wilayah/propinsi_list', $data);
    }

    public function kabupaten()
    {
        $data = [];
        $data['propinsi'] = $this->wilayah_model->getPropinsi();
        $data['kabupaten'] = $this->wilayah_model->getKabupaten();

        $this->load->templated_view('wilayah/kabupaten_list', $data);
    }

    public function filter_kabupaten(){
        $propinsi = $this->input->post('propinsi');
        $kabs = $this->wilayah_model->getKabupaten($propinsi);
        $options = '';
        if(!empty($kabs)){
            foreach($kabs as $row){
                $options .='<li><a href="#" class="select-kabupaten" id="'.$row->ID_KAB.'" label="'.$row->NAMA_KABUPATEN.'">'.$row->NAMA_KABUPATEN.'</a></li>';
            }
        }
        echo $options;
    }

    public function ajax_kabupaten(){
        $array = [];
        $propinsi = $this->input->post('propinsi');
        if($propinsi){
            $dt = $this->wilayah_model->getKabupaten($propinsi);
            if(!empty($dt)){
                foreach($dt as $row){
                    $array [] = array(
                        $row->ID_KAB,
                        $row->RES,
                        $row->NAMA_KABUPATEN,
                        $row->IBUKOTA,
                        ''
                    );
                }
            }
            $data = array('data'=>$array);
        }
        else {
            $data=array('data'=>[]);
        }
        echo json_encode($data);
    }

    public function kecamatan()
    {
        $data = [];
        $data['propinsi'] = $this->wilayah_model->getPropinsi();
        $data['kabupaten'] = [];
        $data['kecamatan'] = $this->wilayah_model->getKecamatan();
        $this->load->templated_view('wilayah/kecamatan_list', $data);
    }

    public function filter_kecamatan(){
        $kabupaten = $this->input->post('kabupaten');
        $kecs = $this->wilayah_model->getKecamatan($kabupaten);
        $options = '';
        if(!empty($kecs)){
            foreach($kecs as $row){
                $options .='<li><a href="#" class="select-kecamatan" id="'.$row->ID_KEC.'" label="'.$row->NAMA_KECAMATAN.'">'.$row->NAMA_KECAMATAN.'</a></li>';
            }
        }
        echo $options;
    }

    public function ajax_kecamatan(){
        $array = [];
        $kabupaten = $this->input->post('kabupaten');
        if($kabupaten){
            $dt = $this->wilayah_model->getKecamatan($kabupaten);
            if(!empty($dt)){
                foreach($dt as $row){
                    $array [] = array(
                        $row->ID_KEC,
                        $row->NAMA_KECAMATAN,
                        $row->KET,
                        ''
                    );
                }
            }
            $data = array('data'=>$array);
        }
        else {
            $data=array('data'=>[]);
        }
        echo json_encode($data);
    }

    public function kelurahan()
    {
        $data = [];
        $data['propinsi'] = $this->wilayah_model->getPropinsi();
        $data['kabupaten'] = [];
        $data['kecamatan'] = [];
        $data['kelurahan'] =  $this->wilayah_model->getKelurahan();
        $this->load->templated_view('wilayah/kelurahan_list', $data);
    }

    public function ajax_kelurahan(){
        $array = [];
        $kecamatan = $this->input->post('kecamatan');
        if($kecamatan){
            $dt = $this->wilayah_model->getKelurahan($kecamatan);
            if(!empty($dt)){
                foreach($dt as $row){
                    $array [] = array(
                        $row->ID_KEL,
                        $row->NAMA_KELURAHAN,
                        $row->LONGITUDE,
                        $row->LATTITUDE,
                        ''
                    );
                }
            }
            $data = array('data'=>$array);
        }
        else {
            $data=array('data'=>[]);
        }
        echo json_encode($data);
    }

    public function kodepos()
    {
        $data = [];
        $data['propinsi'] = $this->wilayah_model->getPropinsi();
        $data['kabupaten'] = [];
        $data['kecamatan'] = [];
        $data['kodepos'] =  $this->wilayah_model->getKodepos();
        $this->load->templated_view('wilayah/kodepos_list', $data);
    }




}
