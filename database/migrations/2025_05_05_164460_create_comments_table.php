<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('illustration_id');
            $table->text('content');
            $table->timestamps();
        });

        // Delay para asegurar que la tabla illustrations está creada
        sleep(1);

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('illustration_id')
                ->references('id')
                ->on('illustrations')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
