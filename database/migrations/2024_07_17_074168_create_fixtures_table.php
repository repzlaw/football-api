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
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('home_club_id')->nullable()->constrained('clubs')->cascadeOnDelete();
            $table->foreignId('away_club_id')->nullable()->constrained('clubs')->cascadeOnDelete();
            $table->foreignId('venue_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('home_club_score')->nullable();
            $table->string('away_club_score')->nullable();
            $table->timestamp('kick_off');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixtures');
    }
};
