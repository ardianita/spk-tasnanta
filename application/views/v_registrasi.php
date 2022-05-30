<body class="bg-login-registrasi">
    <img style="max-width: 8%; padding: 10px;" src="<?= base_url('assets/img/logo.png'); ?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card o-hidden border-0 shadow-lg my-4">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><strong>Aplikasi Prioritas Pembangunan Pariwisata Selingkar Wilis</strong></h1>
                                    </div>
                                    <form method="POST" action="<?= base_url('auth/registrasi') ?>">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" value="<?= set_value('email') ?>">
                                            <?= form_error('email', '<div class="text-danger small">', '</div>') ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input type="text" class="form-control" name="username" value="<?= set_value('username') ?>">
                                            <?= form_error('username', '<div class="text-danger small">', '</div>') ?>
                                        </div>
                                        <div class="form-group">
                                            <label><?= $argument == 'desa' ? "Nama Desa" : "Nama Lengkap" ?></label>
                                            <input type="text" class="form-control" name="name" value="<?= set_value('name') ?>">
                                            <?= form_error('name', '<div class="text-danger small">', '</div>') ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password">
                                            <?= form_error('password', '<div class="text-danger small">', '</div>') ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor Telepon</label>
                                            <input type="text" class="form-control" name="telp" value="<?= set_value('telp') ?>">
                                            <?= form_error('telp', '<div class="text-danger small">', '</div>') ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary form-control">Registrasi</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('auth') ?>">Sudah Punya Akun? <strong>Login!</strong></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>