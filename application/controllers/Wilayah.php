<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include(dirname(__FILE__).'/Base.php');
class Wilayah extends Base
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('general');
        $this->load->library('session');
        $this->load->model('wilayah_model');
        $this->session->set_userdata('menu-active','menu-3');
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
                $options .='<li><a href="#" class="select-kabupaten" res="'.$row->RES.'" id="'.$row->ID_KAB.'" label="'.$row->NAMA_KABUPATEN.'">'.$row->NAMA_KABUPATEN.'</a></li>';
            }
        }
        echo $options;
    }

    public function filter_kabupaten_modal(){
        $propinsi = $this->input->post('propinsi');
        $kabs = $this->wilayah_model->getKabupaten($propinsi);
        $options ='<option value="">PILIH KABUPATEN</option>';
        if(!empty($kabs)){
            foreach($kabs as $row){
                $options .='<option value="'.$row->ID_KAB.'" res="'.$row->RES.'">'.$row->RES.'-'.$row->NAMA_KABUPATEN.'</option>';
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


    public function kecamatan_data()
    {
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
                        $row->ID_KAB
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

    public function kecamatan_detail()
    {
        $array = [];
        $id_kec = $this->input->post('id_kec');
        if($id_kec){
            $dt = $this->wilayah_model->getKecamatanById($id_kec);
            if(!empty($dt)){
                $array [] = array(
                    'id_kab'=>$dt[0]->ID_KAB,
                    'kabupaten'=>$dt[0]->NAMA_KABUPATEN,
                    'id_kec'=>$dt[0]->ID_KEC,
                    'kecamatan'=>$dt[0]->NAMA_KECAMATAN,
                    'kodepos'=>$dt[0]->KODEPOS,
                    'keterangan'=>$dt[0]->KET,
                );
            }
            $data = array('data'=>$array);
        }
        else {
            $data=array('data'=>[]);
        }
        echo json_encode($data);
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

    public function filter_kecamatan_modal(){
        $kabupaten = $this->input->post('kabupaten');
        $kecs = $this->wilayah_model->getKecamatan($kabupaten);
        $options ='<option value="">PILIH KECAMATAN</option>';
        if(!empty($kecs)){
            foreach($kecs as $row){
                $options .='<option value="'.$row->ID_KEC.'">'.$row->NAMA_KECAMATAN.'</option>';
            }
        }
        echo $options;
    }

    public function kecamatan_add(){
        $id_kab = trim($this->input->post('id_kab'));
        $id_kec = trim($this->input->post('id_kec'));
        $kecamatan = trim($this->input->post('kecamatan'));
        $kodepos = trim($this->input->post('kodepos'));
        $keterangan = trim($this->input->post('keterangan'));
        list($status,$message) = $this->wilayah_model->addKecamatan($id_kab,$id_kec,$kecamatan,$kodepos,$keterangan);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }

    public function kecamatan_delete(){
        $id_kec = $this->input->post('id_kec');
        $status = $this->wilayah_model->deleteKecamatan($id_kec);
        echo $status;
    }

    public function kecamatan_edit(){
        $id_kab = trim($this->input->post('id_kab'));
        $id_kec = trim($this->input->post('id_kec'));
        $kecamatan = trim($this->input->post('kecamatan'));
        $kodepos = trim($this->input->post('kodepos'));
        $keterangan = trim($this->input->post('keterangan'));
        list($status,$message) = $this->wilayah_model->editKecamatan($id_kab,$id_kec,$kecamatan,$kodepos,$keterangan);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }

    public function kelurahan()
    {
        $data = [];
        $data['propinsi'] = $this->wilayah_model->getPropinsi();
        $data['kabupaten'] = [];
        $data['kecamatan'] = [];
        $this->load->templated_view('wilayah/kelurahan_list', $data);
    }

    public function kelurahan_data()
    {
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
                        $row->ID_KEC
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

    public function kelurahan_add(){
        $id_kec = trim($this->input->post('id_kec'));
        $id_kel = trim($this->input->post('id_kel'));
        $kelurahan = trim($this->input->post('kelurahan'));
        $kodepos = trim($this->input->post('kodepos'));
        $longitude = trim($this->input->post('longitude'));
        $lattitude = trim($this->input->post('lattitude'));
        list($status,$message) = $this->wilayah_model->addKelurahan($id_kec,$id_kel,$kelurahan,$kodepos,$longitude,$lattitude);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }

    public function kelurahan_delete(){
        $id_kel = $this->input->post('id_kel');
        $status = $this->wilayah_model->deleteKelurahan($id_kel);
        echo $status;
    }

    public function kelurahan_detail()
    {
        $array = [];
        $id_kel = $this->input->post('id_kel');
        if($id_kel){
            $dt = $this->wilayah_model->getKelurahanById($id_kel);
            if(!empty($dt)){
                $array [] = array(
                    'id_prop'=>$dt[0]->ID_PROP,
                    'propinsi'=>$dt[0]->NAMA_PROPINSI,
                    'id_kab'=>$dt[0]->ID_KAB,
                    'kabupaten'=>$dt[0]->NAMA_KABUPATEN,
                    'id_kec'=>$dt[0]->ID_KEC,
                    'kecamatan'=>$dt[0]->NAMA_KECAMATAN,
                    'id_kel'=>$dt[0]->ID_KEL,
                    'kelurahan'=>$dt[0]->NAMA_KELURAHAN,
                    'kodepos'=>$dt[0]->KODEPOS,
                    'longitude'=>$dt[0]->LONGITUDE,
                    'lattitude'=>$dt[0]->LATTITUDE
                );
            }
            $data = array('data'=>$array);
        }
        else {
            $data=array('data'=>[]);
        }
        echo json_encode($data);
    }

    public function kelurahan_edit(){
        $id_kec = trim($this->input->post('id_kec'));
        $id_kel = trim($this->input->post('id_kel'));
        $kelurahan = trim($this->input->post('kelurahan'));
        $kodepos = trim($this->input->post('kodepos'));
        $longitude = trim($this->input->post('longitude'));
        $lattitude = trim($this->input->post('lattitude'));
        list($status,$message) = $this->wilayah_model->editKelurahan($id_kec,$id_kel,$kelurahan,$kodepos,$longitude,$lattitude);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }

    public function filter_kelurahan_modal(){
        $kecamatan = $this->input->post('kecamatan');
        $kels = $this->wilayah_model->getKelurahan($kecamatan);
        $options ='<option value="">PILIH KELURAHAN</option>';
        if(!empty($kels)){
            foreach($kels as $row){
                $options .='<option value="'.$row->ID_KEL.'">'.$row->NAMA_KELURAHAN.'</option>';
            }
        }
        echo $options;
    }

    public function kodepos()
    {
        $data = [];
        $data['propinsi'] = $this->wilayah_model->getPropinsi();
        $data['kabupaten'] = [];
        $data['kecamatan'] = [];
        $this->load->templated_view('wilayah/kodepos_list', $data);
    }

    public function kodepos_data()
    {
        $array = [];
        $propinsi = $this->input->post('propinsi');
        $kabupaten = $this->input->post('kabupaten');
        $kecamatan = $this->input->post('kecamatan');
        if($kecamatan){
            $dt = $this->wilayah_model->getKodepos($propinsi,$kabupaten,$kecamatan);
            if(!empty($dt)){
                foreach($dt as $row){
                    $array [] = array(
                        $row->ID_KEL,
                        $row->NAMA_KELURAHAN,
                        $row->ID_KODE,
                        $row->NAMA_KECAMATAN,
                        $row->RES,
                        $row->NAMA_KABUPATEN,
                        $row->NAMA_PROPINSI,
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

    public function kodepos_add(){
        $prop = trim($this->input->post('prop'));
        $res = trim($this->input->post('res'));
        $kab = trim($this->input->post('kab'));
        $kec = trim($this->input->post('kec'));
        $id_kel = trim($this->input->post('id_kel'));
        $kelurahan = trim($this->input->post('kelurahan'));
        $kodepos = trim($this->input->post('kodepos'));
        list($status,$message) = $this->wilayah_model->addKodepos($prop,$res,$kab,$kec,$id_kel,$kelurahan,$kodepos);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }

    public function kodepos_delete(){
        $id_kode = $this->input->post('id_kode');
        $status = $this->wilayah_model->deleteKodepos($id_kode);
        echo $status;
    }

    public function kodepos_detail()
    {
        $array = [];
        $id_kode = $this->input->post('id_kode');
        if($id_kode){
            $dt = $this->wilayah_model->getKodeposById($id_kode);
            if(!empty($dt)){
                $array [] = array(
                    'prop'=>$dt[0]->NAMA_PROPINSI,
                    'res'=>$dt[0]->RES,
                    'kab'=>$dt[0]->NAMA_KABUPATEN,
                    'kec'=>$dt[0]->NAMA_KECAMATAN,
                    'id_kel'=>$dt[0]->ID_KEL,
                    'kel'=>$dt[0]->NAMA_KELURAHAN,
                    'kodepos'=>$dt[0]->ID_KODE
                );
            }
            $data = array('data'=>$array);
        }
        else {
            $data=array('data'=>[]);
        }
        echo json_encode($data);
    }

    public function kodepos_edit(){
        $kodepos_old = trim($this->input->post('kodepos_old'));
        $kodepos = trim($this->input->post('kodepos'));
        $kelurahan = trim($this->input->post('kelurahan'));
        list($status,$message) = $this->wilayah_model->editKodepos($kodepos_old,$kodepos,$kelurahan);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }


}
