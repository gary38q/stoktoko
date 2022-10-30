<?php

namespace App\Http\Controllers;

use App\Models\historybarang;
use App\Http\Requests\StorehistorybarangRequest;
use App\Http\Requests\UpdatehistorybarangRequest;

class HistorybarangController extends Controller
{

    public function getHB(){

        $hisb = historybarang::orderBy('created_at', 'desc')->get();

        return view('backend.historybarang',compact('hisb'));
    }

}
