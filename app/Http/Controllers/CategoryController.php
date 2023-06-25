<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // //direct category list page
    // public function listPage(){
    //     return view('category.list');
    // }


    //direct category list page
    public function listPage(){
        $categories=Category::when(request('key'),function($query){
                    $query->where('name','like','%'.request('key').'%');
        })
        ->orderBy('created_at','desc')
        ->paginate(4);
        return view('admin.category.list',compact('categories'));
    }

    //direct category create page
    public function createPage(){
        return view('admin.category.create');
    }

    //create category
    public function create(Request $request){
          $this->categoryValidationCheck($request);
          $data=$this->requestCategoryData($request);

        Category::create($data);
        return redirect()->route('category#list')->with(['createSuccess'=>'Category created..!']);
    }
    //edit category
    public function edit($id){
        $category=Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    //update category
    public function update(Request $request){
        $this->categoryValidationCheck($request);
        $data=$this->requestCategoryData($request);

        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#list');
    }

    //delete category
    public function delete($id){
       Category::where('id',$id)->delete();
       return back()->with(['deleteSuccess'=>'Delete success..']);
    }
    //category validation check
    private function categoryValidationCheck($request){
         Validator::make($request->all(),[
           'categoryName'=>'required|unique:categories,name,'.$request->id,
         ])->validate();
    }

    //request category data
    private function requestCategoryData($request){
        return [
            'name'=>$request->categoryName
        ];
    }
}
