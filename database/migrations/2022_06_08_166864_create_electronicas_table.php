<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElectronicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('electronicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('texnika_id');
            $table->foreignId('filial_id');
            $table->foreignId('dep_id')->nullable();
            $table->foreignId('bolim_id')->nullable();
            $table->string('inverta_nomer');
            $table->string('model');
            $table->string('protsessor')->nullable();
            $table->string('ozu')->nullable();
            $table->string('tip_sistema')->nullable();
            $table->string('printer_name')->nullable();
            $table->date('year');
            $table->string('storage')->nullable();
            $table->string('tip_printer')->nullable();
            $table->string('monitor_name')->nullable();
            $table->string('monitor_size')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('electronicas');
    }
}
