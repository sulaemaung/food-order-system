<?php

namespace App\Http\Controllers;

use Storage;

use App\Models\Cart;
use App\Models\User;
use App\Models\order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home
    public function home(){
        $product=Product::orderBy('created_at','desc')->get();
        $category=Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        $history=order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('product','category','cart','history'));
    }
    //password change Page
    public function changePasswordPage(){
       return view('user.password.changePassword');
    }
     //change passowrd
     public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
        $user=User::select('password')->where('id',Auth::user()->id)->first();
        $dbHashValue=$user->password;

        if(Hash::check($request->oldPassword,$dbHashValue)){
          $data=[
             'password'=>Hash::make($request->newPassword)
          ];
          User::where('id',Auth::user()->id)->update($data);
          Auth::logout();
          return redirect()->route('auth#loginPage');
        }

        return back()->with(['notmatch'=>'Tho old password not match.Try again!..']);
    }

    //account page
    public function changeAccountPage(){
            return view('user.account.edit');
        }
    //update account
    public function updateAccount($id,Request $request){
           $this->accountValidationCheck($request);
           $data=$this->getUserData($request);

         if($request->hasFile('image')){
           $dbImage=User::where('id',$id)->first();
           $dbImage=$dbImage->image;

           if($dbImage!=null){
            Storage::delete('public/'.$dbImage);
          }

           $fileName=uniqid().$request->file('image')->getClientoriginalName();

           $request->file('image')->storeAs('public',$fileName);
           $data['image']=$fileName;


       }
       User::where('id',$id)->update($data);
       return back()->with(['updatesuccess'=>'Account Updated']);
     }
     public function filter($categoryId){
        $product=Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $category=Category::get();

        $history=order::where('user_id',Auth::user()->id)->get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('product','category','cart','history'));
     }
     //direct product detail
     public function productDetails($id){
        $product=Product::where('id',$id)->first();
        $productList=Product::get();
        return view('user.main.deatail',compact('product','productList'));
     }
     //cart list
     public function cartList(){
        $cartlist=Cart::select('carts.*','products.name as product_name','products.price as product_price','products.image as product_image')
                       ->leftJoin('products','products.id','carts.product_id')
                       ->where('carts.user_id',Auth::user()->id)->get();

        $totalprice=0;
        foreach($cartlist as $c){
            $totalprice+=$c->product_price*$c->quantity;
        }
        return view('user.cart.cart',compact('cartlist','totalprice'));
     }
     //history cart
     public function history(){
        $order=order::where('user_id',Auth::user()->id)->paginate('6');
        return view('user.cart.history',compact('order'));
     }
     //user list
     public function list(Request $request){
        $userlist=User::where('role','user')->get();
         //dd($userlist->toArray());
        return view('admin.userlist.list',compact('userlist'));
     }

     //user change role
     public function changeRole(Request $request){
      //  logger($request->all());
        $updateRole=[
            'role'=>$request->role
        ];
          User::where('id',$request->userId)->update($updateRole);
     }
      //contact page
      public function contact(){
        return view('user.contact.contact');
     }
     //get contact info
     public function contactInfo(Request $request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'message'=>'required'

           ])->validate();

          Contact::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
            'updated_at'=>Carbon::now()

           ]);
     return redirect()->route('user#contact');

     }

     //request user data
     private function getUserData($request){
        return[
          'name'=>$request->name,
          'email'=>$request->email,
          'phone'=>$request->phone,
          'gender'=>$request->gender,
          'address'=>$request->address,
          'updated_at'=>Carbon::now()
        ];
      }

     //check password validation
     private function passwordValidationCheck($request){
          Validator::make($request->all(),[
           'oldPassword'=>'required|min:5',
           'newPassword'=>'required|min:5',
           'comfirmPassword'=>'required|min:5|same:newPassword'
          ])->validate();
     }

      //account validation check
      private function accountValidationCheck($request){
        Validator::make($request->all(),[
         'name'=>'required',
         'email'=>'required',
         'phone'=>'required',
         'gender'=>'required',
         'image'=>'mimes:png,jpg,jpeg,webp|file',
         'address'=>'required',
         'message'=>'required'

        ])->validate();
        }
}
