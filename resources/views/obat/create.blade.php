@extends('adminlte::page')

@section('title', 'Tambah obat')

@section('content')
    <h1>Tambah Data obat</h1>

    <form action="{{ route('obat.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_obat">Nama obat</label>
            <input type="text" name="nama_obat" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="kategori">Kategori</label>
            <input type="text" name="kategori" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="stok">Stok</label>
            <input type="int" name="stok" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="decimal" name="harga" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('obat.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
