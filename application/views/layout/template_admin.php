<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title; ?></title>
    <link href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('css/sb-styles.css') ?>" rel="stylesheet">
    <link href="<?= base_url('css/styles.css') ?> " rel="stylesheet">
    <link href="<?= base_url('datatables/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a href="#" id="sidebarToggleX" class="closeToggle"><i class="fas fa-times"></i></a>
                        <div class="dashboard">
                            <a class="nav-link" id="logo" href="#">
                                <img src="<?= base_url('image/logo.png') ?>" alt="" height="80">
                            </a>
                            <p>Pengguna Kamar 06</p>
                        </div>
                        <div class="sb-menu-top">
                            <a class="nav-link menupilih" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-scroll"></i></div>
                                Upetimu
                            </a>
                            <a class="nav-link menupilih" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-hourglass"></i></div>
                                Riwayat
                            </a>
                            <a class="nav-link menupilih" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-wallet"></i></div>
                                Dompet
                                <a class="dompet" href="">Rp. 20.000</a>
                            </a>
                        </div>
                        <div class="sb-menu-bottom">
                            <hr width="50%" color="white">
                            <a class="nav-link menupilih" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
                                Pengaturan
                            </a>
                            <a class="nav-link menupilih" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-info-circle"></i></div>
                                Tentang
                            </a>
                            <a class="nav-link menupilih" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-running"></i></div>
                                Keluar
                            </a>
                            <div class="sb-menu-sosmed">
                                <p>Copyright &copy; <a href="https://behance.net/uiidx">&nbsp;UI.IDX&nbsp;</a>2020</p>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <?= $this->renderSection('content'); ?>

    </div>
    <script src="<?= base_url('js/jquery-3.4.1.min.js') ?>"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url('js/scripts.js') ?>"></script>
    <script src="<?= base_url('js/fontawesome/js/all.min.js') ?>"></script>
    <script src="<?= base_url('datatables/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('datatables/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script>
        $(document).ready(function() {
            $('#tablelistrik').DataTable({
                "language": {
                    "emptyTable": "Data Kosong",
                    "processing": "Memuat Data",
                    "zeroRecords": "Data Tidak Ditemukan"
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('pengguna.index')}}",
                    type: 'GET'
                },
                columns: [{
                        data: 'bulan',
                        name: 'bulan'
                    },
                    {
                        data: 'upeti',
                        name: 'upeti',
                        render: $.fn.dataTable.render.number(',', '.', 0, 'Rp. ')
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                ],
                order: [
                    // [0, 'desc']
                ],
                'rowCallback': function(row, data, index) {
                    if (data.status == "Diterima") {
                        $(row).find('td:eq(3)').addClass('statuspay').css('background-color', 'rgb(5, 150, 0)');
                    } else if (data.status == "Proses") {
                        $(row).find('td:eq(3)').addClass('statuspay').css('background-color', 'rgb(195 208 0)');
                    } else {
                        $(row).find('td:eq(3)').addClass('statuspay').css('background-color', 'rgb(169, 33, 46)').text('Belum Bayar');
                    }
                },
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#tablewifi').DataTable({
                "language": {
                    "emptyTable": "Data Kosong",
                    "processing": "Memuat Data",
                    "zeroRecords": "Data Tidak Ditemukan"
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('pengguna.getpemwifi')}}",
                    type: 'GET'
                },
                columns: [{
                        data: 'bulan',
                        name: 'bulan'
                    },
                    {
                        data: 'upeti',
                        name: 'upeti',
                        render: $.fn.dataTable.render.number(',', '.', 0, 'Rp. ')
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                ],
                order: [
                    // [0, 'desc']
                ],
                'rowCallback': function(row, data, index) {
                    if (data.status == "Diterima") {
                        $(row).find('td:eq(3)').addClass('statuspay').css('background-color', 'rgb(5, 150, 0)');
                    } else if (data.status == "Proses") {
                        $(row).find('td:eq(3)').addClass('statuspay').css('background-color', 'rgb(195 208 0)');
                    } else {
                        $(row).find('td:eq(3)').addClass('statuspay').css('background-color', 'rgb(169, 33, 46)').text('Belum Bayar');
                    }
                },
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#tableid').DataTable({
                "language": {
                    "emptyTable": "Data Kosong",
                    "processing": "Memuat Data",
                    "zeroRecords": "Data Tidak Ditemukan"
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{route('getpemwifi')}}",
                    type: 'GET'
                },
                columns: [{
                        data: 'bulan',
                        name: 'bulan'
                    },
                    {
                        data: 'upeti',
                        name: 'upeti',
                        render: $.fn.dataTable.render.number(',', '.', 0, 'Rp. ')
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },
                ],
                order: [
                    // [0, 'desc']
                ],
                'rowCallback': function(row, data, index) {
                    if (data.status == "Diterima") {
                        $(row).find('td:eq(3)').addClass('statuspay').css('background-color', 'rgb(5, 150, 0)');
                    } else if (data.status == "Proses") {
                        $(row).find('td:eq(3)').addClass('statuspay').css('background-color', 'rgb(195 208 0)');
                    } else {
                        $(row).find('td:eq(3)').addClass('statuspay').css('background-color', 'rgb(169, 33, 46)').text('Belum Bayar');
                    }
                },
            });
        });
    </script>
</body>

</html>