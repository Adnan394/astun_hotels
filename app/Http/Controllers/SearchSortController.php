<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchSortController extends Controller
{
    public function search_guest(Request $request) {
        $data = User::where('name', 'like', '%'.$request->search.'%')->paginate($request->sort);
        echo json_encode([
            'data' => $data->items(),
            'links' => $data->links()->render()
        ]);
    }
    public function search_reservation(Request $request) {
        $data = Reservation::join('users', 'reservations.id_user', '=', 'users.id')
        ->where('users.name', 'like', '%'.$request->search.'%')
        ->join('rooms', 'reservations.id_room', '=', 'rooms.id')
        ->join('payments', 'reservations.id_payment', '=', 'payments.id')
        ->select(['reservations.*', 'users.name as name_user', 'rooms.room_number as name_room', 'payments.name as name_payment'])
        ->paginate($request->sort);
        echo json_encode([
            'data' => $data->items(),
            'links' => $data->links()->render()
        ]);
    }
}