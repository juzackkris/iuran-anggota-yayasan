<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-12 bg-primary">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>ID</th>
                            <th>Barcode</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($kk as $k) : ?>
                            <tr align="center">
                                <td ><?php echo $no++ ?></td>
                                <td><?= $k['nama_kk']; ?></td>
                                <td><?= $k['nomor_id']; ?></td>
                                <td><img src="<?php echo base_url('superAdmin/barcode/set_barcode/'.$k['nomor_id']); ?>" alt=""></td>
                                <td>
                                    <a class="btn btn-sm btn-success" href="<?php echo base_url('superAdmin/barcode/download/' . $k['nomor_id']) ?>"><i class="fas fa-download"></i></a>
                                    <a class="btn btn-sm btn-primary" href="<?php echo base_url('superAdmin/kartu/cetakKartu/' . $k['nomor_id']) ?>"><i class="fas fa-id-card"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>
