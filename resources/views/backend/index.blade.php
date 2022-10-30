@extends('backend.layout')

@section('Sidebar')

    <div class="menu-item">
      <a class="menu-link active" href="/">
        <span class="menu-title">Transaksi</span>
      </a>
    </div>
    <div class="menu-item">
      <a class="menu-link" href="/Product">
        <span class="menu-title">Product</span>
      </a>
    </div>
    <div class="menu-item">
      <a class="menu-link" href="/History">
        <span class="menu-title">History</span>
      </a>
    </div>
    <div class="menu-item">
      <a class="menu-link" href="/HistoryBarang">
        <span class="menu-title">History barang</span>
      </a>
    </div>

@endsection

@section('isi')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Transaksi</h1>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <div class="card">
                <!--begin::Header-->
                <div class="card-header card-header-stretch">
                    <!--begin::Title-->
                    <div class="card-title w-100">
                        <input class="form-control" id="myInput" type="text" placeholder="Search.." autofocus>
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body p-0">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7 col-sm-12">
                                <table class="table">
                                    <thead  class="thead-light">
                                      <tr class="text-center">
                                        <th>SKU</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Barang</th>
                                        <th>Stok Barang</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody id="myTable" class="text-center">
                                      @foreach ($products as $product)
                                        
                                      <tr class="text-center">
                                        <td class="ml-3">{{ $product->produk_SKU }}</td>
                                        <td class="text-left">{{ $product->nama_produk }}</td>
                                        <td class="text-left">Rp. <?php echo number_format( $product->harga , 0,',','.') ?> </td>
                                        <td>{{ $product->jumlah_stock }}</td>
                                        <td width="200px"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#MyModal{{ $product->produk_SKU }}">
                                              Tambah Barang
                                            </button>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="MyModal{{ $product->produk_SKU }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Produk</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">  
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                      <form action="/Tambah-Cart/{{ $product->produk_SKU }}?stock={{ $product->jumlah_stock }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                                          @csrf
                                                          <div class="modal-body">
                                                              <div>
                                                                  Jumlah Barang
                                                                  <span><input name="Jumlah" type="text" class="form-control input-sm" autofocus></span>
                                                              </div>
                                                          </div>
                                                          <div class="modal-footer">
                                                              <button type="submit" class="btn btn-primary">Tambah Produk</button>
                                                          </div>
                                                      </form>
                                                </div>
                                              </div>
                                            </div></td>
                                      </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                                  {{-- <div class="mt-3">
                                    {{$products->links()}}
                                    <br><br>
                                </div> --}}
                            </div>
                            {{-- Keranjang --}}
                            <div class="col-md-5 col-sm-12 mb-5">
                              <table class="table">
                                <thead  class="thead-light">
                                  <tr class="text-center">
                                    <th>Nama Barang</th>
                                    <th>Jumlah Barang</th>
                                    <th>Harga Satuan</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody class="text-center">
                                  <?php $total = 0 ?>
                                  @foreach ($cart as $cart)
                                    <?php $total = $total + $cart->harga * $cart->Jumlah?>
                                  <tr  class="text-center">
                                    <td class="text-left">&nbsp;{{ $cart->nama_produk }}</td>
                                    <td>{{ $cart->Jumlah }}</td>
                                    <td class="text-left">Rp. <?php echo number_format( $cart->harga, 0,',','.') ?></td>
                                    <td><div class="row text-white">
                                          <a href="/Delete-Cart/{{ $cart->id }}" class="btn btn-danger col ml-3 mr-3">Delete</a>
                                        </div></td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                              Total harga: Rp. <?php echo number_format( $total , 0,',','.') ?>
                              <br>
                              <button class="btn btn-primary text-white" id="printid" href="#">Print</button>
                              <a class="btn btn-danger text-white float-right" href="/Delete-All">Delete All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection