<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\order;
use App\Models\Product;
use App\Models\orderlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{

    public function pizzaList(Request $request){
        //logger($request->all());

        if($request->status=='desc'){
         $data=Product::orderBy('created_at','desc')->get();
        }
         else{
            $data=Product::orderBy('created_at','asc')->get();
         }
         return $data;
    }
    //add to cart
    public function addCart(Request $request){
        $data=$this->getOrderData($request);
        Cart::create($data);
        $response=[
            'message'=>'Add to cart completed',
            'status'=>'success'
        ];
        return response()->json($response, 200);

    }

    public function order(Request $request){
        $total=0;
        foreach($request->all() as $item){
             $data=orderlist::create([
                'user_id'=>$item['user_id'] ,
                'product_id'=>$item['product_id'],
                'quantity' =>$item['quantity'] ,
                'total'=>$item['total'] ,
                'orderCode'=>$item['orderCode'],
             ]);
             $total += $data->total;
         }
         Cart::where('user_id',Auth::user()->id)->delete();
         order::create([
            'user_id'=>Auth::user()->id,
            'orderCode'=>$data->orderCode,
            'total_price'=>$total+3000,
            'status'=>0

           ]);
        return response()->json([
            'status'=>'true',
            'message'=>'order complete'
        ],200);

        }
    //clear  cart
    public function clearCart(){
    Cart::where('user_id',Auth::user()->id)->delete();
    }
    //clear current cart
    public function clearCurrent(Request $request){
         Cart::where('user_id',Auth::user()->id)
            ->where('product_id',$request->productId)
            ->where('id',$request->orderId)
            ->delete();

    }
    //increase view count
    public function increaseViewCount(Request $request){
          $product=Product::where('id',$request->productId)->first();

          $viewCount=[
            'view_count'=>$product->view_count + 1
          ];
          Product::where('id',$request->productId)->update($viewCount);
    }
    //get order data
    public function getOrderData($request){
         return[
             'user_id'=>$request->userId,
             'product_id'=>$request->productId,
             'quantity'=>$request->count
         ];
    }
}
