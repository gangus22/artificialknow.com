<?php

use App\Models\Author;
use App\Models\Content;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Content::query()->delete();
        Schema::table('contents', function (Blueprint $table) {
            $table->foreignIdFor(Author::class)->after('name')->constrained();
        });
    }
};
