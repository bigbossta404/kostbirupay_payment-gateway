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
        <div class="container-fluid">
            <div class="headcontent">
                <h2>Daftar Pembayaranmu</h2>
                <div class="btn_group">
                    <a href="#" class="btn btn-default active" id="tipelist"> <i class="fas fa-bed fa-xs"></i> </a>
                    <a href="<?= site_url('listrik') ?>" class="btn btn-default noactive" id="tipelist" style="width: 40px;"> <i class="fas fa-bolt fa-xs"></i> </a>
                    <a href="<?= site_url('wifi') ?>" class="btn btn-default noactive" id="tipelist"> <i class="fas fa-wifi fa-xs"></i> </a>
                </div>
            </div>
            <div class="card bodycontent">
                <div class="card-body">
                    <div class="tab-pane table-responsive">
                        <table id="tablekost" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>ID Bayar</td>
                                    <td>Bulan</td>
                                    <td>Tagihan</td>
                                    <td>Status</td>
                                    <td>#</td>
                                </tr>
                            </thead>
                            <form id="payment-form" method="post" action="<?= site_url('/snap/finish/') . $user['id_pengguna']; ?>">
                                <input type="hidden" name="idbayar" id="idbayar" value="">
                                <input type="hidden" name="pilih" id="pilih" value="">
                                <input type="hidden" name="result_type" id="result-type" value="">
                                <input type="hidden" name="result_data" id="result-data" value="">
                            </form>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>