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
        Schema::create('trx_machine_assy_tool', function (Blueprint $table) {
            $table->id();
            $table->string('id_list_machine');
            $table->string('id_trx_assy_old')->nullable();
            $table->string('id_trx_assy_new')->nullable();
            $table->timestamp('start_install')->nullable();
            $table->timestamp('end_install')->nullable();
            $table->string('id_user_install')->nullable();
            $table->string('id_user_uninstall')->nullable();
            $table->string('flag_desktop')->nullable();
            $table->string('flag_transaction')->nullable();
            $table->integer('total_inject')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trx_machine_assy_tool');
    }
};
