<?php

namespace App\Models;

use App\Models\Room;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected static function booted()
    {
        static::created(function () {
            LogActivity::create([
                'user_id' => auth()->user()->id,
                'action' => 'A new Reservation has been created',
            ]);
        });
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function room() {
        return $this->belongsTo(Room::class);
    }
    public function payment() {
        return $this->belongsTo(Payment::class);
    }
}