<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //pizza list page
    public function list(){
        $pizzas=Product::select('products.*','categories.name as category_name')
        ->when(request('key'),function($query){
          $query->where('products.name','like','%'.request('key').'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')
        ->paginate(3);
        return view ('admin.product.pizzalist',compact('pizzas'));
    }
    public function createPage(){
        $categories=Category::select('id','name')->get();
        return view ('admin.product.create',compact('categories'));
    }



    public function create(Request $request){
      $this->productValidationCheck($request,"create");
      $data=$this->requestProductInfo($request);

        $fileName=uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public',$fileName);
        $data['image']=$fileName;

      Product::create($data);
      return redirect()->route('product#list');

    }


    //delete pizza
    public function delete($id){
        Product::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Delete success..']);
     }

     //edit pizza
     public function edit($id){
        $pizza=Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();
        return view('admin.product.pizzaEdit',compact('pizza'));
    }
    //updatePage pizza
    public function updatePage($id){
        $pizza=Product::where('id',$id)->first();
        $category=Category::get();
        return view('admin.product.update',compact('pizza','category'));
    }
    //update pizza
    public function update(Request $request){
          $this->productValidationCheck($request,"update");
          $data=$this->requestProductInfo($request);

          if($request->hasFile('image')){
            $oldImage=Product::where('id',$request->pizzaId)->first();
            $oldImage=$oldImage->image;


            $fileName=uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image']=$fileName;

          };
          Product::where('id',$request->pizzaId)->update($data);
         return redirect()->route('product#list');


    }
    private function requestProductInfo($request){
        return[
          'category_id'=>$request->category,
          'name'=>$request->pizzaName,
          'description'=>$request->description,
          'price'=>$request->price,
          'waiting_time'=>$request->waitingTime,
        ];
      }
    private function productValidationCheck($request,$action){
        $validationRules=[
            'pizzaName'=>'required|min:5|unique:products,name,'.$request->pizzaId,
            'category'=>'required',
            'description'=>'required',

            'price'=>'required',
            'waitingTime'=>'required'
        ];
        $validationRules['image']=$action=="create"?'required|mimes:png,jpg,jpeg,webp|file':'mimes:png,jpg,jpeg,webp|file';
        Validator::make($request->all(),$validationRules)->validate();
        }
}
