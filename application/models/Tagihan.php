<?php

class Tagihan extends CI_Model
{
    //==================== TAGIHAN KOS ==============================

    public function getupdatekost($username)
    {
        $query = $this->db->query("SELECT b.bulan bulan, k.kost harga FROM pembayaran pbk 
        JOIN list_bulan b ON b.id_bulan = pbk.`id_bulan`
        JOIN kamar k ON k.`id_kamar` = pbk.`id_kamar`
        JOIN pengguna_data pd ON pd.`id_kamar` = k.`id_kamar`
        WHERE MONTH(datecreate) = MONTH(CURRENT_TIMESTAMP)
        AND pbk.ket = 'kost'
        AND pd.`username` = '$username'");
        return $query->result_array();
    }
    public function getupdatelistrik($username)
    {
        $query = $this->db->query("SELECT b.bulan bulan, k.listrik harga FROM pembayaran pbl 
        JOIN list_bulan b ON b.id_bulan = pbl.`id_bulan`
        JOIN kamar k ON k.`id_kamar` = pbl.`id_kamar`
        JOIN pengguna_data pd ON pd.`id_kamar` = k.`id_kamar`
        WHERE MONTH(datecreate) = MONTH(CURRENT_TIMESTAMP)
        AND pbl.ket = 'listrik'
        AND pd.`username` = '$username'");
        return $query->result_array();
    }
    public function getupdatewifi($username)
    {
        $query = $this->db->query("SELECT b.bulan bulan, k.wifi harga FROM pembayaran pbw 
        JOIN list_bulan b ON b.id_bulan = pbw.`id_bulan`
        JOIN kamar k ON k.`id_kamar` = pbw.`id_kamar`
        JOIN pengguna_data pd ON pd.`id_kamar` = k.`id_kamar`
        WHERE MONTH(datecreate) = MONTH(CURRENT_TIMESTAMP)
        AND pbw.ket = 'wifi'
        AND pd.`username` = '$username'");
        return $query->result_array();
    }

    var $column_order = array('idbayar', 'bulan', 'harga', 'status', null); //set column field database for datatable orderable
    var $column_search = array('bulan', 'tk.status'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = ['bl.id_bulan' => 'asc']; // default o
    private function _get_datatables_kost()
    {

        $this->db->select('CONCAT("TGK",pbk.id_bayar) idtagih,bl.bulan bulan, k.kost harga, tk.status status,  pbk.id_bayar idbayar');
        $this->db->from('pembayaran pbk');
        $this->db->join('list_bulan bl', 'pbk.id_bulan = bl.id_bulan');
        $this->db->join('kamar k', 'k.id_kamar = pbk.id_kamar');
        $this->db->join('transaksi tk', 'tk.id_bayar = pbk.id_bayar', 'left');
        $this->db->where('pbk.ket', 'kost');
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

    function get_datatableskost($idkamar)
    {
        $this->_get_datatables_kost();
        $this->db->where('pbk.id_kamar', $idkamar);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filteredkost($idkamar)
    {
        $this->_get_datatables_kost();
        $this->db->where('pbk.id_kamar', $idkamar);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_allkost($idkamar)
    {
        $this->db->from($this->_get_datatables_kost(), $this->db->where('pbk.id_kamar', $idkamar));

        return $this->db->count_all_results();
    }

    //===================== TAGIHAN LISTRIK ========================


    private function _get_datatables_listrik()
    {

        $this->db->select('CONCAT("TGLIS",pbl.id_bayar) idtagih,bl.bulan bulan, k.listrik harga, tk.status status, pbl.id_bayar idbayar');
        $this->db->from('pembayaran pbl');
        $this->db->join('list_bulan bl', 'pbl.id_bulan = bl.id_bulan');
        $this->db->join('kamar k', 'k.id_kamar = pbl.id_kamar');
        $this->db->join('transaksi tk', 'tk.id_bayar = pbl.id_bayar', 'left');
        $this->db->where('pbl.ket', 'listrik');

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

    function get_datatableslistrik($idkamar)
    {
        $this->_get_datatables_listrik();
        $this->db->where('pbl.id_kamar', $idkamar);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filteredlistrik($idkamar)
    {
        $this->_get_datatables_listrik();
        $this->db->where('pbl.id_kamar', $idkamar);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_alllistrik($idkamar)
    {
        $this->db->from($this->_get_datatables_listrik(), $this->db->where('pbl.id_kamar', $idkamar));

        return $this->db->count_all_results();
    }
    //===================== TAGIHAN WIFI ========================


    private function _get_datatables_wifi()
    {

        $this->db->select('CONCAT("TGWIFI",pbw.id_bayar) idtagih,bl.bulan bulan, k.wifi harga, trw.status status, pbw.id_bayar idbayar');
        $this->db->from('pembayaran pbw');
        $this->db->join('list_bulan bl', 'pbw.id_bulan = bl.id_bulan');
        $this->db->join('kamar k', 'k.id_kamar = pbw.id_kamar');
        $this->db->join('transaksi trw', 'trw.id_bayar = pbw.id_bayar', 'left');
        $this->db->where('pbw.ket', 'wifi');
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

    function get_datatableswifi($idkamar)
    {
        $this->_get_datatables_wifi();
        $this->db->where('pbw.id_kamar', $idkamar);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filteredwifi($idkamar)
    {
        $this->_get_datatables_wifi();
        $this->db->where('pbw.id_kamar', $idkamar);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_allwifi($idkamar)
    {
        $this->db->from($this->_get_datatables_wifi(), $this->db->where('pbw.id_kamar', $idkamar));

        return $this->db->count_all_results();
    }
    public function get_id_akun()
    {
        $this->db->select('k.id_kamar id_kamar');
        $this->db->from('kamar k');
        $this->db->join('pengguna_data pd', 'pd.id_kamar = k.id_kamar');
        $this->db->where('pd.active', '1');
        $query = $this->db->get();
        return $query->result_array();
    }


    //========================= PENGURUS TAGIHAN WIFI =======================================
    var $colwifi_order = array(null, 'bulan', 'datecreate', null);
    var $colwifi_search = array('bulan', 'datecreate');
    var $order_wifi = ['idbulan' => 'asc'];
    private function _get_datatables_Twifi()
    {

        $this->db->select('bl.bulan bulan, datecreate, pbw.id_bulan idbulan, DATE_FORMAT(NOW(), "%Y") tahun');
        $this->db->from('pembayaran pbw');
        $this->db->join('list_bulan bl', 'bl.id_bulan = pbw.id_bulan');
        $this->db->where('DATE_FORMAT(datecreate,"%Y")', 'DATE_FORMAT(NOW(), "%Y")', false);
        $this->db->where('pbw.ket', 'wifi');
        $this->db->group_by('pbw.id_bulan');

        $i = 0;

        foreach ($this->colwifi_search as $item) // loop column
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

                if (count($this->colwifi_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->colwifi_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_wifi)) {
            $order_wifi = $this->order_wifi;
            $this->db->order_by(key($order_wifi), $order_wifi[key($order_wifi)]);
        }
    }

    function get_datatablesTwifi()
    {
        $this->_get_datatables_Twifi();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filteredTwifi()
    {
        $this->_get_datatables_Twifi();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_allTwifi()
    {
        $this->db->from($this->_get_datatables_Twifi());
        return $this->db->count_all_results();
    }
    //========================= PENGURUS TAGIHAN LISTRIK =======================================
    var $collistrik_order = array(null, 'bulan', 'datecreate', null);
    var $collistrik_search = array('bulan', 'datecreate');
    var $order_listrik = ['idbulan' => 'asc'];
    private function _get_datatables_Tlistrik()
    {

        $this->db->select('bl.bulan bulan, datecreate, pbw.id_bulan idbulan, DATE_FORMAT(NOW(), "%Y") tahun');
        $this->db->from('pembayaran pbw');
        $this->db->join('list_bulan bl', 'bl.id_bulan = pbw.id_bulan');
        $this->db->where('DATE_FORMAT(datecreate,"%Y")', 'DATE_FORMAT(NOW(), "%Y")', false);
        $this->db->where('pbw.ket', 'listrik');
        $this->db->group_by('pbw.id_bulan');

        $i = 0;

        foreach ($this->collistrik_search as $item) // loop column
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

                if (count($this->collistrik_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->collistrik_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_listrik)) {
            $order_listrik = $this->order_listrik;
            $this->db->order_by(key($order_listrik), $order_listrik[key($order_listrik)]);
        }
    }

    function get_datatablesTlistrik()
    {
        $this->_get_datatables_Tlistrik();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filteredTlistrik()
    {
        $this->_get_datatables_Twifi();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_allTlistrik()
    {
        $this->db->from($this->_get_datatables_Tlistrik());
        return $this->db->count_all_results();
    }
    //==============================

    public function wifionbulan()
    {
        $query = $this->db->query('SELECT id_bulan, bulan FROM list_bulan
        WHERE id_bulan NOT IN (SELECT id_bulan FROM pembayaran where ket = "wifi")');
        return $query->result_array();
    }
    public function listrikonbulan()
    {
        $query = $this->db->query('SELECT id_bulan, bulan FROM list_bulan
        WHERE id_bulan NOT IN (SELECT id_bulan FROM pembayaran where ket = "listrik")');
        return $query->result_array();
    }

    function getPercentWifi()
    {
        $query = $this->db->query("
        SELECT 
        CAST((SELECT COUNT(*) FROM transaksi WHERE MONTH(tgl_lunas) = MONTH(CURRENT_TIMESTAMP) AND id_transaksi LIKE '%WIFI%')/
        (SELECT COUNT(*) FROM pengguna_data WHERE active = 1)*100 AS UNSIGNED) AS persenwifi");
        return $query->row_array();
    }
    function getPercentListrik()
    {
        $query = $this->db->query("
        SELECT 
        CAST((SELECT COUNT(*) FROM transaksi WHERE MONTH(tgl_lunas) = MONTH(CURRENT_TIMESTAMP) AND id_transaksi LIKE '%LIS%')/
        (SELECT COUNT(*) FROM pengguna_data WHERE active = 1)*100 AS UNSIGNED) AS persenlistrik");
        return $query->row_array();
    }

    function getTransaksi_Wifi($id)
    {
        $this->db->select('CONCAT("TGWIFI",pbw.id_bayar) idtagih, k.no_kamar nokamar, k.wifi hargawifi, trw.status status, harga hargadeal');
        $this->db->from('pembayaran pbw');
        $this->db->join('list_bulan bl', 'pbw.id_bulan = bl.id_bulan');
        $this->db->join('kamar k', 'k.id_kamar = pbw.id_kamar', 'left');
        $this->db->join('pengguna_data p', ' k.id_kamar = p.id_kamar', 'left');
        $this->db->join('transaksi trw', 'trw.id_bayar = pbw.id_bayar', 'left');
        $this->db->where('pbw.id_bulan', $id[0]);
        $this->db->where('YEAR(pbw.datecreate)', $id[1]);
        $this->db->where('pbw.ket', 'wifi');
        $this->db->where('p.active', 1);

        $query = $this->db->get();
        return $query->result_array();
    }
    function getTransaksi_Listrik($id)
    {
        $this->db->select('CONCAT("TGLIS",pbw.id_bayar) idtagih, k.no_kamar nokamar, k.listrik hargalistrik, trw.status status, harga hargadeal');
        $this->db->from('pembayaran pbw');
        $this->db->join('list_bulan bl', 'pbw.id_bulan = bl.id_bulan');
        $this->db->join('kamar k', 'k.id_kamar = pbw.id_kamar', 'left');
        $this->db->join('pengguna_data p', ' k.id_kamar = p.id_kamar', 'left');
        $this->db->join('transaksi trw', 'trw.id_bayar = pbw.id_bayar', 'left');
        $this->db->where('pbw.id_bulan', $id[0]);
        $this->db->where('YEAR(pbw.datecreate)', $id[1]);
        $this->db->where('pbw.ket', 'listrik');
        $this->db->where('p.active', 1);

        $query = $this->db->get();
        return $query->result_array();
    }

    //============================= ADD Tagihan WIFI By New id_kamar ==============================

    function getKamar_Wifi($id)
    {
        $query = $this->db->query("SELECT k.id_kamar, no_kamar FROM kamar k JOIN pengguna_data pd ON k.`id_kamar` = pd.`id_kamar` WHERE k.id_kamar NOT IN (SELECT id_kamar FROM pembayaran WHERE ket = 'wifi' AND id_bulan = " . $id[0] . ") AND pd.active = 1");
        return $query->result_array();
    }
    function getKamar_Listrik($id)
    {
        $query = $this->db->query("SELECT k.id_kamar, no_kamar FROM kamar k JOIN pengguna_data pd ON k.`id_kamar` = pd.`id_kamar` WHERE k.id_kamar NOT IN (SELECT id_kamar FROM pembayaran WHERE ket = 'listrik' AND id_bulan = " . $id[0] . ") AND pd.active = 1");
        return $query->result_array();
    }
    function getDetKamarM($datadump)
    {
        $this->db->select("pd.nama nama, k." . $datadump['bagian'] . " " . $datadump['bagian'] . "");
        $this->db->from('kamar k');
        $this->db->join('pengguna_data pd', 'pd.id_kamar = k.id_kamar');
        $this->db->where("k.id_kamar", $datadump['idkamar']);
        $query = $this->db->get();
        return $query->row_array();
    }
}
