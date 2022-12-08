<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <a href="<?= base_url('dashboard/mahasiswa') ?>"><button class="btn btn-primary">
                        kembali</button></a>
                <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
            </div>
            <div class="table-responsive p-3">
                <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>IPK</th>
                            <th>Angkatan</th>
                            <th>Program Studi</th>
                            <th>Status Mahasiswa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($minIPKlulus as $pemalas) : ?>
                            <tr>
                                <td> <?= $pemalas['Nama Mahasiswa']; ?></td>
                                <td> <?= $pemalas["IPK"]; ?> </td>
                                <td> <?= $pemalas["Angkatan"]; ?> </td>
                                <td> <?= $pemalas["Nama Prodi"]; ?> </td>
                                <td> <?= $pemalas["Status Mahasiswa"]; ?> </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>