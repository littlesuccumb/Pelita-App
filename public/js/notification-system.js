/**
 * Advanced Notification System untuk Laravel
 * File: public/js/notification-system.js
 */

const NotificationSystem = {
    templates: {
        success: {
            'basic': {
                icon: '<i class="fas fa-check-circle"></i>',
                title: '✨ Berhasil!',
                message: 'Operasi berhasil diselesaikan.',
                color: '#10b981',
                duration: 5000
            },
            'data-added': {
                icon: '<i class="fas fa-plus-circle"></i>',
                title: '✨ Barang Ditambahkan!',
                message: null, // akan diambil dari data
                color: '#10b981',
                duration: 5000
            },
            'data-updated': {
                icon: '<i class="fas fa-sync-alt"></i>',
                title: '✨ Data Diperbarui!',
                message: null,
                color: '#10b981',
                duration: 5000
            },
            'deleted': {
                icon: '<i class="fas fa-trash-alt"></i>',
                title: '✨ Barang Dihapus!',
                message: null,
                color: '#10b981',
                duration: 5000
            },
            'photos-uploaded': {
                icon: '<i class="fas fa-images"></i>',
                title: '✨ Foto Berhasil Diupload!',
                message: null,
                color: '#10b981',
                duration: 5000
            },
            'maintenance-scheduled': {
                icon: '<i class="fas fa-tools"></i>',
                title: '✨ Maintenance Dijadwalkan!',
                message: null,
                color: '#10b981',
                duration: 5000
            },
            'import-completed': {
                icon: '<i class="fas fa-file-import"></i>',
                title: '✨ Import Selesai!',
                message: null,
                color: '#10b981',
                duration: 5000
            }
        },
        error: {
            'basic': {
                icon: '<i class="fas fa-times-circle"></i>',
                title: '❌ Gagal!',
                message: 'Operasi gagal. Silakan coba lagi.',
                color: '#ef4444',
                duration: 6000
            },
            'validation': {
                icon: '<i class="fas fa-exclamation-circle"></i>',
                title: '❌ Validasi Error!',
                message: 'Terdapat kesalahan pada form:',
                color: '#ef4444',
                duration: 7000
            },
            'upload': {
                icon: '<i class="fas fa-cloud-upload-alt"></i>',
                title: '❌ Upload Gagal!',
                message: null,
                color: '#ef4444',
                duration: 8000
            },
            'delete-failed': {
                icon: '<i class="fas fa-trash-alt"></i>',
                title: '❌ Hapus Gagal!',
                message: null,
                color: '#ef4444',
                duration: 6000
            },
            'import-failed': {
                icon: '<i class="fas fa-file-import"></i>',
                title: '❌ Import Gagal!',
                message: null,
                color: '#ef4444',
                duration: 8000
            }
        },
        warning: {
            'basic': {
                icon: '<i class="fas fa-exclamation-triangle"></i>',
                title: '⚠️ Peringatan!',
                message: 'Ada beberapa hal yang perlu diperhatikan.',
                color: '#f59e0b',
                duration: 6000
            },
            'low-stock': {
                icon: '<i class="fas fa-box-open"></i>',
                title: '⚠️ Stok Menipis!',
                message: null,
                color: '#f59e0b',
                duration: 7000
            },
            'partial-upload-fail': {
                icon: '<i class="fas fa-exclamation"></i>',
                title: '⚠️ Sebagian Foto Gagal!',
                message: null,
                color: '#f59e0b',
                duration: 8000
            },
            'partial-import-fail': {
                icon: '<i class="fas fa-exclamation"></i>',
                title: '⚠️ Sebagian Data Gagal!',
                message: null,
                color: '#f59e0b',
                duration: 8000
            },
            'active-loans': {
                icon: '<i class="fas fa-hourglass-end"></i>',
                title: '⚠️ Barang Sedang Dipinjam!',
                message: null,
                color: '#f59e0b',
                duration: 6000
            }
        },
        info: {
            'basic': {
                icon: '<i class="fas fa-info-circle"></i>',
                title: 'ℹ️ Informasi',
                message: 'Informasi penting untuk Anda.',
                color: '#3b82f6',
                duration: 5000
            },
            'stock-update': {
                icon: '<i class="fas fa-box"></i>',
                title: 'ℹ️ Update Stok',
                message: null,
                color: '#3b82f6',
                duration: 5000
            },
            'maintenance-info': {
                icon: '<i class="fas fa-tools"></i>',
                title: 'ℹ️ Maintenance Dijadwalkan',
                message: null,
                color: '#3b82f6',
                duration: 5000
            },
            'import-progress': {
                icon: '<i class="fas fa-upload"></i>',
                title: 'ℹ️ Import Progress',
                message: null,
                color: '#3b82f6',
                duration: 5000
            }
        }
    },

    show(type, subType, data = {}) {
        const template = this.templates[type]?.[subType] || this.templates[type]?.basic;
        if (!template) {
            console.warn(`Template tidak ditemukan: ${type}.${subType}`);
            return;
        }

        const container = document.getElementById('notification-container');
        if (!container) {
            console.warn('Notification container tidak ditemukan');
            return;
        }

        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.style.setProperty('--color', template.color);

        // Prepare message
        const message = data.message || template.message;

        // Prepare details
        let detailsHTML = '';
        if (data.details && data.details.length > 0) {
            detailsHTML = `
                <div class="notification-list">
                    ${data.details.map(detail => `
                        <div class="notification-list-item" style="border-left-color: var(--color);">
                            ${detail.icon}
                            <span>${detail.text}</span>
                        </div>
                    `).join('')}
                </div>
            `;
        }

        // Prepare action button
        let actionHTML = '';
        if (data.action) {
            actionHTML = `
                <div class="notification-footer">
                    <button class="notification-btn notification-btn-dismiss" onclick="this.closest('.notification').classList.add('exit'); setTimeout(() => this.closest('.notification').remove(), 400)">
                        Tutup
                    </button>
                    <button class="notification-btn notification-btn-action" style="color: var(--color);" onclick="${data.actionCallback || `alert('${data.action}')`}; this.closest('.notification').classList.add('exit'); setTimeout(() => this.closest('.notification').remove(), 400)">
                        ${data.action}
                    </button>
                </div>
            `;
        }

        notification.innerHTML = `
            <div class="notification-header">
                <div class="notification-icon">${template.icon}</div>
                <div class="notification-header-content">
                    <div class="notification-title">${template.title}</div>
                    <div class="notification-time">
                        <i class="fas fa-clock"></i>
                        <span>Baru saja</span>
                    </div>
                </div>
                <button class="notification-close" onclick="this.closest('.notification').classList.add('exit'); setTimeout(() => this.closest('.notification').remove(), 400)">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="notification-body">
                <p class="notification-message">${message}</p>
                ${detailsHTML}
            </div>
            ${actionHTML}
            <div class="notification-progress" style="background: var(--color);"></div>
        `;

        container.appendChild(notification);

        // Auto dismiss
        const duration = data.duration || template.duration;
        setTimeout(() => {
            if (notification.parentElement) {
                notification.classList.add('exit');
                setTimeout(() => notification.remove(), 400);
            }
        }, duration);
    },

    success(subType, data = {}) {
        this.show('success', subType, data);
    },

    error(subType, data = {}) {
        this.show('error', subType, data);
    },

    warning(subType, data = {}) {
        this.show('warning', subType, data);
    },

    info(subType, data = {}) {
        this.show('info', subType, data);
    },

    // Helper methods untuk kasus khusus
    dataAdded(barangName, barangCode, jumlah, fotoCount = 0, kategori = '') {
        this.success('data-added', {
            message: `Barang "${barangName}" berhasil ditambahkan!`,
            details: [
                { icon: '<i class="fas fa-barcode"></i>', text: `Kode: ${barangCode}` },
                { icon: '<i class="fas fa-cubes"></i>', text: `Jumlah: ${jumlah} unit` },
                kategori ? { icon: '<i class="fas fa-tag"></i>', text: `Kategori: ${kategori}` } : null,
                fotoCount > 0 ? { icon: '<i class="fas fa-images"></i>', text: `Foto: ${fotoCount} gambar` } : null
            ].filter(Boolean)
        });
    },

    dataUpdated(barangName, changes = []) {
        this.success('data-updated', {
            message: `Data barang "${barangName}" berhasil diperbarui!`,
            details: changes.length > 0 ? changes : [
                { icon: '<i class="fas fa-edit"></i>', text: 'Data telah diperbarui' }
            ]
        });
    },

    deleted(barangName, barangCode) {
        this.success('deleted', {
            message: `Barang "${barangName}" telah dihapus dari sistem.`,
            details: [
                { icon: '<i class="fas fa-warning"></i>', text: 'Tindakan tidak dapat dibatalkan' },
                barangCode ? { icon: '<i class="fas fa-barcode"></i>', text: `Kode: ${barangCode}` } : null
            ].filter(Boolean)
        });
    },

    photosUploaded(barangName, uploadedCount, failedCount = 0) {
        if (failedCount > 0) {
            this.warning('partial-upload-fail', {
                message: `${uploadedCount} foto berhasil diupload, ${failedCount} foto gagal.`,
                details: [
                    { icon: '<i class="fas fa-check"></i>', text: `${uploadedCount} foto berhasil` },
                    { icon: '<i class="fas fa-times"></i>', text: `${failedCount} foto gagal` }
                ]
            });
        } else {
            this.success('photos-uploaded', {
                message: `${uploadedCount} foto untuk "${barangName}" berhasil diupload!`,
                details: [
                    { icon: '<i class="fas fa-check"></i>', text: `Total: ${uploadedCount} gambar` }
                ]
            });
        }
    },

    maintenanceScheduled(barangName, jumlah, teknisi = '', tanggal = '') {
        this.success('maintenance-scheduled', {
            message: `Maintenance untuk ${jumlah} unit "${barangName}" berhasil dijadwalkan!`,
            details: [
                { icon: '<i class="fas fa-cubes"></i>', text: `Jumlah: ${jumlah} unit` },
                tanggal ? { icon: '<i class="fas fa-calendar"></i>', text: `Tanggal: ${tanggal}` } : null,
                teknisi ? { icon: '<i class="fas fa-user"></i>', text: `Teknisi: ${teknisi}` } : null
            ].filter(Boolean)
        });
    },

    importCompleted(successCount, failedCount = 0, errorDetails = []) {
        if (failedCount > 0) {
            this.warning('partial-import-fail', {
                message: `${successCount} data berhasil diimport, ${failedCount} gagal.`,
                details: [
                    { icon: '<i class="fas fa-check"></i>', text: `${successCount} berhasil` },
                    { icon: '<i class="fas fa-times"></i>', text: `${failedCount} gagal` },
                    ...errorDetails.slice(0, 3)
                ]
            });
        } else {
            this.success('import-completed', {
                message: `${successCount} data barang berhasil diimport!`,
                details: [
                    { icon: '<i class="fas fa-check"></i>', text: `Total: ${successCount} barang` }
                ]
            });
        }
    },

    validationError(errors = []) {
        this.error('validation', {
            message: 'Terdapat kesalahan pada form:',
            details: errors.map(err => ({
                icon: '<i class="fas fa-times"></i>',
                text: err
            }))
        });
    },

    uploadError(failedFiles = []) {
        this.error('upload', {
            message: `${failedFiles.length} file gagal diupload:`,
            details: failedFiles.map(file => ({
                icon: '<i class="fas fa-times"></i>',
                text: file
            }))
        });
    },

    lowStock(items = []) {
        this.warning('low-stock', {
            message: 'Beberapa barang memiliki stok yang terbatas:',
            details: items.map(item => ({
                icon: '<i class="fas fa-warning"></i>',
                text: item
            }))
        });
    },

    clearAll() {
        const container = document.getElementById('notification-container');
        if (container) {
            document.querySelectorAll('.notification').forEach(n => {
                n.classList.add('exit');
            });
            setTimeout(() => {
                document.querySelectorAll('.notification').forEach(n => n.remove());
            }, 400);
        }
    }
};

// Auto-initialize on DOM ready
document.addEventListener('DOMContentLoaded', () => {
    console.log('✅ Notification System loaded');
});