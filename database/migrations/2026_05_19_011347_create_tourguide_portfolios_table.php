<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tourguide_portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tourguide_profile_id')->constrained()->onDelete('cascade');
            $table->string('image');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tourguide_portfolios');
    }
};