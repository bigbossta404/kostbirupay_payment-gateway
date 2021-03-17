<?php

class Transaksi extends CI_Model
{
    public function getDetKost($idtagih)
    {
        $this->db->select('id_transaksi, id_bayar, harga, tgl_invoice, tgl_lunas, pay_type,va_num, bank, pdf_url, status');
        $this->db->from('transaksi');
        $this->db->where('id_bayar', $idtagih);
        $this->db->like('id_transaksi', 'KOST');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function cekOrder($id_order)
    {
        $query = $this->db->query("SELECT 
            (SELECT COUNT(id_transaksi) FROM transaksi WHERE id_transaksi = '$id_order') AS kost, 
            (SELECT COUNT(id_transaksi) FROM transaksi WHERE id_transaksi = '$id_order') AS listrik, 
            (SELECT COUNT(id_transaksi) FROM transaksi WHERE id_transaksi = '$id_order' ) AS wifi");
        return $query->result_array();
    }
    public function get_monthly_wifi()
    {
        $query = $this->db->query("SELECT SUM(harga) uangwifi FROM transaksi
        WHERE MONTH(tgl_lunas) = MONTH(CURRENT_TIMESTAMP) AND id_transaksi LIKE '%WIFI%'");
        return $query->row_array();
    }
    public function get_monthly_listrik()
    {
        $query = $this->db->query("SELECT SUM(harga) uanglistrik FROM transaksi
        WHERE MONTH(tgl_lunas) = MONTH(CURRENT_TIMESTAMP) AND id_transaksi LIKE '%LIS%'");
        return $query->row_array();
    }
    public function get_saldo()
    {
        $query = $this->db->query("SELECT (SELECT saldo FROM kas WHERE id_kas = 2) kaslistrik,
        (SELECT saldo FROM kas WHERE id_kas = 3) kaswifi");
        return $query->row_array();
    }
}
