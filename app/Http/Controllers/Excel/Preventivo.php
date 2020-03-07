<?php

namespace App\Http\Controllers\Excel;

use App\Http\Controllers\Controller;
use Excel;
use App\Varejo\Model\CSC\RegistroOperador;
use Maatwebsite\Excel\Concerns\FromCollection;

class Preventivo extends Controller
{
    public function Export($dtstart,$dtfinish)
    {
        $acordos = RegistroOperador::join('tb_csc_acordo','tb_csc_registro_operador.id','=','tb_csc_acordo.id_acordo_fk')
            ->whereBetween('datareg', [$dtstart,$dtfinish]);

        return Excel::create('Acordos Preventivo', function($excel) use ($acordos){
            $excel->setTitle('Acordos Preventivo')->sheet('usuarios', function($sheet) use ($acordos){

                $sheet->appendRow([
                    'Data do Acordo',
                    'Hora',
                    'Operador',
                    'Ilha',
                    'Usuário X',
                    'Aspect',
                    'CPF',
                    'Supervisor',
                    'Valor da Dívida',
                    'Taxa Nova',
                    'Taxa Antiga',
                    'Produto Novo',
                    'Produto Antigo',
                    'Fila',
                    'Tipo Acordo',
                    'Conta',
                    'Agência',
                    'Contrato',
                    'Valor Financiado',
                    'Data de Vencimento',
                    'Número de parcelas',
                    'Valor da Parcelas',
                    'Juros ao Mês',
                    'Juros ao Ano',
                    'CET ao Mês',
                    'CET ao Ano',
                    'IOF',
                    'Redução Para',
                    'Data de Nascimento'
                ]);

                $acordos->chunk(500, function ($usuarios) use ($sheet)
                {

                    foreach ($usuarios as $acordo){

                        $sheet->appendRow([
                            date('d/m/Y', strtotime($acordo->datareg)),
                            $acordo->hora,
                            $acordo->nomeoperador,
                            $acordo->celula,
                            $acordo->usuariox,
                            $acordo->aspect,
                            str_replace("-","",str_replace(".","",'F0'.$acordo->cpf)),
                            $acordo->supervisor,
                            number_format($acordo->valor/100,2,',','.'),
                            $acordo->taxanova,
                            $acordo->taxaantiga,
                            $acordo->produtonovo,
                            $acordo->produtoantigo,
                            $acordo->fila,
                            $acordo->tipo_acordo,
                            $acordo->conta,
                            $acordo->agencia,
                            $acordo->contrato,
                            number_format($acordo->valor_financiado/100,2,',','.'),
                            date('d/m/Y', strtotime($acordo->data_vencimento)),
                            $acordo->numero_parcelas,
                            number_format($acordo->valor_parcela/100,2,',','.'),
                            $acordo->jurosAM,
                            $acordo->jurosAA,
                            $acordo->cetAM,
                            $acordo->cetAA,
                            $acordo->iof,
                            $acordo->reducao_para,
                            date('d/m/Y', strtotime($acordo->data_nascimento)),
                        ]);
                    }
                });

                //$sheet->fromArray($acordo_array, null, 'A1', false, false);
                $sheet->row(1, function ($row){
                    $row->setFontColor('#ffffff')->setBackground('#00458B');
                });

            });
        })->download('xlsx');

    }

    public function ExportPP($dtstart,$dtfinish)
    {
        $acordos = RegistroOperador::join('tb_csc_pp','tb_csc_registro_operador.id','=','tb_csc_pp.id_pp_csc_fk')
            ->whereBetween('datareg', [$dtstart,$dtfinish]);

        return Excel::create('PP Preventivo', function($excel) use ($acordos){
            $excel->setTitle('PP Preventivo')->sheet('usuarios', function($sheet) use ($acordos){

                $sheet->appendRow([
                    'X',
                    'Data',
                    'Hora',
                    'Célula',
                    'Supervisor',
                    'Operador',
                    'Aspect',
                    'CPF',
                    'Valor',
                    'Fila',
                ]);

                $acordos->chunk(500, function ($usuarios) use ($sheet)
                {

                    foreach ($usuarios as $acordo){

                        $sheet->appendRow([
                            $acordo->usuariox,
                            date('d/m/Y', strtotime($acordo->datareg)),
                            $acordo->hora,
                            $acordo->celula,
                            $acordo->supervisor,
                            $acordo->nomeoperador,
                            $acordo->aspect,
                            str_replace("-","",str_replace(".","",'F0'.$acordo->cpf)),
                            number_format($acordo->valor/100,2,',','.'),
                            $acordo->fila,
                        ]);
                    }

                });

                //$sheet->fromArray($acordo_array, null, 'A1', false, false);
                $sheet->row(1, function ($row){
                    $row->setFontColor('#ffffff')->setBackground('#00458B');
                });

            });
        })->download('xlsx');

    }

    public function ExportDesfavoravel($dtstart,$dtfinish)
    {
        $acordos = RegistroOperador::join('tb_csc_desfavoravel','tb_csc_registro_operador.id','=','tb_csc_desfavoravel.id_desfavoravel_fk')
            ->whereBetween('datareg', [$dtstart,$dtfinish]);

        return Excel::create('Desfavoravel Preventivo', function($excel) use ($acordos){
            $excel->setTitle('Desfavoravel Preventivo')->sheet('usuarios', function($sheet) use ($acordos){

                $sheet->appendRow([
                    'X',
                    'Operador',
                    'Aspect',
                    'Data',
                    'Hora',
                    'Supervisor',
                    'CPF',
                    'Valor',
                    'Fila',
                    'Taxa Antiga',
                    'Taxa Nova',
                    'Dias Atraso',
                    'Valor Parc Anterior',
                    'QTD Parc Anterior',
                    'Valor Parc Atual',
                    'QTD Parcela Atual',
                ]);

                $acordos->chunk(500, function ($usuarios) use ($sheet)
                {

                    foreach ($usuarios as $acordo){

                        $sheet->appendRow([
                            $acordo->usuariox,
                            $acordo->nomeoperador,
                            $acordo->aspect,
                            date('d/m/Y', strtotime($acordo->datareg)),
                            $acordo->hora,
                            $acordo->supervisor,
                            str_replace("-","",str_replace(".","",'F0'.$acordo->cpf)),
                            number_format(($acordo->valor / 100), 2,',','.'),
                            $acordo->fila,
                            $acordo->taxaantiga ,
                            $acordo->taxanova,
                            $acordo->dias_atraso,
                            number_format(($acordo->valor_parc_anterior / 100), 2,',','.') ,
                            $acordo->qtd_parc_anterior,
                            number_format(($acordo->valor_parc_atual / 100), 2,',','.'),
                            $acordo->qtd_parc_atual,
                        ]);
                    }

                });

                //$sheet->fromArray($acordo_array, null, 'A1', false, false);
                $sheet->row(1, function ($row){
                    $row->setFontColor('#ffffff')->setBackground('#00458B');
                });

            });
        })->download('xlsx');

    }

    public function ExportRecusa($dtstart,$dtfinish)
    {
        $acordos = RegistroOperador::join('tb_csc_recusa','tb_csc_registro_operador.id','=','tb_csc_recusa.id_recusa_csc_fk')
            ->whereBetween('datareg', [$dtstart,$dtfinish]);

        return Excel::create('Recusa Preventivo', function($excel) use ($acordos){
            $excel->setTitle('Recusa Preventivo')->sheet('usuarios', function($sheet) use ($acordos){

                $sheet->appendRow([
                    'X',
                    'Operador',
                    'Aspect',
                    'Data',
                    'Hora',
                    'Supervisor',
                    'CPF',
                    'Valor',
                    'Fila',
                    'Taxa Antiga',
                    'Taxa Nova',
                    'Produto Novo',
                    'Produto Antigo',
                ]);

                $acordos->chunk(500, function ($usuarios) use ($sheet)
                {

                    foreach ($usuarios as $acordo)
                    {
                        $sheet->appendRow([
                            $acordo->usuariox,
                            $acordo->nomeoperador,
                            $acordo->aspect,
                            date('d/m/Y', strtotime($acordo->datareg)),
                            $acordo->hora,
                            $acordo->supervisor,
                            str_replace("-","",str_replace(".","",'F0'.$acordo->cpf)),
                            number_format(($acordo->valor / 100), 2,',','.'),
                            $acordo->fila,
                            $acordo->taxaantiga ,
                            $acordo->taxanova,
                            $acordo->produtonovo,
                            $acordo->produtoantigo,
                        ]);
                    }

                });

                //$sheet->fromArray($acordo_array, null, 'A1', false, false);
                $sheet->row(1, function ($row){
                    $row->setFontColor('#ffffff')->setBackground('#00458B');
                });

            });
        })->download('xlsx');

    }


}
