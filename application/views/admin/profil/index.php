<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>
    <?= $this->session->flashdata('pesan'); ?>
    <div class="card shadow mb-12">
        <div class="card-header py-12 bg-primary">
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 offset-md-3">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="card card-primary">
                        <h5 class="card-header bg-info" align="center"><b>PROFIL</b></h5>
                        <div class="card-body">
                            <form action="<?php echo base_url('admin/profil/subah'); ?>" method="POST">
                                <input type="hidden" name="kode" value="<?php echo $id_admin ?>">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama_admin"
                                        value="<?php echo $nama_admin; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username"
                                        value="<?php echo $username; ?>">
                                </div>
                                <div class=" mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password"
                                        value="<?php echo $password; ?>" s>
                                </div>
                                <button type=" submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


