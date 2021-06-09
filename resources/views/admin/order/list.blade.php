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
                <a href="{{url('admin/order/insert')}}" class="btn btn-success">Insert</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if(session()->has('message'))   
                <div class="alert alert-success">      
                  {{ session()->get('message') }}        
                </div>
                @endif
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Nama Pembeli</th>
                    <th>Tanggal Order</th>
                    <th width="240px">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@foreach($orders as $order)
                  <tr>
                    <td> {{$order->name}} </td>
                    <td> {{$order->tanggal_order}} </td>
                    <td> 
                      <form action="{{url('admin/order/delete/'.$order->id)}}" method="post">
                        <a class="btn btn-primary btn-sm" href="{{url('admin/order/orderItem/'.$order->id)}}">Edit</a>
                        @csrf

                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin Menghapus Data Ini')">Delete</button>
                      </form>
                    </td>
                  </tr>
                  	@endforeach
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
@endsection