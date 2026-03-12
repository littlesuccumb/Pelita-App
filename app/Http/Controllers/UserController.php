<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests;

    /**
     * Constructor - Apply middleware for super admin access only
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:super_admin']);
    }

    /**
     * Display a listing of users (Super Admin only)
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('jabatan', 'LIKE', "%{$search}%")
                  ->orWhere('instansi', 'LIKE', "%{$search}%")
                  ->orWhere('no_telp', 'LIKE', "%{$search}%")
                  ->orWhere('no_ktp', 'LIKE', "%{$search}%");
            });
        }

        // Sort
        $sortBy = $request->get('sort', 'name');
        $sortOrder = $request->get('order', 'asc');
        
        // Validate sort column
        $allowedSorts = ['name', 'email', 'role', 'created_at'];
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'name';
        }
        
        $query->orderBy($sortBy, $sortOrder);

        $users = $query->paginate(15);

        // Statistics for dashboard
        $stats = [
            'total' => User::count(),
            'user' => User::where('role', 'user')->count(),
            'admin' => User::where('role', 'admin')->count(),
            'super_admin' => User::where('role', 'super_admin')->count(),
            'pengurus_aset' => User::where('role', 'pengurus_aset')->count(),
        ];

        return view('admin.users.index', compact('users', 'stats'));
    }

    /**
     * Show the form for creating a new user (Super Admin only)
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in database (Super Admin only)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,admin,super_admin,pengurus_aset',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jabatan' => 'nullable|string|max:255',
            'instansi' => 'nullable|string|max:255',
            'nama_organisasi' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'no_ktp' => 'nullable|string|max:255',
            'kelurahan' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'kode_pos' => 'nullable|string|max:255',
        ]);

        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'jabatan' => $request->jabatan,
                'instansi' => $request->instansi,
                'nama_organisasi' => $request->nama_organisasi,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'no_ktp' => $request->no_ktp,
                'kelurahan' => $request->kelurahan,
                'kecamatan' => $request->kecamatan,
                'kabupaten' => $request->kabupaten,
                'kode_pos' => $request->kode_pos,
            ];

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
            }

            $user = User::create($data);

            // Log aktivitas
            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aksi' => 'Menambah User',
                'detail' => "Super Admin menambahkan user baru: {$user->name} ({$user->email}) dengan role: {$user->role}",
            ]);

            return redirect()->route('admin.users.index')
                ->with('success', 'User berhasil ditambahkan.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified user details (Super Admin only)
     */
    public function show(User $user)
    {
        // Initialize empty stats
        $stats = [
            'total_permohonan' => 0,
            'permohonan_disetujui' => 0,
            'permohonan_ditolak' => 0,
            'permohonan_pending' => 0,
            'total_peminjaman' => 0,
            'peminjaman_disetujui' => 0,
            'peminjaman_selesai' => 0,
            'peminjaman_ditolak' => 0,
            'peminjaman_menunggu' => 0,
        ];

        $recentPermohonan = collect(); // Empty collection
        $recentPeminjaman = collect(); // Empty collection

        // Load statistik HANYA untuk role 'user'
        if ($user->role === 'user') {
            $stats = [
                'total_permohonan' => $user->permohonan()->count(),
                'permohonan_disetujui' => $user->permohonan()->where('status', 'Disetujui')->count(),
                'permohonan_ditolak' => $user->permohonan()->where('status', 'Ditolak')->count(),
                'permohonan_pending' => $user->permohonan()->where('status', 'Dalam Proses')->count(),
                
                'total_peminjaman' => $user->peminjaman()->count(),
                'peminjaman_disetujui' => $user->peminjaman()->where('status', 'disetujui')->count(),
                'peminjaman_selesai' => $user->peminjaman()->where('status', 'selesai')->count(),
                'peminjaman_ditolak' => $user->peminjaman()->where('status', 'ditolak')->count(),
                'peminjaman_menunggu' => $user->peminjaman()->where('status', 'menunggu')->count(),
            ];

            // Recent permohonan dengan items
            $recentPermohonan = $user->permohonan()
                ->with(['items.barang.kategori'])
                ->latest()
                ->take(5)
                ->get();

            // Recent peminjaman barang only
            $recentPeminjaman = $user->peminjaman()
                ->with(['barang.kategori'])
                ->where('jenis_aset', 'barang')
                ->latest()
                ->take(5)
                ->get();
        }

        return view('admin.users.show', compact('user', 'stats', 'recentPermohonan', 'recentPeminjaman'));
    }

    /**
     * Show the form for editing the specified user (Super Admin only)
     */
    public function edit(User $user)
    {
        // Prevent super_admin from editing themselves if they're the only super_admin
        if ($user->role === 'super_admin' && $user->id === Auth::id()) {
            $superAdminCount = User::where('role', 'super_admin')->count();
            if ($superAdminCount <= 1) {
                return back()->with('error', 'Tidak dapat mengubah data super admin terakhir.');
            }
        }

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in database (Super Admin only)
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:user,admin,super_admin,pengurus_aset',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jabatan' => 'nullable|string|max:255',
            'instansi' => 'nullable|string|max:255',
            'nama_organisasi' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'no_ktp' => 'nullable|string|max:255',
            'kelurahan' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
            'kode_pos' => 'nullable|string|max:255',
        ]);

        // Prevent changing role of the last super_admin
        if ($user->role === 'super_admin' && $request->role !== 'super_admin') {
            $superAdminCount = User::where('role', 'super_admin')->count();
            if ($superAdminCount <= 1) {
                return back()->with('error', 'Tidak dapat mengubah role super admin terakhir.');
            }
        }

        try {
            $data = $request->except(['password', 'avatar']);
            
            // Update password if provided
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                // Delete old avatar if exists
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }
                
                $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
            }

            $user->update($data);

            // Log aktivitas
            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aksi' => 'Mengubah User',
                'detail' => "Super Admin mengubah data user: {$user->name} ({$user->email})",
            ]);

            return redirect()->route('admin.users.index')
                ->with('success', 'User berhasil diperbarui.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified user from database (Super Admin only)
     */
    public function destroy(User $user)
    {
        // Prevent deleting super_admin if they're the only one
        if ($user->role === 'super_admin') {
            $superAdminCount = User::where('role', 'super_admin')->count();
            if ($superAdminCount <= 1) {
                return back()->with('error', 'Tidak dapat menghapus super admin terakhir.');
            }
        }

        // Prevent deleting currently logged in user
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Tidak dapat menghapus akun yang sedang login.');
        }

        // Prevent deleting user with active permohonan
        $activePermohonan = $user->permohonan()
            ->where('status', 'Dalam Proses')
            ->count();

        if ($activePermohonan > 0) {
            return back()->with('error', 'Tidak dapat menghapus user yang memiliki permohonan aktif.');
        }

        // Prevent deleting user with active peminjaman
        $activePeminjaman = $user->peminjaman()
            ->whereIn('status', ['menunggu', 'disetujui'])
            ->count();

        if ($activePeminjaman > 0) {
            return back()->with('error', 'Tidak dapat menghapus user yang memiliki peminjaman aktif.');
        }

        try {
            $userName = $user->name;
            $userEmail = $user->email;
            
            // Delete avatar if exists
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            $user->delete();

            // Log aktivitas
            LogAktivitas::create([
                'user_id' => Auth::id(),
                'aksi' => 'Menghapus User',
                'detail' => "Super Admin menghapus user: {$userName} ({$userEmail})",
            ]);

            return redirect()->route('admin.users.index')
                ->with('success', 'User berhasil dihapus.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Delete user avatar (Super Admin only)
     */
    public function deleteAvatar(User $user)
    {
        try {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
                $user->update(['avatar' => null]);

                // Log aktivitas
                LogAktivitas::create([
                    'user_id' => Auth::id(),
                    'aksi' => 'Menghapus Avatar User',
                    'detail' => "Super Admin menghapus avatar user: {$user->name}",
                ]);

                return back()->with('success', 'Avatar berhasil dihapus.');
            }

            return back()->with('error', 'Avatar tidak ditemukan.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Get users for API/AJAX calls (Super Admin only)
     * Used for dropdowns, autocomplete, etc
     */
    public function getUsers(Request $request)
    {
        $query = User::select('id', 'name', 'email', 'role', 'avatar');
        
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }
        
        $users = $query->orderBy('name')->get();
        
        return response()->json($users);
    }
}