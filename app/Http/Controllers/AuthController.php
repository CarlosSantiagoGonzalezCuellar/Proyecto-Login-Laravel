<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\respuestas;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        $_respuestas = new respuestas;
        $_authVali = new authValidate;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Recibe datos enviados
            $postBody = file_get_contents("php://input");
            //Envia al manejador
            $datosArray = $_authVali->login($postBody);
            //Devuelve respuesta
            header("Content-Type: application/json");
            if (isset($datosArray["result"]["error_id"])) {
                $responseCode = $datosArray["result"]["error_id"];
                http_response_code($responseCode);
            } else {
                http_response_code(200);
            }
            echo json_encode($datosArray);

        } else {
            $_respuestas = new respuestas;
            header("Content-Type: application/json");
            $datosArray = $_respuestas->error_405();
            echo json_encode($datosArray);
        }
    }
}
