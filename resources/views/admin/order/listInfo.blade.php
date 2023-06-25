@extends('admin.layouts.master')
@section('title','Order List Page')
@section('content')
 <!-- MAIN CONTENT-->
 <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">


            {{-- Order Info --}}
               <div class="row col-5">
                <div class="card">
                    <div class="card-body">
                     <h3><i class="fa-solid fa-clipboard-list me-2"></i>Order Info</h3>
                     <h5 class="text-warning"><i class="fa-sharp fa-solid fa-circle-exclamation me-2 text-warning"></i>Include delivery charges</h5>
                    </div>
                     <div class="row  mb-3 ms-2">
                        <div class="col"><i class="fa-solid fa-user me-2"></i>Name</div>
                        <div class="col">{{strtoupper($orderlist[0]->user_name)}}</div>
                     </div>
                     <div class="row  mb-3 ms-2">
                        <div class="col"><i class="fa-solid fa-barcode me-2"></i>Order Code</div>
                        <div class="col">{{$orderlist[0]->orderCode}}</div>
                     </div>
                     <div class="row  mb-3 ms-2">
                        <div class="col"><i class="fa-regular fa-calendar-days me-2"></i>Order Date</div>
                        <div class="col">{{$orderlist[0]->created_at}}</div>
                     </div>
                     <div class="row  mb-3 ms-2">
                        <div class="col"><i class="fa-solid fa-money-bill me-2"></i>Total</div>
                        <div class="col">{{$orderlist[0]->total}}</div>
                     </div>
                  </div>
               </div>

            {{--End Order Info --}}
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order List</h2>

                        </div>
                    </div>

                </div>

                {{-- @if(count($categories)!=0) --}}
                  <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Product image</th>
                                <th>Product name</th>
                                <th>Order date</th>
                                <th>Amount</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($orderlist as $o)
                           <tr class="tr-shadow">

                             <td>{{$o->order_id}}</td>
                             <td class="col-2"><img src="{{asset('storage/'.$o->image)}}"></td>
                             <td>{{$o->product_name}}</td>
                             <td>{{$o->created_at->format('F-j-Y')}}</td>
                             <td>{{$o->total}}</td>
                             <td>{{$o->quantity}}</td>


                           </tr>
                           @endforeach
                        </tbody>
                    </table>

        {{-- Pagination --}}

        {{--End Pagination --}}

                {{-- </div>
                @else
                  <h3 class="text-secondary text-center mt-5">There is no Category here!</h3>
                @endif --}}


                <!-- END DATA TABLE -->

            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection


