@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
</section>
<div class="content px-3"> 
    <div class="row">
        <div class="col-md-3 col-xl-3">
            <div class="info-box" style="background-color: rgb(255, 255, 255)">
                <span class="info-box-icon bg-success"><i class="nav-icon fa fa-school"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Tickets</span>
                    <span class="info-box-number">{{$count['total']}}</span>
                    {{-- <span class="info-box-number">{{ $model->order_count }}</span> --}}
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xl-3">
            <div class="info-box" style="background-color: rgb(255, 255, 255)">
                <span class="info-box-icon bg-info"><i class="nav-icon fa fa-user"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">New Tickets</span>
                    <span class="info-box-number">{{$count['new']}}</span>
                    {{-- <span class="info-box-number">{{ $model->product_count }}</span> --}}
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xl-3">
            <div class="info-box" style="background-color: rgb(255, 255, 255">
                <span class="info-box-icon bg-danger"><i class="nav-icon fa fa-user-secret"></i></span> 
                <div class="info-box-content">
                    <span class="info-box-text">Pending Tickets</span>
                    <span class="info-box-number">{{$count['pending']}}</span>
                    {{-- <span class="info-box-number">{{ $model->customer_count }}</span> --}}
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xl-3">
            <div class="info-box" style="background-color: rgb(255, 255, 255)">
                <span class="info-box-icon bg-secondary"><i class="nav-icon fa fa-book-open"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Completed Tickets</span>
                    <span class="info-box-number">{{$count['completed']}}</span>
                    {{-- <span class="info-box-number">{{ $model->customer_count }}</span> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
