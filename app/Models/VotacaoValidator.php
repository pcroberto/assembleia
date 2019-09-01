<?php
namespace App\Models;

class VotacaoValidator
{
    const RULES = [
        'pauta_id' => 'required | numeric | min:1',
        'minutos' => 'numeric | min:1'
    ];
}
