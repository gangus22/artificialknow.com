<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('url', 255)->unique()->nullable()->after('cluster_id');
        });

        Schema::table('clusters', function (Blueprint $table) {
            $table->string('url', 255)->unique()->nullable()->after('slug');
        });
    }
};
