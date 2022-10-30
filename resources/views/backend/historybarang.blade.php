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
      <a class="menu-link" href="/History">
        <span class="menu-title">History</span>
      </a>
    </div>
    <div class="menu-item">
      <a class="menu-link active" href="/HistoryBarang">
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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">History Barang</h1>
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
                            <div class="col">
                                <table class="table">
                                    <thead  class="thead-light">
                                      <tr class="text-center">
                                        <th>Tanggal</th>
                                        <th>Pengirim</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Barang</th>
                                      </tr>
                                    </thead>
                                    <tbody id="myTable" class="text-center">
                                      @foreach ($hisb as $historyb)
                                      <tr class="text-center">
                                        <td><?php echo date('d-m-Y', strtotime($historyb->created_at)); ?></td>
                                        <td>{{ $historyb->Pengirim }}</td>
                                        <td>{{ $historyb->nama_produk }}</td>
                                        <td>{{ $historyb->Jumlah }}</td>
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
    </div>
</div>

@endsection