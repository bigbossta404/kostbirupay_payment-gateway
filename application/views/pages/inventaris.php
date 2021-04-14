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
            <div class="col-xl col-md-6 mb-4 mt-2">
                <div class="card border-left-primary shadow py-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mr-2 d-flex align-items-center">
                                <span class="labelinven" style="padding: 10px; background-color: #dadada;">
                                    Pantau transparansi keuangan
                                </span>
                                <div class="btn_group mb-0">
                                    <a class="btn btn-default invenwifi active" id="tipelist"> <i class="fas fa-wifi fa-xs"></i> </a>
                                    <a class="btn btn-default invenlis noactive" id="tipelist" style="width: 40px;"> <i class="fas fa-bolt fa-xs"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bodycontent">
                <div class="card-body">
                    <div class="tab-pane table-responsive tabwifi">
                        <table id="table_inven_wifi" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>Pemasukan</td>
                                    <td>Pengeluaran</td>
                                    <td>Saldo</td>
                                    <td>Ket</td>
                                    <td>Tanggal</td>
                                    <td>Struk</td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane table-responsive tablistrik" style="display: none;">
                        <table id="table_inven_listrik" class="table table-striped table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>Pemasukan</td>
                                    <td>Pengeluaran</td>
                                    <td>Saldo</td>
                                    <td>Ket</td>
                                    <td>Tanggal</td>
                                    <td>Struk</td>
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
</div>