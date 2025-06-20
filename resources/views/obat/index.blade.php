@extends('adminlte::page')

@section('title', 'Data Obat')

@section('content')
    <h1>Data Obat</h1>

    {{-- Tampilkan notifikasi jika ada --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Tombol Tambah dan Filter --}}
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('obat.create') }}" class="btn btn-primary">Tambah Obat</a>

        <form method="GET" action="{{ route('obat.index') }}">
            <div class="input-group">
                <select name="sort" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Urutkan --</option>
                    <option value="nama_obat_asc" {{ request('sort') == 'nama_obat_asc_asc' ? 'selected' : '' }}>Nama Obat A-Z</option>
                    <option value="nama_obat_desc" {{ request('sort') == 'nama_obat_asc_desc' ? 'selected' : '' }}>Nama Obat Z-A</option>
                    <option value="kategori_asc" {{ request('sort') == 'kategori_asc' ? 'selected' : '' }}>Kategori A-Z</option>
                    <option value="kategori_desc" {{ request('sort') == 'kategori_desc' ? 'selected' : '' }}>Kategori Z-A</option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Filter</button>
                </div>
            </div>
        </form>
    </div>

    {{-- Tabel --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Obat</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (is_array($obat) && count($obat) > 0)
                @foreach ($obat as $item)
                    @if (is_array($item) && isset($item['id']))
                        <tr>
                            <td>{{ $item['nama_obat'] ?? '-' }}</td>
                            <td>{{ $item['kategori'] ?? '-' }}</td>
                            <td>{{ $item['stok'] ?? '-' }}</td>
                            <td>{{ $item['harga'] ?? '-' }}</td>
                            <td>
                                <a href="{{ route('obat.edit', $item['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('obat.destroy', $item['id']) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center">Data obat belum tersedia atau gagal diambil dari server.</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
