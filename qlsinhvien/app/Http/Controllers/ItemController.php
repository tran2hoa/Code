<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Excel;
use App\Item;
use DB;
use Input;
use App\User;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('items');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

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
    }

    public function import(Request $request)
    {
        if($request->hasFile('imported-file')){
            $path = $request->file('imported-file')->getRealPath();
            $data=Excel::load($path)->get();
            // return $data;
            if(!empty($data) && $data->count()){
                foreach ($data->toArray() as $row){
                        if(!empty($row)){
                            $dataArray[] =
                            [
                              'item_name' => $row['name'],
                              'item_code' => $row['code'],
                              'item_price' => $row['price'],
                              'item_qty' => $row['quantity'],
                              'item_tax' => $row['tax'],
                              'item_status' => $row['status'],
                              'created_at' => $row['created_at']
                            ];
                        }
                }
                if(!empty($dataArray)){
                    Item::insert($dataArray);
                    return back();
                }
            }
        }
    }SDFTGYUIOP[Ư\

    public function export(){
        $items = User::all();
        Excel::create('items', function($excel) use($items) {
              $excel->sheet('ExportFile', function($sheet) use($items) {
                  $sheet->fromArray($items);
              });
        })->export('xls');
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
    }
}
