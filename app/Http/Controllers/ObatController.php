<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    protected $api;

    public function __construct(ApiService $api)
    {
        $this->api = $api;
    }

    public function index(Request $request)
    {
        $obat = $this->api->get('obat');

        if (!is_array($obat)) {
            $obat = [];
        }

        // Sorting berdasarkan parameter query
        switch ($request->sort) {
            case 'nama_obat_asc':
                usort($obat, fn($a, $b) => strcmp($a['nama_obat'], $b['nama_obat']));
                break;
            case 'nama_obat_desc':
                usort($obat, fn($a, $b) => strcmp($b['nama_obat'], $a['nama_obat']));
                break;
            case 'kategori_asc':
                usort($obat, fn($a, $b) => ($a['kategori'] ?? 0) <=> ($b['kategori'] ?? 0));
                break;
            case 'kategori_desc':
                usort($obat, fn($a, $b) => ($b['kategori'] ?? 0) <=> ($a['kategori'] ?? 0));
                break;
        }

        return view('obat.index', compact('obat'));
    }

    public function create()
    {
        return view('obat.create');
    }

    public function store(Request $request)
    {
        $this->api->post('obat', $request->all());

        return redirect()->route('obat.index')
            ->with('success', 'Data obat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = $this->api->get("obat/{$id}");

        if (!is_array($data) || !isset($data['id'])) {
            return abort(404, 'Data obat tidak ditemukan atau API gagal diakses');
        }

        return view('obat.edit', ['obat' => $data]);
    }

    public function update(Request $request, $id)
    {
        $this->api->put("obat/{$id}", $request->all());

        return redirect()->route('obat.index')
            ->with('success', 'Data obat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->api->delete("obat/{$id}");

        return redirect()->route('obat.index')
            ->with('success', 'Data obat berhasil dihapus.');
    }
}
