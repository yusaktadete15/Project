@extends('admin/template')

@section('title')
{{$title}}
@endsection

@section('subtitle')

<div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Insert </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active"> Insert </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->

@endsection

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post" action="{{url('admin/order/insert')}}">

	@csrf

    <div class="card-body">
    	<div class="form-group">
            <select name="user_id" class="form-control select2bs4" style="width: 25%">
            	@foreach ( $users as $row )
            		<option value="{{$row->id}}">{{$row->name}}</option>
            	@endforeach
            </select>
            <label>Tanggal Order</label>
            <div class="input-group date" id="reservationdate" data-target-input="nearest" style="width: 25%">
            <input type="date" class="form-control datetimepicker-input" name="tanggal_order" />
                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
        </div>
        <input type="submit" name="submit">
    </div>

@endsection