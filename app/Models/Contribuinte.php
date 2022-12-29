<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contribuinte extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id',
        'nome',
        'telefone'
    ];

    public function endereco():HasOne
    {
        return $this->hasOne(Endereco::class, 'contribuinte_id', 'id');
    }

    public function contribuicoes(): HasMany
    {
        return $this->hasMany(Contribuicao::class, 'contribuinte_id', 'id');
    }
}
