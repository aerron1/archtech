<div class="admin-sidebar">
    <div class="admin-logo">
        <a href="{{ route('admin.dashboard') }}" style="text-decoration: none;">
            <img src="{{ asset('homepage/file/assets/img/navbar-logo.png') }}" alt="Archtech Admin">
        </a>
    </div>

    <nav class="sidebar-nav">
        <a class="nav-link-admin {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>

        <a class="nav-link-admin {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}" href="{{ route('admin.posts.index') }}">
            <i class="fas fa-newspaper"></i>
            <span>Blog Posts</span>
        </a>

        <a class="nav-link-admin" href="#">
            <i class="fas fa-cogs"></i>
            <span>Services</span>
        </a>

        <a class="nav-link-admin" href="#">
            <i class="fas fa-boxes"></i>
            <span>Products</span>
        </a>

        <a class="nav-link-admin" href="#">
            <i class="fas fa-users"></i>
            <span>Team Members</span>
        </a>

        <a class="nav-link-admin" href="#">
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
