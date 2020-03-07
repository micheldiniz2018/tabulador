<?php

use Illuminate\Database\Seeder;
use App\cargo;
use App\superior;
use App\ilha;
use App\User;
use Illuminate\Support\Facades\Hash;

class usuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*//insere cargos
        $cargo = new cargo();
        $cargo->cargo = 'operator';
        $cargo->save();

        $cargo = new cargo();
        $cargo->cargo = 'supervisor';
        $cargo->save();

        $cargo = new cargo();
        $cargo->cargo = 'backoffice';
        $cargo->save();

        //insere superior
        $superior = new superior();
        $superior->name = 'supervisor teste';
        $superior->save();

        //insere ilha
        $ilha = new ilha();
        $ilha->ilha = 'ilha teste';
        $ilha->save();

        //insere usuário
        $user = new User();
        $user->name = 'user teste';
        $user->usuariox = 'X111111';
        $user->aspect = 'testeoperador';
        $user->password = Hash::make('teste');
        $user->superiors_id = 1;
        $user->cargos_id = 1;
        $user->ilha_id = 1;
        $user->save();

        //insere usuário
        $user = new User();
        $user->name = 'user teste supervisor';
        $user->usuariox = 'X111111';
        $user->aspect = 'testesupervisor';
        $user->password = Hash::make('teste');
        $user->superiors_id = 1;
        $user->cargos_id = 2;
        $user->ilha_id = 1;
        $user->save();*/

        //insere backoffice
        $user = new User();
        $user->name = 'BIANCA MELO FARIA';
        $user->usuariox = 'X111111';
        $user->aspect = 'BMFARIA';
        $user->password = Hash::make('lidera123@bianca');
        $user->superiors_id = 1;
        $user->cargos_id = 3;
        $user->ilha_id = 2;
        $user->save();

        //insere backoffice
        $user = new User();
        $user->name = 'GUILHERME COLUCI OLIVEIRA';
        $user->usuariox = 'X111111';
        $user->aspect = 'GCOLUCI';
        $user->password = Hash::make('lidera123@guilherme');
        $user->superiors_id = 1;
        $user->cargos_id = 3;
        $user->ilha_id = 2;
        $user->save();

        //insere backoffice
        $user = new User();
        $user->name = 'Rhawanny Bianca Paes da Silva';
        $user->usuariox = 'X111111';
        $user->aspect = 'Rbpaes';
        $user->password = Hash::make('lidera123@rhawanny');
        $user->superiors_id = 1;
        $user->cargos_id = 3;
        $user->ilha_id = 2;
        $user->save();
    }
}
