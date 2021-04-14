<div id="layoutSidenav_content">
    <main>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <div class="nav-item dropdown no-arrow ml-auto">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['nama'] ?></span>
                    <img class="img-profile rounded-circle" src="<?= ($user['img'] != null) ? base_url('asset/image/profile/' . $user['img']) : base_url('asset/image/profile/default.jpg')  ?>" width="40">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?= base_url('profile/usr') ?>">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400" style="font-size: 15px;"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400" style="font-size: 15px;"></i>
                        Keluar
                    </a>
                </div>
            </div>
        </nav>
        <div class="container-fluid contentdetuser">
            <div class="row">
                <div class="col-xl-8 mb-4 mt-4">
                    <div id="profile">
                        <label>Klik atau seret untuk unggah</label>
                    </div>
                    <input type="file" id="myfile" style="display: none;" />
                </div>
            </div>
            <div class=" col-xl-8 mb-5">
                <div class="card shadow boxdetuser">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" class="form-control border border-info" value="<?= $user['nama'] ?>">
                                <input type="hidden" name="keyhold" id="keyhold" class="form-control border border-info" value="<?= $user['id_pengguna'] ?>">
                                <small class="text-danger" id="nama_error"></small>
                            </div>

                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email" id="email" class="form-control border border-info" value="<?= $user['email'] ?>">
                                <small class="text-danger" id="email_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="">No. Telepon</label>
                                <input type="text" name="telp" id="telp" class="form-control border border-info" value="<?= $user['notelp'] ?>">
                                <small class="text-danger" id="telp_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control border border-info" rows="3"><?= $user['alamat'] ?></textarea>
                                <small class="text-danger" id="alamat_error"></small>
                            </div>
                        </div>
                        <div class="col-md-5 ml-auto">
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" id="username" class="form-control border border-info" value="<?= $user['username'] ?>">
                                <small class="text-danger" id="username_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="" id="tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="Lewati atau kosongkan bila tidak mau merubah password">Password <span class="text-primary"><i class="far fa-question-circle fa-xs"></i></span></label>
                                <input type="newpassword" name="newpassword" id="newpassword" class="form-control border border-info" value="" placeholder="(Reset password)">
                                <input type="hidden" name="password" id="password" class="form-control border border-info" value="<?= $user['password'] ?>" placeholder="(Reset password)">
                                <small class="text-danger" id="newpassword_error"></small>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100 mb-2 text-white btn_up_users">Simpan</button>
                                <a href="<?= base_url('user') ?>" class="btn btn-danger w-100">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class=" vectorimg">
        <img class="imgupdate" src="<?= base_url('asset/image/updatevector.png') ?>" alt="">
    </div>
</div>