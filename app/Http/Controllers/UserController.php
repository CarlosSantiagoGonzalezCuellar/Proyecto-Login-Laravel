<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\respuestas;
use App\Http\Controllers\userValidate;


class UserController extends Controller
{

    //<!-- ========== METODO POR DEFECTO DE USER: GET ========== -->
    public function __invoke()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET["id"])) {
                $usuarioId = $_GET["id"];
                $users = User::select('users.id', 'users.nombre', 'roles.nombreRol', 'users.correo', 'users.password')
                    ->join('roles', 'users.rol', '=', 'roles.id')
                    ->where('users.id', $usuarioId)
                    ->get();
                header("Content-Type: application/json");
                http_response_code(200);
            } else {
                $users = User::select('users.id', 'users.nombre', 'roles.nombreRol', 'users.correo', 'users.password')
                    ->join('roles', 'users.rol', '=', 'roles.id')
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


    //<!-- ========== METODO DE URL INDEX DE USER: 1=GET - 2=PATCH ========== -->
    public function index($opcion)
    {

        //<!-- ========== METODO GET SI URL = 1 ========== -->
        if ($opcion == "1") {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                if (isset($_GET["id"])) {
                    $usuarioId = $_GET["id"];
                    $users = User::select('users.id', 'users.nombre', 'roles.nombreRol', 'users.correo', 'users.password')
                        ->join('roles', 'users.rol', '=', 'roles.id')
                        ->where('users.id', $usuarioId)
                        ->get();
                } else {
                    $users = User::select('users.id', 'users.nombre', 'roles.nombreRol', 'users.correo', 'users.password')
                        ->join('roles', 'users.rol', '=', 'roles.id')
                        ->get();
                }
                return response()->json($users);

            } else {
                $_respuestas = new respuestas;
                header("Content-Type: application/json");
                $datosArray = $_respuestas->error_405();
                echo json_encode($datosArray);
            }

        //<!-- ========== METODO PATCH SI URL = 2 ========== -->
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


    //<!-- ========== METODO DE URL CREATE DE USER: POST ========== -->
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


    //<!-- ========== METODO DE URL DELETE DE USER: POST ========== -->
    public function delete()
    {
        $_userVali = new userValidate;
        $_respuestas = new respuestas;
        if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            //Recibe datos enviados
            $deleteBody = file_get_contents("php://input");
            //Envia datos al manejador
            $datosArray = $_userVali->delete($deleteBody);
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
