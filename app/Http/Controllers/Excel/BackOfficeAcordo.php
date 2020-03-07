<?php

namespace App\Http\Controllers\Excel;

use App\Http\Controllers\Controller;
use Excel;
use App\Varejo\Model\CSC\AcordoBackoffice;
use Maatwebsite\Excel\Concerns\FromCollection;

class BackOfficeAcordo extends Controller
{

    public function Export($dtstart,$dtfinish)
    {
        $acordos = AcordoBackoffice::join('tb_csc_acordo_status','tb_csc_acordo_backoffice.status','=','tb_csc_acordo_status.id')
            ->join('tb_csc_acordo_codigo','tb_csc_acordo_backoffice.codigo','=','tb_csc_acordo_codigo.id')
            ->join('tb_csc_acordo_campanha_tipo_negociacao','tb_csc_acordo_backoffice.tipo_negociacao','=','tb_csc_acordo_campanha_tipo_negociacao.id')
            ->join('tb_csc_acordo_campanha','tb_csc_acordo_backoffice.campanha','=','tb_csc_acordo_campanha.id')
            ->join('tb_filas_cateira','tb_csc_acordo_backoffice.fila','=','tb_filas_cateira.id')
            ->whereBetween('data', [date('Y-08-01'),date('Y-08-t')]);

        return Excel::create('Acordos Back Office', function($excel) use ($acordos){
            $excel->setTitle('Acordos Back Office')->sheet('acc', function($sheet) use ($acordos){

                $sheet->appendRow([
                    'Valor Dívida',
                    'Valor Financiado',
                    'Status',
                    'Usuário X',
                    'Data Vencimento',
                    'Data Acordo',
                    'Hora Acordo',
                    'Taxa Nova',
                    'Taxa Antiga',
                    'Contrato',
                    'Código',
                    'Nome BKO',
                    'Aspect BKO',
                    'Tipo Negociação',
                    'Campanha',
                    'Fila'
                ]);

                $acordos->chunk(500, function ($acc) use ($sheet)
                {
                    foreach ($acc as $acordo){

                        $sheet->appendRow([
                            number_format(($acordo->valor ), 2,',','.'),
                            number_format(($acordo->valor_tfc ), 2,',','.') ,
                            $acordo->status,
                            $acordo->usuario_x,
                            date('d/m/Y', strtotime($acordo->dt_vencimento)),
                            date('d/m/Y', strtotime($acordo->data)),
                            $acordo->hora,
                            $acordo->tx_nova,
                            $acordo->tx_antiga,
                            $acordo->contrato,
                            $acordo->codigo,
                            $acordo->backoffice_name,
                            $acordo->backoffice_aspect,
                            $acordo->negociacao,
                            $acordo->campanha,
                            $acordo->fila
                        ]);
                    }
                });

                //$sheet->fromArray($acordos, null, 'A1', false, false);
                $sheet->row(1, function ($row){
                    $row->setFontColor('#ffffff')->setBackground('#00458B');
                });

            });
        })->download('xlsx');

    }

}
