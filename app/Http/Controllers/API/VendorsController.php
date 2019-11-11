<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use App\Vendor;

class VendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Vendor::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|alpha_num',
        ]);
        if ($validator->fails()) {
            return response(['status' => 'fail'], Config::get('constants.status.badRequest'));
        }
        $vendor = Vendor::firstOrCreate(['name' => $request->name]);
        return Vendor::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // support both name and id search
        $vendor = Vendor::find($id);
        if (empty($vendor)) {
            $vendor = Vendor::where('name', $id)
                            ->orWhere('name', 'like', '%'.$id.'%')
                            ->get();
        }
        return isset($vendor) ? response($vendor, Config::get('constants.status.ok')) : response(['success' => false], Config::get('constant.status.notFound'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $vendor = Vendor::find($id);
        if (empty($vendor)) {
            return response(['status'=> false], Config::get('constants.status.notFound'));
        }
        $vendor->name = $request->name;
        $vendor->save();
        return response(['status'=>true, 'vendor'=>$vendor], Config::get('constants.status.ok'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $vendor = Vendor::destroy($id);
        return $vendor == 1 ?
            response(['content'=> 'no'], Config::get('constants.status.noContent')) :
            response(['content not found'], Config::get('constants.status.notFound'));
    }
}
