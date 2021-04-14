<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pengguna extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-SUgyYd_evM9QK4Jdx9QiacG5', 'production' => false);
        $this->load->library('midtrans');
        $this->midtrans->config($params);
        $this->load->helper('url');
        $this->load->model('tagihan');
        $this->load->model('transaksi');
        $this->load->model('akun');
    }

    public function index()
    {
        if ($this->session->userdata('akses') == '3') {
            $username = $this->session->userdata('username');
            $data['user'] = $this->akun->getakun($username);
            $data['updatekost'] = $this->tagihan->getupdatekost($username);
            $data['updatelistrik'] = $this->tagihan->getupdatelistrik($username);
            $data['updatewifi'] = $this->tagihan->getupdatewifi($username);

            $data['title'] = 'Dashboard';
            $this->load->view('layout/header_pengguna', $data);
            $this->load->view('pages/pengguna_v', $data);
            $this->load->view('layout/footer_pengguna');
        } else {
            redirect('/');
        }
    }
    public function indexkost()
    {
        if ($this->session->userdata('akses') == '3') {
            $username = $this->session->userdata('username');
            $data['user'] = $this->akun->getakun($username);

            $data['title'] = 'Dashboard';
            $this->load->view('layout/header_pengguna', $data);
            $this->load->view('pages/tagihankost');
            $this->load->view('layout/footer_pengguna');
        } else {
            redirect('/');
        }
    }
    public function tagihankost()
    {
        if ($this->session->userdata('akses') == '3') {
            $idkamar = $this->session->userdata('id_kamar');
            // $list = $this->tagihan->_get_datatables($idkamar);
            $list = $this->tagihan->get_datatableskost($idkamar);
            $data = array();
            foreach ($list as $tagih) {
                $row = array();
                $format = number_format($tagih->harga, '0', '', '.');
                if ($tagih->status == 200 || $tagih->status == 201) {
                    $row[] = "<a href='kost/transaksikost-$tagih->idbayar'>#$tagih->idtagih</a>";
                } else {
                    $row[] = "<p>#$tagih->idtagih</p>";
                }
                $row[] = "<input type='text' value='$tagih->bulan' id='bulan' class='rowtagihan' name='bulan' form='payment-form' readonly>";
                $row[] = "<input type='number' value='$format' id='harga' class='rowtagihan' name='harga' form='payment-form' readonly>";
                if ($tagih->status == 200) {
                    $row[] = "<span class='badge bg-success' style='color:white'>Lunas</span>";
                } elseif ($tagih->status == 201) {
                    $row[] = "<span class='badge bg-warning' style='color:black'>Pending</span>";
                } else {
                    $row[] = "<span class='badge bg-danger' style='color:white'>Belum Bayar</span>";
                };
                if ($tagih->status == 200 || $tagih->status == 201) {
                    $row[] = "<button class='btn btn-primary' disabled>Bayar</button>";
                } else {
                    $row[] = "<button class='btn btn-primary' id='pay-kost' data-id='$tagih->idbayar'>Bayar</button>";
                }


                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->tagihan->count_allkost($idkamar),
                "recordsFiltered" => $this->tagihan->count_filteredkost($idkamar),
                "data" => $data,
            );

            echo json_encode($output);
        } else {
            redirect('/');
        }
    }

    public function indexlistrik()
    {
        if ($this->session->userdata('akses') == '3') {
            $username = $this->session->userdata('username');
            $data['user'] = $this->akun->getakun($username);

            $data['title'] = 'Dashboard';
            $this->load->view('layout/header_pengguna', $data);
            $this->load->view('pages/tagihanlistrik');
            $this->load->view('layout/footer_pengguna');
        } else {
            redirect('/');
        }
    }
    public function tagihanlistrik()
    {
        if ($this->session->userdata('akses') == '3') {


            $idkamar = $this->session->userdata('id_kamar');
            // $list = $this->tagihan->_get_datatables($idkamar);
            $list = $this->tagihan->get_datatableslistrik($idkamar);
            $data = array();
            foreach ($list as $tagih) {
                $row = array();
                $format = number_format($tagih->harga, '0', '', '.');
                if ($tagih->status == 200 || $tagih->status == 201) {
                    $row[] = "<a href='beranda/transaksikost-$tagih->idbayar'>#$tagih->idtagih</a>";
                } else {
                    $row[] = "<p>#$tagih->idtagih</p>";
                }
                $row[] = "<input type='text' value='$tagih->bulan' id='bulan' class='rowtagihan' name='bulan' form='payment-form' readonly>";
                $row[] = "<input type='number' value='$format' id='harga' class='rowtagihan' name='harga' form='payment-form' readonly>";
                if ($tagih->status == 200) {
                    $row[] = "<span class='badge bg-success' style='color:white'>Lunas</span>";
                } elseif ($tagih->status == 201) {
                    $row[] = "<span class='badge bg-warning' style='color:black'>Pending</span>";
                } else {
                    $row[] = "<span class='badge bg-danger' style='color:white'>Belum Bayar</span>";
                };
                if ($tagih->status == 200 || $tagih->status == 201) {
                    $row[] = "<button class='btn btn-primary' disabled>Bayar</button>";
                } else {
                    $row[] = "<button class='btn btn-primary' id='pay-listrik' data-id='$tagih->idbayar'>Bayar</button>";
                }


                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->tagihan->count_alllistrik($idkamar),
                "recordsFiltered" => $this->tagihan->count_filteredlistrik($idkamar),
                "data" => $data,
            );

            echo json_encode($output);
        } else {
            redirect('/');
        }
    }
    public function indexwifi()
    {
        if ($this->session->userdata('akses') == '3') {
            $username = $this->session->userdata('username');
            $data['user'] = $this->akun->getakun($username);

            $data['title'] = 'Dashboard';
            $this->load->view('layout/header_pengguna', $data);
            $this->load->view('pages/tagihanwifi');
            $this->load->view('layout/footer_pengguna');
        } else {
            redirect('/');
        }
    }
    public function tagihanwifi()
    {
        if ($this->session->userdata('akses') == '3') {


            $idkamar = $this->session->userdata('id_kamar');
            // $list = $this->tagihan->_get_datatables($idkamar);
            $list = $this->tagihan->get_datatableswifi($idkamar);
            $data = array();
            foreach ($list as $tagih) {
                $row = array();
                $format = number_format($tagih->harga, '0', '', '.');
                if ($tagih->status == 200 || $tagih->status == 201) {
                    $row[] = "<a href='kost/transaksikost-$tagih->idbayar'>#$tagih->idtagih</a>";
                } else {
                    $row[] = "<p>#$tagih->idtagih</p>";
                }
                $row[] = "<input type='text' value='$tagih->bulan' id='bulan' class='rowtagihan' name='bulan' form='payment-form' readonly>";
                $row[] = "<input type='number' value='$format' id='harga' class='rowtagihan' name='harga' form='payment-form' readonly>";
                if ($tagih->status == 200) {
                    $row[] = "<span class='badge bg-success' style='color:white'>Lunas</span>";
                } elseif ($tagih->status == 201) {
                    $row[] = "<span class='badge bg-warning' style='color:black'>Pending</span>";
                } else {
                    $row[] = "<span class='badge bg-danger' style='color:white'>Belum Bayar</span>";
                };
                if ($tagih->status == 200 || $tagih->status == 201) {
                    $row[] = "<button class='btn btn-primary' disabled>Bayar</button>";
                } else {
                    $row[] = "<button class='btn btn-primary' id='pay-wifi' data-id='$tagih->idbayar'>Bayar</button>";
                }


                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->tagihan->count_allwifi($idkamar),
                "recordsFiltered" => $this->tagihan->count_filteredwifi($idkamar),
                "data" => $data,
            );

            echo json_encode($output);
        } else {
            redirect('/');
        }
    }

    public function det_transaksi($idbayar)
    {
        if ($this->session->userdata('akses') == '3') {
            $username = $this->session->userdata('username');
            $data['user'] = $this->akun->getakun($username);
            $data['title'] = 'Transaksi';
            $data['det_transak'] = $this->transaksi->getDetKost($idbayar);
            $this->load->view('layout/header_pengguna', $data);
            $this->load->view('pages/detailtransaksi', $data);
            $this->load->view('layout/footer_pengguna');
        } else {
            redirect('/');
        }
    }
    public function index_history_bayar()
    {
        if ($this->session->userdata('akses') == '3') {
            $username = $this->session->userdata('username');
            $data['user'] = $this->akun->getakun($username);
            $data['title'] = 'History Pembayaran';
            // $data['det_transak'] = $this->transaksi->getDetKost($idbayar);
            $this->load->view('layout/header_pengguna', $data);
            $this->load->view('pages/historybayar', $data);
            $this->load->view('layout/footer_pengguna');
        } else {
            redirect('/');
        }
    }
    public function history_bayar()
    {
        if ($this->session->userdata('akses') == '3') {
            $id_pengguna = $this->session->userdata('id_pengguna');
            $list = $this->transaksi->get_datatablesHistory($id_pengguna);
            $data = array();
            foreach ($list as $hw) {
                $row = array();
                $row[] = $hw->id_transaksi;
                $row[] = $hw->bulan;
                $row[] = $hw->harga;
                $row[] = $hw->pay_type;
                $row[] = $hw->bank;
                $row[] = $hw->tgl_invoice;
                if ($hw->status == 201) {
                    $row[] = "<button class='btn btn-success' disabled>Invoice</button>";
                } else {
                    $row[] = "<button class='btn btn-success'>Invoice</button>";
                }
                $data[] = $row;
            }
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->transaksi->count_allHistory($id_pengguna),
                "recordsFiltered" => $this->transaksi->count_filteredHistory($id_pengguna),
                "data" => $data,
            );

            echo json_encode($output);
        } else {
            redirect('/');
        }
    }

    public function index_inventaris()
    {
        if ($this->session->userdata('akses') == '3') {
            $username = $this->session->userdata('username');
            $data['user'] = $this->akun->getakun($username);
            $data['title'] = 'Inventaris';
            $this->load->view('layout/header_pengguna', $data);
            $this->load->view('pages/inventaris', $data);
            $this->load->view('layout/footer_pengguna');
        } else {
            redirect('/');
        }
    }

    public function getInvenWifi()
    {
        if ($this->session->userdata('akses') == '3') {
            $list = $this->transaksi->get_datatables_in_wifi();
            $data = array();
            foreach ($list as $iw) {
                $row = array();
                $row[] = 'Rp. ' . number_format($iw->pemasukan, '0', '', '.');
                $row[] = 'Rp. ' . number_format($iw->pengeluaran, '0', '', '.');
                $row[] = 'Rp. ' . number_format($iw->saldo, '0', '', '.');
                $row[] = $iw->ket;
                $row[] = $iw->tgl_transaksi;
                $row[] = '<a href="" class="btn btn-success"> Struk </a>';
                $data[] = $row;
            }
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->transaksi->count_all_in_w(),
                "recordsFiltered" => $this->transaksi->count_filtered_in_w(),
                "data" => $data,
            );

            echo json_encode($output);
        } else {
            redirect('/');
        }
    }
    public function getInvenListrik()
    {
        if ($this->session->userdata('akses') == '3') {
            $list = $this->transaksi->get_datatables_in_listrik();
            $data = array();
            foreach ($list as $il) {
                $row = array();
                $row[] = 'Rp. ' . number_format($il->pemasukan, '0', '', '.');
                $row[] = 'Rp. ' . number_format($il->pengeluaran, '0', '', '.');
                $row[] = 'Rp. ' . number_format($il->saldo, '0', '', '.');
                $row[] = $il->ket;
                $row[] = $il->tgl_transaksi;
                $row[] = '<a href="" class="btn btn-success"> Struk </a>';
                $data[] = $row;
            }
            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->transaksi->count_all_in_l(),
                "recordsFiltered" => $this->transaksi->count_filtered_in_l(),
                "data" => $data,
            );

            echo json_encode($output);
        } else {
            redirect('/');
        }
    }
    public function index_detakunuser()
    {
        if ($this->session->userdata('akses') == '3') {
            $username = $this->session->userdata('username');
            $data['user'] = $this->akun->getakun($username);
            $data['kamar'] = $this->akun->getkamar();
            $data['detkamar'] = $this->akun->another_getkamar($username);

            $data['title'] = 'Detail User';
            $this->load->view('layout/header_pengguna', $data);
            $this->load->view('pages/det_user_low', $data);
            $this->load->view('layout/footer_pengguna');
        } else {
            redirect('/');
        }
    }
}
