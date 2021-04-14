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

    // public function get_history_by_kamar(){
    //     $query = $this->db->query("SELECT id_transaksi, bulan, harga, pay_type, bank, tgl_invoice FROM transaksi t
    //     JOIN pembayaran pb ON pb.`id_bayar` = t.`id_bayar`
    //     JOIN list_bulan bl ON bl.`id_bulan` = pb.`id_bulan`");
    //     return $query->row-
    // }

    //========================= TABEL HISTORY PENGGUNA =======================================
    var $colwifi_history = array('id_transaksi', 'bulan', 'harga', 'pay_type', 'bank', 'tgl_invoice', null);
    var $colw_history_search = array('id_transaksi', 'bulan', 'harga', 'pay_type', 'bank', 'tgl_invoice');
    var $order_w_history = ['tgl_invoice' => 'desc'];
    private function _get_datatables_history()
    {

        $this->db->select('id_transaksi, bulan, harga, pay_type, bank, tgl_invoice, status');
        $this->db->from('transaksi t');
        $this->db->join('pembayaran pb', 'pb.id_bayar = t.id_bayar');
        $this->db->join('list_bulan bl', 'bl.id_bulan = pb.id_bulan');

        $i = 0;

        foreach ($this->colw_history_search as $item) // loop column
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->colw_history_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->colwifi_history[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_w_history)) {
            $order_w_history = $this->order_w_history;
            $this->db->order_by(key($order_w_history), $order_w_history[key($order_w_history)]);
        }
    }

    function get_datatablesHistory($id_pengguna)
    {
        $this->_get_datatables_history();
        $this->db->where('id_pengguna', $id_pengguna);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filteredHistory($id_pengguna)
    {
        $this->_get_datatables_history();
        $this->db->where('id_pengguna', $id_pengguna);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_allHistory($id_pengguna)
    {
        $this->db->from($this->_get_datatables_history(), $this->db->where('id_pengguna', $id_pengguna));
        return $this->db->count_all_results();
    }
    //=====================================================================

    var $col_iw = array('pemasukan', 'pengeluaran', 'saldo', 'ket', 'tgl_transaksi', null);
    var $col_search_iw = array('pemasukan', 'pengeluaran', 'saldo', 'ket', 'tgl_transaksi');
    var $order_iw = ['tgl_transaksi' => 'desc'];
    private function _get_datatables_in_wifi()
    {

        $this->db->select('*');
        $this->db->from('keuangan');
        $this->db->not_like('struk', 'WIFI-');
        $this->db->not_like('struk', 'LIS-');
        $this->db->where('tags', 'wifi');

        $i = 0;

        foreach ($this->col_search_iw as $item) // loop column
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->col_search_iw) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->col_iw[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_iw)) {
            $order_iw = $this->order_iw;
            $this->db->order_by(key($order_iw), $order_iw[key($order_iw)]);
        }
    }

    function get_datatables_in_wifi()
    {
        $this->_get_datatables_in_wifi();
        // $this->db->where('id_pengguna', $id_pengguna);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_in_w()
    {
        $this->_get_datatables_in_wifi();
        // $this->db->where('id_pengguna', $id_pengguna);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_in_w()
    {
        $this->db->from($this->_get_datatables_in_wifi());
        return $this->db->count_all_results();
    }
    //============================ Inventaris Listrik   =======================================

    var $col_il = array('pemasukan', 'pengeluaran', 'saldo', 'ket', 'tgl_transaksi', null);
    var $col_search_il = array('pemasukan', 'pengeluaran', 'saldo', 'ket', 'tgl_transaksi');
    var $order_il = ['tgl_transaksi' => 'desc'];
    private function _get_datatables_in_listrik()
    {

        $this->db->select('*');
        $this->db->from('keuangan');
        $this->db->where('tags', 'listrik');
        // $this->db->not_like('struk', 'WIFI-');
        // $this->db->not_like('struk', 'LIS-');
        // $this->db->or_where('struk', null);

        $i = 0;

        foreach ($this->col_search_il as $item) // loop column
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->col_search_il) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->col_il[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_il)) {
            $order_il = $this->order_il;
            $this->db->order_by(key($order_il), $order_il[key($order_il)]);
        }
    }

    function get_datatables_in_listrik()
    {
        $this->_get_datatables_in_listrik();
        // $this->db->where('id_pengguna', $id_pengguna);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_in_l()
    {
        $this->_get_datatables_in_listrik();
        // $this->db->where('id_pengguna', $id_pengguna);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_in_l()
    {
        $this->db->from($this->_get_datatables_in_listrik());
        return $this->db->count_all_results();
    }
}
