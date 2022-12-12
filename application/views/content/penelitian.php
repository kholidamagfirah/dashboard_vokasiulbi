<!-- Row -->
<div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <?php foreach ($maxsinta3score as $maxsinta3) : ?>
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Score Sinta 3 Tahun Tertinggi </div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800"><?= $maxsinta3['nama']; ?></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="h6 text-success mr-1">Total : <?= $maxsinta3['sinta_score_3_years']; ?></span>
                                <span>Since last years</span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <?php foreach ($minsinta3score as $minsinta3) : ?>
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Score Sinta 3 Tahun Terendah</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800"><?= $minsinta3['nama']; ?></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="h6 text-success mr-2">Total : <?= $minsinta3['sinta_score_3_years']; ?></span>
                                <span>Since last years</span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New User Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <?php foreach ($maxsinta3scoreproductif as $maxsintaproductif) : ?>
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Produktivitas Sinta 3 Tahun Tertinggi</div>
                            <div class="h6 mb-0 mr-3 font-weight-bold text-gray-800"><?= $maxsintaproductif['nama']; ?></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="h6 text-success mr-2"></i>Total : <?= $maxsintaproductif['sinta_score_3_years_productivity']; ?></span>
                                <span>Since last years</span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <?php foreach ($minsinta3scoreproductif as $minsintaproductif) : ?>
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Produktivitas Sinta 3 Tahun Terendah</div>
                            <div class="h6 mb-0 font-weight-bold text-gray-800"><?= $minsintaproductif['nama']; ?></div>
                            <div class="mt-2 mb-0 text-muted text-xs">
                                <span class="text-danger mr-2">Total : <?= $minsintaproductif['sinta_score_3_years_productivity']; ?></span>
                                <span>Since last years</span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-warning"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <!-- Select2 -->
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url('dashboard/penelitian') ?>" method="POST">
                    <div class="form-group">
                        <label for="select2SinglePlaceholder">Pilih Kategori</label>
                        <select class="form-control form-control-sm mb-3" name="category" id="select2SinglePlaceholder">
                            <option value="">Category Penelitian</option>
                            <?php foreach ($category as $keyword => $value) : ?>
                                <?php if ($keyword < 3) {
                                    continue;
                                } ?>
                                <option value="<?= $value; ?>"><?= $value; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="select2SinglePlaceholder">Pilih Program Study</label>
                        <select class="form-control form-control-sm mb-3" name="prodi" id="select2SinglePlaceholder">
                            <option value="">Program Study</option>
                            <?php foreach ($key as $nama) : ?>
                                <option value="<?= $nama; ?>"><?= $nama; ?></option>
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
                <h6 class="m-0 font-weight-bold text-primary"><?= $labelchartall; ?></h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="dataAllpenelitian"></canvas>
                </div>
                <!--<hr>
                Styling for the area chart can be found in the
                <code>/js/demo/chart-area-demo.js</code> file. -->
            </div>
        </div>
    </div>
    <!-- Area Charts -->
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?= $LabelCart; ?></h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
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
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>Jumlah Authors</th>
                            <th>Nama Prodi</th>
                            <th>Sinta Score 3 years</th>
                            <th>Sinta Score 3 Years Productfivity</th>
                            <th>Sinta Score Overall</th>
                            <th>Sinta Score Overall Productfivity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $nama_prodi["authors"]; ?></td>
                            <td><?= $nama_prodi["nama"]; ?></td>
                            <td><?= $nama_prodi["sinta_score_3_years"]; ?></td>
                            <td><?= $nama_prodi["sinta_score_3_years_productivity"]; ?></td>
                            <td><?= $nama_prodi["sinta_score_overall"]; ?></td>
                            <td><?= $nama_prodi["sinta_score_overall_productivity"]; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--Row-->