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
                <div class="row">
                    <div class="col-md-4">
                        <table class="table">
                            <tr>
                                <th>NOMOR ID</th>
                                <td>:</td>
                                <td><?= $kk['nik']; ?></td>
                            </tr>
                            <tr>
                                <th>Nama Kepala Keluarga</th>
                                <td>:</td>
                                <td><?= $kk['nama_kk']; ?></td>
                            </tr>
                            <tr>
                                <th>Kelas</th>
                                <td>:</td>
                                <td><?= $kk['alamat']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <table class="table table-bordered text-center">
                    <tr>
                        <th>No</th>
                        <th>No.Bayar</th>
                        <th>Pembayaran Bulan</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                    <?php $no = 1;
                    foreach ($bayar as $b) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $b['nobayar']; ?></td>
                            <td><?= $b['bulan']; ?></td>
                            <td><?= $b['jumlah']; ?></td>
                            <td><?= $b['ket']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
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