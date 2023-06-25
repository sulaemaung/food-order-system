{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>user home</h1>

    Role->{{Auth::user()->role}}
    <form action="{{route('logout')}}" method="post">
        @csrf
        <input type="submit" value="Logout">
        </form>
</body>
</html> --}}
@extends('user.layouts.master')
@section('content')

    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->

                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="d-flex align-items-center justify-content-between mb-3 bg-dark text-white p-2">

                            <label class="bg-dark text-white" for="price-all">Categories</label>
                            <span class="badge border font-weight-normal">{{count($category)}}</span>
                        </div>
                        <div class=" d-flex align-items-center justify-content-between mb-3">
                            <a href="{{route('user#home')}}">
                                <label class="text-dark" for="price-1">All</label>
                            </a>

                        </div>
                      @foreach ($category as $c )
                      <div class=" d-flex align-items-center justify-content-between mb-3">
                        <a href="{{route('user#filter',$c->id)}}">
                            <label class="text-dark" for="price-1">{{$c->name}}</label>
                        </a>

                    </div>
                      @endforeach
                    </form>
                </div>
                <!-- Price End -->


                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->

            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                 <a href="{{route('user#cartList')}}">
                                    <button type="button" class="btn btn-primary position-relative">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span class="position-absolute top-0 start-100 translate-middle p-1 mb-5 mx-2 bg-dark text-primary border border-light rounded-circle" >
                                           <span class="m-1">{{count($cart)}}

                                    </button>
                                 </a>
                                 <a href="{{route("user#history")}}">
                                    <button type="button" class="btn btn-primary position-relative ms-3">
                                         History
                                        <span class="position-absolute top-0 start-100 translate-middle p-1 mb-5 mx-2 bg-dark text-primary border border-light rounded-circle" >
                                           <span class="m-1">{{count($history)}}
                                    </button>
                                 </a>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" id="sortingOption" class="form-control">
                                        <option value="">Choose Option</option>
                                        <option value="asc">Asending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>

                <span id="productList" class="row">
                    @foreach ($product as $p )

                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1 " >
                        <div class="product-item bg-light mb-4"  id="myForm">
                            <div class="product-img position-relative overflow-hidden h-300">
                                <img class="img-fluid w-100 h-300" src="{{asset('storage/'.$p->image)}}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href="{{route('user#productDetails',$p->id)}}"><i class="fa fa-shopping-cart"></i></a>

                                 </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{$p->price}} kyats</h5>

                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </span>

                    {{-- <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="https://onecms-res.cloudinary.com/image/upload/s--sEfcyVTf--/c_crop%2Ch_717%2Cw_957%2Cx_153%2Cy_771/c_fill%2Cg_auto%2Ch_622%2Cw_830/f_auto%2Cq_auto/v1/mediacorp/cna/image/2022/04/01/final-2.jpeg?itok=urO6AS9r" alt="">
                                <!-- <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                </div> -->
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">Cheesy Pizza</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>20000 kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="https://danamic-media.danamic.org/danamic-production/2022/04/12003417/Chicken-Satay-Pizza-Top-1024x1024.jpg" alt="">
                                <!-- <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                </div> -->
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">Cheesy Pizza</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>20000 kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="https://d1sag4ddilekf6.azureedge.net/compressed_webp/items/SGITE20200407093514014750/detail/674be39ff1144d6e9f5db2211c92f067_1590056669449973127.webp" alt="">
                                <!-- <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                </div> -->
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">Cheesy Pizza</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>20000 kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="https://media-cdn.tripadvisor.com/media/photo-s/1a/62/fb/84/pizza-hut.jpg" alt="">
                                <!-- <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-sync-alt"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-search"></i></a>
                                </div> -->
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">Cheesy Pizza</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>20000 kyats</h5><h6 class="text-muted ml-2"><del>25000</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection
@section('scriptsource')
   <script>
    $(document).ready(function(){



    $('#sortingOption').change(function(){
           $eventOption= $('#sortingOption').val();


           if($eventOption=='asc'){
            $.ajax({
            type:'get',
            url:'http://127.0.0.1:8000/user/ajax/pizzaList',
            data:{'status':'asc'},
            datatype:'json',
            success:function(response){
                $list='';
                for($i=0;$i<response.length;$i++){
               $list+=` <div class="col-lg-4 col-md-6 col-sm-6 pb-1 " >
                        <div class="product-item bg-light mb-4"  id="myForm">
                            <div class="product-img position-relative overflow-hidden h-300">
                                <img class="img-fluid w-100 h-300" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="{{route('user#productDetails',$p->id)}}"><i class="fa-solid fa-circle-info"></i></a>

                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${response[$i].price} kyats</h5>

                                </div>

                            </div>
                        </div>
                    </div>

 `;
                }
                $('#productList').html($list);

            }
        })
        }else if($eventOption=='desc'){
            $.ajax({
            type:'get',
            url:'http://127.0.0.1:8000/user/ajax/pizzaList',
            data:{'status':'desc'},
            datatype:'json',
            success:function(response){
                $list='';
                for($i=0;$i<response.length;$i++){
               $list+=` <div class="col-lg-4 col-md-6 col-sm-6 pb-1 " >
                        <div class="product-item bg-light mb-4"  id="myForm">
                            <div class="product-img position-relative overflow-hidden h-300">
                                <img class="img-fluid w-100 h-300" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href="{{route('user#productDetails',$p->id)}}"><i class="fa-solid fa-circle-info"></i></a>

                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${response[$i].price} kyats</h5>

                                </div>

                            </div>
                        </div>
                    </div>



               `;
                }
                $('#productList').html($list);


            }
          })
           }
        })
    });




  </script>
@endsection



