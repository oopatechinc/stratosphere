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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained();
            $table->foreignId('state_id')->constrained();
            $table->unsignedBigInteger('addressable_id');
            $table->string('addressable_type');
            $table->boolean('hide_address')->default(false);
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->string('postal_code')->nullable();
            $table->string('gmaps_full_address')->nullable();
            $table->string('gmaps_place_id')->nullable();
            $table->decimal('gmaps_longitude', 11, 8)->nullable();
            $table->decimal('gmaps_latitude', 10, 8)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
