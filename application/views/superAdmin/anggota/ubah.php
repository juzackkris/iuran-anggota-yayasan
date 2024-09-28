<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>
    <div class="card" style="width: 60%; margin-bottom: 60px;">
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <?= form_open(''); ?>
                    <input type="hidden" name="id_anggota" value="<?= $anggota['id_anggota']; ?>">
                    <div class="form group">
                        <label><b>NAMA KEPALA KELUARGA</b></label>
                        <select name="nama_kk" id="nama_kk" class="form-control mb-3" value="<?= $anggota['nama_kk']; ?>">
                            <option value="">--Pilih Kepala Keluarga--</option>
                            <?php foreach ($kk as $k) : ?>
                                <option value="<?php echo $k->nama_kk ?>" selected><?php echo $k->nama_kk ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="muted text-danger"><?= form_error('nama_kk'); ?></small>
                    </div>

                    <div class="form group">
                        <label><b>NAMA ANGGOTA KELUARGA</b></label>
                        <input type="text" name="nama" id="nama" class="form-control mb-3" value="<?= $anggota['nama']; ?>">
                        <small class="muted text-danger"><?= form_error('nama'); ?></small>
                    </div>
                    <div class="form group">
                        <label><b>ALAMAT</b></label>
                        <input type="text" name="alamat" id="alamat" class="form-control mb-3" value="<?= $anggota['alamat']; ?>">
                        <small class="muted text-danger"><?= form_error('alamat'); ?></small>
                    </div>
                    <div class="form group">
                        <label><b>TANGGAL LAHIR</b></label>
                        <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control mb-3" value="<?= $anggota['tgl_lahir']; ?>">
                        <small class="muted text-danger"><?= form_error('tgl_lahir'); ?></small>
                    </div>
                    <div class="form group">
                        <label><b>TELEPON</b></label>
                        <input type="number" name="telepon" id="telepon" class="form-control mb-3" value="<?= $anggota['telepon']; ?>" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==14) return false;">
                        <?php echo form_error('telepon', '<div class="text-small text-danger"></div>') ?>
                    </div>
                    <div class="form group">
                        <label><b>STATUS</b></label>
                        <select name="status" id="status" class="form-control mb-3">
                            <option value="<?= $anggota['status']; ?>" selected><?= $anggota['status']; ?></option>
                            <option value="Istri">Istri</option>
                            <option value="Anak">Anak</option>
                            <small class="muted text-danger"><?= form_error('status'); ?></small>
                        </select>
                    </div>
                    <div class="form group">
                        <label><b>NIK</b></label>
                        <input type="number" name="nik" id="nik" class="form-control mb-3" value="<?= $anggota['nik']; ?>" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==16) return false;">
                        <small class="muted text-danger"><?= form_error('nik'); ?></small>
                    </div>
                    <div class="form group">
                        <label><b>NOMOR KK</b></label>
                        <input type="number" name="no_kk" id="no_kk" class="form-control mb-3" value="<?= $anggota['no_kk']; ?>" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==16) return false;">
                        <small class="muted text-danger"><?= form_error('no_kk'); ?></small>
                    </div>
                    <div class="form group">
                        <label><b>TANGGAL MENINGGAL</b></label>
                        <input type="date" name="tgl_meninggal" id="tgl_meninggal" class="form-control mb-3"
                            value="<?= $anggota['tgl_meninggal']; ?>">
                    </div>
                    <div class="form-group">
                        <a href="<?= base_url('superAdmin/kk'); ?>" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-success">Ubah</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>