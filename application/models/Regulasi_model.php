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
}