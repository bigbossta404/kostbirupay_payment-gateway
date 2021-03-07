<div id="layoutSidenav_content">
    <main>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        </nav>
        <div class="container container-transaksi">
            <div class="content">
                <h2>Detail Transaksi</h2>
                <?php foreach ($det_transak as $dtk) : ?>
                    <p>ID Tagihan: <?php echo '#TG' . $dtk['id_bayar']; ?></p>
            </div>
            <div class="bodytransaksi">
                <div class="card bodytransaksi-left">
                    <span class="ribbon4">
                        <?php if ($dtk['status'] == '200') : ?> <b>lunas</b>
                        <?php else : ?> <b>Pending</b>
                        <?php endif; ?>
                    </span>
                    <div class="card-body invoice">
                        <div class="left-invoice">
                            <h4>ID Invoice : <?php echo $dtk['id_transkost'] ?></h4>
                            <p><small>Tanggal Invoice </small></p>
                            <p><span id="traText"><?php echo $dtk['tgl_invoice'] ?></span></p>
                            <div class="lunas">
                                <div class="tgl-lunas">
                                    <p><small>Tanggal Lunas </small></p>
                                    <p>
                                        <?php if ($dtk['tgl_lunas'] != null) : ?>
                                    <p><span id="traText"><?php echo $dtk['tgl_lunas']; ?></span></p>
                                <?php else : ?> <span class="badge bg-warning" style="color:#000000">Belum lunas</span>
                                <?php endif ?>
                                </p>
                                </div>
                                <div class="metode-bayar">
                                    <p><small>Metode Bayar</small></p>
                                    <p><span id="traText"><?php echo $dtk['pay_type'] ?></span></p>
                                </div>
                            </div>
                            <p><small>Dibayar</small></p>
                            <p><?php echo 'Rp ' . number_format($dtk['harga'], '0', '', '.'); ?></p>
                        </div>

                    </div>
                </div>
                <div class="card bodytransaksi-right">
                    <table>
                        <tr>
                            <td>Pengguna</td>
                            <td>:</td>
                            <td>Fakhri</td>
                        </tr>
                        <tr>
                            <td>No. Kamar</td>
                            <td>:</td>
                            <td>12</td>
                        </tr>
                        <tr>
                            <td>Bayar Via</td>
                            <td>:</td>
                            <?php if ($dtk['pay_type'] == 'bank_transfer') : ?>
                                <td>Bank <?php echo $dtk['bank']; ?></td>
                            <?php endif ?></td>
                        </tr>
                        <tr>
                            <td>VA Number</td>
                            <td>:</td>
                            <td><?php echo $dtk['va_num']; ?></td>
                        </tr>
                    </table>
                    <table class="penerimabayar">
                        <tr>
                            <td>Penerima</td>
                            <td>:</td>
                            <td>Fx. Suroyo</td>
                        </tr>
                        <tr>
                            <td>No. Rekening</td>
                            <td>:</td>
                            <td>043224232234</td>
                        </tr>

                    </table>
                    <!-- <div class="penerima">
                        <table class="penerimatable">
                            <tr>
                                <td>Pengguna</td>
                                <td>:</td>
                                <td>Fakhri</td>
                            </tr>
                            <tr>
                                <td>No. Kamar</td>
                                <td>:</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <td>Bayar Via</td>
                                <td>:</td>
                                <?php if ($dtk['pay_type'] == 'bank_transfer') : ?>
                                    <td>Bank <?php echo $dtk['bank']; ?></td>
                                <?php endif ?></td>
                            </tr>
                            <tr>
                                <td>Virtual Akun</td>
                                <td>:</td>
                                <td><?php echo $dtk['va_num']; ?></td>
                            </tr>
                        </table>
                    </div> -->
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </main>
</div>