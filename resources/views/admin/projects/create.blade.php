@extends('admin.layouts.app')

@section('title', 'Create New Project')

@push('styles')
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<style>
    /* Custom SweetAlert2 Styles */
    .swal2-popup {
        border-radius: 10px !important;
        padding: 20px !important;
    }

    .swal2-title {
        color: #084433 !important;
        font-weight: 600 !important;
    }

    .swal2-confirm {
        background: linear-gradient(135deg, #084433 0%, #063325 100%) !important;
        border: none !important;
        border-radius: 5px !important;
        padding: 10px 20px !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
    }

    .swal2-confirm:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 5px 15px rgba(8, 68, 51, 0.3) !important;
    }

    .swal2-cancel {
        background: linear-gradient(135deg, #dc3545 0%, #a71d2a 100%) !important;
        border: none !important;
        border-radius: 5px !important;
        padding: 10px 20px !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
    }

    .swal2-cancel:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3) !important;
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
</style>
@endpush

@section('content')
<!-- Header -->
<div class="admin-header">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 style="color: #084433; margin: 0 0 5px 0;">Create New Project</h1>
            <p class="text-muted" style="margin: 0;">Add a new project to your portfolio</p>
        </div>
        <div style="text-align: right;">
            <a href="{{ route('admin.projects.index') }}" class="btn-archtech-outline">
                <i class="fas fa-arrow-left me-2"></i>Back to Projects
            </a>
        </div>
    </div>
</div>

<!-- Flash Messages -->
@if($errors->any())
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle me-2"></i>
        <ul style="margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Create Form -->
<div class="admin-card">
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" id="createProjectForm">
        @csrf

        <div class="row">
            <!-- Left Column -->
            <div class="col col-md-6">
                <!-- Title -->
                <div class="form-group mb-4">
                    <label for="title" class="form-label">Project Title *</label>
                    <input type="text"
                           class="form-control @error('title') is-invalid @enderror"
                           id="title"
                           name="title"
                           value="{{ old('title') }}"
                           required>
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Location -->
                <div class="form-group mb-4">
                    <label for="location" class="form-label">Location *</label>
                    <input type="text"
                           class="form-control @error('location') is-invalid @enderror"
                           id="location"
                           name="location"
                           value="{{ old('location') }}"
                           placeholder="e.g., Dubai, UAE"
                           required>
                    @error('location')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Client -->
                <div class="form-group mb-4">
                    <label for="client" class="form-label">Client</label>
                    <input type="text"
                           class="form-control @error('client') is-invalid @enderror"
                           id="client"
                           name="client"
                           value="{{ old('client') }}"
                           placeholder="e.g., Dubai Municipality">
                    @error('client')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Project Date -->
                <div class="form-group mb-4">
                    <label for="project_date" class="form-label">Project Date</label>
                    <input type="date"
                           class="form-control @error('project_date') is-invalid @enderror"
                           id="project_date"
                           name="project_date"
                           value="{{ old('project_date') }}">
                    @error('project_date')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Right Column -->
            <div class="col col-md-6">
                <!-- Status -->
                <div class="form-group mb-4">
                    <label for="status" class="form-label">Status *</label>
                    <select class="form-control @error('status') is-invalid @enderror"
                            id="status"
                            name="status"
                            required>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="planned" {{ old('status') == 'planned' ? 'selected' : '' }}>Planned</option>
                    </select>
                    @error('status')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Featured Image -->
                <div class="form-group mb-4">
                    <label for="featured_image" class="form-label">Featured Image</label>
                    <input type="file"
                           class="form-control @error('featured_image') is-invalid @enderror"
                           id="featured_image"
                           name="featured_image"
                           accept="image/*">
                    <small class="text-muted">Max size: 5MB. Recommended: 1200x800px</small>

                    <div id="imagePreview" class="text-center mt-3" style="display: none;">
                        <img id="previewImage" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                    </div>

                    @error('featured_image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Checkboxes -->
                <div class="form-group mb-4">
                    <div class="checkbox-group" style="display: flex; align-items: center; gap: 10px;">
                        <input type="checkbox"
                               id="is_featured"
                               name="is_featured"
                               value="1"
                               {{ old('is_featured') ? 'checked' : '' }}>
                        <label for="is_featured" style="margin: 0;">Mark as Featured Project</label>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <div class="checkbox-group" style="display: flex; align-items: center; gap: 10px;">
                        <input type="checkbox"
                               id="is_published"
                               name="is_published"
                               value="1"
                               {{ old('is_published', true) ? 'checked' : '' }}>
                        <label for="is_published" style="margin: 0;">Publish immediately</label>
                    </div>
                </div>
            </div>

            <!-- Full Width - Description -->
            <div class="col col-md-12">
                <div class="form-group mb-4">
                    <label for="description" class="form-label">Project Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description"
                              name="description"
                              rows="6">{{ old('description') }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Gallery Images -->
            <div class="col col-md-12">
                <div class="form-group mb-4">
                    <label for="gallery_images" class="form-label">Gallery Images</label>
                    <input type="file"
                           class="form-control @error('gallery_images.*') is-invalid @enderror"
                           id="gallery_images"
                           name="gallery_images[]"
                           accept="image/*"
                           multiple>
                    <small class="text-muted">You can select multiple images. Max size per image: 5MB</small>
                    @error('gallery_images.*')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Gallery Preview Container -->
                <div id="gallery-preview" class="gallery-preview" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 15px; margin-top: 15px;"></div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div style="margin-top: 30px; display: flex; gap: 15px;">
            <button type="submit" class="btn-archtech" id="submitBtn">
                <i class="fas fa-save me-2"></i>Create Project
            </button>
            <a href="{{ route('admin.projects.index') }}" class="btn-archtech-outline">
                Cancel
            </a>
        </div>
    </form>
</div>

@push('scripts')
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // SweetAlert2 notification for success - this runs AFTER redirect back to create page
    @if(session('success'))
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            // After showing success, redirect to index
            window.location.href = '{{ route("admin.projects.index") }}';
        });
    @endif

    // SweetAlert2 notification for error
    @if(session('error'))
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            showConfirmButton: true,
            timer: 3000
        });
    @endif

    // SweetAlert2 notification for validation errors
    @if($errors->any())
        let errorMessage = '<ul style="text-align: left; margin-bottom: 0;">';
        @foreach($errors->all() as $error)
            errorMessage += '<li>{{ $error }}</li>';
        @endforeach
        errorMessage += '</ul>';

        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Validation Error',
            html: errorMessage,
            showConfirmButton: true,
            confirmButtonText: 'OK'
        });
    @endif

    // Auto-dismiss alerts after 5 seconds (fallback)
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);

    // Featured image preview
    const featuredImageInput = document.getElementById('featured_image');
    const imagePreview = document.getElementById('imagePreview');
    const previewImage = document.getElementById('previewImage');

    if (featuredImageInput) {
        featuredImageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                // Check file size
                if (this.files[0].size > 5 * 1024 * 1024) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'File Too Large',
                        text: 'Featured image must be less than 5MB',
                        showConfirmButton: true,
                        timer: 3000
                    });
                    this.value = '';
                    imagePreview.style.display = 'none';
                    return;
                }

                // Check file type
                if (!this.files[0].type.startsWith('image/')) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Invalid File Type',
                        text: 'Please upload an image file',
                        showConfirmButton: true,
                        timer: 3000
                    });
                    this.value = '';
                    imagePreview.style.display = 'none';
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    imagePreview.style.display = 'block';
                }

                reader.readAsDataURL(this.files[0]);
            } else {
                imagePreview.style.display = 'none';
            }
        });
    }

    // Gallery preview
    const galleryInput = document.getElementById('gallery_images');
    const galleryPreview = document.getElementById('gallery-preview');

    if (galleryInput) {
        galleryInput.addEventListener('change', function() {
            galleryPreview.innerHTML = '';

            Array.from(this.files).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    // Check file size
                    if (file.size > 5 * 1024 * 1024) {
                        Swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'File Too Large',
                            text: `Image ${index + 1} exceeds 5MB and will not be previewed`,
                            showConfirmButton: true,
                            timer: 3000
                        });
                        return;
                    }

                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const previewItem = document.createElement('div');
                        previewItem.className = 'gallery-item';
                        previewItem.style.position = 'relative';
                        previewItem.style.border = '1px solid #dee2e6';
                        previewItem.style.borderRadius = '5px';
                        previewItem.style.overflow = 'hidden';
                        previewItem.style.aspectRatio = '1/1';

                        previewItem.innerHTML = `
                            <img src="${e.target.result}" alt="Preview ${index + 1}" style="width: 100%; height: 100%; object-fit: cover;">
                            <button type="button" class="remove-image" style="position: absolute; top: 5px; right: 5px; background: rgba(220, 53, 69, 0.9); color: white; border: none; border-radius: 50%; width: 25px; height: 25px; display: flex; align-items: center; justify-content: center; cursor: pointer;" data-index="${index}">
                                <i class="fas fa-times" style="font-size: 12px;"></i>
                            </button>
                        `;

                        // Add remove functionality (visual only)
                        previewItem.querySelector('.remove-image').addEventListener('click', function() {
                            this.closest('.gallery-item').remove();
                        });

                        galleryPreview.appendChild(previewItem);
                    }

                    reader.readAsDataURL(file);
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Invalid File',
                        text: `File ${index + 1} is not an image and will be skipped`,
                        showConfirmButton: true,
                        timer: 3000
                    });
                }
            });
        });
    }

    // Form submission validation
    const form = document.getElementById('createProjectForm');
    const submitBtn = document.getElementById('submitBtn');

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Basic validation
            const title = document.getElementById('title').value.trim();
            const location = document.getElementById('location').value.trim();

            if (!title) {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Validation Error',
                    text: 'Project title is required',
                    showConfirmButton: true,
                    timer: 3000
                });
                return;
            }

            if (!location) {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Validation Error',
                    text: 'Project location is required',
                    showConfirmButton: true,
                    timer: 3000
                });
                return;
            }

            // Show loading state
            Swal.fire({
                title: 'Creating Project...',
                text: 'Please wait while we save your project.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Disable submit button
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating...';

            // Submit the form
            this.submit();
        });
    }

    // Prevent multiple form submissions
    let submitted = false;
    form.addEventListener('submit', function(e) {
        if (submitted) {
            e.preventDefault();
            return false;
        }
        submitted = true;
    });
});
</script>
@endpush

<style>
/* Additional styles for form */
.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    font-weight: 600;
    color: var(--archtech-primary);
    margin-bottom: 8px;
    display: block;
}

.form-control {
    border: 1px solid #dee2e6;
    border-radius: 5px;
    padding: 10px 15px;
    width: 100%;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: var(--archtech-primary);
    box-shadow: 0 0 0 0.2rem rgba(8, 68, 51, 0.25);
    outline: none;
}

.form-control.is-invalid {
    border-color: #dc3545;
}

.text-danger {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 5px;
    display: block;
}

.text-muted {
    color: #6c757d;
    font-size: 0.875rem;
    margin-top: 5px;
    display: block;
}

.checkbox-group {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 15px;
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 5px;
    transition: all 0.2s ease;
}

.checkbox-group:hover {
    border-color: var(--archtech-primary);
    background: rgba(8, 68, 51, 0.02);
}

.checkbox-group input[type="checkbox"] {
    width: 18px;
    height: 18px;
    margin: 0;
}

.checkbox-group label {
    margin: 0;
    font-weight: 500;
    color: var(--archtech-dark);
    cursor: pointer;
}

.alert {
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
    border-left: 4px solid;
}

.alert-danger {
    background-color: #f8d7da;
    border-color: #dc3545;
    color: #721c24;
}

.btn-archtech {
    background: linear-gradient(135deg, var(--archtech-primary) 0%, var(--archtech-dark) 100%);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
    font-weight: 600;
    transition: all 0.3s ease;
    cursor: pointer;
}

.btn-archtech:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(8, 68, 51, 0.3);
}

.btn-archtech:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.btn-archtech-outline {
    background: transparent;
    color: var(--archtech-primary);
    border: 2px solid var(--archtech-primary);
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-archtech-outline:hover {
    background: var(--archtech-primary);
    color: white;
    transform: translateY(-2px);
}

.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

.col {
    padding-right: 15px;
    padding-left: 15px;
    box-sizing: border-box;
}

.col-md-6 {
    flex: 0 0 50%;
    max-width: 50%;
}

.col-md-12 {
    flex: 0 0 100%;
    max-width: 100%;
}

@media (max-width: 768px) {
    .col-md-6 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
</style>
@endsection
