<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    protected $table = 'votos';

    protected $fillable = [
        'votacao_id',
        'voto',
        'associado'
    ];

    public function votacao()
    {
        return $this->belongsTo('App\Models\Votacao');
    }
}