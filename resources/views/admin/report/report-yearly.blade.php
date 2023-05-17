@extends('admin.admin_dashboard');



@section('main')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Report</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Yearly Report</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <p><a href="{{ route('report.view') }}" class="btn btn-info">Back To Search</a></p>
            <div class="card">
                <div class="card-body">
                    <h6 class="text-danger mb-2">Year of: {{ $year }}</h6>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Date</th>
                                <th>Invoice</th>
                                <th>Amount</th>
                                <th>Payment</th>
                                <th>status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allData as $data)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $data->order_date }}</td>
                                    <td>{{ $data->invoice_no }}</td>
                                    <td>${{ $data->amount }}</td>
                                    <td>{{ $data->payment_method }}</td>
                                    <td>
                                        <span class="badge rounded-pill bg-info">{{ $data->status }}</span>
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


