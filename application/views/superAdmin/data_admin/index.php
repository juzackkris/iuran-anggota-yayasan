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
                            <th>Nama Admin</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $no = 1;
                        foreach ($admin as $a) : ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?= $a['nama_admin']; ?></td>
                                <td><?= $a['username']; ?></td>
                                <td><?= $a['password']; ?></td>
                                <td>
                                    <a class="btn btn-sm btn-primary " href="<?php echo base_url('superAdmin/data_admin/ubahAdmin/' . $a['id_admin']) ?>"><i class="fas fa-edit"></i></a>
                                    <a onclick="return confirm('Yakin Hapus')" class="btn btn-sm btn-danger " href="<?php echo base_url('superAdmin/data_admin/hapus/' . $a['id_admin']) ?>"><i class="fas fa-trash"></i></a>
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
                <h5 class="modal-title" id="formModalLabelKk">TAMBAH ADMIN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('superAdmin/data_admin'); ?>
                <div class="form group">
                    <label for="nama"><b>NAMA ADMIN</b></label>
                    <input type="text" name="nama_admin" id="nama_admin" class="form-control mb-3">
                    <small class="muted text-danger"><?= form_error('nama_admin'); ?></small>
                </div>
                <div class="form group">
                    <label for="alamat"><b>USERNAME</b></label>
                    <input type="text" name="username" id="username" class="form-control mb-3">
                    <small class="muted text-danger"><?= form_error('username'); ?></small>
                </div>
                <div class="form group">
                    <label for="password"><b>PASSWORD</b></label>
                    <input type="password" name="password" id="lihatPassword" class="form-control mb-3">
                    <input type="checkbox" onclick="myFunction()">  Lihat Password
                    <small class="muted text-danger"><?= form_error('password'); ?></small>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>
function myFunction() {
  var x = document.getElementById("lihatPassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>