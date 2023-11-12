<style>
    @media print {
        .no-print {
            display: none;
        }
    }
</style>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>
    <?= $this->session->flashdata('pesan'); ?>
    <?= $this->session->flashdata('danger'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <p class="ml-2">Dari Tanggal : <?= date('d-m-Y', strtotime($mulaiTgl)); ?><br>
                Sampai Tanggal : <?= date('d-m-Y', strtotime($sampaiTgl)); ?>
        </p></br>
        <p class="ml-2" style="color:red">*Jika kolom Nomor ID / Status berupa angka maka nama tersebut adalah kepala keluarga, 
            jika kolom Nomor ID / Status berupa anak atau istri maka nama tersebut adalah anggota keluarga.
        </p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm table-hover" id="dataTable" width="100%" cellspacing="0" >
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Nomor ID / Status</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $total = 0;
                    $no = 1;
                    foreach ($kk as $t) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $t['nomor_id']; ?></td>
                            <td><?= $t['nama_kk']; ?></td>
                            <td><?= $t['alamat']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <div class="row">
                    <!-- <div class="col-md-2">
                        <a href="" onclick="window.print()" class="btn btn-secondary btn-sm no-print"><i class="fas fa-print"></i> Cetak</a>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 
<script>
    window.print();
</script> -->