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
                        <th>Nomor ID</th>
                        <th>Kepala Keluarga</th>
                        <th>Alamat</th>
                        <th>Tagihan Bulan</th>
                        <th>Jumlah Tagihan</th>
                        <th>Keterangan</th>
                    </tr>
                    <?php $total = 0;
                    $no = 1;
                    foreach ($tunggakan as $t) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $t['nomor_id']; ?></td>
                            <td><?= $t['nama_kk']; ?></td>
                            <td><?= $t['alamat']; ?></td>
                            <td><?= $t['bulan']; ?></td>
                            <td><?= $t['jumlah']; ?></td>
                            <td>Belum Bayar</td>
                        </tr>
                        <?php $total += $t['jumlah']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="5"><strong>Total</strong></td>
                        <td colspan="2">Rp.<?= number_format($total, 0, ',', '.'); ?></td>
                    </tr>
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