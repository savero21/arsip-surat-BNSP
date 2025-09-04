@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Kategori Surat</h3>
    <p>Berikut ini adalah kategori yang bisa digunakan untuk melabeli surat.</p>

    <div class="mb-3">
        <a href="{{ route('categories.create') }}" 
           class="btn btn-success border fw-semibold px-3">
           + Tambah Kategori Baru
        </a>
    </div>

    <table class="table table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th style="width:120px;">ID</th>
                <th>Nama Kategori</th>
                <th>Keterangan</th>
                <th style="width:180px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->kode_kategori }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="{{ route('categories.edit', $category->id) }}" 
                           class="btn btn-primary btn-sm px-3">
                           Edit
                        </a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm btn-delete">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            let form = this.closest('form');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data kategori ini akan dihapus permanen!",
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
