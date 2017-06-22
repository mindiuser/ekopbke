<?php
class Rekening_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', TRUE);
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
        $result_final = [];
        $sql = 'SELECT DISTINCT (ACCBB) AS ACCBB
            FROM accountbb ';
        if($kelompok && $kelompok != ''){
            $sql .= 'WHERE ACCKEL = ? ';
        }else{
            $sql .= 'WHERE ACCKEL = ? ';
            $kelompok ='0';
        }
        $sql .= 'ORDER BY BUKUBESAR ASC';
        $q = $this->db->query($sql,array($kelompok));
        $res = $q->result();
        foreach($res as $row){
            $sqlt = 'SELECT ACCKEL,ACCBB,BUKUBESAR,KATEGORI,GOLONGAN
            FROM accountbb WHERE ACCBB = ? ORDER BY BUKUBESAR ASC';
            $qr = $this->db->query($sqlt,array($row->ACCBB));
            $res_qr = $qr->result();
            $result_final[] = ['ACCBB'=>$row->ACCBB, 'ACCKEL'=>$res_qr[0]->ACCKEL,'BUKUBESAR'=>$res_qr[0]->BUKUBESAR,'KATEGORI'=>$res_qr[0]->KATEGORI,'GOLONGAN'=>$res_qr[0]->GOLONGAN];
        }
        return json_decode(json_encode($result_final));

    }

    function getSubBukuBesarRekening($buku_besar ='') {
        $result_final = [];
        $sql = 'SELECT DISTINCT (ACC) AS ACC
            FROM account ';
        if($buku_besar && $buku_besar != ''){
            $sql .= 'WHERE ACCBB = ? ';
        }else{
            $sql .= 'WHERE ACCBB = ? ';
            $buku_besar ='0';
        }
        $sql .= 'ORDER BY ACC ASC';
        $q = $this->db->query($sql,array($buku_besar));
        $res = $q->result();
        foreach($res as $row){
            $sqlt = 'SELECT ACC,ACCBB,KETERANGAN,GOLONGAN
            FROM account WHERE ACC = ? ORDER BY KETERANGAN ASC';
            $qr = $this->db->query($sqlt,array($row->ACC));
            $res_qr = $qr->result();
            $result_final[] = ['ACC'=>$row->ACC, 'ACCBB'=>$res_qr[0]->ACCBB,'KETERANGAN'=>$res_qr[0]->KETERANGAN,'GOLONGAN'=>$res_qr[0]->GOLONGAN];
        }
        return json_decode(json_encode($result_final));

    }



}