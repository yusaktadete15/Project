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
              <form method="post" action="{{url('admin/order/orderItem/'.$id)}}" id="form-order-item">
              @csrf

              <div class="card-body">
                <div class="form-group">
                  <input type="hidden" name="order_id" value="{{$id}}" id="order_id">
                  <label for="product_id">Product</label>
                  <select name="product_id" id="product_id" class="form-control select2bs4" style="width: 25%">
                    @foreach ( $product as $row )
                    <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                  </select>
                  <label>Quantity</label><br>
                  <input type="text" name="quantity" value="{{old('quantity')}}" id="quantity">
                </div>
                  <input type="submit" name="submit">
              </div>

              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Nama Produk</th>
                  <th>Quantity</th>
                  <th width="240px">Action</th>
                </tr>
                </thead>
                <tbody id="data-item">
                  @foreach($orderitems as $orderItem)
                <tr>
                  <td> {{$orderItem->name}} </td>
                  <td> {{$orderItem->quantity}} </td>
                  <td>  
                    <form action="{{url('admin/order/orderItem/delete/'.$orderItem->id)}}" method="post">
                        <a class="btn btn-primary btn-sm" href="{{url('admin/order/orderItem/edit/'.$orderItem->id)}}">Edit</a>

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

@push('script')
    <script>
        $(document).ready(function() {
          $('#form-order-item').on('submit', function(e){
            e.preventDefault();
            const order_id = $('#order_id').val();
            const product_id = $('#product_id').val();
            const quantity = $('#quantity').val();

            $.ajax({
              type: 'POST',
              url: '/api/order/order_item/' + order_id,
              data: {
                'order_id' : order_id,
                'product_id' : product_id,
                'quantity' : quantity
              },
              success: function(result) {
                // console.log(result)
                $('#data-item').html(updateTable(result.data));
                $('#quantity').val('');
              }
            })
          })
        })

        $(document).on('click', function(e){
          if($(e.target).hasClass('btn-delete')) {
            const order_id = $(e.target).data('order-id');
            const id = $(e.target).data('id');
            $.ajax({
              type: 'DELETE',
              url: `/api/order/${order_id}/order_item/${id}`,
              success: function(result) {
                // console.log(result);
                $('#data-item').html(updateTable(result.data));
              }
            })
          }
        })

        function updateTable(data) {
          let table = '';
          data.forEach((d, i) => {
            table += `
                    <tr>
                          <td> ${d.product.name} </td>
                          <td> ${d.quantity} </td>
                          <td>  
                                <a class="btn btn-primary btn-sm" href="#">Edit</a>
                                <button type="button" class="btn btn-danger btn-sm btn-delete"
                                data-order-id="${d.order_id}"
                                data-id="${d.id}"
                                onclick="return confirm('Apakah Anda Yakin Menghapus Data Ini')">Delete</button>
                          </td>
                        </tr>
            `;
          })
          return table
        }
    </script>
@endpush