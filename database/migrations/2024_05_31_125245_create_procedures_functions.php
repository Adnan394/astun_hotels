<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
        CREATE PROCEDURE myincome()
            BEGIN
            SELECT SUM(total_price) AS total FROM reservations;
            END
        ');
        DB::unprepared('
        CREATE FUNCTION availableroom()
        RETURNS INT
        BEGIN
            DECLARE total INT;
            SELECT COUNT(*) INTO total FROM rooms WHERE avaibility = 1;
            RETURN total;
        END 
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procedures_functions');
    }
};