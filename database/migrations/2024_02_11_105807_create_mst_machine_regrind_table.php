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
        Schema::create('mst_machine_regrind', function (Blueprint $table) {
            $table->id();
            $table->string('id_plant');
            $table->string('no_asset');
            $table->string('machine_regrind');
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
        Schema::dropIfExists('mst_machine_regrind');
    }
};
