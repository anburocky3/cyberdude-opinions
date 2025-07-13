<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->integer('price')->default(0);
            $table->integer('discount_price')->default(0);
            $table->boolean('is_membership')->default(false);
            $table->string('image')->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('duration')->comment('in minutes');
            $table->string('language')->default('tamil');
            $table->string('tags')->nullable();
            $table->string('color')->nullable();
            $table->string('difficulty_level')->nullable();
            $table->json('prerequisites')->nullable();
            $table->json('learning_objectives')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
