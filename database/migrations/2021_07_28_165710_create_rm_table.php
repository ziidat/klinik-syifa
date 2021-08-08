<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rm', function (Blueprint $table) {
            $table->id('id');
            $table->id('idpasien');
            $table->string('keluhan');
            $table->text('anamnesis');
            $table->text('cekfisik');
            $table->text('lab');
            $table->text('hasil');
            $table->string('diagnosis');
            $table->text('resep');
            $table->text('jumlah');
            $table->text('aturan');
            $table->integer('dokter');
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
        Schema::dropIfExists('rm');
    }
}
