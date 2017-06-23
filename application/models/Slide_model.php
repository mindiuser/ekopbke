<?php
class Slide_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    function getSlideWeb() {
        $sql = 'SELECT *
            FROM dt_slide_web
            ORDER BY NAMA_FILE ASC';
        $q = $this->db->query($sql);
        return $q->result();
    }

    function getSlideWebByIde($ide) {
        $sql = 'SELECT *
            FROM dt_slide_web
            WHERE ID = ?
            ORDER BY NAMA_FILE ASC';
        $q = $this->db->query($sql,array($ide));
        return $q->result();
    }

    function addSlideWeb($id,$keterangan,$nama_file)
    {
        $sql = "INSERT INTO dt_slide_web (ID,KETERANGAN,NAMA_FILE,LOKASI) VALUES (?,?,?,?)";
        $lokasi = 'public/uploads/web/'.$nama_file;
        $status = $this->db->query($sql, array($id,$keterangan,$nama_file,$lokasi));
        if($status){
            return array($status,'Data telah ditambahkan');
        }
        else {
            return array($status, $this->db->error());
        }
    }

    function deleteSlideWeb($ide)
    {
        $sql = "DELETE FROM dt_slide_web WHERE ID = ?";
        return $this->db->query($sql,array($ide));
    }


    function getSlideMobile() {
        $sql = 'SELECT *
            FROM dt_slide_mobile
            ORDER BY NAMA_FILE ASC';
        $q = $this->db->query($sql);
        return $q->result();
    }

    function getSlideMobileByIde($ide) {
        $sql = 'SELECT *
            FROM dt_slide_mobile
            WHERE ID = ?
            ORDER BY NAMA_FILE ASC';
        $q = $this->db->query($sql,array($ide));
        return $q->result();
    }

    function addSlideMobile($id,$keterangan,$nama_file)
    {
        $sql = "INSERT INTO dt_slide_mobile (ID,KETERANGAN,NAMA_FILE,LOKASI) VALUES (?,?,?,?)";
        $lokasi = 'public/uploads/mobile/'.$nama_file;
        $status = $this->db->query($sql, array($id,$keterangan,$nama_file,$lokasi));
        if($status){
            return array($status,'Data telah ditambahkan');
        }
        else {
            return array($status, $this->db->error());
        }
    }

    function deleteSlideMobile($ide)
    {
        $sql = "DELETE FROM dt_slide_mobile WHERE ID = ?";
        return $this->db->query($sql,array($ide));
    }


}