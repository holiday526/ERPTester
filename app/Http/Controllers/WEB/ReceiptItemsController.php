<?php

namespace App\Http\Controllers\WEB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;

class ReceiptItemsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
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

    public function delete($receipt_id, $delete_id){
        $receipt = app("App\Http\Controllers\API\ReceiptItemsController")->destroy($delete_id);
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

}
