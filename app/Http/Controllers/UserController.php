<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\respuestas;
use App\Http\Controllers\userValidate;


class UserController extends Controller
{
    public function __invoke()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET["id"])) {
                $usuarioId = $_GET["id"];
                $users = User::select('users.id', 'users.nombre', 'roles.nombreRol', 'users.estado')
                    ->join('roles', 'users.rol', '=', 'roles.id')
                    ->where('estado', '1')
                    ->where('users.id', $usuarioId)
                    ->get();
                header("Content-Type: application/json");
                http_response_code(200);
            } else {
                $users = User::select('users.id', 'users.nombre', 'roles.nombreRol', 'users.estado')
                    ->join('roles', 'users.rol', '=', 'roles.id')
                    ->where('users.estado', '1')
                    ->get();
                header("Content-Type: application/json");
                http_response_code(200);
            }

            return response()->json($users);
        } else {
            $_respuestas = new respuestas;
            header("Content-Type: application/json");
            $datosArray = $_respuestas->error_405();
            echo json_encode($datosArray);
        }
    }

    public function index($opcion)
    {
        if ($opcion == "1") {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                if (isset($_GET["id"])) {
                    $usuarioId = $_GET["id"];
                    $users = User::select('users.id', 'users.nombre', 'roles.nombreRol', 'users.estado')
                        ->join('roles', 'users.rol', '=', 'roles.id')
                        ->where('estado', '1')
                        ->where('users.id', $usuarioId)
                        ->get();
                } else {
                    $users = User::select('users.id', 'users.nombre', 'roles.nombreRol', 'users.estado')
                        ->join('roles', 'users.rol', '=', 'roles.id')
                        ->where('estado', '1')
                        ->get();
                }
                return response()->json($users);
            } else {
                $_respuestas = new respuestas;
                header("Content-Type: application/json");
                $datosArray = $_respuestas->error_405();
                echo json_encode($datosArray);
            }
        } elseif ($opcion == "2") {
            $_userVali = new userValidate;
            $_respuestas = new respuestas;
            if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
                //Recibe datos enviados
                $patchBody = file_get_contents("php://input");
                //Envia datos al manejador
                $datosArray = $_userVali->patch($patchBody);
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
                header("Content-Type: application/json");
                $datosArray = $_respuestas->error_405();
                echo json_encode($datosArray);
            }
        }
    }

    public function create(Request $request)
    {
        $_userVali = new userValidate;
        $_respuestas = new respuestas;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Recibe datos enviados
            $postBody = file_get_contents("php://input");
            //Envia al manejador
            $datosArray = $_userVali->post($postBody);
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
            header("Content-Type: application/json");
            $datosArray = $_respuestas->error_405();
            echo json_encode($datosArray);
        }
    }

    public function delete()
    {
        if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            echo "Metodo DELETE valido";
        } else {
            $_respuestas = new respuestas;
            header("Content-Type: application/json");
            $datosArray = $_respuestas->error_405();
            echo json_encode($datosArray);
        }
    }
}
