<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $latestArticles = \App\Models\Article::with('author')->where('status', 'published')->latest('published_at')->take(3)->get();
    $latestEvents = \App\Models\Event::where('status', 'upcoming')->orderBy('event_date', 'asc')->take(3)->get();
    return view('welcome', compact('latestArticles', 'latestEvents'));
})->name('home');

Route::view('/ecosystem', 'pages.ecosystem')->name('ecosystem');
Route::view('/tentang-kami', 'pages.tentang-kami')->name('tentang-kami');
Route::get('/resources', function (\Illuminate\Http\Request $request) {
    $query = \App\Models\LegalResource::query();
    if ($request->filled('search')) {
        $query->search($request->search);
    }
    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }
    if ($request->filled('year')) {
        $query->where('year', $request->year);
    }
    $resources = $query->latest('year')->latest('id')->paginate(9)->withQueryString();
    $categories = \App\Models\LegalResource::select('category')->distinct()->pluck('category');
    $years = \App\Models\LegalResource::select('year')->distinct()->orderByDesc('year')->pluck('year');
    return view('pages.resources-page', compact('resources', 'categories', 'years'));
})->name('resources.page');

Route::get('/event-academy', function () {
    $upcomingEvents = \App\Models\Event::where('status', 'upcoming')->orderBy('event_date', 'asc')->get();
    $completedEvents = \App\Models\Event::where('status', 'completed')->latest('event_date')->get();
    return view('pages.event-academy', compact('upcomingEvents', 'completedEvents'));
})->name('event-academy');

// Opini & Berita (Public CMS Routes)
Route::get('/opini-berita', [\App\Http\Controllers\ClientArticleController::class, 'publicIndex'])->name('opini-berita');
Route::get('/opini-berita/{slug}', [\App\Http\Controllers\ClientArticleController::class, 'publicShow'])->name('opini-berita.show');

Route::view('/kontak', 'pages.kontak')->name('kontak');

Route::get('/dashboard', function () {
    $user = auth()->user();
    $orders = $user->orders()->latest()->take(5)->get();
    
    $activeCount = $user->orders()->whereIn('status', ['draft', 'waiting_approval', 'processing', 'client_review', 'revision'])->count();
    $completedCount = $user->orders()->where('status', 'completed')->count();
    
    $unpaidCount = \App\Models\Invoice::whereHas('order', function ($query) use ($user) {
        $query->where('user_id', $user->id);
    })->where('status', 'unpaid')->count();

    return view('dashboard', compact('orders', 'activeCount', 'completedCount', 'unpaidCount'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');

    Route::get('/orders', [\App\Http\Controllers\AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [\App\Http\Controllers\AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [\App\Http\Controllers\AdminOrderController::class, 'updateStatus'])->name('orders.update_status');
    Route::post('/orders/{order}/document', [\App\Http\Controllers\AdminOrderController::class, 'uploadFinalDocument'])->name('orders.upload_document');

    // Offline Client Data & Mail Tracking & CMS Articles & Events
    Route::resource('client-data', \App\Http\Controllers\Admin\ClientDataController::class);
    Route::resource('incoming-mails', \App\Http\Controllers\Admin\IncomingMailController::class);
    Route::resource('outgoing-mails', \App\Http\Controllers\Admin\OutgoingMailController::class);
    Route::resource('monitoring-jobs', \App\Http\Controllers\Admin\MonitoringJobController::class);
    Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class);
    Route::resource('events', \App\Http\Controllers\Admin\EventController::class);
    Route::resource('legal-resources', \App\Http\Controllers\Admin\LegalResourceController::class);

    // Invoicing & CRM (Superadmin Only)
    Route::middleware(['superadmin'])->group(function () {
        Route::post('/invoices', [\App\Http\Controllers\AdminInvoiceController::class, 'store'])->name('invoices.store');
        Route::patch('/invoices/{invoice}/pay', [\App\Http\Controllers\AdminInvoiceController::class, 'markAsPaid'])->name('invoices.mark_paid');
        
        Route::get('/clients', [\App\Http\Controllers\AdminClientController::class, 'index'])->name('clients.index');
        Route::patch('/clients/{user}/toggle', [\App\Http\Controllers\AdminClientController::class, 'toggleStatus'])->name('clients.toggle');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/research', function () {
        return view('research');
    })->name('research');

    Route::get('/dashboard/opini', [\App\Http\Controllers\ClientArticleController::class, 'dashboardIndex'])->name('client.opini.index');
    
    // GATED Event Module in Client Dashboard
    Route::get('/dashboard/events', [\App\Http\Controllers\ClientEventController::class, 'index'])->name('client.events.index');
    Route::get('/dashboard/events/{slug}', [\App\Http\Controllers\ClientEventController::class, 'show'])->name('client.events.show');
    Route::post('/dashboard/events/{event}/register', [\App\Http\Controllers\ClientEventController::class, 'register'])->name('client.events.register');

    // GATED Legal Research & Regulation Vault in Client Dashboard
    Route::get('/dashboard/resources', [\App\Http\Controllers\ClientResourceController::class, 'index'])->name('client.resources.index');
    Route::get('/dashboard/resources/{slug}/detail', [\App\Http\Controllers\ClientResourceController::class, 'show'])->name('client.resources.show');
    Route::get('/dashboard/resources/{legalResource}/download', [\App\Http\Controllers\ClientResourceController::class, 'download'])->name('client.resources.download');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('orders', \App\Http\Controllers\OrderController::class);
    Route::get('/documents/{document}/download', [\App\Http\Controllers\DocumentController::class, 'download'])->name('documents.download');
});

require __DIR__.'/auth.php';
