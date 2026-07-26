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
        Schema::create('instagram_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('instagram_user_id', 100)->unique();
            $table->string('username')->nullable();
            $table->string('name')->nullable();
            $table->string('account_type', 50)->nullable();
            $table->text('profile_picture_url')->nullable();
            $table->unsignedInteger('media_count')->nullable();
            $table->longText('access_token');
            $table->timestamp('token_expires_at')->nullable();
            $table->timestamp('connected_at')->nullable();
            $table->timestamp('last_synced_at')->nullable();
            $table->string('last_sync_status', 30)->default('never');
            $table->text('last_sync_error')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instagram_accounts');
    }
};
