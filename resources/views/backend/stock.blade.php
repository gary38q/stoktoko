@extends('backend.layout')

@section('Sidebar')

    <div class="menu-item">
      <a class="menu-link" href="/">
        <span class="menu-title">Transaksi</span>
      </a>
    </div>
    <div class="menu-item">
      <a class="menu-link active" href="/Product">
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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Product</h1>
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
                        <input class="form-control col-10" id="myInput" type="text" placeholder="Search.." autofocus>
                        <div class="col-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                Tambah Produk
                              </button>
                              
                              <!-- Modal -->
                              <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" autocomplete="off">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">Tambah Produk</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                        <form action="/Tambah-Produk" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div>
                                                    Produk SKU (Scan produk)
                                                    <span><input name="SKU" type="text" class="form-control input-sm" ></span>
                                                </div>
                                                <br>
                                                <div>
                                                    Nama Produk
                                                    <span><input name="NamaProduk" type="text" class="form-control input-sm" ></span>
                                                </div>
                                                <br>
                                                <div>
                                                    Harga 
                                                    <span><input name="Harga" type="text" class="form-control input-sm" ></span>
                                                </div>
                                                <br>
                                                <div>
                                                    Jumlah Stok 
                                                    <span><input name="Stok" type="text" class="form-control input-sm" ></span>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Tambah Produk</button>
                                            </div>
                                        </form>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                    
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body p-0">
                    <div class="container">
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
                            @foreach ($product as $product)
                              
                            <tr  class="text-center">
                              <td>{{ $product->produk_SKU }}</td>
                              <td class="text-left">{{ $product->nama_produk }}</td>
                              <td class="text-left">Rp. <?php echo number_format( $product->harga , 0,',','.') ?></td>
                              <td>{{ $product->jumlah_stock }}</td>
                              <td>
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahstok{{ $product->produk_SKU }}">Tambah Stok</button>
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#UpdateModal{{ $product->produk_SKU }}">Update Produk</button>
                              <a  class="btn btn-danger" href="{{ url('Delete') }}/{{ $product->produk_SKU }}">Delete Produk</a></td>
                              
                              
                              <!-- Update Produk Modal -->
                              <div class="modal fade" id="UpdateModal{{ $product->produk_SKU }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">Update Produk</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                        <form action="{{ url('/Update-Product') }}/{{ $product->produk_SKU }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body text-left">
                                                <div>
                                                    Produk SKU
                                                    <span class="font-weight-bold"><br>{{ $product->produk_SKU }}</span>
                                                </div>
                                                <br>
                                                <div>
                                                    Jumlah Stok 
                                                    <span class="font-weight-bold"><br>{{ $product->jumlah_stock }}</span>
                                                </div>
                                                <br>
                                                <div>
                                                    Nama Produk
                                                    <span><input name="NamaProduk" type="text" value="{{ $product->nama_produk }}" class="form-control input-sm" ></span>
                                                </div>
                                                <br>
                                                <div>
                                                    Harga 
                                                    <span><input name="Harga" type="text" value="{{ $product->harga }}" class="form-control input-sm" ></span>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Update Produk</button>
                                            </div>
                                        </form>
                                  </div>
                                </div>
                              </div>

                              {{-- tambah stock Modal --}}
                              <div class="modal fade" id="tambahstok{{ $product->produk_SKU }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLongTitle">Tambah Stock</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                        <form action="{{ url('/Tambah-Stock') }}/{{ $product->produk_SKU }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body text-left">
                                                <div>
                                                  Pengirim Barang 
                                                  <span><input name="pengirim" type="text" class="form-control input-sm" ></span>
                                                </div>
                                                <br>
                                                <div>
                                                    Jumlah Stock 
                                                    <span><input name="tstock" type="number" class="form-control input-sm" ></span>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Tambah Stock</button>
                                            </div>
                                        </form>
                                  </div>
                                </div>
                              </div></td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection