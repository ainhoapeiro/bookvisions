<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('collection_illustration', function (Blueprint $table) {
            $table->foreign('collection_id')
                ->references('id')
                ->on('collections')
                ->onDelete('cascade');

            $table->foreign('illustration_id')
                ->references('id')
                ->on('illustration')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('collection_illustration', function (Blueprint $table) {
            $table->dropForeign(['collection_id']);
            $table->dropForeign(['illustration_id']);
        });
    }
};
