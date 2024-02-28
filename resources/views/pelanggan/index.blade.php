@extends('_template_back.layout')
@section('content')
{{-- jka error atau depet --}}
<div class="main-container container-fluid"> 
<div class="breadcrumb-header justify-content-between">
    <div>
        <h4 class="content-title mb-2">Hi, welcome back!</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a   href="javascript:void(0);">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Data Tables</li>
            </ol>
        </nav>
    </div>
</div>
<!-- /breadcrumb -->
<!-- Row -->
<div class="row row-sm">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex my-auto btn-list justify-content-end">
                    <!---------route create produk ------>
                    <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">Tambah Data</a>
                    <a href="{{ route('export_pdf_pelanggan') }}" class="btn btn-danger">Export PDF</a>
                    <a href="{{ route('export_excel_pelanggan') }}" class="btn btn-success">Export Excel</a>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table border-top-0 table-bordered text-nowrap border-bottom" id="basic-datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>Alamat</th>
                                <th>Nomor Telepon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pelanggan as $dt)
                                
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $dt->nama_pelanggan }}</td>
                                <td>{{ $dt->alamat }}</td>
                                <td>{{ $dt->nomor_telepon }}</td>
                                <td>
                                    <a href="{{ route('pelanggan.edit', $dt->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Data Ini?')"action="{{ route('pelanggan.destroy',$dt->id)}}" method="post" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
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