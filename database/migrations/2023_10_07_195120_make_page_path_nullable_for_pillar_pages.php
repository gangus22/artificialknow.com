<?php

use App\Models\Cluster;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('path', 255)->nullable()->change();
            $table->string('name', 255)->unique()->after('meta');

            $table->foreignIdFor(Cluster::class)->change()->nullable()->constrained()->nullOnDelete();
        });
    }
};
