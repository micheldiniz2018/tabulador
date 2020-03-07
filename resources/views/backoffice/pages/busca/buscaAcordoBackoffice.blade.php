@extends('backoffice.index.index')
@section('contentbody')
    <!-- Main Container -->
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-image overflow-hidden" style="background-image: url( {{ asset('assets/media/photos/photo3@2x.jpg') }} );">
            <div class="bg-primary-dark-op">
                <div class="content content-narrow content-full">
                    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center mt-5 mb-2 text-center text-sm-left">
                        <div class="flex-sm-fill">
                            <h1 class="font-w600 text-white mb-0 invisible" data-toggle="appear">CALL CENTER - BACK OFFICE - PREVENTIVO</h1>
                            <h2 class="h4 font-w400 text-white-75 mb-0 invisible" data-toggle="appear" data-timeout="250">Bem Vindo!<br>
                                {{ \Illuminate\Support\Facades\Auth::user()->getName() }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Hero -->
        <!-- Page Content -->
        <div class="content content-narrow">

            <!-- Dynamic Table Full Pagination -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Tabela de acordos atualizados pelo Back Office <kbd>{{ date('01/m/Y') }}</kbd> à <kbd>{{ date('t/m/Y') }}</kbd></h3>
                </div>

                <div class="col-lg-8">
                    <!-- Form Inline - Default Style -->
                    <form class="form-inline mb-4" action="{{  url('/backoffice/index/resultBackOfficeAcords/') }}" method="POST">
                        @csrf
                        <label class="sr-only" for="dtinical">Data Inicial</label>
                        <input type="date" class="form-control mb-2 mr-sm-2 mb-sm-0" id="dtinical" name="dtinical" placeholder="dd/mm/aaaa">
                        <label class="sr-only" for="dtfinal">Data Final</label>
                        <input type="date" class="form-control mb-2 mr-sm-2 mb-sm-0" id="dtfinal" name="dtfinal" placeholder="dd/mm/aaaas">
                        <button type="submit" class="btn btn-primary">Buscar</button>

                        @if ($errors->any())
                            <div class="block-content">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissable" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <p class="mb-0">{{ $error }} !</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    </form>
                    <!-- END Form Inline - Alternative Style -->
                    <!-- export excel -->
                    <a href="/backoffice/index/backofficeAcordoExport/{{ date("Y-08-01")}}/{{date('Y-08-t') }}"> <button class="btn btn-success" value="Excel" id="export" name="export"><span class="fa fa-download"></span> &ensp;Excel</button></a>
                    <!-- input datepicker -->
                </div>

                <div class="block-content block-content-full">
                    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped js-dataTable-full-pagination">
                            <thead>
                            <tr>
                                <th class="text-center" >Valor Dívida</th>
                                <th>Valor Financiado</th>
                                <th class="d-none d-sm-table-cell" >Status</th>
                                <th class="d-none d-sm-table-cell" >Usuário X</th>
                                <th class="d-none d-sm-table-cell" >Data Vencimento</th>
                                <th class="d-none d-sm-table-cell" >Data Acordo</th>
                                <th>Taxa Nova</th>
                                <th>Taxa Antiga</th>
                                <th>Contrato</th>
                                <th>Código</th>
                                <th>Nome BKO</th>
                                <th>Aspect BKO</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Tipo Negociação</th>
                                <th style="width: 15%;">Campanha</th>
                                <th style="width: 15%;">Fila</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse( $registros as $acordo)
                                <tr>
                                    <td class="text-center font-size-sm">
                                        {{ number_format(($acordo->valor ), 2,',','.') }}
                                    </td>
                                    <td class="font-w600 font-size-sm">
                                        {{ number_format(($acordo->valor_tfc ), 2,',','.') }}
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        {{ $acordo->status }}
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        {{ $acordo->usuario_x }}
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        {{ date('d/m/Y', strtotime($acordo->dt_vencimento)) }}
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        {{ date('d/m/Y', strtotime($acordo->data)) }}
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        {{ $acordo->tx_nova }}
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        {{ $acordo->tx_antiga }}
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        {{ $acordo->contrato }}
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        {{ $acordo->codigo }}
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        {{ $acordo->backoffice_name }}
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        {{ $acordo->backoffice_aspect }}
                                    </td>
                                    <td>
                                        {{ $acordo->negociacao }}
                                    </td>
                                    <td>
                                        {{ $acordo->campanha }}
                                    </td>
                                    <td>
                                        {{ $acordo->fila }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td style="font-size: 8pt" colspan="5"> Sem dados! </td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- END Dynamic Table Full Pagination -->

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
                                <a class="block block-rounded block-themed bg-default" href="javascript:void(0)">
                                    <div class="block-content text-center">
                                        <i class="si si-speedometer fa-2x text-white-75"></i>
                                        <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                            CRM
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6">
                                <a class="block block-rounded block-themed bg-danger" href="javascript:void(0)">
                                    <div class="block-content text-center">
                                        <i class="si si-rocket fa-2x text-white-75"></i>
                                        <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                            Products
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-6">
                                <a class="block block-rounded block-themed bg-success mb-0" href="javascript:void(0)">
                                    <div class="block-content text-center">
                                        <i class="si si-plane fa-2x text-white-75"></i>
                                        <p class="font-w600 font-size-sm text-white mt-2 mb-3">
                                            Sales
                                        </p>
                                    </div>
                                </a>
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
