<div id="layoutSidenav_content">
    <main>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        </nav>
        <div class="container-fluid beranda">
            <div class="headcontent">
                <h2>Tagihan Terbaru</h2>
                <!-- <div class="btn_group">
                    <a href="#" class="btn btn-default active" id="tipelist"> <i class="fas fa-bed fa-xs"></i> </a>
                    <a href="<?= site_url('listrik') ?>" class="btn btn-default noactive" id="tipelist" style="width: 40px;"> <i class="fas fa-bolt fa-xs"></i> </a>
                    <a href="#" class="btn btn-default noactive" id="tipelist"> <i class="fas fa-wifi fa-xs"></i> </a>
                </div> -->
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