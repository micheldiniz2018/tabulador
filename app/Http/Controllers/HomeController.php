<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Operator\Varejo\index;
use App\Http\Controllers\BackOffice\Pages\IndexBackOffice;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->isOperatorVarejo())
        {
            $RegAcordos = new index();
            $acordos = $RegAcordos->index();
            return view('operator.varejo.content.home', compact('acordos'));
        }
        else if(Auth::user()->isSuper())
        {
            return redirect()->route('operator.varejo.index');
        }
        else if(Auth::user()->isBackOffice())
        {
            $numberPreventivo = new IndexBackOffice();
            $saida = $numberPreventivo->index();
            return view('backoffice.index.content.home', compact('saida'));
        }

    }

}
