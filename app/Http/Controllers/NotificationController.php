<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NotificationEmployee;
use App\Models\NotificationEvaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function updateNotification($id)
    {
        // Try to find the notification in both tables
        $evaluationNotification = NotificationEvaluation::find($id);
        $employeeNotification = NotificationEmployee::find($id);

        // Check which type of notification exists and update the read_at value
        if ($evaluationNotification) {
            $this->updateReadAt($evaluationNotification);
        } elseif ($employeeNotification) {
            $this->updateReadAt($employeeNotification);
        } else {
            return response()->json(['error' => 'Notification not found'], 404);
        }

        return response()->json(['message' => 'Notification updated successfully']);
    }

    // Helper method to update the read_at value
    private function updateReadAt($notification)
    {
        if ($notification) {
            $notification->read_at = now();
            $notification->save();
        }
    }

    public function markAllAsRead()
    {
        $user = Auth::user();

        NotificationEvaluation::where('notifiable_id', $user->employee_id)->update(['read_at' => now()]);
        NotificationEmployee::where('notifiable_id', $user->employee_id)->update(['read_at' => now()]);

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }
}
