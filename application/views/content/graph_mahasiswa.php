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
                    <form action="<?= base_url('index.php/dashboard/pertumbuhanmahasiswa') ?>" method="POST">
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
    <div class="row">
        <!-- Area Charts -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $LabelCartall; ?></h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="pertumbuhanmhs"></canvas>
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
                <?php if ($datapertumbuhan != null) : ?>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>Angkatan</th>
                                    <th>Status Mahasiswa</th>
                                    <th>Jumlah Mahasiswa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datapertumbuhan as $datper) : ?>
                                    <tr>
                                        <td><?= $datper["angkatan"]; ?></td>
                                        <td><?= $datper["status"]; ?></td>
                                        <td><?= number_format($datper["jumlahmhs"], 0); ?></td>
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
                    <h6 class="m-0 font-weight-bold text-primary"><?= $LabelCartlulus; ?></h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="pertumbuhanmhslulus"></canvas>
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
                    <h6 class="m-0 font-weight-bold text-primary"><?= $labeltablelulus; ?></h6>
                </div>
                <?php if ($datapertumbuhanlulus != null) : ?>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>Angkatan</th>
                                    <th>Status Mahasiswa</th>
                                    <th>Jumlah Mahasiswa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datapertumbuhanlulus as $datper) : ?>
                                    <tr>
                                        <td><?= $datper["angkatan"]; ?></td>
                                        <td><?= $datper["status"]; ?></td>
                                        <td><?= number_format($datper["jumlahmhs"], 0); ?></td>
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