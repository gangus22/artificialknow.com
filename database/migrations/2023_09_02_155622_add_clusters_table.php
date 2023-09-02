<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clusters', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 255);
            $table->unsignedBigInteger('parent_id')->nullable();

            $table->unique(['slug', 'parent_id']);
        });
    }
};
