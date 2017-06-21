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

    function addBagian($urut,$name)
    {
        $sql_get = 'SELECT * FROM dt_uid_bagian WHERE URUT = ? ';
        $q = $this->db->query($sql_get,array($urut));
        $dt = $q->result();
        if(!empty($dt)){
           return array(false,'Nomor urut tidak boleh sama ');
        }
        $sql = "INSERT INTO dt_uid_bagian (URUT,BAGIAN) VALUES (?,?)";
        $status = $this->db->query($sql, array($urut,$name));
        if($status){
            return array($status,'Data telah ditambahkan');
        }
        else {
            return array($status, $this->db->error());
        }

    }

    function editBagian($urut,$bagian,$urut_old,$bagian_old)
    {
        $sql_del = "DELETE FROM dt_uid_bagian WHERE URUT = ? AND BAGIAN = ?";
        $status_del = $this->db->query($sql_del,array($urut_old,$bagian_old));
        if(!$status_del){
            return array(false,'Update gagal');
        }
        $sql = "INSERT INTO dt_uid_bagian (URUT,BAGIAN) VALUES (?,?)";
        $status = $this->db->query($sql, array($urut,$bagian));
        if($status){
            return array($status,'Data telah diedit');
        }
        else {
            return array($status, $this->db->error());
        }

    }

    function deleteBagian($urut,$name)
    {
        $sql = "DELETE FROM dt_uid_bagian WHERE URUT = ? AND BAGIAN = ?";
        return $this->db->query($sql,array($urut,$name));
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