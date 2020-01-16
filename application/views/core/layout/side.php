<ul class="nav flex-column">
    <?php if ($this->session->userdata('sisule_cms_hak') == 'admin') { ?>
    <li class="nav-item">
        <a class="nav-link menu-instansi" href="<?= base_url(); ?>home/instansi">
            <i class="material-icons">account_balance</i>
            <span>Instansi</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link menu-karyawan" href="<?= base_url(); ?>home/karyawan">
            <i class="material-icons">account_circle</i>
            <span>Karyawan</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link menu-bidang" href="<?= base_url(); ?>home/bidang">
            <i class="material-icons">event_seat</i>
            <span>Bidang</span>
        </a>
    </li>
    <?php } ?>
    <?php if ($this->session->userdata('sisule_cms_hak') == 'superadmin') { ?>
    <li class="nav-item">
        <a class="nav-link menu-instansi" href="<?= base_url(); ?>home/instansi">
            <i class="material-icons">account_balance</i>
            <span>Instansi</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link menu-user" href="<?= base_url(); ?>home/user">
            <i class="material-icons">verified_user</i>
            <span>Pengguna Aplikasi</span>
        </a>
    </li>
    <?php } ?>
    <li class="nav-item">
        <a class="nav-link menu-surat-masuk" href="<?= base_url(); ?>home/suratmasuk">
            <i class="material-icons">email</i>
            <span>Surat Masuk</span>
        </a>
    </li>
    <?php if($this->session->userdata('sisule_cms_agendaris') == '1'){ ?>
    <li class="nav-item">
        <a class="nav-link menu-surat-keluar" href="<?= base_url(); ?>home/suratkeluar">
            <i class="material-icons">send</i>
            <span>Surat Keluar</span>
        </a>
    </li>
    <?php } ?>
    <li class="nav-item">
        <a class="nav-link menu-kalender" href="<?= base_url(); ?>home/kalender">
            <i class="material-icons">date_range</i>
            <span>Kalender</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link menu-tracking" href="<?= base_url(); ?>home/tracking">
            <i class="material-icons">explore</i>
            <span>Pelacakan Surat</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link menu-statistik" href="<?= base_url(); ?>home/statistik">
            <i class="material-icons">bar_chart</i>
            <span>Statistik Surat</span>
        </a>
    </li>
</ul>