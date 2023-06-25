@extends('admin.layouts.master')
@section('title','Category List Page')
@section('content')
 <!-- MAIN CONTENT-->
 <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{route('product#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                </div>
            </div>
            <div class="col-lg-6 offset-3">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">Create your Pizza</h3>
                        </div>
                        <hr>
                        <form action="{{route('product#create')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                <input id="cc-pament"  name="pizzaName" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter pizza name">
                            </div>
                             @error('pizzaName')
                            <small class="text-danger">{{$message}}</small>
                             @enderror

                             <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Category</label>
                                <select name="category" class="form-control" id="" >
                                    <option value="">Choose your category</option>
                                    @foreach ($categories as $c )
                                    <option value="{{$c->id}}">{{$c->name}}</option>

                                    @endforeach
                                </select>
                            </div>
                             @error('category')
                            <small class="text-danger">{{$message}}</small>
                             @enderror

                             <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Description</label>
                               <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
                            </div>
                             @error('description')
                            <small class="text-danger">{{$message}}</small>
                             @enderror

                             <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Image</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                             @error('image')
                            <small class="text-danger">{{$message}}</small>
                             @enderror

                             <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                <input id="cc-pament" value="{{old('waitingTime')}}" name="waitingTime" type="number" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter Waiting time">
                            </div>
                             @error('waitingTime')
                            <small class="text-danger">{{$message}}</small>
                             @enderror

                             <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Price</label>
                                <input id="cc-pament" value="{{old('price')}}" name="price" type="number" class="form-control" aria-required="true" aria-invalid="false" placeholder="Enter price">
                            </div>
                             @error('price')
                            <small class="text-danger">{{$message}}</small>
                             @enderror

                            <div>
                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                    <span id="payment-button-amount">Create</span>
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
