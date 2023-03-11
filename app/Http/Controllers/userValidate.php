<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\respuestas;
use App\Models\Credential;
use App\Models\User;
use App\Models\Token;

class userValidate extends Controller
{
    private $usuarioId = "";
    private $nombre = "";
    private $rol = "";
    private $estado = "";
    private $token = "";

    //<-- ========== METODO POST CON VALIDACIONES ========== -->
    public function post($json)
    {
        $_respuestas = new respuestas;
        $_token = new Token;
        $_user = new User;
        $datos = json_decode($json, true);

        // if (!isset($datos["token"])) {
        //     return $_respuestas->error_401();
        // } else {
        //     $this->token = $datos["token"];
        //     if ($_token->validarToken($this->token) == true) {
                if (!isset($datos["nombre"]) || !isset($datos["rol"])) {
                    return $_respuestas->error_400();
                } else {
                    $this->nombre = $datos["nombre"];
                    $this->rol = $datos["rol"];
                    $this->estado = "1";

                    $_user->nombre = $this->nombre;
                    $_user->rol = $this->rol;
                    $_user->estado = $this->estado;
                    $_user->save();
                    $respu = $_user;
                    if ($respu["id"]) {
                        $resp = $respu["id"];
                    } else {
                        $resp = 0;
                    }


                    if ($resp != null) {
                        $resp = $resp;
                    } else {
                        $resp = 0;
                    }

                    if ($resp != null) {
                        $respuesta = $_respuestas->response;
                        $respuesta["result"] = array(
                            "id" => $resp
                        );
                        return $respuesta;
                    } else {
                        return $_respuestas->error_500();
                    }
                }
        //     } else {
        //         return $_respuestas->error_401("El token enviado es invalido o ha caducado!!");
        //     }
        // }
    }


    //<-- ========== METODO PATCH CON VALIDACIONES ========== -->
    public function patch($json)
    {
        $_respuestas = new respuestas;
        $_token = new Token;
        $datos = json_decode($json, true);

        // if (!isset($datos["token"])) {
        //     return $_respuestas->error_401();
        // } else {
        //     $this->token = $datos["token"];
        //     if ($_token->validarToken($this->token) == true) {
                if (!isset($datos["id"])) {
                    return $_respuestas->error_400();
                } else {
                    $this->usuarioId = $datos["id"];

                    if (isset($datos["nombre"])) {
                        $this->nombre = $datos["nombre"];
                    }
                    if (isset($datos["rol"])) {
                        $this->rol = $datos["rol"];
                    }
                    $this->estado = "1";

                    $_user = User::find($this->usuarioId);
                    $resultArray = array();

                    foreach ($_user as $key) {
                        $resultArray[] = $key;
                    }
                    $datos = $this->convertirUtf8($resultArray);

                    if ($datos) {
                        $_user->nombre = $this->nombre;
                        $_user->rol = $this->rol;
                        $_user->estado = $this->estado;
                        $_user->save();
                        $respu = $_user;
                        if ($respu) {
                            $resp = $respu;
                        } else {
                            $resp = 0;
                        }

                        if ($resp) {
                            $respuesta = $_respuestas->response;
                            $respuesta["result"] = array(
                                "id" => $this->usuarioId
                            );
                            return $respuesta;
                        } else {
                            return $_respuestas->error_500();
                        }
                    } else {
                        return $_respuestas->error_200("Usuario inactivo!!");
                    }
                }
        //     } else {
        //         return $_respuestas->error_401("El token enviado es invalido o ha caducado!!");
        //     }
        // }
    }

    //<!-- ========== METODO PARA CONVERTIR A UTF8 ========== -->
    public function convertirUtf8($array)
    {
        array_walk_recursive($array, function (&$item, $key) {
            if (!mb_detect_encoding($item, "utf-8", true)) {
                $item = iconv("ISO-8859-1", "UTF-8", $item);
            }
        });
        return $array;
    }
}
