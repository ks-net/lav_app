<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class AdminDashboardController extends Controller {


    public function index() {
        $routes = Route::getRoutes();


        return view('admin.dashboard')->with('routes', $routes);
    }

}
