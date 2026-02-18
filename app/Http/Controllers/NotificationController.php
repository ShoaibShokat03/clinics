<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $query = Notification::where('notification_to', Auth::id());

        // Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Date Filter
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $notifications = $query->orderBy('created_at', 'desc')
            ->paginate(15)
            ->appends($request->all());

        return view('notifications.index', compact('notifications'));
    }

    public function fetch()
    {
        $notifications = Notification::where('notification_to', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();
        return response()->json($notifications);
    }

    public function markAsRead(Request $request)
    {
        $notification = Notification::find($request->id);

        if ($notification) {
            $notification->status = 'read';
            $notification->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
    public function readAll(Request $request)
    {
        $userId = auth()->id();
        Notification::where('notification_to', $userId)
            ->where('status', 'new')
            ->update(['status' => 'read']);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;
        if (is_array($ids) && !empty($ids)) {
            Notification::where('notification_to', Auth::id())
                ->whereIn('id', $ids)
                ->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 400);
    }

    public function bulkMarkAsRead(Request $request)
    {
        $ids = $request->ids;
        if (is_array($ids) && !empty($ids)) {
            Notification::where('notification_to', Auth::id())
                ->whereIn('id', $ids)
                ->update(['status' => 'read']);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 400);
    }
}
