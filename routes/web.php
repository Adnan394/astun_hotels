<?php

use App\Models\Room;
use App\Models\Review;
use App\Models\Room_type;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SearchSortController;

Route::get('/', function () {
    return view('welcome', [
        'room_types' => Room_type::all(),
        'reviews' => Review::all()
    ]);
});

Route::get('room-lists/{id}', function($id) {
    return view('room_lists', [
        'rooms' => Room::where('room_type_id', $id)->get()
    ]);
})->name('room-lists');

Route::get('my-book', function() {
    return view('my-book', [
        'reservations' => Reservation::where('id_user', Auth::user()->id)->get()
    ]);
})->name('my-book');

Route::get('reservation/{id}', [ReservationController::class, 'index'])->middleware('auth')->name('reservation');
Route::post('reservation', [ReservationController::class, 'store'])->middleware('auth')->name('reservation_store');
Route::prefix('admin')->middleware('auth_admin')->group(function () {
    Route::get('/', function () {
        $income = DB::select('CALL myincome()');
        $available =DB::select('SELECT availableroom() AS total');
        return view('admin.welcome', [
            'income' => $income[0]->total,
            'available_room' => $available[0]->total
        ]);
    });

    Route::get('payment', [AdminController::class, 'payment'])->name('payment');
    Route::post('payment', [AdminController::class, 'payment_store'])->name('payment_store');
    Route::get('guest', [AdminController::class, 'guest'])->name('guest');
    Route::get('rooms', [AdminController::class, 'rooms'])->name('rooms');
    Route::get('room_create', [AdminController::class, 'room_create'])->name('room_create');
    Route::post('room_store', [AdminController::class, 'room_store'])->name('room_store');
    Route::get('room_type', [AdminController::class, 'room_type'])->name('room_type');
    Route::post('room_type_store', [AdminController::class, 'room_type_store'])->name('room_type_store');

    Route::get('reservation_list', function() {
        return view('admin.reservation_list', [
            'reservations' => Reservation::paginate(10)
        ]);
    })->name('reservation_list');


    //search & sorting
    Route::get('search_guest', [SearchSortController::class, 'search_guest'])->name('search_guest');
    Route::get('search_reservation', [SearchSortController::class, 'search_reservation'])->name('search_reservation');

    Route::put('room_avaibility/{id}', function($id) {
        Room::where('id', $id)->update([
            'avaibility' => Room::where('id', $id)->first()->avaibility == 0 ? 1 : 0
        ]);

        return redirect()->back();
    })->name('room_avaibility');
});

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register_store', [AuthController::class, 'register_store'])->name('register_store');
Route::post('login', [AuthController::class, 'login_store'])->name('login_store');
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('403', function() {
    return view('errors.403');
});

Route::post('review', function(Request $request) {
    Review::create([
        'user_id' => Auth::user()->id,
        'review' => $request->review
    ]);

    return redirect()->back();
})->name('review');