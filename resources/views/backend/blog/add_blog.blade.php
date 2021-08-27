@extends('backend.master')

@section('header_css')
  

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-10 offset-1">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Add Blog</h4>
                       
                        {{-- Success message --}}
                       @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Hey!</strong> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        @endif
                       
                        <form class="form-horizontal" role="form" action="post-blog" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group row">
                                <label for="title" class="col-3 col-form-label">Product titel</label>
                                <div class="col-9">
                                    <input type="text" class="form-control  @error('title') is-invalid @enderror" value="{{ old('title') }}"    name="title" id="title" placeholder="Ex: Nature Honey">
                                    
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="slug" class="col-3 col-form-label">Blog Permalink</label>
                                <div class="col-9">
                                    <input type="text" class="form-control  @error('slug') is-invalid @enderror" value="{{ old('slug') }}"    name="slug" id="slug" placeholder="Ex: Nature Honey">
                                     @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="category_id" class="col-3 col-form-label">Category Name</label>
                                <div class="col-9">
                                  <select name="categroy_id" id="categroy_id" class="form-control @error('categroy_id') is-invalid @enderror">
                                        <option value="">Select One</option>
                                        @foreach($blogs as $cat)
                                            <option value="{{$cat->id}}"> {{ $cat->category_name }} </option>
                                        @endforeach
                                </select>
                                     @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="my-editor" class="col-3 col-form-label">Description</label>
                                <div class="col-9">
                                    <textarea name="description" id="my-editor" class="form-control  @error('description') is-invalid @enderror" value="{{ old('description') }}"> 
                                    
                                    </textarea>
                                     @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                    
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="feature_image" class="col-3 col-form-label">Feture Image</label>
                                <div class="col-9">
                                    <input type="file" multiple class="form-control  @error('feature_image') is-invalid @enderror" value="{{ old('feature_image') }}"    name="feature_image" id="feature_image" placeholder="Ex: Nature Honey">
                                     @error('feature_image')
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

<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

  <script>
      $('#title').keyup(function() {
            $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
        });

        //Summernote
        var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  };
    CKEDITOR.replace('my-editor', options);

     
  </script>

@endsection

