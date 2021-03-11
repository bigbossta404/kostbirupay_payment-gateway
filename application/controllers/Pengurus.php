<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pengurus extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('tagihan');
        $this->load->model('transaksi');
        $this->load->model('akun');
        $this->load->helper('date');
    }

    public function index()
    {
        if ($this->session->userdata('akses') == '2' && $this->session->userdata('bagian') == 'wifi') {
            $username = $this->session->userdata('username');

            $data['pengurus'] = $this->akun->getakunpengurus($username);
            $data['getdebitwifi'] = $this->transaksi->get_monthly_wifi();
            $data['getdebitlistrik'] = $this->transaksi->get_monthly_listrik();
            $data['getsaldo'] = $this->transaksi->get_saldo();
            $data['online'] = $this->akun->getOnline();
            $data['persen'] = $this->tagihan->getPercentWifi();
            // echo $data['getdebit']['uangwifi'];
            $data['title'] = 'Dashboard';
            $this->load->view('layout/pengurus/header_pengurus', $data);
            $this->load->view('pages/pengurus/pengurus_wifi', $data);
            $this->load->view('layout/pengurus/footer_pengurus');
        } elseif ($this->session->userdata('akses') == '2' && $this->session->userdata('bagian') == 'listrik') {
            $username = $this->session->userdata('username');

            $data['pengurus'] = $this->akun->getakunpengurus($username);
            $data['getdebitwifi'] = $this->transaksi->get_monthly_wifi();
            $data['getdebitlistrik'] = $this->transaksi->get_monthly_listrik();
            $data['getsaldo'] = $this->transaksi->get_saldo();
            $data['online'] = $this->akun->getOnline();
            $data['persen'] = $this->tagihan->getPercentWifi();
            // echo $data['getdebit']['uangwifi'];
            $data['title'] = 'Dashboard';
            $this->load->view('layout/pengurus/header_pengurus', $data);
            $this->load->view('pages/pengurus/pengurus_wifi', $data);
            $this->load->view('layout/pengurus/footer_pengurus');
        } else {
            redirect('/');
        }
    }

    public function index_akunuser()
    {
        if ($this->session->userdata('akses') == '2') {
            $username = $this->session->userdata('username');
            $data['pengurus'] = $this->akun->getakunpengurus($username);
            $data['kamar'] = $this->akun->getkamar();


            $data['title'] = 'Akun User';
            $this->load->view('layout/pengurus/header_pengurus', $data);
            $this->load->view('pages/pengurus/akun_user', $data);
            $this->load->view('layout/pengurus/footer_pengurus');
        } else {
            redirect('/');
        }
    }

    public function akunuser()
    {
        if ($this->session->userdata('akses') == '2') {
            $list = $this->akun->get_datatablesuser();
            $data = array();
            foreach ($list as $us) {
                $row = array();
                $row[] = "<a href='user/$us->username'> $us->idpengguna </a>";
                $row[] = $us->nama;
                $row[] = $us->username;
                $row[] = $us->no_kamar;
                if ($us->active == 1) {
                    $row[] = "<span class='badge bg-success' style='color:white; padding:8px'>Aktif</span>";
                } else {
                    $row[] = "<span class='badge bg-warning' style='color:black; padding:8px'>Non-Aktif</span>";
                };
                $row[] =  '<button class="btn btn-primary btn_active" data-toggle="modal" id="' . $us->id_pengguna . '">Aktivasi</button>
                            <button class="btn btn-danger btn_hapusakun" id="' . $us->id_pengguna . '">Hapus</button>';
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->akun->count_alluser(),
                "recordsFiltered" => $this->akun->count_filtereduser(),
                "data" => $data,
            );

            echo json_encode($output);
        } else {
            redirect('/');
        }
    }

    public function getdetakunuser($username)
    {
        if ($this->session->userdata('akses') == '2' && $this->session->userdata('bagian') == 'wifi') {
            $pengurususer = $this->session->userdata('username');
            $data['pengurus'] = $this->akun->getakunpengurus($pengurususer);
            $data['user'] = $this->akun->getakun($username);
            $data['kamar'] = $this->akun->getkamar();
            $data['detkamar'] = $this->akun->another_getkamar($username);
            // var_dump($data['user']);
            $data['title'] = 'Detail User';
            $this->load->view('layout/pengurus/header_pengurus', $data);
            $this->load->view('pages/pengurus/det_user', $data);
            $this->load->view('layout/pengurus/footer_pengurus');
        } elseif ($this->session->userdata('akses') == '2' && $this->session->userdata('bagian') == 'listrik') {
            echo 'laman pengurus listrik';
        } else {
            redirect('/');
        }
    }

    public function buatakun()
    {
        if ($this->session->userdata('akses') == '2' && $this->session->userdata('bagian') == 'wifi') {
            $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
                'required' => 'Nama wajib isi'
            ]);
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[pengguna_data.email]', [
                'is_unique' => 'Email sudah terdaftar',
                'required' => 'Email wajib isi',
                'valid_email' => 'Format email harus valid'
            ]);
            $this->form_validation->set_rules('telp', 'Telp', 'trim|numeric|min_length[12]|max_length[13]', [
                'numeric' => 'Nomor tidak valid',
                'min_length' => 'Minumum 12 digit',
                'max_length' => 'Maximum 13 digit'
            ]);
            $this->form_validation->set_rules('kamar', 'Kamar', 'required|trim|numeric', [
                'required' => 'Pilih kamar',
                'numeric' => 'Data kamar tidak valid'
            ]);
            $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[pengguna_data.username]', [
                'is_unique' => 'Username sudah terdaftar',
                'required' => 'Username Wajib isi',

            ]);
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|matches[repassword]', [
                'matches' => 'password tidak sama!',
                'min_length' => 'Minimal 8 Karakter',
                'required' => 'Password wajib isi'
            ]);
            $this->form_validation->set_rules('repassword', 'Password', 'required|trim|matches[password]');

            if ($this->form_validation->run() == false) {
                $data = array(
                    'error'   => true,
                    'nama_error' => form_error('nama'),
                    'email_error' => form_error('email'),
                    'telp_error' => form_error('telp'),
                    'kamar_error' => form_error('kamar'),
                    'username_error' => form_error('username'),
                    'password_error' => form_error('password'),
                    'repassword_error' => form_error('repassword')
                );
                echo json_encode($data);
            } else {
                $alert = array(
                    'success' => '<div class="alert alert-success">Data berhasil ditambah  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button> </div>'
                );
                $data = [
                    'nama' => htmlspecialchars($this->input->post('nama', true)),
                    'username' => $this->input->post('username', true),
                    'email' => htmlspecialchars($this->input->post('email', true)),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'notelp' => $this->input->post('telp', true),
                    'id_kamar' => $this->input->post('kamar', true),
                    'id_level' => 3,
                    'active' => 1,
                    'img' => 'default.jpg'
                ];

                echo json_encode($alert);
                $this->akun->daftar($data);
            }
        } elseif ($this->session->userdata('akses') == '2' && $this->session->userdata('bagian') == 'listrik') {
            echo 'laman pengurus listrik';
        } else {
            redirect('/');
        }
    }
    public function getactivedata($id_pengguna)
    {
        if ($this->session->userdata('akses') == '2' && $this->session->userdata('bagian') == 'wifi') {
            $data = $this->akun->getakunByID($id_pengguna);
            echo json_encode($data);
        } elseif ($this->session->userdata('akses') == '2' && $this->session->userdata('bagian') == 'listrik') {
            echo 'laman pengurus listrik';
        } else {
            redirect('/');
        }
    }
    public function updateactive()
    {
        if ($this->session->userdata('akses') == '2' && $this->session->userdata('bagian') == 'wifi') {
            $this->form_validation->set_rules('active', 'Active', 'required|trim|numeric', [
                'required' => 'Wajib pilih mas',
                'numeric' => 'Gk usah jail reload dulu'
            ]);

            if ($this->form_validation->run() == false) {
                $data = array(
                    'error'   => true,
                    'active_error' => form_error('active')
                );
                echo json_encode($data);
            } else {

                $id = $this->input->post('id', true);
                $idactive = $this->input->post('active', true);
                if ($idactive == 0) {
                    $alert = array(
                        'success' => '<div class="alert alert-success">Akun dinon-aktifkan<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button> </div>'
                    );
                    $data = [
                        'active' => $idactive
                    ];
                    $this->db->update('pengguna_data', $data, array('id_pengguna' => $id));
                    echo json_encode($alert);
                } elseif ($idactive == 1) {
                    $alert = array(
                        'success' => '<div class="alert alert-success">Akun berhasil diaktifkan<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button> </div>'
                    );
                    $data = [
                        'active' => $idactive
                    ];
                    $this->db->update('pengguna_data', $data, array('id_pengguna' => $id));
                    echo json_encode($alert);
                } else {
                    $alert = array(
                        'error' => '<div class="alert alert-warning"><b>ERROR:</b> Tidak valid!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button> </div>'
                    );
                    echo json_encode($alert);
                }
            }
        } elseif ($this->session->userdata('akses') == '2' && $this->session->userdata('bagian') == 'listrik') {
            echo 'laman pengurus listrik';
        } else {
            redirect('/');
        }
    }

    public function hapusakun($id)
    {
        if ($this->session->userdata('akses') == '2' && $this->session->userdata('bagian') == 'wifi') {
            $this->akun->hapusByID($id);
        } elseif ($this->session->userdata('akses') == '2' && $this->session->userdata('bagian') == 'listrik') {
            echo 'laman pengurus listrik';
        } else {
            redirect('/');
        }
    }

    public function updateuser()
    {
        if ($this->session->userdata('akses') == '2' && $this->session->userdata('bagian') == 'wifi') {
            $id = $this->input->post('id', true);
            $user = $this->input->post('user');
            $cekpass = $this->input->post('newpass');
            $cekwifi = $this->input->post('tagihanwifi');
            $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
                'required' => 'Nama wajib isi'
            ]);
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
                'required' => 'Email wajib isi',
                'valid_email' => 'Format email harus valid'
            ]);
            $this->form_validation->set_rules('telp', 'Telp', 'trim|numeric|min_length[12]|max_length[13]', [
                'numeric' => 'Nomor tidak valid',
                'min_length' => 'Minumum 12 digit',
                'max_length' => 'Maximum 13 digit'
            ]);
            $this->form_validation->set_rules('user', 'User', 'required|trim', [
                'required' => 'Username Wajib isi'

            ]);
            $this->form_validation->set_rules('newpass', 'Newpass', 'trim|min_length[8]', [
                'min_length' => 'Minimal 8 Karakter'
            ]);
            $this->form_validation->set_rules('kamar', 'Kamar', 'required|trim|numeric', [
                'required' => 'Pilih kamar',
                'numeric' => 'Data kamar tidak valid'
            ]);
            $this->form_validation->set_rules('tagihanwifi', 'Tagihanwifi', 'required|trim|numeric', [
                'required' => 'Isi nominal tagihan wifi',
                'numeric' => 'Data tagihan tidak valid'
            ]);

            if ($this->form_validation->run() == false) {
                $data = array(
                    'error'   => true,
                    'nama_error' => form_error('nama'),
                    'email_error' => form_error('email'),
                    'telp_error' => form_error('telp'),
                    'username_error' => form_error('user'),
                    'newpassword_error' => form_error('newpass'),
                    'kamar_error' => form_error('kamar'),
                    'tagihanwifi_error' => form_error('tagihanwifi')
                );
                echo json_encode($data);
            } else {
                if ($cekpass == null) {
                    $alert = array(
                        'success' => true,
                        'userslah' => $user,
                    );
                    $data = [
                        'nama' => htmlspecialchars($this->input->post('nama', true)),
                        'username' => $this->input->post('user', true),
                        'email' => htmlspecialchars($this->input->post('email', true)),
                        'password' => $this->input->post('pass'),
                        'notelp' => $this->input->post('telp', true),
                        'alamat' => $this->input->post('alamat', true),
                        'id_kamar' => $this->input->post('kamar', true)
                    ];


                    $wifi = "UPDATE kamar k JOIN pengguna_data pd ON pd.id_kamar = k.id_kamar SET wifi = " . $cekwifi . " WHERE pd.id_pengguna = " . $id . " ";
                    $this->db->query($wifi);

                    $this->db->update('pengguna_data', $data, array('id_pengguna' => $id));

                    echo json_encode($alert);
                } elseif ($cekpass != null) {
                    $alert = array(
                        'success' => true,
                        'userslah' => $user,
                    );
                    $data = [
                        'nama' => htmlspecialchars($this->input->post('nama', true)),
                        'username' => $this->input->post('user', true),
                        'email' => htmlspecialchars($this->input->post('email', true)),
                        'password' => password_hash($this->input->post('newpass'), PASSWORD_DEFAULT),
                        'notelp' => $this->input->post('telp', true),
                        'alamat' => $this->input->post('alamat', true),
                        'id_kamar' => $this->input->post('kamar', true)
                    ];

                    $wifi = "UPDATE kamar k JOIN pengguna_data pd ON pd.id_kamar = k.id_kamar SET wifi = " . $cekwifi . " WHERE pd.id_pengguna = " . $id . " ";
                    $this->db->query($wifi);


                    $this->db->update('pengguna_data', $data, array('id_pengguna' => $id));

                    echo json_encode($alert);
                } else {
                    $alert = array(
                        'gagal' => true,
                        'userslah' => $user,
                    );
                    echo json_encode($alert);
                }
            }
        } elseif ($this->session->userdata('akses') == '2' && $this->session->userdata('bagian') == 'listrik') {
            echo 'laman pengurus listrik';
        } else {
            redirect('/');
        }
    }
    public function index_bayarwifi()
    {
        if ($this->session->userdata('akses') == '2' && $this->session->userdata('bagian') == 'wifi') {
            $username = $this->session->userdata('username');
            $data['pengurus'] = $this->akun->getakunpengurus($username);
            $data['bulancek'] = $this->tagihan->wifionbulan();
            $data['title'] = 'Detail User';
            $this->load->view('layout/pengurus/header_pengurus', $data);
            $this->load->view('pages/pengurus/pem_wifi', $data);
            $this->load->view('layout/pengurus/footer_pengurus');
        } elseif ($this->session->userdata('akses') == '2' && $this->session->userdata('bagian') == 'listrik') {
            echo 'laman pengurus listrik';
        } else {
            redirect('/');
        }
    }
    public function readtagihanwifi()
    {
        if ($this->session->userdata('akses') == '2' && $this->session->userdata('bagian') == 'wifi') {
            $list = $this->tagihan->get_datatablesTwifi();
            $data = array();
            $i = 1;
            foreach ($list as $wf) {
                $row = array();
                $row[] = $i++;
                $row[] = '<a href="pembayaran-wifi/' . $wf->idbulan . '-' . $wf->tahun . '" class="bulanwifi" id="' . $wf->idbulan . ' ' . $wf->tahun . '">' . $wf->bulan . '</a>';
                $row[] = $wf->datecreate;
                $row[] =  '<button class="btn btn-danger btn_hapusakun" id="' . $wf->datecreate . '">Hapus</button>';
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->tagihan->count_allTwifi(),
                "recordsFiltered" => $this->tagihan->count_filteredTwifi(),
                "data" => $data,
            );

            echo json_encode($output);
        } elseif ($this->session->userdata('akses') == '2' && $this->session->userdata('bagian') == 'listrik') {
            echo 'laman pengurus listrik';
        } else {
            redirect('/');
        }
    }
    public function create_tagihanwifi()
    {
        $id = $this->tagihan->get_id_akun();

        $this->form_validation->set_rules('idbulan', 'Idbulan', 'required|numeric');
        if ($this->form_validation->run() == false) {
            $data = array(
                'error' => true,
                'alert' => '<div class="alert alert-danger"><b>ERROR:</b> Silahkan cek, apakah ada data yang kosong atau tidak valid!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button> </div>'
            );
            echo json_encode($data);
        } else {
            $idbulan = $this->input->post('idbulan', true);
            if ($id != null) {
                foreach ($id as $i) {
                    $this->db->set('id_bulan', $idbulan);
                    $this->db->set('id_kamar', $i['id_kamar']);
                    $this->db->set('ket', 'wifi');
                    $this->db->set('datecreate', 'NOW()', false);
                    $this->db->insert('pembayaran');
                }
                $data = array(
                    'success' => true
                );
                echo json_encode($data);
            } else {
                $data = array(
                    'error' => true,
                    'alert' => '<div class="alert alert-danger"><b>ERROR:</b> Silahkan cek, apakah ada data yang kosong atau tidak valid!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button> </div>'
                );
                echo json_encode($data);
            }
        }
    }

    public function index_transaksiwifi($idwaktu)
    {
        if ($this->session->userdata('akses') == '2' && $this->session->userdata('bagian') == 'wifi') {
            $username = $this->session->userdata('username');
            $data['pengurus'] = $this->akun->getakunpengurus($username);
            $id = explode('-', $idwaktu);
            $data['det_tagihan_wifi'] = $this->tagihan->getTransaksi_Wifi($id);
            $data['kamar'] = $this->tagihan->getKamar_Wifi($id);

            $data['title'] = 'Transaksi User';
            $this->load->view('layout/pengurus/header_pengurus', $data);
            $this->load->view('pages/pengurus/transaksi_wifi', $data);
            $this->load->view('layout/pengurus/footer_pengurus');
        } elseif ($this->session->userdata('akses') == '2' && $this->session->userdata('bagian') == 'listrik') {
            echo 'laman pengurus listrik';
        } else {
            redirect('/');
        }
    }

    public function getDetKamar_Wifi($idkamar)
    {
        $data = $this->tagihan->getDetKamar_Wifi($idkamar);
        echo json_encode($data);
    }

    public function newTagihan_Wifi()
    {

        // $this->form_validation->set_rules('idkamar', 'IdKamar', 'required|numeric|greater_than[0]');
        $bulan = $this->input->post('idbulan');
        $rowbulan = explode('-', $bulan);
        $this->form_validation->set_rules('idkamar', 'Idkamar', 'required|numeric|greater_than[0]');
        if ($this->form_validation->run() == false) {
            $alert = array(
                'error' => true,
                'alert' => '<div class="alert alert-warning"><b>ERROR:</b> Tidak valid!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button> </div>',
                'msg' => validation_errors()
            );
            echo json_encode($alert);
        } else {
            $alert = array(
                'success' => true
            );

            $data = [
                'id_bulan' => $rowbulan[0],
                'id_kamar' => $this->input->post('idkamar'),
                'ket' => 'wifi'
            ];

            $this->db->set('datecreate', 'NOW()', false);
            $this->db->insert('pembayaran', $data);
            echo json_encode($alert);
        }
    }

    public function index_keuangan()
    {
        if ($this->session->userdata('akses') == '2' && $this->session->userdata('bagian') == 'wifi') {
            $username = $this->session->userdata('username');
            $data['pengurus'] = $this->akun->getakunpengurus($username);
            $data['getsaldo'] = $this->transaksi->get_saldo();
            $data['title'] = 'Keuangan';
            $this->load->view('layout/pengurus/header_pengurus', $data);
            $this->load->view('pages/pengurus/keuangan', $data);
            $this->load->view('layout/pengurus/footer_pengurus');
        } elseif ($this->session->userdata('akses') == '2' && $this->session->userdata('bagian') == 'listrik') {
            echo 'laman pengurus listrik';
        } else {
            redirect('/');
        }
    }
}
