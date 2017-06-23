<?php
class Predikat_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('kesehatan', TRUE);
    }

    function getPredikat() {
        $sql = 'SELECT *
            FROM dt_nilai_kesehatan
            ORDER BY URUT ASC';
        $q = $this->db->query($sql);
        return $q->result();
    }

    function addPredikat($predikat,$min,$rmin,$maks,$rmaks)
    {
        $sql = "INSERT INTO dt_nilai_kesehatan (PREDIKAT,MIN,RMIN,MAKS,RMAKS) VALUES (?,?,?,?,?)";
        $status = $this->db->query($sql, array($predikat,$min,$rmin,$maks,$rmaks));
        if($status){
            return array($status,'Data telah ditambahkan');
        }
        else {
            return array($status, $this->db->error());
        }
    }

    function deletePredikat($urut)
    {
        $sql = "DELETE FROM dt_nilai_kesehatan WHERE URUT = ?";
        return $this->db->query($sql,array($urut));
    }


    function editPredikat($urut,$predikat,$min,$rmin,$maks,$rmaks)
    {
        $sql = "UPDATE dt_nilai_kesehatan SET PREDIKAT = ?,MIN = ?,RMIN = ?,MAKS = ? ,RMAKS = ? WHERE URUT = ?";
        $status = $this->db->query($sql, array($predikat,$min,$rmin,$maks,$rmaks,$urut));
        if($status){
            return array($status,'Data telah diedit');
        }
        else {
            return array($status, $this->db->error());
        }

    }




}