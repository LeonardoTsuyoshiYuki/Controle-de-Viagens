<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('viagens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('motorista_id')->constrained('motoristas')->cascadeOnDelete();
            $table->foreignId('veiculo_id')->constrained('veiculos')->cascadeOnDelete();
            $table->unsignedInteger('km_inicial');
            $table->unsignedInteger('km_final');
            $table->dateTime('data_hora_saida');
            $table->dateTime('data_hora_chegada');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('viagens');
    }
};
