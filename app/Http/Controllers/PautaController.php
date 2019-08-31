<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PautaController extends Controller
{
    public function get($id)
    {
        echo "Achou " . $id;
    }

    public function getAll()
    {
        echo "Achou";
    }

    public function new(Request $request)
    {
        dd($request->all());
    }

    public function update($id, Request $request)
    {
        dd($id, $request->all());
    }
}
