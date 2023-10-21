<?php

use App\Models\Page;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('contents');

        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->json('article');
            $table->foreignIdFor(Page::class)->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }
};
