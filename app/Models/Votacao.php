<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Votacao extends Model
{
    protected $table = 'votacoes';

    protected $fillable = [
        'pauta_id',
        'minutos'
    ];

    public function pauta()
    {
        return $this->belongsTo('App\Models\Pauta');
    }

    public function votos()
    {
        return $this->hasMany('App\Models\Voto');
    }
}