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
        Schema::create('instagram_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('instagram_account_id')->constrained('instagram_accounts')->cascadeOnDelete();
            $table->string('instagram_media_id', 100)->unique();
            $table->longText('caption')->nullable();
            $table->string('media_type', 30);
            $table->string('media_product_type', 30)->nullable();
            $table->text('media_url')->nullable();
            $table->text('thumbnail_url')->nullable();
            $table->text('permalink');
            $table->string('username')->nullable();
            $table->timestamp('posted_at');
            $table->json('children')->nullable();
            $table->json('raw_payload')->nullable();
            $table->boolean('is_visible')->default(true);
            $table->timestamp('synced_at')->nullable();
            $table->timestamps();

            $table->index('posted_at');
            $table->index('is_visible');
            $table->index(['instagram_account_id', 'posted_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instagram_media');
    }
};
