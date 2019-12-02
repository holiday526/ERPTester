<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;

class ReceiptsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $receipts = app("App\Http\Controllers\API\ReceiptsController")->index();
        $receipt_type_name = array();
        foreach (App\ReceiptType::all() as $receiptType) {
            $receipt_type_name[$receiptType['id']] = $receiptType['description'];
        }
        return view(
            'layout.receipt.index',
            ['receipts'=>$receipts, 'receipt_type_name'=>$receipt_type_name]
        );
    }

    public function show($receipt_id) {
        $receipt = app("App\Http\Controllers\API\ReceiptsController")->show($receipt_id);
        $total_value = 0;
        foreach ($receipt['receipt_item'] as $item) {
            $total_value += $item['data'];
        }
        return view(
            'layout.receipt.show',
            ['receipt'=>$receipt, 'total_value'=>$total_value]
        );
    }

    public function delete($delete_id){
        $receipt = app("App\Http\Controllers\API\ReceiptsController")->destroy($delete_id);
        $receipts = app("App\Http\Controllers\API\ReceiptsController")->index();
        $receipt_type_name = array();
        foreach (App\ReceiptType::all() as $receiptType) {
            $receipt_type_name[$receiptType['id']] = $receiptType['description'];
        }
        return view(
            'layout.receipt.index',
            ['receipts'=>$receipts, 'receipt_type_name'=>$receipt_type_name]
        );
    }

    public function create(){
        $types = array();
        foreach (App\ReceiptType::all() as $receiptType) {
            $types[$receiptType['id']] = $receiptType['description'];
        }

        $vendors = array();
        foreach (App\Vendor::all() as $vendor) {
            $vendors[$vendor['id']] = $vendor['name'];
        }
        return view('layout.receipt.create',
            ['types'=>$types, 'vendors'=>$vendors]);
    }

}
