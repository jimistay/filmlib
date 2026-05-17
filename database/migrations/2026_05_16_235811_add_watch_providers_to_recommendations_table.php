<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recommendations', function (Blueprint $table) {
            if (!Schema::hasColumn('recommendations', 'poster_url')) {
                $table->string('poster_url')->nullable()->after('title');
            }

            if (!Schema::hasColumn('recommendations', 'watch_providers')) {
                $table->json('watch_providers')->nullable()->after('poster_url');
            }

            if (!Schema::hasColumn('recommendations', 'watch_link')) {
                $table->string('watch_link')->nullable()->after('watch_providers');
            }
        });
    }

    public function down(): void
    {
        Schema::table('recommendations', function (Blueprint $table) {
            if (Schema::hasColumn('recommendations', 'watch_link')) {
                $table->dropColumn('watch_link');
            }

            if (Schema::hasColumn('recommendations', 'watch_providers')) {
                $table->dropColumn('watch_providers');
            }

            if (Schema::hasColumn('recommendations', 'poster_url')) {
                $table->dropColumn('poster_url');
            }
        });
    }
};