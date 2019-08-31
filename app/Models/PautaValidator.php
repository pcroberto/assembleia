<?php
namespace App\Models;

class PautaValidator
{
    const RULES = [
        'nome' => 'required | max:255',
        'descricao' => 'required'
    ];
}