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
            return array(false,'Data tidak ditemukan');
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
        if($bagian != ''){
            $sql .= 'WHERE BAGIAN = ? ';
        }
        $sql .= 'ORDER BY URUT ASC';
        $q = $this->db->query($sql,array($bagian));
        return $q->result();
    }

    function addJabatan($bagian,$urut,$jabatan)
    {
        $sql_get = 'SELECT * FROM dt_uid_jabatan WHERE BAGIAN = ? AND URUT = ? ';
        $q = $this->db->query($sql_get,array($bagian,$urut));
        $dt = $q->result();
        if(!empty($dt)){
            return array(false,'Nomor urut sudah terpakai ');
        }
        $sql = "INSERT INTO dt_uid_jabatan (URUT,JABATAN,BAGIAN) VALUES (?,?,?)";
        $status = $this->db->query($sql, array($urut,$jabatan,$bagian));
        if($status){
            return array($status,'Data telah ditambahkan');
        }
        else {
            return array($status, $this->db->error());
        }

    }

    function editJabatan($bagian,$urut,$jabatan,$urut_old,$jabatan_old)
    {
        $sql_sel = "SELECT * FROM dt_uid_jabatan WHERE URUT = ? AND BAGIAN = ? AND JABATAN = ?";
        $status_sel = $this->db->query($sql_sel,array($urut_old,$bagian,$jabatan_old));
        $dt = $status_sel->result();
        if(empty($dt)){
            return array(false,'Data tidak ditemukan');
        }
        $sql = "UPDATE dt_uid_jabatan SET URUT = ?, JABATAN = ? WHERE URUT = ? AND BAGIAN = ? AND JABATAN = ?";
        $status = $this->db->query($sql, array($urut,$jabatan,$urut_old,$bagian,$jabatan_old));
        if($status){
            return array($status,'Data telah diedit');
        }
        else {
            return array($status, $this->db->error());
        }

    }

    function deleteJabatan($urut,$bagian,$jabatan)
    {
        $sql = "DELETE FROM dt_uid_jabatan WHERE URUT = ? AND BAGIAN = ? AND JABATAN = ?";
        return $this->db->query($sql,array($urut,$bagian,$jabatan));
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