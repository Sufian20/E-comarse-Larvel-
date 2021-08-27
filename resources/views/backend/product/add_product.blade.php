@extends('backend.master')

@section('content')
<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <!-- end col -->
            <div class="col-md-10 offset-1">
                <div class="card-box">
                    <h4 class="header-title mb-4">Add Product</h4>

                    {{-- Success message --}}
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Hey!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif


                    <form class="form-horizontal" role="form" action="{{url('post-product')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="product_name" class="col-3 col-form-label">Product Name</label>
                            <div class="col-9">
                                <input type="text" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name') }}" name="product_name" id="product_name" placeholder="Ex: Nature Honey">
                                @error('product_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="slug" class="col-3 col-form-label">Slug</label>
                            <div class="col-9">
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug') }}" name="slug" id="slug" placeholder="Ex: nature-honey">
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
                                    @foreach($categories as $cat)
                                    <option value="{{$cat->id}}"> {{ $cat->category_name }} </option>
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
                            <label for="subcategroy_id" class="col-3 col-form-label">Subcategory Name</label>
                            <div class="col-9">
                                <select name="subcategroy_id" id="subcategroy_id" class="form-control @error('subcategroy_id') is-invalid @enderror">

                                </select>

                                @error('subcategroy_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="product_price" class="col-3 col-form-label">Product Price</label>
                            <div class="col-9">
                                <input type="number" class="form-control @error('product_price') is-invalid @enderror" value="{{ old('product_price') }}" name="product_price" id="product_price" placeholder="Ex: 100">
                                @error('product_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="product_quantity" class="col-3 col-form-label">Product Quntity</label>
                            <div class="col-9">
                                <input type="number" class="form-control @error('product_quantity') is-invalid @enderror" value="{{ old('product_quantity') }}" name="product_quantity" id="product_quantity" placeholder="Ex: 10">
                                @error('product_quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="product_summary" class="col-3 col-form-label">Product Summary</label>
                            <div class="col-9">
                                <textarea name="product_summary" id="product_summary" class="form-control @error('subcategroy_id') is-invalid @enderror">

                                </textarea>

                                @error('product_summary')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="product_description" class="col-3 col-form-label">Product Description</label>
                            <div class="col-9">
                                <textarea name="product_description" id="product_description" class="form-control @error('product_description') is-invalid @enderror">

                                    </textarea>

                                @error('product_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">

                            <label for="product_thumbnil" class="col-3 col-form-label">Product Thumbnil</label>
                            <div class="col-9">

                                <input type="file" accept="image/*" class="form-control @error('product_thumbnil') is-invalid @enderror" name="product_thumbnil" id="file_ip_1" onchange="photoChange(this)">
                                @error('product_thumbnil')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <div id="imgPreview" style="padding-top:10px;">
                                    <td><img id="file_preview" src="{{ asset('thumbnil/gellary.jpg') }}" width="150" height="150"></td>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="product_image" class="col-3 col-form-label">Image Gallery</label>
                            <div class="col-9">
                                <input type="file" multiple class="form-control @error('product_image') is-invalid @enderror" name="product_image[]" id="product_image" onchange="photoChange2(this)">
                                @error('product_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                 <div id="imgPreview" style="padding-top:10px;">
                                    <td><img id="file_2_preview" src="{{ asset('thumbnil/gellary.jpg') }}" width="150" height="150"></td>
                                </div>
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
<script>
    //============== image previw ======================


    function photoChange(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#file_preview')
                    .attr('src', e.target.result)
                    .attr("class", "img-thumbnail")
            };
            reader.readAsDataURL(input.files[0]);
        }
    }





    function photoChange2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#file_2_preview')
                    .attr('src', e.target.result)
                    .attr("class", "img-thumbnail")
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    //============== image previw end======================
    $('#product_name').keyup(function() {
        $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g, "-"));
    });


    $('#categroy_id').change(function() {
        var cat_id = $(this).val();


        if (cat_id) {
            $.ajax({
                type: "GET"
                , url: "{{url('api/get-category-list')}}/" + cat_id
                , success: function(res) {
                    if (res) {
                        console.log(res)
                        $("#subcategroy_id").empty();
                        $("#subcategroy_id").append('<option>Select</option>');
                        $.each(res, function(key, value) {
                            $("#subcategroy_id").append('<option value="' + value.id + '">' + value.subcategory_name + '</option>');
                        });

                    } else {
                        $("#subcategroy_id").empty();
                    }
                }
            });
        } else {
            $("#categroy_id").empty();

        }
    });

</script>

@endsection
