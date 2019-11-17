<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PlayerController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function stateChange(Request $state){
        return 501;
    }
}
