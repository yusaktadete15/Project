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
          <div class="col-md-6">
            <div class="card">
              <div class="card-header"> 
                <h3>Insert Product</h3>
              </div>
            <div class="card-header"> 
              <button id="hide">Hide</button>
              <button id="tambah">Insert</button>
            </div>
            <div class="card-body">
              @if(session()->has('message'))   
              <div class="alert alert-success">      
                {{ session()->get('message') }}        
              </div>
              @endif
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Insert Product</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form method="post" action="{{url('admin/product/insert')}}" id="form-insert-product" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                      <div class="form-group">
                        <label>Code</label>
                        <input name="code" type="text" class="form-control" id="code" placeholder="Code" value="{{old('code')}}">
                      </div>
                      <div class="form-group">
                        <label>Name</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Name" value="{{old('name')}}">
                      </div>
                      <div class="form-group">
                        <label>Stock</label>
                        <input name="stock" type="text" class="form-control" id="stock" placeholder="Stock" value="{{old('stock')}}">
                      </div>
                      <div class="form-group">
                        <label>Price</label>
                        <input name="price" type="text" class="form-control" id="price" placeholder="Price" value="{{old('price')}}">
                      </div>
                      <div class="form-group">
                        <label for="image">Image</label>
                        <input name="image" type="file" class="form-control" id="image" value="{{old('image')}}">
                      </div>
                    </div>
                    <!-- /.card-body -->
    
                    <div class="card-footer">
                      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
            </div>
          </div>
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List Product</h3>
              </div>
              <!-- /.card-header -->
                <table id="data-item" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th width="240px">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  	@foreach($products as $product)
                  <tr>
                    <td> {{$product->code}} </td>
                    <td> {{$product->name}} </td>
                    <td> {{$product->stock}} </td>
                    <td> {{$product->price}} </td>
                    <td> <img src="{{asset('data_file/'.$product->image)}}"  width="100px"></td>
                    <td> 
                      <form action="{{url('admin/product/delete/'.$product->id)}}" method="post">
                        <a class="btn btn-primary btn-sm" href="{{url('admin/product/edit/'.$product->id)}}">Edit</a> 

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
            {{ $products->links() }}
@endsection
@push('script')
    <script>
      $(document).ready(function(){
        $("#hide").click(function(){
          $("#form-insert-product").hide();
          });
        $("#tambah").click(function(){
            $("#form-insert-product").show();
          });
      });
        // $(document).ready(function() {
        //   $('#form-insert-product').on('submit', function(e){
        //     e.preventDefault();
        //     const code = $('#code').val();
        //     const name = $('#name').val();
        //     const stock = $('#stock').val();
        //     const price = $('#price').val();
        //     const image = $('#image').val();

        //     $.ajax({
        //       type: 'POST',
        //       url: '/api/product/insert',
        //       data: {
        //         'code' : code,
        //         'name' : name,
        //         'stock' : stock,
        //         'price' : price,
        //         'image' : image,
        //       },
        //       success: function(result) {
        //         console.log(result)
        //         // $('#data-item').html(updateTable(result.data));
        //         // $('#code').val('');
        //         // $('#name').val('');
        //         // $('#stock').val('');
        //         // $('#price').val('');
        //         // $('#image').val('');
        //       },
        //       error: function(err){
        //         console.log(err);
        //       }
        //     })
        //   })
        // })

        // $(document).on('click', function(e){
        //   if($(e.target).hasClass('btn-delete')) {
        //     const id = $(e.target).data('id');
        //     $.ajax({
        //       type: 'DELETE',
        //       url: `/api/product/delete/${id}`,
        //       success: function(result) {
        //         // console.log(result);
        //         $('#data-item').html(updateTable(result.data));
        //       }
        //     })
        //   }
        // })

        // function updateTable(data) {
        //   let table = '';
        //   data.forEach((d, i) => {
        //     table += `
        //             <tr>
        //                   <td> ${d.code} </td>
        //                   <td> ${d.name} </td>
        //                   <td> ${d.stock} </td>
        //                   <td> ${d.price} </td>
        //                   <td> </td>
        //                   <td>  
        //                         <a class="btn btn-primary btn-sm" href="#">Edit</a>
        //                         <button type="button" class="btn btn-danger btn-sm btn-delete"
        //                         data-id="${d.id}"
        //                         onclick="return confirm('Apakah Anda Yakin Menghapus Data Ini')">Delete</button>
        //                   </td>
        //                 </tr>
        //     `;
        //   })
        //   return table
        // }
    </script>
@endpush