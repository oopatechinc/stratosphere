<?php

use App\Models\Integration;
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
        Schema::create('integrations', function (Blueprint $table) {
            $table->id();
            $table->integer('integrable_id')->unsigned();
            $table->string('integrable_type');
            $table->string('platform');
            $table->string('platform_pretty_name')->nullable();
            $table->longText('access_token')->nullable();
            $table->longText('refresh_token')->nullable();
            $table->dateTime('token_created_at')->nullable();
            $table->dateTime('token_expires_in')->nullable();
            $table->string('platform_account_id')->nullable();
            $table->string('platform_user_id')->nullable();
            $table->string('primary_resource_id')->nullable(); //e.g primary google calendar
            $table->string('status')->default(Integration::STATUS_ACTIVE);
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
        Schema::dropIfExists('integrations');
    }
};
