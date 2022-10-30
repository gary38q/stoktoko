@extends('backend.layout')

@section('Sidebar')

    <div class="menu-item">
      <a class="menu-link" href="/">
        <span class="menu-title">Transaksi</span>
      </a>
    </div>
    <div class="menu-item">
      <a class="menu-link" href="/Product">
        <span class="menu-title">Product</span>
      </a>
    </div>
    <div class="menu-item">
      <a class="menu-link active" href="/History">
        <span class="menu-title">History</span>
      </a>
    </div>
    <div class="menu-item">
      <a class="menu-link" href="../../demo5/dist/index.html">
        <span class="menu-title">Home</span>
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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">History Detail</h1>
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
                    <div class="card-title w-100 font-weight-bold">
                        {{ $id }}
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body p-0">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <table class="table">
                                    <thead  class="thead-light">
                                      <tr class="text-center">
                                        <th>Nama Produk</th>
                                        <th>Jumlah Barang</th>
                                        <th>Harga Barang</th>
                                        <th>Total Harga</th>
                                      </tr>
                                    </thead>
                                    <tbody id="myTable" class="text-center">
                                      <?php $total = 0; ?>
                                      @foreach ($hisdetail as $history)

                                      <?php $total = $total + ($history->jumlah * $history->harga); ?>
                                      <tr class="text-center">
                                        <td>{{ $history->nama_produk }}</td>
                                        <td>{{ $history->jumlah }}</td>
                                        <td>Rp. <?php echo number_format( $history->harga, 0,',','.') ?></td>
                                        <td class="text-right">Rp. <?php echo number_format( $history->jumlah * $history->harga , 0,',','.') ?></td>
                                      </tr>
                                      @endforeach
                                      <tr>
                                        <td colspan="3" class="font-weight-bold">Total :</td>
                                        <td class="text-right font-weight-bold">Rp. <?php echo number_format( $total , 0,',','.') ?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection