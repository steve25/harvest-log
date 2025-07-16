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
        Schema::create('weighings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('field_crop_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('coming_weight_kg')->nullable();
            $table->integer('leaving_weight_kg')->nullable();
            $table->integer('netto_weight_kg')->nullable();
            $table->integer('bulk_density')->nullable();
            $table->integer('moisture')->nullable();
            $table->foreignId('storage_id')->nullable()->constrained()->nullOnDelete();
            $table->dateTime('start_record_at');
            $table->dateTime('recorded_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weighings');
    }
};
