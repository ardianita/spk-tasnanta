<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dinas'); ?>">
            <div class="sidebar-brand-icon">
                <img style="max-width: 80%;" src="<?= base_url('assets/img/logo.png'); ?>">
            </div>
            <div class="sidebar-brand-text mx-3">Tasnanta</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Master Data</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?= base_url('dinas/pengguna/dinas'); ?>">Data Pengguna Dinas</a>
                    <a class="collapse-item" href="<?= base_url('dinas/pengguna/desa'); ?>">Data Pengguna Desa</a>
                    <a class="collapse-item" href="<?= base_url('kriteria'); ?>">Data Kriteria</a>
                    <a class="collapse-item" href="<?= base_url('kriteria/tampil_subkriteria'); ?>">Data Subkriteria</a>
                </div>
            </div>
        </li>

        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dinas/tampil_destinasi'); ?>">
                <i class="fas fa-fw fa-solid fa-folder"></i>
                <span>Data Destinasi Wisata</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dinas/tampil_validasi'); ?>">
                <i class="fas fa-fw fa-check"></i>
                <span>Validasi</span></a>
        </li>

        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dinas/pemeringkatan') ?>">
                <i class="fas fa-fw fa-solid fa-trophy"></i>
                <span>Pemeringkatan</span></a>
        </li>

        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-landmark"></i>
                <span>Pembangunan</span>
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?= base_url('dinas/tampil_pembangunan1') ?>">Sedang Dibangun</a>
                    <a class="collapse-item" href="<?= base_url('dinas/tampil_pembangunan2'); ?>">Telah Dibangun</a>
                </div>
            </div>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?= $admin['username']; ?></span>
                            <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $admin['foto']; ?>">
                        </a>

                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?= base_url('dinas/profil'); ?>">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('dinas/ubah_password'); ?>">
                                <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                Ubah Password
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                    </li>
                </ul>
            </nav>
            <!-- End of Topbar -->

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>Apakah Anda Yakin Ingin Keluar?</h5>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
                        </div>
                    </div>
                </div>
            </div>