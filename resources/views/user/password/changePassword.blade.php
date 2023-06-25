@extends('user.layouts.master')
@section('title','Password Change Page')
@section('content')
 <!-- MAIN CONTENT-->
 <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">

            <div class="col-lg-6 offset-3">
                <a href="{{route('user#home')}}">
                    <i class="fa-solid fa-arrow-left text-dark mb-3 "></i>
                </a>
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Change Password</h3>
                        </div>
                     @if(session('notmatch'))
                        <div class="col-12">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-triangle-exclamation"></i>{{session('notmatch')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                        </div>
                        @endif

                        <form action="{{route('user#updateAccount',Auth::user()->id)}}" method="post" novalidate="novalidate">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                <input id="cc-pament" name="oldPassword" type="password" class="form-control  @error('oldpassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter old password">
                            </div>
                            @error('oldPassword')
                            <small class="text-danger">{{$message}}</small>
                        @enderror

                        <div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">New Password</label>
                                <input id="cc-pament" name="newPassword"  type="password" class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter new password">
                            </div>
                            @error('newPassword')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        <div>
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Comfirm Password</label>
                                <input id="cc-pament" name="comfirmPassword" type="password" class="form-control @error('comfirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter comfirm password">
                            </div>
                            @error('comfirmPassword')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block bg-dark">
                                    <span id="payment-button-amount"><i class="fa-solid fa-key me-2"></i>Change Password</span>
                                    {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                    <i class="fa-solid fa-circle-right"></i>
                                </button>
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
