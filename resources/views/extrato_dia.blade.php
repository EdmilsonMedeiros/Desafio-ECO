<style>
    .recibo-header{
        text-align: center;
    }
    .recibo{
        background-color: #fcf9d8;
        padding: 1em;
        width: 90%;
        left: auto; right: auto;
        margin-right: auto; margin-left: auto;
    }
</style>
<div class="row recibo col-5 offset-1">
    <div class="recibo-header">
        <h3>Consectetur adipiscing elit. </h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sollicitudin lectus sit amet metus mattis maximus. Dolor sit amet, consectetur adipiscing elit.</p>
    </div>

        <h3>Mensageiro: {{ Auth::user()->name }}</h3>
        <h5>{{ date('d/m/Y') }}</h5>
        <hr>
        <p>Valor total em reais................................: {{ isset($total_reais_contribuicoes) ? $total_reais_contribuicoes : ''}}</p>
        <p>Quantidade total de doações.........................: {{ isset($total_doacoes) ? $total_doacoes : ''}}</p>
        <hr>
        <p>Quantidade total de doações recebidas...............: {{ isset($total_doacoes_recebidas) ? $total_doacoes_recebidas : ''}}</p>
        <p>Valor total em reais................................: {{ isset($total_reais_contribuicoes_recebidas) ? $total_reais_contribuicoes_recebidas : ''}}</p>
        <hr>
        <p>Quantidade total de doações pendentes...............: {{ isset($total_doacoes_pendentes) ? $total_doacoes_pendentes : ''}}</p>
        <p>Valor total em reais................................: {{ isset($total_reais_contribuicoes_pendentes) ? $total_reais_contribuicoes_pendentes : ''}}</p>
        <hr>
        <p>Quantidade total de doações canceladas...............: {{ isset($total_doacoes_canceladas) ? $total_doacoes_canceladas : ''}}</p>
        <p>Valor total em reais................................: {{ isset($total_reais_contribuicoes_canceladas) ? $total_reais_contribuicoes_canceladas : ''}}</p>

    <p class="p-recibo-right"><br>Cras sollicitudin lectus 7789825614</p>
</div>
