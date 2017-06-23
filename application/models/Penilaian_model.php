<?php
class Penilaian_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('kesehatan', TRUE);
    }

    function getPenilaian() {
        $sql = 'SELECT *
            FROM dt_nilai_aspek
            ORDER BY ASPEK ASC';
        $q = $this->db->query($sql);
        return $q->result();
    }

    function addPenilaian($kode,$aspek,$bobot)
    {
        $sql = "INSERT INTO dt_nilai_aspek (KODE,ASPEK,BOBOT_ASPEK) VALUES (?,?,?)";
        $status = $this->db->query($sql, array($kode,$aspek,$bobot));
        if($status){
            return array($status,'Data telah ditambahkan');
        }
        else {
            return array($status, $this->db->error());
        }
    }

    function deletePenilaian($kode)
    {
        $sql = "DELETE FROM dt_nilai_aspek WHERE KODE = ?";
        return $this->db->query($sql,array($kode));
    }


    function editPenilaian($kode,$aspek,$bobot)
    {
        $sql = "UPDATE dt_nilai_aspek SET ASPEK = ?, BOBOT_ASPEK = ? WHERE KODE = ?";
        $status = $this->db->query($sql, array($aspek,$bobot,$kode));
        if($status){
            return array($status,'Data telah diedit');
        }
        else {
            return array($status, $this->db->error());
        }

    }




}