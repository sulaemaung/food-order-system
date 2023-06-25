@extends('admin.layouts.master')
@section('title','Order List Page')
@section('content')
 <!-- MAIN CONTENT-->
 <div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Order List</h2>

                        </div>
                    </div>

                </div>

{{-- Search section --}}
{{-- <div class="row">
  <div class="col-3">
          <h4 class="text-secondry">Search key::
             <span class="text-danger">{{request('key')}}</span>
          </h4>
   </div>
  <div class="col-3 offset-6 ">
        <form action="" method="get">
            <div class="d-flex">
             <input type="text" name="key" class="form-control" placeholder="Search.." value="{{request('key')}}">
                <button class="btn bg-dark text-white">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </form>
    </div>
</div> --}}
{{--End Search section --}}

        <div class="row">
            <div class="col-6">
                <form action="{{route('order#changeStatus')}}" method="get">
                    @csrf
                    <div class="d-flex">
                        <label for="" class="fs-3">Order status</label>
                          <select name="orderStatus"  class="form-control col-2 ms-3 mb-3">
                            <option value="">All</option>
                            <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending</option>
                            <option value="1" @if (request('orderStatus') == '1') selected @endif>Accept</option>
                            <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject</option>
                          </select>
                          <button type="submit" class="btn bg-dark text-white mb-2">Search</button>

                    </div>
                  </form>
            </div>
            <div class="col-4">
                <div class="col-3 offset-10  bg-white shadow-sm text-center">
                    <h3><i class="fa-solid fa-database  m-2"></i>{{count($order)}}</h3>
                </div>
              </div>

        </div>
                {{-- @if(count($categories)!=0) --}}
                  <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>User Id</th>
                                <th>User Name</th>
                                <th>Order Date</th>
                                <th>Order Code</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="orderList">
                           @foreach ($order as $o)
                           <tr class="tr-shadow">
                            <input type="hidden" name="" class="orderId" value="{{$o->id}}">
                             <td>{{$o->user_id}}</td>
                             <td>{{$o->user_name}}</td>
                             <td>{{$o->created_at->format('F-j-Y')}}</td>
                             <td><a href="{{route('order#listInfo')}}">{{$o->orderCode}}</a></td>
                             <td>{{$o->total_price}}</td>
                             <td>
                                <select name="status" class="form-control statusChange">
                                    <option value="0" @if ($o->status== '0') selected @endif>Pending</option>
                                    <option value="1" @if ($o->status== '1') selected @endif>Accept</option>
                                    <option value="2" @if ($o->status== '2') selected @endif>Reject</option>
                                </select>
                             </td>

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
@section('scriptsection')
    <script>
        $(document).ready(function(){
        //   $('#orderStatus').change(function(){
        //     $status=$('#orderStatus').val();

        //     $.ajax({
        //     type:'get',
        //     url:'http://127.0.0.1:8000/order/status',
        //     data:{
        //         'status' : $status,
        //     },
        //     datatype:'json',
        //     success:function(response){
        //         $list='';
        //         for($i=0;$i<response.length;$i++){
        //             $months=['January'.'February','March','April','May','June','July','August','September','November','December'];
        //             $dbDate=new Date(response[$i].created_at);
        //             $finalDate=$months[$dbDate.getMonth()] +'-'+ $dbDate.getDate() +"-"+ $dbDate.getFullYear();
        //             if(response[$i].status==0){
        //                 $statusMessage=`
        //                 <select name="status" id="statusChange" class="form-control text-align-center">
        //                             <option value="0" selected >Pending</option>
        //                             <option value="1" >Accept</option>
        //                             <option value="2" >Reject</option>
        //                         </select>
        //                 `;
        //             }else if(response[$i].status==1){
        //                 $statusMessage=`
        //                 <select name="status" id="statusChange" class="form-control text-align-center">
        //                             <option value="0" >Pending</option>
        //                             <option value="1"selected  >Accept</option>
        //                             <option value="2" >Reject</option>
        //                         </select>
        //                 `;
        //             }
        //             else if(response[$i].status==2){
        //                 $statusMessage=`
        //                 <select name="status" id="statusChange" class="form-control text-align-center">
        //                             <option value="0" >Pending</option>
        //                             <option value="1" >Accept</option>
        //                             <option value="2" selected >Reject</option>
        //                         </select>
        //                 `;
        //             }

        //          $list+=`   <tr class="tr-shadow">
        //                      <input type="hidden" name="" class="orderId" value="${response[$i].id}">
        //                      <td>${response[$i].user_id}</td>
        //                      <td>${response[$i].user_name}</td>
        //                      <td>${$finalDate}</td>
        //                      <td>${response[$i].orderCode}</td>
        //                      <td>${response[$i].total_price}</td>
        //                      <td>${$statusMessage}</td>

        //                    </tr>

        //        `;
        //         }
        //         $('#orderList').html($list);
        //     }

        //   })


        //   })
          $('.statusChange').change(function(){

            $current=$(this).val();
            $parentNode=$(this).parents('tr');
            $orderId=$parentNode.find('.orderId').val();
            $data={
                'status':$current,
                'orderId':$orderId
          };


          $.ajax({
            type:'get',
            url:'http://127.0.0.1:8000/order/dbChangeStatus',
            data: $data,
            datatype:'json',
        })
        })

        })
    </script>
@endsection()
