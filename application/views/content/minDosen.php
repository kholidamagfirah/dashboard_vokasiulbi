<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <a href="<?= base_url('dashboard/dosen') ?>"><button class="btn btn-primary">
                        kembali</button></a>
                <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama Dosen</th>
                            <th>Total SKS</th>
                            <th>Tahun Ajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($minsksDosen as $min_sks_dosen) : ?>
                            <tr>
                                <td> <?= $min_sks_dosen['Nama Dosen']; ?></td>
                                <td> <?= $min_sks_dosen["Total SKS"]; ?> </td>
                                <td> <?= $min_sks_dosen["Nama Prodi"]; ?> </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>