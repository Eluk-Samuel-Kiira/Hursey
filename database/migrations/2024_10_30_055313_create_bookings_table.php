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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_number'); 
            $table->date('check_in');
            $table->date('check_out'); 
            $table->integer('guest_number'); 
            $table->string('coming_from')->nullable(); 
            $table->text('special_requests')->nullable(); 
            $table->string('ip_address', 45)->nullable(); 
            $table->enum('status', ['reserved', 'checked_in', 'checked_out', 'canceled'])->default('reserved'); 
            $table->enum('txn_status', ['pending', 'completed', 'failed'])->default('pending'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
