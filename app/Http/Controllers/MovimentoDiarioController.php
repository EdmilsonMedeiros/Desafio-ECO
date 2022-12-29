<?php

namespace App\Http\Controllers;

use App\Models\Contribuicao;
use App\Models\Contribuinte;
use App\Models\Pagamento;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\PDF as PDF;
use Illuminate\Support\Facades\DB;

class MovimentoDiarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forma_pagamentos   = Pagamento::get();
        $contribuintes      = Contribuinte::get();
        $mensageiros        = User::get();

        $hoje = date('Y-m-d');

        $contribuicoes = Contribuicao::wheremensageiro_id(Auth::user()->id)
        // ->wheredata_recebimento($hoje)
        ->where('data_prevista', $hoje)
        ->orWhere('data_prevista', '<=', $hoje)
        ->wheremensageiro_id(Auth::user()->id)
        ->wherestatus('Pendente')->get();

        return view('movimentos_diarios',compact('contribuicoes', 'forma_pagamentos', 'contribuintes', 'mensageiros'));
    }

    public function historico($id)
    {
        $contribuicoes = Contribuicao::wheremensageiro_id($id)
        ->where('data_finalizacao', '!=', null)
        ->get();

        return view('historico_movimentos', compact('contribuicoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    public function updateMovimentosDia($user)
    {
        $hoje = date('Y-m-d');

        $contribuicao_update = Contribuicao::wheremensageiro_id($user)
        ->where('data_prevista', $hoje)
        ->orWhere('data_prevista', '<=', $hoje)
        ->wheremensageiro_id(Auth::user()->id)
        ->wherestatus('Pendente')->get();

        foreach($contribuicao_update as $contribuicao_update){
            $contribuicao_update->update(['data_finalizacao'=>$hoje]);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function PDFMovimentoDiario($user)
    {
        $hoje = date('Y-m-d');

        $contribuicoes_db = DB::table('contribuicoes')->wheremensageiro_id($user)
        ->where('data_prevista', $hoje)
        ->orWhere('data_prevista', '<=', $hoje)
        ->wheremensageiro_id(Auth::user()->id)
        ->wherestatus('Pendente')->get();


        $total_reais_contribuicoes = $contribuicoes_db->sum('valor');
        $total_doacoes = count($contribuicoes_db);

        $total_reais_contribuicoes_recebidas = $contribuicoes_db->where('status', 'Recebido')->sum('valor');
        $total_doacoes_recebidas = count($contribuicoes_db->where('status', 'Recebido'));

        $total_reais_contribuicoes_pendentes = $contribuicoes_db->where('status', 'Pendente')->sum('valor');
        $total_doacoes_pendentes = count($contribuicoes_db->where('status', 'Pendente'));

        $total_reais_contribuicoes_canceladas = $contribuicoes_db->where('status', 'Cancelado')->sum('valor');
        $total_doacoes_canceladas = count($contribuicoes_db->where('status', 'Cancelado'));


        $pdf = FacadePdf::loadView('extrato_dia', compact('total_reais_contribuicoes_canceladas', 'total_reais_contribuicoes_pendentes', 'total_reais_contribuicoes_recebidas', 'total_doacoes_canceladas', 'total_doacoes_pendentes', 'total_doacoes_recebidas', 'total_doacoes', 'total_reais_contribuicoes'));

        return $pdf->download("movimentos_".Auth::user()->name."_".date('d-m-Y').".pdf");
    }
}
