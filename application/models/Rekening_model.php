<?php
class Rekening_model extends CI_Model {

    public $CIF;

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
        $this->CIF = '00000'; //CIF should use $this->session->userdata('cif');
    }

    function getJenisRekening() {
        $result_final = [];
        $sql = 'SELECT distinct(ACCJENIS) AS ACCJENIS
            FROM dt_accjenis
            ORDER BY ACCJENIS ASC';
        $q = $this->db->query($sql);
        $res = $q->result();
        foreach($res as $row){
            $sqlt = 'SELECT JENIS
            FROM dt_accjenis
            WHERE ACCJENIS = ?
            ORDER BY ACCJENIS ASC';
            $qr = $this->db->query($sqlt,array($row->ACCJENIS));
            $res_qr = $qr->result();
            $result_final[] = ['ACCJENIS'=>$row->ACCJENIS, 'JENIS'=>$res_qr[0]->JENIS];
        }
        return json_decode(json_encode($result_final));
    }

    function getKelompokRekening($jenis_rekening ='') {
        $result_final = [];
        $sql = 'SELECT DISTINCT (ACCKEL) AS ACCKEL
            FROM dt_acckel ';
        if($jenis_rekening && $jenis_rekening != '')
            $sql .= 'WHERE ACCJENIS = ? ';
        else {
            $sql .= 'WHERE ACCJENIS = ? ';
            $jenis_rekening ='0';
        }
        $sql .= 'ORDER BY KELOMPOK ASC';
        $q = $this->db->query($sql,array($jenis_rekening));
        $res = $q->result();
        foreach($res as $row){
            $sqlt = 'SELECT ACCJENIS,ACCKEL,KELOMPOK,GOL,SUBGOL
            FROM dt_acckel WHERE ACCKEL = ? ORDER BY KELOMPOK ASC';
            $qr = $this->db->query($sqlt,array($row->ACCKEL));
            $res_qr = $qr->result();
            $result_final[] = ['ACCKEL'=>$row->ACCKEL, 'ACCJENIS'=>$res_qr[0]->ACCJENIS,'KELOMPOK'=>$res_qr[0]->KELOMPOK,'GOL'=>$res_qr[0]->GOL,'SUBGOL'=>$res_qr[0]->SUBGOL];
        }
        return json_decode(json_encode($result_final));
    }

    function getBukuBesarRekening($kelompok ='') {
        $params = [];
        $sql = 'SELECT * FROM accountbb WHERE CIF = ? AND ACCKEL = ? ORDER BY BUKUBESAR ASC';
        $params[] = $this->CIF; //CIF should use $this->session->userdata('cif');
        if($kelompok != ''){
            $params[] = $kelompok;
        }
        else {
            $params[] = 0;
        }
        $q = $this->db->query($sql,$params);
        return $q->result();

    }


    function addBukubesar($kel,$accbb,$bb,$kat,$gol,$res)
    {
        $sql = "INSERT INTO accountbb (ACCKEL,ACCBB,BUKUBESAR,KATEGORI,GOLONGAN,RESIKO,CIF) VALUES (?,?,?,?,?,?,?)";
        $status = $this->db->query($sql, array($kel,$accbb,$bb,$kat,$gol,$res,$this->CIF));
        if($status){
            return array($status,'Data telah ditambahkan');
        }
        else {
            return array($status, $this->db->error());
        }
    }

    function deleteBukubesar($accbb)
    {
        $sql = "DELETE FROM accountbb WHERE ACCBB = ? AND CIF = ? ";
        return $this->db->query($sql,array($accbb,$this->CIF));
    }

    function getBukubesarById($accbb) {
        $params = [$accbb,$this->CIF];
        $sql = 'SELECT b.*,k.ACCJENIS,k.KELOMPOK,j.JENIS FROM accountbb AS b ';
        $sql .= 'LEFT JOIN dt_acckel AS k ON (k.ACCKEL = b.ACCKEL) ';
        $sql .= 'LEFT JOIN dt_accjenis AS j ON (j.ACCJENIS = k.ACCJENIS) ';
        $sql .= 'WHERE  b.ACCBB = ? AND b.CIF = ? ORDER BY b.ACCBB ASC LIMIT 0,1';
        $q = $this->db->query($sql,$params);
        return $q->result();
    }

    function editBukubesar($kel,$accbb,$bb,$kat,$gol,$res)
    {
        $sql = "UPDATE accountbb SET BUKUBESAR=?,KATEGORI=?,GOLONGAN=?,RESIKO=? WHERE ACCBB=? AND ACCKEL = ? AND CIF = ?";
        $status = $this->db->query($sql, array($bb,$kat,$gol,$res,$accbb,$kel,$this->CIF));
        if($status){
            return array($status,'Data telah diupdate');
        }
        else {
            return array($status, $this->db->error());
        }
    }


    function getSubBukuBesarRekening($accbb ='') {
        $params = [];
        $sql = 'SELECT * FROM account WHERE CIF = ? AND ACCBB = ? ORDER BY KETERANGAN ASC';
        $params[] = $this->CIF; //CIF should use $this->session->userdata('cif');
        if($accbb != ''){
            $params[] = $accbb;
        }
        else {
            $params[] = 0;
        }
        $q = $this->db->query($sql,$params);
        return $q->result();

    }

    function addSubBukubesar($jenis,$kel,$bb,$acc,$ket,$gol,$ku){
        $sql_check = 'SELECT * FROM account WHERE ACCBB = ? AND ACC = ? AND CIF = ? ORDER BY KETERANGAN ASC';
        $q_check = $this->db->query($sql_check, array($bb,$acc,$this->CIF));
        $result = $q_check->result();
        if(!empty($result)){
            return array(FALSE, 'Duplicate acc account '.$acc);
        }
        $sql = "INSERT INTO account (ACCBB,ACC,KETERANGAN,GOLONGAN,KU,CIF) VALUES (?,?,?,?,?,?)";
        $status = $this->db->query($sql, array($bb,$acc,$ket,$gol,$ku,$this->CIF));
        if($status){
            return array($status,'Data telah ditambahkan');
        }
        else {
            return array($status, $this->db->error());
        }
    }

    function deleteSubBukubesar($acc)
    {
        $sql = "DELETE FROM account WHERE ACC = ? AND CIF = ? ";
        return $this->db->query($sql,array($acc,$this->CIF));
    }

    function getSubBukubesarById($acc){
        $params = [$acc,$this->CIF];
        $sql = 'SELECT bc.*,b.BUKUBESAR,b.ACCKEL,k.ACCJENIS,k.KELOMPOK,j.JENIS FROM account AS bc ';
        $sql .= 'LEFT JOIN accountbb AS b ON (b.ACCBB = bc.ACCBB) ';
        $sql .= 'LEFT JOIN dt_acckel AS k ON (k.ACCKEL = b.ACCKEL) ';
        $sql .= 'LEFT JOIN dt_accjenis AS j ON (j.ACCJENIS = k.ACCJENIS) ';
        $sql .= 'WHERE bc.ACC = ? AND bc.CIF = ? ORDER BY bc.ACC ASC LIMIT 0,1';
        $q = $this->db->query($sql,$params);
        return $q->result();
    }

    function editSubBukubesar($jenis,$kel,$bb,$acc,$ket,$gol,$ku){
        $sql = "UPDATE account SET KETERANGAN = ?,GOLONGAN = ?,KU = ? WHERE ACC = ? AND ACCBB = ?";
        $status = $this->db->query($sql, array($ket,$gol,$ku,$acc,$bb));
        if($status){
            return array($status,'Data telah diupdate');
        }
        else {
            return array($status, $this->db->error());
        }
    }



}