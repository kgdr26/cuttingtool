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
        Schema::create('mst_tool_regis', function (Blueprint $table) {
            $table->id();
            $table->string('id_tool');//id type tool
            $table->string('id_maker');//id maker tool
            $table->string('id_material');//id material tool
            $table->string('id_marking');//id marking program
            $table->string('id_unit');//id unit
            $table->string('part_no');
            $table->string('engineering_no');
            $table->string('hes_no');
            $table->string('spesification');
            $table->string('price');
            $table->string('replacement');
            $table->string('judgement');
            $table->integer('max_regrind');
            $table->integer('max_indexing');
            $table->string('drawing');
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
        Schema::dropIfExists('mst_tool_regis');
    }
};
