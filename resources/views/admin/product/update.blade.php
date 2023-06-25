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
                            <h3 class="text-center title-2">Update Pizza</h3>
                        </div>


                <form action="{{route('product#update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <input type="hidden" name="pizzaId" value="{{$pizza->id}}">
                         <img src="{{asset('storage/'.$pizza->image)}}" />


                            <div class="mt-3">
                                <input type="file"  class="form-control @error('image') is-invalid @enderror " name="image" >
                            </div>
                            @error('image')
                            <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div class="mt-3 ">
                                <button class="btn bg-dark text-white col-12" type="submit">
                                    Update
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                <input id="cc-pament" name="pizzaName" value="{{old('pizzaName',$pizza->name)}}" type="text" class="form-control @error('pizzaName') is-invalid @enderror " aria-required="true" aria-invalid="false" placeholder="Enter new name">
                            </div>
                            @error('pizzaName')
                            <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Price</label>
                                <input id="cc-pament" name="price" value="{{old('price',$pizza->price)}}" type="text" class="form-control @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter new price">
                            </div>
                            @error('price')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Waiting time</label>
                                <input id="cc-pament" name="waitingTime" value="{{old('waitingTime',$pizza->waiting_time)}}" type="text" class="form-control @error('waitingtime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter waiting time">
                            </div>
                            @error('waitingTime')
                            <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">View count</label>
                                <input id="cc-pament" name="viewCount" value="{{old('viewCount',$pizza->view_count)}}" type="text" class="form-control @error('viewCount') is-invalid @enderror" aria-required="true"  disabled aria-invalid="false"  disabled>
                            </div>
                            @error('viewCount')
                            <small class="text-danger">{{$message}}</small>
                            @enderror


                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Category</label>
                                <select name="category" id="" class="form-control @error('category') is-invalid @enderror">
                                <option value="">Choose Category</option>
                                  @foreach ($category as $c )
                                  <option value="{{$c->id}}" @if($pizza->category_id==$c->id) selected @endif>{{$c->name}}</option>
                                  @endforeach
                                </select>
                            </div>
                            @error('category')
                            <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div class="form-group">
                                <label class="control-label mb-2">Description</label>
                                <textarea name="description" id="" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror" placeholder="Enter new description">{{old('description',$pizza->description)}}</textarea>
                            </div>
                            @error('description')
                            <small class="text-danger">{{$message}}</small>
                            @enderror

                            <div class="form-group">
                                <label for="cc-payment" class="control-label mb-1">Created date</label>
                                <input id="cc-pament" name="createdAt" disabled value="{{old('createdAt',$pizza->created_at->format('j-F-Y'))}}"  class="form-control " aria-required="true" aria-invalid="false" >
                            </div>
                            @error('createdAt')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
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
