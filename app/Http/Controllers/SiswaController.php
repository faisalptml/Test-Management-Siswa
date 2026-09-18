<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with('lembaga')
            ->latest()
            ->get();

        $lembagas = Lembaga::orderBy('nama_lembaga')
            ->get();

        return view('siswa.index', compact('siswas', 'lembagas'));
    }

    public function create()
    {
        $lembagas = Lembaga::orderBy('nama_lembaga')
            ->get();

        return view('siswa.create', compact('lembagas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lembaga_id' => [
                'required',
                'integer',
                'exists:lembagas,id',
            ],

            'nis' => [
                'required',
                'numeric',
                'unique:siswas,nis',
            ],

            'nama_siswa' => [
                'required',
                'string',
                'max:150',
            ],

            'email' => [
                'required',
                'email',
                'max:150',
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:100',
            ],
        ], [
            'lembaga_id.required' => 'Lembaga wajib dipilih.',
            'lembaga_id.exists' => 'Lembaga tidak valid.',

            'nis.required' => 'NIS wajib diisi.',
            'nis.numeric' => 'NIS harus berupa angka.',
            'nis.unique' => 'NIS sudah digunakan.',

            'nama_siswa.required' => 'Nama siswa wajib diisi.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',

            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Foto hanya boleh JPG atau PNG.',
            'foto.max' => 'Ukuran foto maksimal 100KB.',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')
                ->store('siswa', 'public');
        }

        Siswa::create($validated);

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa)
    {
        $lembagas = Lembaga::orderBy('nama_lembaga')
            ->get();

        return view('siswa.edit', compact('siswa', 'lembagas'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'lembaga_id' => [
                'required',
                'integer',
                'exists:lembagas,id',
            ],

            'nis' => [
                'required',
                'numeric',
                Rule::unique('siswas', 'nis')->ignore($siswa->id),
            ],

            'nama_siswa' => [
                'required',
                'string',
                'max:150',
            ],

            'email' => [
                'required',
                'email',
                'max:150',
            ],

            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:100',
            ],
        ], [
            'lembaga_id.required' => 'Lembaga wajib dipilih.',
            'lembaga_id.exists' => 'Lembaga tidak valid.',

            'nis.required' => 'NIS wajib diisi.',
            'nis.numeric' => 'NIS harus berupa angka.',
            'nis.unique' => 'NIS sudah digunakan.',

            'nama_siswa.required' => 'Nama siswa wajib diisi.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',

            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Foto hanya boleh JPG atau PNG.',
            'foto.max' => 'Ukuran foto maksimal 100KB.',
        ]);

        if ($request->hasFile('foto')) {

            if ($siswa->foto) {
                Storage::disk('public')->delete($siswa->foto);
            }

            $validated['foto'] = $request->file('foto')
                ->store('siswa', 'public');
        }

        $siswa->update($validated);

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        if ($siswa->foto) {
            Storage::disk('public')->delete($siswa->foto);
        }

        $siswa->delete();

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}
