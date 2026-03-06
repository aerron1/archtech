@extends('admin.layouts.app')

@section('title', 'View Submission - Archtech Admin')

@section('content')
<div class="admin-header">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <h1 class="fw-bold mb-2">View Submission</h1>
            <p class="text-muted">Message from {{ $contactSubmission->name }}</p>
        </div>
        <div>
            <a href="{{ route('admin.contact-submissions.index') }}" class="btn btn-archtech-outline me-2">
                <i class="fas fa-arrow-left me-2"></i>Back to List
            </a>
            @if(!$contactSubmission->is_read)
                <button class="btn btn-archtech" id="markReadBtn" data-id="{{ $contactSubmission->id }}">
                    <i class="fas fa-check-circle me-2"></i>Mark as Read
                </button>
            @else
                <button class="btn btn-archtech-outline" id="markUnreadBtn" data-id="{{ $contactSubmission->id }}">
                    <i class="fas fa-clock me-2"></i>Mark as Unread
                </button>
            @endif
            <button class="btn btn-archtech-outline text-danger" id="deleteBtn" data-id="{{ $contactSubmission->id }}" data-name="{{ $contactSubmission->name }}">
                <i class="fas fa-trash me-2"></i>Delete
            </button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header" style="background: linear-gradient(135deg, var(--archtech-primary) 0%, var(--archtech-dark) 100%); color: white;">
                <h5 class="mb-0"><i class="fas fa-envelope me-2"></i>Message Details</h5>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <h6 class="fw-bold" style="color: var(--archtech-primary);">Subject:</h6>
                    <p class="lead">{{ $contactSubmission->subject }}</p>
                </div>

                <div class="mb-4">
                    <h6 class="fw-bold" style="color: var(--archtech-primary);">Message:</h6>
                    <div class="p-3 bg-light rounded" style="white-space: pre-wrap; line-height: 1.8;">
                        {{ $contactSubmission->message }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-header" style="background: linear-gradient(135deg, var(--archtech-primary) 0%, var(--archtech-dark) 100%); color: white;">
                <h5 class="mb-0"><i class="fas fa-user me-2"></i>Sender Information</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="fw-bold" style="color: var(--archtech-primary);">Name:</label>
                    <p class="mb-0">{{ $contactSubmission->name }}</p>
                </div>

                <div class="mb-3">
                    <label class="fw-bold" style="color: var(--archtech-primary);">Email:</label>
                    <p class="mb-0">
                        <a href="mailto:{{ $contactSubmission->email }}" style="color: var(--archtech-primary);">
                            {{ $contactSubmission->email }}
                        </a>
                    </p>
                </div>

                <div class="mb-3">
                    <label class="fw-bold" style="color: var(--archtech-primary);">Status:</label>
                    <p class="mb-0">
                        @if($contactSubmission->is_read)
                            <span class="badge" style="background-color: #198754; color: white; padding: 5px 10px;">
                                <i class="fas fa-check-circle me-1"></i>Read
                            </span>
                        @else
                            <span class="badge" style="background-color: #ffc107; color: #212529; padding: 5px 10px;">
                                <i class="fas fa-clock me-1"></i>Unread
                            </span>
                        @endif
                    </p>
                </div>

                <div class="mb-3">
                    <label class="fw-bold" style="color: var(--archtech-primary);">Date Submitted:</label>
                    <p class="mb-0">
                        {{ $contactSubmission->created_at->format('F d, Y') }}<br>
                        <small class="text-muted">{{ $contactSubmission->created_at->format('h:i A') }}</small>
                    </p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" style="background: linear-gradient(135deg, var(--archtech-primary) 0%, var(--archtech-dark) 100%); color: white;">
                <h5 class="mb-0"><i class="fas fa-network-wired me-2"></i>Technical Details</h5>
            </div>
            <div class="card-body">
                @if($contactSubmission->ip_address)
                    <div class="mb-3">
                        <label class="fw-bold" style="color: var(--archtech-primary);">IP Address:</label>
                        <p class="mb-0"><code>{{ $contactSubmission->ip_address }}</code></p>
                    </div>
                @endif

                @if($contactSubmission->user_agent)
                    <div class="mb-3">
                        <label class="fw-bold" style="color: var(--archtech-primary);">User Agent:</label>
                        <p class="mb-0 small text-muted" style="word-break: break-all;">
                            {{ $contactSubmission->user_agent }}
                        </p>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="fw-bold" style="color: var(--archtech-primary);">Submission ID:</label>
                    <p class="mb-0"><code>#{{ $contactSubmission->id }}</code></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Form (Hidden) -->
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mark as Read
    const markReadBtn = document.getElementById('markReadBtn');
    if (markReadBtn) {
        markReadBtn.addEventListener('click', function() {
            const submissionId = this.dataset.id;

            fetch(`/admin/contact-submissions/${submissionId}/mark-as-read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Marked as Read',
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
    }

    // Mark as Unread
    const markUnreadBtn = document.getElementById('markUnreadBtn');
    if (markUnreadBtn) {
        markUnreadBtn.addEventListener('click', function() {
            const submissionId = this.dataset.id;

            fetch(`/admin/contact-submissions/${submissionId}/mark-as-unread`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Marked as Unread',
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
    }

    // Delete button
    const deleteBtn = document.getElementById('deleteBtn');
    const deleteForm = document.getElementById('deleteForm');

    if (deleteBtn) {
        deleteBtn.addEventListener('click', function() {
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
                    deleteForm.action = `/admin/contact-submissions/${submissionId}`;
                    deleteForm.submit();
                }
            });
        });
    }
});
</script>
@endpush
