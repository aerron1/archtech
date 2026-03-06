<div class="admin-sidebar">
    <div class="admin-logo">
        <a href="{{ route('admin.dashboard') }}" style="text-decoration: none;">
            <img src="{{ asset('homepage/file/assets/img/navbar-logo.png') }}" alt="Archtech Admin">
        </a>
    </div>

    <nav class="sidebar-nav">
        <!-- Dashboard -->
        <a class="nav-link-admin {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>

        <!-- Blog Posts -->
        <a class="nav-link-admin {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">
            <i class="fas fa-newspaper"></i>
            <span>Blog Posts</span>
        </a>

        <!-- Projects -->
        <a class="nav-link-admin {{ request()->routeIs('admin.projects.*') && !request()->routeIs('admin.projects.trash') ? 'active' : '' }}" href="{{ route('admin.projects.index') }}">
            <i class="fas fa-project-diagram"></i>
            <span>Projects</span>
        </a>

        <!-- Services -->
        <a class="nav-link-admin" href="#">
            <i class="fas fa-cogs"></i>
            <span>Services</span>
        </a>

        <!-- Products -->
        <a class="nav-link-admin" href="#">
            <i class="fas fa-boxes"></i>
            <span>Products</span>
        </a>

        <!-- Team Members -->
        <a class="nav-link-admin {{ request()->routeIs('admin.team.*') ? 'active' : '' }}" href="{{ route('admin.team.index') }}">
            <i class="fas fa-users"></i>
            <span>Team Members</span>
        </a>

        <!-- CONTACT SUBMISSIONS - Add this right after Team Members -->
        <a class="nav-link-admin {{ request()->routeIs('admin.contact-submissions.*') ? 'active' : '' }}" href="{{ route('admin.contact-submissions.index') }}">
            <i class="fas fa-envelope"></i>
            <span>Contact Submissions</span>
            @php
                use App\Models\ContactSubmission;
                $unreadCount = ContactSubmission::where('is_read', false)->count();
            @endphp
            @if($unreadCount > 0)
                <span class="badge" style="background-color: #ffc107 !important; color: #212529 !important; margin-left: auto; font-size: 0.75rem; padding: 3px 8px; border-radius: 10px;">
                    {{ $unreadCount }} new
                </span>
            @endif
        </a>

        <!-- Recently Deleted -->
        <a class="nav-link-admin {{ request()->routeIs('admin.posts.trash') ? 'active' : '' }}" href="{{ route('admin.posts.trash') }}">
            <i class="fas fa-trash"></i>
            <span>Recently Deleted</span>
        </a>

        <!-- Settings -->
        <a class="nav-link-admin {{ request()->routeIs('admin.settings') ? 'active' : '' }}" href="{{ route('admin.settings') }}">
            <i class="fas fa-cog"></i>
            <span>Settings</span>
        </a>

        <div class="logout-form">
            <a class="nav-link-admin" href="{{ route('home') }}" target="_blank">
                <i class="fas fa-external-link-alt"></i>
                <span>View Website</span>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </nav>

    <div class="admin-user-info">
        <div class="user-avatar">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
        <div class="user-name">
            {{ Auth::user()->name }}
        </div>
        <small style="color: rgba(255, 255, 255, 0.7);">{{ Auth::user()->email }}</small>
    </div>
</div>
