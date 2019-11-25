<ul class="navbar-nav border-left flex-row ml-auto">
    <li class="nav-item border-right dropdown notifications">
        <a class="nav-link nav-link-icon text-center" href="#" role="button" id="dropdownMenuLink"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="nav-link-icon__wrapper">
                <i class="material-icons">&#xE7F4;</i>
                <span class="badge badge-pill badge-danger">2</span>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-small" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="#">
                <div class="notification__icon-wrapper">
                    <div class="notification__icon">
                        <i class="material-icons">&#xE6E1;</i>
                    </div>
                </div>
                <div class="notification__content">
                    <span class="notification__category">Analytics</span>
                    <p>Your website’s active users count increased by
                        <span class="text-success text-semibold">28%</span> in the last week. Great job!</p>
                </div>
            </a>
            <a class="dropdown-item" href="#">
                <div class="notification__icon-wrapper">
                    <div class="notification__icon">
                        <i class="material-icons">&#xE8D1;</i>
                    </div>
                </div>
                <div class="notification__content">
                    <span class="notification__category">Sales</span>
                    <p>Last week your store’s sales count decreased by
                        <span class="text-danger text-semibold">5.52%</span>. It could have been worse!</p>
                </div>
            </a>
            <a class="dropdown-item notification__all text-center" href="#"> View all Notifications </a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-nowrap px-4" data-toggle="dropdown" href="#" role="button"
            aria-haspopup="true" aria-expanded="false">
            <?php
            if ($profile != null) { ?>
            <img class="rounded-circle mr-2" src="<?= base_url('assets/image/pns/' . $profile[0]->image); ?>"
                style="max-width: 35px;" alt="">
            <span class="d-none d-md-inline-block"><?= $profile[0]->nama; ?></span>
            <?php } else { ?>
            <i class="material-icons verified_user" style="font-size: 24px; top: 5px; color: #000;">&#xe8e8;</i>
            <span class="d-none d-md-inline-block text-black mr-auto mt-2">
                <?= $login[0]->hak; ?> </span>
            <?php } ?>
        </a>
        <div class="dropdown-menu dropdown-menu-small">
            <a class="dropdown-item" href="<?= base_url(); ?>home/profil">
                <i class="material-icons">&#xE7FD;</i> Profile</a>
            <a class="dropdown-item text-danger" href="<?= base_url(); ?>home/logout">
                <i class="material-icons text-danger">&#xE879;</i> Logout </a>
        </div>
    </li>
</ul>