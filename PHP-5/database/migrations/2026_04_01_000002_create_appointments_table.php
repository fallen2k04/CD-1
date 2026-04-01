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
        Schema::create('appointments', function (Blueprint $col) {
            $col->id();
            $col->foreignId('customer_id')->constrained()->onDelete('cascade');
            $col->date('appointment_date');
            $col->time('appointment_time');
            $col->string('status')->default('active'); // active, cancelled
            $col->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
