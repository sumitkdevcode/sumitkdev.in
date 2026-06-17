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
        Schema::create('social_posts', function (Blueprint $table) {
            $table->id();
            $table->string('platform')->default('instagram'); // instagram, twitter, custom
            $table->text('content')->nullable(); // caption or tweet text
            $table->string('media_url')->nullable(); // local path or remote URL
            $table->string('media_type')->default('IMAGE'); // IMAGE, VIDEO, CAROUSEL_ALBUM
            $table->string('permalink')->nullable(); // link to original post
            $table->timestamp('published_at')->useCurrent();
            $table->boolean('is_published')->default(true);
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
        Schema::dropIfExists('social_posts');
    }
};
