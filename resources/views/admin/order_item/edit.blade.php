@extends('admin.template')
@section('title')
{{$title}}
@endsection

@section('subtitle')
<div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> {{$subtitle}} </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active"> {{$subtitle}} </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
@endsection

@section('content')
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List Order</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
                @endif

                @if(session()->has('message'))   
              <div class="alert alert-success">      
                  {{ session()->get('message') }}        
              </div>
                @endif
              <form method="post" action="{{url('admin/order/orderItem/edit/'.$orderitem->id)}}">
              @csrf

              <div class="card-body">
                <div class="form-group">
                  <input type="hidden" name="order_id" value="{{$orderitem->order_id}}">
                  <label>Product</label>
                  <select name="product_id" class="form-control select2bs4" style="width: 25%">
                    <option value="{{$orderitem->product_id}}">{{$orderitem->name}}</option>
                  </select>
                  <label>Quantity</label><br>
                  <input type="text" name="quantity" value="{{old('quantity', $orderitem->quantity)}}">
                </div>
                  <input type="submit" name="submit">
              </div>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
@endsection