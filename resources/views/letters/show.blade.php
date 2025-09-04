@extends('layouts.app')

@section('content')
<div class="header">
    <h1>Detail Arsip</h1>
    <div class="small">
        Nomor: <b>{{ $letter->number }}</b> • 
        Kategori: <b>{{ $letter->category->name }}</b> • 
        Arsip: {{ $letter->archived_at->format('Y-m-d H:i') }}
    </div>
</div>

<div class="hstack" style="margin-bottom:10px">
    <a class="btn btn-muted" href="{{ route('letters.index') }}">Kembali</a>

    <!-- Tombol unduh via Blob (type=button supaya tidak trigger submit form) -->
    <button type="button" class="btn btn-warning btn-download"
        data-url="{{ route('letters.stream',$letter) }}"
        data-filename="{{ \Illuminate\Support\Str::slug($letter->title, '_') }}.pdf">
        Unduh PDF
    </button>

    <a class="btn btn-primary" href="{{ route('letters.edit',$letter) }}">Edit</a>
</div>

<div class="card" style="padding:10px">
    <iframe src="{{ route('letters.stream',$letter) }}" 
        style="width:100%; height:600px; border:1px solid #ccc"></iframe>
</div>
@endsection
