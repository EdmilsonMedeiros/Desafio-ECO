<style>
    .recibo-header{
        text-align: center;
    }
    .recibo{
        background-color: #fcf9d8;
        padding: 1em;
        width: 300px;
        left: auto; right: auto;
        margin-right: auto; margin-left: auto;
    }
</style>
<div class="row recibo col-5 offset-1" id="capture">
    <div class="recibo-header">
        <h3>Consectetur adipiscing elit. </h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sollicitudin lectus sit amet metus mattis maximus. Dolor sit amet, consectetur adipiscing elit.</p>
    </div>

        <p>Recibo.................: {{ isset($contribuicao->id) ? $contribuicao->id : '' }}</p>

        <p>Valor..................: {{ isset($contribuicao->valor) ? $contribuicao->valor : '' }}</p>

        <p>Data recebimento.......: {{ isset($contribuicao->data_recebimento) ? date('d/m/Y', strtotime($contribuicao->data_recebimento)) : '' }}</p>

        <p>ID/Mensageiro..........: {{ isset($contribuicao->mensageiro->id) ? $contribuicao->mensageiro->id : '' }} -
            {{ isset($contribuicao->mensageiro->name) ? $contribuicao->mensageiro->name : '' }}</p>

        <p>ID/Contribuinte........: {{ isset($contribuicao->contribuinte->id) ? $contribuicao->contribuinte->id : '' }} -
            {{ isset($contribuicao->contribuinte->nome) ? $contribuicao->contribuinte->nome : '' }}</p>

    <hr>
    <div class="">
        <p>Status: {{ isset($contribuicao->status) ? $contribuicao->status : '' }}</p>
    </div>

    <p class="p-recibo-right"><br>Cras sollicitudin lectus 7789825614</p>
</div>
