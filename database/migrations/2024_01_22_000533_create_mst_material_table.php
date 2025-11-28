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
        Schema::create('mst_material', function (Blueprint $table) {
            $table->id();
            $table->string('id_material')->unique();
            $table->string('material_type');
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
        Schema::dropIfExists('mst_material');
    }
};
