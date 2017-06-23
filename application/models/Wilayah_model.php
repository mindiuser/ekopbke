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

    function addPropinsi($id,$propinsi)
    {
        $sql_get = 'SELECT * FROM dt_propinsi WHERE ID_PROP = ? AND NAMA_PROPINSI = ?';
        $q = $this->db->query($sql_get,array($id,$propinsi));
        $dt = $q->result();
        if(!empty($dt)){
            return array(false,'Nomor ID dan Propsinsi sudah ada ');
        }
        $sql = "INSERT INTO dt_propinsi (ID_PROP,NAMA_PROPINSI) VALUES (?,?)";
        $status = $this->db->query($sql, array($id,$propinsi));
        if($status){
            return array($status,'Data telah ditambahkan');
        }
        else {
            return array($status, $this->db->error());
        }

    }

    function deletePropinsi($id_prop,$propinsi)
    {
        $sql = "DELETE FROM dt_propinsi WHERE ID_PROP = ? AND NAMA_PROPINSI = ?";
        return $this->db->query($sql,array($id_prop,$propinsi));
    }

    function editPropinsi($id,$propinsi,$id_old,$propinsi_old)
    {
        $sql = "UPDATE dt_propinsi SET ID_PROP = ?, NAMA_PROPINSI = ? WHERE ID_PROP = ? AND NAMA_PROPINSI = ?";
        $status = $this->db->query($sql, array($id,$propinsi,$id_old,$propinsi_old));
        if($status){
            return array($status,'Data telah diedit');
        }
        else {
            return array($status, $this->db->error());
        }

    }

    function getKabupaten($propinsi='') {
        $sql = 'SELECT ID_PROP,ID_KAB, RES,NAMA_KABUPATEN,IBUKOTA
            FROM dt_kabupaten  WHERE ID_PROP = ? ORDER BY NAMA_KABUPATEN ASC';
            if($propinsi == ''){
                $propinsi = '*';
            }
        $q = $this->db->query($sql,[$propinsi]);
        return $q->result();
    }

    function addKabupaten($id_prop,$id_kab,$res,$kabupaten,$ibukota)
    {
        $sql = "INSERT INTO dt_kabupaten (ID_PROP,ID_KAB,RES,NAMA_KABUPATEN,IBUKOTA) VALUES (?,?,?,?,?)";
        $status = $this->db->query($sql, array($id_prop,$id_kab,$res,$kabupaten,$ibukota));
        if($status){
            return array($status,'Data telah ditambahkan');
        }
        else {
            return array($status, $this->db->error());
        }

    }

    function deleteKabupaten($id_prop,$id_kab)
    {
        $sql = "DELETE FROM dt_kabupaten WHERE ID_PROP = ? AND ID_KAB = ?";
        return $this->db->query($sql,array($id_prop,$id_kab));
    }

    function editKabupaten($id_prop,$id_kab,$res,$kabupaten,$ibukota)
    {
        $sql = "UPDATE dt_kabupaten SET RES = ? ,NAMA_KABUPATEN = ?,IBUKOTA = ? WHERE ID_KAB = ? AND ID_PROP = ?";
        $status = $this->db->query($sql, array($res,$kabupaten,$ibukota,$id_kab,$id_prop));
        if($status){
            return array($status,'Data telah diupdate');
        }
        else {
            return array($status, $this->db->error());
        }

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