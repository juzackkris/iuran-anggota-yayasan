<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>
    <div class="card" style="width: 60%; margin-bottom: 60px;">
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <?= form_open(''); ?>
                    <input type="hidden" name="id_keluarga" value="<?= $kk['id_keluarga']; ?>">
                    <div class="form group">
                        <label><b>NOMOR ID</b></label>
                        <input type="number" name="nomor_id" id="nomor_id" class="form-control mb-3"
                            value="<?= $kk['nomor_id']; ?>" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" >
                        <small class="muted text-danger"><?= form_error('nomor_id'); ?></small>
                    </div>
                    <div class="form group">
                        <label><b>NAMA KEPALA KELUARGA</b></label>
                        <input type="text" name="nama_kk" id="nama_kk" class="form-control mb-3"
                            value="<?= $kk['nama_kk']; ?>">
                        <small class="muted text-danger"><?= form_error('nama_kk'); ?></small>
                    </div>
                    <div class="form group">
                        <label><b>ALAMAT</b></label>
                        <input type="text" name="alamat" id="alamat" class="form-control mb-3"
                            value="<?= $kk['alamat']; ?>">
                        <small class="muted text-danger"><?= form_error('alamat'); ?></small>
                    </div>
                    <div class="form group">
                        <label><b>TANGGAL LAHIR</b></label>
                        <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control mb-3"
                            value="<?= $kk['tgl_lahir']; ?>">
                        <small class="muted text-danger"><?= form_error('tgl_lahir'); ?></small>
                    </div>
                    <div class="form group">
                        <label><b>TELEPON</b></label>
                        <input type="number" name="telepon" id="telepon" class="form-control mb-3"
                            value="<?= $kk['telepon']; ?>" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==14) return false;" >
                        <?php echo form_error('telepon', '<div class="text-small text-danger"></div>') ?>
                    </div>

                    <input type="hidden" name="biaya" id="biaya" value="15000" readonly class="form-control mb-3">
                    <small class="muted text-danger"><?= form_error('biaya'); ?></small>

                    <input type="hidden" name="jatuh_tempo" id="jatuh_tempo" value="2022-01-10" readonly
                        class="form-control mb-3">
                    <small class="muted text-danger"><?= form_error('jatuh_tempo'); ?></small>

                    <div class="form group">
                        <label><b>NIK</b></label>
                        <input type="number" name="nik" id="nik" class="form-control mb-3" value="<?= $kk['nik']; ?>" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==16) return false;" >
                        <?php echo form_error('nik', '<div class="text-small text-danger"></div>') ?>
                    </div>
                    <div class="form group">
                        <label><b>NOMOR KK</b></label>
                        <input type="number" name="nomor_kk" id="nomor_kk" class="form-control mb-3"
                            value="<?= $kk['nomor_kk']; ?>" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==16) return false;" >
                        <?php echo form_error('nomor_kk', '<div class="text-small text-danger"></div>') ?>
                    </div>
                    <div class="form group">
                        <label><b>TANGGAL MENINGGAL</b></label>
                        <input type="date" name="tgl_meninggal" id="tgl_meninggal" class="form-control mb-3"
                            value="<?= $kk['tgl_meninggal']; ?>">
                    </div>
                    <div class="form-group">
                        <a href="<?= base_url('superAdmin/kk'); ?>" class="btn btn-secondary" data-dismiss="modal">Keluar</a>
                        <button type="submit" class="btn btn-success">Ubah</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>