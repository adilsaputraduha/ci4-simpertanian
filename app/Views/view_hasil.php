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
                <a class="collapse-item" href="<?= base_url('penerima'); ?>">Data Penerima Bantuan</a>
                <a class="collapse-item active" href="<?= base_url('hasil'); ?>">Data Hasil Pelatihan</a>
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
        <h6>Data Hasil Pelatihan</h6>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahModal"><i class="fa fa-plus mr-2"></i>Tambah Data</button>
            <a href="<?= base_url('hasil/report'); ?>" class="btn btn-info"><i class="fa fa-print mr-2"></i>Cetak</a>
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
                            <th>Tanggal Pelatihan</th>
                            <th>Agenda</th>
                            <th>Hasil</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($hasil as $row) : $no++ ?>
                            <tr>
                                <td> <?= $no; ?></td>
                                <td> <?= $row['pelatihan_tanggal']; ?></td>
                                <td> <?= $row['pelatihan_agenda']; ?></td>
                                <td> <?= $row['hasil_status']; ?></td>
                                <td style="text-align: center;">
                                    <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal<?= $row['hasil_id']; ?>">Edit</a>
                                    <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusModal<?= $row['hasil_id']; ?>">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<form action="<?= base_url('hasil/save'); ?>" method="POST">
    <?= csrf_field(); ?>
    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Tambah hasil pelatihan</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label>Pelatihan</label>
                                <div class="input-group mb-3">
                                    <input type="hidden" name="idagenda" id="idagenda" class="idagenda">
                                    <input type="text" id="agenda" name="agenda" value="<?= old('agenda'); ?>" required readonly class="form-control agenda <?= ($validation->hasError('agenda')) ? 'is-invalid' : ''; ?>" />
                                    <button class="btn btn-primary ml-1" data-toggle="modal" data-target="#cariPelatihan" type="button">Cari</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label>Status</label>
                                <select name="keterangan" id="keterangan" class="form-control">
                                    <option value="Terlaksana">Terlaksana</option>
                                    <option value="Ditunda">Ditunda</option>
                                    <option value="Batal">Batal</option>
                                    <option value="Belum terlaksana">Belum terlaksana</option>
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

<?php foreach ($hasil as $row) : ?>
    <form action="<?= base_url('hasil/edit'); ?>" method="POST">
        <?= csrf_field(); ?>
        <div class="modal fade" id="editModal<?= $row['hasil_id']; ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit hasil pelatihan</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="<?= $row['hasil_id']; ?>">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label>Pelatihan</label>
                                    <div class="input-group mb-3">
                                        <input type="hidden" name="idagenda" value="<?= $row['hasil_pelatihan']; ?>" id="idagenda" class="idagenda">
                                        <input type="text" id="agenda" name="agenda" value="<?= $row['pelatihan_agenda']; ?>" required readonly class="form-control agenda <?= ($validation->hasError('agenda')) ? 'is-invalid' : ''; ?>" />
                                        <button class="btn btn-primary ml-1" data-toggle="modal" data-target="#cariPelatihan" type="button">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="keterangan" id="keterangan" class="form-control">
                                        <?php if ($row['hasil_status'] == 'Terlaksana') { ?>
                                            <option selected value="Terlaksana">Terlaksana</option>
                                            <option value="Ditunda">Ditunda</option>
                                            <option value="Batal">Batal</option>
                                            <option value="Belum terlaksana">Belum terlaksana</option>
                                        <?php } else if ($row['hasil_status'] == 'Ditunda') { ?>
                                            <option selected value="Ditunda">Ditunda</option>
                                            <option value="Terlaksana">Terlaksana</option>
                                            <option value="Batal">Batal</option>
                                            <option value="Belum terlaksana">Belum terlaksana</option>
                                        <?php } else if ($row['hasil_status'] == 'Batal') { ?>
                                            <option selected value="Batal">Batal</option>
                                            <option value="Ditunda">Ditunda</option>
                                            <option value="Terlaksana">Terlaksana</option>
                                            <option value="Belum terlaksana">Belum terlaksana</option>
                                        <?php } else if ($row['hasil_status'] == 'Belum terlaksana') { ?>
                                            <option selected value="Belum terlaksana">Belum terlaksana</option>
                                            <option value="Batal">Batal</option>
                                            <option value="Ditunda">Ditunda</option>
                                            <option value="Terlaksana">Terlaksana</option>
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
    <form action="<?= base_url('hasil/delete'); ?>" method="POST">
        <?= csrf_field(); ?>
        <div class="modal fade" tabindex="-1" id="hapusModal<?= $row['hasil_id']; ?>" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus hasil pelatihan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" required value="<?= $row['hasil_id']; ?>" />
                        <input type="hidden" name="idpelatihan" required value="<?= $row['pelatihan_id']; ?>" />
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

<div class="modal" tabindex="-1" id="cariPelatihan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Pelatihan</h5>
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
                        foreach ($pelatihan as $row) : $no++ ?>
                            <tr>
                                <td> <?= $no; ?></td>
                                <td> <?= $row['pelatihan_tanggal']; ?></td>
                                <td> <?= $row['kecamatan_nama']; ?></td>
                                <td> <?= $row['kelurahan_nama']; ?></td>
                                <td> <?= $row['pelatihan_agenda']; ?></td>
                                <td style="text-align: center;">
                                    <a class="btn-sm btn-primary btn-pilihpelatihan" data-id="<?= $row['pelatihan_id']; ?>" data-agenda="<?= $row['pelatihan_agenda']; ?>"><i class="fa fa-chevron-left"></i></a>
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
    $('.btn-pilihpelatihan').on('click', function() {
        const idagenda = $(this).data('id');
        const agenda = $(this).data('agenda');
        $('.agenda').val(agenda);
        $('.idagenda').val(idagenda);
        $('#cariPelatihan').modal('hide');
    });
</script>

<?= $this->endSection(); ?>