<div id="layoutSidenav_content">
    <main>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        </nav>
        <div class="container-fluid contentpengurus">
            <div class="headcontent">
                <?= $this->session->flashdata('pesan');
                ?>
                <h2>Akun User</h2>
                <div class="px-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modaladd">
                        Data <i class="fas fa-plus-circle"></i>
                    </button>
                </div>
            </div>
            <div id="alert-msg"></div>
            <div class="card bodycontent shadow">
                <div class="card-body">
                    <div class="tab-pane table-responsive">
                        <table id="tableuser" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>ID User</td>
                                    <td>Nama</td>
                                    <td>Username</td>
                                    <td>No Kamar</td>
                                    <td>Status</td>
                                    <td>#</td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <div class="vectorimg">
        <img class="imgupdate" src="<?= base_url('asset/image/updatevector.png') ?>" alt="">
    </div>
</div>

<div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row p-4">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" class="form-control border border-info" value="" placeholder="Nama Lengkap">
                            <small class="text-danger" id="nama_error"></small>
                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" id="email" class="form-control border border-info" value="" placeholder="emailmu@mail.com">
                            <small class="text-danger" id="email_error"></small>
                        </div>
                        <div class="form-group">
                            <label for="">No. Telepon</label>
                            <input type="number" name="telp" id="telp" class="form-control border border-info" value="" placeholder="cth. 081xx">
                            <small class="text-danger" id="telp_error"></small>
                        </div>
                        <div class="form-group">
                            <label for="">No. Kamar</label>
                            <select class="form-control border border-info" name="kamar" id="kamar">
                                <option value=" " selected>-- Pilih Kamar --</option>
                                <?php foreach ($kamar as $k) : ?>
                                    <option value="<?php echo $k['idkamar']; ?>"><?php echo $k['no_kamar'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-danger" id="kamar_error"></small>
                        </div>
                    </div>
                    <div class="col-md-5 ml-auto border-left border-4">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" name="username" id="username" class="form-control border border-info" value="" placeholder="Username">
                            <small class="text-danger" id="username_error"></small>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" id="password" class="form-control border border-info" value="" placeholder="Password">
                            <small class="text-danger" id="password_error"></small>
                        </div>
                        <div class="form-group">
                            <label for="">Ulangi Password</label>
                            <input type="password" name="repassword" id="repassword" class="form-control border border-info" value="" placeholder="Ulang password">
                            <small class="text-danger" id="repassword_error"></small>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn_tambah">Tambah Data</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalactive" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aktivasi Akun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row p-4">
                    <div class="col">
                        <div class="form-group">
                            <select type="text" name="active" id="active" class="form-control border border-info">
                                <option value="1">Aktif</option>
                                <option value="0">Non-AKtif</option>
                            </select>
                            <small class="text-danger" id="active_error"></small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn_active" id="">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>