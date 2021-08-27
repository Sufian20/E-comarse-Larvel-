@extends('backend.master')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-10 offset-1">
                    <div class="card-box">
                        <h4 style="float:left" class="header-title mb-4">View Sub Category</h4>
                        <a href="{{ url('add-subcategory')}}" style="float:right"><i class="fa fa-plus"></i>Add </a>
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
                                <th scope="col">Category Name</th>
                                <th scope="col">Sub Category Name</th>
                                <th scope="col">Created</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($subcategoris as $key => $cat)
                                <tr>
                                    <th scope="row">{{ $subcategoris->firstItem() + $key }}</th>
                                    <td>{{ $cat->category_id }}</td>
                                    <td>{{ $cat->subcategory_name }}</td>
                                    <td>{{ $cat->created_at ?? "N/A" }}</td>
                                    <td>
                                        <a class="btn btn-outline-primary" href="{{ url('edit-subcategory') }}/{{ $cat->id }}">Edit</a>
                                        <a class="btn btn-outline-danger" href="{{ url('delete-subcategory') }}/{{ $cat->id }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                         </table>
                        {{ $subcategoris->links() }}
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- end container-fluid -->
    </div>
@endsection
