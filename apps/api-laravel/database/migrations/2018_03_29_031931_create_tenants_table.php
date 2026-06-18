<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\Models\Tenant;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('vertical_id')->constrained();
            $table->foreignId('language_id')->default(1)->constrained();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('business_number')->nullable()->unique();
            $table->string('status')->default(Tenant::STATUS_ACTIVE);
            $table->string('logo_path')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->json('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenants');
    }
};
