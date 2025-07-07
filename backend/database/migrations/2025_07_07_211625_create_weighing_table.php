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
        Schema::create('weighing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('field_crop_id')->nullable()->constrained()->onDelete('set_null');
            $table->decimal('brutto_kg', 10, 2)->nullable();
            $table->decimal('netto_kg', 10, 2)->nullable();
            $table->decimal('tara_kg', 10, 2)->nullable();
            $table->dateTime('recorded_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weighing');
    }
};
