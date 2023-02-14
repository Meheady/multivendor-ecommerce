@extends('admin.admin_dashboard');



@section('main')
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Category</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Category</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('add.category')}}"  class="btn btn-primary">Add Category</a>
            </div>
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
                            <th>Category Name</th>
                            <th>Category Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allData as $data)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->cat_name}}</td>
                            <td>
                                <img src="{{asset($data->cat_image)}}" width="50px" height="50px" alt="">
                            </td>
                            <td>
                                <a href="{{route('edit.category',$data->id)}}" class="btn btn-success">Edit</a>
                                <a href="{{route('delete.category',$data->id)}}" id="delete" class="delete btn btn-danger">Delete</a>
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
