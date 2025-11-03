<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OfferExportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ViewingController;
use Illuminate\Support\Facades\Route;

// Authenticated routes
Route::middleware(['web', 'auth'])->group(function () {

    // Admin-only routes
    Route::middleware('isAdmin')->group(function () {
        Route::get('audit_logs', [AuditLogController::class, 'index'])->name('audit_logs.index');
        Route::resource('agents', AgentController::class)->only(['index', 'edit', 'update', 'destroy']);
        Route::resource('clients', ClientController::class)->only(['index', 'edit', 'update', 'destroy']);

        // Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/deals-by-region', [ReportController::class, 'dealsByRegion'])->name('reports.deals_by_region');
        Route::get('/reports/deals-by-period', [ReportController::class, 'dealsByPeriod'])->name('reports.deals_by_period');
        Route::get('/reports/avg-deal-time', [ReportController::class, 'avgDealTime'])->name('reports.avg_deal_time');
        Route::get('/reports/top-agents', [ReportController::class, 'topAgents'])->name('reports.top_agents');
        Route::get('/reports/properties-without-viewings', [ReportController::class, 'propertiesWithoutViewings'])->name('reports.properties_without_viewings');
        Route::get('/reports/avg-price', [ReportController::class, 'avgPriceByType'])->name('reports.avg_price_by_type');
        Route::get('/reports/revenue-by-region', [ReportController::class, 'revenueByRegion'])->name('reports.revenue_by_region');
        Route::get('/reports/avg-transaction-by-agent', [ReportController::class, 'avgTransactionByAgent'])->name('reports.avg_transaction_by_agent');
        Route::get('/reports/deal-range-by-property-type', [ReportController::class, 'dealRangeByPropertyType'])->name('reports.deal_range_by_property_type');
        Route::get('/reports/monthly-transaction-summary', [ReportController::class, 'monthlyTransactionSummary'])->name('reports.monthly_transaction_summary');
    });

    Route::middleware(['web', 'auth', 'isAgentOrAdmin'])->group(function () {
        Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
        Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
        Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
        Route::patch('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
        Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');

        // Export CSV
        Route::get('/offers/export/{type}', [OfferExportController::class, 'export'])
            ->name('offers.export')
            ->where('type', 'active|done');
    });

    // Purchase & Profile
    Route::post('/properties/{id}/purchase', [PropertyController::class, 'purchase'])->name('properties.purchase');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Viewings
    Route::get('/viewings', [ViewingController::class, 'index'])->name('viewings.index');
    Route::post('/viewings', [ViewingController::class, 'store'])->name('viewings.store');
    Route::patch('/viewings/{viewing}', [ViewingController::class, 'update'])->name('viewings.update');
    Route::patch('/viewings/{viewing}/cancel', [ViewingController::class, 'cancel'])->name('viewings.cancel');
    Route::get('/viewings/{viewing}/review', [ViewingController::class, 'review'])->name('viewings.review');
    Route::middleware(['auth', 'isAgentOrAdmin'])->group(function () {
        Route::get('/viewings/{viewing}/edit', [ViewingController::class, 'edit'])->name('viewings.edit');
    });
    Route::delete('/viewings/{viewing}', [ViewingController::class, 'destroy'])->name('viewings.destroy')->middleware('isAdmin');

    //Offers & Transactions
    Route::get('/offers', [OfferController::class,'index'])->name('offers.index');
    Route::get('/offers/create', [OfferController::class,'create'])->name('offers.create')->middleware('isAgent');
    Route::post('/offers', [OfferController::class,'store'])->name('offers.store')->middleware('isAgent');
    Route::get('/offers/{offer}', [OfferController::class,'show'])->name('offers.show');
    Route::patch('/offers/{offer}/accept', [OfferController::class,'accept'])->name('offers.accept');
    Route::patch('/offers/{offer}/reject', [OfferController::class,'reject'])->name('offers.reject');
    Route::get('/offers/{offer}/history', [OfferController::class, 'history'])
        ->name('offers.history')->middleware('isAgentOrAdmin');;

    Route::get('/transactions', [TransactionController::class,'index'])->name('transactions.index');
});

// Public routes
Route::middleware('web')->group(function () {
    Route::get('/', [PropertyController::class, 'home'])->name('home');
    Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
    Route::get('/properties/{id}', [PropertyController::class, 'show'])->name('properties.show');
});

require __DIR__ . '/auth.php';
