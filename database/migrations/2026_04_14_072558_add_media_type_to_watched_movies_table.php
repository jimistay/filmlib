<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('watched_movies', function (Blueprint $table) {
            $table->string('media_type')->default('movie')->after('tmdb_id');
        });
    }

    public function down(): void
    {
        Schema::table('watched_movies', function (Blueprint $table) {
            $table->dropColumn('media_type');
        });
    }
};