<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use Illuminate\Http\Request;
use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the notifications.
     */
    public function index()
    {
        $notifications = LogAktivitas::notifikasi()
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(20);
            
        return view('notifications.index', compact('notifications'));
    }

    /**
     * Get unread notifications (for AJAX/API).
     */
    public function getUnread()
    {
        $notifications = LogAktivitas::notifikasi()
            ->where('user_id', Auth::id())
            ->latest()
            ->limit(5)
            ->get()
            ->map(function($notif) {
                return [
                    'id' => $notif->id,
                    'aksi' => $notif->aksi,
                    'detail' => $notif->detail,
                    'url' => $notif->url,
                    'is_read' => $notif->is_read,
                    'icon' => $notif->icon,
                    'time_ago' => $notif->created_at->diffForHumans(), // ✅ Tambahkan ini
                    'created_at' => $notif->created_at->toISOString()
                ];
            });
        
        $unreadCount = LogAktivitas::notifikasi()
            ->where('user_id', Auth::id())
            ->unread()
            ->count();
        
        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount
        ]);
    }

    /**
     * Mark notification as read.
     */
    public function markAsRead($id)
    {
        $notification = LogAktivitas::notifikasi()
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        $notification->markAsRead();
        
        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }
        
        return redirect($notification->url ?? route('dashboard'));
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        NotificationService::markAllAsRead(Auth::id());
        
        return response()->json(['success' => true]);
    }

    /**
     * Delete a notification.
     */
    public function destroy($id)
    {
        $notification = LogAktivitas::notifikasi()
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        $notification->delete();
        
        return response()->json(['success' => true]);
    }
}