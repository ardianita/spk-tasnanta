<body class="bg-login-registrasi">
    <img style="max-width: 8%; padding: 10px;" src="<?= base_url('assets/img/logo.png'); ?>">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><strong>Aplikasi Prioritas Pembangunan Pariwisata Selingkar Wilis</strong></h1>
                                    </div>
                                    <?= $this->session->flashdata('pesan') ?>
                                    <form method="POST" action="<?= base_url('auth') ?>">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" placeholder="Email" value="<?= set_value('email'); ?>">
                                            <?= form_error('email', '<div class="text-danger small">', '</div>') ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control" placeholder="Password">
                                            <?= form_error('password', '<div class="text-danger small">', '</div>') ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Login
                                        </button>
                                        <hr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>