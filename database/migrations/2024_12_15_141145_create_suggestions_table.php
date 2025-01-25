<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('suggestions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('technology');
            $table->text('tags');
            $table->text('desc');
            $table->boolean('show_roadmap')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->foreignId('user_id');
            $table->enum('status', ['open', 'considering', 'planned', 'in-progress', 'completed']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suggestions');
    }
};
