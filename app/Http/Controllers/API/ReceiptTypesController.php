<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;
use App\ReceiptType;

class ReceiptTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return ReceiptType::all();
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
        $validator = Validator::make($request->all(), [
            'description' => 'required|alpha_num',
        ]);
        if ($validator->fails()) {
            return response(['status' => 'fail'], Config::get('constants.status.badRequest'));
        }
        $receipt_type = ReceiptType::firstOrCreate(['description' => $request->description]);
        return ReceiptType::all();
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
//        $receipt_type = ReceiptType::find($id);
//        return isset($receipt_type) ?
//            response($receipt_type, Config::get('constants.status.ok')) :
//            response(['success' => false], Config::get('constant.status.notFound'));
//    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $receipt_type = ReceiptType::find($id);
        if (empty($receipt_type)) {
            return response(['status'=> false], Config::get('constants.status.notFound'));
        }
        $receipt_type->description = $request->description;
        $receipt_type->save();
        return response(['status'=>true, 'receipt_type'=>$receipt_type], Config::get('constants.status.ok'));
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
        $receipt_type = ReceiptType::destroy($id);
        return $receipt_type == 1 ?
            response(['content'=> 'no'], Config::get('constants.status.noContent')) :
            response(['content not found'], Config::get('constants.status.notFound'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateFromWeb(Request $request)
    {
        //
        $receipt_type = ReceiptType::find($request['id']);
        $receipt_type->description = $request->description;
        $receipt_type->save();
        return redirect('/type');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createType(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'description' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response(['status' => 'fail'], Config::get('constants.status.badRequest'));
        }
        $receipt_type = ReceiptType::firstOrCreate(['description' => $request->description]);
        return redirect('/type');
    }
}
