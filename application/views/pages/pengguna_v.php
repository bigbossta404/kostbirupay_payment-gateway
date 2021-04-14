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
        <div class="container-fluid beranda">
            <div class="headcontent">
                <h2>Tagihan Terbaru</h2>
            </div>
            <a href="<?= base_url('kost') ?>" class="cardopen" id="klikbox">
                <div class="card bodycontent selectbox contentkost">
                    <div class="icon">
                        <i class="fas fa-bed"></i>
                    </div>
                    <div class="label">
                        <?php if (count($updatekost) == 0) : ?>
                            <div class="katalog">
                                <span>Kosong</span>
                            </div>
                            <div class="harga">
                                <span>Rp. 0,00,-</span>
                            </div>
                        <?php else : ?>
                            <div class="katalog">
                                <span>Tagihan <?php echo $updatekost[0]['bulan']; ?></span>
                            </div>
                            <div class="harga">
                                <span>Rp. <?= number_format($updatekost[0]['harga'], '0', '', '.') ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
            <a href="<?= base_url('listrik') ?>" class="cardopen" id="klikbox">
                <div class="card bodycontent selectbox contentlistrik">
                    <div class="icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div class="label">
                        <?php if (count($updatelistrik) == 0) : ?>
                            <div class="katalog">
                                <span>Kosong</span>
                            </div>
                            <div class="harga">
                                <span>Rp. 0,00,-</span>
                            </div>
                        <?php else : ?>
                            <div class="katalog">
                                <span>Tagihan <?php echo $updatelistrik[0]['bulan']; ?></span>
                            </div>
                            <div class="harga">
                                <span>Rp. <?= number_format($updatelistrik[0]['harga'], '0', '', '.') ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
            <a href="<?= base_url('wifi') ?>" class="cardopen" id="klikbox">
                <div class="card bodycontent selectbox contentwifi">
                    <div class="icon">
                        <i class="fas fa-wifi"></i>
                    </div>
                    <div class="label">
                        <?php if (count($updatewifi) == 0) : ?>
                            <div class="katalog">
                                <span>Kosong</span>
                            </div>
                            <div class="harga">
                                <span>Rp. 0,00,-</span>
                            </div>
                        <?php else : ?>
                            <div class="katalog">
                                <span>Tagihan <?php echo $updatewifi[0]['bulan']; ?></span>
                            </div>
                            <div class="harga">
                                <span>Rp. <?= number_format($updatewifi[0]['harga'], '0', '', '.') ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
        </div>
    </main>
    <div class="vectorimg">
        <img class="imgupdate" src="<?= base_url('asset/image/updatevector.png') ?>" alt="">
    </div>
</div>