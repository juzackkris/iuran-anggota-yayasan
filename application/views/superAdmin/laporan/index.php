<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-12 bg-primary">
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <div class="row">
                        <div class="col-md-5 ml-5">
                            <!-- <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Cetak Laporan Kepala Keluarga</h5>
                                    <a href="<?= base_url('admin/laporan/kk'); ?>" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i></a>
                                </div>
                            </div>
                            <div class="card mt-4" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Cetak Laporan Anggota Keluarga</h5>
                                    <a href="<?= base_url('admin/laporan/anggota'); ?>" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i></a>
                                </div>
                            </div>
                            <div class="card mt-4" style="width: 30rem;">
                                <div class="card-body">
                                    <h5 class="card-title">Laporan Pendaftaran Perbulan</h5>
                                    <?= form_open('admin/laporan/pendaftaranBulanan'); ?>
                                    <div class="form-group">
                                        <label for="mulai_tgl">Pilih Bulan</label>
                                        <input type="month" name="tgl_input" class="form-control" value="<?= date('F Y'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn-primary">Tampilkan</button>
                                    </div>
                                    <?= form_close(); ?>
                                </div>
                            </div> -->
                            <div class="card mb-5">
                                <div class="card-body">
                                    <h5 class="card-title"><b>Laporan Pendaftaran Bulanan</b></h5>
                                    <?= form_open('superAdmin/laporan/pendaftaranBulanan'); ?>
                                    <div class="form-group">
                                        <label for="mulai_tgl">Pilih Bulan</label>
                                        <input type="month" name="tgl_input" class="form-control" value="<?= date('F Y'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn-success">Tampilkan</button>
                                    </div>
                                    <?= form_close(); ?>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><b>Laporan Kematian Tahunan</b></h5>
                                    <?= form_open('superAdmin/laporan/kematianPertahun'); ?>
                                    <div class="form-group">
                                        <label for="mulai_tgl">Mulai Tanggal</label>
                                        <input type="date" name="mulai_tgl" class="form-control" value="<?= date('Y-m-d'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="sampai_tgl">Sampai Tanggal</label>
                                        <input type="date" name="sampai_tgl" class="form-control" value="<?= date('Y-m-d'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn-success">Tampilkan</button>
                                    </div>
                                    <?= form_close(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-body">
                                <h5 class="card-title"><b> Pembayaran</b></h5>
                                    <?= form_open('superAdmin/laporan/pembayaran'); ?>
                                    <div class="form-group">
                                        <label for="mulai_tgl">Mulai Tanggal</label>
                                        <input type="date" name="mulai_tgl" class="form-control" value="<?= date('Y-m-d'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="sampai_tgl">Sampai Tanggal</label>
                                        <input type="date" name="sampai_tgl" class="form-control" value="<?= date('Y-m-d'); ?>">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="form-control btn-success">Tampilkan</button>
                                    </div>
                                    <?= form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>