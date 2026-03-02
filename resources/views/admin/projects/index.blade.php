@extends('admin.layouts.app')

@section('title', 'Projects Management')

@push('styles')
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<style>
    /* Custom SweetAlert2 Styles - Copied from team edit page */
    .swal-title {
        color: #084433 !important;
        font-weight: 600 !important;
    }

    .swal-popup {
        border-radius: 10px !important;
        padding: 20px !important;
    }

    .swal-confirm-btn {
        background: linear-gradient(135deg, #dc3545 0%, #a71d2a 100%) !important;
        border: none !important;
        border-radius: 5px !important;
        padding: 10px 20px !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
    }

    .swal-confirm-btn:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3) !important;
    }

    .swal-cancel-btn {
        background: linear-gradient(135deg, var(--archtech-primary) 0%, var(--archtech-dark) 100%) !important;
        border: none !important;
        border-radius: 5px !important;
        padding: 10px 20px !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
    }

    .swal-cancel-btn:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 5px 15px rgba(8, 68, 51, 0.3) !important;
    }

    .swal-restore-btn {
        background: linear-gradient(135deg, #198754 0%, #136a43 100%) !important;
        border: none !important;
        border-radius: 5px !important;
        padding: 10px 20px !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
    }

    .swal-restore-btn:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 5px 15px rgba(25, 135, 84, 0.3) !important;
    }

    /* SweetAlert2 Mobile Styles */
    @media (max-width: 480px) {
        .swal2-popup {
            font-size: 0.9rem !important;
            padding: 15px !important;
            width: 90% !important;
        }

        .swal2-title {
            font-size: 1.3rem !important;
        }

        .swal2-actions {
            flex-direction: column !important;
            gap: 10px !important;
        }

        .swal2-actions button {
            width: 100% !important;
            margin: 0 !important;
        }
    }

    /* Pagination Styles - Smaller */
    .pagination {
        display: inline-flex;
        list-style: none;
        padding: 0;
        margin: 0;
        gap: 5px;
    }

    .pagination li {
        display: inline-block;
    }

    .pagination li a,
    .pagination li span {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 32px;
        height: 32px;
        padding: 0 6px;
        font-size: 0.85rem;
        border-radius: 4px;
        background: white;
        color: #084433;
        text-decoration: none;
        border: 1px solid #dee2e6;
        transition: all 0.2s ease;
    }

    .pagination li a:hover {
        background: #f8f9fa;
        border-color: #084433;
        transform: translateY(-1px);
    }

    .pagination li.active span {
        background: #084433;
        color: white;
        border-color: #084433;
    }

    .pagination li.disabled span {
        background: #f8f9fa;
        color: #6c757d;
        border-color: #dee2e6;
        cursor: not-allowed;
    }

    /* Filter styles */
    .filters {
        background: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        border-left: 4px solid var(--archtech-primary);
    }

    .filter-group {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
    }

    .filter-select {
        padding: 8px 12px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        min-width: 150px;
        font-size: 0.95rem;
        background: white;
    }

    .search-input {
        flex: 1;
        min-width: 200px;
        padding: 8px 12px;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        font-size: 0.95rem;
    }

    .search-btn {
        background: #084433;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .search-btn:hover {
        background: #063325;
        transform: translateY(-1px);
    }

    /* Table styles */
    .items-table {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .items-table table {
        width: 100%;
        border-collapse: collapse;
    }

    .items-table th {
        background: #f8f9fa;
        padding: 15px;
        text-align: left;
        font-weight: 600;
        color: #084433;
        border-bottom: 2px solid #dee2e6;
    }

    .items-table td {
        padding: 15px;
        border-bottom: 1px solid #dee2e6;
        vertical-align: middle;
    }

    .items-table tr:hover {
        background: #f8f9fa;
    }

    .badge {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .badge-completed {
        background: #d4edda;
        color: #155724;
    }

    .badge-ongoing {
        background: #cce5ff;
        color: #004085;
    }

    .badge-planned {
        background: #fff3cd;
        color: #856404;
    }

    .badge-featured {
        background: #ffd700;
        color: #084433;
    }

    .btn-group {
        display: flex;
        gap: 5px;
    }

    .btn-outline-success {
        padding: 6px 10px;
        border: 1px solid #28a745;
        border-radius: 4px;
        color: #28a745;
        background: transparent;
        transition: all 0.3s ease;
    }

    .btn-outline-success:hover {
        background: #28a745;
        color: white;
    }

    .btn-outline-danger {
        padding: 6px 10px;
        border: 1px solid #dc3545;
        border-radius: 4px;
        color: #dc3545;
        background: transparent;
        transition: all 0.3s ease;
    }

    .btn-outline-danger:hover {
        background: #dc3545;
        color: white;
    }

    .btn-archtech {
        background: linear-gradient(135deg, var(--archtech-primary) 0%, var(--archtech-dark) 100%);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .btn-archtech:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(8, 68, 51, 0.3);
    }

    .btn-archtech-outline {
        background: transparent;
        color: #084433;
        border: 2px solid #084433;
        padding: 6px 12px;
        border-radius: 5px;
        text-decoration: none;
        display: inline-block;
        font-weight: 500;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .btn-archtech-outline:hover {
        background: #084433;
        color: white;
    }

    @media (max-width: 768px) {
        .filter-group {
            flex-direction: column;
        }

        .filter-select,
        .search-input,
        .search-btn,
        .btn-archtech-outline {
            width: 100%;
        }

        .items-table {
            overflow-x: auto;
        }

        .items-table table {
            min-width: 800px;
        }
    }
</style>
@endpush

@section('content')
<!-- Header -->
<div class="admin-header">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 style="color: #084433; margin: 0 0 5px 0;">Projects</h1>
            <p class="text-muted" style="margin: 0;">Manage your portfolio projects</p>
        </div>
        <div style="text-align: right;">
            <a href="{{ route('admin.projects.create') }}" class="btn-archtech">
                <i class="fas fa-plus-circle me-2"></i>Add New Project
            </a>
        </div>
    </div>
</div>

<!-- Flash Messages (Hidden - we'll use SweetAlert instead) -->
@if(session('success'))
    <div class="alert alert-success" style="display: none;">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger" style="display: none;">{{ session('error') }}</div>
@endif

<!-- Filters -->
<div class="filters">
    <form method="GET" action="{{ route('admin.projects.index') }}" id="filterForm">
        <div class="filter-group">
            <select name="status" class="filter-select" onchange="this.form.submit()">
                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Status</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                <option value="planned" {{ request('status') == 'planned' ? 'selected' : '' }}>Planned</option>
            </select>

            <select name="featured" class="filter-select" onchange="this.form.submit()">
                <option value="">All Projects</option>
                <option value="yes" {{ request('featured') == 'yes' ? 'selected' : '' }}>Featured Only</option>
            </select>

            <input type="text"
                   name="search"
                   class="search-input"
                   placeholder="Search by title, location, client..."
                   value="{{ request('search') }}">

            <button type="submit" class="search-btn">
                <i class="fas fa-search me-2"></i>Search
            </button>

            @if(request()->has('search') || request()->has('status') || request()->has('featured'))
                <a href="{{ route('admin.projects.index') }}" class="btn-archtech-outline">
                    <i class="fas fa-times me-2"></i>Clear Filters
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Projects Table -->
<div class="items-table">
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Location</th>
                <th>Client</th>
                <th>Status</th>
                <th>Featured</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
            <tr>
                <td>
                    @if($project->featured_image)
                        <img src="{{ asset('storage/' . $project->featured_image) }}"
                             alt="{{ $project->title }}"
                             style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                    @else
                        <div style="width: 50px; height: 50px; background: #f0f0f0; border-radius: 5px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-image text-muted"></i>
                        </div>
                    @endif
                </td>
                <td>
                    <strong>{{ Str::limit($project->title, 40) }}</strong>
                    <br>
                    <small class="text-muted">By {{ $project->user->name ?? 'Unknown' }}</small>
                </td>
                <td>
                    <i class="fas fa-map-marker-alt text-muted me-1"></i>
                    {{ Str::limit($project->location, 30) }}
                </td>
                <td>{{ $project->client ?: '-' }}</td>
                <td>
                    @if($project->status == 'completed')
                        <span class="badge badge-completed">Completed</span>
                    @elseif($project->status == 'ongoing')
                        <span class="badge badge-ongoing">Ongoing</span>
                    @else
                        <span class="badge badge-planned">Planned</span>
                    @endif
                </td>
                <td>
                    @if($project->is_featured)
                        <span class="badge badge-featured">
                            <i class="fas fa-star me-1"></i>Featured
                        </span>
                    @else
                        <span class="text-muted">—</span>
                    @endif
                </td>
                <td>
                    @if($project->project_date)
                        {{ $project->project_date->format('M Y') }}
                    @else
                        <span class="text-muted">No date</span>
                    @endif
                </td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin.projects.edit', $project) }}"
                           class="btn-outline-success"
                           title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button"
                                class="btn-outline-danger delete-project"
                                title="Delete"
                                data-project-id="{{ $project->id }}"
                                data-project-title="{{ $project->title }}">
                            <i class="fas fa-trash"></i>
                        </button>
                        <form id="delete-form-{{ $project->id }}"
                              action="{{ route('admin.projects.destroy', $project) }}"
                              method="POST"
                              style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center py-5">
                    <i class="fas fa-project-diagram fa-3x text-muted mb-3"></i>
                    <p class="text-muted mb-3">No projects found.</p>
                    <a href="{{ route('admin.projects.create') }}" class="btn-archtech">
                        <i class="fas fa-plus me-2"></i>Add Your First Project
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Bulk Actions & Pagination -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; flex-wrap: wrap; gap: 15px;">
    <div>
        @if($projects->count() > 0)
            <button type="button" class="btn-archtech-outline" id="bulkDeleteBtn" style="display: none;">
                <i class="fas fa-trash me-2"></i>Move to Trash
            </button>
        @endif
    </div>
    <div>
        <!-- Smaller Pagination -->
        @if(method_exists($projects, 'links'))
            {{ $projects->appends(request()->query())->links('pagination::bootstrap-4') }}
        @endif
    </div>
</div>

<!-- Trash Link -->
<div style="margin-top: 20px; text-align: right;">
    <a href="{{ route('admin.projects.trash') }}" class="text-muted" style="text-decoration: none;">
        <i class="fas fa-trash me-1"></i>
        View Trash ({{ $trashedCount }})
    </a>
</div>

<!-- Bulk Action Form -->
<form id="bulkActionForm" action="{{ route('admin.projects.bulk-action') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="action" id="bulkAction" value="delete">
    <input type="hidden" name="selected_projects[]" id="selectedProjects">
</form>
@endsection

@push('scripts')
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // SweetAlert2 notification for success - Like team edit page
    @if(session('success'))
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            showConfirmButton: true,
            confirmButtonColor: '#084433',
            timer: 3000,
            timerProgressBar: true,
            customClass: {
                title: 'swal-title',
                confirmButton: 'swal-cancel-btn'
            }
        });
    @endif

    // SweetAlert2 notification for error - Like team edit page
    @if(session('error'))
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            showConfirmButton: true,
            confirmButtonColor: '#084433',
            timer: 3000,
            timerProgressBar: true,
            customClass: {
                title: 'swal-title',
                confirmButton: 'swal-cancel-btn'
            }
        });
    @endif

    // Select All functionality
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.select-item');
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');

    function updateBulkDeleteButton() {
        const checked = document.querySelectorAll('.select-item:checked');
        if (checked.length > 0) {
            bulkDeleteBtn.style.display = 'inline-block';
        } else {
            bulkDeleteBtn.style.display = 'none';
        }
    }

    if (selectAll) {
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateBulkDeleteButton();
        });
    }

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkDeleteButton);
    });

    // Bulk Delete
    if (bulkDeleteBtn) {
        bulkDeleteBtn.addEventListener('click', function() {
            const checked = document.querySelectorAll('.select-item:checked');
            const ids = Array.from(checked).map(cb => cb.value);

            if (ids.length === 0) return;

            Swal.fire({
                title: 'Move to Trash?',
                text: `Are you sure you want to move ${ids.length} project(s) to trash?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#084433',
                confirmButtonText: 'Yes, move to trash!',
                cancelButtonText: 'Cancel',
                background: '#fff',
                customClass: {
                    title: 'swal-title',
                    confirmButton: 'swal-confirm-btn',
                    cancelButton: 'swal-cancel-btn'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state
                    Swal.fire({
                        title: 'Processing...',
                        text: 'Please wait while we move the projects to trash.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                        customClass: {
                            title: 'swal-title'
                        }
                    });

                    document.getElementById('selectedProjects').value = JSON.stringify(ids);
                    document.getElementById('bulkAction').value = 'delete';
                    document.getElementById('bulkActionForm').submit();
                }
            });
        });
    }

    // Single Delete - Updated with team edit page styling
    const deleteButtons = document.querySelectorAll('.delete-project');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const projectId = this.dataset.projectId;
            const projectTitle = this.dataset.projectTitle;

            Swal.fire({
                title: 'Move to Trash?',
                text: `Are you sure you want to move "${projectTitle}" to trash?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#084433',
                confirmButtonText: 'Yes, move to trash!',
                cancelButtonText: 'Cancel',
                background: '#fff',
                customClass: {
                    title: 'swal-title',
                    confirmButton: 'swal-confirm-btn',
                    cancelButton: 'swal-cancel-btn'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state
                    Swal.fire({
                        title: 'Moving to Trash...',
                        text: 'Please wait...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                        customClass: {
                            title: 'swal-title'
                        }
                    });

                    document.getElementById(`delete-form-${projectId}`).submit();
                }
            });
        });
    });

    // Auto-dismiss alerts after 5 seconds (fallback)
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
});
</script>
@endpush
