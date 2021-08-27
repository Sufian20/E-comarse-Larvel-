@extends('backend.master')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-10 offset-1">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Edit Category</h4>
                        <a href="{{ url('view-category')}}" style="float:right"><i class="fa fa-list"></i>View All</a>
                        {{-- Success message --}}
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Hey!</strong> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        @endif


                        <form class="form-horizontal" role="form" action="{{url('update-category')}}" method="post">
                        @csrf
                            <input type="hidden" name="category_id" value="{{ $category->id }}">
                            <div class="form-group row">
                                <label for="category_name" class="col-3 col-form-label">Category Name</label>
                                <div class="col-9">
                                    <input type="text"  value="{{ $category-> category_name }}" class="form-control" name="category_name" id="category_name" placeholder="Ex: Home & Garden">
                                </div>
                            </div>
                            <div class="form-group mb-0 justify-content-end row text-center">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- end container-fluid -->
    </div>
@endsection
