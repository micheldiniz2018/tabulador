<!-- Header -->
<header id="page-header">
    <!-- Header Content -->
    <div class="content-header">
        <!-- Left Section -->
        <div class="d-flex align-items-center">
            <!-- Toggle Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
            <button type="button" class="btn btn-sm btn-dual mr-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <!-- END Toggle Sidebar -->

            <!-- Toggle Mini Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
            <button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
                <i class="fa fa-fw fa-ellipsis-v"></i>
            </button>
            <!-- END Toggle Mini Sidebar -->



        </div>
        <!-- END Left Section -->

        <!-- Right Section -->
        <div class="d-flex align-items-center">
            <!-- User Dropdown -->
            <div class="dropdown d-inline-block ml-2">
                <button type="button" class="btn btn-sm btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded" src="{{ asset('assets/media/avatars/avatar10.jpg')}}" alt="Header Avatar" style="width: 18px;">
                    <span class="d-none d-sm-inline-block ml-1">{{\Illuminate\Support\Facades\Auth::user()->getName()}}</span>
                    <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-user-dropdown">
                    <div class="p-3 text-center bg-primary">
                        <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{asset('assets/media/avatars/avatar10.jpg')}}" alt="">
                    </div>
                    <div class="p-2">
                        <h5 class="dropdown-header text-uppercase">Opções de usuário</h5>
                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            <span>Configurações</span>
                            <i class="si si-settings"></i>
                        </a>
                        <div role="separator" class="dropdown-divider"></div>
                        <h5 class="dropdown-header text-uppercase">Ações</h5>
                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('logout')}}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <span>Sair</span>
                            <i class="si si-logout ml-1"></i>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf

                            </form>
                        </a>
                    </div>
                </div>
            </div>
            <!-- END User Dropdown -->
        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->

</header>
