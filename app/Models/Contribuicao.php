<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contribuicao extends Model
{
    use HasFactory;
    protected $table = "contribuicoes";
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id',
        'valor',
        'data_prevista',
        'data_recebimento',
        'contribuinte_id',
        'mensageiro_id',
        'tipo_pagamento_id',
        'status',
        'data_finalizacao',
        'observacao'
    ];

    public function pagamento(): HasOne
    {
        return $this->hasOne(Pagamento::class, 'id', 'tipo_pagamento_id');
    }

    public function contribuinte(): BelongsTo
    {
        return $this->belongsTo(Contribuinte::class, 'contribuinte_id', 'id')->withTrashed();
    }

    public function mensageiro(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'mensageiro_id');
    }

}
