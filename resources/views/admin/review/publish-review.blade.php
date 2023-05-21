@extends('admin.admin_dashboard');



@section('main')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Review</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Published Review</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>User Name</th>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($review as $data)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$data->user->name}}</td>
                                    <td>{{$data->product->product_name}}</td>
                                    <td><img src="{{asset($data->product->product_thumbnail)}}" width="50px" height="50px" alt=""></td>
                                    <td>{{$data->rating}} star</td>
                                    <td>{{Str::limit($data->comment,25) }}</td>
                                    <td>
                                        <span class="badge rounded-pill bg-success">Published</span>
                                    </td>
                                    <td>
                                        <a href="{{route('delete.review.admin',$data->id)}}" class="confirm btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
