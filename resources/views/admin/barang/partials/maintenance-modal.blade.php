<!-- Modal Maintenance untuk Barang ID: {{ $barang->id }} -->
<!-- Modal Maintenance untuk Barang ID: {{ $barang->id }} -->
<div id="maintenance-modal-{{ $barang->id }}" 
     class="fixed inset-0 bg-black/60 dark:bg-black/80 backdrop-blur-md overflow-y-auto h-full w-full hidden z-[9999] transition-all duration-300">
    <div class="relative top-20 mx-auto p-5 border-0 w-11/12 max-w-md shadow-2xl rounded-xl bg-white dark:bg-gray-800 animate-slide-up">
        <div class="mt-3">
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="p-3 bg-orange-100 dark:bg-orange-900/30 rounded-lg mr-3">
                        <i class="fas fa-tools text-orange-600 dark:text-orange-400"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Jadwalkan Maintenance</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $barang->nama_barang }}</p>
                    </div>
                </div>
                <button onclick="closeMaintenanceModal('{{ $barang->id }}')" 
                        class="p-2 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-all">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form action="{{ route('admin.barang.maintenance', $barang->id) }}" 
                  method="POST" 
                  id="form-maintenance-{{ $barang->id }}"
                  onsubmit="return validateMaintenanceForm('{{ $barang->id }}')">
                @csrf
                
                <!-- Info Stok -->
                <div class="mb-4 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/30 dark:to-indigo-900/30 rounded-lg border border-blue-200 dark:border-blue-700">
                    <div class="flex items-center justify-between text-sm mb-2">
                        <span class="text-blue-700 dark:text-blue-400 font-medium">Stok Tersedia:</span>
                        <span class="font-bold text-blue-900 dark:text-blue-300 text-lg">{{ $barang->jumlah_tersedia }} unit</span>
                    </div>
                    @if($barang->jumlah_maintenance > 0)
                    <div class="flex items-center justify-between text-sm pt-2 border-t border-blue-200 dark:border-blue-700">
                        <span class="text-orange-700 dark:text-orange-400">Sedang Maintenance:</span>
                        <span class="font-semibold text-orange-900 dark:text-orange-300">{{ $barang->jumlah_maintenance }} unit</span>
                    </div>
                    @endif
                    <div class="flex items-center justify-between text-sm pt-2 border-t border-blue-200 dark:border-blue-700">
                        <span class="text-gray-700 dark:text-gray-300">Total Stok:</span>
                        <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $barang->jumlah_total }} unit</span>
                    </div>
                </div>

                <!-- Jumlah Unit untuk Maintenance -->
                <div class="mb-4">
                    <label for="jumlah-{{ $barang->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Jumlah Unit <span class="text-red-500 dark:text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <input type="number" 
                               name="jumlah" 
                               id="jumlah-{{ $barang->id }}"
                               min="1" 
                               max="{{ $barang->jumlah_tersedia }}"
                               value="1"
                               required
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all"
                               onchange="updateMaintenancePreview('{{ $barang->id }}')">
                        <div class="absolute right-3 top-2.5 text-gray-400 dark:text-gray-500">
                            <i class="fas fa-calculator"></i>
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-2">
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            <i class="fas fa-info-circle mr-1"></i>
                            Maksimal: {{ $barang->jumlah_tersedia }} unit
                        </p>
                        <div class="flex space-x-1">
                            <button type="button" onclick="setQuickAmount('{{ $barang->id }}', 1)" 
                                    class="px-2 py-1 text-xs bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded transition-all">1</button>
                            @if($barang->jumlah_tersedia >= 5)
                            <button type="button" onclick="setQuickAmount('{{ $barang->id }}', 5)" 
                                    class="px-2 py-1 text-xs bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded transition-all">5</button>
                            @endif
                            @if($barang->jumlah_tersedia >= 10)
                            <button type="button" onclick="setQuickAmount('{{ $barang->id }}', 10)" 
                                    class="px-2 py-1 text-xs bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded transition-all">10</button>
                            @endif
                            <button type="button" onclick="setQuickAmount('{{ $barang->id }}', {{ $barang->jumlah_tersedia }})" 
                                    class="px-2 py-1 text-xs bg-blue-100 dark:bg-blue-900/50 hover:bg-blue-200 dark:hover:bg-blue-800/50 text-blue-700 dark:text-blue-300 rounded transition-all">Semua</button>
                        </div>
                    </div>
                </div>

                <!-- Preview Stok Setelah Maintenance -->
                <div id="preview-{{ $barang->id }}" class="mb-4 p-3 bg-yellow-50 dark:bg-yellow-900/30 rounded-lg border border-yellow-200 dark:border-yellow-700 hidden">
                    <div class="flex items-center text-sm text-yellow-800 dark:text-yellow-300">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <span>Stok tersedia setelah maintenance: <strong id="preview-value-{{ $barang->id }}"></strong> unit</span>
                    </div>
                </div>

                <!-- Jenis Maintenance -->
                <div class="mb-4">
                    <label for="jenis_maintenance-{{ $barang->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Jenis Maintenance <span class="text-red-500 dark:text-red-400">*</span>
                    </label>
                    <select name="jenis_maintenance" 
                            id="jenis_maintenance-{{ $barang->id }}"
                            required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all">
                        <option value="">Pilih Jenis</option>
                        <option value="preventif">🛡️ Preventif (Pencegahan Rutin)</option>
                        <option value="korektif">🔧 Korektif (Perbaikan)</option>
                        <option value="emergency">⚠️ Emergency (Darurat/Rusak Berat)</option>
                    </select>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        <i class="fas fa-lightbulb mr-1"></i>
                        Pilih sesuai tingkat urgensi maintenance
                    </p>
                </div>

                <!-- Deskripsi -->
                <div class="mb-4">
                    <label for="deskripsi-{{ $barang->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Deskripsi Maintenance <span class="text-red-500 dark:text-red-400">*</span>
                    </label>
                    <textarea name="deskripsi" 
                              id="deskripsi-{{ $barang->id }}"
                              rows="3" 
                              required
                              maxlength="500"
                              placeholder="Contoh: Penggantian komponen rusak, pembersihan menyeluruh, perbaikan sistem kelistrikan, dll..."
                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:placeholder-gray-400 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 resize-none transition-all"></textarea>
                    <div class="flex items-center justify-between mt-1">
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            <span id="char-count-{{ $barang->id }}" class="font-semibold">0</span>/500 karakter
                        </p>
                        <p class="text-xs text-red-600 dark:text-red-400 font-medium">
                            Minimal 10 karakter
                        </p>
                    </div>
                </div>

                <!-- Teknisi -->
                <div class="mb-4">
                    <label for="teknisi-{{ $barang->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nama Teknisi <span class="text-gray-400 dark:text-gray-500">(Opsional)</span>
                    </label>
                    <div class="relative">
                        <input type="text" 
                               name="teknisi" 
                               id="teknisi-{{ $barang->id }}"
                               placeholder="Contoh: Ahmad Maintenance Team"
                               class="w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:placeholder-gray-400 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all">
                        <div class="absolute left-3 top-2.5 text-gray-400 dark:text-gray-500">
                            <i class="fas fa-user-cog"></i>
                        </div>
                    </div>
                </div>

                <!-- Biaya -->
                <div class="mb-4">
                    <label for="biaya-{{ $barang->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Estimasi Biaya <span class="text-gray-400 dark:text-gray-500">(Opsional)</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-2.5 text-gray-500 dark:text-gray-400 font-medium">Rp</span>
                        <input type="number" 
                               name="biaya" 
                               id="biaya-{{ $barang->id }}"
                               min="0"
                               placeholder="0"
                               class="w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:placeholder-gray-400 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-all">
                        <div class="absolute right-3 top-2.5 text-gray-400 dark:text-gray-500">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Kosongkan jika belum ada estimasi biaya
                    </p>
                </div>

                <!-- Warning Info -->
                <div class="mb-4 p-3 bg-amber-50 dark:bg-amber-900/30 rounded-lg border border-amber-200 dark:border-amber-700">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-amber-600 dark:text-amber-400 mt-0.5"></i>
                        </div>
                        <div class="ml-2">
                            <p class="text-xs text-amber-800 dark:text-amber-300 font-medium">
                                Perhatian!
                            </p>
                            <p class="text-xs text-amber-700 dark:text-amber-400 mt-1">
                                Unit yang dijadwalkan maintenance akan dikurangi dari stok tersedia dan tidak dapat dipinjam hingga selesai.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button type="button" 
                            onclick="closeMaintenanceModal('{{ $barang->id }}')" 
                            class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg font-medium transition-all">
                        <i class="fas fa-times mr-1"></i>
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 text-white bg-gradient-to-r from-orange-600 to-orange-700 hover:from-orange-700 hover:to-orange-800 rounded-lg font-medium transition-all shadow-md hover:shadow-lg">
                        <i class="fas fa-tools mr-2"></i>
                        Jadwalkan Maintenance
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>