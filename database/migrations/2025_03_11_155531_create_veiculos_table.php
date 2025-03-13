<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_veiculos_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVeiculosTable extends Migration
{
    public function up()
    {
        Schema::create('veiculos', function (Blueprint $table) {
            $table->id();
            $table->string('modelo');
            $table->integer('ano');
            $table->date('data_aquisicao');
            $table->integer('km_aquisicao');
            $table->string('placa')->unique(); 
            $table->string('renavam')->unique();
            $table->timestamps();

            $table->unique('placa');
            $table->unique('renavam');
        });
    }

    public function down()
    {       
        Schema::table('veiculos', function (Blueprint $table) {
            $table->dropUnique(['placa']);
            $table->dropUnique(['renavam']);
        });
        Schema::dropIfExists('veiculos');
    }
}
