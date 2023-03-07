<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "Metodo POST valido";

        } else {
            echo "Metodo no valido";
        }
    }
}
