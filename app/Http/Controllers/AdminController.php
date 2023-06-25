<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    //change passowrd page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }
    //direct admin detail page
     public function details(){
        return view('admin.account.deatails');
     }
      //direct admin profile page
      public function edit(){
        //Auth::user()->id
        return view('admin.account.edit');
     }
     //update account
     public function update($id,Request $request){
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
       return redirect()->route('admin#details')->with(['updatesuccess'=>'Account Updated']);
     }
     //admin list
     public function list(){
       $admins= User::when(request('key'),function($query){
        $query->orwhere('users.name','like','%'.request('key').'%')
              -> orwhere('users.email','like','%'.request('key').'%')
              -> orwhere('users.gender','like','%'.request('key').'%')
              -> orwhere('users.phone','like','%'.request('key').'%')
              -> orwhere('users.address','like','%'.request('key').'%');
      })
      ->where('role','admin')->get();
       return view('admin.account.list',compact('admins'));
     }
     //delete admin
     public function delete($id){
         User::where('id',$id)->delete();
         return redirect()->route('admin#list')->with(['deletesuccess'=>'Admin account deleted']);
     }
     //contact list page
     public function contactListPage(){
        $contactList= Contact::orderBy('created_at','desc')->get();
        return view('admin.contact.list',compact('contactList'));
     }

     //change role
     public function changeRole(Request $request){
         $updateRole=[
            'role'=>$request->role
         ];
         User::where('id',$request->userId)->update($updateRole);
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
     //account validation check
     private function accountValidationCheck($request){
        Validator::make($request->all(),[
         'name'=>'required',
         'email'=>'required',
         'phone'=>'required',
         'gender'=>'required',
         'image'=>'mimes:png,jpg,jpeg,webp|file',
         'address'=>'required'
        ])->validate();
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
    //check password validation
    private function passwordValidationCheck($request){
         Validator::make($request->all(),[
          'oldPassword'=>'required|min:5',
          'newPassword'=>'required|min:5',
          'comfirmPassword'=>'required|min:5|same:newPassword'
         ])->validate();



    }
}
