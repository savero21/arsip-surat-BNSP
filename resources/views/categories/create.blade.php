@extends('layouts.app')

@section('content')
<div class="header mb-3">
    <h2>Kategori Surat >> Tambah</h2>
    <p class="text-muted">
        Tambahkan data kategori baru sesuai kebutuhan. Jika sudah selesai, jangan lupa untuk mengklik tombol <b>"Simpan"</b>.
    </p>
</div>

<div class="card" style="padding:20px; max-width:650px; margin:auto;">
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="row mb-3 align-items-center">
            <label class="col-sm-4 col-form-label">ID (Auto Increment)</label>
            <div class="col-sm-8">
                <input type="text" name="kode_kategori" class="form-control" 
                       value="{{ $nextKodeKategori }}" readonly>
            </div>
        </div>

        <div class="row mb-3 align-items-center">
            <label class="col-sm-4 col-form-label">Nama Kategori</label>
            <div class="col-sm-8">
                <input type="text" name="name" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-4 col-form-label">Keterangan</label>
            <div class="col-sm-8">
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">&laquo; Kembali</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>
</div>
@endsection
