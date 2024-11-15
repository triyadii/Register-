<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url() ?>Dashboard">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url() ?>Event">
                <i class="bi bi-calendar2-event"></i>
                <span>Event</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#component-user" data-bs-toggle="collapse" href="#">
                <i class="bi bi-person-check"></i>
                <span>User</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="component-user" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url() ?>UserAdmin">
                        <i class="bi bi-circle"></i><span>Admin</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>UserOperator">
                        <i class="bi bi-circle"></i><span>Operator</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>UserPeserta">
                        <i class="bi bi-circle"></i><span>Peserta</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#component-hakAkses" data-bs-toggle="collapse" href="#">
                <i class="bi bi-person-check"></i>
                <span>Hak Akses</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="component-hakAkses" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= base_url() ?>HakAksesAdmin">
                        <i class="bi bi-circle"></i><span>Admin</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>HakAksesOperator">
                        <i class="bi bi-circle"></i><span>Operator</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url() ?>HakAksesPeserta">
                        <i class="bi bi-circle"></i><span>Peserta</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
<!-- End Sidebar-->