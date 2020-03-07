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
                    <h3 class="block-title">Tabela de Recusa período <kbd>{{ date("d/m/Y", strtotime($saida["dtinicial"])) }}</kbd> à <kbd>{{date('d/m/Y', strtotime($saida['dtfinal'])) }}</kbd></h3>
                </div>

                <div class="col-lg-8">
                    <!-- Form Inline - Default Style -->
                    <form class="form-inline mb-4" action="{{  url('/backoffice/index/resultRecusa/') }}" method="POST">
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
                    <a href="{{ url('/backoffice/index/backofficeRecusaExport/'.date("Y-m-d", strtotime($saida["dtinicial"])) .'/'.date('Y-m-d', strtotime($saida['dtfinal']))) }}"> <button class="btn btn-success" value="Excel" id="export" name="export"><span class="fa fa-download"></span> &ensp;Excel</button></a>
                    <!-- input datepicker -->
                </div>

                <div class="block-content block-content-full">
                    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped js-dataTable-full-pagination">
                            <thead>
                            <tr>
                                <th class="text-center" >X</th>
                                <th class="text-center" >Operador</th>
                                <th class="text-center" >Aspect</th>
                                <th>Data</th>
                                <th class="d-none d-sm-table-cell" >Supervisor</th>
                                <th class="d-none d-sm-table-cell" >CPF</th>
                                <th>Valor de Risco</th>
                                <th>Fila</th>
                                <th>Taxa Antiga</th>
                                <th>Taxa Nova</th>
                                <th>Produto Novo</th>
                                <th>Produto Antigo</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse( $desfavoravel as $acordo)
                                <tr>
                                    <td class="text-center font-size-sm">
                                        {{ $acordo->usuariox }}
                                    </td>
                                    <td class="text-center font-size-sm">
                                        {{ $acordo->nomeoperador }}
                                    </td>
                                    <td class="text-center font-size-sm">
                                        {{ $acordo->aspect }}
                                    </td>
                                    <td class="font-w600 font-size-sm">
                                        {{ date('d/m/Y', strtotime($acordo->datareg)) }}
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        {{ $acordo->supervisor }}
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        {{ str_replace("-","",str_replace(".","",'F0'.$acordo->cpf)) }}
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        <span class="badge badge-primary">
                                            {{ number_format(($acordo->valor / 100), 2,',','.') }}
                                        </span>
                                    </td>
                                    <td>
                                    <span class="badge badge-primary">
                                        {{ $acordo->fila }}
                                    </span>
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        {{ $acordo->taxaantiga }}
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        {{ $acordo->taxanova }}
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        {{ $acordo->produtonovo }}
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        {{ $acordo->produtoantigo }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td style="font-size: 8pt" colspan="5" > Sem dados! </td>
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

@endsection

