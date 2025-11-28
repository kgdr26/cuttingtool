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
        Schema::create('mst_holder', function (Blueprint $table) {
            $table->id();
            $table->string('id_holder')->unique();
            $table->string('holder_type');
            $table->boolean('is_active')->default(true);
            $table->string('created_by', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_holder');
    }
};
