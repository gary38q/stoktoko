<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\history;
use App\Models\historybarang;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ProdukController extends Controller
{
    public function index(){
        $products = DB::table('produks')->get();
        // ->simplePaginate(8);
        $cart = Cart::SELECT('*')->join('produks','produks.produk_SKU','=','carts.cart_SKU')->get();
        return view('backend.index', compact('products','cart'));
    }

    public function history(){
        $history = history::all();
        return view('backend.history', compact('history'));
    }

    public function stock(){
        $product = Produk::all();
        return view('backend.stock', compact('product'));
    }

    public function addProduct(Request $request){

        $valid = $request->validate([
            'SKU' => 'required|unique:produks,produk_SKU',
            'NamaProduk' => 'required',
            'Harga' => 'required',
            'Stok' => 'required'
        ]); 
        $product = new Produk();
        $product->produk_SKU = $valid['SKU'];
        $product->nama_produk = $valid['NamaProduk'];
        $product->harga = $valid['Harga'];
        $product->jumlah_stock = $valid['Stok']; 
        $product->save();
        $message="Add New Product Success";
            echo "<script type='text/javascript'>alert('$message');     
            window.location.replace('/Product');
            </script>";
    }

    public function print_out(){
        $cart = Produk::join('carts','carts.cart_SKU','=','produks.produk_SKU')->get();

        // Custom Paper
        $customPaper = array(0,0,140,200);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->setPaper($customPaper)->loadView('backend.print',compact('cart'));

        return $pdf->stream();
    }

    public function update_prod(Request $request, $id){
        $update = $request->validate([
            'NamaProduk' => 'required',
            'Harga' => 'required'
        ]);

        Produk::where('produk_SKU','=',$id)
        ->update([
            'nama_produk'   => $update['NamaProduk'],
            'harga'         => $update['Harga']
        ]);

        $message="Update Success";
        echo "<script type='text/javascript'>alert('$message');
        window.location.replace('/Product');</script>";
        
    }

    public function delete_prod($id){
        Produk::where('produk_SKU','=',$id)->delete();
        Cart::where('cart_SKU','=',$id)->delete();
        
        return redirect()->action([ProdukController::class, 'stock']);
    }

    public function tambah_Stok(Request $request, $id){
        
        $valid = $request->validate([
            'pengirim' => 'required',
            'tstock' => 'required'
        ]);

        $curr_stock = DB::table('produks')->where('produk_SKU','=',$id)->first();
        
        $nama_produk = $curr_stock->nama_produk;
        $total_stock = $curr_stock->jumlah_stock + $valid['tstock'];

        Produk::where('produk_SKU','=',$id)
        ->update([
            'jumlah_stock'   => $total_stock
        ]);

        $historyB = new historybarang();
        $historyB->nama_produk = $nama_produk;
        $historyB->Pengirim = $valid['pengirim'];
        $historyB->Jumlah = $valid['tstock'];
        $historyB->save();

        return back();
        
    }
}