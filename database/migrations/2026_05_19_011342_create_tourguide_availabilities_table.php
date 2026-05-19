<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tourguide_availabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tourguide_profile_id')->constrained()->onDelete('cascade');
            $table->date('available_date');
            $table->enum('status', ['available', 'booked'])->default('available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tourguide_availabilities');
    }
};