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
        Schema::create('pay_fac_payment_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pay_fac_customer_id')->constrained();
            $table->string('payment_method');
            $table->boolean('is_default')->default(0);
            $table->string('brand');
            $table->string('identifier')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_fac_payment_methods');
    }
};
