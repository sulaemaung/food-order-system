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
                            <h2 class="title-1">Contact List</h2>

                        </div>
                    </div>

                </div>

                {{-- @if(count($categories)!=0) --}}
                  <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($contactList as $c)
                           <tr class="tr-shadow">

                             <td>{{$c->name}}</td>
                             <td>{{$c->email}}</td>
                             <td>{{$c->message}}</td>
                             <td>{{$c->created_at}}</td>
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
{{-- @section('scriptsection')
    <script>
        $(document).ready(function(){

          $('.statusChange').change(function(){

            $current=$(this).val();
            $parentNode=$(this).parents('tr');
            $userId=$parentNode.find('.userId').val();
            console.log($userId);
            $data={

                'userId':$userId,
                'role': $current,
          };


          $.ajax({
            type:'get',
            url:'http://127.0.0.1:8000/user/changeRole',
            data: $data,
            datatype:'json',
        })
        location.reload();
        })

       })
    </script>
    @endsection() --}}
