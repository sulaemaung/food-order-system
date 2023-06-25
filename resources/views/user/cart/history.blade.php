@extends('user.layouts.master')

@section('content')
<!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <a href="{{route('user#home')}}">
                <i class="fa-solid fa-arrow-left text-dark mb-3 "></i>
            </a>
            <div class="col-lg-10 offset-1 table-responsive mb-5" style="height: 450px">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>

                            <th>Date</th>
                            <th>Order code</th>
                            <th>Total</th>
                            <th>Status</th>

                        </tr>
                    </thead>
                    @foreach ($order as $o)
                        <tr>
                            <td class="align-middle">{{$o->created_at->format('j-F-Y')}}</td>
                            <td class="align-middle">{{$o->orderCode}}</td>
                            <td class="align-middle">{{$o->total_price}}</td>
                            <td class="align-middle">
                              @if ($o->status == 0)
                               <span class="text-primary"><i class="fa-solid fa-clock me-2"></i>Pending</span>

                              @elseif($o->status == 1)
                                <span class="text-success"><i class="fa-solid fa-circle-check me-2"></i>Success</span>

                              @elseif($o->status == 2)
                                <span class="text-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i>Reject</span>
                              @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
                 <span>
                   {{ $order->appends(request()->query())->links()}}
                </span>
            </div>
@endsection
