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
                <h3 class="card-title">List Product</h3>
                <a href="/admin/user/insert" class="btn btn-success">Insert</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th width="240px">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($users as $user)
                  <tr>
                    <td> {{$user->name}} </td>
                    <td> {{$user->email}} </td>
                    <td> 
                      <form action="{{url('admin/user/delete/'.$user->id)}}" method="post">
                        <a class="btn btn-primary btn-sm" href="{{url('admin/user/edit/'.$user->id)}}">Edit</a> 

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
{{ $users->links() }}
@endsection