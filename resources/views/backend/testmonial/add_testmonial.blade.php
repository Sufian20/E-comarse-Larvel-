@extends('backend.master')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-10 offset-1">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Add Testmonnial</h4>
                       
                        {{-- Success message --}}
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Hey!</strong> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        @endif

                       
                        <form class="form-horizontal" role="form" action="{{route('PostTestMonial')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group row">
                                <label for="clint_name" class="col-3 col-form-label">Clinent Name</label>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('clint_name') is-invalid @enderror" value="{{ old('clint_name') }}"    name="clint_name" id="clint_name" placeholder="Ex: Eleza Any">
                                    @error('clint_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="clint_title" class="col-3 col-form-label">Clinent Title</label>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('clint_title') is-invalid @enderror" value="{{ old('clint_title') }}"    name="clint_title" id="clint_name" placeholder="Ex: CEO Women Fedaration">
                                    @error('clint_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <label for="clint_say" class="col-3 col-form-label">Client Comment</label>
                                <div class="col-9">
                                <textarea name="clint_say" id="clint_say" class="form-control @error('clint_say') is-invalid @enderror">  

                                </textarea>
                                 
                                    @error('clint_say')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                            </div>
                          
                            
                            <div class="form-group row">
                                <label for="product_image" class="col-3 col-form-label">Client Picture</label>
                                <div class="col-9">
                                    <input type="file" multiple class="form-control @error('product_image') is-invalid @enderror"  name="product_image[]" id="product_image">
                                    @error('product_image')
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

@section('footer_js')
    

@endsection