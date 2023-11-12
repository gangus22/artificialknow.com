<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    // TODO: add scheduled auto conversion from 301 to 302 in case of old redirects
    public function up(): void
    {
        Schema::create('redirects', function (Blueprint $table) {
            $table->id();
            $table->string('from', 255);
            $table->string('to', 255);
            $table->enum('type', [301, 302]);
        });
    }
};
