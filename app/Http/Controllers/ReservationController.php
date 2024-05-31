<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Room;
use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index($id) {
        return view('reservation', [
            'rooms' => Room::where('id', $id)->first(),
            'payments' => Payment::all() 
        ]);
    }

    public function store(Request $request) {
        DB::beginTransaction();
        try {
            $check_in = new DateTime($request->check_in);
            $check_out = new DateTime($request->check_out);
            $difference = $check_in->diff($check_out)->days;
            
            Reservation::create([
                'invoice' => 'BOOK' . time() . Auth::user()->id,
                'id_user' => auth()->user()->id,
                'id_room' => $request->room_id,
                'check_in_date' => $request->check_in,
                'check_out_date' => $request->check_out,
                'total_price' => $request->total_price * $difference,
                'id_payment' => $request->payment
            ]);
    
            Room::where('id', $request->room_id)->update([
                'avaibility' => 0
            ]);
            DB::commit();
    
            return redirect('my-book');
        } catch (\Throwable $th) {
            // Rollback transaksi jika terjadi error
            DB::rollback();
            return $th->getMessage();
        }
    }
}