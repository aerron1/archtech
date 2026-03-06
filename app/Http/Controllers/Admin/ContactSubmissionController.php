<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ContactSubmissionController extends Controller
{
    /**
     * Display a listing of contact submissions.
     */
    public function index(Request $request)
    {
        $query = ContactSubmission::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%");
            });
        }

        // Filter by read/unread
        if ($request->filled('filter')) {
            if ($request->filter === 'read') {
                $query->where('is_read', true);
            } elseif ($request->filter === 'unread') {
                $query->where('is_read', false);
            }
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Get submissions with pagination
        $submissions = $query->latest()->paginate(15)->withQueryString();

        // Statistics
        $totalSubmissions = ContactSubmission::count();
        $unreadCount = ContactSubmission::where('is_read', false)->count();
        $readCount = ContactSubmission::where('is_read', true)->count();
        $todayCount = ContactSubmission::whereDate('created_at', today())->count();

        return view('admin.contact-submissions.index', compact(
            'submissions',
            'totalSubmissions',
            'unreadCount',
            'readCount',
            'todayCount'
        ));
    }

    /**
     * Display the specified submission.
     */
    public function show(ContactSubmission $contactSubmission)
    {
        // Mark as read when viewed
        if (!$contactSubmission->is_read) {
            $contactSubmission->update(['is_read' => true]);
        }

        return view('admin.contact-submissions.show', compact('contactSubmission'));
    }

    /**
     * Mark submission as read.
     */
    public function markAsRead(ContactSubmission $contactSubmission)
    {
        $contactSubmission->update(['is_read' => true]);

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Marked as read successfully.'
            ]);
        }

        return redirect()->back()->with('success', 'Marked as read successfully.');
    }

    /**
     * Mark submission as unread.
     */
    public function markAsUnread(ContactSubmission $contactSubmission)
    {
        $contactSubmission->update(['is_read' => false]);

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Marked as unread successfully.'
            ]);
        }

        return redirect()->back()->with('success', 'Marked as unread successfully.');
    }

    /**
     * Bulk mark as read.
     */
    public function bulkMarkAsRead(Request $request)
    {
        $request->validate([
            'ids' => 'required|string'
        ]);

        $ids = json_decode($request->ids, true);

        if (!is_array($ids)) {
            return redirect()->back()->with('error', 'Invalid selection.');
        }

        ContactSubmission::whereIn('id', $ids)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return redirect()->back()->with('success', count($ids) . ' submission(s) marked as read successfully.');
    }

    /**
     * Bulk mark as unread.
     */
    public function bulkMarkAsUnread(Request $request)
    {
        $request->validate([
            'ids' => 'required|string'
        ]);

        $ids = json_decode($request->ids, true);

        if (!is_array($ids)) {
            return redirect()->back()->with('error', 'Invalid selection.');
        }

        ContactSubmission::whereIn('id', $ids)
            ->where('is_read', true)
            ->update(['is_read' => false]);

        return redirect()->back()->with('success', count($ids) . ' submission(s) marked as unread successfully.');
    }

    /**
     * Bulk delete submissions.
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|string'
        ]);

        $ids = json_decode($request->ids, true);

        if (!is_array($ids)) {
            return redirect()->back()->with('error', 'Invalid selection.');
        }

        ContactSubmission::whereIn('id', $ids)->delete();

        return redirect()->back()->with('success', count($ids) . ' submission(s) deleted successfully.');
    }

    /**
     * Remove the specified submission.
     */
    public function destroy(ContactSubmission $contactSubmission)
    {
        try {
            $contactSubmission->delete();

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Submission deleted successfully.'
                ]);
            }

            return redirect()->route('admin.contact-submissions.index')
                ->with('success', 'Submission deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting contact submission: ' . $e->getMessage());

            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete submission.'
                ], 500);
            }

            return redirect()->route('admin.contact-submissions.index')
                ->with('error', 'Failed to delete submission.');
        }
    }

    /**
     * Export submissions to CSV.
     */
    public function export(Request $request)
    {
        $query = ContactSubmission::query();

        // Apply filters same as index
        if ($request->filled('filter')) {
            if ($request->filter === 'read') {
                $query->where('is_read', true);
            } elseif ($request->filter === 'unread') {
                $query->where('is_read', false);
            }
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $submissions = $query->latest()->get();

        $filename = 'contact-submissions-' . now()->format('Y-m-d-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $columns = ['ID', 'Name', 'Email', 'Subject', 'Message', 'IP Address', 'User Agent', 'Status', 'Date Submitted', 'Time Submitted'];

        $callback = function() use ($submissions, $columns) {
            $file = fopen('php://output', 'w');

            // Add UTF-8 BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Add headers
            fputcsv($file, $columns);

            foreach ($submissions as $submission) {
                // Clean message - remove extra spaces and line breaks for CSV
                $message = preg_replace('/\s+/', ' ', trim($submission->message));
                $message = str_replace(["\r", "\n"], ' ', $message);

                fputcsv($file, [
                    $submission->id,
                    $submission->name,
                    $submission->email,
                    $submission->subject,
                    $message,
                    $submission->ip_address ?? 'N/A',
                    $submission->user_agent ? substr($submission->user_agent, 0, 100) . '...' : 'N/A',
                    $submission->is_read ? 'Read' : 'Unread',
                    $submission->created_at->format('Y-m-d'),
                    $submission->created_at->format('h:i A')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
