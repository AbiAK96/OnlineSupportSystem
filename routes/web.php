<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth:sanctum'])->group(function(){

    Route::resource('tickets', TicketController::class); 
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});

Route::group(['prefix' => 'tickets', 'middleware' => ['auth']], function() {
    Route::get('/',[TicketController::class, 'index'])->name('tickets.index');
    Route::get('create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('store', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('edit/{id}', [TicketController::class, 'edit'])->name('tickets.edit');
    Route::patch('update/{id}', [TicketController::class, 'update'])->name('tickets.update');
    Route::get('search-ticket', [TicketController::class, 'search'])->name('tickets.search-ticket');
    Route::get('status/{id}', [TicketController::class, 'getStatus'])->name('tickets.getStatus');
    Route::patch('status/{id}', [TicketController::class, 'updateStatus'])->name('tickets.updateStatus');
    Route::get('message/{id}', [TicketController::class, 'getMessage'])->name('tickets.getMessage');
    Route::post('message', [TicketController::class, 'storeMessage'])->name('tickets.message.store');
});

Route::get('/customer/ticket', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer');
Route::post('/customer/ticket', [App\Http\Controllers\CustomerController::class, 'create'])->name('customer.ticket');
Route::get('/customer/status', [App\Http\Controllers\CustomerController::class, 'status'])->name('ticket');
Route::get('/customer/ticket-status', [App\Http\Controllers\CustomerController::class, 'getStatus'])->name('ticket.status');