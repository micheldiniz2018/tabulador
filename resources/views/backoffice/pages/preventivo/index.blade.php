@extends('backoffice.index.index')
@section('contentbody')
    <!-- Main Container -->
    <main id="main-container">

        <!-- Hero -->
        <div class="bg-image overflow-hidden" style="background-image: url({{ asset('assets/media/photos/photo3@2x.jpg') }});">
            <div class="bg-primary-dark-op">
                <div class="content content-narrow content-full">
                    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center mt-5 mb-2 text-center text-sm-left">
                        <div class="flex-sm-fill">
                            <h1 class="font-w600 text-white mb-0 invisible" data-toggle="appear">CALL CENTER - BACK OFFICE - PREVENTIVO</h1>
                            <h2 class="h4 font-w400 text-white-75 mb-0 invisible" data-toggle="appear" data-timeout="250">Bem Vindo!<br>
                                {{ \Illuminate\Support\Facades\Auth::user()->getName() }}</h2>
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
                <div class="col-9 col-md-6 col-lg-9 col-xl-4">
                    <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="{{ url('backoffice/index/preventivoAcordo') }}">
                        <div class="block-content block-content-full">
                            <div class="font-size-sm font-w600 text-uppercase text-muted">Preventivo Acordo,  {{ $saida['DataExtenso'] }}</div>
                            <div class="font-size-h2 font-w400 text-dark">{{ $saida['getNumberPreventivo'] }}</div>
                            <div class="font-size-sm font-w300 text-uppercase text-black">QUANTIDADE - ACORDOS</div>
                        </div>
                        <br>
                    </a>
                </div>
                <div class="col-9 col-md-6 col-lg-9 col-xl-4">
                    <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="{{ url('backoffice/index/preventivoAcordo') }}">
                        <div class="block-content block-content-full">
                            <div class="font-size-sm font-w600 text-uppercase text-muted">Preventivo Acordo, {{ $saida['DataExtenso'] }}</div>
                            <div class="font-size-h2 font-w400 text-dark">R$ {{ number_format($saida['jetValorPreventivoFinanciado'] / 100,2,',','.') }}</div>
                            <div class="font-size-sm font-w300 text-uppercase text-black">VALOR - ACORDOS</div>
                        </div>
                        <br>
                    </a>
                </div>

                <!-- pp -->
                <div class="col-9 col-md-6 col-lg-9 col-xl-4">
                    <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="{{ url('backoffice/index/preventivoPP') }}">
                        <div class="block-content block-content-full">
                            <div class="font-size-sm font-w600 text-uppercase text-muted">Preventivo PP, {{ $saida['DataExtenso'] }}</div>
                            <div class="font-size-h2 font-w400 text-dark">{{ $saida['countPP'] }}</div>
                            <div class="font-size-sm font-w300 text-uppercase text-black">QUANTIDADE - PP</div>
                        </div>
                        <br>
                    </a>
                </div>

                <div class="col-9 col-md-6 col-lg-9 col-xl-4">
                    <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="{{ url('backoffice/index/preventivoPP') }}">
                        <div class="block-content block-content-full">
                            <div class="font-size-sm font-w600 text-uppercase text-muted">Preventivo PP, {{ $saida['DataExtenso'] }}</div>
                            <div class="font-size-h2 font-w400 text-dark">R$ {{ number_format($saida['AllPP'] / 100,2,',','.') }}</div>
                            <div class="font-size-sm font-w300 text-uppercase text-black">VALOR - PP</div>
                        </div>
                        <br>
                    </a>
                </div>

                <!-- desfavoravel -->
                <div class="col-9 col-md-6 col-lg-9 col-xl-4">
                    <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="{{ url('backoffice/index/preventivoDesfavoravel') }}">
                        <div class="block-content block-content-full">
                            <div class="font-size-sm font-w600 text-uppercase text-muted">Preventivo Desfavorável</div>
                            <div class="font-size-h2 font-w400 text-dark">{{ $saida['countDesvaforavel'] }}</div>
                            <div class="font-size-sm font-w300 text-uppercase text-black">QUANTIDADE - Desfavorável</div>
                        </div>
                        <br>
                    </a>
                </div>

                <div class="col-9 col-md-6 col-lg-9 col-xl-4">
                    <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="{{ url('backoffice/index/preventivoDesfavoravel') }}">
                        <div class="block-content block-content-full">
                            <div class="font-size-sm font-w600 text-uppercase text-muted">Preventivo Desfavorável</div>
                            <div class="font-size-h2 font-w400 text-dark">R$ {{ number_format($saida['sumDesfavoravel'] / 100,2,',','.') }}</div>
                            <div class="font-size-sm font-w300 text-uppercase text-black">VALOR - Desfavorável</div>
                        </div>
                        <br>
                    </a>
                </div>

                <!-- recusa -->
                <div class="col-9 col-md-6 col-lg-9 col-xl-4">
                    <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="{{ url('backoffice/index/preventivoRecusa') }}">
                        <div class="block-content block-content-full">
                            <div class="font-size-sm font-w600 text-uppercase text-muted">Preventivo Recusa</div>
                            <div class="font-size-h2 font-w400 text-dark">{{ $saida['countRecusa'] }}</div>
                            <div class="font-size-sm font-w300 text-uppercase text-black">QUANTIDADE - Recusa</div>
                        </div>
                        <br>
                    </a>
                </div>
                <div class="col-9 col-md-6 col-lg-9 col-xl-4">
                    <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="{{ url('backoffice/index/preventivoRecusa') }}">
                        <div class="block-content block-content-full">
                            <div class="font-size-sm font-w600 text-uppercase text-muted">Preventivo Recusa</div>
                            <div class="font-size-h2 font-w400 text-dark">R$ {{ number_format($saida['sumRecusa'] / 100,2,',','.') }}</div>
                            <div class="font-size-sm font-w300 text-uppercase text-black">VALOR - Recusa</div>
                        </div>
                        <br>
                    </a>
                </div>

            </div>
            <!-- END Stats -->

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
