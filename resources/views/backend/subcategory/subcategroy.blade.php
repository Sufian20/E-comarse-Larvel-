@extends('backend.master')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-10 offset-1">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Add Sub Category</h4>
                       
                        {{-- Success message --}}
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Hey!</strong> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        @endif

                       
                        <form class="form-horizontal" role="form" action="{{url('post-subcategory')}}" method="post">
                        @csrf
                            <div class="form-group row">
                                <label for="category_id" class="col-3 col-form-label">Category Name</label>
                                <div class="col-9">
                                <select name="category_id" id="category_id" class="form-control"> 
                                            <option>Select</option>
                                        @foreach($categories as $cat)
                                             <option value="{{ $cat->id}}">{{ $cat->category_name}}</option>

                                        @endforeach
                                   </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="subcategory_name" class="col-3 col-form-label">Sub Category Name</label>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('subcategory_name') is-invalid @enderror" value="{{ old('subcategory_name') }}"    name="subcategory_name" id="subcategory_name" placeholder="Ex: Home & Garden">
                                    @error('subcategory_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                            </div>
                            <div class="form-group mb-0 justify-content-end row text-center">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
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
