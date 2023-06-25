@extends('admin.layouts.master')
@section('title','Category List Page')
@section('content')
 <!-- MAIN CONTENT-->
 <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                 <div class="col-3">
                    @if(session('updatesuccess'))
            </div>
            <div class="col-4 offset-8">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check"></i>{{session('updatesuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            </div>
         @endif
                 </div>
            </div>
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change admin role</h3>
                        </div>


                <form action="{{route('admin#update',$account->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            @if($account->image==null)
                            <img src="{{asset('image/user_profile.webp')}}" />

                              @else
                            <img src="{{asset('storage/'.$account->image)}}" />
                            @endif

                            {{-- <div class="mt-3">
                                <input type="file"  class="form-control @error('image') is-invalid @enderror " name="image" >
                            </div>
                            @error('image')
                            <small class="text-danger">{{$message}}</small>
                            @enderror --}}

                            <div class="mt-3 ">
                                <button class="btn bg-dark text-white col-12" type="submit">
                                    Update
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                <input id="cc-pament" disabled name="name" value="{{old('name',$account->name)}}" type="text" class="form-control @error('name') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter new name">
                            </div>
                            @error('name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Email</label>
                                <input id="cc-pament" disabled name="email" value="{{old('email',$account->email)}}" type="text" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter new email">
                            </div>
                            @error('email')
                            <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Phone</label>
                                <input id="cc-pament" disabled name="phone" value="{{old('phone',$account->phone)}}" type="number" class="form-control @error('phone') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter new phone">
                            </div>
                            @error('phone')
                            <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Gender</label>
                                <select name="gender" disabled id="" class="form-control @error('gender') is-invalid @enderror">
                                    <option value="">Choose Gender</option>
                                    <option value="male" @if($account->gender=='male') selected @endif>Male</option>
                                    <option value="female" @if($account->gender=='female') selected @endif>Female</option>
                                </select>
                            </div>
                            @error('gender')
                            <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div class="form-group">
                                <label class="control-label mb-2">Address</label>
                                <textarea name="address" disabled id="" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror" placeholder="Enter new address">{{old('address',$account->address)}}</textarea>
                            </div>
                            @error('address')
                            <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Role</label>
                                <select name="role" id="">
                                    <option value="admin" @if($account->role=='admin') selected @endif>Admin</option>
                                    <option value="user" @if($account->role=='user') selected @endif>User</option>
                                </select>
                                {{-- <input id="cc-pament" name="role" value="{{old('role',$account->role)}}" type="number" class="form-control " aria-required="true" aria-invalid="false"  disabled> --}}
                            </div>
                        </div>
                        </div>


                       </div>
                </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
