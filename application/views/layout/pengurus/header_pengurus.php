<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title; ?></title>
    <link href="<?= base_url('asset/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('asset/css/sb-styles.css') ?>" rel="stylesheet">
    <link href="<?= base_url('asset/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('asset/css/sweetalert2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('asset/css/styles.css') ?> " rel="stylesheet">
    <link href="<?= base_url('asset/datatables/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,400;0,600;0,800;0,900;1,400;1,600;1,700;1,900&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-vIrmZrLCN2pC-Dmg"></script>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav">

        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <a href="#" id="sidebarToggleX" class="closeToggle"><i class="fas fa-times"></i></a>
                    <div class="nav">
                        <div class="dashboard">
                            <a class="nav-link" id="logo" href="<?= base_url('beranda') ?>">
                                <img src="<?= base_url('asset/image/logo.png') ?>" alt="" height="80">
                            </a>
                            <!-- <p id="nokamar">No. Kamar <?= $user['id_kamar']; ?></p> -->
                        </div>
                        <div class="title-tags" style="background-color: #08006d; padding: 10px; display:flex; align-items: center; justify-content:center">
                            <span class="tags">Pengurus <?= $pengurus['bagian']; ?></span>
                        </div>
                        <div class="sb-menu-top">
                            <a class="nav-link menupilih <?= $this->uri->segment(1) == 'pengurus' ? 'menuaktif' : '' ?>" href="<?= base_url('pengurus'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                <div class="texticon">
                                    Beranda
                                </div>
                            </a>
                            <a class="nav-link menupilih <?= $this->uri->segment(1) == 'pembayaran' ? 'menuaktif' : '' ?>" href="<?= base_url('pembayaran'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-scroll"></i></div>
                                <div class="texticon">
                                    Pembayaran
                                </div>
                            </a>
                            <a class="nav-link menupilih <?= $this->uri->segment(1) == 'keuangan' ? 'menuaktif' : '' ?>" href="<?= base_url('keuangan'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-wallet"></i></div>
                                <div class="texticon">
                                    Keuangan
                                </div>
                            </a>
                            <a class="nav-link menupilih <?= $this->uri->segment(1) == 'user' ? 'menuaktif' : '' ?>" href="<?= base_url('user'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-id-card"></i></div>
                                <div class="texticon">
                                    Akun
                                </div>
                            </a>
                        </div>
                        <div class="sb-menu-bottom">
                            <hr width="50%" color="white" data-toggle="collapse" data-target="#collapseLayouts">
                            <a class="nav-link menupilih" href="charts.html" data-toggle="collapse" data-target="#collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
                                <div class="texticon">
                                    Pengaturan
                                </div>
                            </a>
                            <a class="nav-link menupilih" href="tables.html" data-toggle="collapse" data-target="#collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-info-circle"></i></div>
                                <div class="texticon">
                                    Tentang
                                </div>
                            </a>
                            <a class="nav-link menupilih" href="<?= base_url('auth/logout'); ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-running"></i></div>
                                <div class="texticon">
                                    Keluar
                                </div>
                            </a>
                            <div class="sb-menu-sosmed" data-toggle="collapse" data-target="#collapseLayouts">
                                <p>Copyright &copy; <a href="https://behance.net/uiidx">&nbsp;UI.IDX&nbsp;</a>2020</p>
                            </div>
                        </div>
                    </div>
                </div>

            </nav>
        </div>