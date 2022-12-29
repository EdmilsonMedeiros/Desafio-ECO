<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contribuicoes', function (Blueprint $table) {
            $table->id();
            $table->float('valor');
            $table->date('data_prevista');
            $table->date('data_recebimento')->nullable();
            $table->unsignedBigInteger('contribuinte_id');
            $table->unsignedBigInteger('mensageiro_id');
            $table->unsignedBigInteger('tipo_pagamento_id');
            $table->string('status')->default('pendente');
            $table->string('observacao')->nullable();
            $table->date('data_finalizacao')->nullable();
            $table->foreign('contribuinte_id')->on('contribuintes')->references('id')->onDelete('cascade');
            $table->foreign('mensageiro_id')->on('users')->references('id');
            $table->foreign('tipo_pagamento_id')->on('pagamentos')->references('id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contribuicoes');
    }
};
