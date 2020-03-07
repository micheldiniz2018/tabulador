@extends('operator.varejo.index')
@section('contentbody')
<!-- Main Container -->
<main id="main-container">

<!-- Hero -->
<div class="bg-image overflow-hidden" style="background-image: url('assets/media/photos/photo3@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-narrow content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center mt-5 mb-2 text-center text-sm-left">
                <div class="flex-sm-fill">
                    <h1 class="font-w600 text-white mb-0 invisible" data-toggle="appear">CALL CENTER PREVENTIVO</h1>
                    <h2 class="h4 font-w400 text-white-75 mb-0 invisible" data-toggle="appear" data-timeout="250">Bem Vindo!
                    {{ \Illuminate\Support\Facades\Auth::user()->getName()}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->
<!-- Page Content -->
<div class="content content-narrow">
    <!-- Stats -->
    <div class="row">
        <div class="col-6 col-md-3 col-lg-6 col-xl-3">
            <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Quantidade  de acordos neste mês</div>
                    <div class="font-size-h2 font-w400 text-dark">{{ $acordos[1] }}</div>
                </div>
                <br>
            </a>
        </div>
        <div class="col-6 col-md-3 col-lg-6 col-xl-3">
            <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Quantidade de PP neste mês</div>
                    <div class="font-size-h2 font-w400 text-dark">{{ $acordos[2] }}</div>
                </div>
                <br>
            </a>
        </div>
        <div class="col-6 col-md-3 col-lg-6 col-xl-3">
            <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="font-size-sm font-w600 text-uppercase text-muted"> Quantidade de desfavorável neste mês</div>
                    <div class="font-size-h2 font-w400 text-dark">{{ $acordos[4] }}</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3 col-lg-6 col-xl-3">
            <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Quantidade de recusa neste mês</div>
                    <div class="font-size-h2 font-w400 text-dark">{{ $acordos[3] }}</div>
                </div>
                <br>
            </a>
        </div>
    </div>
    <!-- END Stats -->

    <!-- TABLE SELS -->

    <!-- Dynamic Table Full Pagination -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Tabela de acordos Deste Mês</h3>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">X</th>
                    <th>Data</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Supervisor</th>
                    <th class="d-none d-sm-table-cell" style="width: 30%;">Contrato</th>
                    <th class="d-none d-sm-table-cell" style="width: 15%;">Valor Divida</th>
                    <th style="width: 15%;">Valor Financiado</th>
                </tr>
                </thead>
                <tbody>

                @forelse( $acordos[0] as $acordo)
                    <tr>
                        <td class="text-center font-size-sm">
                            {{$acordo->usuariox }}
                        </td>
                        <td class="font-w600 font-size-sm">
                            {{ date('d/m/Y', strtotime($acordo->datareg)) }}
                        </td>
                        <td class="d-none d-sm-table-cell font-size-sm">
                            {{$acordo->supervisor }}
                        </td>
                        <td class="d-none d-sm-table-cell font-size-sm">
                            {{$acordo->contrato	 }}
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <span class="badge badge-primary">
                                {{number_format(($acordo->valor / 100), 2,',','.') }}
                            </span>
                        </td>
                        <td>
                            <em class="text-muted font-size-sm">
                                {{number_format(($acordo->valor_financiado / 100), 2,',','.') }}
                            </em>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="5"> Sem dados! </td>
                    </tr>

                 @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full Pagination -->

    <!-- END TABLE SELS -->

    <!-- END Customers and Latest Orders -->
</div>
<!-- END Page Content -->

</main>
<!-- footer -->
@include('operator.varejo.content.footer')

<!-- Apps Modal -->
<!-- Opens from the modal toggle button in the header -->
<div class="modal fade" id="one-modal-apps" tabindex="-1" role="dialog" aria-labelledby="one-modal-apps" aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-sm" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Apps</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="row gutters-tiny">
                        <div class="col-6">
                            <!-- CRM -->
                            <a class="block block-rounded block-themed bg-default" href="javascript:void(0)">
                                <div class="block-content text-center">
                                    <i class="si si-speedometer fa-2x text-white-75"></i>
                                    <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                        CRM
                                    </p>
                                </div>
                            </a>
                            <!-- END CRM -->
                        </div>
                        <div class="col-6">
                            <!-- Products -->
                            <a class="block block-rounded block-themed bg-danger" href="javascript:void(0)">
                                <div class="block-content text-center">
                                    <i class="si si-rocket fa-2x text-white-75"></i>
                                    <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                        Products
                                    </p>
                                </div>
                            </a>
                            <!-- END Products -->
                        </div>
                        <div class="col-6">
                            <!-- Sales -->
                            <a class="block block-rounded block-themed bg-success mb-0" href="javascript:void(0)">
                                <div class="block-content text-center">
                                    <i class="si si-plane fa-2x text-white-75"></i>
                                    <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                        Sales
                                    </p>
                                </div>
                            </a>
                            <!-- END Sales -->
                        </div>
                        <div class="col-6">
                            <!-- Payments -->
                            <a class="block block-rounded block-themed bg-warning mb-0" href="javascript:void(0)">
                                <div class="block-content text-center">
                                    <i class="si si-wallet fa-2x text-white-75"></i>
                                    <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                        Payments
                                    </p>
                                </div>
                            </a>
                            <!-- END Payments -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
