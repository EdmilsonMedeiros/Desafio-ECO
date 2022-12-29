<?php

use App\Models\Pagamento;
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
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->string('descricao');
            $table->softDeletes();
            $table->timestamps();
        });

        Pagamento::create([
            'descricao' => 'Dinheiro'
        ]);
        Pagamento::create([
            'descricao' => 'Cartão'
        ]);
        Pagamento::create([
            'descricao' => 'Cheque'
        ]);
        Pagamento::create([
            'descricao' => 'Outros'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagamentos');
    }
};
