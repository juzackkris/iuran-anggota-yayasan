<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#formModalKk"><i class="fas fa-plus"></i> Tambah Data</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

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
                                <td>
                                    <a class="btn btn-sm btn-primary " href="<?php echo base_url('admin/anggota/ubahAnggota/' . $a['id_anggota']) ?>"><i class="fas fa-edit"></i></a>
                                    <a onclick="return confirm('Yakin Hapus')" class="btn btn-sm btn-danger " href="<?php echo base_url('admin/anggota/hapus/' . $a['id_anggota']) ?>"><i class="fas fa-trash"></i></a>
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
                <h5 class="modal-title" id="formModalLabelKk">TAMBAH ANGGOTA KELUARGA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('admin/anggota'); ?>
                <div class="form group">
                    <label><b>NAMA KEPALA KELUARGA</b></label>
                    <select name="nama_kk" id="nama_kk" class="form-control mb-3">
                        <option value="">--Pilih Kepala Keluarga--</option>
                        <?php foreach ($kk as $k) : ?>
                            <option value="<?php echo $k->nama_kk ?>"><?php echo $k->nama_kk ?></option>
                        <?php endforeach; ?>
                    </select>
                    <small class="muted text-danger"><?= form_error('nama_kk'); ?></small>
                </div>
                <div class="form group">
                    <label for="nama"><b>NAMA ANGGOTA KELUARGA</b></label>
                    <input type="text" name="nama" id="nama" class="form-control mb-3">
                    <small class="muted text-danger"><?= form_error('nama'); ?></small>
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
                    <label for="Telepon"><b>TELEPON</b></label>
                    <input type="number" name="telepon" id="telepon" class="form-control mb-3" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==14) return false;" >
                    <small class="muted text-danger"><?= form_error('Telepon'); ?></small>
                </div>
                <div class="form group">
                    <label for="status"><b>STATUS</b></label>
                    <select name="status" id="status" class="form-control mb-3">
                        <option value="">--Pilih Status--</option>
                        <option value="Istri">Istri</option>
                        <option value="Anak">Anak</option>
                        <small class="muted text-danger"><?= form_error('status'); ?></small>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nik"><b>NIK</b></label>
                    <input type="number" name="nik" id="nik" class="form-control mb-3" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==16) return false;" >
                    <small class="muted text-danger"><?= form_error('nik'); ?></small>
                </div>
                <div class="form-group">
                    <label for="no_kk"><b>NOMOR KK</b></label>
                    <input type="number" name="no_kk" id="no_kk" class="form-control mb-3" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==16) return false;" >
                    <small class="muted text-danger"><?= form_error('no_kk'); ?></small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>