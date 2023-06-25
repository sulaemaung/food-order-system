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
                            <h2 class="title-1">User List</h2>

                        </div>
                    </div>

                </div>

                {{-- @if(count($categories)!=0) --}}
                  <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($userlist as $u)
                           <tr class="tr-shadow">
                            <input type="hidden" class="userId" value="{{$u->id}}">
                             <td class="col-2">
                                @if ($u->image==null)
                                    <img src="{{asset('image/user_profile.webp')}}"></td>
                                @else
                                    <img src="{{asset('storage/'.$u->image)}}"></td>
                                @endif
                             <td>{{$u->name}}</td>
                             <td>{{$u->email}}</td>
                             <td>{{$u->gender}}</td>
                             <td>{{$u->phone}}</td>
                             <td>{{$u->address}}</td>
                             <td><select name="" id="" class="form-control statusChange">
                                <option value="user" @if ($u->role=='user') selected @endif>User</option>
                                <option value="admin"  @if ($u->role=='admin') selected @endif>Admin </option>
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
    @endsection()

