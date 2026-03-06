<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SinglePostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FireProtectionController;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ElectricalController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\MechanicalController;
use App\Http\Controllers\AuxiliaryController;
use App\Http\Controllers\MaterialHandlingController;
use App\Http\Controllers\ToolsLiftingController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('posts.index');
})->name('home');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/blog', [PostController::class, 'index'])->name('posts.index');
Route::get('/blog/{post:slug}', SinglePostController::class)->name('posts.show');

Route::view('/about', 'about')->name('about');

/*
|--------------------------------------------------------------------------
| Dashboard (optional)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Protected + Active Users Only)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'active'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Posts Management
        Route::resource('posts', AdminPostController::class)->except(['show']);

        // Trash Routes
        Route::get('posts/trash', [AdminPostController::class, 'trash'])->name('posts.trash');
        Route::post('posts/{id}/restore', [AdminPostController::class, 'restore'])->name('posts.restore');
        Route::delete('posts/{id}/force-delete', [AdminPostController::class, 'forceDelete'])->name('posts.force-delete');
        Route::post('posts/empty-trash', [AdminPostController::class, 'emptyTrash'])->name('posts.empty-trash');
        Route::post('posts/bulk-action', [AdminPostController::class, 'bulkAction'])->name('posts.bulk-action');

        // Projects Management
        Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class)->except(['show']);

        // Projects Trash Routes
        Route::get('projects/trash', [\App\Http\Controllers\Admin\ProjectController::class, 'trash'])->name('projects.trash');
        Route::post('projects/{id}/restore', [\App\Http\Controllers\Admin\ProjectController::class, 'restore'])->name('projects.restore');
        Route::delete('projects/{id}/force-delete', [\App\Http\Controllers\Admin\ProjectController::class, 'forceDelete'])->name('projects.force-delete');
        Route::post('projects/bulk-action', [\App\Http\Controllers\Admin\ProjectController::class, 'bulkAction'])->name('projects.bulk-action');
        Route::post('projects/{project}/remove-gallery-image', [\App\Http\Controllers\Admin\ProjectController::class, 'removeGalleryImage'])->name('projects.remove-gallery-image');

        // Services
        Route::get('/services', function () {
            return view('admin.services.index');
        })->name('services.index');

        // Products
        Route::get('/products', function () {
            return view('admin.products.index');
        })->name('products.index');

        // Team Management
        Route::resource('team', \App\Http\Controllers\Admin\TeamController::class)->except(['show']);
        Route::post('team/{team}/toggle-status', [\App\Http\Controllers\Admin\TeamController::class, 'toggleStatus'])
            ->name('team.toggle-status');

        // ========== CONTACT SUBMISSIONS MANAGEMENT ==========
        Route::resource('contact-submissions', \App\Http\Controllers\Admin\ContactSubmissionController::class)
            ->except(['create', 'edit', 'update']);

        // Mark as Read/Unread (Individual)
        Route::post('contact-submissions/{contactSubmission}/mark-as-read',
            [\App\Http\Controllers\Admin\ContactSubmissionController::class, 'markAsRead'])
            ->name('contact-submissions.mark-as-read');

        Route::post('contact-submissions/{contactSubmission}/mark-as-unread',
            [\App\Http\Controllers\Admin\ContactSubmissionController::class, 'markAsUnread'])
            ->name('contact-submissions.mark-as-unread');

        // Bulk Actions
        Route::post('contact-submissions/bulk-mark-read',
            [\App\Http\Controllers\Admin\ContactSubmissionController::class, 'bulkMarkAsRead'])
            ->name('contact-submissions.bulk-mark-read');

        Route::post('contact-submissions/bulk-mark-unread',
            [\App\Http\Controllers\Admin\ContactSubmissionController::class, 'bulkMarkAsUnread'])
            ->name('contact-submissions.bulk-mark-unread');

        Route::post('contact-submissions/bulk-delete',
            [\App\Http\Controllers\Admin\ContactSubmissionController::class, 'bulkDelete'])
            ->name('contact-submissions.bulk-delete');

        // Export to CSV
        Route::get('contact-submissions/export/csv',
            [\App\Http\Controllers\Admin\ContactSubmissionController::class, 'export'])
            ->name('contact-submissions.export');
        // ========== END CONTACT SUBMISSIONS ==========

        // Settings Routes
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
        Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.update-profile');
        Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.update-password');
        Route::put('/settings/profile-picture', [SettingsController::class, 'updateProfilePicture'])->name('settings.update-profile-picture');
        Route::delete('/settings/profile-picture', [SettingsController::class, 'removeProfilePicture'])->name('settings.remove-profile-picture');
    });

/*
|--------------------------------------------------------------------------
| Public Product Pages
|--------------------------------------------------------------------------
*/
Route::get('product/index', [ProductController::class, 'index'])->name('product.index');
Route::get('fire-pro/index', [FireProtectionController::class, 'index'])->name('fire-pro.index');

Route::get('/electrical/index', [ElectricalController::class, 'index' ])->name('electrical.index');
Route::get('/electrical/product', [ElectricalController::class, 'product' ])->name('electrical.product');

// Mechanical Routes
Route::get('/mechanical', [MechanicalController::class, 'index'])->name('mechanical.index');
Route::get('/mechanical/product', [MechanicalController::class, 'index'])->name('mechanical.product');

// Auxiliary Routes
Route::get('/auxiliary', [AuxiliaryController::class, 'index'])->name('auxiliary.index');
Route::get('/auxiliary/product', [AuxiliaryController::class, 'product'])->name('auxiliary.product');

// Material Handling Routes
Route::get('/material-handling', [MaterialHandlingController::class, 'index'])->name('material-handling.index');
Route::get('/material-handling/product', [MaterialHandlingController::class, 'product'])->name('material-handling.product');

// Tools & Lifting Equipment Routes
Route::get('/tools-lifting', [ToolsLiftingController::class, 'index'])->name('tools-lifting.index');
Route::get('/tools-lifting/product', [ToolsLiftingController::class, 'product'])->name('tools-lifting.product');

/*
|--------------------------------------------------------------------------
| Quote
|--------------------------------------------------------------------------
*/

/*  EMAIL  */
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');

Route::post('/add-to-quote', function (Request $request) {
    session()->push('quote.items', $request->product_id);
    return response()->json(['success' => true]);
})->middleware('web');

require __DIR__.'/auth.php';
