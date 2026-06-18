<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained();
            $table->foreignId('promotion_id')->nullable()->constrained();
            $table->string('external_payfac_id', 50);
            $table->integer('trial_period_days');
            $table->string('alias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_products');
    }
};
