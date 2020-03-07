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
                    <h3 class="block-title">Tabela de acordos período <kbd>{{ date('d/m/Y') }}</kbd> à <kbd>{{ date('d/m/Y') }}</kbd></h3>
                </div>

                <div class="col-lg-8">
                    <!-- Form Inline - Default Style -->
                    <form class="form-inline mb-4" action="{{  url('/backoffice/index/preventivoSearch/') }}" method="POST">
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
                    <a href="{{ url('/backoffice/index/preventivoExport/'.date("Y-m-d") .'/'.date('Y-m-d')) }}"> <button class="btn btn-success" value="Excel" id="export" name="export"><span class="fa fa-download"></span> &ensp;Excel</button></a>
                    <!-- input datepicker -->
                </div>

                <div class="block-content block-content-full">
                    <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped js-dataTable-full-pagination">
                            <thead>
                            <tr>
                                <th class="text-center" >X</th>
                                <th>Data</th>
                                <th class="d-none d-sm-table-cell" >Supervisor</th>
                                <th class="d-none d-sm-table-cell" >Contrato</th>
                                <th class="d-none d-sm-table-cell" >CPF</th>
                                <th class="d-none d-sm-table-cell" >Status</th>
                                <th>Tipo Negociação</th>
                                <th>Fila</th>
                                <th>Campanha</th>
                                <th>Taxa Nova</th>
                                <th>Taxa Antiga</th>
                                <th>Código</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Valor Divida</th>
                                <th style="width: 15%;">Valor Financiado</th>
                                <th style="width: 15%;">Atualizar</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse( $acordos as $acordo)
                                <tr class="linha{{$acordo->id_acordo_fk}}" @if($acordo->status === 0 || $acordo->status === null)
                                style="background-color: #FA8072;"
                                    @else
                                    style="background-color: #98FB98"
                                        @endif>
                                    <td class="text-center font-size-sm">
                                        {{ $acordo->usuariox }}
                                    </td>
                                    <td class="font-w600 font-size-sm">
                                        {{ date('d/m/Y', strtotime($acordo->datareg)) }}
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        {{ $acordo->supervisor }}
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        {{ $acordo->contrato }}
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        {{ str_replace("-","",str_replace(".","",'F0'.$acordo->cpf)) }}
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        <select  name="status{{ $acordo->id_acordo_fk }}" id="status{{ $acordo->id_acordo_fk }}" class="form-control bg">
                                            <optgroup label="Status">
                                                @forelse($saida['AllStatus']  as $seg)
                                                    <option value="{{  $seg->id }}">{{  $seg->status }}</option>
                                                @empty
                                                    <kbd>SEM STATUS REGISTRADOS!</kbd>
                                                @endforelse
                                            </optgroup>
                                        </select>
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        <select name="negociacao{{ $acordo->id_acordo_fk }}" id="negociacao{{ $acordo->id_acordo_fk }}" class="form-control bg">
                                            <optgroup label="Negociações">
                                                @forelse($saida['negociacao']  as $seg)
                                                    <option value="{{  $seg->id }}">{{  $seg->negociacao }}</option>
                                                @empty
                                                    <kbd>SEM REGISTRADOS!</kbd>
                                                @endforelse
                                            </optgroup>
                                        </select>
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        <select name="fila{{ $acordo->id_acordo_fk }}" id="fila{{ $acordo->id_acordo_fk }}" class="form-control bg">
                                            <optgroup label="Filas">
                                                @forelse($saida['fila']  as $seg)
                                                    <option value="{{  $seg->id }}">{{  $seg->fila }}</option>
                                                @empty
                                                    <kbd>SEM REGISTRADOS!</kbd>
                                                @endforelse
                                            </optgroup>
                                        </select>
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        <select name="campanha{{ $acordo->id_acordo_fk }}" id="campanha{{ $acordo->id_acordo_fk }}" class="form-control bg">
                                            <optgroup label="Campanhas">
                                                @forelse($saida['campanha']  as $seg)
                                                    <option value="{{  $seg->id }}">{{  $seg->campanha }}</option>
                                                @empty
                                                    <kbd>SEM REGISTRADOS!</kbd>
                                                @endforelse
                                            </optgroup>
                                        </select>
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        {{ $acordo->taxanova }}
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        {{ $acordo->taxaantiga }}
                                    </td>
                                    <td class="d-none d-sm-table-cell font-size-sm">
                                        <select name="codigo{{ $acordo->id_acordo_fk }}" id="codigo{{ $acordo->id_acordo_fk }}" class="form-control bg">
                                            <optgroup label="Códigos">
                                                @forelse($saida['codigo']  as $seg)
                                                    <option value="{{  $seg->id }}">{{  $seg->codigo }}</option>
                                                @empty
                                                    <kbd>SEM REGISTRADOS!</kbd>
                                                @endforelse
                                            </optgroup>
                                        </select>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                <span class="badge badge-primary">
                                    {{ number_format(($acordo->valor / 100), 2,',','.') }}
                                </span>
                                    </td>
                                    <td>
                                    <span class="badge badge-primary">
                                        {{ number_format(($acordo->valor_financiado / 100), 2,',','.') }}
                                    </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-primary" id="atualizar{{ $acordo->id_acordo_fk }}"
                                                    @if($acordo->status != 0)
                                                    disabled
                                                    @endif
                                                    onclick=" criarProduto({{ $acordo->id_acordo_fk }})" data-toggle="tooltip" title="Editar">
                                                @if($acordo->status === 0)
                                                    <span class="fa fa-fw fa-pencil-alt"></span>
                                                @else
                                                    <span class="font-weight-normal">Atualizado!</span>
                                                @endif
                                            </button>
                                        </div>
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

    <script>

        function criarProduto(id)
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            dados = [
                $('#status'+id+' option:selected').val(),
                $('#negociacao'+id+' option:selected').val(),
                $('#fila'+id+' option:selected').val(),
                $('#campanha'+id+' option:selected').val(),
                $("#codigo"+id).val(),
                id
            ];

            $('#atualizar'+dados[5]).text('Aguarde..').prop('disabled', true).attr('disabled','disabled');

            $.ajax({
                method: 'post',
                url: "{{ url('/backoffice/index/atualizarAcordo') }}",
                data: {
                    id : dados[5],
                    status : dados[0],
                    negociacao : dados[1],
                    fila : dados[2],
                    campanha : dados[3],
                    codigo : dados[4],

                },
                success: function(data)
                {
                    if(data === 'acordo')
                    {
                        alert('Registro não encontrado!');
                        window.setTimeout( showSubmit(dados[5]) , 3000 );
                    }
                    if(data === 'status') {
                        alert('Não foi possivel atualizar o status!');
                        window.setTimeout( showSubmit(dados[5]) , 3000 );
                    }
                    if(data === 'ok')
                    {
                        $('#atualizar' + dados[5]).text('Atualizado!').prop('disabled', true).attr('enable', 'enable');
                        $(".linha" + dados[5]).css("background", "#98FB98");
                    }

                },
                error: function(error) {
                    console.log(error);
                }
            });

        }

        function showSubmit(dadosA) {
            $('#atualizar'+dadosA).text('').prop('disabled', false).attr('enable','enable').append('<span class="fa fa-fw fa-pencil-alt"></span>')
        }

    </script>

@endsection
