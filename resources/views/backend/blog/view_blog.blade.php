@extends('backend.master')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <!-- end col -->
                <div class="col-md-10 offset-1">
                    <div class="card-box">
                        <h4 style="float:left" class="header-title mb-4">View Blog</h4>
                        {{-- Success message --}}
                       

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Titel</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Feture Image</th>
                                <th scope="col">Blog Description</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($blogs as $key => $blo)
                                <tr>
                                    <th scope="row">{{ $blogs->firstItem() + $key }}</th>
                                    <td>{{ $blo->title }}</td>
                                  <td> ---- </td> 
                                    <td><img src="{{ asset('blogs/'.$blo->feature_image) }}" alt="Image" width="150" height="150"></td>
                                    <td>{{ $blo->description }}</td>
                                    <td>
                                        <a class="btn btn-outline-success" href="{{ url('#') }}/{{ $blo->slug }}">View</a>
                                        <a class="btn btn-outline-primary" href="{{ url('edit-blog') }}/{{ $blo->slug }}">Edit</a>
                                        <a class="btn btn-outline-danger" href="{{ url('delete-blog') }}/{{ $blo->id }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                         </table>
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- end container-fluid -->
    </div>
@endsection
