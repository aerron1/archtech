<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TeamController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.team.index', compact('users'));
    }

    public function create()
    {
        $positions = User::POSITIONS;
        return view('admin.team.create', compact('positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'position' => ['required', 'in:' . implode(',', User::POSITIONS)],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'position' => $request->position,
            'is_active' => true,
            'status_changed_at' => now(), // Track when status was set
        ]);

        // Log the status change
        $this->logStatusChange($user, 'enabled', 'New team member created and enabled');

        // Store success message with type for SweetAlert
        return redirect()->route('admin.team.index')
            ->with([
                'success' => 'Team member created successfully.',
                'alert_type' => 'success',
                'alert_title' => 'Success!',
                'alert_message' => 'Team member has been created successfully.'
            ]);
    }

    public function edit(User $team)
    {
        $positions = User::POSITIONS;
        return view('admin.team.edit', compact('team', 'positions'));
    }

    public function update(Request $request, User $team)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$team->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'position' => ['required', 'in:' . implode(',', User::POSITIONS)],
        ]);

        // Track if this is an update (not creation)
        $isUpdate = $team->exists;

        $team->name = $request->name;
        $team->email = $request->email;
        $team->position = $request->position;

        if ($request->password) {
            $team->password = Hash::make($request->password);
        }

        $team->save();

        if ($isUpdate) {
            // Log the update
            $this->logStatusChange($team, 'updated', 'Team member profile updated');
        }

        return redirect()->route('admin.team.index')
            ->with([
                'success' => 'Team member updated successfully.',
                'alert_type' => 'success',
                'alert_title' => 'Updated!',
                'alert_message' => 'Team member has been updated successfully.'
            ]);
    }

    public function toggleStatus(User $team)
    {
        // Only seeder admin can toggle status
        if (!auth()->user()->isSeederAdmin()) {
            return redirect()->route('admin.team.index')
                ->with([
                    'error' => 'You do not have permission to modify user status.',
                    'alert_type' => 'error',
                    'alert_title' => 'Permission Denied!',
                    'alert_message' => 'You do not have permission to modify user status.'
                ]);
        }

        // Prevent toggling seeder admin account
        if ($team->isSeederAdmin()) {
            return redirect()->route('admin.team.index')
                ->with([
                    'error' => 'Cannot modify the seeder admin account status.',
                    'alert_type' => 'error',
                    'alert_title' => 'Cannot Modify!',
                    'alert_message' => 'Cannot modify the seeder admin account status.'
                ]);
        }

        $oldStatus = $team->is_active;
        $team->is_active = !$team->is_active;
        $team->status_changed_at = now();
        $team->save();

        $status = $team->is_active ? 'enabled' : 'disabled';
        $action = $team->is_active ? 'enabled' : 'disabled';

        // Log the status change
        $this->logStatusChange($team, $action, "Team member {$action}");

        return redirect()->route('admin.team.index')
            ->with([
                'success' => "Team member {$team->name} has been {$status} successfully.",
                'alert_type' => 'success',
                'alert_title' => 'Status Changed!',
                'alert_message' => "Team member {$team->name} has been {$status} successfully."
            ]);
    }

    public function destroy(User $team)
    {
        // Prevent deleting yourself
        if ($team->id === auth()->id()) {
            return redirect()->route('admin.team.index')
                ->with([
                    'error' => 'You cannot delete your own account.',
                    'alert_type' => 'error',
                    'alert_title' => 'Cannot Delete!',
                    'alert_message' => 'You cannot delete your own account.'
                ]);
        }

        // Prevent deleting seeder admin account
        if ($team->isSeederAdmin()) {
            return redirect()->route('admin.team.index')
                ->with([
                    'error' => 'Cannot delete the seeder admin account.',
                    'alert_type' => 'error',
                    'alert_title' => 'Cannot Delete!',
                    'alert_message' => 'Cannot delete the seeder admin account.'
                ]);
        }

        $teamName = $team->name; // Store name before deletion

        // Log before deletion
        $this->logStatusChange($team, 'deleted', 'Team member deleted');

        $team->delete();

        return redirect()->route('admin.team.index')
            ->with([
                'success' => 'Team member deleted successfully.',
                'alert_type' => 'success',
                'alert_title' => 'Deleted!',
                'alert_message' => "Team member {$teamName} has been deleted successfully."
            ]);
    }

    /**
     * Log status changes for team members
     */
    private function logStatusChange(User $user, $action, $description)
    {
        // Your logging logic here
    }
}
