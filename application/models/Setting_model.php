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
        $sql_get = 'SELECT URUT FROM dt_uid_bagian ORDER BY URUT DESC';
        $q = $this->db->query($sql_get);
        $dt = $q->result();
        $newid = 0;
        if(!empty($dt)){
            $arr = [];
            foreach($dt as $row){
                $arr[] = (int) $row->URUT;
            }
            $newid = max($arr)+1;
        }
        if($newid == 0){
            $sql_getone = 'SELECT URUT FROM dt_uid_bagian ORDER BY URUT DESC LIMIT 0,1';
            $qt = $this->db->query($sql_getone);
            $dt = $qt->result();
            $newid = (int) $dt->URUT+1;
        }
        $sql = "INSERT INTO dt_uid_bagian (URUT,BAGIAN) VALUES (?,?)";
        $status = $this->db->query($sql, array($newid,$name));
        if($status){
            return array($status,'Data telah ditambahkan');
        }
        else {
            return array($status, $this->db->error());
        }

    }

    function editBagian($urut,$bagian,$urut_old,$bagian_old)
    {
        $sql = "UPDATE dt_uid_bagian SET BAGIAN = ? WHERE URUT = ?";
        $status = $this->db->query($sql,array($bagian,$urut_old));
        if($status){
            return array($status,'Data telah diupdate');
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
        $sql_get = 'SELECT URUT FROM dt_uid_jabatan ORDER BY URUT DESC';
        $q = $this->db->query($sql_get);
        $dt = $q->result();
        $newid = 0;
        if(!empty($dt)){
            $arr = [];
            foreach($dt as $row){
                $arr[] = (int) $row->URUT;
            }
            $newid = max($arr)+1;
        }
        if($newid == 0){
            $sql_getone = 'SELECT URUT FROM dt_uid_jabatan ORDER BY URUT DESC LIMIT 0,1';
            $qt = $this->db->query($sql_getone);
            $dt = $qt->result();
            $newid = (int) $dt->URUT+1;
        }

        $sql = "INSERT INTO dt_uid_jabatan (URUT,JABATAN,BAGIAN) VALUES (?,?,?)";
        $status = $this->db->query($sql, array($newid,$jabatan,$bagian));
        if($status){
            return array($status,'Data telah ditambahkan');
        }
        else {
            return array($status, $this->db->error());
        }

    }

    function editJabatan($bagian,$urut,$jabatan,$urut_old,$jabatan_old)
    {
        $sql = "UPDATE dt_uid_jabatan SET JABATAN = ? WHERE URUT = ? AND BAGIAN = ?";
        $status = $this->db->query($sql, array($jabatan,$urut_old,$bagian));
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

    function getMaster($type) {
        switch($type){
            case 'bagian':
                $sql = 'SELECT * FROM dt_uid_bagian ';
                $sql .= 'ORDER BY BAGIAN ASC';
                $q = $this->db->query($sql);
                return $q->result();
                break;
            case 'jabatan':
                $sql = 'SELECT * FROM dt_uid_jabatan ';
                $sql .= 'ORDER BY JABATAN ASC';
                $q = $this->db->query($sql);
                return $q->result();
                break;
            case 'level':
                return  json_decode(json_encode(array(
                   array('ID'=>1,'LEVEL'=> 'OPERATOR'),
                    array('ID'=>2,'LEVEL'=> 'SUPERVISI'),
                        array('ID'=>3,'LEVEL'=> 'MANAGER'),
                            array('ID'=>9,'LEVEL'=> 'ADMINISTRATOR')
                )));
            break;
            case 'regional':
                $sql = 'SELECT * FROM dt_regional ';
                $sql .= 'ORDER BY NAMA_REGIONAL ASC';
                $q = $this->db->query($sql);
                return $q->result();
            break;
            case 'cabang':
                $sql = 'SELECT * FROM dt_cabang ';
                $sql .= 'ORDER BY NAMA_CABANG ASC';
                $q = $this->db->query($sql);
                return $q->result();

        }

    }

    function addUser($post)
    {
        $sql_get = 'SELECT * FROM uid WHERE uid = ? ';
        $q = $this->db->query($sql_get,array($post['uid']));
        $dt = $q->result();
        if(!empty($dt)){
            return array(false,'UID sudah terpakai ');
        }
        $parr =  array("uid","nama","password","level","bagian","jabatan","administrator",
            "setting","registrasi_mitra","master","approval","dashboard","regulasi","regional","cabang","status");

        $rrr = 'UID,NAMA,PASSWORD,LVL,BAGIAN,JABATAN,ADMINISTRATOR,SETTING,MIF_REGISTRASI,MIF,MIF_APPROVAL,MONITORING,REGULASI,IDREG,IDCAB,ST';
        $params = [];
        foreach($parr as $key){
            $params[] = $post[$key];
        }
        $sql = "INSERT INTO uid (".$rrr.") VALUES (?,?,?,?,? ,?,?,?,?,? ,?,?,?,?,?, ?)";
        $status = $this->db->query($sql,$params);
        if($status){
            return array($status,'Data telah ditambahkan');
        }
        else {
            return array($status, $this->db->error());
        }

    }

    function deleteUser($uid)
    {
        $sql = "DELETE FROM uid WHERE UID = ?";
        return $this->db->query($sql,array($uid));
    }

    function getUserById($uid){
            $sql = 'SELECT * FROM uid WHERE UID = ? ORDER BY NAMA ASC LIMIT 0,1';
            $q = $this->db->query($sql,[$uid]);
            return $q->result();

    }

    function editUser($post)
    {
        $parr =  array("nama","level","bagian","jabatan","administrator",
            "setting","registrasi_mitra","master","approval","dashboard",
            "regulasi","regional","cabang","status");
        $rrr = 'NAMA = ?,LVL = ?,BAGIAN = ?,JABATAN = ?,ADMINISTRATOR = ?,SETTING = ?,MIF_REGISTRASI = ?,MIF = ?,MIF_APPROVAL = ?,MONITORING = ?,REGULASI = ?,IDREG = ?,IDCAB = ?,ST = ?';
        $params = [];
        foreach($parr as $key){
            $params[] = $post[$key];
        }
        $params[] = $post['uid'];
        $sql = "UPDATE uid SET ".$rrr." WHERE UID = ?";
        $status = $this->db->query($sql,$params);
        if($status){
            return array($status,'Data telah diupdate');
        }
        else {
            return array($status, $this->db->error());
        }

    }

    function getLogs() {
        $sql = 'SELECT TGL,UID,AKSI,APP_FORM,RESUME,IP_ADDRESS,COMP_NAME,TIME_STAMP FROM log ';
        $sql .= 'ORDER BY TIME_STAMP DESC';
        $q = $this->db->query($sql);
        return $q->result();
    }

    function getUsersForDdl() {
        $sql = 'SELECT UID,NAMA FROM uid ';
        $sql .= 'ORDER BY NAMA ASC';
        $q = $this->db->query($sql);
        return $q->result();
    }

}
?>