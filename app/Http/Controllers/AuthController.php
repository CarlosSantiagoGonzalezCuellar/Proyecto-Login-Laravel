<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\respuestas;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "Metodo POST valido";
            $data = json_decode($request->getContent());

        } else {
            $_respuestas = new respuestas;
            header("Content-Type: application/json");
            $datosArray = $_respuestas->error_405();
            echo json_encode($datosArray);
        }
    }
}
