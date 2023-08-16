<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    function dashboard(){
        return view("admin/dashboardPage");
    }

    public function main(){
        echo $_ENV['APP_NAME'];
    }
}
