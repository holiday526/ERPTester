<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;

class ReceiptTypesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $types = app("App\Http\Controllers\API\ReceiptTypesController")->index();
        return view(
            'layout.type.index',
            ['types'=>$types]
        );
    }

    public function delete($delete_id){
        $types = app("App\Http\Controllers\API\ReceiptTypesController")->destroy($delete_id);
        $types = app("App\Http\Controllers\API\ReceiptTypesController")->index();

        return view(
            'layout.type.index',
            ['types'=>$types]
        );
    }

    public function createPage(){
        return view('layout.type.create');
    }

}
