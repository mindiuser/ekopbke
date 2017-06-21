<?php
class Setting_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    function getBagian() {
        $sql = 'SELECT *
            FROM dt_uid_bagian
            ORDER BY URUT ASC';
        $q = $this->db->query($sql);
        return $q->result();
    }

    function getJabatan($bagian = '') {
        $sql = 'SELECT * FROM dt_uid_jabatan ';
        //if($bagian != ''){
            $sql .= 'WHERE jabatan = "'.$bagian.'" ';
        //}
        $sql .= 'ORDER BY URUT ASC';
        $q = $this->db->query($sql);
        return $q->result();
    }

    function getUsers() {
        $sql = 'SELECT * FROM uid ';
        $sql .= 'ORDER BY NAMA ASC';
        $q = $this->db->query($sql);
        return $q->result();
    }

    function getLogs() {
        $sql = 'SELECT * FROM transaksi ';
        $sql .= 'ORDER BY IDE DESC';
        $q = $this->db->query($sql);
        return $q->result();
    }

}
?>