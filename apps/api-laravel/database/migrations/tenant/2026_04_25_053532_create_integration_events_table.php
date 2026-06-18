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
        Schema::create('integration_events', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('eventable_id');
            $table->string('eventable_type');
            $table->foreignId('integration_id')->constrained()->cascadeOnDelete();
            $table->foreignId('integration_resource_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('event_id');
            $table->string('url')->nullable();
            $table->string('password', 30)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integration_events');
    }
};
