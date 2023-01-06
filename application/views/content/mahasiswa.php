<!-- Row -->
<div class="row mb-3">
    <div class="col-lg-12">
        <!-- Select2 -->
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <form action="<?= base_url('index.php/dashboard/mahasiswa') ?>" method="POST">
                        <label for="select2Single">Pilih Angkatan</label>
                        <select class="form-control form-control-sm mb-3" name="angkatan" id="select2Single">
                            <?php if ($dropdown_angkatan == null) : ?>
                                <option value="" selected disabled>Pilih Angkatan</option>
                            <?php else : ?>
                                <option style="background-color:grey" value="" selected disabled><?= $dropdown_angkatan; ?> (Selected)</option>
                            <?php endif; ?>
                            <?php foreach ($angkatan as $ak) : ?>
                                <option value="<?= $ak["Angkatan"] ?>"><?= $ak["Angkatan"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                </div>
                <div class="form-group">
                    <label for="select2SinglePlaceholder">Pilih Program Study</label>
                    <select class="form-control form-control-sm mb-3" name="prodi" id="select2Single">
                        <?php if ($dropdown_prodi == null) : ?>
                            <option value="" selected disabled>Pilih Angkatan</option>
                        <?php else : ?>
                            <option style="background-color:grey" value="" selected disabled><?= $dropdown_prodi; ?> (Selected)</option>
                        <?php endif; ?>
                        <?php foreach ($nama_prodi as $prodi) : ?>
                            <option value="<?= $prodi["ID Prodi"] ?>"><?= $prodi["Nama Prodi"]; ?></option>
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
    <?php if (count($maxIpkLulus) > 1) : ?>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <?php $i = 1 ?>
                            <?php foreach ($maxIpkLulus as $upIPK) : ?>
                                <div class="text-xs font-weight-bold text-uppercase mb-1">IPK Tertinggi </div>
                                <span class="text-primary mt-2 text-xs"></i>Angkatan <?= $dropdown_angkatan; ?></span>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">IPK : <?= number_format($upIPK['IPK'], 2) ?></div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> -->
                                    <span><a href="<?= base_url('index.php/dashboard/maxipkLulus') ?>"><button class="btn btn-primary btn-sm">Lihat Data</button></a></span>
                                </div>
                                <?php if ($i == 1) {
                                    break;
                                } ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col mr-2">
                            <?php foreach ($maxIpkLulus as $upIPK) : ?>
                                <div class="text-xs font-weight-bold text-uppercase mb-1">IPK Tertinggi Lulusan</div>
                                <span class="text-primary mt-2 text-xs"></i>Angkatan <?= $dropdown_angkatan; ?></span>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">IPK : <?= number_format($upIPK['IPK'], 2) ?></div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span> -->
                                    <span><?= $upIPK['Nama Mahasiswa']; ?></span><br>
                                    <span><?= $upIPK['Nama Prodi']; ?></span>
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
    <?php endif; ?>
    <!-- Earnings (Annual) Card Example -->
    <?php if (count($maxIpkAktif) > 1) : ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <?php $i = 1; ?>
                        <?php foreach ($maxIpkAktif as $upIPKaktif) : ?>
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">IPK tertinggi Mahasiswa Aktif</div>
                                <span class="text-primary mt-2 text-xs"></i>Angkatan <?= $dropdown_angkatan; ?></span>
                                <!-- <div class="h5 mb-0 font-weight-bold text-gray-800">IPK : <?= number_format($upIPKaktif['IPK'], 2); ?></div> -->
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <!-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span> -->
                                    <span><a href="<?= base_url('index.php/dashboard/maxipkAktif') ?>"><button class="btn btn-primary btn-sm">Lihat Data</button></a></span>
                                </div>
                            </div>
                            <?php if ($i == 1) {
                                break;
                            } ?>
                        <?php endforeach; ?>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <?php foreach ($maxIpkAktif as $upIPKaktif) : ?>
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">IPK tertinggi Mahasiswa Aktif</div>
                                <span class="text-primary mt-2 text-xs"></i>Angkatan <?= $dropdown_angkatan; ?></span>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($upIPKaktif['IPK'], 2); ?></div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <!-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span> -->
                                    <span><?= $upIPKaktif['Nama Mahasiswa']; ?></span><br>
                                    <span><?= $upIPKaktif['Nama Prodi']; ?></span>
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
    <?php endif; ?>
    <?php if (count($minIPKlulus) == 1) : ?>
        <!-- New User Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <?php foreach ($minIPKlulus as $sksrendah) : ?>
                                <div class="text-xs font-weight-bold text-uppercase mb-1">IPK Terendah Lulusan</div>
                                <span class="text-primary mt-2 text-xs"></i>Angktan <?= $dropdown_angkatan; ?></span>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">IPK : <?= number_format($sksrendah['IPK'], 2); ?></div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <!-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span> -->
                                    <span><?= $sksrendah['Nama Mahasiswa']; ?></span><br>
                                    <span><?= $sksrendah['Nama Prodi']; ?></span>
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
    <?php else : ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <?php $i = 1; ?>
                            <?php foreach ($minIPKlulus as $sksrendah) : ?>
                                <div class="text-xs font-weight-bold text-uppercase mb-1">IPK Terendah Lulusan</div>
                                <span class="text-primary mt-2 text-xs"></i>Angkatan <?= $dropdown_angkatan; ?></span>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">IPK : <?= number_format($sksrendah['IPK'], 2); ?></div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <!-- <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span> -->
                                    <span><a href="<?= base_url('index.php/dashboard/minipklulus') ?>"><button class="btn btn-primary btn-sm">Lihat Data</button></a></span>
                                </div>
                                <?php if ($i == 1) {
                                    break;
                                } ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if (count($minIPKaktif) == 1) : ?>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <?php foreach ($minIPKaktif as $pemalas) : ?>
                                <div class="text-xs font-weight-bold text-uppercase mb-1">IPK Terendah Mahasiswa Aktif</div>
                                <span class="text-primary mt-2 text-xs"></i>Angkatan <?= $dropdown_angkatan; ?></span>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($pemalas['IPK']); ?></div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <!-- <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span> -->
                                    <span><?= $pemalas['Nama Mahasiswa']; ?></span><br>
                                    <span><?= $pemalas['Nama Prodi']; ?></span>
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
    <?php else : ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <?php $i = 1; ?>
                            <?php foreach ($minIPKaktif as $pemalas) : ?>
                                <div class="text-xs font-weight-bold text-uppercase mb-1">IPK Terendah Mahasiswa Aktif</div>
                                <span class="text-primary mt-2 text-xs"></i>Angkatan <?= $dropdown_angkatan; ?></span>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($pemalas['IPK']); ?></div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <!-- <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span> -->
                                    <span><a href="<?= base_url('index.php/dashboard/minipkaktif') ?>"><button class="btn btn-primary btn-sm">Lihat Data</button></a></span>
                                </div>
                                <?php if ($i == 1) {
                                    break;
                                } ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<div class="row">
    <!-- Area Charts -->
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?= $LabelCartall; ?></h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="mahasiswaIpkAll"></canvas>
                </div>
                <!--     <hr>
                Styling for the area chart can be found in the
                <code>/js/demo/chart-area-demo.js</code> file. -->
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?= $labeltable; ?></h6>
            </div>
            <?php if ($maxipkallprodi != null) : ?>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>Program Studi</th>
                                <th>Angkatan</th>
                                <th>Status Mahasiswa</th>
                                <th>IPK</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($maxipkallprodi as $maxipkprodi) : ?>
                                <tr>
                                    <td><?= $maxipkprodi["Nama Prodi"]; ?></td>
                                    <td><?= $maxipkprodi["Angkatan"]; ?></td>
                                    <td><?= $maxipkprodi["Status Mahasiswa"]; ?></td>
                                    <td><?= number_format($maxipkprodi["IPK"], 2); ?></td>
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
                                <th>Nama Mahasiswa</th>
                                <th>Program Studi</th>
                                <th>Angkatan</th>
                                <th>Status Mahasiswa</th>
                                <th>IPK</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5">
                                    <h4 class="card-title text-danger" style="text-align:center">
                                        Tidak Ada Data Ditemukan Mungkin Tahun ID Belum Terisi
                                    </h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?= $LabelCart; ?></h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="mahasiswaChart"></canvas>
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
                <h6 class="m-0 font-weight-bold text-primary"><?= $labeltable; ?></h6>
            </div>
            <?php if ($ipk[0] != null) : ?>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama Mahasiswa</th>
                                <th>Program Studi</th>
                                <th>Angkatan</th>
                                <th>Status Mahasiswa</th>
                                <th>IPK</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ipk as $nilai) : ?>
                                <tr>
                                    <td><?= $nilai["Nama Mahasiswa"]; ?></td>
                                    <td><?= $nilai["Nama Prodi"]; ?></td>
                                    <td><?= $nilai["Angkatan"]; ?></td>
                                    <td><?= $nilai["Status Mahasiswa"]; ?></td>
                                    <td><?= number_format($nilai["IPK"], 2); ?></td>
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
                                <th>Nama Mahasiswa</th>
                                <th>Program Studi</th>
                                <th>Angkatan</th>
                                <th>Status Mahasiswa</th>
                                <th>IPK</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5">
                                    <h4 class="card-title text-danger" style="text-align:center">
                                        Tidak Ada Data Ditemukan Mungkin Tahun ID Belum Terisi
                                    </h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!--Row-->