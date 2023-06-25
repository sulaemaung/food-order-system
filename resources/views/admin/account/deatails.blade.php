@extends('admin.layouts.master')
@section('title','Category List Page')
@section('content')
 <!-- MAIN CONTENT-->
 <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">

            </div>
            <div class="col-lg-10 offset-1">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Account Info</h3>
                        </div>
                   <div class="row">
                    <div class="col-3 offset-1">
                        @if(Auth::user()->image==null)
                            <img src="{{asset('image/user_profile.webp')}}" />

                        @else
                        <img src="{{asset('storage/'.Auth::user()->image)}}" />
                        @endif
                    </div>
                    <div class="col-5 offset-1 ">
                        <h4 class="my-2"><i class="fa-solid fa-user-pen me-2"></i>{{Auth::user()->name}}</h4>
                        <h4 class="my-2"><i class="fa-solid fa-envelope me-2"></i>{{Auth::user()->email}}</h4>
                        <h4 class="my-2"><i class="fa-solid fa-phone me-2"></i>{{Auth::user()->phone}}</h4>
                        <h4 class="my-2"><i class="fa-solid fa-venus-mars me-2"></i>{{Auth::user()->gender}}</h4>
                        <h4 class="my-2"><i class="fa-sharp fa-solid fa-location-dot me-2"></i>{{Auth::user()->address}}</h4>
                        <h4 class="my-2"><i class="fa-solid fa-calendar-days me-2"></i>{{Auth::user()->created_at->format('j-F-Y')}}</h4>
                    </div>
                    </div>

                    <div class="row">
                        <div class="col-3 offset-9">
                            <a href="{{route('admin#edit')}}">
                                <button class="btn bg-dark text-white">
                                    <i class="fa-solid fa-pen-to-square me-2"></i>Edit Profile
                                </button>
                            </a>
                        </div>
                    </div>
                   </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
