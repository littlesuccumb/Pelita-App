<!-- Notifications -->
<div class="relative" x-data="notificationDropdown()" x-init="init()" x-cloak>
    <button @click="toggleDropdown()" class="nav-button relative bell-button">
        <svg class="w-6 h-6 bell-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
        </svg>
        <span x-show="unreadCount > 0" 
              x-text="unreadCount" 
              class="notification-badge">
        </span>
    </button>

    <!-- Notification Dropdown -->
    <div x-show="open" 
         @click.away="open = false" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="notification-dropdown">
         
        <!-- Header -->
        <div class="notification-header">
            <div class="flex items-center justify-between">
                <h3 class="notification-title">
                    <span class="status-dot"></span>
                    Notifikasi
                </h3>
                <button @click="markAllAsRead()" 
                        x-show="unreadCount > 0"
                        class="mark-read-btn">
                    Tandai Dibaca
                </button>
            </div>
        </div>

        <!-- Notifications List -->
        <div class="notification-list">
            <template x-if="loading">
                <div class="notification-empty">
                    <div class="spinner"></div>
                    <p class="empty-text">Memuat...</p>
                </div>
            </template>

            <template x-if="!loading && notifications.length === 0">
                <div class="notification-empty">
                    <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <p class="empty-text">Tidak ada notifikasi</p>
                </div>
            </template>

            <template x-if="!loading && notifications.length > 0">
                <div>
                    <template x-for="notif in notifications" :key="notif.id">
                        <div @click="markAsRead(notif.id, notif.url)" 
                             class="notification-item"
                             :class="{ 'notification-unread': !notif.is_read }">
                            <div class="notification-content">
                                <!-- Icon -->
                                <div class="notification-icon-wrapper"
                                     :class="{
                                         'bg-green-100 dark:bg-green-900/30': notif.icon === 'success',
                                         'bg-red-100 dark:bg-red-900/30': notif.icon === 'error',
                                         'bg-yellow-100 dark:bg-yellow-900/30': notif.icon === 'warning',
                                         'bg-blue-100 dark:bg-blue-900/30': notif.icon === 'info'
                                     }">
                                    <!-- Success -->
                                    <svg x-show="notif.icon === 'success'" class="notification-icon text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <!-- Error -->
                                    <svg x-show="notif.icon === 'error'" class="notification-icon text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    <!-- Warning -->
                                    <svg x-show="notif.icon === 'warning'" class="notification-icon text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                    <!-- Info -->
                                    <svg x-show="notif.icon === 'info'" class="notification-icon text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>

                                <!-- Text Content -->
                                <div class="notification-text">
                                    <div class="notification-title-row">
                                        <p class="notification-action" x-text="notif.aksi"></p>
                                        <span x-show="!notif.is_read" class="unread-dot"></span>
                                    </div>
                                    <p class="notification-detail" x-text="notif.detail"></p>
                                    <p class="notification-time">
                                        <svg class="time-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span x-text="notif.time_ago"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </template>
        </div>

        <!-- Footer -->
        <div class="notification-footer">
            <a href="{{ route('notifications.index') }}" class="view-all-link">
                Lihat Semua Notifikasi
            </a>
        </div>
    </div>
</div>

<script>
function notificationDropdown() {
    return {
        open: false,
        loading: false,
        notifications: [],
        unreadCount: 0,
        pollInterval: null,

        init() {
            this.fetchNotifications();
            this.pollInterval = setInterval(() => {
                this.fetchNotifications();
            }, 30000);
        },

        toggleDropdown() {
            this.open = !this.open;
            if (this.open) {
                this.fetchNotifications();
            }
        },

        async fetchNotifications() {
            try {
                const response = await fetch('{{ route('notifications.unread') }}', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });
                
                if (!response.ok) throw new Error('Network response was not ok');
                
                const data = await response.json();
                this.notifications = data.notifications || [];
                this.unreadCount = data.unread_count || 0;
            } catch (error) {
                console.error('Error fetching notifications:', error);
            }
        },

        async markAsRead(id, url) {
            try {
                const response = await fetch(`{{ url('notifications') }}/${id}/read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                if (!response.ok) throw new Error('Failed to mark as read');

                if (url) {
                    window.location.href = url;
                } else {
                    await this.fetchNotifications();
                }
            } catch (error) {
                console.error('Error marking notification as read:', error);
            }
        },

        async markAllAsRead() {
            try {
                const response = await fetch('{{ route('notifications.mark-all-read') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) throw new Error('Failed to mark all as read');

                await this.fetchNotifications();
            } catch (error) {
                console.error('Error marking all as read:', error);
            }
        },

        destroy() {
            if (this.pollInterval) {
                clearInterval(this.pollInterval);
            }
        }
    }
}
</script>

<style>
/* ===== BELL SHAKE ANIMATION ===== */
.bell-button {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.bell-icon {
    transition: color 0.3s ease;
    transform-origin: top center;
}

/* Shake animation on hover */
.bell-button:hover .bell-icon {
    animation: bellshake 0.6s cubic-bezier(.36,.07,.19,.97) both;
    color: #3b82f6;
}

.dark .bell-button:hover .bell-icon {
    color: #60a5fa;
}

@keyframes bellshake {
    0%, 100% { 
        transform: rotate(0deg); 
    }
    10%, 30%, 50%, 70%, 90% { 
        transform: rotate(14deg); 
    }
    20%, 40%, 60%, 80% { 
        transform: rotate(-14deg); 
    }
    95% { 
        transform: rotate(7deg); 
    }
    97% { 
        transform: rotate(-7deg); 
    }
}

/* Badge pulse animation when there are unread notifications */
.notification-badge {
    position: absolute;
    top: -4px;
    right: -4px;
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
    font-size: 10px;
    font-weight: 600;
    padding: 2px 6px;
    border-radius: 10px;
    min-width: 18px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3);
    line-height: 1.4;
    animation: badgePulse 2s ease-in-out infinite;
}

@keyframes badgePulse {
    0%, 100% {
        transform: scale(1);
        box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3);
    }
    50% {
        transform: scale(1.05);
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.5);
    }
}

/* Notification Dropdown */
.notification-dropdown {
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1), 0 4px 12px rgba(0, 0, 0, 0.08);
    z-index: 50;
    width: 360px;
    max-width: calc(100vw - 32px);
    overflow: hidden;
}

.dark .notification-dropdown {
    background: rgb(31, 41, 55);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3), 0 4px 12px rgba(0, 0, 0, 0.2);
}

@media (max-width: 640px) {
    .notification-dropdown {
        position: fixed;
        top: 60px;
        right: 16px;
        left: 16px;
        width: auto;
        max-width: none;
    }
}

/* Header */
.notification-header {
    padding: 12px 16px;
    border-bottom: 1px solid #f3f4f6;
    background: #fafafa;
}

.dark .notification-header {
    border-bottom-color: rgb(55, 65, 81);
    background: rgb(31, 41, 55);
}

.notification-title {
    font-size: 13px;
    font-weight: 600;
    color: #111827;
    display: flex;
    align-items: center;
    gap: 8px;
}

.dark .notification-title {
    color: rgb(243, 244, 246);
}

.mark-read-btn {
    font-size: 11px;
    color: #4f46e5;
    font-weight: 500;
    white-space: nowrap;
    padding: 4px 8px;
    border-radius: 6px;
    transition: all 0.2s;
}

.dark .mark-read-btn {
    color: rgb(129, 140, 248);
}

.mark-read-btn:hover {
    background: #eef2ff;
    color: #4338ca;
}

.dark .mark-read-btn:hover {
    background: rgb(67, 56, 202, 0.2);
    color: rgb(165, 180, 252);
}

/* Notifications List */
.notification-list {
    max-height: 65vh;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
}

@media (min-width: 641px) {
    .notification-list {
        max-height: 400px;
    }
}

.notification-list::-webkit-scrollbar {
    width: 5px;
}

.notification-list::-webkit-scrollbar-track {
    background: #f9fafb;
}

.dark .notification-list::-webkit-scrollbar-track {
    background: rgb(31, 41, 55);
}

.notification-list::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 3px;
}

.dark .notification-list::-webkit-scrollbar-thumb {
    background: rgb(75, 85, 99);
}

/* Notification Item */
.notification-item {
    padding: 12px 16px;
    border-bottom: 1px solid #f3f4f6;
    cursor: pointer;
    transition: background 0.15s;
    -webkit-tap-highlight-color: transparent;
}

.dark .notification-item {
    border-bottom-color: rgb(55, 65, 81);
}

.notification-item:hover {
    background: #f9fafb;
}

.dark .notification-item:hover {
    background: rgb(55, 65, 81);
}

.notification-item:active {
    background: #f3f4f6;
}

.dark .notification-item:active {
    background: rgb(75, 85, 99);
}

.notification-item:last-child {
    border-bottom: none;
}

.notification-unread {
    background: #eff6ff;
}

.dark .notification-unread {
    background: rgba(59, 130, 246, 0.1);
}

.notification-content {
    display: flex;
    gap: 12px;
    align-items: start;
}

/* Icon */
.notification-icon-wrapper {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.notification-icon {
    width: 18px;
    height: 18px;
}

/* Text */
.notification-text {
    flex: 1;
    min-width: 0;
}

.notification-title-row {
    display: flex;
    align-items: start;
    justify-content: space-between;
    gap: 8px;
    margin-bottom: 4px;
}

.notification-action {
    font-size: 13px;
    font-weight: 500;
    color: #111827;
    line-height: 1.4;
    flex: 1;
}

.dark .notification-action {
    color: rgb(243, 244, 246);
}

.notification-detail {
    font-size: 12px;
    color: #6b7280;
    line-height: 1.5;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    margin-bottom: 6px;
}

.dark .notification-detail {
    color: rgb(156, 163, 175);
}

.notification-time {
    font-size: 11px;
    color: #9ca3af;
    display: flex;
    align-items: center;
    gap: 4px;
}

.dark .notification-time {
    color: rgb(107, 114, 128);
}

.time-icon {
    width: 12px;
    height: 12px;
}

.unread-dot {
    width: 8px;
    height: 8px;
    background: #3b82f6;
    border-radius: 50%;
    flex-shrink: 0;
    margin-top: 4px;
}

/* Empty State */
.notification-empty {
    padding: 48px 24px;
    text-align: center;
}

.empty-icon {
    width: 56px;
    height: 56px;
    margin: 0 auto 12px;
    color: #d1d5db;
}

.dark .empty-icon {
    color: rgb(75, 85, 99);
}

.empty-text {
    font-size: 13px;
    color: #6b7280;
}

.dark .empty-text {
    color: rgb(156, 163, 175);
}

.spinner {
    display: inline-block;
    width: 32px;
    height: 32px;
    border: 3px solid #e5e7eb;
    border-top-color: #4f46e5;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    margin-bottom: 12px;
}

.dark .spinner {
    border-color: rgb(55, 65, 81);
    border-top-color: rgb(129, 140, 248);
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Footer */
.notification-footer {
    padding: 10px 16px;
    border-top: 1px solid #f3f4f6;
    background: white;
}

.dark .notification-footer {
    border-top-color: rgb(55, 65, 81);
    background: rgb(31, 41, 55);
}

.view-all-link {
    display: block;
    text-align: center;
    font-size: 12px;
    color: #4f46e5;
    font-weight: 500;
    transition: color 0.2s;
}

.dark .view-all-link {
    color: rgb(129, 140, 248);
}

.view-all-link:hover {
    color: #4338ca;
}

.dark .view-all-link:hover {
    color: rgb(165, 180, 252);
}

/* Status Dot */
.status-dot {
    width: 6px;
    height: 6px;
    background: #10b981;
    border-radius: 50%;
    display: inline-block;
    box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2);
}
</style>