<nav id="sidebar" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header bg-white-5">
        <!-- Logo -->
        <a class="font-w600 text-dual" href="{{ url('/home')  }}">
            <i class="fa fa-user text-primary"></i>
            <span class="smini-hide">
                            <span class="font-w700 font-size-h5">MD</span> <span class="font-w400">3.0</span>
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
            <a class="nav-main-link active" href="{{ url('/home') }}">
                <i class="nav-main-link-icon si si-home"></i>
                <span class="nav-main-link-name">Início</span>
            </a>
        </li>
        <li class="nav-main-heading">Interface Back Office</li>
        <li class="nav-main-item">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                <i class="nav-main-link-icon si si-directions"></i>
                <span class="nav-main-link-name">Ilhas</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ url('backoffice/index/preventivo') }}">
                        <span class="nav-main-link-name">Preventivo</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="javascript:void(0)">
                        <span class="nav-main-link-name">Adimplente</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="javascript:void(0)">
                        <span class="nav-main-link-name">Imobiliário</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="javascript:void(0)">
                        <span class="nav-main-link-name">Oferta Acordo</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="javascript:void(0)">
                        <span class="nav-main-link-name"> Consignado </span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="javascript:void(0)">
                        <span class="nav-main-link-name">Prospera</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-main-item">
            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="javascript:void(0)">
                <i class="nav-main-link-icon si si-magnifier"></i>
                <span class="nav-main-link-name">Buscar</span>
            </a>
            <ul class="nav-main-submenu">
                <li class="nav-main-item">
                    <a class="nav-main-link" href="{{ url('backoffice/index/findBackOfficeAcords')  }}">
                        <span class="nav-main-link-name">Acordo Editados</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="javascript:void(0)">
                        <span class="nav-main-link-name">PP</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="javascript:void(0)">
                        <span class="nav-main-link-name">Desfavorável</span>
                    </a>
                </li>
                <li class="nav-main-item">
                    <a class="nav-main-link" href="javascript:void(0)">
                        <span class="nav-main-link-name">Recusa</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
<!-- END Side Navigation -->
</nav>
