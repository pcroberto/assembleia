<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pauta extends Model
{
    protected $table = 'pautas';

    protected $fillable = [
        'nome',
        'descricao'
    ];
}