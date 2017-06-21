<?php
class Wilayah_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    function getPropinsi() {
        $sql = 'SELECT *
            FROM dt_propinsi
            ORDER BY NAMA_PROPINSI ASC';
        $q = $this->db->query($sql);
        return $q->result();
    }

    function getKabupaten($propinsi='') {
        $sql = 'SELECT ID_PROP,ID_KAB, RES,NAMA_KABUPATEN,IBUKOTA
            FROM dt_kabupaten ';
        if($propinsi != '')
            $sql .= 'WHERE ID_PROP = '.$propinsi.' ';
        $sql .= 'ORDER BY NAMA_KABUPATEN ASC';
        $q = $this->db->query($sql);
        return $q->result();
    }

    function getKecamatan($kabupaten='') {
        $sql = 'SELECT *
            FROM dt_kecamatan ';
            if($kabupaten != '')
              $sql .= 'WHERE ID_KAB = '.$kabupaten.' ';
            $sql .='ORDER BY NAMA_KECAMATAN ASC';
        $q = $this->db->query($sql);
        return $q->result();
    }

    function getKelurahan($kecamatan='') {
        $sql = 'SELECT *
            FROM dt_kelurahan ';
            if($kecamatan != '')
              $sql .= 'WHERE ID_KEC = "'.$kecamatan.'" ';
            $sql .='ORDER BY NAMA_KELURAHAN ASC';
        $q = $this->db->query($sql);
        return $q->result();
    }

    function getKodepos($propinsi='',$kabupaten='',$kecamatan='', $kelurahan='') {
        $sql = 'SELECT * FROM dt_kodepos ';
        if($propinsi != '')
        $sql .= 'WHERE NAMA_PROPINSI = '.$propinsi.' ';
        if($kabupaten != '')
        $sql .= 'AND NAMA_KABUPATEN like "%'.$kabupaten.'%" ';
        if($kecamatan != '')
        $sql .= 'AND NAMA_KECATAMAN = '.$kecamatan.' ';
        if($kelurahan != '')
            $sql .= 'AND NAMA_KELURAHAN = '.$kecamatan.' ';

        $sql .= 'ORDER BY ID_KODE ASC ';
        $q = $this->db->query($sql);
        return $q->result();
    }



}
?>