@extends('admin/template')

@section('title')
{{$title}}
@endsection

@section('subtitle')

<div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Edit </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active"> Edit </li>
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

@if(session()->has('message'))
  <div class="alert alert-success">
    {{ session()->get('message') }}
  </div>
@endif

<form method="post" action="{{url('admin/product/edit/'.$product->id)}}">

  @csrf

    <div class="card-body">
      <div class="form-group">
            <select name="category_id">
              @foreach ( $categories as $row )
                <option value="{{$row->id}}">{{$row->nama}}</option>
              @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Code</label><br>
            <input type="text" name="code" value="{{old('code',$product->code)}}">
        </div>
        <div class="form-group">
            <label>Name</label><br>
            <input type="text" name="name" value="{{old('name',$product->name)}}">
        </div>
        <div class="form-group">
            <label>Stock</label><br>
            <input type="text" name="stock" value="{{old('stock',$product->stock)}}">
        </div>
        <div class="form-group">
            <label>Varian</label><br>
            <input type="text" name="varian" value="{{old('varian',$product->varian)}}">
        </div>
        <div class="form-group">
            <label>Description</label><br>
            <input type="text" name="description" value="{{old('description',$product->description)}}">
        </div>
        <input type="submit" name="submit">
    </div>

@endsection