<?php

namespace App\Models;

use App\Models\Room_type;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function room_type() {
        return $this->belongsTo(Room_type::class);
    }

    public function reservation() {
        return $this->hasMany(Reservation::class);
    }
}