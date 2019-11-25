<style>
.btn-custome {
    padding: 0px 5px;
}
</style>

<body>
    <header class="masthead"></header>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <?= form_open('Welcome/authentication'); ?>
                <form>
                    <span class="login100-form-title p-b-12">
                        <i class="zmdi zmdi-email text-primary" style="margin-top: -30px;"></i>
                    </span>
                    <div class="mb-3 mt-3">
                        <?= $message; ?>
                    </div>
                    <div class="wrap-input100 validate-input mt-4" data-validate="Username">
                        <input class="input100" type="text" name="username">
                        <span class="focus-input100" data-placeholder="Username" autocomplete="off"></span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100" data-placeholder="Password"></span>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <?= $captcha; ?>
                        </div>
                        <div class="col-lg-6">
                            <div class="wrap-input100 validate-input" data-validate="Enter Captcha">
                                <input class="input100" type="captcha" name="captcha">
                                <span class="focus-input100" data-placeholder="Captcha"></span>
                            </div>
                        </div>
                    </div>
                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </div>
                </form>
                <?= form_close(); ?>
                <p class="text-center mt-4  text-capitalize text-black-50" style="font-size: 14px;">
                    Buku Panduan : <a href="<?= base_url(); ?>welcome/downloadManualBook"
                        class="btn btn-sm btn-custome btn-outline-primary" target="_blank"
                        style="font-size: 12px;">Unduh</a>
                    <a href="#" class="btn btn-sm btn-custome btn-outline-dark" style="font-size: 12px;">dokumentasi</a>
                </p>
                <p class="text-center  text-capitalize text-black-50" style="font-size: 14px;">
                    Copyright &copy Kabupaten Ciamis - <?= date('Y'); ?>
                </p>

            </div>

        </div>
    </div>
