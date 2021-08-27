@extends('backend.master')

@section('content')
<div class="content">
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <!-- end col -->
            <div class="col-md-10 offset-1">
                <div class="card-box">
                    <h4 style="float:left" class="header-title mb-4">View Product</h4>
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
                                <th scope="col">Product Name</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Porduct Image</th>

                                <th scope="col">Product Section Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $key => $product)
                            <tr>
                                <th scope="row">{{ $products->firstItem() + $key }}</th>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->category->category_name }}</td>
                                <td><img src="{{ asset('thumbnil/'.$product->product_thumbnil) }}" alt="Image" width="150" height="150"></td>
                                <td>
                                      <form class="form-horizontal" role="form" action="{{route('PostProductSection')}}" method="post">
                                        @csrf
                                    <div class="section_stataus" style="padding:30px;">
                                   
                                        <input class="radio-S" style="margin-bottom: 13px;" type="radio" id="male" name="product_section_status" value="1">Slider <br>
                                        <input class="radio-b" style="margin-bottom: 13px;" type="radio" id="male" name="product_section_status" value="2">BestSeller <br>
                                        
                                        <button type="submit" class="btn btn-sm btn-warning">Submit</button>
                                    </div>
                                    </form>

                                </td>
                                <td>
                                    <a class="btn btn-sm btn-success" href="{{ url('#') }}/{{ $product->slug }}">View</a>
                                    <a class="btn btn-sm btn-info" href="{{ url('edit-product') }}/{{ $product->slug }}">Edit</a>
                                    <a class="btn btn-sm btn-danger" href="{{ url('delete-product') }}/{{ $product->id }}">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- end container-fluid -->
</div>
@endsection
