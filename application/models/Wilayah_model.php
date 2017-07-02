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

    function getKecamatanById($id) {
        $sql = 'SELECT b.*,c.NAMA_KABUPATEN AS NAMA_KABUPATEN FROM dt_kecamatan b
         LEFT JOIN dt_kabupaten c on c.ID_KAB = b.ID_KAB WHERE b.ID_KEC = ? LIMIT 0,1';
        $q = $this->db->query($sql,array($id));
        return $q->result();
    }

    function addKecamatan($id_kab,$id_kec,$kecamatan,$kodepos,$keterangan)
    {
        $sql = "INSERT INTO dt_kecamatan (ID_KAB,ID_KEC,NAMA_KECAMATAN,KODEPOS,KET) VALUES (?,?,?,?,?)";
        $status = $this->db->query($sql, array($id_kab,$id_kec,$kecamatan,$kodepos,$keterangan));
        if($status){
            return array($status,'Data telah ditambahkan');
        }
        else {
            return array($status, $this->db->error());
        }
    }

    function deleteKecamatan($id_kec)
    {
        $sql = "DELETE FROM dt_kecamatan WHERE ID_KEC = ?";
        return $this->db->query($sql,array($id_kec));
    }

    function editKecamatan($id_kab,$id_kec,$kecamatan,$kodepos,$keterangan)
    {
        $sql = "UPDATE dt_kecamatan SET NAMA_KECAMATAN = ? ,KODEPOS = ?,KET = ? WHERE ID_KEC = ? AND ID_KAB = ?";
        $status = $this->db->query($sql, array($kecamatan,$kodepos,$keterangan,$id_kec,$id_kab));
        if($status){
            return array($status,'Data telah diupdate');
        }
        else {
            return array($status, $this->db->error());
        }
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

    function addKelurahan($id_kec,$id_kel,$kelurahan,$kodepos,$longitude,$lattitude)
    {
        $sql = "INSERT INTO dt_kelurahan (ID_KEC,ID_KEL,NAMA_KELURAHAN,KODEPOS,LONGITUDE,LATTITUDE) VALUES (?,?,?,?,?,?)";
        $status = $this->db->query($sql, array($id_kec,$id_kel,$kelurahan,$kodepos,$longitude,$lattitude));
        if($status){
            return array($status,'Data telah ditambahkan');
        }
        else {
            return array($status, $this->db->error());
        }
    }

    function deleteKelurahan($id_kel)
    {
        $sql = "DELETE FROM dt_kelurahan WHERE ID_KEL = ?";
        return $this->db->query($sql,array($id_kel));
    }

    function getKelurahanById($id) {
        $sql = 'SELECT b.*,g.NAMA_KECAMATAN AS NAMA_KECAMATAN,g.ID_KAB as ID_KAB,c.NAMA_KABUPATEN AS NAMA_KABUPATEN,c.ID_PROP AS ID_PROP, p.NAMA_PROPINSI AS NAMA_PROPINSI FROM dt_kelurahan b
         LEFT JOIN dt_kecamatan g on (g.ID_KEC = b.ID_KEC) LEFT JOIN dt_kabupaten c on (c.ID_KAB = g.ID_KAB) LEFT JOIN dt_propinsi p on (p.ID_PROP = c.ID_PROP) ';
        $sql .= 'WHERE b.ID_KEL = ? LIMIT 0,1';
        $q = $this->db->query($sql,array($id));
        return $q->result();
    }

    function editKelurahan($id_kec,$id_kel,$kelurahan,$kodepos,$longitude,$lattitude)
    {
        $sql = "UPDATE dt_kelurahan SET NAMA_KELURAHAN = ?,KODEPOS = ?,LONGITUDE = ?,LATTITUDE = ? WHERE ID_KEL = ? AND ID_KEC = ?";
        $status = $this->db->query($sql, array($kelurahan,$kodepos,$longitude,$lattitude,$id_kel,$id_kec));
        if($status){
            return array($status,'Data telah diupdate');
        }
        else {
            return array($status, $this->db->error());
        }
    }


    function getKodepos($propinsi='',$kabupaten='',$kecamatan='') {
        $params = [];
        $sql = 'SELECT * FROM dt_kodepos ';
        if($propinsi != ''){
            $sql .= 'WHERE NAMA_PROPINSI = ? ';
            $params[] = $propinsi;
        }
        if($kabupaten != ''){
            $sql .= 'AND NAMA_KABUPATEN = ? ';
            $params[] = $kabupaten;
        }
        if($kecamatan != ''){
            $sql .= 'AND NAMA_KECAMATAN = ? ';
            $params[] = $kecamatan;
        }
        $sql .= 'ORDER BY ID_KODE ASC ';
        $q = $this->db->query($sql,$params);
        return $q->result();
    }

    function addKodepos($prop,$res,$kab,$kec,$id_kel,$kelurahan,$kodepos)
    {
        $kb = explode("-",$kab);
        if(in_array(strtoupper($kb[0]),['','KAB','KAB.','KOTA','KOTA.'])){
            $kab = '';
            $i = 0;
            foreach($kb as $row){
                if($i > 0){
                    $kab .= $row.' ';
                }
                $i++;
            }
        }
        $kab = trim($kab);
        $sql = "INSERT INTO dt_kodepos (ID_KODE,ID_KEL,NAMA_KELURAHAN,NAMA_KECAMATAN,RES,NAMA_KABUPATEN,NAMA_PROPINSI) VALUES (?,?,?,?,?,?,?)";
        $status = $this->db->query($sql, array($kodepos,$id_kel,$kelurahan,$kec,$res,$kab,$prop));
        if($status){
            return array($status,'Data telah ditambahkan');
        }
        else {
            return array($status, $this->db->error());
        }
    }

    function deleteKodepos($id_kode)
    {
        $sql = "DELETE FROM dt_kodepos WHERE ID_KODE = ?";
        return $this->db->query($sql,array($id_kode));
    }

    function getKodeposById($id_kode) {
        $params = [$id_kode];
        $sql = 'SELECT * FROM dt_kodepos WHERE ID_KODE = ? ORDER BY ID_KODE ASC LIMIT 0,1';
        $q = $this->db->query($sql,$params);
        return $q->result();
    }

    function editKodepos($kodepos_old,$kodepos)
    {
        $sql = "UPDATE dt_kodepos SET ID_KODE = ? WHERE ID_KODE = ?";
        $status = $this->db->query($sql, array($kodepos,$kodepos_old));
        if($status){
            return array($status,'Data telah diupdate');
        }
        else {
            return array($status, $this->db->error());
        }
    }


}
?>