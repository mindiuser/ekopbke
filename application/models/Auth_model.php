<?php
class Auth_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
    }

    function checkLogin($username,$password) {
        $sql = 'SELECT *
            FROM uid
            WHERE NAMA = ? AND PASSWORD = ?
            ORDER BY UID ASC';
        $q = $this->db->query($sql,array($username,md5($password)));
        return $q->result();
    }

}