<div id="layoutSidenav_content">
    <main>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        </nav>
        <div class="container-fluid contentpengurus">
            <div class="headcontent">
                <h2>Pembayaran Wifi</h2>
            </div>
            <div class="row">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="mb-0 fs-5 text-dark">
                                        <span style="padding: 10px; background-color: #dadada;">
                                            Input tagihan baru ke semua pengguna
                                        </span>
                                    </div>
                                </div>
                                <div class="pickbulan monthpick">
                                    <div class="form-group">
                                        <select name="pickbulanwifi" id="pickbulanwifi" class="form-control border border-info">
                                            <option value="">-- Bulan --</option>
                                            <?php foreach ($bulancek as $bl) : ?>
                                                <option value="<?= $bl['id_bulan']; ?>"><?= $bl['bulan']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="pickbulan px-4">
                                    <div class="form-group">
                                        <input name="" id="" class="form-control border border-info" value="2021" style="text-align: center;background-color:#fff" readonly>
                                    </div>
                                </div>
                                <div class="btntagihan">
                                    <button type="button" class="btn btn-primary" id="btntagihan">
                                        Tagihan <i class="fas fa-plus-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="alert-msg"></div>
            <div class="row">
                <div class="col-xl">
                    <div class="card bodycontent shadow">
                        <div class="card-body">
                            <div class="tab-pane table-responsive">
                                <table id="tabletagihan_peng" class="table table-striped table-bordered " width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Bulan</td>
                                            <td>Date Create</td>
                                            <td>#</td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
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