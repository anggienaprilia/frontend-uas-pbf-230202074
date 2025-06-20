@extends('adminlte::page')

@section('title', 'Data Pasien')

@section('content')
    <h1>Data Pasien</h1>

    {{-- Notifikasi jika ada --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Tombol Tambah dan Filter --}}
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('pasien.create') }}" class="btn btn-primary">Tambah Pasien</a>

        <form method="GET" action="{{ route('pasien.index') }}">
            <div class="input-group">
                <select name="sort" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Urutkan --</option>
                    <option value="nama_pasien_asc" {{ request('sort') == 'nama_pasien_asc' ? 'selected' : '' }}>Nama A-Z</option>
                    <option value="nama_pasien_desc" {{ request('sort') == 'nama_pasien_desc' ? 'selected' : '' }}>Nama Z-A</option>
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
                <th>Nama Pasien</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (is_array($pasien) && count($pasien) > 0)
                @foreach ($pasien as $item)
                    @if (is_array($item) && isset($item['id']))
                        <tr>
                            <td>{{ $item['nama'] ?? '-' }}</td>
                            <td>{{ $item['alamat'] ?? '-' }}</td>
                            <td>{{ $item['tanggal_lahir'] ?? '-' }}</td>
                            <td>{{ $item['jenis_kelamin'] ?? '-' }}</td>
                            <td>
                                <a href="{{ route('pasien.edit', $item['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('pasien.destroy', $item['id']) }}" method="POST" style="display:inline;">
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
                    <td colspan="5" class="text-center">Data pasien belum tersedia atau gagal dimuat.</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection
