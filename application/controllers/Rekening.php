<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include(dirname(__FILE__).'/Base.php');

class Rekening extends Base
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('general');
        $this->load->library('session');
        $this->load->model('rekening_model');
        $this->session->set_userdata('menu-active','menu-4');
    }

    public function jenis_rekening()
    {
        $this->load->templated_view('rekening/jenis_rekening_list');
    }

    public function jenis_rekening_data()
    {
        $dt = $this->rekening_model->getJenisRekening();
        if(!empty($dt)){
            foreach($dt as $row){
                $array [] = array(
                    $row->ACCJENIS,
                    $row->JENIS
                );
            }
            $data = array('data'=>$array);
        }
        else {
            $data=array('data'=>[]);
        }
        echo json_encode($data);

    }

    public function kelompok_rekening()
    {
        $data = [];
        $data['jenis'] = $this->rekening_model->getJenisRekening();
        $this->load->templated_view('rekening/kelompok_rekening_list',$data);
    }

    public function kelompok_rekening_data()
    {
        $jenis = $this->input->post('jenis_rekening');
        $dt = $this->rekening_model->getKelompokRekening($jenis);
        if(!empty($dt)){
            foreach($dt as $row){
                $array [] = array(
                    $row->ACCKEL,
                    $row->KELOMPOK,
                    $row->GOL,
                    $row->SUBGOL
                );
            }
            $data = array('data'=>$array);
        }
        else {
            $data=array('data'=>[]);
        }
        echo json_encode($data);

    }

    public function buku_besar()
    {
        $data = [];
        $data['jenis'] = $this->rekening_model->getJenisRekening();
        $this->load->templated_view('rekening/buku_besar_list',$data);
    }

    public function buku_besar_data()
    {
        $kelompok = ($this->input->post('kelompok'))?$this->input->post('kelompok'):'';
        $dt = $this->rekening_model->getBukuBesarRekening($kelompok);
        if(!empty($dt)){
            foreach($dt as $row){
                $array [] = array(
                    $row->ACCBB,
                    $row->BUKUBESAR,
                    $row->KATEGORI,
                    $row->GOLONGAN,
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

    public function filter_kelompok()
    {
        $jenis = $this->input->post('jenis_rekening');
        $dt = $this->rekening_model->getKelompokRekening($jenis);
        $options = '';
        if(!empty($dt)){
            foreach($dt as $row){
                $options .='<li><a href="#" class="select-kelompok" id="'.$row->ACCKEL.'" label="'.$row->KELOMPOK.'">'.$row->KELOMPOK.'</a></li>';
            }
        }
        echo $options;
    }

    public function filter_kelompok_modal()
    {
        $jenis = $this->input->post('jenis_rekening');
        $dt = $this->rekening_model->getKelompokRekening($jenis);
        $options ='<option value="">PILIH KELOMPOK</option>';
        if(!empty($dt)){
            foreach($dt as $row){
                $options .='<option value="'.$row->ACCKEL.'">'.$row->KELOMPOK.'</option>';
            }
        }
        echo $options;
    }

    public function buku_besar_add(){
        //kelompok:kelompok,accbb:accbb,bukubesar:bukubesar,kategori:kategori,golongan:golongan,resiko:resiko
        $kel = trim($this->input->post('kelompok'));
        $accbb = trim($this->input->post('accbb'));
        $bb = trim($this->input->post('bukubesar'));
        $kat = trim($this->input->post('kategori'));
        $gol = trim($this->input->post('golongan'));
        $res = trim($this->input->post('resiko'));
        list($status,$message) = $this->rekening_model->addBukubesar($kel,$accbb,$bb,$kat,$gol,$res);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }

    public function buku_besar_delete(){
        $accbb = $this->input->post('accbb');
        $status = $this->rekening_model->deleteBukubesar($accbb);
        echo $status;
    }

    public function buku_besar_detail()
    {
        $array = [];
        $accbb = $this->input->post('accbb');
        if($accbb){
            $dt = $this->rekening_model->getBukubesarById($accbb);
            if(!empty($dt)){
                $array [] = array(
                    'accjenis'=>$dt[0]->ACCJENIS,
                    'jenis'=>$dt[0]->JENIS,
                    'acckel'=>$dt[0]->ACCKEL,
                    'kel'=>$dt[0]->KELOMPOK,
                    'accbb'=>$dt[0]->ACCBB,
                    'bukubesar'=>$dt[0]->BUKUBESAR,
                    'kategori'=>$dt[0]->KATEGORI,
                    'golongan'=>$dt[0]->GOLONGAN,
                    'resiko'=>$dt[0]->RESIKO
                );
            }
            $data = array('data'=>$array);
        }
        else {
            $data=array('data'=>[]);
        }
        echo json_encode($data);
    }

    public function buku_besar_edit(){
        //kelompok:kelompok,accbb:accbb,bukubesar:bukubesar,kategori:kategori,golongan:golongan,resiko:resiko
        $kel = trim($this->input->post('kelompok'));
        $accbb = trim($this->input->post('accbb'));
        $bb = trim($this->input->post('bukubesar'));
        $kat = trim($this->input->post('kategori'));
        $gol = trim($this->input->post('golongan'));
        $res = trim($this->input->post('resiko'));
        list($status,$message) = $this->rekening_model->editBukubesar($kel,$accbb,$bb,$kat,$gol,$res);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }

    public function sub_buku_besar()
    {
        $data = [];
        $data['jenis'] = $this->rekening_model->getJenisRekening();
        $this->load->templated_view('rekening/sub_buku_besar_list',$data);
    }

    public function sub_buku_besar_data()
    {
        $buku_besar = ($this->input->post('buku_besar'))?$this->input->post('buku_besar'):'';
        $dt = $this->rekening_model->getSubBukuBesarRekening($buku_besar);
        if(!empty($dt)){
            foreach($dt as $row){
                $array [] = array(
                    $row->ACC,
                    $row->KETERANGAN,
                    $row->GOLONGAN,
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

    public function filter_buku_besar()
    {
        $kelompok = ($this->input->post('kelompok'))?$this->input->post('kelompok'):'';
        $dt = $this->rekening_model->getBukuBesarRekening($kelompok);
        $options = '';
        if(!empty($dt)){
            foreach($dt as $row){
                $options .='<li><a href="#" class="select-bukubesar" id="'.$row->ACCBB.'" label="'.$row->BUKUBESAR.'">'.$row->BUKUBESAR.'</a></li>';
            }
        }
        echo $options;
    }

    public function filter_buku_besar_modal()
    {
        $kelompok = ($this->input->post('kelompok'))?$this->input->post('kelompok'):'';
        $dt = $this->rekening_model->getBukuBesarRekening($kelompok);
        $options ='<option value="">PILIH BUKU BESAR</option>';
        if(!empty($dt)){
            foreach($dt as $row){
                $options .='<option value="'.$row->ACCBB.'">'.$row->BUKUBESAR.'</option>';
            }
        }
        echo $options;
    }

    public function sub_buku_besar_add(){
        $jenis = trim($this->input->post('jenis'));
        $kel = trim($this->input->post('kelompok'));
        $bb = trim($this->input->post('bukubesar'));
        $acc = trim($this->input->post('acc'));
        $ket = trim($this->input->post('keterangan'));
        $gol = trim($this->input->post('golongan'));
        $ku = trim($this->input->post('ku'));
        list($status,$message) = $this->rekening_model->addSubBukubesar($jenis,$kel,$bb,$acc,$ket,$gol,$ku);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }

    public function sub_buku_besar_delete(){
        $acc = $this->input->post('acc');
        $status = $this->rekening_model->deleteSubBukubesar($acc);
        echo $status;
    }

    public function sub_buku_besar_detail()
    {
        $array = [];
        $acc = $this->input->post('acc');
        if($acc){
            $dt = $this->rekening_model->getSubBukubesarById($acc);
            if(!empty($dt)){
                $array [] = array(
                    'accjenis'=>$dt[0]->ACCJENIS,
                    'jenis'=>$dt[0]->JENIS,
                    'acckel'=>$dt[0]->ACCKEL,
                    'kel'=>$dt[0]->KELOMPOK,
                    'accbb'=>$dt[0]->ACCBB,
                    'bb'=>$dt[0]->BUKUBESAR,
                    'acc'=>$dt[0]->ACC,
                    'keterangan'=>$dt[0]->KETERANGAN,
                    'golongan'=>$dt[0]->GOLONGAN,
                    'ku'=>$dt[0]->KU
                );
            }
            $data = array('data'=>$array);
        }
        else {
            $data=array('data'=>[]);
        }
        echo json_encode($data);
    }

    public function sub_buku_besar_edit(){
        $jenis = trim($this->input->post('jenis'));
        $kel = trim($this->input->post('kelompok'));
        $bb = trim($this->input->post('bukubesar'));
        $acc = trim($this->input->post('acc'));
        $ket = trim($this->input->post('keterangan'));
        $gol = trim($this->input->post('golongan'));
        $ku = trim($this->input->post('ku'));
        list($status,$message) = $this->rekening_model->editSubBukubesar($jenis,$kel,$bb,$acc,$ket,$gol,$ku);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }



}