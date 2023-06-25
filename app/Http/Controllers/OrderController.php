<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\orderlist;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //direct order page
    public function list(){
        $order=order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','orders.user_id')
        ->orderBy('created_at','desc')->get();
        return view('admin.order.list',compact('order'));
    }
    //sort with ajax
    public function changeStatus(Request $request){

        $order=order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','orders.user_id')
        ->orderBy('created_at','desc');

         if( $request->orderStatus==null){
            $order=$order->get();
         }
         else{
            $order=$order->where('orders.status',$request->orderStatus)->get();
         }

        return view('admin.order.list',compact('order'));
        }
        public function dbChangeStatus(Request $request){
         order::where('id',$request->orderId)->update([
            'status'=>$request->status
         ]);
        $order=order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','orders.user_id')
        ->orderBy('created_at','desc')->get();
        return response()->json($order,200);

        }
        public function listInfo(){
          $orderlist=orderlist::select('orderlists.*','users.id as user_id','users.name as user_name','products.image as image',
          'products.name as product_name','orders.id as order_id','orders.total_price as total')
                    ->leftJoin('users','users.id','orderlists.user_id')
                    ->leftJoin('orders','orders.user_id','orderlists.user_id')
                    ->leftJoin('products','products.id','orderlists.product_id')->get();

               // dd($orderlist->toArray());
        return view('admin.order.listInfo',compact('orderlist'));
        }
}
