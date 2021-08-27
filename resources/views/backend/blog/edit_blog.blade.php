@extends('backend.master')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-10 offset-1">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Update Product</h4>

                        {{-- Success message --}}
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Hey!</strong> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        @endif


                        <form class="form-horizontal" role="form" action="{{url('update-blog')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <input type="hidden" name="blog_id" value="{{$blog->id}}">
                            <div class="form-group row">
                                <label for="title" class="col-3 col-form-label">Product Name</label>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{$blog->title ?? old('title') }}"    name="title" id="title">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="slug" class="col-3 col-form-label">Slug</label>
                                <div class="col-9">
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" value="{{$blog->slug ?? old('slug') }}"    name="slug" id="slug" placeholder="Ex: nature-honey">
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="categroy_id" class="col-3 col-form-label">Category Name</label>
                                <div class="col-9">
                                <select name="categroy_id" id="categroy_id" class="form-control @error('categroy_id') is-invalid @enderror">
                                        <option value="">Select One</option>
                                        @foreach($blogs as $cat)
                                            <option @if($blog->categroy_id == $cat->id) selected @endif value="{{$cat->id}}"> {{ $cat->category_name }} </option>
                                        @endforeach
                                </select>
                                    @error('categroy_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <label for="description" class="col-3 col-form-label">BLog Description</label>
                                <div class="col-9">
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">
                                      {{$blog->description ?? old('description')}}
                                    </textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="feature_image" class="col-3 col-form-label">Blog Feature Image</label>
                                <div class="col-9">
                                    <input type="file" class="form-control @error('feature_image') is-invalid @enderror"     name="feature_image" id="feature_image">
                                    @error('feature_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                     @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="feature_image" class="col-3 col-form-label"> Photo Preview</label>
                                <div class="col-9">
                                   <img src="{{asset('blogs/'.$blog->feature_image)}}" alt="" height="80" weight="80">
                                </div>
                            </div>
                            <div class="form-group mb-0 justify-content-end row text-center">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success waves-effect waves-light">UPDATE</button>
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
    <script>
        $('#product_name').keyup(function() {
            $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g,"-"));
        });


        $('#categroy_id').change(function(){
    var cat_id = $(this).val();


    if(cat_id){
        $.ajax({
           type:"GET",
           url:"{{url('api/get-category-list')}}/"+cat_id,
           success:function(res){
            if(res){
                console.log(res)
                $("#subcategroy_id").empty();
                $("#subcategroy_id").append('<option>Select</option>');
                $.each(res,function(key,value){
                    $("#subcategroy_id").append('<option value="'+value.id+'">'+value.subcategory_name+'</option>');
                });

            }else{
               $("#subcategroy_id").empty();
            }
           }
        });
    }else{
        $("#categroy_id").empty();

    }
   });
    </script>

@endsection
