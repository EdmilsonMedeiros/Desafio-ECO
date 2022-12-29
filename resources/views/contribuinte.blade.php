@extends('layouts.app')

@section('content')

<div class="container-fluid container-principal">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link" href="{{ route('contribuicao.index') }}" data-bs-html="true" data-bs-toggle="tooltip" data-bs-placement="top" title="Manutenções nos próximos 7 dias"><img src="{{ asset('img/doacao (1).png') }}" alt=""> Contribuições</a></li>
        <li class="nav-item active"><a class="nav-link active" href="{{ route('contribuinte.index') }}" data-bs-html="true" data-bs-toggle="tooltip" data-bs-placement="top" title="Solicitar, editar e deletar manutenções"><img src="{{ asset('img/doacao.png') }}" alt="">Contribuintes</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('movimentos.index') }}" data-bs-html="true" data-bs-toggle="tooltip" data-bs-placement="top" title="Manutenções nos próximos 7 dias"><img src="{{ asset('img/delivery-man.png') }}" alt=""> Meus movimentos do dia</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('movimentos.historico', Auth::user()->id) }}" data-bs-html="true" data-bs-toggle="tooltip" data-bs-placement="top" title="Manutenções nos próximos 7 dias"><img src="{{ asset('img/historia.png') }}" alt=""> Meu histórico de movimentos</a></li>
    </ul>

    @if (Session::has('sucesso'))
        <p class="text-success error">{{ 'Sucesso' }}</p>
    @endif
    @if (Session::has('erro'))
        <p class="text-danger error">{{ 'Erro' }}</p>
    @endif

    @if ($errors->has('nome'))
        <p class="text-danger error">{{  $errors->has('nome') ? $errors->first('nome') : ''    }}</p>
    @endif
    @if ($errors->has('telefone'))
        <p class="text-danger error">{{  $errors->has('telefone') ? $errors->first('telefone') : ''    }}</p>
    @endif
    @if ($errors->has('cep'))
        <p class="text-danger error">{{  $errors->has('cep') ? $errors->first('cep') : ''    }}</p>
    @endif
    @if ($errors->has('rua'))
        <p class="text-danger error">{{  $errors->has('rua') ? $errors->first('rua') : ''    }}</p>
    @endif
    @if ($errors->has('numero'))
        <p class="text-danger error">{{  $errors->has('numero') ? $errors->first('numero') : ''    }}</p>
    @endif
    @if ($errors->has('bairro'))
        <p class="text-danger error">{{  $errors->has('bairro') ? $errors->first('bairro') : ''    }}</p>
    @endif
    @if ($errors->has('cidade'))
        <p class="text-danger error">{{  $errors->has('cidade') ? $errors->first('cidade') : ''    }}</p>
    @endif
    @if ($errors->has('estado'))
        <p class="text-danger error">{{  $errors->has('estado') ? $errors->first('estado') : ''    }}</p>
    @endif

    <div class="">
        <div class="col-12 title">
            <h4>
                Contribuintes
            </h4>
            <a href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modal-cadastrar-contribuinte"><img src="{{ asset('img/doacao.png') }}" alt=""> Cadastrar contribuinte</a>
        </div>
        <br>
    </div>
    <div class="card">
        <table id="example" class="table table-striped table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Contribuinte</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            @foreach ($contribuintes as $contribuinte)
            <tbody>

                    <tr>
                        <td>{{ isset($contribuinte->id) ? $contribuinte->id : '' }}</td>
                        <td>{{ isset($contribuinte->nome) ? $contribuinte->nome : '' }}</td>
                        <td>{{ isset($contribuinte->telefone) ? $contribuinte->telefone : '' }}</td>
                        <td>
                            <div class="form_delete">
                                <form action="">
                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-cadastrar-contribuinte{{ isset($contribuinte->id) ? $contribuinte->id : '' }}" title="Editar"><img src="{{ asset('img/edit.png') }}" alt=""></a>
                                </form>

                                <form class="form_delete" id="form_{{$contribuinte->id}}" action="{{ route('contribuinte.destroy', $contribuinte->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    @method('DELETE')
                                    <a class="btn btn-danger" onclick="confirmSubmit({{$contribuinte->id}})" title="Editar"><img src="{{ asset('img/trash-bin.png') }}" alt=""></a>
                                </form>
                            </div>
                        </td>
                    </tr>

            </tbody>
<!-- Modal editar contribuinte-->
<div class="modal fade modal-lg" id="modal-cadastrar-contribuinte{{ isset($contribuinte->id) ? $contribuinte->id : '' }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><img src="{{ asset('img/doacao.png') }}" alt=""> Editar Contribuinte</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <div class="row">
                    <form action="{{ route('contribuinte.update', $contribuinte->id) }}" method="POST">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="row">
                            <div class="col-6">
                                <label for="">Nome</label>
                                <input name="nome" type="text" max="50" placeholder="Nome do contribuinte" class="form-control" value="{{ isset($contribuinte->nome) ? $contribuinte->nome : '' }}" required>
                            </div>

                            <div class="col-6">
                                <label for="">Telefone</label>
                                <input name="telefone" type="text" placeholder="(99)99999-9999" class="form-control" value="{{ isset($contribuinte->telefone) ? $contribuinte->telefone : '' }}" required>
                            </div>

                            <div class="col-4">
                                <label for="">CEP</label>
                                <input name="cep" type="number" placeholder="59000000" class="form-control" value="{{ isset($contribuinte->endereco->cep) ? $contribuinte->endereco->cep : '' }}" required>
                            </div>
                            <div class="col-8">
                                <label for="">Rua</label>
                                <input name="rua" type="text" placeholder="Rua da Pedra" class="form-control" value="{{ isset($contribuinte->endereco->rua) ? $contribuinte->endereco->rua : '' }}" required>
                            </div>
                            <div class="col-2">
                                <label for="">Número</label>
                                <input name="numero" type="number" placeholder="00" class="form-control" value="{{ isset($contribuinte->endereco->numero) ? $contribuinte->endereco->numero : '' }}" required>
                            </div>
                            <div class="col-10">
                                <label for="">Bairro</label>
                                <input name="bairro" type="text" placeholder="" class="form-control" value="{{ isset($contribuinte->endereco->bairro) ? $contribuinte->endereco->bairro : '' }}" required>
                            </div>
                            <div class="col-5">
                                <label for="">Cidade</label>
                                <input name="cidade" type="text" placeholder="" class="form-control" value="{{ isset($contribuinte->endereco->cidade) ? $contribuinte->endereco->cidade : '' }}" required>
                            </div>
                            <div class="col-7">
                                <label for="">Estado</label>
                                <input name="estado" type="text" placeholder="Rio Grando do Norte" class="form-control" value="{{ isset($contribuinte->endereco->estado) ? $contribuinte->endereco->estado : '' }}" required>
                            </div>
                            <div class="col-12">
                                <label for=""></label>
                                <input type="submit" class="btn btn-primary" value="Cadastrar">
                            </div>
                        </div>
                    </form>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
    </div>
    </div>
</div>
            @endforeach
        </table>
    </div>
</div>
<script>
    var id;
    function confirmSubmit(id){
        if(confirm('Tem certeza?')){
            document.getElementById("form_"+id).submit();
        }
    }

    $(document).ready(function () {
        $('#example').DataTable({
            order: [[0, 'desc']],
            language: {
                    "lengthMenu": "Mostrar MENU resultados por página",
                    "zeroRecords": "Nenhum resultado encontrado - desculpe",
                    "info": "Mostrando página _PAGE_ de _PAGES_ páginas.",
                    "infoEmpty": "Nenhum resultado encontrado",
                    "infoFiltered": "(Filtro de MAX registros no total)",
                    "search": "Busca rápida por qualquer filtro: ",
                    "paginate": {
                        "first": "Primeira",
                        "last": "Última",
                        "next": "Próxima",
                        "previous": "Anterior"
                    },
            },
            "pageLength": 10,
        });
    });
</script>

@endsection
