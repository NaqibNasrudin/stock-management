@extends('layouts.nav')
<link rel="stylesheet" href="{{asset('css/add_order.css')}}">
@section('content')


<div class="new-meeting">
    <h1 class="m-3">Create New Order</h1>

    @if(session()->has('message'))
        <div class="alert alert-success m-3">
            {{ session()->get('message') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger m-3">
            {{ session()->get('error') }}
        </div>
    @endif

    <form action="/add-stock/store" method="POST">
        @csrf

        <div class="row">
            <div class="col m-3">
                <label for="">Customer Name</label>
                <input type="text" class="form-control" name="cust_name">

            </div>
        </div>

        <div class="row">
            <div class="col m-3">
                <label for="">Product Name</label>
                <input type="text" class="form-control" name="product_name">
            </div>
            <div class="col m-3">
                <label for="">Quantity</label>
                <input type="text" class="form-control col" name="qty" id="meetingDate">

                <input type="submit" class="btn btn-primary my-3" value="Create New Order" style="float: right" >
            </div>

        </div>
    </form>
    {{-- <button>Add New Meeting</button> --}}
</div>
@endsection
