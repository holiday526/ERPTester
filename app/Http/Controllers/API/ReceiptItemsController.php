<?php

namespace App\Http\Controllers\API;

use App\ReceiptItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class ReceiptItemsController extends Controller
{

    const FALSE_RETURN = ['status' => false];
    const RECEIPT_ITEMS_TAG = 'receipt_items';

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
        return ReceiptItem::all();
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
        $receipt_items = $request->json()->get(self::RECEIPT_ITEMS_TAG);
        if (!$receipt_items) {
            abort(
                Config::get('constants.status.badRequest'),
                'Bad Request',
                Config::get('constants.jsonContentType')
            );
        }

        $row_count = 0;
        foreach ($receipt_items as $item) {
            ReceiptItem::create($item);
            $row_count++;
        }
        return response(
            $this->json_formatter($row_count),
            Config::get('constants.status.created'),
            Config::get('constants.jsonContentType')
        );
    }

//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id == $receipt_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /* $id == $receipt_id */
        $receipt_items = $request->json()->get(self::RECEIPT_ITEMS_TAG);
        $row_count = 0;
        foreach ($receipt_items as $item) {
            // $item['id'] is 'receipt_items.id'
            $receipt_item = ReceiptItem::find($item['id']);
            $receipt_item->description = $item['description'];
            $receipt_item->data = $item['data'];
            $receipt_item->save();
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
        $receipt_item = ReceiptItem::destroy($id);
        return $receipt_item == 1 ?
            response(['content'=> 'no'], Config::get('constants.status.noContent')) :
            response(['content not found'], Config::get('constants.status.notFound'));
    }
}
