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
        Schema::create('mst_assy_tool_port_regis', function (Blueprint $table) {
            $table->id();
            $table->string('id_machine_regis');
            $table->string('id_cutting_tool_regis');
            $table->string('id_holder_regis');
            $table->string('id_accesories_regis');
            $table->string('tool_port');
            $table->string('sigma_process');
            $table->string('macro_address');
            $table->string('min_value');
            $table->string('max_value');
            $table->boolean('is_active')->default(true);
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_assy_tool_port_regis');
    }
};
