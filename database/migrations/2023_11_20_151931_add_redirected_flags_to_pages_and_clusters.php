<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropIndex('pages_name_unique');

            $table->boolean('is_redirected')->default(false);
        });

        Schema::table('clusters', function (Blueprint $table) {
            $table->boolean('is_redirected')->default(false);
        });
    }
};
