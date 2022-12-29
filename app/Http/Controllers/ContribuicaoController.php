<?php

namespace App\Http\Controllers;

use App\Models\Contribuicao;
use App\Models\Contribuinte;
use App\Models\Pagamento;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF as PDF;

class ContribuicaoController extends Controller
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
        $contribuicoes      = Contribuicao::get();
        return view('home', compact('forma_pagamentos', 'contribuintes', 'mensageiros', 'contribuicoes'));
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
        $rules = [
            'valor' => 'required',
            'contribuinte_id' => 'required',
            'mensageiro_id' => 'required',
            'tipo_pagamento_id' => 'required',
            'status' => 'required'
        ];

        $feedbacks = [
            'required' => 'O campo :attribute é obigatório'
        ];

        $request->validate($rules, $feedbacks);

        if(Contribuicao::create($request->all())){
            return redirect()->back()->with('sucesso', 'Sucesso');
        }else{
            return redirect()->back()->with('erro', 'Erro');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contribuicao  $contribuicao
     * @return \Illuminate\Http\Response
     */
    public function show(Contribuicao $contribuicao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contribuicao  $contribuicao
     * @return \Illuminate\Http\Response
     */
    public function edit(Contribuicao $contribuicao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contribuicao  $contribuicao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contribuicao $contribuicao)
    {

        $rule = ['status' => 'required'];
        $feedback = ['required' => 'O campo :attribute é obrigatório'];

        $request->validate($rule, $feedback);

        $contribuicao->status = $request->status;
        if($request->status == 'Recebido'){
            $contribuicao->data_recebimento = date('Y-m-d');
        }else{
            $contribuicao->data_recebimento = null;
        }
        if($contribuicao->update()){
            return redirect()->back()->with('sucesso', 'Sucesso');
        }else{
            return redirect()->back()->with('erro', 'Erro');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contribuicao  $contribuicao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contribuicao $contribuicao)
    {
        //
    }

    public function PDFRecibo(Contribuicao $contribuicao)
    {
        $pdf = FacadePdf::loadView('recibo_pdf', compact('contribuicao'));
        return $pdf->download('recibo.pdf');
    }
}
