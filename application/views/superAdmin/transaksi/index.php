<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>
    <?php echo $this->session->flashdata('pesan') ?>
    <?php echo $this->session->flashdata('pesan_transaksi') ?>
    <?php echo $this->session->flashdata('pesan_pertanggal') ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <div class="col-md-6">
                <div class="alert alert-info" role="alert"><i class="fas fa-info"></i> Masukan Nomor ID Kepala Keluarga
                    yang sudah terdaftar untuk melihat Iuran Bulanan.</div>
                <form action="<?= base_url('superAdmin/transaksi/cariTransaksi') ?>" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nomor ID Kepala Keluarga..."
                            name="nomor_id" autofocus="on">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit"><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </div>
                    <small class="muted text-danger"><?= form_error('nomor_id'); ?></small>
                </form>
            </div>
        </div>

        <?php if ($this->input->get('nomor_id')) :
            // redirect('admin/transaksi'. '/' . $kk['nomor_id']);
        ?>

        <div class="row">
            <div class="col-md-4 offset-md-1">
                <h4 class="text-center">Biodata Kepala Keluarga</h4>
                <table class="table">
                    <tr>
                        <th>Nomor ID</th>
                        <td>:</td>
                        <td><?= $kk['nomor_id']; ?></td>
                    </tr>
                    <tr>
                        <th>Nama Kepala Keluarga</th>
                        <td>:</td>
                        <td><?= $kk['nama_kk']; ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>:</td>
                        <td><?= $kk['alamat']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir </th>
                        <td>:</td>
                        <td><?= $kk['tgl_lahir']; ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4 offset-md-2">
            <h4 class="text-center">Cetak Struk Pertanggal</h4>
                    <div class="card">
                        <div class="card-body">
                            <?= form_open('superAdmin/laporan/cetakStrukPeriode/'. $kk['nomor_id']); ?>
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" id="datepicker" name="tanggal" class="form-control">
                            </div>
                            <!-- <div class="form-group">
                                <label for="sampai_tgl">Sampai Tanggal</label>
                                <input type="date" id="datepicker" name="sampai_tgl" class="form-control">
                            </div> -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mb-6 col-md-4 offset-md-4">Tampilkan</button>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                
            </div>    
        </div>
        <!-- /Biodata Siswa -->


        <!-- Data Pembayaran -->
        <div class="card shadow mb-4 mt-4">
            <div class="card-body">
                <div class="table-responsive">
                <form action="<?= base_url('superAdmin/transaksi/bayarBanyak/' . $kk['nomor_id']) ?>" method="POST">
                    <table class="table table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
                        <a href="<?= base_url('superAdmin/laporan/cetakStruk/' .  $kk['nomor_id']); ?>" target="_self"
                            class="btn btn-primary mb-3">Cetak Struk <i class="fas fa-print"></i></a>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Bulan</th>
                                <th>Tanggal Bayar</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                                <th>Bayar</th>
                                <th class="text-center"><button type="submit" name="tombolCheckbox" class="btn btn-success btn-sm">Bayar</button></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $no = 1;
                                foreach ($pembayaran as $s) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $s['bulan']; ?></td>
                                <td><?= $s['tglbayar']; ?></td>
                                <td><?= $s['jumlah']; ?></td>
                                <td><?= $s['ket']; ?></td>
                                <td>
                                    <?php if ($s['nobayar'] == null) : ?>
                                    <a href="<?= base_url('superAdmin/transaksi/bayar/' . $kk['nomor_id'] . '/' . $s['id_pb']); ?>"
                                        class="btn btn-success">Bayar</a>
                                    <?php else : ?>
                                    <a href="<?= base_url('superAdmin/transaksi/batal/' . $kk['nomor_id'] . '/' . $s['id_pb']); ?>"
                                        class="btn btn-danger btn-sm">Batal</a>
                                    
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="checkbox_value[]" value="<?= $s['id_pb']; ?>">
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </form>
                </div>
            </div>
        </div>

        <!-- /Data Pembayaran -->
        <?php endif; ?>

    </div>
</div>