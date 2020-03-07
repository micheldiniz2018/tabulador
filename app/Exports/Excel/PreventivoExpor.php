<?php

namespace App\Exports\Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Varejo\Model\CSC\RegistroOperador;

class PreventivoExpor implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

    }

    public function export($dtstart,$dtfinish)
    {
        $acordos = RegistroOperador::join('tb_csc_acordo','tb_csc_registro_operador.id','=','tb_csc_acordo.id_acordo_fk')
            ->join('tb_csc_acordo_status','tb_csc_acordo.fk_status','=','tb_csc_acordo_status.id')
            ->whereBetween('datareg', [$dtstart,$dtfinish])
            ->get();

        //return Excel::download( $acordos, date('d-m-Y-i-H').'_Preventivo.xlsx');
        $acordo_array[] = array('Data do Acordo', 'Hora', 'Operador', 'Ilha', 'Usuário X', 'Aspect','Supervisor','Valor da Dívida'
        ,'Taxa Nova','Taxa Antiga','Produto Novo','Produto Antigo','Fila','Tipo Acordo','Conta','Agência','Contrato','Valor Financiado'
        ,'Data de Vencimento','Número de parcelas','Valor da Parcelas','Juros ao Mês','Juros ao Ano','CET ao Mês','CET ao Ano','IOF'
        ,'Redução Para','Data de Nascimento','');

        foreach($acordos as $acordo)
        {
            $acordo_array[] = array(
                'Data do Acordo'  => date('d/m/Y', strtotime($acordo->datareg)),
                'Hora'   => $acordo->	hora,
                'Operador'    => $acordo->nomeoperador,
                'Ilha'  => $acordo->celula,
                'Usuário X'   => $acordo->usuariox,
                'Usuário X'   => $acordo->usuariox,
                'Aspect'   => $acordo->aspect,
                'Supervisor'   => $acordo->supervisor,
                'Valor da Dívida'   => number_format($acordo->valor/100,2,',','.'),
                'Taxa Nova'   => $acordo->taxanova,
                'Taxa Antiga'   => $acordo->taxaantiga,
                'Produto Novo'   => $acordo->produtonovo,
                'Produto Antigo'   => $acordo->produtoantigo,
                'Fila'   => $acordo->fila,
                'Tipo Acordo'   => $acordo->tipo_acordo,
                'Conta'   => $acordo->conta,
                'Agência'   => $acordo->agencia,
                'Contrato'   => $acordo->contrato,
                'Valor Financiado'   => number_format($acordo->valor_financiado/100,2,',','.'),
                'Data de Vencimento'   => date('d/m/Y', strtotime($acordo->data_vencimento)),
                'Número de parcelas'   => $acordo->numero_parcelas,
                'Valor da Parcelas'   => number_format($acordo->valor_parcela/100,2,',','.'),
                'Juros ao Mês'   => $acordo->jurosAM	,
                'Juros ao Ano'   => $acordo->jurosAA,
                'CET ao Mês'   => $acordo->cetAM,
                'CET ao Ano'   => $acordo->cetAA,
                'IOF'   => $acordo->iof,
                'Redução Para'   => $acordo->reducao_para,
                'Redução Para'   => date('d/m/Y', strtotime($acordo->data_nascimento))
            );
        }

        return $acordo_array;

    }


}
