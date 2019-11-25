<div class="main-navbar">
    <nav class="navbar align-items-stretch navbar-light bg-white flex-md-nowrap border-bottom p-0">
        <a class="navbar-brand w-100 mr-0" href="<?= base_url(); ?>home">
            <div class="d-table m-auto">
                <div class="d-table m-auto">
                    <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 35px;"
                        src="<?= base_url(); ?>assets/image/logo.png" alt="">
                    <img id="main-logo" class="d-none d-md-inline" src="<?= base_url(); ?>assets/image/app/se.png"
                        alt="">
                </div>
            </div>
        </a>
        <a class="toggle-sidebar d-sm-inline d-md-none d-lg-none">
            <i class="material-icons">&#xE5C4;</i>
        </a>
    </nav>

</div>
<form action="#" class="main-sidebar__search w-100 border-right d-sm-flex d-md-none d-lg-none">
    <div class="input-group input-group-seamless ml-3">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="fas fa-search"></i>
            </div>
        </div>
        <input class="navbar-search form-control" type="text" placeholder="Search for something..." aria-label="Search">
    </div>
</form>
<div class="nav-wrapper">
    <?php $this->load->view('core/layout/side'); ?>
</div>