@extends('admin.layouts.app')

@section('title', 'Contact Submissions - Archtech Admin')

@section('content')
<div class="admin-header">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h1 class="fw-bold mb-2" style="color: var(--archtech-primary);">Contact Submissions</h1>
            <p class="text-muted">Manage and respond to messages from your website contact form</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.contact-submissions.export', request()->query()) }}" class="btn btn-archtech-outline" id="exportBtn">
                <i class="fas fa-download me-2"></i>Export CSV
            </a>
        </div>
    </div>
</div>

<!-- Statistics Cards - Simplified Elegant Design -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-card-inner">
                <div>
                    <div class="stat-label">Total Submissions</div>
                    <div class="stat-value">{{ $totalSubmissions }}</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-card-inner">
                <div>
                    <div class="stat-label">Unread</div>
                    <div class="stat-value">{{ $unreadCount }}</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-card-inner">
                <div>
                    <div class="stat-label">Read</div>
                    <div class="stat-value">{{ $readCount }}</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-card-inner">
                <div>
                    <div class="stat-label">Today</div>
                    <div class="stat-value">{{ $todayCount }}</div>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-calendar-day"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filters Card -->
<div class="filter-card mb-4">
    <div class="filter-card-header">
        <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filter Submissions</h5>
    </div>
    <div class="filter-card-body">
        <form method="GET" action="{{ route('admin.contact-submissions.index') }}" id="filterForm">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="filter" class="form-select">
                        <option value="">All Submissions</option>
                        <option value="unread" {{ request('filter') == 'unread' ? 'selected' : '' }}>Unread Only</option>
                        <option value="read" {{ request('filter') == 'read' ? 'selected' : '' }}>Read Only</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">From Date</label>
                    <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label">To Date</label>
                    <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Search</label>
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                        <button class="btn btn-archtech" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>

            @if(request()->hasAny(['search', 'filter', 'date_from', 'date_to']))
                <div class="mt-3">
                    <a href="{{ route('admin.contact-submissions.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Clear Filters
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>

<!-- Bulk Actions -->
@if($submissions->count() > 0)
    <div class="bulk-actions-bar mb-3">
        <div class="d-flex align-items-center gap-3 flex-wrap">
            <div class="d-flex align-items-center">
                <input type="checkbox" id="masterCheckbox" class="form-check-input me-2">
                <label for="masterCheckbox" class="form-check-label fw-bold">Select All</label>
            </div>

            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-success" id="bulkMarkReadBtn">
                    <i class="fas fa-check-circle me-1"></i>Mark as Read
                </button>
                <button type="button" class="btn btn-sm btn-outline-warning" id="bulkMarkUnreadBtn">
                    <i class="fas fa-clock me-1"></i>Mark as Unread
                </button>
                <button type="button" class="btn btn-sm btn-outline-danger" id="bulkDeleteBtn">
                    <i class="fas fa-trash me-1"></i>Delete
                </button>
            </div>

            <span class="text-muted" id="selectedCount">0 selected</span>
        </div>
    </div>
@endif

<!-- Submissions Table -->
<div class="table-responsive">
    <table class="table table-hover submissions-table">
        <thead>
            <tr>
                <th width="40"></th>
                <th>Status</th>
                <th>Sender</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Date</th>
                <th width="120">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($submissions as $submission)
                <tr class="{{ !$submission->is_read ? 'table-active fw-bold' : '' }}">
                    <td>
                        <input type="checkbox" class="submission-checkbox form-check-input" value="{{ $submission->id }}">
                    </td>
                    <td>
                        @if($submission->is_read)
                            <span class="badge bg-success">
                                <i class="fas fa-check-circle me-1"></i>Read
                            </span>
                        @else
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-clock me-1"></i>Unread
                            </span>
                        @endif
                    </td>
                    <td>
                        <div class="sender-info">
                            <strong>{{ $submission->name }}</strong>
                            <br>
                            <small class="text-muted">{{ $submission->email }}</small>
                        </div>
                    </td>
                    <td>
                        <div class="subject-preview">
                            {{ Str::limit($submission->subject, 30) }}
                        </div>
                    </td>
                    <td>
                        <div class="message-preview text-muted">
                            {{ Str::limit($submission->message, 50) }}
                        </div>
                    </td>
                    <td>
                        <div class="date-info">
                            {{ $submission->created_at->format('M d, Y') }}
                            <br>
                            <small class="text-muted">{{ $submission->created_at->format('h:i A') }}</small>
                        </div>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.contact-submissions.show', $submission) }}"
                               class="btn btn-sm btn-outline-primary" title="View">
                                <i class="fas fa-eye"></i>
                            </a>

                            @if($submission->is_read)
                                <button type="button"
                                        class="btn btn-sm btn-outline-warning mark-unread-btn"
                                        data-id="{{ $submission->id }}"
                                        title="Mark as Unread">
                                    <i class="fas fa-clock"></i>
                                </button>
                            @else
                                <button type="button"
                                        class="btn btn-sm btn-outline-success mark-read-btn"
                                        data-id="{{ $submission->id }}"
                                        title="Mark as Read">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                            @endif

                            <button type="button"
                                    class="btn btn-sm btn-outline-danger delete-btn"
                                    data-id="{{ $submission->id }}"
                                    data-name="{{ $submission->name }}"
                                    title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <div class="empty-state">
                            <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                            <h4 class="fw-bold">No Submissions Found</h4>
                            <p class="text-muted">No contact form submissions match your criteria.</p>
                            @if(request()->hasAny(['search', 'filter', 'date_from', 'date_to']))
                                <a href="{{ route('admin.contact-submissions.index') }}" class="btn btn-archtech mt-3">
                                    <i class="fas fa-times me-2"></i>Clear Filters
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="d-flex justify-content-between align-items-center mt-4">
    <div class="text-muted small">
        Showing {{ $submissions->firstItem() ?? 0 }} to {{ $submissions->lastItem() ?? 0 }} of {{ $submissions->total() }} results
    </div>
    <div>
        {{ $submissions->links() }}
    </div>
</div>

<!-- Delete Form (Hidden) -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<!-- Bulk Form (Hidden) -->
<form id="bulkForm" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="ids" id="bulkIds">
</form>

<style>
/* Simplified Statistics Cards - Clean and Elegant */
.stat-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    border-color: var(--archtech-primary);
}

.stat-card-inner {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.stat-label {
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #6c757d;
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.stat-value {
    font-size: 2rem;
    font-weight: 600;
    color: #2d3748;
    line-height: 1.2;
}

.stat-icon {
    font-size: 2.5rem;
    color: var(--archtech-primary);
    opacity: 0.3;
}

/* Filter Card */
.filter-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    overflow: hidden;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.filter-card-header {
    background: #f8f9fa;
    color: #2d3748;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

.filter-card-body {
    padding: 1.5rem;
}

/* Bulk Actions Bar */
.bulk-actions-bar {
    background: white;
    border-radius: 10px;
    padding: 1rem 1.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

/* Submissions Table */
.submissions-table {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.submissions-table thead th {
    background: #f8f9fa;
    color: #2d3748;
    font-weight: 600;
    border: none;
    padding: 1rem;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.submissions-table tbody tr {
    transition: all 0.2s ease;
}

.submissions-table tbody tr:hover {
    background-color: #f8f9fa;
}

.submissions-table td {
    padding: 1rem;
    vertical-align: middle;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
}

/* Sender Info */
.sender-info {
    line-height: 1.4;
}

.sender-info strong {
    color: #2d3748;
}

/* Subject Preview */
.subject-preview {
    font-weight: 500;
    color: #2d3748;
}

/* Message Preview */
.message-preview {
    font-size: 0.9rem;
    color: #6c757d;
}

/* Date Info */
.date-info {
    font-size: 0.9rem;
    line-height: 1.4;
    color: #2d3748;
}

.date-info small {
    color: #6c757d;
}

/* Empty State */
.empty-state {
    padding: 3rem;
    text-align: center;
}

.empty-state i {
    color: #dee2e6;
}

.empty-state h4 {
    color: #2d3748;
    margin-bottom: 0.5rem;
}

/* Button Group */
.btn-group {
    display: flex;
    gap: 0.3rem;
}

.btn-outline-primary {
    border-color: #dee2e6;
    color: var(--archtech-primary);
}

.btn-outline-primary:hover {
    background: var(--archtech-primary);
    border-color: var(--archtech-primary);
    color: white;
}

.btn-outline-success {
    border-color: #dee2e6;
    color: #198754;
}

.btn-outline-success:hover {
    background: #198754;
    border-color: #198754;
    color: white;
}

.btn-outline-warning {
    border-color: #dee2e6;
    color: #ffc107;
}

.btn-outline-warning:hover {
    background: #ffc107;
    border-color: #ffc107;
    color: #212529;
}

.btn-outline-danger {
    border-color: #dee2e6;
    color: #dc3545;
}

.btn-outline-danger:hover {
    background: #dc3545;
    border-color: #dc3545;
    color: white;
}

/* Badges */
.badge {
    padding: 0.5rem 0.75rem;
    font-weight: 500;
    font-size: 0.75rem;
}

.bg-success {
    background-color: #198754 !important;
}

.bg-warning {
    background-color: #ffc107 !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .stat-card {
        padding: 1rem;
    }

    .stat-value {
        font-size: 1.5rem;
    }

    .stat-icon {
        font-size: 2rem;
    }

    .submissions-table {
        font-size: 0.9rem;
    }

    .btn-group {
        flex-direction: column;
    }

    .bulk-actions-bar .btn-group {
        flex-direction: row;
    }
}

/* Pagination styling */
.pagination {
    display: flex;
    gap: 0.3rem;
    list-style: none;
    padding: 0;
}

.pagination li a,
.pagination li span {
    display: block;
    padding: 0.5rem 1rem;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    color: var(--archtech-primary);
    text-decoration: none;
    transition: all 0.2s ease;
    background: white;
}

.pagination li.active span {
    background: var(--archtech-primary);
    color: white;
    border-color: var(--archtech-primary);
}

.pagination li a:hover {
    background: #f8f9fa;
    border-color: var(--archtech-primary);
    color: var(--archtech-primary);
}

/* Form Controls */
.form-select, .form-control {
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 0.5rem 1rem;
    font-size: 0.95rem;
}

.form-select:focus, .form-control:focus {
    border-color: var(--archtech-primary);
    box-shadow: 0 0 0 3px rgba(8, 68, 51, 0.1);
    outline: none;
}

.btn-archtech {
    background: var(--archtech-primary);
    color: white;
    border: none;
    padding: 0.5rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-archtech:hover {
    background: var(--archtech-dark);
    transform: translateY(-1px);
}

.btn-archtech-outline {
    background: transparent;
    color: var(--archtech-primary);
    border: 2px solid var(--archtech-primary);
    padding: 0.5rem 1.5rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-archtech-outline:hover {
    background: var(--archtech-primary);
    color: white;
    transform: translateY(-1px);
}
</style>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Individual delete
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const deleteForm = document.getElementById('deleteForm');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const submissionId = this.dataset.id;
            const submissionName = this.dataset.name;

            Swal.fire({
                title: 'Delete Submission?',
                html: `Are you sure you want to delete the message from <strong>${submissionName}</strong>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteForm.action = `{{ url('admin/contact-submissions') }}/${submissionId}`;
                    deleteForm.submit();
                }
            });
        });
    });

    // Mark as Read (Individual)
    const markReadButtons = document.querySelectorAll('.mark-read-btn');
    markReadButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const submissionId = this.dataset.id;

            fetch(`/admin/contact-submissions/${submissionId}/mark-as-read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to mark as read.'
                });
            });
        });
    });

    // Mark as Unread (Individual)
    const markUnreadButtons = document.querySelectorAll('.mark-unread-btn');
    markUnreadButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const submissionId = this.dataset.id;

            fetch(`/admin/contact-submissions/${submissionId}/mark-as-unread`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to mark as unread.'
                });
            });
        });
    });

    // Bulk Actions
    const masterCheckbox = document.getElementById('masterCheckbox');
    const submissionCheckboxes = document.querySelectorAll('.submission-checkbox');
    const selectedCount = document.getElementById('selectedCount');
    const bulkMarkReadBtn = document.getElementById('bulkMarkReadBtn');
    const bulkMarkUnreadBtn = document.getElementById('bulkMarkUnreadBtn');
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
    const bulkForm = document.getElementById('bulkForm');
    const bulkIds = document.getElementById('bulkIds');

    function updateSelectedCount() {
        const checked = document.querySelectorAll('.submission-checkbox:checked').length;
        selectedCount.textContent = `${checked} selected`;

        if (submissionCheckboxes.length === checked) {
            masterCheckbox.checked = true;
            masterCheckbox.indeterminate = false;
        } else if (checked === 0) {
            masterCheckbox.checked = false;
            masterCheckbox.indeterminate = false;
        } else {
            masterCheckbox.checked = false;
            masterCheckbox.indeterminate = true;
        }
    }

    if (masterCheckbox) {
        masterCheckbox.addEventListener('change', function() {
            submissionCheckboxes.forEach(cb => {
                cb.checked = this.checked;
            });
            updateSelectedCount();
        });
    }

    submissionCheckboxes.forEach(cb => {
        cb.addEventListener('change', updateSelectedCount);
    });

    // Bulk Mark as Read
    if (bulkMarkReadBtn) {
        bulkMarkReadBtn.addEventListener('click', function() {
            const selectedIds = Array.from(document.querySelectorAll('.submission-checkbox:checked')).map(cb => cb.value);

            if (selectedIds.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Selection',
                    text: 'Please select at least one submission.'
                });
                return;
            }

            Swal.fire({
                title: 'Mark as Read',
                text: `Mark ${selectedIds.length} submission(s) as read?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, mark as read'
            }).then((result) => {
                if (result.isConfirmed) {
                    bulkIds.value = JSON.stringify(selectedIds);
                    bulkForm.action = '{{ route("admin.contact-submissions.bulk-mark-read") }}';
                    bulkForm.submit();
                }
            });
        });
    }

    // Bulk Mark as Unread
    if (bulkMarkUnreadBtn) {
        bulkMarkUnreadBtn.addEventListener('click', function() {
            const selectedIds = Array.from(document.querySelectorAll('.submission-checkbox:checked')).map(cb => cb.value);

            if (selectedIds.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Selection',
                    text: 'Please select at least one submission.'
                });
                return;
            }

            Swal.fire({
                title: 'Mark as Unread',
                text: `Mark ${selectedIds.length} submission(s) as unread?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#ffc107',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, mark as unread'
            }).then((result) => {
                if (result.isConfirmed) {
                    bulkIds.value = JSON.stringify(selectedIds);
                    bulkForm.action = '{{ route("admin.contact-submissions.bulk-mark-unread") }}';
                    bulkForm.submit();
                }
            });
        });
    }

    // Bulk Delete
    if (bulkDeleteBtn) {
        bulkDeleteBtn.addEventListener('click', function() {
            const selectedIds = Array.from(document.querySelectorAll('.submission-checkbox:checked')).map(cb => cb.value);

            if (selectedIds.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'No Selection',
                    text: 'Please select at least one submission.'
                });
                return;
            }

            Swal.fire({
                title: 'Delete Submissions',
                html: `Are you sure you want to delete <strong>${selectedIds.length}</strong> submission(s)?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete them!'
            }).then((result) => {
                if (result.isConfirmed) {
                    bulkIds.value = JSON.stringify(selectedIds);
                    bulkForm.action = '{{ route("admin.contact-submissions.bulk-delete") }}';
                    bulkForm.submit();
                }
            });
        });
    }

    // Export button loading state
    const exportBtn = document.getElementById('exportBtn');
    if (exportBtn) {
        exportBtn.addEventListener('click', function(e) {
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Exporting...';
            // Don't prevent default - let the link work normally
        });
    }
});
</script>
@endpush
