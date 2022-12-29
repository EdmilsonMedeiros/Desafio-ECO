@extends('layouts.app')

@section('content')

<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<div class="container-fluid container-principal">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link" href="{{ route('contribuicao.index') }}" data-bs-html="true" data-bs-toggle="tooltip" data-bs-placement="top" title="Manutenções nos próximos 7 dias"><img src="{{ asset('img/doacao (1).png') }}" alt=""> Contribuições</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('contribuinte.index') }}" data-bs-html="true" data-bs-toggle="tooltip" data-bs-placement="top" title="Solicitar, editar e deletar manutenções"><img src="{{ asset('img/doacao.png') }}" alt=""> Contribuintes</a></li>
        <li class="nav-item active"><a class="nav-link active" href="{{ route('movimentos.index') }}" data-bs-html="true" data-bs-toggle="tooltip" data-bs-placement="top" title="Manutenções nos próximos 7 dias"><img src="{{ asset('img/delivery-man.png') }}" alt=""> Meus movimentos do dia</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('movimentos.historico', Auth::user()->id) }}" data-bs-html="true" data-bs-toggle="tooltip" data-bs-placement="top" title="Manutenções nos próximos 7 dias"><img src="{{ asset('img/historia.png') }}" alt=""> Meu histórico de movimentos</a></li>
    </ul>

    @if ($contribuicoes->first()->data_finalizacao != null)
        <p class="text-success error">{{ 'Finalizados' }}</p>
    @endif

    @if (Session::has('sucesso'))
        <p class="text-success error">{{ 'Sucesso' }}</p>
    @endif
    @if (Session::has('erro'))
        <p class="text-danger error">{{ 'Erro' }}</p>
    @endif

    <div class="">
        <div class="col-12 title">
            <h4>
                Meus movimentos de hoje
            </h4>
            <a href="{{ route('movimentos.PDFMovimentoDiario', Auth::user()->id) }}" class="btn btn-light" ><img src="{{ asset('img/acabou-o-tempo.png') }}" alt=""> Extrato de atividades do dia</a>

            <a href="{{ route('updateMovimentosDia', Auth::user()->id) }}" class="btn btn-warning" onclick="return confirm('Tem certeza que quer prosseguir?')"><img src="{{ asset('img/terminar.png') }}" alt=""> Finalizar atividades</a>
        </div>
        <br>
    </div>
    <div class="card">
        <table id="example" class="table table-hover table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Contribuinte</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contribuicoes as $contribuicao)
                    <tr style="background-color:
                    {{ !is_null($contribuicao->status) && $contribuicao->status == 'Cancelado' ? '#ffece6' : '' }}
                    {{ !is_null($contribuicao->status) && $contribuicao->status == 'Pendente' ? '#fdfbe4' : '' }}
                    {{ !is_null($contribuicao->status) && $contribuicao->status == 'Recebido' ? '#edffe6' : '' }};">

                        <td>{{ isset($contribuicao->id) ? $contribuicao->id : '' }}</td>
                        <td>{{ isset($contribuicao->contribuinte->nome) ? $contribuicao->contribuinte->nome : '' }}</td>
                        <td>{{ isset($contribuicao->data_prevista) ? date('d/m/Y', strtotime($contribuicao->data_prevista)) : '' }}</td>
                        <td>{{ isset($contribuicao->status) ? $contribuicao->status : '' }}</td>
                        <td>
                            @if (isset($contribuicao->status) && $contribuicao->status == 'Recebido')
                                <a title="Recibo" href="{{ route('contribuicao.pdf', $contribuicao->id) }}" class="btn btn-primary"><img src="{{ asset('img/recibo.png') }}" alt=""></a>
                            @endif
                            <a title="Visualizar" href="#" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modal-contribuicao{{isset($contribuicao->id) ? $contribuicao->id : ''}}"><img src="{{ asset('img/eye.png') }}" alt=""></a>
                        </td>
                    </tr>

<!-- Modal contribuição-->
<div class="modal fade" id="modal-contribuicao{{isset($contribuicao->id) ? $contribuicao->id : ''}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><img src="{{ asset('img/doacao (1).png') }}" alt=""> Contribuição</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <h5>Contribuição: {{ isset($contribuicao->id) ? $contribuicao->id : '' }}</h5>
                    <ul>
                        <li><b>Contribuinte:</b> {{ isset($contribuicao->contribuinte->nome) ? $contribuicao->contribuinte->nome : '' }}</li>
                        <hr>
                        <li><b>Data prevista:</b> {{ isset($contribuicao->data_prevista) ? date('d/m/Y', strtotime($contribuicao->data_prevista)) : '' }}</li>
                        <hr>
                        <li><b>Mensageiro:</b> {{ isset($contribuicao->mensageiro->name) ? $contribuicao->mensageiro->name : '' }}</li>
                        <hr>
                        <form action="{{ route('contribuicao.update', $contribuicao->id) }}" method="post">
                            {{ csrf_field() }}
                            @method('PUT')
                            <label for=""><li><b>Status:</b> </li></label>
                            <div class="">
                                <div class="form-group">
                                    <div class="">
                                        <select name="status" id="" class="form-control" required {{ isset($contribuicao->status) && $contribuicao->status == 'Recebido' ? 'disabled' : ''}}>
                                            <option value="{{ isset($contribuicao->status) ? $contribuicao->status : '' }}" selected>{{ isset($contribuicao->status) ? $contribuicao->status : '' }}</option>
                                            <option value="Pendente">Pendente</option>,
                                            <option value="Recebido">Recebido</option>
                                            <option value="Cancelado">Cancelado</option>
                                        </select>
                                    </div>

                                    @if (!(isset($contribuicao->status) && $contribuicao->status == 'Recebido'))
                                        <div class="">
                                            <button type="submit" class="btn btn-success">Atualizar</button>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </form>
                        <hr>
                        <li><b>Data recebimento:</b> {{ isset($contribuicao->data_recebimento) ? date('d/m/Y', strtotime($contribuicao->data_recebimento)) : '' }}</li>
                        <hr>
                        <li><b>Forma de pagamento:</b> {{ isset($contribuicao->pagamento->descricao) ? $contribuicao->pagamento->descricao : '' }}</li>
                        <hr>
                        <li><b>Observações:</b> <br> {{ isset($contribuicao->observacao) ? $contribuicao->observacao : '' }}</li>


                    </ul>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        </div>
    </div>
    </div>
</div>

@endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal cadastro doação -->
<div class="modal fade modal-lg" id="modal-cadastrar-doacao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><img src="{{ asset('img/doacao (1).png') }}" alt=""> Cadastrar doação</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <div class="row">
                    <form action="{{ route('contribuicao.store') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-6">
                                <label for="">Valor</label>
                                <input name="valor" type="text" step="0.00" placeholder="0.00" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label for="">Data prevista</label>
                                <input value="{{ date('Y-m-d') }}" name="data_prevista" type="date" placeholder="" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label for="">Contribuinte</label>
                                <select name="contribuinte_id" id="" class="form-control" required>
                                    <option value="" selected disabled>Nenhum</option>
                                    @if ($contribuintes)
                                        @foreach ($contribuintes as $contribuinte)
                                            <option value="{{ $contribuinte->id ? $contribuinte->id : '' }}">{{ $contribuinte->nome ? $contribuinte->nome : '' }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="">Mensageiro</label>
                                <select name="mensageiro_id" id="" class="form-control" required>
                                    <option value="" selected disabled>Nenhum</option>
                                    @if ($mensageiros)
                                        @foreach ($mensageiros as $mensageiro)
                                            <option value="{{ isset($mensageiro->id) ? $mensageiro->id : '' }}">{{ $mensageiro->name ? $mensageiro->name : '' }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="">Forma de contribuição</label>
                                <select name="tipo_pagamento_id" id="" class="form-control" required>
                                    <option value="" selected disabled>Nenhum</option>
                                    @if ($forma_pagamentos)
                                        @foreach ($forma_pagamentos as $forma_pagamento)
                                            <option value="{{ $forma_pagamento->id ? $forma_pagamento->id : '' }}">{{ $forma_pagamento->descricao ? $forma_pagamento->descricao : '' }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="">Status:</label>
                                <select name="status" id="" class="form-control" required>
                                    <option value="Pendente" selected>Pendente</option>,
                                    <option value="Recebido">Recebido</option>
                                    <option value="Cancelado">Cancelado</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="">Observações <span class="text-gray">(255 caracteres)</span> </label>
                                <textarea class="form-control" name="observacao" id="" cols="10" rows="3"></textarea>
                            </div>
                            <div class="col-12">
                                <label for=""></label>
                                <input type="submit" class="btn btn-primary" value="Salvar">
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

<script>

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
