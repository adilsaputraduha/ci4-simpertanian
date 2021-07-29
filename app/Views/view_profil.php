<?= $this->extend('layout/main'); ?>

<?= $this->section('menu'); ?>

<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('/'); ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<?php if (session()->get('userlevel') == 0) { ?>
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-user-cog"></i>
            <span>Management User</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('user'); ?>">User List</a>
            </div>
        </div>
    </li>
<?php } ?>
<hr class="sidebar-divider d-none d-md-block">
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Management Data</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url('kelompok'); ?>">Data Kelompok</a>
            <a class="collapse-item" href="<?= base_url('anggota'); ?>">Data Anggota Kelompok</a>
            <?php if (session()->get('userlevel') == 0 || session()->get('userlevel') == 1) { ?>
                <a class="collapse-item" href="<?= base_url('bantuan'); ?>">Bantuan Masuk</a>
                <a class="collapse-item" href="<?= base_url('pelatihan'); ?>">Jadwal Pelatihan</a>
                <a class="collapse-item" href="<?= base_url('lahan'); ?>">Luas Lahan</a>
                <a class="collapse-item" href="<?= base_url('penerima'); ?>">Penerima Bantuan</a>
                <a class="collapse-item" href="<?= base_url('hasil'); ?>">Hasil Pelatihan</a>
            <?php } ?>
        </div>
    </div>
</li>

<hr class="sidebar-divider d-none d-md-block">

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-book-open"></i>
        <span>Report</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <?php if (session()->get('userlevel') == 0 || session()->get('userlevel') == 1) { ?>
                <a class="collapse-item" href="<?= base_url('kelompok/report'); ?>">Lap. Kelompok</a>
                <a class="collapse-item" href="<?= base_url('anggota/report'); ?>">Lap. Anggota Kelompok</a>
                <a class="collapse-item" href="<?= base_url('bantuan/report'); ?>">Lap. Bantuan Masuk</a>
            <?php } ?>
            <?php if (session()->get('userlevel') == 0 || session()->get('userlevel') == 1 || session()->get('userlevel') == 2) { ?>
                <a class="collapse-item" href="<?= base_url('pelatihan/report'); ?>">Lap. Jadwal Pelatihan</a>
            <?php } ?>
            <?php if (session()->get('userlevel') == 0 || session()->get('userlevel') == 1) { ?>
                <a class="collapse-item" href="<?= base_url('lahan/report'); ?>">Lap. Luas Lahan</a>
                <a class="collapse-item" href="<?= base_url('penerima/report'); ?>">Lap. Penerima Bantuan</a>
                <a class="collapse-item" href="<?= base_url('hasil/report'); ?>">Lap. Hasil Pelatihan</a>
            <?php } ?>
        </div>
    </div>
</li>
<hr class="sidebar-divider d-none d-md-block">
<li class="nav-item active">
    <a class="nav-link" href="<?= base_url('manageuser1/myprofile'); ?>">
        <i class="fas fa-user-cog"></i>
        <span>My Profile</span>
    </a>
</li>

<hr class="sidebar-divider d-none d-md-block">
<!-- Nav Item - Logout -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('logout'); ?>">
        <i class="fas fa-user-lock"></i>
        <span>Logout</span></a>
</li>

<?= $this->endSection(); ?>

<?= $this->section('isi'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="alert alert-success icons-alert">
        <h6>Profil Saya</h6>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if (session()->getFlashdata('success')) { ?>
                <div class="alert alert-success icons-alert mb-2">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php echo session()->getFlashdata('success'); ?>
                </div>
            <?php } else if (session()->getFlashdata('failed')) { ?>
                <div class="alert alert-danger icons-alert mb-2">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?php echo session()->getFlashdata('failed'); ?>
                </div>
            <?php } ?>
            <div class="row justify-content-center">
                <div class="col-sm-6">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">Email : <?= session()->get('useremail'); ?></a>
                        <a href="#" class="list-group-item list-group-item-action">Nama : <?= session()->get('username'); ?></a>
                        <a href="#" class="list-group-item list-group-item-action">Level : <?php if (session()->get('userlevel') == 1) { ?> Admin <?php } else if (session()->get('userlevel') == 0) { ?> Super Admin <?php } else if (session()->get('userlevel') == 2) { ?> Kelompok <?php } ?></a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-sm-6">
                    <button class="btn btn-primary float-right" data-toggle="modal" data-target="#updateModal">Update Data</button>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="<?= base_url('profil/update'); ?>" method="POST">
    <?= csrf_field(); ?>
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Update profil</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" readonly class="form-control" id="email" name="email" value="<?= session()->get('useremail'); ?>" required placeholder="Input email">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label>Nama</label>
                                <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" required value="<?= old('nama'); ?>" placeholder="Input nama baru">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('nama'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" required placeholder="Input password baru">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('password'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mt-2 mb-2" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary mt-2 mb-2 mr-2">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?= $this->endSection(); ?>