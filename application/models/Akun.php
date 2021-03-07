<?php

class Akun extends CI_Model
{
    function daftar($data)
    {
        $this->db->insert('pengguna_data', $data);
    }
    function getakun($username)
    {
        $this->db->select('*');
        $this->db->from('pengguna_data');
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->row_array();
    }
    function getakunByID($id_pengguna)
    {
        $this->db->select('*');
        $this->db->from('pengguna_data');
        $this->db->where('id_pengguna', $id_pengguna);
        $query = $this->db->get();
        return $query->row_array();
    }

    function getkamar()
    {
        $this->db->select('id_kamar idkamar, no_kamar, cabang, kost, status');
        $this->db->from('kamar k');
        $this->db->order_by('id_kamar', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }
    function hapusByID($id_pengguna)
    {
        $this->db->delete('pengguna_data', array('id_pengguna' => $id_pengguna));
    }
    //========================== AKTIVITAS LOGIN USERS ====================================
    function getOnline()
    {
        $this->db->select('COUNT(*) online');
        $this->db->from('log_users');
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->row_array();
    }
    function getLogs($data)
    {
        $this->db->select('*');
        $this->db->from('log_users');
        $this->db->where('username', $data['username']);
        $query = $this->db->get();
        return $query->row_array();
    }
    function create_newlog($data)
    {
        $this->db->set('username', $data['username']);
        $this->db->set('status', 1);
        $this->db->set('time', 'NOW()', FALSE);
        $this->db->insert('log_users');
    }
    function update_activelog($data)
    {
        $this->db->set('status', 1);
        $this->db->set('time', 'NOW()', FALSE);
        $this->db->where('username', $data['username']);
        $this->db->update('log_users');
    }
    function create_logout($data)
    {

        $this->db->set('status', 0);
        $this->db->set('time', 'NOW()', FALSE);
        $this->db->where('username', $data['username']);
        $this->db->update('log_users');
    }
    //========================== END AKTIVITAS LOGIN USERS ====================================

    function getAllID()
    {
        $this->db->select('id_pengguna');
    }
    //========== PENGURUS

    function getakunpengurus($username)
    {
        $this->db->select('*');
        $this->db->from('pengurus_data');
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->row_array();
    }

    var $column_order = array('idpengguna', 'nama', 'username', 'no_kamar', 'active', null); //set column field database for datatable orderable
    var $column_search = array('nama', 'username', 'no_kamar', 'active'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = ['id_pengguna' => 'desc']; // default o
    private function _get_datatables_user()
    {

        $this->db->select('CONCAT("user", pd.id_pengguna) idpengguna, nama, username, no_kamar, active, pd.id_pengguna id_pengguna');
        $this->db->from('pengguna_data pd');
        $this->db->join('kamar k', 'k.id_kamar = pd.id_kamar', 'left');

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

    function get_datatablesuser()
    {
        $this->_get_datatables_user();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtereduser()
    {
        $this->_get_datatables_user();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_alluser()
    {
        $this->db->from($this->_get_datatables_user());

        return $this->db->count_all_results();
    }
}
