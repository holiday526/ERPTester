<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receipt;
use App\ReceiptItem;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $receipts = Receipt::select("*")->get();
        $all_receipts_earn_total = array();
        $all_receipts_spend_total = array();
        foreach ($receipts as $receipt) {
            $total_spend = 0;
            $total_earn = 0;
            $receipt_item = ReceiptItem::where('receipt_id', $receipt['id'])->get();
            if ($receipt_item) {
                if ($receipt['expense']) {
                    foreach ($receipt_item as $item) {
                        $total_spend += strval($item['data']);
                    }
                    $all_receipts_spend_total[$receipt['id']] = $total_spend;
                } else {
                    foreach($receipt_item as $item) {
                        $total_earn += strval($item['data']);
                    }
                    $all_receipts_earn_total[$receipt['id']] = $total_earn;
                }
            }
        };
        return view(
            'layout.dashboard.index',
            ['total_spend'=>array_sum($all_receipts_spend_total), 'total_earn'=>array_sum($all_receipts_earn_total)]
        );
    }
}
