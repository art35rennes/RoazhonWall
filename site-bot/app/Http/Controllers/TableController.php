<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class TableController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function show($table){

        $header = \DB::connection()->getSchemaBuilder()->getColumnListing($table);
        $data = DB::table($table)->get();

        return view('table', ['headers'=>$header, 'datas'=>$data, 'table'=>$table]);
    }
}
