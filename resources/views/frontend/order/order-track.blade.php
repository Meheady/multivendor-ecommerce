@extends('frontend.master')
@section('main')
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mx-auto text-center">
                   <div class="card">
                       <div class="card-title">Order Tracking</div>
                       <div class="card-body">
                           <form action="{{ route('order.tracking') }}" method="post">
                               @csrf
                               <div class="form-group">
                                   <input type="text" name="invoice_no" placeholder="Enter Invoice Number">
                               </div>
                               <button class="btn btn-success">Track</button>
                           </form>
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
@endsection

