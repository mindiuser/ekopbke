<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('general');
        $this->load->library('session');
        $this->load->model('rekening_model');
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
        //$this->output->enable_profiler(TRUE);
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
        //$this->output->enable_profiler(TRUE);
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
                $options .='<li><a href="#" class="select-buku-besar" id="'.$row->ACCBB.'" label="'.$row->BUKUBESAR.'">'.$row->BUKUBESAR.'</a></li>';
            }
        }
        echo $options;
    }



}