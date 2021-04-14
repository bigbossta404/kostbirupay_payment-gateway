<?php

class Keuangan extends CI_Model
{
    var $column_order = array('pemasukan', 'pengeluaran', 'saldo', 'struk', 'tgl_transaksi', null); //set column field database for datatable orderable
    var $column_search = array('pemasukan', 'pengeluaran', 'saldo', 'tgl_transaksi'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = ['id_keuangan' => 'desc']; // default o
    private function _get_datatables_keuangan()
    {

        $this->db->select('*');
        $this->db->from('keuangan');

        $i = 0;

        foreach ($this->column_search as $item) // loop column
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

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables_keuangan($bagian)
    {
        $this->_get_datatables_keuangan();
        $this->db->where('tags', $bagian);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_keuangan($bagian)
    {
        $this->_get_datatables_keuangan();
        $this->db->where('tags', $bagian);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all_keuangan($bagian)
    {
        $this->db->from($this->_get_datatables_keuangan(), $this->db->where('tags', $bagian));

        return $this->db->count_all_results();
    }

    public function SaldoIn($calsaldo)
    {
        $query = $this->db->query("SELECT saldo + " . $calsaldo['jml'] . " total FROM kas WHERE jenis_kas = '" . $calsaldo['bagian'] . "'");
        return $query->row_array();
    }
    public function SaldoOut($calsaldo)
    {
        $query = $this->db->query("SELECT saldo - " . $calsaldo['jml'] . " total FROM kas WHERE jenis_kas = '" . $calsaldo['bagian'] . "'");
        return $query->row_array();
    }
    public function recentSaldo($calsaldo)
    {
        $query = $this->db->query("SELECT saldo FROM kas WHERE jenis_kas = '" . $calsaldo['bagian'] . "' ");
        return $query->row_array();
    }

    public function getBulanChart($bagian)
    {
        $query = $this->db->query("SELECT bulan FROM list_bulan WHERE id_bulan IN (SELECT DATE_FORMAT(tgl_transaksi,'%c') FROM keuangan WHERE tags LIKE '%" . $bagian .  "%' GROUP BY DATE_FORMAT(tgl_transaksi,'%c')) ORDER BY id_bulan ASC");
        return $query->result_array();
    }
    public function getSaldoChart($bagian)
    {
        $query = $this->db->query("SELECT 
        MAX(saldo) AS totalkas,
        MAX(tgl_transaksi) AS tgl_lap
 FROM
 ( SELECT tgl_transaksi,
          first_value(saldo) over 
          (PARTITION BY DATE_FORMAT(tgl_transaksi,'%Y-%m') ORDER BY tgl_transaksi DESC) AS saldo
    FROM keuangan WHERE tags LIKE '%" . $bagian .  "%'
 ) l
 GROUP BY DATE_FORMAT(tgl_transaksi,'%Y-%m')");
        return $query->result_array();
    }
}
