<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>
    <?= $this->session->flashdata('pesan'); ?>
    <?= $this->session->flashdata('danger'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#formModalKk"><i class="fas fa-plus"></i> Tambah Data</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-sm table-hover" id="dataTable" width="100%" cellspacing="0" >
                    <thead>
                        <tr align="center">
                            <th>NO</th>
                            <th>ID</th>
                            <th>NAMA</th>
                            <th>ALAMAT</th>
                            <th>TANGGAL LAHIR</th>
                            <th>TELEPON</th>
                            <th>NIK</th>
                            <th>NOMOR KK</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($kk as $k) : ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?= $k['nomor_id']; ?></td>
                                <td><?= $k['nama_kk']; ?></td>
                                <td><?= $k['alamat']; ?></td>
                                <td><?= $k['tgl_lahir']; ?></td>
                                <td><?= $k['telepon']; ?></td>
                                <td><?= $k['nik']; ?></td>
                                <td><?= $k['nomor_kk']; ?></td>
                                <td align="center">
                                    <a class="btn btn-sm btn-primary " href="<?php echo base_url('superAdmin/kk/ubahKk/' . $k['id_keluarga']) ?>"><i class="fas fa-user-edit"></i></a>
                                    <a onclick="return confirm('Yakin Hapus')" class="btn btn-sm btn-danger " href="<?php echo base_url('superAdmin/kk/hapus/' . $k['id_keluarga']) ?>"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="formModalKk" tabindex="-1" aria-labelledby="formModalLabelKk" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabelKk" ><center><b>TAMBAH KEPALA KELUARGA</b></center></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('admin/kk'); ?>
                <div class="form group">
                    <label for="nomor_id"><b>NOMOR ID</b></label>
                    <input type="number" name="nomor_id" id="nomor_id" class="form-control mb-3" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" >
                    <small class="muted text-danger"><?= form_error('nomor_id'); ?></small>
                </div>
                <div class="form group">
                    <label for="nama_kk"><b>NAMA KEPALA KELUARGA</b></label>
                    <input type="text" name="nama_kk" id="nama_kk" class="form-control mb-3">
                    <small class="muted text-danger"><?= form_error('nama_kk'); ?></small>
                </div>
                <div class="form group">
                    <label for="alamat"><b>ALAMAT</b></label>
                    <input type="text" name="alamat" id="alamat" class="form-control mb-3">
                    <small class="muted text-danger"><?= form_error('alamat'); ?></small>
                </div>
                <div class="form group">
                    <label for="tgl_lahir"><b>TANGGAL LAHIR</b></label>
                    <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control mb-3">
                    <small class="muted text-danger"><?= form_error('tgl_lahir'); ?></small>
                </div>
                <div class="form group">
                    <label for="telepon"><b>TELEPON</b></label>
                    <input type="number" name="telepon" id="telepon" class="form-control mb-3" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==14) return false;" >
                    <small class="muted text-danger"><?= form_error('telepon'); ?></small>
                </div>

                <input type="hidden" name="biaya" id="biaya" value="15000" readonly class="form-control mb-3">
                <small class="muted text-danger"><?= form_error('biaya'); ?></small>

                <input type="hidden" name="jatuh_tempo" id="jatuh_tempo" value="2022-01-10" readonly class="form-control mb-3">
                <small class="muted text-danger"><?= form_error('jatuh_tempo'); ?></small>

                <div class="form group">
                    <label for="nik"><b>NIK</b></label>
                    <input type="number" name="nik" id="nik" class="form-control mb-3" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==16) return false;" >
                    <small class="muted text-danger"><?= form_error('nik'); ?></small>
                </div>
                <div class="form group">
                    <label for="nomor_kk"><b>NOMOR KK</b></label>
                    <input type="number" name="nomor_kk" id="nomor_kk" class="form-control mb-3" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==16) return false;" >
                    <small class="muted text-danger"><?= form_error('nomor_kk'); ?></small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
