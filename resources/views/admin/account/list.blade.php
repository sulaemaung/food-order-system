@extends('admin.layouts.master')
@section('title','Category List Page')
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
                            <h2 class="title-1">Admin List</h2>

                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <a href={{route('category#createPage')}}>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                <i class="zmdi zmdi-plus"></i>Add Category
                            </button>
                        </a>
                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                            CSV download
                        </button>
                    </div>
                </div>
    {{-- Alert --}}
        @if(session('createSuccess'))
            </div>
            <div class="col-4 offset-8">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check"></i>{{session('createSuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            </div>
        @endif
        @if(session('deletesuccess'))
            </div>
            <div class="col-4 offset-8">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check"></i>{{session('deletesuccess')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            </div>
         @endif
    {{-- End Alert --}}
{{-- Search section --}}
<div class="row">
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
</div>
{{--End Search section --}}
<div class="row">
    <div class="col-1 offset-10 mt-3 bg-white shadow-sm text-center">
        <h3><i class="fa-solid fa-database"></i></h3>
    </div>
 </div>


                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Iamge</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Address</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($admins as $a)
                           <tr class="tr-shadow">
                            <input type="hidden" class="userId" value="{{$a->id}}">
                            <td class="col-2">
                                @if ($a->image==null)
                                    <img src="{{asset('image/user_profile.webp')}}"></td>
                                @else
                                    <img src="{{asset('storage/'.$a->image)}}"></td>
                                @endif
                            <td class="">{{$a->name}}</td>
                            <td class="">{{$a->email}}</td>
                            <td class="">{{$a->phone}}</td>
                            <td class="">{{$a->gender}}</td>
                            <td class="">{{$a->address}}</td>
                            <td class="">
                                <select name="" id="" class="form-control statusChange">
                                    <option value="user" @if ($a->role=='user') selected @endif>User</option>
                                    <option value="admin" @if ($a->role=='admin') selected @endif>Admin </option>
                                 </select>

                            </td>


                       <td>
                            <div class="table-data-feature text-center">
                               @if(Auth::user()->id==$a->id)

                                @else

                                <a href="{{route('admin#delete',$a->id)}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </a>
                                @endif


                            </div>
                         </td>
                        </tr></td></tr>
                         @endforeach
                        </tbody>
                    </table>


        {{-- Pagination --}}
               {{-- <div class="mt-3">
                   {{$admins->appends(request()->query())->links()}}
               </div> --}}
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
            url:'http://127.0.0.1:8000/changeRole',
            data: $data,
            datatype:'json',
        })
        location.reload();
        })

       })
    </script>
    @endsection()


