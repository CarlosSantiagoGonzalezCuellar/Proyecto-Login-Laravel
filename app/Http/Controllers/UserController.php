<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __invoke()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            echo "Metodo GET valido";

        } else {
            echo "Metodo no valido";
        }
    }

    public function index($opcion)
    {
        if ($opcion == "1") {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                echo "Metodo GET valido";
            } else {
                echo "Metodo no valido";
            }

        } elseif ($opcion == "2") {
            if ($_SERVER["REQUEST_METHOD"] == "PATCH") {
                echo "Metodo PATCH valido";
            } else {
                echo "Metodo no valido";
            }
        }
    }

    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "Metodo POST valido";

        } else {
            echo "Metodo no valido";
        }
    }

    public function delete()
    {
        if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            echo "Metodo DELETE valido";

        } else {
            echo "Metodo no valido";
        }
    }
}
