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
        Schema::create('mst_marking_tool', function (Blueprint $table) {
            $table->id();
            $table->string('id_tool_regis');
            $table->string('id_wct');
            $table->string('qr_code');
            $table->string('status_qr_code');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_stock')->default(false);
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_marking_tool');
    }
};
