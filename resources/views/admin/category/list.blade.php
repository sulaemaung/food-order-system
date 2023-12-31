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
                            <h2 class="title-1">Category List</h2>

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
        @if(session('deleteSuccess'))
            </div>
            <div class="col-4 offset-8">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check"></i>{{session('deleteSuccess')}}
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
        <h3><i class="fa-solid fa-database"></i>{{$categories->total()}}</h3>
    </div>
 </div>

                @if(count($categories)!=0)
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Category Name</th>
                                <th>Created Date</th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($categories as $category)
                           <tr class="tr-shadow">
                            <td>{{$category->id}}</td>
                            <td class="col-6">{{$category->name}}
                            </td>
                            <td>{{$category->created_at->format('j-F-Y')}}</td>
                         <td>
                            <div class="table-data-feature text-center">

{{--
                                <button class="item " data-toggle="tooltip" data-placement="top" title="View">
                                        <i class="fa-sharp fa-solid fa-eye "></i>
                                </button> --}}

                               <a href="{{route('category#edit',$category->id)}}">
                                <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                               </a>
                                <a href="{{route('category#delete',$category->id)}}">
                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </a>


                            </div>
                         </td>
                        </tr></td></tr>
                           @endforeach
                        </tbody>
                    </table>


        {{-- Pagination --}}
               <div class="mt-3">
                   {{$categories->appends(request()->query())->links()}}
               </div>
        {{--End Pagination --}}

                </div>
                @else
                  <h3 class="text-secondary text-center mt-5">There is no Category here!</h3>
                @endif


                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
@endsection
