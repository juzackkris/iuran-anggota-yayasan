<style>
    @media print {
        .no-print {
            display: none;
        }
    }
</style>
<div class="container py-4">
    <div class="row">
        <div class="col-md">
            <div class="card">
                <h4 class="text-center">YAYASAN DHARMA BHAKTI CIKAMPEK</h4>
                <small class="text-center">Laporan Pembayaran</small>
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Kepala Keluarga</th>
                        <th>Nama Anggota Keluarga</th>
                        <th>Alamat</th>
                        <th>Tanggal Lahir</th>
                        <th>Telepon</th>
                        <th>Status</th>
                        <th>NIK</th>
                        <th>Nomor KK</th>
                    </tr>
                    <?php $no = 1;
                    foreach ($anggota as $a) : ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?= $a['nama_kk']; ?></td>
                            <td><?= $a['nama']; ?></td>
                            <td><?= $a['alamat']; ?></td>
                            <td><?= $a['tgl_lahir']; ?></td>
                            <td><?= $a['telepon']; ?></td>
                            <td><?= $a['status']; ?></td>
                            <td><?= $a['nik']; ?></td>
                            <td><?= $a['no_kk']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <div class="row">
                    <div class="col-md-2">
                        <a href="" onclick="window.print()" class="btn btn-secondary btn-sm no-print"><i class="fas fa-print"></i> Cetak</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 offset-md-9">
                        <table>
                            <tr>
                                <td></td>
                                <td>
                                    <p>Cikampek, <?= date('d-m-Y'); ?><br>
                                        Evi Krisani Agustina</p>
                                    <br><br>
                                    <p>_______________________</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.print();
</script>