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
        Schema::create('trx_assy', function (Blueprint $table) {
            $table->id();
            $table->string('holder_qr_code');
            $table->string('id_assy');
            $table->string('id_plant');
            $table->string('id_wct');
            $table->string('id_machine_regis');
            $table->string('id_assy_tool_port_regis');
            $table->integer('id_user_install')->nullable();
            $table->integer('id_user_uninstall')->nullable();
            $table->text('json_tool');
            $table->text('json_holder');
            $table->text('json_acc');
            $table->text('status_assy');
            $table->dateTime('start_install')->nullable();
            $table->dateTime('end_install')->nullable();
            $table->integer('total_inject')->nullable();
            $table->string('zoller_z_value')->nullable();
            $table->string('zoller_x_value')->nullable();
            $table->integer('id_location')->nullable();
            $table->string('actual_lifetime')->default(0);
            $table->string('id_user_tool_analyze')->nullable();
            $table->string('id_user_regrind_process')->nullable();
            $table->string('id_user_regrind_check')->nullable();
            $table->timestamp('start_regrind')->nullable();
            $table->timestamp('end_regrind')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trx_assy');
    }
};
