<!-- Container Fluid-->

<!-- Row -->
<div class="row mb-3">
    <div class="col-lg-12">
        <!-- Select2 -->
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url('dashboard/dosen') ?>" method="POST">
                    <div class="form-group">
                        <label for="select2SinglePlaceholder">Pilih Tahun Akademik</label>
                        <select class="form-control form-control-sm mb-3" name="tahunajaran" id="select2SinglePlaceholder">
                            <?php if ($dropdown_tahunajaran == null) : ?>
                                <option value="" disabled selected>Pilih Tahun Akademik</option>
                            <?php else : ?>
                                <option value="" disabled selected><?= $dropdown_tahunajaran; ?></option>
                            <?php endif; ?>
                            <?php foreach ($tahunID as $idtahun) : ?>
                                <option value="<?= $idtahun['ID Tahun Akademik'] ?>"><?= $idtahun['Nama Tahun Akademik']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <?php if (count($prodisksterkecil) == 1) : ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <?php foreach ($prodisksterkecil as $minprodi) : ?>
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Beban Pengajaran Prodi Terendah</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $minprodi['Total SKS']; ?> sks</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> -->
                                    <span><?= $minprodi['Nama Prodi']; ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <?php foreach ($prodisksterbanyak as $maxprodi) : ?>
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Beban Pengajaran Prodi Tertinggi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $maxprodi['Total SKS']; ?> sks</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <!-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span> -->
                                <span><?= $maxprodi['Nama Prodi']; ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (count($minsksDosen) == 1) : ?>
        <?php foreach ($minsksDosen as $minDosen) :  ?>
            <!-- New User Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Beban Pengajaran Dosen Terendah</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $minDosen['Total SKS']; ?></div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <!-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span> -->
                                    <span><?= $minDosen['Nama Dosen']; ?></span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Beban Pengajaran Dosen Terendah</div>
                            <div class="mt-2 mb-0 text-muted text-xs">Beberapa Dosen Memiliki nilai Beban Pengajaran Terendah</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <!-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span> -->
                                <span><a href="<?= base_url('dashboard/misksDosen') ?>"><button class="btn btn-primary btn-sm">Lihat Data</button></a></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- Pending Requests Card Example -->
    <?php if (count($maxsksDosen) == 1) : ?>
        <?php foreach ($maxsksDosen as $dosen) : ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Beban Pengajaran Dosen Tertinggi</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $dosen['Total SKS']; ?> sks</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span><?= $dosen['Nama Dosen']  ?></span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Beban Pengajaran Dosen Tertinggi</div>
                            <div class="mt-2 mb-0 text-muted text-xs">Beberapa Dosen Memiliki nilai Beban Pengajaran Tertinggi</div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <!-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span> -->
                                <span><a href="<?= base_url('dashboard/maxsksDosen') ?>"><button class="btn btn-primary btn-sm">Lihat Data</button></a></span>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<div class="row">
    <div class="col-lg-12">
        <!-- Select2 -->
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url('dashboard/dosen') ?>" method="POST">
                    <div class="form-group">
                        <label for="select2SinglePlaceholder">Pilih Program Studi</label>
                        <select class="form-control form-control-sm mb-3" name="prodiID" id="select2SinglePlaceholder">
                            <option value="" disabled selected><?= $dropdown_prodi; ?></option>
                            <?php foreach ($Nama_Prodi as $idprodi) : ?>
                                <option value="<?= $idprodi['ID Prodi'] ?>" selected><?= $idprodi['Nama Prodi']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="select2SinglePlaceholder">Pilih Tahun Akademik </label>
                        <select class="form-control form-control-sm mb-3" name="tahunID" id="select2SinglePlaceholder">
                            <option value="" disabled selected><?= $dropdown_tahunid; ?></option>
                            <?php foreach ($tahunID as $idtahun) : ?>
                                <option value="<?= $idtahun['ID Tahun Akademik'] ?>"><?= $idtahun['Nama Tahun Akademik']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Area Charts -->
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?= $labelgraph; ?></h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="dosenChart"></canvas>
                </div>
                <!--  <hr>
                Styling for the area chart can be found in the
                <code>/js/demo/chart-area-demo.js</code> file. -->
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Tabel</h6>
            </div>
            <?php if ($prodi != null) : ?>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama Prodi</th>
                                <th>Total SKS</th>
                                <th>Tahun Ajaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($prodi as $data_prodi) : ?>
                                <tr>
                                    <td> <?= $data_prodi['Nama Prodi']; ?></td>
                                    <td> <?= $data_prodi["Total SKS"]; ?> </td>
                                    <td> <?= $data_prodi["Nama Tahun Akademik"]; ?> </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama Prodi</th>
                                <th>Total SKS</th>
                                <th>Tahun Ajaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3">
                                    <h4 class="card-title text-danger" style="text-align:center">
                                        Silahkan isi tahun ID pada menu drodown
                                    </h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- Bar Chart -->
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Beban Pengajaran Dosen Per Prodi</h6>
            </div>
            <div class="card-body">
                <div class="chart-bar">
                    <canvas id="dosenChartNama"></canvas>
                </div>
                <!--  <hr>
                Styling for the bar chart can be found in the <code>/js/demo/chart-bar-demo.js</code> file. -->
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Tabel</h6>
            </div>
            <?php if ($prodi != null) : ?>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama Prodi</th>
                                <th>Total SKS</th>
                                <th>Tahun Ajaran</th>
                            </tr>
                        </thead>
                        <?php foreach ($sks_dosen as $nama_dosen) : ?>
                            <tbody>
                                <tr>
                                    <td> <?= $nama_dosen['Nama Dosen']; ?></td>
                                    <td> <?= $nama_dosen["Total SKS"]; ?> </td>
                                    <td> <?= $nama_dosen["Nama Tahun Akademik"]; ?> </td>
                                </tr>
                            </tbody>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php else : ?>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama Prodi</th>
                                <th>Total SKS</th>
                                <th>Tahun Ajaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3">
                                    <h4 class="card-title text-danger" style="text-align:center">
                                        Silahkan isi tahun ID pada menu drodown
                                    </h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>