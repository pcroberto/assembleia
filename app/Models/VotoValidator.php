<?php
namespace App\Models;

class VotoValidator
{
    const RULES = [
        'votacao_id' => 'required | numeric | min:1',
        'voto' => 'required | boolean',
        'associado' => 'required | numeric | min:1',
    ];
}