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
<li class="nav-item active">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Management Data</span>
    </a>
    <div id="collapseUtilities" class="collapse show" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url('kelompok'); ?>">Data Kelompok</a>
            <a class="collapse-item" href="<?= base_url('anggota'); ?>">Data Anggota Kelompok</a>
            <?php if (session()->get('userlevel') == 0 || session()->get('userlevel') == 1) { ?>
                <a class="collapse-item active" href="<?= base_url('bantuan'); ?>">Data Bantuan Masuk</a>
                <a class="collapse-item" href="<?= base_url('pelatihan'); ?>">Data Jadwal Pelatihan</a>
                <a class="collapse-item" href="<?= base_url('lahan'); ?>">Data Luas Lahan</a>
                <a class="collapse-item" href="<?= base_url('penerima'); ?>">Data Penerima Bantuan</a>
                <a class="collapse-item" href="<?= base_url('hasil'); ?>">Data Hasil Pelatihan</a>
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
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('profil'); ?>">
        <i class="fas fa-user-cog"></i>
        <span>My Profile</span></a>
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
        <h6>Data Bantuan Masukan</h6>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahModal"><i class="fa fa-plus mr-2"></i>Tambah Data</button>
            <a href="<?= base_url('bantuan/report'); ?>" class="btn btn-info"><i class="fa fa-print mr-2"></i>Cetak</a>
        </div>
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
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Bantuan</th>
                            <th>QTY</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($bantuan as $row) : $no++ ?>
                            <tr>
                                <td> <?= $no; ?></td>
                                <td> <?= $row['bantuan_tanggal']; ?></td>
                                <td> <?= $row['bantuan_nama']; ?></td>
                                <td> <?= $row['bantuan_qty']; ?></td>
                                <td> <?= $row['bantuan_keterangan']; ?></td>
                                <td style="text-align: center;">
                                    <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal<?= $row['bantuan_id']; ?>">Edit</a>
                                    <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusModal<?= $row['bantuan_id']; ?>">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<form action="<?= base_url('bantuan/save'); ?>" method="POST">
    <?= csrf_field(); ?>
    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Tambah bantuan</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label>Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label>Bantuan</label>
                                <input type="text" class="form-control" id="nama" name="nama" required placeholder="Input bantuan">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label>Qty</label>
                                <input type="text" class="form-control" id="qty" name="qty" required placeholder="Input quantity">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label>Keterangan</label>
                                <select name="keterangan" id="keterangan" class="form-control">
                                    <option value="Sudah diterima">Sudah diterima</option>
                                    <option value="Belum diterima">Belum diterima</option>
                                </select>
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

<?php foreach ($bantuan as $row) : ?>
    <form action="<?= base_url('bantuan/edit'); ?>" method="POST">
        <?= csrf_field(); ?>
        <div class="modal fade" id="editModal<?= $row['bantuan_id']; ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit bantuan</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id" value="<?= $row['bantuan_id']; ?>">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label>Tanggal</label>
                                    <input type="date" value="<?= $row['bantuan_tanggal']; ?>" class="form-control" id="tanggal" name="tanggal" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label>Bantuan</label>
                                    <input type="text" value="<?= $row['bantuan_nama']; ?>" class="form-control" id="nama" name="nama" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label>Qty</label>
                                    <input type="text" value="<?= $row['bantuan_qty']; ?>" class="form-control" id="qty" name="qty" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label>Keterangan</label>
                                    <select name="keterangan" id="keterangan" class="form-control">
                                        <?php if ($row['bantuan_keterangan'] == 'Sudah diterima') { ?>
                                            <option selected value="Sudah diterima">Sudah diterima</option>
                                            <option value="Belum diterima">Belum diterima</option>
                                        <?php } else if ($row['bantuan_keterangan'] == 'Belum diterima') { ?>
                                            <option selected value="Belum diterima">Belum diterima</option>
                                            <option value="Sudah diterima">Sudah diterima</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mt-2 mb-2" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary mt-2 mb-2 mr-2">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form action="<?= base_url('bantuan/delete'); ?>" method="POST">
        <?= csrf_field(); ?>
        <div class="modal fade" tabindex="-1" id="hapusModal<?= $row['bantuan_id']; ?>" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus bantuan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" required value="<?= $row['bantuan_id']; ?>" />
                        <h6>Apakah anda yakin ingin menghapus data ini?</h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary mt-2 mb-2 mr-2">Yakin</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php endforeach; ?>

<script src="<?= base_url(); ?>/assets/vendor/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

<?= $this->endSection(); ?>