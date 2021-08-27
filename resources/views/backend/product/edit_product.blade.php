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


                    <form class="form-horizontal" role="form" action="{{url('update-product')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <div class="form-group row">
                            <label for="product_name" class="col-3 col-form-label">Product Name</label>
                            <div class="col-9">
                                <input type="text" class="form-control @error('product_name') is-invalid @enderror" value="{{$product->product_name ?? old('product_name') }}" name="product_name" id="product_name" placeholder="Ex: Nature Honey">
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
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" value="{{$product->slug ?? old('slug') }}" name="slug" id="slug" placeholder="Ex: nature-honey">
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
                                    <option @if($product->categroy_id == $cat->id) selected @endif value="{{$cat->id}}"> {{ $cat->category_name }} </option>
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
                            <label for="subcategroy_id" class="col-3 col-form-label">Subcategory Name {{$product->subcategroy_id}}</label>
                            <div class="col-9">
                                <select name="subcategroy_id" id="subcategroy_id" class="form-control @error('subcategroy_id') is-invalid @enderror">
                                    <option @if($product->subcategroy_id) selected @endif value="{{$product->subcategroy_id}}"> {{ $product->subcategory->subcategory_name }} </option>
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
                                <input type="number" class="form-control @error('product_price') is-invalid @enderror" value="{{$product->product_price ?? old('product_price') }}" name="product_price" id="product_price" placeholder="Ex: 100">
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
                                <input type="number" class="form-control @error('product_quantity') is-invalid @enderror" value="{{$product->product_quantity ?? old('product_quantity') }}" name="product_quantity" id="product_quantity" placeholder="Ex: 10">
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
                                {{$product->product_summary ?? old('product_summary')}}
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
                                {{$product->product_description ?? old('product_description')}}
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
                                <input type="file" class="form-control @error('product_thumbnil') is-invalid @enderror" id="file_ip_1" onchange="photoChange(this)" name="product_thumbnil" id="product_thumbnil">
                                @error('product_thumbnil')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="product_thumbnil" class="col-3 col-form-label">Thumbnil Preview</label>
                            <div class="col-9">
                               <img id="file_preview" src="{{asset('thumbnil/'.$product->product_thumbnil)}}" width="150" height="150">
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

    ///====================================================
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
