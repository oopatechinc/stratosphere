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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('tenant_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('plan_id')->constrained();
            $table->string('pay_fac_session_id');
            $table->string('pay_fac_subscription_id')->nullable();
            $table->string('payment_status', 20);
            $table->string('currency', 50)->nullable();
            $table->decimal('tax')->nullable();
            $table->decimal('total')->nullable();
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
        Schema::dropIfExists('subscriptions');
    }
};
