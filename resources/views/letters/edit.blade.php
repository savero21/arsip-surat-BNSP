@extends('layouts.app')

@section('content')
<div class="header"><h1>Edit Arsip</h1></div>
<div class="card" style="padding:16px">
<form method="POST" action="{{ route('letters.update',$letter) }}" enctype="multipart/form-data" class="form-grid">
@csrf @method('PUT')
    <div>
        <label>Nomor Surat</label>
        <input type="text" name="number" value="{{ old('number',$letter->number) }}">
        @error('number') <div class="small" style="color:#b91c1c">{{ $message }}</div> @enderror
    </div>
    <div>
        <label>Kategori</label>
        <select name="category_id">
            @foreach($categories as $c)
                <option value="{{ $c->id }}" @selected(old('category_id',$letter->category_id)==$c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
        @error('category_id') <div class="small" style="color:#b91c1c">{{ $message }}</div> @enderror
    </div>
    <div>
        <label>Judul</label>
        <input type="text" name="title" value="{{ old('title',$letter->title) }}">
        @error('title') <div class="small" style="color:#b91c1c">{{ $message }}</div> @enderror
    </div>
    <div>
        <label>Waktu Pengarsipan</label>
        <!-- <input type="datetime-local" name="archived_at" value="{{ old('archived_at',$letter->archived_at->format('Y-m-d\TH:i')) }}"> -->
         <input type="datetime-local" name="archived_at" 
       value="{{ old('archived_at', optional($letter->archived_at)->format('Y-m-d\TH:i')) }}">

        @error('archived_at') <div class="small" style="color:#b91c1c">{{ $message }}</div> @enderror
    </div>
    <div style="grid-column:1 / -1">
        <label>Ganti File PDF (opsional)</label>
        <input type="file" name="file_pdf" accept="application/pdf">
        <div class="small">File saat ini: {{ $letter->file_path }}</div>
        @error('file_pdf') <div class="small" style="color:#b91c1c">{{ $message }}</div> @enderror
    </div>
    <div style="grid-column:1 / -1" class="hstack">
        <a class="btn btn-muted" href="{{ route('letters.index') }}">Batal</a>
        <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
    </div>
</form>
</div>
@endsection
