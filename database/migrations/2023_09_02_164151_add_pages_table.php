<?php

use App\Models\Cluster;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Cluster::class)->nullable();
            $table->json('meta');
            $table->string('path');
            $table->boolean('indexed')->default(false);
            $table->boolean('visible')->default(false);
            $table->timestamps();

            $table->unique([['cluster_id','path'], 'meta']);
        });
    }
};
