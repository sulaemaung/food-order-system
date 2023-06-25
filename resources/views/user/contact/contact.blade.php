@extends('user.layouts.master')
@section('title','Account Page')
@section('content')

   {{-- Contact  --}}
   <div class="row">
     <div class="col-8 offset-2 bg-primary p-4">
        <form action="{{route('user#contactInfo')}}" method="post" >
             <h2 class="text-center mb-3">Contacting with us</h2>
            @csrf
            <div class="form-group"><input type="text" name="name" class="form-control" placeholder="Name"></div>
            @error('name')
            <small class="text-dark">{{$message}}</small>
            @enderror

            <div class="form-group"> <input type="email" name="email" class="form-control" placeholder="Email"></div>
            @error('email')
            <small class="text-dark">{{$message}}</small>
            @enderror

            <div class="form-group"> <textarea  id="" class="form-control" name="message" cols="30" rows="10" placeholder="Your Message"></textarea></div>
            @error('message')
            <small class="text-dark">{{$message}}</small>
            @enderror
            <button class="btn bg-dark text-white text-center float-end" type="submit">Send Message</button>

        </form>
     </div>
   </div>
@endsection

