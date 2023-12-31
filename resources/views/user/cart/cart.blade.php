@extends('user.layouts.master')

@section('content')
<!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <a href="{{route('user#home')}}">
                <i class="fa-solid fa-arrow-left text-dark mb-3 "></i>
            </a>
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                       @foreach ($cartlist as $c)
                    <tr>
                        <td><img src="{{asset('storage/'.$c->product_image)}}" alt="" class="img-thumbnail shadow-sm" style="width: 150px;"></td>
                        <td class="align-middle">{{$c->product_name}}
                            <input type="hidden" class="orderId" value="{{$c->id}}">
                            <input type="hidden" class="productId" value="{{$c->product_id}}">
                            <input type="hidden" class="userId" value="{{$c->user_id}}">
                        </td>
                        <td class="align-middle" id="price">{{$c->product_price}} kyats</td>

                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{$c->quantity}}" id="qty">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle" id="total">{{$c->product_price*$c->quantity}} kyats</td>
                        <td class="align-middle">

                                <button class="btn btn-sm btn-danger btnRemove">
                                    Remove
                                </button>

                        </td>
                    </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotal">{{$totalprice}} kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery fee</h6>
                            <h6 class="font-weight-medium" >3000 kyats</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice">{{$totalprice+3000}} kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">Proceed To Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearBtn">Clear</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptsource')
    <script src="{{asset('js/cart.js')}}">
    </script>
    <script>
        $('#orderBtn').click(function(){
            $orderList=[];
            $random=Math.floor(Math.random()*1000000);
          $('#dataTable tbody tr').each(function(index,row){
            $orderList.push({
            'user_id': $(row).find('.userId').val(),
            'product_id': $(row).find('.productId').val(),
            'quantity':$(row).find('#qty').val(),
            'total':Number($(row).find('#total').html().replace('kyats','')),
            'orderCode':'POS'+$random
          });
        });

          $.ajax({
            type:'get',
            url: 'http://127.0.0.1:8000/user/ajax/order',
            data: Object.assign({},$orderList),
            datatype:'json',
            success:function(response){
                if(response.status=='true'){
                    window.location.href='http://127.0.0.1:8000/user/homePage';
                }
            }
        })

    })
    $('#clearBtn').click(function(){
        $.ajax({
            type:'get',
            url:'http://127.0.0.1:8000/user/ajax/clearCart',

            datatype:'json',

         })
        $('#dataTable tbody tr').remove();
        $('#subTotal').html(0+" kyats");
        $('#finalPrice').html(3000+"kyats");

    })
      //remove current cart
      $('.btnRemove').click(function(){
        $parentNode=$(this).parents('tr');
         $productId=$parentNode.find('.productId').val();
         $orderId=$parentNode.find('.orderId').val();

         $.ajax({
            type:'get',
            url:'http://127.0.0.1:8000/user/ajax/clearCurrent',
            data:{'productId':$productId,'orderId':$orderId},
            datatype:'json',

        })
        $parentNode.remove();
         $totalprice=0;
        $('#dataTable tbody tr').each(function(index,row){
          $totalprice+=Number($(row).find('#total').text().replace('kyats',''));
        });
        $('#subTotal').html($totalprice+" kyats");
        $('#finalPrice').html(`${$totalprice+3000} kyats`);
    })

    </script>
@endsection
