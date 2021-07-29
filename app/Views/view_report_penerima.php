<?= $this->extend('layout/main'); ?>

<?= $this->section('menu'); ?>

<link href="<?= base_url(); ?>/assets/select2/css/select2.min.css" rel="stylesheet" />
<script src="<?= base_url(); ?>/assets/select2/js/select2.min.js"></script>

<hr class="sidebar-divider my-0">

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
                <a class="collapse-item" href="<?= base_url('user'); ?>">Data User</a>
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
                <a class="collapse-item" href="<?= base_url('bantuan'); ?>">Data Bantuan Masuk</a>
                <a class="collapse-item" href="<?= base_url('pelatihan'); ?>">Data Jadwal Pelatihan</a>
                <a class="collapse-item" href="<?= base_url('lahan'); ?>">Data Luas Lahan</a>
                <a class="collapse-item" href="<?= base_url('penerima'); ?>">Data Penerima Bantuan</a>
                <a class="collapse-item" href="<?= base_url('hasil'); ?>">Data Hasil Pelatihan</a>
            <?php } ?>
        </div>
    </div>
</li>
<hr class="sidebar-divider d-none d-md-block">
<li class="nav-item active">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-book-open"></i>
        <span>Report</span>
    </a>
    <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
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
                <a class="collapse-item active" href="<?= base_url('penerima/report'); ?>">Lap. Penerima Bantuan</a>
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
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span></a>
</li>

<?= $this->endSection(); ?>

<?= $this->section('isi'); ?>

<div class="container-fluid">
    <div class="alert alert-info" role="alert">
        Laporan Data Penerima Bantuan
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Laporan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Laporan data penerima bantuan</td>
                            <td style="text-align: center;">
                                <a class="btn btn-sm btn-info mb-1" href="<?= base_url('penerima/cetaksemua'); ?>" target="__blank">Cetak</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Laporan data penerima bantuan berdasarkan <strong>Bantuan</strong></td>
                            <td style="text-align: center;">
                                <a class="btn btn-sm btn-info mb-1" data-toggle="modal" data-target="#cariBantuan">Pilih</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<form action="<?= base_url('penerima/cetakbantuan'); ?>" method="POST" target="__blank">
    <div class="modal" tabindex="-1" id="cariBantuan">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Bantuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label>Nama bantuan</label>
                                <div class="form-group">
                                    <select name="bantuan" required id="bantuan" class="form-control">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="button" data-dismiss="modal">Close</button>
                    <button type="submit" id="cetakbantuan" class="btn btn-primary disabled">Cetak</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    function getDataBantuan() {
        $('#bantuan').select2({
            width: '100%',
            dropdownParent: "#cariBantuan",
            minimumInputLength: 1,
            allowClear: false,
            placeholder: 'Cari bantuan',
            ajax: {
                url: "<?= base_url('penerima/bantuan'); ?>",
                type: 'GET',
                dataType: 'json',
                delay: 500,
                data: function(params) {
                    return {
                        search: params.term
                    }
                },
                processResults: function(data, page) {
                    return {
                        results: data
                    }
                },
                error: function(err) {
                    console.log(err)
                },
                cache: true
            }
        });
    }

    $('#bantuan').change(function(e) {
        $("#cetakbantuan").removeClass('disabled');
    });

    $(document).ready(function() {
        getDataBantuan();
    });
</script>

<?= $this->endSection(); ?>