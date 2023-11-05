<?php

use App\Models\Cluster;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Cluster::query()->delete();
        Schema::table('clusters', function (Blueprint $table) {
            $table->string('breadcrumbs_title', 255)->after('slug');

            $table->unique(['breadcrumbs_title', 'parent_id']);
        });
    }
};
