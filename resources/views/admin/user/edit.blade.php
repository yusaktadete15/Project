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
              <li class="breadcrumb-item"><a href="/admin/user">Home</a></li>
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

<form method="post" action="{{url('admin/user/edit/'.$user->id)}}">

  @csrf

    <div class="card-body">
        <div class="form-group">
            <label>Name</label><br>
            <input type="text" name="name" value="{{old('name',$user->name)}}">
        </div>
        <div class="form-group">
            <label>Email</label><br>
            <input type="email" name="email" value="{{old('email',$user->email)}}">
        </div>
        <div class="form-group">
            <label>password</label><br>
            <input type="password" name="password" value="{{old('password',$user->password)}}">
        </div>
        <input type="submit" name="submit">
    </div>

@endsection