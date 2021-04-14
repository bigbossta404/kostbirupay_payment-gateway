<div id="layoutSidenav_content">
    <main>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        </nav>
        <div class="container-fluid contentpengurus">
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4 mt-2">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Kas</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><span class="h6 text-gray-800">Rp.</span>
                                        <span id="saldo">
                                            <?php
                                            if ($bagian == 'wifi') {
                                                echo ($getsaldo['kaswifi'] == null) ?  "0" : number_format($getsaldo['kaswifi'], '0', '', '.');
                                            } else {
                                                echo ($getsaldo['kaslistrik'] == null) ?  "0" : number_format($getsaldo['kaslistrik'], '0', '', '.');
                                            } ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-wallet fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl col-md-6 mb-4 mt-2">
                    <div class="card border-left-primary shadow py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="mb-0 fs-5 text-dark">
                                        <span style="padding: 10px; background-color: #dadada;">
                                            Akses tombol di samping untuk kelola keuangan
                                        </span>
                                    </div>
                                </div>
                                <div class="btncash mr-3">
                                    <button type="button" class="btn btn-success" id="btncashin">
                                        Cash In <i class="fas fa-plus-circle"></i>
                                    </button>
                                </div>
                                <div class="btncash">
                                    <button type="button" class="btn btn-danger" id="btncashout">
                                        Cash Out <i class="fas fa-minus-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
            </div>
            <div class="row boxcashin style=" style="visibility:hidden; display:none">
                <div class="col-xl ">
                    <div class="card bodycontent shadow">
                        <div class="card-body d-flex">
                            <div class="col-xl-3">
                                <input type="text" class="form-control  border-primary jumIn" name="jumIn" placeholder="Rp 0,00">
                            </div>
                            <div class="col-xl-3">
                                <input type="text" class="form-control  border-primary ketIn" name="ketIn" placeholder="Keterangan">
                            </div>
                            <div class="ml-auto">
                                <button class="btn btn-success cashin" id="">Setor <i class="fas fa-plus-circle"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row boxcashout style=" style="visibility:hidden; display:none">
                <div class="col-xl ">
                    <div class="card bodycontent shadow">
                        <div class="card-body d-flex">
                            <div class="col-xl-3">
                                <input type="text" class="form-control  border-primary jumOut" name="jumOut" placeholder="Rp 0,00">
                            </div>
                            <div class="col-xl-3">
                                <input type="text" class="form-control  border-primary ketOut" name="ketOut" placeholder="Keterangan">
                            </div>
                            <div class="ml-auto">
                                <button class="btn btn-danger cashout" id="">Tarik <i class="fas fa-minus-circle"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Buku Keuangan</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <!-- <div class="tab-pane table-responsive"> -->
                            <table id="table_keuangan" class="table wrap table-striped table-bordered hover   order-column" width="100%" cellspacing="0">
                                <thead>
                                    <tr>

                                        <td>No.</td>
                                        <td>Pemasukan</td>
                                        <td>Pengeluaran</td>
                                        <td>Saldo</td>
                                        <td>Struk</td>
                                        <td>Tanggal</td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="vectorimg">
        <img class="imgupdate" src="<?= base_url('asset/image/updatevector.png') ?>" alt="">
    </div>
</div>