@extends('layout.template')
@section('title','Home')

@section('content')
@php
$id = Session::get('id');
@endphp
    <!-- Hero section -->
    <section class="hero-section">
        <div class="hero-slider owl-carousel">
            <div class="hs-item set-bg" data-setbg="{{asset('banner/1.jpg')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 text-black">
                            <span>New Arrivals</span>
                            <h2>Converse CT All-Star Black High</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
                            @if ($id != null)
                                <a href="#" class="site-btn sb-black">ADD TO CART</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="slide-num-holder" id="snh-1"></div>
        </div>
    </section>
    <!-- Hero section end -->



    <!-- Features section -->
    <section class="features-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 p-0 feature">
                    <div class="feature-inner">
                        <div class="feature-icon">
                            <img src="img/icons/1.png" alt="#">
                        </div>
                        <h2>Fast Secure Payments</h2>
                    </div>
                </div>
                <div class="col-md-4 p-0 feature">
                    <div class="feature-inner">
                        <div class="feature-icon">
                            <img src="img/icons/2.png" alt="#">
                        </div>
                        <h2>Premium Products</h2>
                    </div>
                </div>
                <div class="col-md-4 p-0 feature">
                    <div class="feature-inner">
                        <div class="feature-icon">
                            <img src="img/icons/3.png" alt="#">
                        </div>
                        <h2>Free & fast Delivery</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features section end -->


    <!-- letest product section -->
    <section class="top-letest-product-section">
        <div class="container">
            <div class="section-title">
                <h2>LATEST PRODUCTS</h2>
            </div>
            <div class="product-slider owl-carousel">
                @foreach($latests as $latest)
                <div class="product-item">
                    <div class="pi-pic">
                        <img src="{{asset('data_file/'.$latest->image)}}" alt="">
                        <div class="pi-links">
                            @if($id != null)
                            <button data-toggle="modal" data-target="#myModal"  data-id="{{ $latest->id }}" class="add-to-cart jumlah" ><i class="flaticon-bag"></i><span>Add to cart</span></button>
                            @endif
                        </div>
                    </div>
                    <div class="pi-text">
                        <h6>Rp. {{$latest->price}}</h6>
                        <p> {{$latest->name}} </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- letest product section end -->



    <!-- Product filter section -->
    <section class="product-filter-section">
        <div class="container">
            <div class="section-title">
                <h2>ALL PRODUCTS</h2>
            </div>
            <div class="row">
                @foreach($products as $product)
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src=" {{asset('data_file/'.$product->image)}} " alt="">
                            <div class="pi-links">
                                @if($id != null)
                                <button data-toggle="modal" data-target="#myModal"  data-id="{{ $product->id }}" class="add-to-cart jumlah" ><i class="flaticon-bag"></i><span>Add to cart</span></button>
                                @endif
                            </div>
                        </div>
                        <div class="pi-text">
                            <h6>Rp. {{$product->price}} </h6>
                            <p> {{$product->name}} </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center pt-5">
                <button class="site-btn sb-line sb-dark">LOAD MORE</button>
            </div>
        </div>
    </section>
    <!-- Product filter section end -->

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <form action=" {{url('addCart')}} " method="post">
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Masukan Jumlah</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_barang" class="id_barang" name="id_barang" value="3487">
                <div class="form-group">
                    <label for="exampleInputEmail1">Jumlah Beli</label>
                    <input type="text" class="form-control " id="jumlah" name="jumlah" placeholder="Jumlah Beli">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default">Beli</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        </form>
    </div>
  </div>

@endsection

@push('script')

<script type="text/javascript">
    $(".jumlah").click(function() {
     $(".id_barang").val($(this).attr('data-id'));
     });

    </script>
@endpush
