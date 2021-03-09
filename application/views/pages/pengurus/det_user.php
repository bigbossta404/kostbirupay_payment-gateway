<div id="layoutSidenav_content">
    <main>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        </nav>
        <div class="container-fluid contentdetuser">
            <div class="headcontent">
                <h2>Detail User</h2>

            </div>
            <div class="col-xl-8 mb-5">
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
                                <label for="">No. Kamar</label>
                                <select class="form-control border border-info " name="kamar" id="kamar">
                                    <?php foreach ($kamar as $k) : ?>
                                        <option value="<?php echo $k['idkamar']; ?>" <?php echo ($k['idkamar'] == $user['id_kamar']) ? "selected = 'selected'" : "" ?>><?php echo $k['no_kamar'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="text-danger" id="kamar_error"></small>
                            </div>
                            <div class="form-group">
                                <label for="">Tagihan</label>
                                <input type="text" name="tagihanwifi" id="tagihanwifi" class="form-control border border-info" value="<?= $detkamar['wifi'] ?>">
                                <small class="text-danger" id="tagihanwifi_error"></small>
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