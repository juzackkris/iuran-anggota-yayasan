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
            <div class="card"></br>
                <h4 class="text-center"><b>STRUK PEMBAYARAN IURAN YAYASAN DHARMA BHAKTI CIKAMPEK</b></h4></br>
                <div class="row">
                    <div class="col-md-4 offset-md-1">
                        <table class="table table-borderless">
                            <tr>
                                <th>NOMOR ID</th>
                                <td>:</td>
                                <td><?= $kk['nomor_id']; ?></td>
                            </tr>
                            <tr>
                                <th>NAMA</th>
                                <td>:</td>
                                <td><?= $kk['nama_kk']; ?></td>
                            </tr>
                            <tr>
                                <th>NOMOR BAYAR</th>
                                <td>:</td>
                                <td><?= $pembayaran['nobayar']; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-5 offset-md-1">
                        <table class="table table-borderless">
                            <tr>
                                <th>JUMLAH BULAN</th>
                                <td>:</td>
                                <?php $totalBulan = 0; 
                                foreach ($bayar as $b) :?>
                                    <?php $totalBulan ++?>
                                <?php endforeach; ?>
                                <td>Rp 15.000 x <?= $totalBulan; ?> bulan</td>
                            </tr>
                            <tr>
                                <th>BULAN BAYAR</th>
                                <td>:</td>
                                <?php 
                                foreach ($bulanBayar as $bulan) :?>
                                    <?php $bulan['bulan'];?>
                                <?php endforeach; ?>
                                <?php 
                                foreach ($bayar as $b) :?>
                                    <?php $b['bulan'];?>
                                <?php endforeach; ?>
                                <td><?= $b['bulan']; ?> - <?= $bulan['bulan']; ?> </td>
                            </tr>
                            <tr>
                                <th>TOTAL</th>
                                <td>:</td>
                                <?php $total = 0; 
                                foreach ($bayar as $b) :?>
                                    <?php $total += $b['jumlah']; ?>
                                <?php endforeach; ?>
                                <td>Rp.<?= number_format($total, 0, ',', '.'); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-md-3 offset-md-9 mt-4">
                        <table>
                            <tr>
                                <td></td>
                                <td>
                                    <p>Cikampek, <?= date('d-m-Y'); ?><br>
                                        Admin</p>
                                    <br>
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