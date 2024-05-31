<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Room;
use App\Models\Room_type;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function guest() {
        return view('admin.users.index', [
            'users' => User::where('role', 2)->paginate(10)
        ]);
    }

    public function rooms() {
        return view('admin.rooms.index', [
            'rooms' => Room::all(),
        ]);
    }
    
    public function room_create() {
        return view('admin.rooms.create', [
            'room_types' => Room_type::all()
        ]);
    }
    public function room_type() {
        return view('admin.rooms.room_type.index', [
            'room_types' => Room_type::all()
        ]);
    }
    public function room_store(Request $request) {
            $file1 = $request->image1;
            $path1 = 'assets/images/rooms/';
            $filename1 = $path1 . $file1->getClientOriginalName();
            $file1->move($path1, $filename1);

            $file2 = $request->image2;
            $path2 = 'assets/images/rooms/';
            $filename2 = $path2 . $file2->getClientOriginalName();
            $file2->move($path2, $filename2);

            $file3 = $request->image3;
            $path3 = 'assets/images/rooms/';
            $filename3 = $path3 . $file3->getClientOriginalName();
            $file3->move($path3, $filename3);

            Room::create([
                'image1' => $filename1,
                'image2' => $filename2,
                'image3' => $filename3,
                'room_number' => $request->room_number,
                'room_type_id' => $request->room_type,
                'description' => $request->desciption,
                'avaibility' => $request->avaibility
            ]);

        return redirect('/admin/rooms')->with('success', 'Room created successfully');
    }
    public function room_type_store(Request $request) {
        $file = $request->image;
        $path = 'assets/images/room_type/';
        $filename = $path . $file->getClientOriginalName();
        $file->move($path, $filename);

        Room_type::create([
            'name' => $request->name,
            'image' => $filename,
            'price_per_night' => $request->price_per_night
        ]);

        return redirect('/admin/room_type')->with('success', 'Room type created successfully');
    }

    public function payment() {
        return view('admin.payment.index', [
            'payments' => Payment::all(),
        ]);
    }
    public function payment_store(Request $request) {
        Payment::create([
            'name' => $request->name
        ]);
        return redirect()->back()->with('success', 'Payment method created successfully');
    }
}