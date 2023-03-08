@extends('admin.admin_dashboard');



@section('main')
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Banner</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Banner</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('create.banner')}}"  class="btn btn-primary">Add Banner</a>
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
                            <th>Banner Title</th>
                            <th>Banner Url</th>
                            <th>Banner Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($banners as $data)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$data->banner_title}}</td>
                            <td>{{$data->banner_url}}</td>
                            <td>
                                <img src="{{asset($data->banner_image)}}" width="50px" height="50px" alt="">
                            </td>
                            <td>
                                <a href="{{route('edit.banner',$data->id)}}" class="btn btn-success">Edit</a>
                                <a href="{{route('delete.banner',$data->id)}}" id="delete" class="delete btn btn-danger">Delete</a>
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
