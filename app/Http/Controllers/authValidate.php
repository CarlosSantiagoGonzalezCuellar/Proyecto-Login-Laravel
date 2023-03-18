<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class authValidate extends Controller
{
    public function login($json)
    {
        $_respuestas = new respuestas;

        $datos = json_decode($json, true);
        if (!isset($datos["correo"]) || !isset($datos["password"])) {
            // Error en los campos
            return $_respuestas->error_401();
        } else {
            $correo = $datos["correo"];
            $password = $datos["password"];

            $_user = User::where('correo', $correo)->firstOrFail();
            $resultArray = array();

            foreach ($_user as $key) {
                $resultArray[] = $key;
            }

            $datos = $this->convertirUtf8($resultArray);

            if ($datos) {
                // Verificar si la contraseña es igual
                if (Hash::check($password, $_user["password"])) {
                    $token = $_user->createToken('auth_token')->plainTextToken;
                    if ($token) {
                        $result = $_respuestas->response;

                        $result["result"] = array(
                            "token" => $token,
                            "id" => $_user["id"],
                            "nombre" => $_user["nombre"],
                            "rol" => $_user["rol"]
                        );

                        return $result;
                    } else {
                        //No se guardo
                        return $_respuestas->error_500("Error interno, no se ha podido guardar!!");
                    }
                } else {
                    //Contraseña incorrecta
                    return $_respuestas->error_200("La contraseña es invalida!!");
                }
            } else {
                // Si no existe el usuario
                return $_respuestas->error_200("El usuario $correo no existe!!");
            }
        }
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
