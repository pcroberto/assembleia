<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votacoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pauta_id');
            $table->foreign('pauta_id')->references('id')->on('pautas');
            $table->integer('minutos')->default(1);
            $table->timestamps();
        });

        Schema::create('votos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('votacao_id');
            $table->foreign('votacao_id')->references('id')->on('votacoes');
            $table->boolean('voto');
            $table->integer('associado');
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
        Schema::dropIfExists('votos');
        Schema::dropIfExists('votacoes');
    }
}
