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
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->index(['is_published', 'published_at'], 'idx_blog_published');
        });

        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->index(['is_published', 'order'], 'idx_portfolio_published');
        });

        Schema::table('media', function (Blueprint $table) {
            $table->index(['file_type', 'order'], 'idx_media_filetype_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropIndex('idx_blog_published');
        });

        Schema::table('portfolio_items', function (Blueprint $table) {
            $table->dropIndex('idx_portfolio_published');
        });

        Schema::table('media', function (Blueprint $table) {
            $table->dropIndex('idx_media_filetype_order');
        });
    }
};
