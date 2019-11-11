<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Receipt;
use Illuminate\Support\Facades\Config;
use App\ReceiptItem;


class ReceiptsController extends Controller
{
    const RECEIPT_TAG = 'receipt';

    private function json_formatter($count = '', $content = '')
    {
        return empty($content) ?
            array('Count' => $count) : array('Records_affected' => $count, 'Content' => $content);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $receipts = Receipt::all();
        foreach ($receipts as $receipt) {
            $receipt->receipt_item = ReceiptItem::where('receipt_id', $receipt['id'])->get();
        }
        return $receipts;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $receipts = $request->json()->get(self::RECEIPT_TAG);
        if (!$receipts) {
            abort(
                Config::get('constants.status.badRequest'),
                'Bad Request',
                Config::get('constants.jsonContentType')
            );
        }

        $row_count = 0;
        foreach ($receipts as $receipt) {
            Receipt::create($receipt);
            $row_count++;
        }
        return Receipt::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $receipt = Receipt::find($id);
        $receipt->receipt_item = ReceiptItem::where('receipt_id', $id)->get();
        return $receipt;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $receipts = $request->json()->get(self::RECEIPT_TAG);
        $row_count = 0;
        foreach ($receipts as $receipt) {
            $rece = Receipt::find($receipt['id']);
            if ($request->filled('description')){
                $rece->description = $receipt['description'];
            }
            if ($request->filled('remarks')) {
                $rece->remarks = $receipt['remarks'];
            }
            if ($request->filled('receipt_type_id')) {
                $rece->receipt_type_id = $receipt['receipt_type_id'];
            }
            if ($request->filled('user_id')) {
                $rece->user_id = $receipt['user_id'];
            }
            if ($request->filled('vendor_id')) {
                $rece->vendor_id = $receipt['vendor_id'];
            }
            $rece->save();
            $row_count++;
        }
        return response(
            $this->json_formatter($row_count),
            Config::get('constants.status.created'),
            Config::get('constants.jsonContentType')
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $receipt = Receipt::destroy($id);
        return $receipt == 1 ?
            response(['content'=> 'no'], Config::get('constants.status.noContent')) :
            response(['content not found'], Config::get('constants.status.notFound'));
    }
}
