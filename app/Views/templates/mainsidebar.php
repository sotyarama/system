<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?= base_url(); ?>assets/dist/img/AdminLTELogo.png" class="brand-image img-circle elevation-3" alt="AdminLTE Logo" style="opacity: .8">
        <span class="brand-text font-weight-light">SYSTEM</span>
    </a>

    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu">
            <li class="nav-item">
                <a href="<?= base_url(); ?>" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Database
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="/allbrands" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Brands</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/allvehicles" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Vehicles</p>
                        </a>
                    </li>
                </ul>

            </li>

        </ul>

    </nav>

</aside>