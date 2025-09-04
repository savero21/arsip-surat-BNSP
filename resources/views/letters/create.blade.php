@extends('layouts.app')

@section('content')
<div class="header"><h1>Arsipkan Surat</h1></div>
<div class="card" style="padding:16px">
    <form method="POST" action="{{ route('letters.store') }}" enctype="multipart/form-data" class="form-grid">
        @csrf
        <div>
            <label>Nomor Surat</label>
            <input type="text" name="number" value="{{ old('number') }}">
            @error('number') <div class="small" style="color:#b91c1c">{{ $message }}</div> @enderror
        </div>
        <div>
            <label>Kategori</label>
            <select name="category_id">
                <option value="">-- pilih --</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" @selected(old('category_id')==$c->id)>{{ $c->name }}</option>
                @endforeach
            </select>
            @error('category_id') <div class="small" style="color:#b91c1c">{{ $message }}</div> @enderror
        </div>
        <div>
            <label>Judul</label>
            <input type="text" name="title" value="{{ old('title') }}">
            @error('title') <div class="small" style="color:#b91c1c">{{ $message }}</div> @enderror
        </div>
        <div>
            <label>Waktu Pengarsipan</label>
            <input type="datetime-local" name="archived_at" value="{{ old('archived_at', now()->format('Y-m-d\TH:i')) }}">
            @error('archived_at') <div class="small" style="color:#b91c1c">{{ $message }}</div> @enderror
        </div>
        <div style="grid-column:1 / -1">
            <label>File PDF</label>
            <input type="file" name="file_pdf" accept="application/pdf">
            @error('file_pdf') <div class="small" style="color:#b91c1c">{{ $message }}</div> @enderror
        </div>
        <div style="grid-column:1 / -1" class="hstack">
            <a class="btn btn-muted" href="{{ route('letters.index') }}">Kembali</a>
            <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
    </form>
</div>
@endsection
