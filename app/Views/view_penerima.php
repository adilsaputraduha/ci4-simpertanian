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
                <a class="collapse-item" href="<?= base_url('bantuan'); ?>">Data Bantuan Masuk</a>
                <a class="collapse-item" href="<?= base_url('pelatihan'); ?>">Data Jadwal Pelatihan</a>
                <a class="collapse-item" href="<?= base_url('lahan'); ?>">Data Luas Lahan</a>
                <a class="collapse-item active" href="<?= base_url('penerima'); ?>">Data Penerima Bantuan</a>
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
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('logout'); ?>">
        <i class="fas fa-user-lock"></i>
        <span>Logout</span></a>
</li>

<?= $this->endSection(); ?>

<?= $this->section('isi'); ?>

<div class="container-fluid">
    <div class="alert alert-success icons-alert">
        <h6>Data Penerima</h6>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahModal"><i class="fa fa-plus mr-2"></i>Tambah Data</button>
            <a href="<?= base_url('penerima/report'); ?>" class="btn btn-info"><i class="fa fa-print mr-2"></i>Cetak</a>
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
                            <th>Kelompok</th>
                            <th>Bantuan</th>
                            <th>Qty</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($penerima as $row) : $no++ ?>
                            <tr>
                                <td> <?= $no; ?></td>
                                <td> <?= $row['kelompok_nama']; ?></td>
                                <td> <?= $row['bantuan_nama']; ?></td>
                                <td> <?= $row['penerima_qty']; ?></td>
                                <td style="text-align: center;">
                                    <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal<?= $row['penerima_id']; ?>">Edit</a>
                                    <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusModal<?= $row['penerima_id']; ?>">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<form action="<?= base_url('penerima/save'); ?>" method="POST">
    <?= csrf_field(); ?>
    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Tambah penerima</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label>Kelompok</label>
                                <div class="input-group mb-3">
                                    <input type="hidden" name="idkelompok" id="idkelompok" class="idkelompok">
                                    <input type="text" id="kelompok" name="kelompok" value="<?= old('kelompok'); ?>" required readonly class="form-control kelompok <?= ($validation->hasError('kelompok')) ? 'is-invalid' : ''; ?>" />
                                    <button class="btn btn-primary ml-1" data-toggle="modal" data-target="#cariKelompok" type="button">Cari</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label>Bantuan</label>
                                <div class="input-group mb-3">
                                    <input type="hidden" name="idbantuan" id="idbantuan" class="idbantuan">
                                    <input type="text" id="bantuan" name="bantuan" value="<?= old('bantuan'); ?>" required readonly class="form-control bantuan <?= ($validation->hasError('bantuan')) ? 'is-invalid' : ''; ?>" />
                                    <button class="btn btn-primary ml-1" data-toggle="modal" data-target="#cariBantuan" type="button">Cari</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label>Qty</label>
                                <input type="hidden" name="qtyhidden" class="qtyhidden" id="qtyhidden">
                                <input type="text" class="form-control qty" id="qty" name="qty" required>
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

<?php foreach ($penerima as $row) : ?>
    <form action="<?= base_url('penerima/edit'); ?>" method="POST">
        <?= csrf_field(); ?>
        <div class="modal fade" id="editModal<?= $row['penerima_id']; ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit penerima</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id" value="<?= $row['penerima_id']; ?>">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label>Kelompok</label>
                                    <div class="input-group mb-3">
                                        <input type="hidden" value="<?= $row['penerima_kelompok']; ?>" name="idkelompok" id="idkelompok" class="idkelompok">
                                        <input type="text" id="kelompok" name="kelompok" value="<?= $row['kelompok_nama']; ?>" required readonly class="form-control kelompok <?= ($validation->hasError('kelompok')) ? 'is-invalid' : ''; ?>" />
                                        <button class="btn btn-primary ml-1" data-toggle="modal" data-target="#cariKelompok" type="button">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label>Bantuan</label>
                                    <div class="input-group mb-3">
                                        <input type="hidden" value="<?= $row['penerima_bantuan']; ?>" name="idbantuan" id="idbantuan" class="idbantuan">
                                        <input type="text" id="bantuan" name="bantuan" value="<?= $row['bantuan_nama']; ?>" required readonly class="form-control bantuan <?= ($validation->hasError('bantuan')) ? 'is-invalid' : ''; ?>" />
                                        <button class="btn btn-primary ml-1" data-toggle="modal" data-target="#cariBantuan" type="button">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label>Qty</label>
                                    <input type="hidden" value="<?= $row['penerima_qty']; ?>" name="qtyhidden" class="qtyhidden" id="qtyhidden">
                                    <input type="text" value="<?= $row['penerima_qty']; ?>" class="form-control qty" id="qty" name="qty" required>
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
    <form action="<?= base_url('penerima/delete'); ?>" method="POST">
        <?= csrf_field(); ?>
        <div class="modal fade" tabindex="-1" id="hapusModal<?= $row['penerima_id']; ?>" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus pelatihan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" required value="<?= $row['penerima_id']; ?>" />
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

<div class="modal" tabindex="-1" id="cariKelompok">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Kelompok</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kelompok Nama</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($kelompok as $row) : $no++ ?>
                            <tr>
                                <td> <?= $no; ?></td>
                                <td> <?= $row['kelompok_nama']; ?></td>
                                <td> <?= $row['kecamatan_nama']; ?></td>
                                <td> <?= $row['kelurahan_nama']; ?></td>
                                <td style="text-align: center;">
                                    <a class="btn-sm btn-primary btn-pilihkelompok" data-id="<?= $row['kelompok_id']; ?>" data-nama="<?= $row['kelompok_nama']; ?>"><i class="fa fa-chevron-left"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" id="cariBantuan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Bantuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Bantuan</th>
                            <th>Qty</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($bantuan as $row) : $no++ ?>
                            <tr>
                                <td> <?= $no; ?></td>
                                <td> <?= $row['bantuan_nama']; ?></td>
                                <td> <?= $row['bantuan_qty']; ?></td>
                                <td> <?= $row['bantuan_keterangan']; ?></td>
                                <td style="text-align: center;">
                                    <a class="btn-sm btn-primary btn-pilihbantuan" data-id="<?= $row['bantuan_id']; ?>" data-nama="<?= $row['bantuan_nama']; ?>" data-qty="<?= $row['bantuan_qty']; ?>"><i class="fa fa-chevron-left"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>/assets/vendor/jquery/jquery.min.js"></script>
<script>
    $('.btn-pilihkelompok').on('click', function() {
        const id = $(this).data('id');
        const nama = $(this).data('nama');
        $('.idkelompok').val(id);
        $('.kelompok').val(nama);
        $('#cariKelompok').modal('hide');
    });

    $('.btn-pilihbantuan').on('click', function() {
        const id = $(this).data('id');
        const nama = $(this).data('nama');
        const qty = $(this).data('qty');
        $('.idbantuan').val(id);
        $('.bantuan').val(nama);
        $('.qty').val(qty);
        $('.qtyhidden').val(qty);
        $('#cariBantuan').modal('hide');
    });
</script>

<?= $this->endSection(); ?>