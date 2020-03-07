@extends('operator.varejo.index')
@section('contentbody')
<!-- Main Container -->
<main id="main-container">
    <!-- Labels on top -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Registrar Acordo Preventivo</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Form Labels on top - Default Style -->
                    <form class="mb-5" action="be_forms_layouts.html" method="POST" onsubmit="return false;">

                        <div class="form-group form-row">

                            <div class="form-group col-4">
                                <label for="cpf">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" onkeypress="$(this).mask('000.000.000-00');" placeholder="Digite o cpf do cliente..">
                            </div>
                            <div class="form-group col-4">
                                <label for="valor_solicitado">Valor Solicitado</label>
                                <input type="text" class="form-control" id="valor_solicitado" name="valor_solicitado" onkeypress="$(this).mask('#.##0,00', {reverse: true})" placeholder="Digite o valor solicitado..">
                            </div>

                        </div>
                        
                        <div class="form-group form-row">

                            <div class="form-group col-4">
                                <label for="tx_nova">Taxa Nova</label>
                                <input type="text" class="form-control" id="tx_nova" onkeypress="$(this).mask('00.00');" name="tx_nova" placeholder="Digite a nova taxa (00.00)">
                            </div>
                            <div class="form-group col-4">
                                <label for="tx_antiga">Taxa Antiga</label>
                                <input type="text" class="form-control" id="tx_antiga" onkeypress="$(this).mask('00.00');" name="tx_antiga" placeholder="Digite a antiga taxa (00.00)">
                            </div>

                        </div>

                        <div class="form-group form-row">

                        <div class="form-group col-4">
                                <label for="produto_novo">Produto Novo</label>
                                <select class="form-control" id="produto_novo" name="produto_novo">
                                    <optgroup label="Produtos Disponiveis">
                                        <option value="">Opções  </option>
                                        @forelse ($produtos as $item)
                                            <option value="{{ $item->id }}"> {{ $item->produtos_call_center }} </option>    
                                        @empty
                                            <option> Sem Registros para mostrar! </option>    
                                        @endforelse

                                    </optgroup>    
                                </select>
                        </div>
                        <div class="form-group col-4">
                                <label for="produto_antigo">Produto Novo</label>
                                <select class="form-control" id="produto_antigo" name="produto_antigo">
                                    <optgroup label="Produtos Disponiveis">
                                        <option >Opções  </option>    
                                        <option value="">Opções  </option>
                                        @forelse ($produtos as $item)
                                            <option value="{{ $item->id }}"> {{ $item->produtos_call_center }} </option>    
                                        @empty
                                            <option> Sem Registros para mostrar! </option>    
                                        @endforelse
                                    </optgroup>    
                                </select>
                        </div>

                        </div>

                        <div class="form-group form-row">

                                <div class="form-group col-4">
                                        <label for="fila">Fila</label>
                                        <select class="form-control" id="fila" name="fila">
                                            <optgroup label="Produtos Disponiveis">
                                                <option value="">Opções  </option>
                                                @forelse ($fila as $item)
                                                    <option value="{{ $item->id }}"> {{ $item->fila }} </option>    
                                                @empty
                                                    <option> Sem Registros para mostrar! </option>    
                                                @endforelse
                                            </optgroup>    
                                        </select>
                                </div>
                                <div class="form-group col-4">
                                        <label for="contato">Tipo de Contato</label>
                                        <select class="form-control" id="contato" name="contato">
                                            <optgroup label="Produtos Disponiveis">    
                                                <option >Opções </option>
                                                <option value="Ativo">Ativo</option>
                                                <option value="Receptivo">Receptivo</option>
                                            </optgroup>    
                                        </select>
                                </div>
    
                            </div>

                            <div class="form-group form-row">

                                    <div class="form-group col-4">
                                        <label for="conta">Conta</label>
                                        <input type="text" class="form-control" id="conta" name="conta" maxlength="10" placeholder="Digite a conta..">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="agencia">Agência</label>
                                        <input type="text" class="form-control" id="agencia" maxlength="15" name="agencia" placeholder="Digite a agência..">
                                    </div>
                                    
                            </div>

                            <div class="form-group form-row">

                                    <div class="form-group col-4">
                                        <label for="contrato">Contrato</label>
                                        <input type="text" class="form-control" id="contrato" maxlength="40" name="contrato" placeholder="Digite o contrato..">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="financiado">Valor Financiado</label>
                                        <input type="text" class="form-control" id="financiado" onkeypress="$(this).mask('#.##0,00', {reverse: true})" name="financiado" placeholder="Digite o valor financiado..">
                                    </div>
                                    
                            </div>

                            <div class="form-group form-row">
                            
                                <div class="form-group col-4">
                                    <label for="vencimento">Data de Vencimento</label>
                                    <input type="date" class="form-control" id="vencimento" name="vencimento" onkeypress="$(this).mask('00/00/0000');" placeholder="Digite a data de vencimento..">
                                </div>
                                <div class="form-group col-4">
                                    <label for="parcelas">Nº de parcelas</label>
                                    <input type="number" maxlength="3" type="text" class="form-control" id="parcelas" name="parcelas" placeholder="Nº de parcelas..">
                                </div>
                                
                            </div>

                            <div class="form-group form-row">

                                    <div class="form-group col-4">
                                        <label for="valor_parcela">Valor Parcela</label>
                                        <input type="text" class="form-control" id="valor_parcela" name="valor_parcela" onkeypress="$(this).mask('#.##0,00', {reverse: true})" placeholder="Digite o valor da parcela..">
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="nascimento">Data de Nascimento</label>
                                        <input type="date" class="form-control" id="nascimento" name="nascimento" onkeypress="$(this).mask('00/00/0000');" placeholder="Digite o nº de parcelas..">
                                    </div>
                                    
                            </div>

                            <div class="form-group form-row">

                                <div class="form-group col-4">
                                    <label for="jurosam">Juros A.M.</label>
                                    <input type="text" class="form-control " id="jurosam" name="jurosam" onkeypress="$(this).mask('000.00');" placeholder="Taxa a.m. (000.00)">
                                </div>
                                <div class="form-group col-4">
                                    <label for="jutosaa">Juros A.A.</label>
                                    <input type="text" class="form-control" id="jurosaa" name="jurosaa" onkeypress="$(this).mask('000.00');" placeholder="Taxa a.a.  (000.00)">
                                </div>
                                
                            </div>

                            <div class="form-group form-row">

                                <div class="form-group col-4">
                                    <label for="cetam">CET A.M.</label>
                                    <input type="text" class="form-control " id="cetam" name="cetam" onkeypress="$(this).mask('000.00');" placeholder="CET a.m. (000.00)">
                                </div>
                                <div class="form-group col-4">
                                    <label for="cetaa">CET A.A.</label>
                                    <input type="text" class="form-control" id="cetaa" name="cetaa" onkeypress="$(this).mask('000.00');" placeholder="CET a.a. (000.00)">
                                </div>
                                
                            </div>

                            <div class="form-group form-row">

                                <div class="form-group col-4">
                                    <label for="reducao">Redução para</label>
                                    <input type="number" class="form-control " id="reducao" name="reducao" onkeypress="$(this).mask('000');" placeholder="Redução crédito..">
                                </div>
                                <div class="form-group col-4">
                                    <label for="iof">IOF</label>
                                    <input type="text" class="form-control" id="iof" name="iof" onkeypress="$(this).mask('000.00');" placeholder="IOF (000.00)">
                                </div>
                                
                            </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </div>
                    </form>
                    <!-- END Form Labels on top - Default Style -->
                </div>
            </div>
        </div>
    </div>
    <!-- END Labels on top -->

</main>
<!-- footer -->
@include('operator.varejo.content.footer')

<!-- ajax request -->
<script type="text/javascript">

    $(document).ready(function() {
        $('#vencimento').datepicker();
    });
      
    function recorderAcc() 
    {
        prod = { 
            cpf : $("#cpf").val(), 
            nome: $("#nomeProduto").val(), 
            preco: $("#precoProduto").val(), 
            estoque: $("#quantidadeProduto").val(), 
            categoria_id: $("#categoriaProduto").val() 
        };

        $.ajax({
            type: "PUT",
            url: "/api/produtos/" + prod.id,
            context: this,
            data: prod,
            success: function(data) {
                prod = JSON.parse(data);
                linhas = $("#tabelaProdutos>tbody>tr");
                e = linhas.filter( function(i, e) { 
                    return ( e.cells[0].textContent == prod.id );
                });
                if (e) {
                    e[0].cells[0].textContent = prod.id;
                    e[0].cells[1].textContent = prod.nome;
                    e[0].cells[2].textContent = prod.estoque;
                    e[0].cells[3].textContent = prod.preco;
                    e[0].cells[4].textContent = prod.categoria_id;
                }
            },
            error: function(error) {
                console.log(error);
            }
        });        
    }
    
</script>
@endsection
