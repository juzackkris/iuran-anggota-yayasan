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
                <p class="ml-2">Dari Tanggal : <?= date('d-m-Y', strtotime($mulaiTgl)); ?><br>
                    Sampai Tanggal : <?= date('d-m-Y', strtotime($sampaiTgl)); ?>
                </p>
                <table class="table table-bordered text-center">
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Kepala Keluarga</th>
                        <th>Alamat</th>
                        <th>No.Bayar</th>
                        <th>Pembayaran Bulan</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                    <?php $total = 0;
                    $no = 1;
                    foreach ($bayar as $b) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $b['nomor_id']; ?></td>
                            <td><?= $b['nama_kk']; ?></td>
                            <td><?= $b['alamat']; ?></td>
                            <td><?= $b['nobayar']; ?></td>
                            <td><?= $b['bulan']; ?></td>
                            <td><?= $b['jumlah']; ?></td>
                            <td><?= $b['ket']; ?></td>
                        </tr>
                        <?php $total += $b['jumlah']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="6"><strong>Total</strong></td>
                        <td>Rp.<?= number_format($total, 0, ',', '.'); ?></td>
                    </tr>
                </table>
                
                <div class="row">
                    <div class="col-md-3 offset-md-9">
                        <table>
                            <tr>
                                <td></td>
                                <td>
                                    <p>Cikampek, <?= date('d-m-Y'); ?><br>
                                        Admin</p>
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