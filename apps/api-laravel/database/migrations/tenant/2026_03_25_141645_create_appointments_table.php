<?php

use App\Models\Appointment;
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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained();
            $table->foreignId('staff_id')->constrained();
            $table->foreignId('customer_timezone_id')->references('id')->on('timezones');
            $table->unsignedBigInteger('customerable_id');
            $table->string('customerable_type');
            $table->date('date');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('status', 20)->default(Appointment::STATUS_PENDING);
            $table->decimal('booking_fee', 11, 2)->default(0);
            $table->decimal('tip', 11, 2)->default(0);
            $table->decimal('service_total', 11, 2)->default(0);
            $table->decimal('tax', 11, 2)->default(0);
            $table->decimal('total', 11, 2);
            $table->timestamps();
            $table->softDeletes();
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
