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
        Schema::create('mst_regrind_inspection_record', function (Blueprint $table) {
            $table->id();
            $table->string('id_register_tool');
            $table->string('eng_no')->nullable();
            $table->string('code')->nullable();
            $table->string('image')->nullable();
            $table->string('max_regrind');
            // json
            $table->json('dimension')->nullable();
            $table->json('inspection_record')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_regrind_inspection_record');
    }
};
