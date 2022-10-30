<?php

namespace App\Http\Controllers;

use App\Models\history;
use App\Models\historyid;
use App\Models\Cart;
use App\Models\Produk;
use App\Http\Requests\StorehistoryRequest;
use App\Http\Requests\UpdatehistoryRequest;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class HistoryController extends Controller
{

    public function CreateH(){

        $carts = Cart::SELECT('*')->join('produks','produks.produk_SKU','=','carts.cart_SKU')->get();

        $invoice = date('y').date('m').date('d').date('H').date('i').date('s');
        $qty = Count($carts);
        $total = 0;
        foreach ($carts as $cart){
        $total = $total + ($cart->harga * $cart->Jumlah);
        }

        $historyid = new historyid();
        $historyid->id = $invoice;
        $historyid->total_qty = $qty;
        $historyid->total_harga = $total;
        $historyid->save();

        foreach($carts as $carts){

        $history = new history();
        $history->id = $invoice;
        $history->nama_produk = $carts->nama_produk;
        $history->jumlah = $carts->Jumlah;
        $history->harga = $carts->harga;
        $history->save();

        $hasilkurang = $cart->jumlah_stock - $cart->Jumlah;

        DB::table('produks')->where('produk_SKU','=', $cart->produk_SKU)->update([
            'jumlah_stock' => $hasilkurang
        ]);

        }

        return redirect('Print_out/'.$invoice);
    }

    public function getH(){
        $his = DB::table('historyids')->orderBy('id','desc')->get();
        
        return view('backend.history',compact('his'));
    }

    public function getdetail($id){
        $hisdetail = DB::table('histories')->where('id','=',$id)->get();

        return view('backend.historydetail',compact('hisdetail','id'));
    }

    public function print_out($id){
        $history = history::where('id','=',$id)->get();
        $hisTime = DB::table('histories')->select('created_at')->where('id','=',$id)->first();
        // echo strtotime($hisTime->created_at);

        // Custom Paper
        $customPaper = array(0,0,125,2000);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper($customPaper)->loadView('backend.print',compact('history','id','hisTime'));
        Cart::truncate();
        return $pdf->stream();
    }

}
