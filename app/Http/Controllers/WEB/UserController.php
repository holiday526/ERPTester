<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = app("App\Http\Controllers\API\UserController")->details();
        #return $user;
        return view(
            'layout.profile.index', ['user'=>$user]
        );
    }
}

