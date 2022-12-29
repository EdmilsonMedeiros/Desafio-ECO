<?php

namespace App\Http\Controllers;

use App\Models\Contribuinte;
use App\Models\Endereco;
use Illuminate\Http\Request;

class ContribuinteController extends Controller
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
        $contribuintes = Contribuinte::get();
        return view('contribuinte', compact('contribuintes'));
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
            'nome'      => 'required',
            'telefone'  => 'required',
            'cep'       => 'required',
            'rua'       => 'required',
            'numero'    => 'required',
            'bairro'    => 'required',
            'cidade'    => 'required',
            'estado'    => 'required'
        ];
        $feedbacks = [
            'required' => 'O campo :attribute é obrigatório',
        ];

        $request->validate($rules, $feedbacks);

        $contribuinte = Contribuinte::create([
            'nome'      => $request->nome,
            'telefone'  => $request->telefone
        ]);

        $last_contribuinte = Contribuinte::get()->last();

        $endereco = Endereco::create([
            'contribuinte_id'   => $last_contribuinte->id,
            'cep'               => $request->cep,
            'rua'               => $request->rua,
            'numero'            => $request->numero,
            'bairro'            => $request->bairro,
            'cidade'            => $request->cidade,
            'estado'            => $request->estado
        ]);

        if($contribuinte && $endereco){
            return redirect()->back()->with('sucesso', 'Sucesso no cadastro');
        }else{
            return redirect()->back()->with('erro', 'Erro no cadastro');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contribuinte  $contribuinte
     * @return \Illuminate\Http\Response
     */
    public function show(Contribuinte $contribuinte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contribuinte  $contribuinte
     * @return \Illuminate\Http\Response
     */
    public function edit(Contribuinte $contribuinte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contribuinte  $contribuinte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contribuinte $contribuinte)
    {
        $rules = [
            'nome'      => 'required',
            'telefone'  => 'required',
            'cep'       => 'required',
            'rua'       => 'required',
            'numero'    => 'required',
            'bairro'    => 'required',
            'cidade'    => 'required',
            'estado'    => 'required'
        ];
        $feedbacks = [
            'required' => 'O campo :attribute é obrigatório',
        ];

        $request->validate($rules, $feedbacks);

        $dados_contribuinte = [
            'nome'      => $request->nome,
            'telefone'  => $request->telefone
        ];

        $endereco = Endereco::wherecontribuinte_id($contribuinte->id)->get()->first();
        $dados_endereco = [
            'cep'               => $request->cep,
            'rua'               => $request->rua,
            'numero'            => $request->numero,
            'bairro'            => $request->bairro,
            'cidade'            => $request->cidade,
            'estado'            => $request->estado
        ];

        if($endereco->update($dados_endereco) && $contribuinte->update($dados_contribuinte)){
            return redirect()->back()->with('sucesso', 'Sucesso');
        }else{
            return redirect()->back()->with('erro', 'Erro');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contribuinte  $contribuinte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contribuinte $contribuinte)
    {
        if($contribuinte->delete()){
            return redirect()->back()->with('sucesso', 'Sucesso');

        }else{
            return redirect()->back()->with('erro', 'Erro');
        }
    }
}
