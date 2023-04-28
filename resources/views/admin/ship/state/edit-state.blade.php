@extends('admin.admin_dashboard');

@section('main')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">State</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit State</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{route('all.state')}}"  class="btn btn-primary">All State</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('update.state',$state->id)}}" method="post">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Division Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select class="form-control" name="division" id="division">
                                        <option value="" selected disabled>Select Division</option>
                                        @foreach($division as $item)
                                            <option {{ $item->id == $state->division_id? 'selected':'' }} value="{{ $item->id }}">{{ $item->division_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">District Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <select class="form-control" name="district" id="district">
                                        @foreach($district as $item)
                                            <option  {{ $item->id == $state->district_id? 'selected':'' }} value="{{ $item->id }}">{{ $item->district_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">State Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" value="{{ $state->state_name }}" class="form-control @error('state_name') is-invalid @enderror" name="state_name" />
                                    @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="Update State" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $('#division').change(function(){
            const id = $(this).val();
            $.ajax({
                url: "{{ url('/admin/ajax-district') }}/"+id,
                type: "GET",
                dataType: "JSON",
                success: function (res) {
                    $('#district').html('');
                    $.each(res,function (key,value) {
                        console.log(value)
                        $('#district').append('<option value="'+ value.id +'">'+ value.district_name +'</option>')
                    })
                },
                error: function (e) {
                    console.log(e);
                }
            })
        });
    </script>
@endsection

