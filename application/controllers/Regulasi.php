<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include(dirname(__FILE__).'/Base.php');

class Regulasi extends Base
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('general');
        $this->load->library('session');
        $this->load->model('regulasi_model');
        $this->session->set_userdata('menu-active','menu-5');
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

    public function add(){
        $tema = trim($this->input->post('tema'));
        $keterangan = trim($this->input->post('keterangan'));
        $file = trim($this->input->post('file'));
        list($status,$message) = $this->regulasi_model->addRegulasi($tema,$keterangan,$file);
        echo json_encode(array('status'=>$status,'message'=>$message));
    }

    function upload_file() {
        //upload file
        $config['upload_path'] = 'public/uploads/regulasi';
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
                if (file_exists('public/uploads/regulasi/' . $new_name)) {
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

    public function delete(){
        $ide = $this->input->post('ide');
        $data = $this->regulasi_model->getRegulasiByIde($ide);
        $filename = $data[0]->NAMA_FILE;
        $status = $this->regulasi_model->deleteRegulasi($ide);
        if($status){
            $path = APPPATH.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR."regulasi".DIRECTORY_SEPARATOR.$filename;
            if(file_exists($path)){
                unlink($path);
            }
            //delete it
        }
        echo $status;
    }

    function view_file() {
        $data = [];
        $data['url'] = $this->input->get('myurl');
        $data['file'] = $this->input->get('filename');
        $this->load->view('regulasi/view_file',$data);
    }

}