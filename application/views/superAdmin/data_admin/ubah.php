<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>
    <div class="card" style="width: 60%; margin-bottom: 60px;">
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <?= form_open(''); ?>
                    <input type="hidden" name="id_admin" value="<?= $admin['id_admin']; ?>">
                    <div class="form group">
                        <label><b>NAMA ADMIN</b></label>
                        <input type="text" name="nama_admin" id="nama_admin" class="form-control mb-3" value="<?= $admin['nama_admin']; ?>">
                        <small class="muted text-danger"><?= form_error('nama_admin'); ?></small>
                    </div>

                    <div class="form group">
                        <label><b>USERNAME</b></label>
                        <input type="text" name="username" id="username" class="form-control mb-3" value="<?= $admin['username']; ?>">
                        <small class="muted text-danger"><?= form_error('username'); ?></small>
                    </div>
                    <div class="form group">
                        <label><b>PASSWORD</b></label>
                        <input type="password" name="password" id="password" class="form-control mb-3" value="<?= $admin['password']; ?>">
                        <small class="muted text-danger"><?= form_error('password'); ?></small>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Ubah</button>
                        <a href="<?= base_url('superAdmin/Data_admin'); ?>" class="btn btn-secondary" data-dismiss="modal">Close</a>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>