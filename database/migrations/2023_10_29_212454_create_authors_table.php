<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->unique();
            $table->string('title', 255);
            $table->string('bio', 255);
            $table->string('img_path', 255)->nullable();
            $table->string('linkedin', 255)->nullable();
        });
    }
};
