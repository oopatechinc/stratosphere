<?php

use App\Models\Location;
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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('language_id')->default(1)->constrained();
            $table->foreignId('timezone_id')->nullable()->constrained();
            $table->string('nickname', 255);
            $table->string('type', 255)->default(Location::TYPE_PHYSICAL);
            $table->string('subdomain')->nullable()->unique();
            $table->string('email', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('x_account', 50)->nullable();
            $table->string('instagram_account', 50)->nullable();
            $table->string('facebook_account', 50)->nullable();
            $table->string('linkedin_account', 50)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
