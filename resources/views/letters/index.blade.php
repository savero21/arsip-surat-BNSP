@extends('layouts.app')

@section('content')
<div class="header">
    <h1>Arsip Surat</h1>
    <div class="small">
        Berikut ini adalah surat-surat resmi yang telah diterbitkan dan diarsipkan.
        Klik "Lihat" pada kolom aksi untuk menampilkan surat.
    </div>
</div>

<form class="search" method="GET" action="{{ route('letters.index') }}">
    <input type="text" name="q" placeholder="Cari surat (judul / nomor)..." value="{{ $q }}">
    <button class="btn btn-primary" type="submit">Cari!</button>
    <a class="btn btn-muted" href="{{ route('letters.index') }}">Reset</a>
</form>

<div class="card" style="padding:12px">
    <table class="table">
        <thead>
            <tr>
                <th>Nomor Surat</th>
                <th>Kategori</th>
                <th>Judul</th>
                <th>Waktu Pengarsipan</th>
                <th style="width:250px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($letters as $l)
            <tr>
                <td>{{ $l->number }}</td>
                <td>{{ $l->category->name }}</td>
                <td>{{ $l->title }}</td>
                <td>{{ $l->archived_at->format('Y-m-d H:i') }}</td>
                <td class="actions hstack gap-2">
                    {{-- Tombol Hapus dengan SweetAlert --}}
                    <form action="{{ route('letters.destroy',$l) }}" method="POST" class="d-inline delete-form">
                        @csrf 
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm btn-delete">Hapus</button>
                    </form>

                    {{-- Tombol Unduh via Blob --}}
                    <button type="button" class="btn btn-warning btn-sm btn-download"
                        data-url="{{ route('letters.stream',$l) }}"
                        data-filename="{{ \Illuminate\Support\Str::slug($l->title, '_') }}.pdf">
                        Unduh
                    </button>

                    <a class="btn btn-navy btn-sm" href="{{ route('letters.show',$l) }}">Lihat &raquo;</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Belum ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer-action hstack" style="justify-content:space-between">
        <div>{{ $letters->withQueryString()->links() }}</div>
        <a class="btn btn-primary" href="{{ route('letters.create') }}">Arsipkan Surat..</a>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    // Konfirmasi hapus pakai SweetAlert
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            let form = this.closest('form');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Arsip surat ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-danger mx-2',
                    cancelButton: 'btn btn-secondary mx-2'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endpush
