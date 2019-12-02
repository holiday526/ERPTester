<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;

class VendorsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $vendors = app("App\Http\Controllers\API\VendorsController")->index();

        return view(
            'layout.vendor.index',
            ['vendors'=>$vendors]
        );
    }

    public function delete($delete_id){
        $vendors = app("App\Http\Controllers\API\VendorsController")->destroy($delete_id);
        $vendors = app("App\Http\Controllers\API\VendorsController")->index();

        return view(
            'layout.vendor.index',
            ['vendors'=>$vendors]
        );
    }

    public function createPage(){
        return view('layout.vendor.create');
    }

    public function createUser($name){
        $vendors = app("App\Http\Controllers\API\VendorsController")->create($name);
        $vendors = app("App\Http\Controllers\API\VendorsController")->index();
        return view(
            'layout.vendor.index',
            ['vendors'=>$vendors]
        );
    }


}
