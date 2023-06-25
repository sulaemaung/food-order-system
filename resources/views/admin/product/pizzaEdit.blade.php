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
                        <div>
                           {{-- <a href="{{route('product#list')}}"> --}}
                            <i class="fa-solid fa-arrow-left text-dark " onclick="history.back()"></i>
                           {{-- </a> --}}
                        </div>

                   <div class="row">
                    <div class="col-3 offset-1">

                        <img src="{{asset('storage/'.$pizza->image)}}" />

                    </div>
                    <div class="col-5 offset-1 ">
                        <h2 class="my-2 text-danger">{{$pizza->name}}</h2>
                        <span class="my-2 btn bg-dark text-white"><i class="fs-4 fa-solid fa-money-bill me-2"></i>{{$pizza->price}} kyats</span>
                        <span class="my-2 btn bg-dark text-white"><i class="fs-4 fa-regular fa-clock me-2"></i>{{$pizza->waiting_time}} mins</span>
                        <span class="my-2 btn bg-dark text-white"><i class="fs-4 fa-solid fa-eye me-2"></i>{{$pizza->view_count}}</span>
                        <span class="my-2 btn bg-dark text-white"><i class="fa-solid fa-list me-2"></i>{{$pizza->category_name}}</span>
                        <span class="my-2 btn bg-dark text-white"><i class="fs-4 fa-solid fa-calendar-days me-2"></i>{{$pizza->created_at->format('j-F-Y')}}</span>
                        <div class="my-2"><i class="fs-4 fa-solid fa-file-lines me-2"></i>Details </div>
                        <div> {{$pizza->description}}</div>

                    </div>
                    </div>

                    <div class="row">
                        <div class="col-3 offset-9">
                            <a href="{{route('product#updatePage',$pizza->id)}}">
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
