<?php
// ===============================
// KategoriBarangController.php
// ===============================

namespace App\Http\Controllers;

use App\Models\KategoriBarang;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriBarangController extends Controller
{
    public function index(Request $request)
    {
        $query = KategoriBarang::withCount('barang');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama_kategori', 'LIKE', "%{$search}%")
                  ->orWhere('deskripsi', 'LIKE', "%{$search}%");
        }

        $kategoriBarang = $query->latest()->paginate(10);

        return view('admin.kategori-barang.index', compact('kategoriBarang'));
    }

    public function create()
    {
        return view('admin.kategori-barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_barang',
            'deskripsi' => 'nullable|string',
        ]);

        try {
            $kategoriBarang = KategoriBarang::create($request->all());

            // Log aktivitas
            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aksi' => 'Menambah Kategori Barang',
                'detail' => "Menambahkan kategori barang: {$kategoriBarang->nama_kategori}",
            ]);

            return redirect()->route('admin.kategori-barang.index')
                ->with('success', 'Kategori barang berhasil ditambahkan.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function show(KategoriBarang $kategoriBarang)
    {
        $kategoriBarang->loadCount('barang');
        $barang = $kategoriBarang->barang()->paginate(10);
        
        return view('admin.kategori-barang.show', compact('kategoriBarang', 'barang'));
    }

    public function edit(KategoriBarang $kategoriBarang)
    {
        $kategoriBarang->loadCount('barang');
        $barang = $kategoriBarang->barang()->paginate(10);

        return view('admin.kategori-barang.edit', compact('kategoriBarang','barang'));
    }

    public function update(Request $request, KategoriBarang $kategoriBarang)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori_barang,nama_kategori,' . $kategoriBarang->id,
            'deskripsi' => 'nullable|string',
        ]);

        try {
            $kategoriBarang->update($request->all());

            // Log aktivitas
            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aksi' => 'Mengubah Kategori Barang',
                'detail' => "Mengubah kategori barang: {$kategoriBarang->nama_kategori}",
            ]);

            return redirect()->route('admin.kategori-barang.index')
                ->with('success', 'Kategori barang berhasil diperbarui.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(KategoriBarang $kategoriBarang)
    {
        // Cek apakah kategori masih digunakan
        if ($kategoriBarang->barang()->count() > 0) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh barang.');
        }

        try {
            $namaKategori = $kategoriBarang->nama_kategori;
            $kategoriBarang->delete();

            // Log aktivitas
            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aksi' => 'Menghapus Kategori Barang',
                'detail' => "Menghapus kategori barang: {$namaKategori}",
            ]);

            return redirect()->route('admin.kategori-barang.index')
                ->with('success', 'Kategori barang berhasil dihapus.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
