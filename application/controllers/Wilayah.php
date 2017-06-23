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
        $this->load->templated_view('wilayah/propinsi_list', $data);
    }

    public function propinsi_data()
    {
        $dt = $this->wilayah_model->getPropinsi();
        if(!empty($dt)){
            foreach($dt as $row){
                $array [] = array(
                    $row->ID_PROP,
                    $row->NAMA_PROPINSI,
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

    public function propinsi_add(){
        $id_prop = trim($this->input->post('id_prop'));
        $propinsi = trim($this->input->post('propinsi'));
        list($status,$message) = $this->wilayah_model->addPropinsi($id_prop,$propinsi);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }

    public function propinsi_delete(){
        $id = $this->input->post('id_prop');
        $propinsi = $this->input->post('propinsi');
        $status = $this->wilayah_model->deletePropinsi($id,$propinsi);
        echo $status;
    }

    public function propinsi_edit(){
        $id = trim($this->input->post('id'));
        $propinsi = trim($this->input->post('propinsi'));
        $id_old = trim($this->input->post('id_old'));
        $propinsi_old = trim($this->input->post('propinsi_old'));
        list($status,$message) = $this->wilayah_model->editPropinsi($id,$propinsi,$id_old,$propinsi_old);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }


    public function kabupaten()
    {
        $data = [];
        $data['propinsi'] = $this->wilayah_model->getPropinsi();
        $this->load->templated_view('wilayah/kabupaten_list', $data);
    }

    public function kabupaten_data()
    {
        $propinsi = ($this->input->post('propinsi'))?$this->input->post('propinsi'):'';
        $dt = $this->wilayah_model->getKabupaten($propinsi);
        if(!empty($dt)){
            foreach($dt as $row){
                $array [] = array(
                    $row->ID_KAB,
                    $row->NAMA_KABUPATEN,
                    $row->RES,
                    $row->IBUKOTA,
                    $row->ID_PROP,
                );
            }
            $data = array('data'=>$array);
        }
        else {
            $data=array('data'=>[]);
        }
        echo json_encode($data);
    }

    public function kabupaten_add(){
        //id_prop:id_prop,id_kab:id_kab,res:res,kabupaten:kabupaten,ibukota:ibukota
        $id_prop = trim($this->input->post('id_prop'));
        $id_kab = trim($this->input->post('id_kab'));
        $res = trim($this->input->post('res'));
        $kabupaten = trim($this->input->post('kabupaten'));
        $ibukota = trim($this->input->post('ibukota'));
        list($status,$message) = $this->wilayah_model->addKabupaten($id_prop,$id_kab,$res,$kabupaten,$ibukota);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }

    public function kabupaten_delete(){
        $id_prop = $this->input->post('id_prop');
        $id_kab = $this->input->post('id_kab');
        $status = $this->wilayah_model->deleteKabupaten($id_prop,$id_kab);
        echo $status;
    }

    public function kabupaten_edit(){
        $id_prop = trim($this->input->post('id_prop'));
        $id_kab = trim($this->input->post('id_kab'));
        $res = trim($this->input->post('res'));
        $kabupaten = trim($this->input->post('kabupaten'));
        $ibukota = trim($this->input->post('ibukota'));
        list($status,$message) = $this->wilayah_model->editKabupaten($id_prop,$id_kab,$res,$kabupaten,$ibukota);
        echo json_encode(array('status'=>$status,'message'=>$message));
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
