<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
  //get product list
  public function productList(){
    $products=Product::get();
    $category=Category::get();
    $user=User::get();
    $data=[
        'product'=>$products,
        'category'=>$category,
        'user'=>$user
    ];
    return response()->json($data,200);
  }

  //create category
  public function createCategory(Request $request){
        $data=[
            'name'=>$request->name,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()

        ];
        Category::create($data);
        return response()->json($data,200);

  }
  //create contact
  public function createContact(Request $request){
        $data=[
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()

        ];
        Contact::create($data);
        return response()->json($data,200);

  }
  //delete category
  public function deleteCategory(Request $request){
    $data=Category::where('id',$request->category_id)->first();

    if(isset($data)){
        Category::where('id',$request->category_id)->delete();
        return response()->json(['status'=>'true','messsage'=>'Delete success'],200);
    }
    return response()->json(['status'=>'false','messsage'=>'There is no category'],200);
  }
    //update category
    public function updateCategory(Request $request){
        $dbSource=Category::where('id',$request->category_id)->first();

        if(isset($dbSource)){
            $data=[
                'name'=>$request->category_name,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ];
            Category::where('id',$request->category_id)->update($data);
            $response=Category::where('id',$request->category_id)->first();
            return response()->json(['status'=>'true','category'=>$response],200);
        }
        return response()->json(['status'=>'false','messsage'=>'There is no category for update'],200);
      }
}
