<?php
// app/Http/Controllers/Admin/AdminController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Project;
use App\Models\ContactSubmission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Post Statistics
        $totalPosts = Post::count();
        $publishedPosts = Post::published()->count();
        $draftPosts = Post::where('is_published', false)->count();
        $totalUsers = User::count();

        // Project Statistics
        $totalProjects = Project::count();
        $featuredProjects = Project::where('is_featured', true)->count();
        $completedProjects = Project::where('status', 'completed')->count();
        $ongoingProjects = Project::where('status', 'ongoing')->count();

        // Recent Posts (last 5)
        $recentPosts = Post::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Recent Projects (last 5)
        $recentProjects = Project::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Time-based statistics
        $postsThisMonth = Post::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $postsThisWeek = Post::whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->count();

        // Calculate posts per user (average)
        $postsPerUser = $totalUsers > 0 ? round($totalPosts / $totalUsers, 1) : 0;

        // Calculate average posts per month
        $firstPost = Post::orderBy('created_at')->first();
        if ($firstPost) {
            $monthsSinceFirstPost = now()->diffInMonths($firstPost->created_at);
            $avgPostsPerMonth = $monthsSinceFirstPost > 0 ? round($totalPosts / max($monthsSinceFirstPost, 1), 1) : $totalPosts;
        } else {
            $avgPostsPerMonth = 0;
        }

        // Contact Submissions Statistics
        $totalContacts = ContactSubmission::count();
        $unreadContacts = ContactSubmission::where('is_read', false)->count();
        $contactsThisMonth = ContactSubmission::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Get monthly contact data for the last 6 months
        $months = [];
        $contactCounts = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M Y');

            $count = ContactSubmission::whereYear('created_at', $date->year)
                                      ->whereMonth('created_at', $date->month)
                                      ->count();
            $contactCounts[] = $count;
        }

        // Get recent activities from the database
        $recentActivities = $this->getRecentActivities();

        return view('admin.dashboard', compact(
            'totalPosts',
            'publishedPosts',
            'draftPosts',
            'totalUsers',
            'totalProjects',
            'featuredProjects',
            'completedProjects',
            'ongoingProjects',
            'recentPosts',
            'recentProjects',
            'postsThisMonth',
            'postsThisWeek',
            'postsPerUser',
            'avgPostsPerMonth',
            'recentActivities',
            'totalContacts',
            'unreadContacts',
            'contactsThisMonth',
            'months',
            'contactCounts'
        ));
    }

    /**
     * Get recent activities from the system
     */
    private function getRecentActivities()
    {
        $activities = [];

        // Get recent contact submissions
        $recentContacts = ContactSubmission::orderBy('created_at', 'desc')
            ->limit(2)
            ->get();

        foreach ($recentContacts as $contact) {
            $activities[] = [
                'icon' => 'envelope',
                'color' => $contact->is_read ? 'info' : 'warning',
                'time' => $contact->created_at->diffForHumans(),
                'message' => 'Contact form from "' . $contact->name . '": ' . Str::limit($contact->subject, 30),
                'badge' => $contact->is_read ? 'Read' : 'New',
                'badge_type' => $contact->is_read ? 'info' : 'warning'
            ];
        }

        // Get recent posts created (last 7 days)
        $recentPosts = Post::with('user')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(2)
            ->get();

        foreach ($recentPosts as $post) {
            $activities[] = [
                'icon' => 'plus-circle',
                'color' => 'success',
                'time' => $post->created_at->diffForHumans(),
                'message' => 'New post created: "' . Str::limit($post->title, 40) . '"',
                'badge' => 'Post',
                'badge_type' => 'success'
            ];
        }

        // Get recent projects created (last 7 days)
        $recentProjects = Project::with('user')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(2)
            ->get();

        foreach ($recentProjects as $project) {
            $activities[] = [
                'icon' => 'project-diagram',
                'color' => 'project',
                'time' => $project->created_at->diffForHumans(),
                'message' => 'New project added: "' . Str::limit($project->title, 40) . '" in ' . $project->location,
                'badge' => 'Project',
                'badge_type' => 'project'
            ];
        }

        // Get recent user registrations (last 7 days)
        $recentUsers = User::where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(1)
            ->get();

        foreach ($recentUsers as $user) {
            $activities[] = [
                'icon' => 'user-plus',
                'color' => 'info',
                'time' => $user->created_at->diffForHumans(),
                'message' => 'New user registered: ' . $user->name,
                'badge' => 'User',
                'badge_type' => 'info'
            ];
        }

        // Get recently updated posts (last 7 days)
        $updatedPosts = Post::where('updated_at', '>=', Carbon::now()->subDays(7))
            ->whereColumn('updated_at', '>', 'created_at')
            ->orderBy('updated_at', 'desc')
            ->limit(1)
            ->get();

        foreach ($updatedPosts as $post) {
            $activities[] = [
                'icon' => 'edit',
                'color' => 'primary',
                'time' => $post->updated_at->diffForHumans(),
                'message' => 'Post updated: "' . Str::limit($post->title, 40) . '"',
                'badge' => 'Update',
                'badge_type' => 'primary'
            ];
        }

        // Get recently updated projects (last 7 days)
        $updatedProjects = Project::where('updated_at', '>=', Carbon::now()->subDays(7))
            ->whereColumn('updated_at', '>', 'created_at')
            ->orderBy('updated_at', 'desc')
            ->limit(1)
            ->get();

        foreach ($updatedProjects as $project) {
            $activities[] = [
                'icon' => 'edit',
                'color' => 'project',
                'time' => $project->updated_at->diffForHumans(),
                'message' => 'Project updated: "' . Str::limit($project->title, 40) . '"',
                'badge' => 'Update',
                'badge_type' => 'project'
            ];
        }

        // Get recently deleted posts (from trash)
        $deletedPosts = Post::onlyTrashed()
            ->where('deleted_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('deleted_at', 'desc')
            ->limit(1)
            ->get();

        foreach ($deletedPosts as $post) {
            $activities[] = [
                'icon' => 'trash',
                'color' => 'danger',
                'time' => $post->deleted_at->diffForHumans(),
                'message' => 'Post deleted: "' . Str::limit($post->title, 40) . '"',
                'badge' => 'Delete',
                'badge_type' => 'danger'
            ];
        }

        // Get recently deleted projects (from trash)
        $deletedProjects = Project::onlyTrashed()
            ->where('deleted_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('deleted_at', 'desc')
            ->limit(1)
            ->get();

        foreach ($deletedProjects as $project) {
            $activities[] = [
                'icon' => 'trash',
                'color' => 'danger',
                'time' => $project->deleted_at->diffForHumans(),
                'message' => 'Project deleted: "' . Str::limit($project->title, 40) . '"',
                'badge' => 'Delete',
                'badge_type' => 'danger'
            ];
        }

        // Get project status changes (last 7 days)
        $statusChangedProjects = Project::where('updated_at', '>=', Carbon::now()->subDays(7))
            ->whereIn('status', ['completed', 'ongoing', 'planned'])
            ->orderBy('updated_at', 'desc')
            ->limit(1)
            ->get();

        foreach ($statusChangedProjects as $project) {
            $activities[] = [
                'icon' => 'chart-line',
                'color' => 'warning',
                'time' => $project->updated_at->diffForHumans(),
                'message' => 'Project "' . Str::limit($project->title, 30) . '" marked as ' . ucfirst($project->status),
                'badge' => ucfirst($project->status),
                'badge_type' => $project->status == 'completed' ? 'success' : ($project->status == 'ongoing' ? 'warning' : 'secondary')
            ];
        }

        // Get team member status changes
        $recentStatusChanges = User::where('updated_at', '>=', Carbon::now()->subDays(7))
            ->where(function($query) {
                $query->where('is_active', true)
                      ->orWhere('is_active', false);
            })
            ->orderBy('updated_at', 'desc')
            ->limit(1)
            ->get();

        foreach ($recentStatusChanges as $user) {
            $status = $user->is_active ? 'enabled' : 'disabled';
            $activities[] = [
                'icon' => $user->is_active ? 'user-check' : 'user-slash',
                'color' => $user->is_active ? 'success' : 'warning',
                'time' => $user->updated_at->diffForHumans(),
                'message' => 'Team member ' . $status . ': ' . $user->name,
                'badge' => $user->is_active ? 'Enabled' : 'Disabled',
                'badge_type' => $user->is_active ? 'success' : 'warning'
            ];
        }

        // Sort activities by time (most recent first)
        usort($activities, function($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });

        // Return only the 8 most recent activities
        return array_slice($activities, 0, 8);
    }
}
