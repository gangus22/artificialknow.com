<?php

use App\Models\Example;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $example = new Example();
        $example->test_data = 'Im a purple test data from DB.';
        $example->save();
    }
};
