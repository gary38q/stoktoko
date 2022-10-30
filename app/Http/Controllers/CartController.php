<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class CartController extends Controller
{
    
    public function AddCart(Request $request, $SKU){

        $stock = $_GET['stock'];

        $valid = $request->validate([
            'Jumlah' => 'required'
        ]);

            $cart = new Cart();

            $carts = Cart::where('cart_SKU','=',$SKU)->count();

            $angkanya = Cart::where('cart_SKU','=',$SKU)->first();

            // Check Avaiable Stock
            if($valid['Jumlah'] > $stock){
                $message="Stock Tidak Cukup, Stock Saat ini tersisa ".$stock;
                echo "<script type='text/javascript'>alert('$message');
                window.location.replace('/');
                </script>";
            }

            else{
                // Update Cart
                if($carts == 1){

                    $akhir = $angkanya['Jumlah'] + $valid['Jumlah'];
                    if ($akhir > $stock){
                        $message="Stock Tidak Cukup, Stock Saat ini tersisa ".$stock;
                        echo "<script type='text/javascript'>alert('$message');
                        window.location.replace('/');
                        </script>";
                    }
                    else{
                        Cart::where('cart_SKU','=',$SKU)->update(['Jumlah' => $akhir]);

                        echo "<script type='text/javascript'>
                        window.location.replace('/');
                        </script>";
                    }
                }
                // Create Cart
                else{
                $cart->cart_SKU = $SKU;
                $cart->Jumlah = $valid['Jumlah'];
                $cart->save();
                echo "<script type='text/javascript'>
                window.location.replace('/');
                </script>";
                }
            }
    }

    public function D_Cart($ID){
        
        Cart::where('id','=',$ID)->delete();

        return redirect()->back();
    }

    public function U_Cart(){
        
    }

    public function delete_all(){
        Cart::truncate();

        return redirect()->back();
    }

}
