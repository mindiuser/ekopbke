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

    function updatePassword($username,$password_old,$password_new) {
        $sqlc = 'SELECT *
            FROM uid
            WHERE NAMA = ? AND PASSWORD = ?
            ORDER BY UID ASC LIMIT 0,1';
        $qc = $this->db->query($sqlc,array($username,md5($password_old)));
        $res = $qc->result();
        if(empty($res)){
            return array(FALSE, "PASSWORD SEKARANG yang anda masukkan tidak benar");
        }
        $sql = "UPDATE uid SET PASSWORD = ? WHERE PASSWORD = ? AND NAMA = ?";
        $status = $this->db->query($sql, array(md5($password_new),md5($password_old),$username));
        if($status){
            return array($status,'Password telah telah diubah');
        }
        else {
            return array($status, $this->db->error());
        }
    }

}