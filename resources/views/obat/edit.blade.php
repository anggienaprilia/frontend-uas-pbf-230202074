@extends('adminlte::page')

@section('title', 'Edit obat')

@section('content')
    <h1>Edit Data obat</h1>

    <form action="{{ route('obat.update', $obat['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_obat">Nama Obat</label>
            <input type="text" name="nama_obat" value="{{ $obat['nama_obat'] }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="kategori">Kategori</label>
            <input type="text" name="kategori" value="{{ $obat['kategori'] }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="stok">Stok</label>
            <input type="int" name="stok" value="{{ $obat['stok'] }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="decimal" name="harga" value="{{ $obat['harga'] }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('obat.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
