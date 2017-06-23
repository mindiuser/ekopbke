<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include(dirname(__FILE__).'/Base.php');

class Slide extends Base
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('general');
        $this->load->library('session');
        $this->load->model('slide_model');
    }

    public function web()
    {
        $this->load->templated_view('slide/slideweb_list');
    }

    public function web_data()
    {
        $dt = $this->slide_model->getSlideWeb();
        if(!empty($dt)){
            foreach($dt as $row){
                $array [] = array(
                    $row->ID,
                    $row->KETERANGAN,
                    $row->NAMA_FILE,
                    $row->LOKASI,
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

    public function web_add(){
        $id = trim($this->input->post('id'));
        $keterangan = trim($this->input->post('keterangan'));
        $file = trim($this->input->post('file'));
        list($status,$message) = $this->slide_model->addSlideWeb($id,$keterangan,$file);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }

    function web_upload_file() {
        //upload file
        $config['upload_path'] = 'public/uploads/web';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = FALSE;
        $config['max_size'] = '3024'; //3 MB
        $new_name =  str_replace(' ', '_', $_FILES['file']['name']);
        $new_name =  str_replace('&','_', $new_name);
        $config['file_name'] = $new_name;
        $msg = '';
        if (isset($_FILES['file']['name'])) {
            if (0 < $_FILES['file']['error']) {
                $msg = 'Error during file upload' . $_FILES['file']['error'];
            } else {
                if (file_exists('public/uploads/web/' . $new_name)) {
                    $msg = 'File already exists : ' . $_FILES['file']['name'];
                } else {
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('file')) {
                        $msg = $this->upload->display_errors();
                    } else {
                        $msg = '';
                    }
                }
            }
        } else {
            $msg = 'Please choose a file';
        }
        if($msg == ''){
            echo json_encode(['status'=>true,'message'=>"Sukses",'file_name'=>$new_name]);
        }
        else {
            echo json_encode(['status'=>false,'message'=>$msg]);
        }
    }

    public function web_delete(){
        $id = $this->input->post('ide');
        $data = $this->slide_model->getSlideWebByIde($id);
        $status = $this->slide_model->deleteSlideWeb($id);
        if($status){
            $filename = $data[0]->NAMA_FILE;
            $path = APPPATH.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR."web".DIRECTORY_SEPARATOR.$filename;
            if(file_exists($path)){
                unlink($path);
            }
            //delete it
        }
        echo $status;
    }




















    public function mobile()
    {
        $this->load->templated_view('slide/slidemobile_list');
    }

    public function mobile_data()
    {
        $dt = $this->slide_model->getSlideMobile();
        if(!empty($dt)){
            foreach($dt as $row){
                $array [] = array(
                    $row->ID,
                    $row->KETERANGAN,
                    $row->NAMA_FILE,
                    $row->LOKASI,
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

    public function mobile_add(){
        $id = trim($this->input->post('id'));
        $keterangan = trim($this->input->post('keterangan'));
        $file = trim($this->input->post('file'));
        list($status,$message) = $this->slide_model->addSlideMobile($id,$keterangan,$file);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }

    function mobile_upload_file() {
        //upload file
        $config['upload_path'] = 'public/uploads/mobile';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = FALSE;
        $config['max_size'] = '3024'; //3 MB
        $new_name =  str_replace(' ', '_', $_FILES['file']['name']);
        $new_name =  str_replace('&','_', $new_name);
        $config['file_name'] = $new_name;
        $msg = '';
        if (isset($_FILES['file']['name'])) {
            if (0 < $_FILES['file']['error']) {
                $msg = 'Error during file upload' . $_FILES['file']['error'];
            } else {
                if (file_exists('public/uploads/mobile/' . $new_name)) {
                    $msg = 'File already exists : ' . $_FILES['file']['name'];
                } else {
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('file')) {
                        $msg = $this->upload->display_errors();
                    } else {
                        $msg = '';
                    }
                }
            }
        } else {
            $msg = 'Please choose a file';
        }
        if($msg == ''){
            echo json_encode(['status'=>true,'message'=>"Sukses",'file_name'=>$new_name]);
        }
        else {
            echo json_encode(['status'=>false,'message'=>$msg]);
        }
    }

    public function mobile_delete(){
        $id = $this->input->post('ide');
        $data = $this->slide_model->getSlideMobileByIde($id);
        $status = $this->slide_model->deleteSlideMobile($id);
        if($status){
            $filename = $data[0]->NAMA_FILE;
            $path = APPPATH.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR."mobile".DIRECTORY_SEPARATOR.$filename;
            if(file_exists($path)){
                unlink($path);
            }
            //delete it
        }
        echo $status;
    }















}