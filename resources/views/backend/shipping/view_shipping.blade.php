
@extends('backend.master')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-10 offset-1">
                    <div class="card-box">
                        <h4 style="float:left" class="header-title mb-4">View Shpping Orders</h4>
                        {{-- Success message --}}
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Hey!</strong> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">SL</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Company Name</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $sl = 1;
                            @endphp
                            @foreach($shippings as $key =>  $ship)
                                <tr>
                                    <th scope="row">{{ $shippings->firstItem() + $key }}</th>
                                    <td>{{ $ship->user->name }}</td>
                                    <td>{{ $ship->phone }}</td>
                                    <td>{{ $ship->company_name }}</td>
                                    
                                        @if($ship->payment_status == 1)
                                            <td><sapn class="badge badge-warning">Pending</sapn></td>
                                            @else
                                             <td><sapn class="badge badge-success">Paid</sapn></td>
                                        @endif
                                    
                                    <td>
                                        <a class="btn btn-sm btn-info" href="{{ url('#') }}/{{ $ship->slug }}">View</a>
                                        
                                        <a class="btn btn-sm btn-danger" href="{{ url('delete-shipping') }}/{{ $ship->id }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                         </table>
                        {{ $shippings->links() }}
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- end container-fluid -->
    </div>
@endsection
