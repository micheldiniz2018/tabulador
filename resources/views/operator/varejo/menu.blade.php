    <nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header bg-white-5">
        <!-- Logo -->
        <a class="font-w600 text-dual" href="{{ redirect('/home') }}">
            <i class="fa fa-user text-primary"></i>
            <span class="smini-hide">
                            <span class="font-w700 font-size-h5">TABULADOR</span></span>
            </span>
        </a>
        <!-- END Logo -->

        <!-- Options -->
        <div>
            <!-- Close Sidebar, Visible only on mobile screens -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <a class="d-lg-none text-dual ml-3" data-toggle="layout" data-action="sidebar_close" href="javascript:void(0)">
                <i class="fa fa-times"></i>
            </a>
            <!-- END Close Sidebar -->
        </div>
        <!-- END Options -->
    </div>
    <!-- END Side Header -->

    <!-- Side Navigation -->
<div class="content-side content-side-full">
    <ul class="nav-main">
        <li class="nav-main-item">
            <a class="nav-main-link active" href="{{ redirect('/home') }}">
                <i class="nav-main-link-icon si si-home"></i>
                <span class="nav-main-link-name">Início</span>
            </a>
        </li>
        <li class="nav-main-heading">Interface Agente</li>
        <li class="nav-main-item">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                <i class="nav-main-link-icon si si-pencil"></i>
                <span class="nav-main-link-name">Tabulação</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    <a class="nav-main-link" href="be_blocks_styles.html">
                        <span class="nav-main-link-name">Acordo</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="be_blocks_options.html">
                        <span class="nav-main-link-name">PP</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="be_blocks_forms.html">
                        <span class="nav-main-link-name">Desfavorável</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="be_blocks_themed.html">
                        <span class="nav-main-link-name">Recusa</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-main-item">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                <i class="nav-main-link-icon si si-magnifier"></i>
                <span class="nav-main-link-name">Buscar</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    <a class="nav-main-link" href="be_ui_grid.html">
                        <span class="nav-main-link-name">Acordo</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="be_ui_typography.html">
                        <span class="nav-main-link-name">PP</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="be_ui_icons.html">
                        <span class="nav-main-link-name">Desfavorável</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="be_ui_buttons.html">
                        <span class="nav-main-link-name">Recusa</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
<!-- END Side Navigation -->
</nav>
