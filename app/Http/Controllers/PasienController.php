<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    protected $api;

    public function __construct(ApiService $api)
    {
        $this->api = $api;
    }

    public function index(Request $request)
    {
        $pasien = $this->api->get('pasien');

        if (!is_array($pasien)) {
            $pasien = [];
        }

        // Sorting berdasarkan parameter query
        switch ($request->sort) {
            case 'nama_pasien_asc':
                usort($pasien, fn($a, $b) => strcmp($a['nama'], $b['nama']));
                break;
            case 'nama_pasien_desc':
                usort($pasien, fn($a, $b) => strcmp($b['nama'], $a['nama']));
                break;
            case 'tanggal_lahir_asc':
                usort($tanggal_lahir, fn($a, $b) => strtotime($a['tanggal_lahir']) <=> strtotime($b['tanggal_lahir']));
                break;
            case 'tanggal_lahir_desc':
                usort($tanggal_lahir, fn($a, $b) => strtotime($b['tanggal_lahir']) <=> strtotime($a['tanggal_lahir']));
                break;
        }

        return view('pasien.index', compact('pasien'));
    }

    public function create()
    {
        return view('pasien.create');
    }

    public function store(Request $request)
    {
        $this->api->post('pasien', $request->all());

        return redirect()->route('pasien.index')
            ->with('success', 'Data pasien berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = $this->api->get("pasien/{$id}");

        if (!is_array($data) || !isset($data['id'])) {
            return abort(404, 'Data pasien tidak ditemukan atau API gagal diakses');
        }

        return view('pasien.edit', ['pasien' => $data]);
    }

    public function update(Request $request, $id)
    {
        $this->api->put("pasien/{$id}", $request->all());

        return redirect()->route('pasien.index')
            ->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->api->delete("pasien/{$id}");

        return redirect()->route('pasien.index')
            ->with('success', 'Data pasien berhasil dihapus.');
    }
}
