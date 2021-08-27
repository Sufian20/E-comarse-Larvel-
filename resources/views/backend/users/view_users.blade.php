@extends('backend.master')

@section('content')
<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <!-- end col -->
            <div class="col-md-10 offset-1">
                <div class="card-box">
                    <h4 style="float:left" class="header-title mb-4">View Admin & Users</h4>
                    
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
                                <th scope="col">User Type</th>
                                <th scope="col">Make Admin</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        @php
                        $sl = 1;
                        @endphp
                        <tbody>
                            @foreach($users as $key => $user)
                            <tr>
                                <th scope="row">{{ $sl++ }}</th>
                                <td>{{ $user->name }}</td>
                                <td>
                                    @if($user->utype == 1)
                                    Admin
                                    @else
                                    User
                                    @endif
                                </td>
                               
                                @if($user->utype == 1)
                                    <td ><span class="badge badge-warning">Already Aadmin</span></td>
                                @else

                                    <td><a href="{{route('MakeAdmin', $user->id)}}" class="btn btn-sm btn-success" value="1">Admit</a></td>
                                @endif
                                <td>
                                    <a class="btn btn-sm btn-info" href="{{ url('#') }}/{{ $user->id }}">Edit</a>
                                    <a class="btn btn-sm btn-danger" href="{{ url('#') }}/{{ $user->id }}">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- end container-fluid -->
</div>
@endsection
