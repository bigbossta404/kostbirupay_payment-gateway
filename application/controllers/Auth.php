<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('akun');
    }

    public function index()
    {
        if ($this->session->userdata('akses') == '2') {
            redirect('pengurus', 'refresh');
        } elseif ($this->session->userdata('akses') == '3') {
            redirect('beranda', 'refresh');
        } else {

            $this->form_validation->set_rules('username', 'Username', 'required|trim', [
                'required' => 'Username wajib diisi'
            ]);
            $this->form_validation->set_rules('password', 'Password', 'required|trim', [
                'required' => 'Password wajib diisi'
            ]);
            if ($this->form_validation->run() == false) {
                $this->load->view('auth/login');
            } else {
                $this->_login();
            }
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');


        $user = $this->akun->getakun($username);
        $pengurus = $this->akun->getakunpengurus($username);
        if ($user) {
            if ($user['active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'id_pengguna' => $user['id_pengguna'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'notelp' => $user['notelp'],
                        'id_level' => $user['id_level'],
                        'id_kamar' => $user['id_kamar']
                    ];
                    $this->session->set_userdata('akses', '3');
                    $this->session->set_userdata($data);
                    $ceklog = $this->akun->getLogs($data);
                    if ($ceklog['username'] == null) {
                        $this->akun->create_newlog($data);
                    } else {
                        $this->akun->update_activelog($data);
                    }
                    redirect('beranda');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible" role="alert">
                   Password salah.
                    <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
                  </div>');

                    redirect('/');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible" role="alert">
                Akun belum aktif.
                <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
              </div>');

                redirect('/');
            }
        } elseif ($pengurus) {
            if ($pengurus['active'] == 1) {
                if (password_verify($password, $pengurus['password'])) {
                    $data = [
                        'id_pengurus' => $pengurus['id_pengurus'],
                        'username' => $pengurus['username'],
                        'email' => $pengurus['email'],
                        'bagian' => $pengurus['bagian']
                    ];
                    $this->session->set_userdata('akses', '2');
                    $this->session->set_userdata($data);
                    redirect('pengurus');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible" role="alert">
                   Password salah.
                    <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
                  </div>');

                    redirect('/');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible" role="alert">
                Akun belum aktif.
                <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
              </div>');

                redirect('/');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Username tidak terdaftar.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> </div>');

            redirect('/');
        }
    }

    public function daftar()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[pengguna_data.email]', [
            'is_unique' => 'Email sudah terdaftar'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[pengguna_data.username]', [
            'is_unique' => 'Username sudah terdaftar'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|matches[repassword]', [
            'matches' => 'password tidak sama!',
            'min_length' => 'Minimal 8 Karakter'
        ]);
        $this->form_validation->set_rules('repassword', 'Password', 'required|trim|matches[password]');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/daftar');
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'username' => $this->input->post('username', true),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'id_level' => 3,
                'active' => 0,
                'img' => 'default.jpg'
            ];

            $this->akun->daftar($data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
            Silahkan tunggu verifikasi dari pengurus
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> </div>');

            redirect('/');
        }
    }
    function logout()
    {
        if ($this->session->userdata('akses') == '3') {
            $data = $this->session->userdata('username');
            $this->akun->create_logout($data);
            $this->session->sess_destroy();
            redirect('/');
        } else {
            $this->session->sess_destroy();
            redirect('/');
        }
    }
}
