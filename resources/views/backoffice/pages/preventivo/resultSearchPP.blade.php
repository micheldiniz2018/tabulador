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
                    <h3 class="block-title">Tabela de pp período <kbd>{{ date("d/m/Y", strtotime($saida["dtinicial"])) }}</kbd> à <kbd>{{date('d/m/Y', strtotime($saida['dtfinal'])) }}</kbd></h3>
                </div>

                <div class="col-lg-8">
                    <!-- Form Inline - Default Style -->
                    <form class="form-inline mb-4" action="{{  url('/backoffice/index/resultPP/') }}" method="POST">
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
                    <a href="{{ url('/backoffice/index/backofficePPExport/'. date("Y-m-d", strtotime($saida["dtinicial"]))) .'/'.date('Y-m-d', strtotime($saida['dtfinal'])) }}"> <button class="btn btn-success" value="Excel" id="export" name="export"><span class="fa fa-download"></span> &ensp;Excel</button></a>
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
                                <th>Valor</th>
                                <th>Fila</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse( $pp as $acordo)
                                <tr class="linha{{$acordo->id_acordo_fk}}">
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
