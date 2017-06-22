<?php
class Regulasi_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    function getRegulasi() {
        $sql = 'SELECT *
            FROM dt_regulasi
            ORDER BY TEMA ASC';
        $q = $this->db->query($sql);
        return $q->result();
    }

    function getRegulasiByIde($ide) {
        $sql = 'SELECT *
            FROM dt_regulasi
            WHERE IDE = ?
            ORDER BY TEMA ASC';
        $q = $this->db->query($sql,array($ide));
        return $q->result();
    }

    function addRegulasi($tema,$keterangan,$file)
    {
        $sql = "INSERT INTO dt_regulasi (TEMA,KETERANGAN,NAMA_FILE) VALUES (?,?,?)";
        $status = $this->db->query($sql, array($tema,$keterangan,$file));
        if($status){
            return array($status,'Data telah ditambahkan');
        }
        else {
            return array($status, $this->db->error());
        }
    }

    function deleteRegulasi($ide)
    {
        $sql = "DELETE FROM dt_regulasi WHERE IDE = ?";
        return $this->db->query($sql,array($ide));
    }
}