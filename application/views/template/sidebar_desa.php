<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('desa'); ?>">
            <div class="sidebar-brand-icon">
                <img style="max-width: 80%;" src="<?= base_url('assets/img/logo.png'); ?>">
            </div>
            <div class="sidebar-brand-text mx-3">Tasnanta</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('desa/tampil_survey'); ?>">
                <i class="fas fa-fw fa-solid fa-folder"></i>
                <span>Data Destinasi Wisata</span></a>
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

                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter" id="count-notif"><?= $tot_notif; ?></span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" id="notifikasi">
                            <h6 class="dropdown-header">
                                Notifikasi
                            </h6>
                            <div id="notif-data"><span class="font-weight-bold">Memuat data...</span></div>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?= $user['username']; ?></span>
                            <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['foto']; ?>">
                        </a>

                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?= base_url('desa/profile'); ?>">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('desa/ubah_password'); ?>">
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

            <script type="text/javascript">
                $(document).ready(function() {
                    count_notif(); //call function get notif

                    //function get notif
                    function count_notif() {
                        $.ajax({
                            type: 'ajax',
                            url: '<?php echo site_url('desa/getCountUserNotifUnread/' . $user['id_user']) ?>',
                            async: true,
                            dataType: 'json',
                            success: function(data) {
                                document.getElementById("count-notif").innerHTML = data;
                            }

                        });

                        $.ajax({
                            type: 'ajax',
                            url: '<?php echo site_url('desa/getUserNotif/' . $user['id_user']) ?>',
                            async: true,
                            dataType: 'json',
                            success: function(data) {

                                console.log(data);
                                var html = '';
                                var i;
                                for (i = 0; i < data.length; i++) {
                                    html +=
                                        '<a class="dropdown-item d-flex align-items-center ' + (data[i]
                                            .is_read == 0 ? 'bg-secondary' : 'bg-light') +
                                        '" href="#">' +
                                        '<div class="mr-3">' +
                                        '<div class="icon-circle bg-primary">' +
                                        '<i class="fas fa-file-alt text-white"></i>' +
                                        '</div></div>' +
                                        '<div><div class="small text-gray-500">' + data[i].created_at +
                                        '</div><span class="font-weight-bold">' + data[i].description +
                                        '</span></div></a>';
                                }
                                document.getElementById("notif-data").innerHTML = html;
                            }

                        });
                    }

                    $('#alertsDropdown').on('click', function() {
                        $.ajax({
                            type: 'ajax',
                            url: '<?php echo site_url('desa/readAllNotif/' . $user['id_user']) ?>',
                            async: true,
                            dataType: 'json'

                        });
                    });

                    $('#notifikasi').parent().on('hidden.bs.dropdown', function() {
                        count_notif();
                    });
                });
            </script>