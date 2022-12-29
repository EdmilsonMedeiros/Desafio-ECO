<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Endereco extends Model
{
    use HasFactory;
    protected $dates = ['deleted_at'];
    use SoftDeletes;
    protected $fillable = [
        'id',
        'contribuinte_id',
        'cep',
        'rua',
        'numero',
        'bairro',
        'cidade',
        'estado'
    ];

    public function contribuinte():BelongsTo
    {
        return $this->BelongsTo(Contribuinte::class, 'contribuinte_id', 'id');
    }
}
